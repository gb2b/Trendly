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


   $tweets = getSearchTweets($auth, $query, $cache);
   $actus = getTrendGnews($cache, $query);
   $bing = getPicturesBing($cache,$auth,$query);


   $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];


  if(isset($_POST['nbcontent']) && !empty($_POST['nbcontent'])){
    $nbcontent = $_POST['nbcontent'];
    }
    else $nbcontent=1;
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
      <?php if( (isset($query)) || isset($bing) ) : ?>
      <div class="image-stage-content row cible"  data-url="<?php echo $bing[$i]->url; ?>">
         <?php 
              $pictmp = 0;
              for($i=$cptpics;$i<$cptpics+4;$i++) : ?>
         <?php if(isset($bing[$i])):?>
         <figure class="col-md-6 pic">
             <img src="<?php echo $bing[$i]->mediasrc ?>" class="pic-image" title="<?php echo $bing[$i]->title ?>" alt="Picture : <?php echo $bing[$i]->title ?>"/>
           <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Bing</h2>
                     
                     <div class="save">
                        <span><a target="_blank" href="<?php echo $bing[$i]->url ?>" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-mediasrc="<?php echo $bing[$i]->mediasrc ?>" data-text="<?php echo $bing[$i]->title ?>" data-url="<?php echo $bing[$i]->url ?>">LOGO</a>
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
              <?php if(isset($actus[$i])) : ?>
              <article class="col-md-3 col-md-offset-0 cible" style="background-color:<?php echo $actusColor[$j];?>"  data-url="<?php echo $actus[$i]->url; ?>">
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
                            <span><a target="_blank" href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                            <span><a href="#" alt="save">SHARE</a></span>
                            <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $actus[$i]->author ?>" data-text="<?php echo $actus[$i]->mainTitle ?>" data-url="<?php echo $actus[$i]->url ?>">LOGO</a>
                         </div>
                      </div>
                   </div>
                </div>

              </article>
              <?php endif; ?>
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
       
    <!--       
      <div class="video-stage-content row">
        <div class="col-md-6">
          <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>
   
        <div class="col-md-6">
          <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>
 
       </div>
    -->
   




  