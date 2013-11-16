<?php 
$instagramClientID = '9110e8c268384cb79901a96e3a16f588';

$api = 'https://api.instagram.com/v1/media/popular?client_id='.$instagramClientID; //api request (edit this to reflect tags)
$response = get_curl($api); //change request path to pull different photos
$images = array();
if($response){
    $i = 0; 
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
}

for ($i=0; $i < count($images); $i++) { 
    echo "<img src='".$images[$i]->src."'></br>";
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