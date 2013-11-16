<?php 
$instagramClientID = '9110e8c268384cb79901a96e3a16f588';

$api = 'https://api.instagram.com/v1/media/popular?client_id='.$instagramClientID; //api request (edit this to reflect tags)
$cache = './cache.json';

// if(file_exists($cache) && filemtime($cache) > time() - 60*60){
//     // If a cache file exists, and it is newer than 1 hour, use it
//     $images = json_decode(file_get_contents($cache),true); //Decode as an json array
// }
// else{
    // Make an API request and create the cache file
    // For example, gets the 32 most popular images on Instagram
    $response = get_curl($api); //change request path to pull different photos

    $images = array();

    if($response){
        // Decode the response and build an array
        foreach(json_decode($response)->data as $item){

            $title = (isset($item->caption))?mb_substr($item->caption->text,0,70,"utf8"):null;

            $src = $item->images->standard_resolution->url; //Caches standard res img path to variable $src

            //Location coords seemed empty in the results but you would need to check them as mostly be undefined
            $lat = (isset($item->data->location->latitude))?$item->data->location->latitude:null; // Caches latitude as $lat
            $lon = (isset($item->data->location->longtitude))?$item->data->location->longtitude:null; // Caches longitude as $lon

            $images[] = array(
            "title" => htmlspecialchars($title),
            "src" => htmlspecialchars($src),
            "lat" => htmlspecialchars($lat),
            "lon" => htmlspecialchars($lon) // Consolidates variables to an array
            );
        }
        file_put_contents($cache,json_encode($images)); //Save as json

    }
// }

for ($i=0; $i < count($images); $i++) { 
    echo "<img src='".$images[$i]["src"]."'></br>";
}


//Debug out


//Added curl for faster response
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