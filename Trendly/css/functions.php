<?php 

$auth =  array(
	"tw_consumer_key"       => "P4sltM3eLlkfCu7u137JCw",
	"tw_consumer_secret"    => "vfoA4Ew0f0iv4jioGy96q9RzJknisr3Yy8LMHQEw",
	"tw_oauth_token"        => "123935211-meMJIWjVL4iaD6mNchXOhbTEYPv5ag4jcfs9wocK",
	"tw_oauth_token_secret" => "rHm8e8ZRZ6iTl7u0JnPzmTDXDq4N69yTeZoHsQ1wpM",
	"tw_path_file_oauth"    => "auth/twitteroauth/twitteroauth.php",
	"instg_client_id"       => "9110e8c268384cb79901a96e3a16f588",
	"bing_client_id"        => "gwqxJUSegbzJC1MyPhs4IV1A5u9yRvGjl2QYjEwzZEs",
	"imgur_client_id"       => "7bf23d0ba414535",
	"zend_yt_path_file"     => "Zend/Loader.php"
	);

$cache = array(
	"classe"      => "class.cache.php",
	"tw_cache"    => "twitter.json",
	"yt_cache"    => "youtube.json",
	"instg_cache" => "instagram.json",
	"gnews_cache" => "gnews.json",
	"imgur_cache" => "imgur.json",
	"bing_cache"  => "bing.json",
	"trend_cache" => "trends.json",
	"time"        => 5, 
	"path_cache"  => "tmp"
	);

/*echo "<pre>";
print_r(getSearchTweets($auth, "tireur", $cache));
echo "</pre>";*/

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
		$content = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".urlencode($q)."&lang=fr&result_type=mixed");//attention à bien définir 	$query (la requête) avant
		$i = 0;
		foreach ($content->statuses as $tweet) {
			$tweets[$i]->text     = $tweet->text;
			$tweets[$i]->user     = $tweet->user->screen_name;
			$tweets[$i]->urlTweet = "http://twitter.com/user/status/".$tweet->id_str;
			$tweets[$i]->urls     = $tweet->entities->urls[0]->url;
			$tweets[$i]->img      = $tweet->entities->media[0]->media_url;
			$i++;
		}
/*		$tweets = $content->statuses[0]->entities;
*/		$tweetCache ->write(cleanCaracteresSpeciaux($q)."_".$cache->tw_cache, json_encode($tweets));
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
				$TwName = preg_replace("/^#([a-zA-Z0-9]+)/", "$1", $trend->name);
				$tweets[$i] = $TwName;
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

/*function getPopularInstgImage($auth, $cache)
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
}*/

