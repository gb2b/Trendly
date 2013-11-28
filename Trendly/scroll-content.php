<?php  
   include("functions.php");

   if(isset($_POST['trend']) && !empty($_POST['trend'])){
      $query = $_POST['trend'];
   }
   if(isset($_POST['nbactus']) && !empty($_POST['nbactus'])){
      $cptactus = $_POST['nbactus'];
   }
   if(isset($_POST['nbtweets']) && !empty($_POST['nbtweets'])){
      $cpttweets = $_POST['nbtweets'];
   }
  if(isset($_POST['nbpics']) && !empty($_POST['nbpics'])){
      $cptpics = $_POST['nbpics'];
     }

  if(isset($_POST['nbvids']) && !empty($_POST['nbvids'])){
      $cptvid = $_POST['nbvids'];
    }


   $tweets = getSearchTweets($auth, $query, $cache);
   $actus = getTrendGnews($cache, $query);
/*   $bing = getPicturesBing($cache,$auth,$query);*/
   $inst = getPopularInstgImage($auth,$cache,$query);
    $videos = getVideoYoutube($auth, $cache,$query);


   $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];



?>

 
      

      <!-- ARTICLES -->
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($actus) ) : ?>
      <div class="second-stage-content row">
          <?php 
          $actmp=0;
          for($i=$cptactus;$i<($cptactus+2);$i++) : ?>
          <?php if(isset($actus[$i])):?>
          <article class="col-md-6 cible" style="border-bottom: 5px solid #9b59b6;"  data-url="<?php echo $actus[$i]->url; ?>">
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
                        <span><a target="_blank" href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $actus[$i]->author ?>" data-text="<?php echo $actus[$i]->mainTitle ?>" data-url="<?php echo $actus[$i]->url ?>">LOGO</a>
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
      <?php endif; ?>

      
      <!-- PICTURES -->
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($bing) || isset($inst)) : ?>
      <div class="image-stage-content row">
         <?php 
              $pictmp = 1;
              for($i=$cptpics;$i<($cptpics+4);$i++) : ?>
         <?php if(isset($inst[$i])):?>
         <figure class="col-md-6 pic cible" data-url="<?php echo $inst[$i]->src; ?>">
             <img src="<?php echo $inst[$i]->src ?>" class="pic-image" title="<?php echo $inst[$i]->title ?>" alt="Picture : <?php echo $bing[$i]->title ?>"/>
           <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Bing</h2>
                     
                     <div class="save">
                        <span><a target="_blank" href="<?php echo $inst[$i]->src ?>" alt="save">GO</a></span>
                        <span><a href="javascript:void(0);" alt="save">SHARE</a></span>
                        <a href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-mediasrc="<?php echo $inst[$i]->src ?>" data-text="<?php echo $inst[$i]->title ?>" data-url="<?php echo $inst[$i]->src ?>">LOGO</a>
                     </div>
                  </div>
            
         </figure>
         <?php 
              $pictmp++;
              endif; 
          ?>
         <?php 
              endfor;
              $cptpics += $pictmp; 
          ?>
         
       </div>
       <?php endif; ?>
       

       <!-- OTHERS ACTUS OR TWEETS -->
       <?php if( (isset($query)) || isset($actus) || isset($tweets)) : ?>
       <div class="regular-stage-content row">
          <?php 
          
          if($cptactus != 0 && $cptactus <= count($actus)){
            $j=0;
            for($i=$cptactus;$i<($cptactus+4);$i++) :?>
            
              <article class="col-md-3 col-md-offset-0 cible" style="background-color:<?php echo $actusColor[$j];?>"  data-url="<?php echo $actus[$i]->url; ?>">
                <div class="block">
                   <div class="text text-block">
                    <?php if(isset($actus[$i])) : ?>
                      <h1><?php echo $actus[$i]->author ?></h1>

                      <p><?php echo $actus[$i]->mainTitle ?></p>
                      <?php else : ?>
                      <h1><?php echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>";?></h1>

                      <p style="font-size: 20px">
                           <?php 
                              $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                              echo $twText; 
                           ?>
                      </p>
                    <?php endif;?>
                   </div>
                  <?php if(isset($actus[$i])) : ?>
                   <div class="highlight-caption top-to-bottom">
                      <div class="highlight">
                         <div class="icon"><img alt="articles" src=
                         "css/asset/articles-icon.png"></div>
                         
                         <div class="save">
                            <span><a target="_blank" href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                            <span><a href="#" alt="save">SHARE</a></span>
                            <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $actus[$i]->author ?>" data-text="<?php echo $actus[$i]->mainTitle ?>" data-url="<?php echo $actus[$i]->url ?>">LOGO</a>
                         </div>
                      </div>
                   </div>
                   <?php endif;?>
                </div>

              </article>
              
        <?php 
            $j++;
            endfor;
            $cptactus += 4;
          }
          else if($cpttweets != 0 && ($cptactus == 0 || $cptactus > count($actus)) && $cpttweets <= count($tweets)){
            $j=0;
            for($i=$cpttweets+1;$i<($cpttweets+5);$i++) :?>
              <?php if(isset($tweets[$i])) : ?>
              <article class="col-md-3 col-md-offset-0 cible" style="background-color:<?php echo $actusColor[$j];?>"  data-url="<?php echo $tweets[$i]->urlTweet; ?>">
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
                            <span><a target="_blank" href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                            <span><a href="#" alt="save">SHARE</a></span>
                            <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $tweets[$i]->user ?>" data-text="<?php echo $tweets[$i]->text ?>" data-url="<?php echo $tweets[$i]->urlTweet ?>">>LOGO</a>
                         </div>
                      </div>
                   </div>
                </div>

              </article>
              <?php endif; ?>
            <?php 
              $j++;
            endfor;
            $cpttweets += 4;
          }
        ?>
      </div>
      <?php endif; ?>
       

      <?php if( (isset($query))  || isset($videos)) : ?>
       <div class="video-stage-content row">
         <?php 
              $vidtmp = 0;
              for($i=$cptvid;$i<($cptvid+2);$i++) : ?>
         <?php if(isset($videos[$i])):?>
            
               
        <article class="videocontainer col-md-6">
        
        <div class="block">
          <iframe width="100%" height="315" src="//www.youtube.com/embed/<?php echo $videos[$i]->id; ?>" frameborder="0" allowfullscreen></iframe>
       
        <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Youtube</h2>
                     
                     <div class="save">
                      <span><a target"_blank" href="<?php echo $videos[$i]->url; ?>">GO</a></span>
                      <span><a href="#">SHARE</a></span>
                      <a href="#" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $videos[$i]->title ?>" data-videoid="<?php echo $videos[$i]->id ?>" data-url="<?php echo $videos[$i]->url ?>">LOGO</a>
                     </div>
                  </div>
               </div>
        </div>
        </article>      
         <?php 
              $vidtmp++;
              endif; 
          ?>
         <?php 
              endfor;
              $cptvid += $vidtmp; 
          ?>
         
       </div>
       <?php endif; ?>




  