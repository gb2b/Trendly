<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CURL</title>
</head>
<body>
	<form action="img.php" method="POST">
		<input type="text" name="url" id="">
	</form>
</body>
</html>
<?php //phpinfo() ?>
<?php 
if (isset($_POST["url"]) && !empty($_POST["url"])) {
	$except = array("http://referentiel.nouvelobs.com/file/3935010.jpg");
	$infos = getImageActu($_POST["url"], $except);
	//echo $infos["url"]." ".$infos["size"][0];
}


function getImageActu($url, $except = array())
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$html = curl_exec($ch);
	curl_close($ch);
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$imageTags = $doc->getElementsByTagName('img');
	$maxSize = 0;
	foreach($imageTags as $tag) {
		if (preg_match("#^\/.*#", $tag->getAttribute('src'))) {
            $img = "http://".getNomDeDomaine($url).$tag->getAttribute('src');
        }else{
            $img = $tag->getAttribute('src');
        }
        echo $img."</br>";
        if (!in_array($img, $except)) {
        	$size = getimagesize($img);
	    	if ($size[1]>$maxSize) {
				$imgUrl  = $img;
				$maxSize = $size[1];
	    	}
        }
	}
	return array("url" => $imgUrl, "size" => $maxSize);
}

function getNomDeDomaine($url) {
    
    $hostname = parse_url($url, PHP_URL_HOST);
    $hostParts = explode('.', $hostname);
    $numberParts = sizeof($hostParts);
    $domain='';
    
    // Domaine sans tld (ex: http://server/page.php)
    if(1 === $numberParts) {
        $domain = current($hostParts);
    }
    // Domaine avec tld (ex: http://fr.php.net/parse-url)
    elseif($numberParts>=2) {
        $hostParts = array_reverse($hostParts);
        $domain = $hostParts[1] .'.'. $hostParts[0];
    }
    return $domain;
}

 ?>