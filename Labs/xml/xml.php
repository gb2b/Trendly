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
        $urlImg           = getImageActu(substr($url1[0][0], 4), $except);
        $infos[$i]["img"] = $urlImg["url"];
    	$i++;
    }
    file_put_contents('gnews.json', json_encode($infos));
    $infos2 = json_decode(file_get_contents('gnews.json'));
    // echo "<pre>";
    // print_r($infos2);
    // echo "</pre>";
    foreach ($infos2 as $info) {
        echo "<h1>".$info->title."</h1>";
        echo "<a href='".$info->url."'>".$info->url."</a>.</br>";
        echo "<img src='".$info->img."'></br></br>";
        echo $info->img."</br>";
    }
    
 
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
        //if (preg_match("\/.*", $tag->getAttribute('src'))) {
        //    $img = getNomDeDomaine($url).$tag->getAttribute('src');
        //}else{
            $img = $tag->getAttribute('src');
        //}
        if (!in_array($img, $except)) {
            $size = getimagesize($img);
            if ($size[0]>$maxSize) {
                $imgUrl  = $img;
                $maxSize = $size[0];
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