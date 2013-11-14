<?php 
$url = "https://gdata.youtube.com/feeds/api/standardfeeds/FR/most_popular?v=2&alt=json";
$result = json_decode(file_get_contents($url));

echo "<pre>";
echo($result->feed->entry[0]->title->0);
echo "</pre>";
 ?>