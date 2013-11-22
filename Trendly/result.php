<?php 
   include("functions.php");

   if(isset($_GET['trend']) && !empty($_GET['trend'])){
      $query = $_GET['trend'];
   }
   $tweets = getSearchTweets($auth, $query, $cache);
   //$videos = getVideoYoutube($auth, $cache, $query);
   $actus = getTrendGnews($cache, $query);
   $pictures = getPicturesImgur($auth,$cache,$query);
   $bing = getPicturesBing($cache,$auth,$query);
 /* echo "<pre>";
   print_r($bing);
   echo "</pre>";*/
   $cptactus = 0;
   $cpttweets = 0;
   $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];
   

?>


<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - Search : <?php if(isset($query)) echo $query; ?></title>
   <meta content="" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">
   <link href="css/result.css" rel="stylesheet">
   <link href="css/css/bootstrap.css" rel="stylesheet">

   <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
</head>

<body>
   <section class="container">
     <form autocomplete="off">
         <fieldset>
            <input id="trend" name="trend" placeholder="Search a trend" required=
            "" type="text" value="<?php if(isset($query)) echo $query; ?>"> <label for="trend"></label>
         </fieldset>

         <div>
            <input type="submit" value=" ">
         </div>
      </form>

      <!-- TWEETS -->
     <div class="top-content row">
         <div class="block">
            <article>
              <div class="container">
                <div class="carousel">
                  <ul>
                    <?php $twtmp=0; ?>
                    <?php for($i=$cpttweets;$i<$cpttweets+5;$i++):?>
                    <?php if(isset($tweets[$i])) :?>
                    <li>
                       <div class="text text-block">
                          <h1><?php echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>";?></h1>
                          <p>
                             <?php 
                                $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                                echo $twText; 
                             ?>
                          </p>
                        </div>
                        <div class="highlight-caption bottom-to-top">
                          <div class="highlight">
                             <div class="icon"><img alt="twitter" src=
                             "css/asset/twitter-ico-b.png"></div>
                             <h2>Twitter</h2>
                             <div class="save">
                                <span><a href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                                <span><a href="#" alt="save">SHARE</a></span>
                                <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>">LOGO</a>
                             </div>
                          </div>
                       </div>
                    </li>
                    <?php $twtmp++; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php $cpttweets += 5; ?>

                  </ul>  
                </div>
              </div> 
              <div class="navPrev"></div>
              <div class="navNext"></div>
            </article>
         </div>
      </div>
  

      <!-- ARTICLES -->
      <div class="second-stage-content row">
          <?php 
          $actmp=0;
          for($i=$cptactus;$i<($cptactus+2);$i++) : ?>
          <?php if(isset($actus[$i])):?>
          <article class="col-md-6" style="border-bottom: 5px solid #9b59b6;">
            <div class="block">
               <div class="text text-block">
                  <h1><?php echo $actus[$i]->author; ?></h1>

                  <p><?php echo $actus[$i]->mainTitle; ?></p>
               </div>

               <div class="highlight-caption bottom-to-top">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon-black.png"></div>
                     
                     <div class="save">
                        <span><a href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
          </article>

          <?php 
          $actmp++;
          endif; ?>
          <?php endfor;
          $cptactus+=$actmp; ?>
      </div>


      
      <!-- PICTURES -->
      <div class="image-stage-content row">
         <?php for($i=1;$i<5;$i++) : ?>
         <?php if(isset($bing[$i])):?>
         <figure class="col-md-6 pic">
             <img src="<?php echo $bing[$i]->mediasrc ?>" class="pic-image" title="<?php echo $bing[$i]->title ?>" alt="Picture : <?php echo $bing[$i]->title ?>"/>
           <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Bing</h2>
                     
                     <div class="save">
                        <span><a href="<?php echo $bing[$i]->url ?>" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>">LOGO</a>
                     </div>
                  </div>
            
         </figure>
         <?php endif; ?>
         <?php endfor; ?>
         
       </div>
       
       
       <div class="regular-stage-content row">
          <?php 
          
          if($cptactus != 0){
            $actmp = 0;
            $j=0;
            for($i=$cptactus;$i<($cptactus+4);$i++) :?>
             <article class="col-md-3 col-md-offset-0" style="background-color:<?php echo $actusColor[$j];?>">
                <div class="block">
                   <div class="text text-block">
                      <h1><?php echo $actus[$i]->author ?></h1>

                      <p><?php echo $actus[$i]->mainTitle ?></p>
                   </div>

                   <div class="highlight-caption top-to-bottom">
                      <div class="highlight">
                         <div class="icon"><img alt="articles" src=
                         "css/asset/articles-icon.png"></div>
                         
                         <div class="save">
                            <span><a href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                            <span><a href="#" alt="save">SHARE</a></span>
                            <a href="#" alt="save">LOGO</a>
                         </div>
                      </div>
                   </div>
                </div>

             </article>
        <?php 
            $actmp++;
            $j++;
            endfor;
            $cptactus += $acttmp;
          }
          if($cpttweets != 0 && $cptactus ==0){
            $twtmp = 0;
            $j=0;
            for($i=$cpttweets;$i<($cpttweets+4);$i++) :?>
             <article class="col-md-3 col-md-offset-0" style="background-color:<?php echo $actusColor[$j];?>">
                <div class="block">
                   <div class="text text-block">
                      <h1><?php echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>";?></h1>

                      <p style="font-size: 20px">
                           <?php 
                              $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                              echo $twText; 
                           ?>
                      </p>
                   </div>

                   <div class="highlight-caption top-to-bottom">
                      <div class="highlight">
                         <div class="icon"><img alt="twitter" src=
                           "css/asset/twitter-ico.png"></div>
                         <div class="save">
                            <span><a href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                            <span><a href="#" alt="save">SHARE</a></span>
                            <a href="#" alt="save">LOGO</a>
                         </div>
                      </div>
                   </div>
                </div>

             </article>
            <?php 
              $twtmp++;
              $j++;
            endfor;
            $cpttweets += 4;
          }
        ?>
      </div>

       
       
     <!--  <div class="video-stage-content row">
         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

      </div>-->
         
   
  
         

      
      

      
      
</section>
</body>


<script>
var speed = 600,
    currSel = 0,
    itemCount = $('.carousel ul li')
                    .length,
    itemWidth = $('.carousel ul li')
                  .css('width')
                    .split('px')[0] ;

$('.navNext').on('click',function(){
  currSel =(currSel+1)%itemCount;
  console.log((currSel*itemWidth));
  $('.carousel ul')
    .animate(
      {marginLeft:
       '-'
       +(currSel*itemWidth)
       +'px'}
      ,speed);
});
$('.navPrev').on('click',function(){
  currSel =((currSel==0)
                ?itemCount
                :(currSel))-1 ;
  console.log((currSel*itemWidth));
  $('.carousel ul')
    .animate(
      {marginLeft:
       '-'
       +(currSel*itemWidth)
       +'px'}
      ,speed);
});

</script>


</html>