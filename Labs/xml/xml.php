 <?php 
$url = "http://news.google.fr/news?pz=1&cf=all&ned=fr&hl=fr&output=rss";

try{
    if(!@$fluxrss=simplexml_load_file($url)){
        throw new Exception('Flux introuvable');
    }
    if(empty($fluxrss->channel->title) || empty($fluxrss->channel->description) || empty($fluxrss->channel->item->title))
        throw new Exception('Flux invalide');
        $i = 0;
        $caractereRemove = array(".", "!", ";", ",","faire","font","avec","supprimer");
        $except = array("http://referentiel.nouvelobs.com/file/3935010.jpg");
    foreach ($fluxrss->channel->item as $item) {
        $b                         = explode("<font size=\"-1\">", $item->description);
        $b[]                       = utf8_decode(utf8_encode(strip_tags($item->title)));
        $title                     = bestWord($b, $caractereRemove);
        $infos[$i]["title"]        = $title["mot"];
        $infos[$i]["nbOccurences"] = $title["nbOccurences"];
        $b                         = explode("<b>", $item->description);
        $nbArticles                = end($b);
        $infos[$i]["nbArticles"]   = intval(utf8_decode($nbArticles));
        $b                         = explode("<font size=\"-1\">", $item->description);
        $description               = $b[2];
        $infos[$i]["description"]  = strip_tags($description);
        $infos[$i]["date"]         = strtotime($item->pubDate);
        preg_match("/url=.*/", $item->link, $url1, PREG_OFFSET_CAPTURE);
        $infos[$i]["url"] = substr($url1[0][0], 4);
        $i++;
    }
    file_put_contents('gnews.json', json_encode($infos));
    $infos2 = json_decode(file_get_contents('gnews.json'));
    echo "<pre>";
    print_r($infos2);
    echo "</pre>";
    
 
}catch(Exception $e){
    echo $e->getMessage();
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

?>