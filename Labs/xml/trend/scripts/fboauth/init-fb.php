<pre>
<?php 
require 'scripts/class.cache.php';
$cache = new Cache("tmp",5);
function curl_get_file_contents($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: graph.facebook.com'));
    $json = curl_exec($ch);
    curl_close($ch);
    return $json;
}

//print_r($resultat->data);
$content1 = "";
if ($cache->read('facebook')) {
	$content1 = $cache->read('facebook');
}else{
	$resultat = curl_get_file_contents("https://graph.facebook.com/search?q=miley%20cyrus&access_token=CAACEdEose0cBAMCOx2VlvFaBZB9tJju7NwPFoFHPKT9Enu9dA3dIKNJUvY1IqQQPzK4WHB3n6mW1YbozKUnOCM0xSvw4z5MeYcJpUvUSl9tgyVhiszCiWL5RRK0TuG8ZAvbLW48s6PjzGUJDtpN1zMbD0NaR0BhmCSPiwZAXVVjQuf2oRReZCVhbE0r8g24ZD&locale=fr_FR");
	$resultat = (json_decode($resultat));
	print_r($resultat);
	foreach ($resultat->data as $value) {
		$content1 .= $value->message;
	}
	$cache->write('facebook', $content1);
}

echo $content1;
 ?>
</pre>