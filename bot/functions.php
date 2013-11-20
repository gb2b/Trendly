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
	"gnews_cache"     => "gnews.json",
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

function getVideoYoutube($auth, $cache, $q = null)
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
			$i++;
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

function getTrendGnews($cache, $q)
{
	$cache  = array_to_object($cache);
	require_once $cache->classe;

	$gCache = new Cache($cache->path_cache,$cache->time);
	if (isset($q) && !empty($q)) {
		$q = "&q=".$q;
	}
	$url = "http://news.google.fr/news?pz=1&cf=all&ned=fr&hl=fr&output=rss".$q;

	if ($gCache->read("_".$cache->gnews_cache)) {
		$infos = json_decode($gCache->read("_".$cache->gnews_cache));
	}else{
		try{
		    if(!@$fluxrss=simplexml_load_file($url)){
		        throw new Exception('Flux introuvable');
		    }
		    if(empty($fluxrss->channel->title) || empty($fluxrss->channel->description) || empty($fluxrss->channel->item->title))
		        throw new Exception('Flux invalide');
		        $i = 0;
		        $caractereRemove = array(".", "!", ";", ",","faire","font","avec","supprimer");
		    	foreach ($fluxrss->channel->item as $item) {
					$b                       = explode("<font size=\"-1\">", $item->description);
					$b[]                     = utf8_decode(utf8_encode(strip_tags($item->title)));
					$title                   = bestWord($b, $caractereRemove);
					$infos[$i]->title        = $title["mot"];
					$infos[$i]->nbOccurences = $title["nbOccurences"];
					$b                       = explode("<b>", $item->description);
					$nbArticles              = end($b);
					$infos[$i]->nbArticles   = intval(utf8_decode($nbArticles));
					$b                       = explode("<font size=\"-1\">", $item->description);
					$description             = $b[2];
					$infos[$i]->description  = strip_tags($description);
					$infos[$i]->date         = strtotime($item->pubDate);
					preg_match("/url=.*/", $item->link, $url1, PREG_OFFSET_CAPTURE);
					$infos[$i]->url          = substr($url1[0][0], 4);
					$othersArticles = new DOMDocument();
					@$othersArticles->loadHTML($item->description);
					$urlArticles = $othersArticles->getElementsByTagName('a');
					$j = 0;
					foreach ($urlArticles as $urlArticle) {
						if ($j>0) {
							$articles = $urlArticle->getAttribute("href");
							preg_match("/url=.*/", $articles, $url1, PREG_OFFSET_CAPTURE);
							$infos[$i]->othersArticles[$j] = substr($url1[0][0], 4);

						}
						$j++;
					}
					$i++;
		    	}
		    $gCache->write("_".$cache->gnews_cache, json_encode($infos));		 
		}catch(Exception $e){
		    echo $e->getMessage();
		} 
	}
	return $infos;
}

function getTrendsPonderation($auth, $cache, $minimal = false)
{
		$twitter   = getPopularTwTrends($auth, $cache);
		$gnews     = getTrendGnews($cache);
		$result[0] = explodeHashtag($twitter[0]);
		$result[1] = $gnews[0]->title;
		$result[2] = explodeHashtag($twitter[1]);
		$result[3] = $gnews[1]->title;
		$result[4] = explodeHashtag($twitter[2]);
		$result[5] = $gnews[3]->title;
		$result[6] = explodeHashtag($twitter[3]);
		$result[7] = $gnews[4]->title;
		$result[8] = explodeHashtag($twitter[4]);
		$result[9] = $gnews[5]->title;
		$content = "var trends = {";
		for ($i=0; $i < count($result); $i++) { 
			if (isset($result[$i]) && !empty($result[$i])) {
				$content .= "\"".$result[$i]."\": [".$i."]";
			}
			if ($i < (count($result)-1)) {
				$content .= ",";
			}
		}
		$content .= "}";
		return $content;

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

function dateTexte($date, $pattern = null){
    setlocale(LC_TIME, "fr_FR.UTF8");
    date_default_timezone_get("Etc/GMT+1");
    if (!isset($pattern) || empty($pattern)) {
        $pattern = "%A %e %B %G à %H:%M";
    }
    return strftime($pattern, $date);
}

function bestWord($phrases, $caractereRemove = array())
{
    for ($i=0; $i < count($caractereRemove); $i++) { 
        $caractereRemoved[$i] = "";
    }
    $chaine = "";
    foreach ($phrases as $phrase) {
        $chaine .= trim(strtolower(str_replace($caractereRemove, $caractereRemoved, $phrase)))." ";
     } 
    $motsAChercher = explode(" ", strip_tags($chaine));

    $i = 0;
    $max = 0;
    foreach ($motsAChercher as $mot) {
        $nbMotAChercher[$i] = @mb_substr_count($chaine, $mot);
        if (strlen($mot)>3) {
            if (intval($nbMotAChercher[$i]) > $max) {
                $max = $nbMotAChercher[$i];
                $idMax = $i;
            }
        }
    $i++;
    }

    return array("mot" => $motsAChercher[$idMax], "nbOccurences" => $max);

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

function explodeHashtag($chaine)
{
	if (preg_match("/^#.*/", $chaine)) {
		$chaine = substr($chaine, 1);
	}
	preg_match_all('#[A-Z]#',$chaine, $chaine3);
	$chaine2 = preg_split('#[A-Z]#',$chaine);
	if (count($chaine2)>0){
		$chaine = "";
		for ($i=0; $i < count($chaine2); $i++) { 
			if (strlen($chaine2[$i])>=1) {
				$chaine .= $chaine3[0][$i-1].$chaine2[$i]." ";
			}
		}
	}
	return trim($chaine);
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
