<?php 
require_once("Zend/Loader.php");

Zend_Loader::loadClass("Zend_Gdata_YouTube");
$yt = new Zend_Gdata_Youtube();
if (isset($_GET["q"]) && !empty($_GET["q"])) {
	$videoFeed = $yt->getVideoFeed("http://gdata.youtube.com/feeds/api/videos?q=".urlencode($_GET["q"])."&orderby=published&max-results=10&v=2&region=FR");
}else{
	$videoFeed = $yt->getVideoFeed("http://gdata.youtube.com/feeds/api/standardfeeds/FR/most_popular?min-results=10&time=today&v=2");
}
$i = 0;
foreach ($videoFeed as $video): $thumbs = $video->getVideoThumbnails();
	$v[$i] = array(
		"title"       => $video->getVideoTitle(),
		"url"         => $video->getVideoWatchPageUrl(),
		"description" => $video->getVideoDescription(),
		"thumbnail"   => $thumbs[0]["url"]
		);
	$i++;
endforeach;

file_put_contents('youtube.json', json_encode($v));
$infos2 = json_decode(file_get_contents('youtube.json'));
echo "<pre>";
print_r($infos2);
echo "</pre>";
 ?>