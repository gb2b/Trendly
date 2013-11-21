<?php
	$auth =  array(
	"tw_consumer_key"       => "P4sltM3eLlkfCu7u137JCw",
	"tw_consumer_secret"    => "vfoA4Ew0f0iv4jioGy96q9RzJknisr3Yy8LMHQEw",
	"tw_oauth_token"        => "123935211-meMJIWjVL4iaD6mNchXOhbTEYPv5ag4jcfs9wocK",
	"tw_oauth_token_secret" => "rHm8e8ZRZ6iTl7u0JnPzmTDXDq4N69yTeZoHsQ1wpM",
	"tw_path_file_oauth"    => "auth/twitteroauth/twitteroauth.php",
	"instg_client_id"       => "9110e8c268384cb79901a96e3a16f588",
	"imgur_client_id" 		=> "7bf23d0ba414535",
	"zend_yt_path_file"     => "Zend/Loader.php"
	);

	$cache = array(
	"classe"          => "class.cache.php",
	"tw_cache"        => "twitter.json",
	"yt_cache"        => "youtube.json",
	"instg_cache"     => "instagram.json",
	"gnews_cache"     => "gnews.json",
	"trends_cache"	  => "trends.json",
	"imgur_cache"	  => "imgur.json",
	"time"            => 5, 
	"path_cache"      => "tmp"
	);


	/*if(isset($_GET['trend']) && !empty($_GET['trend'])){
      $query = $_GET['trend'];
   	}*/


   	


	
	function getPicturesImgur($auth,$cache,$q){
		$auth   = array_to_object($auth);
		$cache  = array_to_object($cache);
		require_once $cache->classe;

		$imagesCache = new Cache($cache->path_cache,$cache->time);
		$api = 'https://api.imgur.com/3/gallery/search/?q='.$q;
		$response = getCurlImgur($api,$auth->imgur_client_id);
		
		if($response){
		    $i = 0; 
		    if ($imagesCache->read("_".$cache->imgur_cache)) {
				$images = json_decode($imagesCache->read("_".$cache->imgur_cache));
			}else{
			    foreach(json_decode($response)->data as $item){

			        $title = (isset($item->title))?$item->title:null;
			        $src = $item->link; 
			        $description = (isset($item->description))?$item->description:null; 

			        $images[$i]->title = htmlspecialchars($title);
			        $images[$i]->src   = htmlspecialchars($src);
			        $images[$i]->description  = htmlspecialchars($description);
			     
			        $i++;
			    }
			    $imagesCache->write("_".$cache->imgur_cache, json_encode($images));
			}
		    return $images;
		}
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
 
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);
        
        return $output;
	    }else{
	        return file_get_contents($url);
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



/*
$req_url = 'https://fireeagle.yahooapis.com/oauth/request_token';
$authurl = 'https://api.imgur.com/oauth2/authorize';
$acc_url = 'https://fireeagle.yahooapis.com/oauth/access_token';
$api_url = 'https://fireeagle.yahooapis.com/api/0.1';
$conskey = 'your_consumer_key';
$conssec = 'your_consumer_secret';

session_start();

// En état state=1 la prochaine requete doit inclure le oauth_token.
// Si ce n'est pas le cas, retour à 0
if(!isset($_GET['oauth_token']) && $_SESSION['state']==1) $_SESSION['state'] = 0;
try {
  $oauth = new OAuth($conskey,$conssec,OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_URI);
  $oauth->enableDebug();
  if(!isset($_GET['oauth_token']) && !$_SESSION['state']) {
    $request_token_info = $oauth->getRequestToken($req_url);
    $_SESSION['secret'] = $request_token_info['oauth_token_secret'];
    $_SESSION['state'] = 1;
    header('Location: '.$authurl.'?oauth_token='.$request_token_info['oauth_token']);
    exit;
  } else if($_SESSION['state']==1) {
    $oauth->setToken($_GET['oauth_token'],$_SESSION['secret']);
    $access_token_info = $oauth->getAccessToken($acc_url);
    $_SESSION['state'] = 2;
    $_SESSION['token'] = $access_token_info['oauth_token'];
    $_SESSION['secret'] = $access_token_info['oauth_token_secret'];
  } 
  $oauth->setToken($_SESSION['token'],$_SESSION['secret']);
  $oauth->fetch("$api_url/user.json");
  $json = json_decode($oauth->getLastResponse());
  print_r($json);
} catch(OAuthException $E) {
  print_r($E);
}*/

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ImgUr</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

  </head>

  <body>
    <div class="container">
      <div>
        <h1 style="text-align:center;">ImgUr Test <?php// if(isset($query)) echo ": ".$query; ?></h1>
        <form autocomplete="off">
        	<input type="text" name="trend" id="trend" required />
        	<input type="submit" value="Envoyer"/>
        </form>
        <h2>Voici le résultat de votre recherche : </h2>
		
		<ul>
			<?php/*
			if(isset($query)):
				$i=0;
				foreach($pictures as $p):?>
				<li>
					<h4><?php if($p->title) echo $p->title; else echo "No title";?></h4>
					<p><?php if($p->description) echo $p->description; else echo "No Desc";?></p>
					<?php if($p->src) echo "<img src=".$p->src."alt='image imgur'>"; else echo "<p>Pas de link</p>";?>
				</li>

				<?php 
				$i++;
				endforeach;
			endif;*/
			?>
		</ul>

		<pre id="pretest">
			<?php print_r(getPicturesImgur($auth,$cache,"monster")); ?>
		</pre>
      </div>
    </div>
  </body>
</html>