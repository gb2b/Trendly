<?php 

$auth =  array(
	"tw_consumer_key"       => "P4sltM3eLlkfCu7u137JCw",
	"tw_consumer_secret"    => "vfoA4Ew0f0iv4jioGy96q9RzJknisr3Yy8LMHQEw",
	"tw_oauth_token"        => "123935211-meMJIWjVL4iaD6mNchXOhbTEYPv5ag4jcfs9wocK",
	"tw_oauth_token_secret" => "rHm8e8ZRZ6iTl7u0JnPzmTDXDq4N69yTeZoHsQ1wpM",
	"tw_path_file_oauth"    => "auth/twitteroauth/twitteroauth.php",
	"instg_client_id"       => "9110e8c268384cb79901a96e3a16f588",
	"zend_yt_path_file"     => "Zend/Loader.php"
	);

$cache = array(
	"classe"          => "class.cache.php",
	"tw_cache"        => "twitter.json",
	"yt_cache"        => "youtube.json",
	"instg_cache"     => "instagram.json",
	"time"            => 5, 
	"path_cache"      => "tmp"
	);

function getSearchTweets($auth, $q, $cache)
{
	$auth   = array_to_object($auth);
	$cache  = array_to_object($cache);

	require_once $cache->classe;
	$tweetCache = new Cache($cache->path_cache,$cache->time);

	if ($tweetCache->read(cleanCaracteresSpeciaux($q)."_".$cache->tw_cache)) {
		$tweets = json_decode($tweetCache->read(cleanCaracteresSpeciaux($q)."_".$cache->tw_cache));
	}else{
		require_once($auth->tw_path_file_oauth);	

		$connection = new TwitterOAuth($auth->tw_consumer_key, $auth->tw_consumer_secret, $auth->tw_oauth_token, $auth->tw_oauth_token_secret);
		$connection->host = "https://api.twitter.com/1.1/";
		$content = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$q."&lang=fr&result_type=popular");//attention à bien définir 	$query (la requête) avant
		$i = 0;

		foreach ($content->statuses as $tweet) {
			$tweets[$i]->text = $tweet->text;
			$tweets[$i]->user = $tweet->user->screen_name;
			$i++;
		}

		$tweetCache->write(cleanCaracteresSpeciaux($q)."_".$cache->tw_cache, json_encode($tweets));
	}
	return $tweets;
}


function getPopularTwTrends($auth, $cache)
{
	$auth   = array_to_object($auth);
	$cache  = array_to_object($cache);

	require_once $cache->classe;
	$tweetCache = new Cache($cache->path_cache,$cache->time);

	if ($tweetCache->read($cache->tw_cache)) {
		$tweets = json_decode($tweetCache->read($cache->tw_cache));
	}else{
		require_once($auth->tw_path_file_oauth);	

		$connection = new TwitterOAuth($auth->tw_consumer_key, $auth->tw_consumer_secret, $auth->tw_oauth_token, $auth->tw_oauth_token_secret);
		$connection->host = "https://api.twitter.com/1.1/";
		$content = $connection->get("https://api.twitter.com/1.1/trends/place.json?id=23424819");//attention à bien définir 	$query (la requête) avant
		$i = 0;

		if (!empty($content)) {
			foreach ($content[$i]->trends as $trend) {
				$tweets[$i] = $trend->name;
				$i++;
			}
		}

		$tweetCache->write($cache->tw_cache, json_encode($tweets));
	}
	return $tweets;
}

function getVideoYoutube($auth, $q = null, $cache)
{
	$cache = array_to_object($cache);
	$auth  = array_to_object($auth);
	require_once($auth->zend_yt_path_file);
	require_once($cache->classe);
	$videoCache = new Cache($cache->path_cache,$cache->time);

	if ($videoCache->read(cleanCaracteresSpeciaux($q)."_".$cache->yt_cache)) {
		$v = json_decode($videoCache->read(cleanCaracteresSpeciaux($q)."_".$cache->yt_cache));
	}else{
		Zend_Loader::loadClass("Zend_Gdata_YouTube");
		$yt = new Zend_Gdata_Youtube();
		if (isset($q) && !empty($q)) {
			$videoFeed = $yt->getVideoFeed("http://gdata.youtube.com/feeds/api/videos?q=".urlencode($q)."&orderby=published&max-results=10&v=2&region=FR&orderby=relevance");

		}else{
			$videoFeed = $yt->getVideoFeed("http://gdata.youtube.com/feeds/api/standardfeeds/FR/most_popular?min-results=10&time=today&v=2&region=FR");
		}
		$i = 0;
		foreach ($videoFeed as $video): $thumbs = $video->getVideoThumbnails();
			$v[$i]->title       = $video->getVideoTitle();
			$v[$i]->url         = $video->getVideoWatchPageUrl();
			$v[$i]->description = $video->getVideoDescription();
			$v[$i]->thumbnail   = $thumbs[2]["url"];
/*			$v[$i]->username = $video->getUserId();
*/			$i++;
		endforeach;
		$videoCache->write(cleanCaracteresSpeciaux($q)."_".$cache->yt_cache, json_encode($v));
	}

	return $v;
}

function getPopularInstgImage($auth, $cache)
{
	$auth   = array_to_object($auth);
	$cache  = array_to_object($cache);
	require_once $cache->classe;

	$imagesCache = new Cache($cache->path_cache,$cache->time);
	$api = 'https://api.instagram.com/v1/media/popular?client_id='.$auth->instg_client_id; //api request (edit this to reflect tags)
	$response = get_curl($api); //change request path to pull different photos

	if($response){
	    $i = 0; 
	    if ($imagesCache->read("_".$cache->instg_cache)) {
			$images = json_decode($imagesCache->read("_".$cache->instg_cache));
		}else{
		    foreach(json_decode($response)->data as $item){

		        $title = (isset($item->caption))?mb_substr($item->caption->text,0,70,"utf8"):null;

		        $src = $item->images->standard_resolution->url; 
		        $lat = (isset($item->data->location->latitude))?$item->data->location->latitude:null; 
		        $lon = (isset($item->data->location->longtitude))?$item->data->location->longtitude:null;
		        $images[$i]->title = htmlspecialchars($title);
		        $images[$i]->src   = htmlspecialchars($src);
		        $images[$i]->lat   = htmlspecialchars($lat);
		        $images[$i]->lon   = htmlspecialchars($lon);
		        $i++;
		    }
		    $imagesCache->write("_".$cache->instg_cache, json_encode($images));
		}
	    return $images;
	}
}

function array_to_object($array) {
  $object = new stdClass;
  foreach($array as $key => $value) {
   if(is_array($value)) {
     // Si c'est un tableau multidimensionnel, on appelle de nouveau la fonction.
     $object->$key = array_to_object($value);
   } else {
     $object->$key = $value;
   }
  }
  return $object;
}

function cleanCaracteresSpeciaux($chaine)
{
	setlocale(LC_ALL, 'fr_FR');
	$chaine = str_replace(" ", "", $chaine);
	$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
	$chaine = preg_replace('#[^0-9a-z]+#i', '-', $chaine);

	while(strpos($chaine, '--') !== false)
	{
		$chaine = str_replace('--', '-', $chaine);
	}

	$chaine = trim($chaine, '-');

	return $chaine;
}

function get_curl($url){
    if(function_exists('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);
        return $output;
    }else{
        return file_get_contents($url);
    }

}
 ?>