function getTrendGnews($cache, $q)
{
	$cache  = array_to_object($cache);
	require_once $cache->classe;

	$gCache = new Cache($cache->path_cache,$cache->time);
	if (isset($q) && !empty($q)) {
		$q2 = "&q=".$q;
	}else{
		$q = "";
	}
	$url = "http://news.google.fr/news?pz=1&cf=all&ned=fr&hl=fr&output=rss".$q2;

	if ($gCache->read(cleanCaracteresSpeciaux($q)."_".$cache->gnews_cache)) {
		$infos = json_decode($gCache->read(cleanCaracteresSpeciaux($q)."_".$cache->gnews_cache));
	}else{
		try{
		    if(!@$fluxrss=simplexml_load_file($url)){
		        throw new Exception('Flux introuvable');
		    }
		    if(empty($fluxrss->channel->title) || empty($fluxrss->channel->description) || empty($fluxrss->channel->item->title))
		        throw new Exception('');
		        $i = 0;
		        $caractereRemove = array(".", "!", ";", ",","faire","font","avec","supprimer");
		    	foreach ($fluxrss->channel->item as $item) {
					$b                       = explode("<font size=\"-1\">", $item->description);
					$b[]                     = utf8_decode(utf8_encode(strip_tags($item->title)));
					$title                   = bestWord($b, $caractereRemove);
					$infos[$i]->keyword      = $title["mot"];
					$titleSplit              = preg_split("# - #", $item->title);
					$infos[$i]->mainTitle    = strip_tags($titleSplit[0]);
					$infos[$i]->author       = strip_tags($titleSplit[1]);
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
					$othersArticles          = new DOMDocument();
					@$othersArticles->loadHTML($item->description);
					$urlArticles             = $othersArticles->getElementsByTagName('a');
					$othersAuthors           = new DOMDocument();
					@$othersAuthors->loadHTML($item->description);
					$authorsArticles         = $othersAuthors->getElementsByTagName('nobr');
					$j = 0;
					$nbArticles = 0;
					$k = 0;
					foreach ($urlArticles as $urlArticle) {
						$nbArticles++;
					}
					foreach ($authorsArticles as $authorArticle) {
						$authorArticles[$k] = $authorArticle->textContent;
						$k++;
					}
					foreach ($urlArticles as $urlArticle) {
						$articles = $urlArticle->getAttribute("href");
						if ($j>1 && !empty($articles) && $j<($nbArticles-4)) {
							preg_match("/url=.*/", $articles, $url1, PREG_OFFSET_CAPTURE);
							$urlFinale = substr($url1[0][0], 4);
							if (!empty($urlFinale)) {
								$m = $j-1;
								$infos[$i]->othersArticles->$m->title   = strip_tags($urlArticle->textContent);
								$infos[$i]->othersArticles->$m->url     = substr($url1[0][0], 4);
								$infos[$i]->othersArticles->$m->authors = $authorArticles[$m-1];
							}
						}
						$j++;
					}
					$i++;
		    	}
		    $gCache->write(cleanCaracteresSpeciaux($q)."_".$cache->gnews_cache, json_encode($infos));		 
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

		$result[0] = $twitter[0];
		$result[1] = $gnews[0]->keyword;
		$result[2] = $twitter[1];
		$result[3] = $gnews[1]->keyword;
		$result[4] = $twitter[2];
		$result[5] = $gnews[3]->keyword;
		$result[6] = $twitter[3];
		$result[7] = $gnews[4]->keyword;
		$result[8] = $twitter[4];
		$result[9] = $gnews[5]->keyword;
		$content = "{";
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

/*function getPicturesImgur($auth,$cache,$q){
	$auth   = array_to_object($auth);
	$cache  = array_to_object($cache);
	require_once $cache->classe;

	$imagesCache = new Cache($cache->path_cache,$cache->time);
	$api = 'https://api.imgur.com/3/gallery/search/1?q='.urlencode($q);
	$response = getCurlImgur($api,$auth->imgur_client_id);
	
	if($response){
	    $i = 0; 
	    if ($imagesCache->read(cleanCaracteresSpeciaux($q)."_".$cache->imgur_cache)) {
			$images = json_decode($imagesCache->read(cleanCaracteresSpeciaux($q)."_".$cache->imgur_cache));
		}else{
		    foreach(json_decode($response)->data as $item){
				
				$title                   = (isset($item->title))?$item->title:null;
				$src                     = $item->link; 
				$description             = (isset($item->description))?$item->description:null;  
				$images[$i]->id          = htmlspecialchars($item->id);
				$images[$i]->title       = htmlspecialchars($title);
				$images[$i]->src         = htmlspecialchars($src);
				$images[$i]->description = htmlspecialchars($description);
		        $i++;
		    }
		    $imagesCache->write(cleanCaracteresSpeciaux($q)."_".$cache->imgur_cache, json_encode($images));
		}
	    return $images;
	}
}*/

function getPicturesBing($cache,$auth,$q){
		$auth   = array_to_object($auth);
		$cache  = array_to_object($cache);
		require_once $cache->classe;

		$bingCache = new Cache($cache->path_cache,$cache->time);
	    $api =  'https://api.datamarket.azure.com/Bing/Search/Image?$format=json&Query=%27'.urlencode($q).'%27&Market=%27fr-FR%27&Adult=%27Strict%27&ImageFilters=%27Size%3ALarge%27';  
	    $response = get_curl_bing($api,$auth->bing_client_id);
	    
		if($response){
		    $i = 0; 
		    if ($bingCache->read(cleanCaracteresSpeciaux($q)."_".$cache->bing_cache)) {
				$images = json_decode($bingCache->read(cleanCaracteresSpeciaux($q)."_".$cache->bing_cache));
			}else{
			    foreach(json_decode($response)->d->results as $item){
					$title                = (isset($item->Title))?$item->Title:null;
					$mediasrc             = $item->MediaUrl; 
					$url                  = $item->SourceUrl; 
					$width                = $item->Width; 
					$height               = $item->Height; 
					
					$images[$i]->title    = htmlspecialchars($title);
					$images[$i]->mediasrc = htmlspecialchars($mediasrc);
					$images[$i]->url      = htmlspecialchars($url);
					$images[$i]->width    = htmlspecialchars($width);
					$images[$i]->height   = htmlspecialchars($height);
			        $i++;
			    }
			    $bingCache->write(cleanCaracteresSpeciaux($q)."_".$cache->bing_cache, json_encode($images));
			}
		    return $images;
		}

}




function array_to_object($array) {
  $object = new stdClass;
  foreach($array as $key => $value) {
   if(is_array($value)) {
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

function getCurlImgur($theurl,$the_clientid){
	if(function_exists('curl_init')){
		$headr = array();
		$headr[] = 'Content-length: 0';
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: Client-Id '.$the_clientid; 
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$theurl);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_GET,true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
	    $output = curl_exec($ch);
	    echo curl_error($ch);
	    curl_close($ch);
	    return $output;
    }else{
        return file_get_contents($url);
    }
}

function get_curl_bing($url,$key){
    if(function_exists('curl_init')){
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($process, CURLOPT_USERPWD,  $key . ":" . $key);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($process);

        curl_close($process);
        return $response;
    }else{
        return file_get_contents($url);
    }
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
