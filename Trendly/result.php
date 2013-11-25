<?php 
   include("functions.php");

   if(isset($_GET['trend']) && !empty($_GET['trend'])){
      $query = $_GET['trend'];
   }
   $tweets = getSearchTweets($auth, $query, $cache);
   $actus = getTrendGnews($cache, $query);
   $bing = getPicturesBing($cache,$auth,$query);
  /* echo "<pre>";
   print_r($tweets);
   echo "</pre>";*/
   $cptactus = 0;
   $cpttweets = 0;
   $cptpics = 1;
   $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];
    $nbcontent = 1;

?>


<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - <?php if(isset($query)) echo $query; ?></title>
   <meta content="" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">
   <link href="css/result.css" rel="stylesheet">
   <link href="css/css/bootstrap.css" rel="stylesheet">

   <link rel="icon" type="image/png" href="css/asset/favicon.png" />

</head>

<body>
   <section id="container" class="container">
     <form autocomplete="off">
         <fieldset>
            <input id="trend" name="trend" placeholder="Search a trend" required=
            "" type="text" value="<?php if(isset($query)) echo $query; ?>"> <label for="trend"></label>
         </fieldset>

         <div>
            <input type="submit" value=" ">
         </div>
      </form>
      

    <div id="content">
      <div id="notif">Le trend a bien été enregistré ! <a href='dashboard.php'>Voir</a></div>
      <!-- TWEETS -->
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($tweets) ) : ?>
      <div class="top-content row">
         <div class="block">
            <article>
              <div class="container">
                <div class="carousel">
                  <ul>
                    <?php $twtmp=0; ?>
                    <?php for($i=$cpttweets;$i<$cpttweets+5;$i++):?>
                    <?php if(isset($tweets[$i])) :?>
                    <li class="cible" data-url="<?php echo $tweets[$i]->urlTweet; ?>">
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
                                <span><a target="_blank" href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                                <span><a href="#" alt="save">SHARE</a></span>
                                <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $tweets[$i]->user ?>" data-text="<?php echo $tweets[$i]->text ?>" data-url="<?php echo $tweets[$i]->urlTweet ?>">LOGO</a>
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
      <?php endif; ?>

      <!-- ARTICLES -->
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($actus) ) : ?>
      <div class="second-stage-content row">
          <?php 
          $actmp=0;
          for($i=$cptactus;$i<($cptactus+2);$i++) : ?>
          <?php if(isset($actus[$i])):?>
          <article class="col-md-6 cible" style="border-bottom: 5px solid #9b59b6;" data-url="<?php echo $actus[$i]->url; ?>">
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
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($bing) ) : ?>
      <div class="image-stage-content row">
         <?php 
              $pictmp = 1;
              for($i=$cptpics;$i<($cptpics+4);$i++) : ?>
         <?php if(isset($bing[$i])):?>
         <figure class="col-md-6 pic cible" data-url="<?php echo $bing[$i]->url; ?>">
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
       
       <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($actus) || isset($tweets)) : ?>
       <div class="regular-stage-content row">
          <?php 
          
          if($cptactus != 0){
            $j=0;
            for($i=$cptactus;$i<($cptactus+4);$i++) :?>
             <article class="col-md-3 col-md-offset-0 cible" style="background-color:<?php echo $actusColor[$j];?>" data-url="<?php echo $actus[$i]->url; ?>">
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
        <?php 
            $actmp++;
            $j++;
            endfor;
            $cptactus += 4;
          }
          if($cpttweets != 0 && $cptactus ==0){
            $j=0;
            for($i=$cpttweets;$i<($cpttweets+4);$i++) :?>
             <article class="col-md-3 col-md-offset-0 cible" style="background-color:<?php echo $actusColor[$j];?>" data-url="<?php echo $tweets[$i]->urlTweet; ?>">
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
                            <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $tweets[$i]->user ?>" data-text="<?php echo $tweets[$i]->text ?>" data-url="<?php echo $tweets[$i]->urlTweet ?>">LOGO</a>
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
      <?php endif; ?>
       
<!--        
     <div class="video-stage-content row">
  <div class="col-md-6">
     <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

  <div class="col-md-6">
     <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

      </div>
   -->

   </div>

  
         

      
      

      
      
  </section>
  <script src="js/jquery.js"></script>
 <script src="js/main.js"></script>
  <script src="js/local_storage.js"></script>
  <script src="js/my_local_storage.js"></script>

  <script type="text/javascript">
        // on initialise ajaxready à true au premier chargement de la fonction
        $(window).data('ajaxready', true);

        var nbcontent = <?php echo $nbcontent;?>;
        var trend = <?php echo "\"".$query."\"";?>;
        var nbactus = <?php echo $cptactus;?>;
        var nbtweets = <?php echo $cpttweets;?>;
        var nbpics = <?php echo $cptpics;?>;

        $("#content").append('<div id="loadergif"><img src="css/img/ajax-loader.gif" alt="loader ajax"></div>');
       
        var deviceAgent = navigator.userAgent.toLowerCase();
        var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);

        var totaltweets = <?php echo count($tweets) ?>;
        var totalactus = <?php echo count($actus) ?>;
        var totalpics = <?php echo count($bing) ?>;


        $(window).scroll(function()
        {
          // On teste si ajaxready vaut false, auquel cas on stoppe la fonction
          if ($(window).data('ajaxready') == false) return;
          
          if
          (
            ($(window).scrollTop() + window.innerHeight == $(document).height())
             || 
             (agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height())
             
          )
          {
            if((nbtweets < totaltweets && nbtweets != 0) || (nbactus < totalactus && nbactus != 0) || (nbpics < totalpics && nbpics != 0) ){
                  // lorsqu'on commence un traitement, on met ajaxready à false
              $(window).data('ajaxready', false);
         
              $('#loadergif').fadeIn(400);
              nbcontent++;
              $.post(
                  "test.php",
                  "totaltweets="+totaltweets+"&totalpics="+totalpics+"&trend="+trend+"&nbactus="+nbactus+"&nbtweets="+nbtweets+"&nbpics="+nbpics,
                  function(data, textStatus) {
                      if(textStatus == "success"){
                        $('#loadergif').before(data);
                        $('.hidden').fadeIn(400);
                        $('#loadergif').fadeOut(400);
                        $(window).data('ajaxready', true);
                        /*oncible();
                        onLocalStorage();*/
                      }

                  }

              );
              nbactus += <?php echo $cptactus;?>;
              nbpics += 4;
              if(nbactus > totalactus || nbactus ==0) nbtweets += 3;
             
            } else {
              alert("Il n'y a plus de contenu à afficher");
            }
          }
        });


  </script>
   

</body>


</html>