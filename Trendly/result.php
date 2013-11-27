<?php 
   include("functions.php");

   if(isset($_GET['trend']) && !empty($_GET['trend'])){
      $query = $_GET['trend'];
   }
  $tweets = getSearchTweets($auth, $query, $cache);
  $actus = getTrendGnews($cache, $query);
  $videos = getVideoYoutube($auth, $cache,$query);
  $inst = getPopularInstgImage($auth,$cache,$query);

  $cptactus = 0;
  $cpttweets = 0;
  $cptpics = 0;
  $cptvid = 0;

  $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];

echo "<pre>";
print_r(getVideoYoutube($auth, $cache,$query));
echo "</pre>";
?>


<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - <?php if(isset($query)) echo $query; ?></title>
   <meta content="" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">

   <link href="css/style.css" rel="stylesheet">
   <link href="css/bootstrap/bootstrap.css" rel="stylesheet">


   <link rel="icon" type="image/png" href="css/asset/favicon.png" />



</head>

<body>

<!-- START OF THE HEADER -->
	<header>
		<!-- START OF THE NAV BAR -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				      <span class="sr-only">Toggle navigation</span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				</button>
		    
				<!-- LOGO -->
				<div class="navbar-brand logo">
			    	<img src="css/asset/logo-b.png" alt="Logo - Trendly">
			    	<span><a href="search.php">Trendly - Les Trends en un clic</a></span>
			    </div>
			    <!-- END LOGO -->
			    
			</div><!-- /.navbar-header -->
		
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <ul class="nav navbar-nav">
			    
			    </ul>
			    
		    
		    <!-- INFO BUTTON -->
		    <ul class="nav navbar-nav navbar-right">
		      <li class="active"><a href="result.php">Page Trend</a></li>
		      <li><a href="search.php">Retour au module</a></li>
		      <li><a href="dashboard.phh">Voir Dashboard</a></li>
		      
		      <li>
		      	<a class="info-icon" href="#">
		      		<i class="glyphicon glyphicon-info-sign" style="color: #fff;"></i>
		      	</a>
		      </li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav><!-- /.navbar -->
		
		<!-- END OF THE NAV BAR -->
	</header>
	<!-- END OF THE HEADER -->


   <section id="container" class="container">
     <form id="topsearch" autocomplete="off">

         <fieldset>
            <input id="trend" name="trend" placeholder="Search a trend" required=
            "" type="text" value="<?php if(isset($query)) echo $query; ?>"> <label for="trend"></label>

            <div>
            <input type="submit" value=" ">
         </div>
         </fieldset>

         
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

                        <div class="highlight-caption-top bottom-to-top">
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

                        <div class="text text-block">
                          <h1><?php echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>";?></h1>
                          <p>
                             <?php 
                                $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                                echo $twText; 
                             ?>
                          </p>
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
      <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"]))  || isset($inst)) : ?>
      <div class="image-stage-content row">
         <?php 
              $pictmp = 0;
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
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-mediasrc="<?php echo $inst[$i]->src ?>" data-text="<?php echo $inst[$i]->title ?>" data-url="<?php echo $inst[$i]->src ?>">LOGO</a>
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
       
    
    
     <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"]))  || isset($videos)) : ?>
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


   </div>

  
         

      
      

      
      
  </section>
  <script src="js/jquery.js"></script>
 <script src="js/main.js"></script>
  <script src="js/local_storage.js"></script>
  <script src="js/my_local_storage.js"></script>

  <script type="text/javascript">
        // on initialise ajaxready à true au premier chargement de la fonction
        $(window).data('ajaxready', true);

        
        var trend = <?php echo "\"".$query."\"";?>;
        var nbactus = <?php echo $cptactus;?>;
        var nbtweets = <?php echo $cpttweets;?>;
        var nbpics = <?php echo $cptpics;?>;
        var nbvids = <?php echo $cptvid;?>;

        $("#content").append('<div id="loadergif"><img src="css/img/ajax-loader.gif" alt="loader ajax"></div>');
        $('#content').append('<div id="nocontent"><img src="css/asset/nocontent-logo.png" alt="No Content"/><p>Il n\'y a plus de contenu à afficher !</p></div>');
        var deviceAgent = navigator.userAgent.toLowerCase();
        var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);

        var totaltweets = <?php echo count($tweets) ?>;
        var totalactus = <?php echo count($actus) ?>;
        var totalpics = <?php echo count($inst) ?>;
        var totalvids = <?php echo count($videos) ?>;


        $(window).scroll(function()
        {
          // On teste si ajaxready vaut false, auquel cas on stoppe la fonction
          if ($(window).data('ajaxready') == false) return;
          
          if
          (
            ($(window).scrollTop() + window.innerHeight + 150 > $(document).height())
             || 
             (agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height())
             
          )
          {
            if((nbtweets < totaltweets && nbtweets != 0) || (nbactus < totalactus && nbactus != 0) || (nbpics < totalpics && nbpics != 0) || (nbvids < totalvids && nbvids != 0) ){
                  // lorsqu'on commence un traitement, on met ajaxready à false
              $(window).data('ajaxready', false);
         
              $('#loadergif').fadeIn(400);
     
              $.post(
                  "scroll-content.php",
                  "&trend="+trend+"&nbactus="+nbactus+"&nbtweets="+nbtweets+"&nbpics="+nbpics+"&nbvids="+nbvids,
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
              nbvids += 2;
              if(nbactus > totalactus || nbactus ==0) nbtweets += 3;
             
            } else {
              $('#nocontent').fadeIn(400);
            }
          }
        });


  </script>
   

</body>


</html>