<?php 
require_once 'scripts/class.cache.php';
$cache = new Cache("tmp",5);
 ?>
<pre>
<?php 
if ($cache->read('twitter')) {
	$content1 = $cache->read('twitter');
}else{
	require_once("twitteroauth.php");
	$consumer_key       ='P4sltM3eLlkfCu7u137JCw'; //consumer key
	$consumer_secret    ='vfoA4Ew0f0iv4jioGy96q9RzJknisr3Yy8LMHQEw'; // consumer secret
	$oauth_token        = '123935211-meMJIWjVL4iaD6mNchXOhbTEYPv5ag4jcfs9wocK'; //oAuth Token
	$oauth_token_secret = 'rHm8e8ZRZ6iTl7u0JnPzmTDXDq4N69yTeZoHsQ1wpM'; //oAuth Token Secret
	 
	//creation de l'objet
	
	$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	$connection->host = "https://api.twitter.com/1.1/";
	$content = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=taubira&lang=fr&result_type=popular&count=4");//attention à bien définir 	$query (la requête) avant
	//$content1 ="";
/*	if (!empty($content)) {
		foreach ($content[0]->trends as $trend) {
			$content1 .= $trend->name."</br></br>";
		}
	}
	$cache->write('twitter', $content1);*/
	$i = 0;
	foreach ($content->statuses as $tweet) {
		$tweets[$i]["text"] = $tweet->text;
		$tweets[$i]["user"] = $tweet->user->screen_name;
		$i++;
	}
}
file_put_contents("../tweets.json", json_encode($tweets));
print_r(json_decode(file_get_contents("../tweets.json")));
 ?>
</pre>
