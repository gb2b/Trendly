<?php 
  //Appel du fichier functions.php (qui permet d'accéder aux API)
  include("functions.php");

  if(isset($_GET['trend']) && !empty($_GET['trend'])){
    $query = $_GET['trend'];
  }

  // Appel des fonctions pour chaque API : Tweet / Youtube / Instragram et Google News
  $tweets = getSearchTweets($auth, $query, $cache);
  $actus = getTrendGnews($cache, $query);
  $videos = getVideoYoutube($auth, $cache,$query);
  $inst = getPopularInstgImage($auth,$cache,$query);

  // Initialisation de variables pour compter les contenus courants
  $cptactus = 0;
  $cpttweets = 0;
  $cptpics = 0;
  $cptvid = 0;

  // Initialisation d'un tableau pour les couleurs sur les actus
  $actusColor = ["#d35400","#f39c12","#1abc9c","#34495e"];

?>


<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - <?php if(isset($query)) echo $query; ?></title>
   <meta content="Toutes les dernières actualités sur le trend <?php if(isset($query)) echo $query; ?>. Retrouvez des articles, des vidéos et des tweets, partagez les ou sauvegardez les sur votre dashboard !" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">

   <link href="css/style.css" rel="stylesheet">
   <link href="css/bootstrap/bootstrap.css" rel="stylesheet">

   <link rel="icon" type="image/png" href="css/asset/favicon.png" />

</head>

<body>

<!-- START OF THE HEADER -->
	<header class="header-top">
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
			    	<a href="search.php"><img src="css/asset/logo-b.png" alt="Logo - Trendly">
			    	<span>Trendly</span></a>
			    </div>
			    <!-- END LOGO -->
		    </div><!-- /.navbar-header -->

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    			<ul class="nav navbar-nav"></ul>
    		    <!-- INFO BUTTON -->
          <?php include("header.php") ?>
	        </div><!-- /.navbar-collapse -->
		</nav><!-- /.navbar -->
		<!-- END OF THE NAV BAR -->
	</header>
	<!-- END OF THE HEADER -->

  <!-- Div pour les notifications de sauvegarde de contenus  -->
  <ul id="listnotif"></ul>

    <section id="container" class="container">
        <!-- Formulaire -->
        <section class="bottom-search row">
    		<div>
    	        <form action="result.php" autocomplete="off" id="search">
    	          <fieldset class="col-md-12">
    	            <input id="trend" name="trend" placeholder="Search a trend" required="" type="text" value="<?php if(isset($query)) echo $query; ?>"> <label for="trend"></label>
                  <input type="submit" value="">
                </fieldset><!-- /.fieldset -->
              </form>
            </div>
    	</section><!-- /.formulaire -->

        <!-- Div qui contiendra tout les contenus (articles/videos/images/tweets) -->
        <div id="content">
          
        <!-- TOP TWEETS -->
        <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($tweets) ) : ?>
        <div class="top-content row">
            <div class="block">
                <article>
                    <!-- Carousel pour les tweets -->
                    <div class="container">
                    <div class="carousel">
                      <ul>
                        <?php //Affiche 5 tweets ?>
                        <?php $twtmp=0; ?>
                        <?php for($i=$cpttweets;$i<$cpttweets+5;$i++):?>
                        <?php if(isset($tweets[$i])) :?>
                        <li class="cible" data-url="<?php echo $tweets[$i]->urlTweet; ?>">
                            <div class="highlight-caption-top bottom-to-top">
                              <div class="highlight">
                                <div class="icon"><img alt="twitter" src="css/asset/twitter-ico-b.png"></div>
                                <h2>Twitter</h2>
                                <div class="save">
                                    <span><a data-toggle="tooltip" title="Voir le contenu" target="_blank" href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                                    <span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux" href="javascript:void(0);" alt="save">SHARE</a></span>
                                    <span><a rel="popover" data-content="Le tweet a été sauvegardé sur votre dashboard!"  data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $tweets[$i]->user ?>" data-text="<?php echo $tweets[$i]->text ?>" data-url="<?php echo $tweets[$i]->urlTweet ?>">
                                      <span class="glyphicon glyphicon-bookmark"></span>
                                    </a></span>
                                </div>
                              </div>
                            </div>
                            <div class="text text-block">
                              <h1><?php echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>";?></h1>
                              <p>
                                 <?php 
                                    //Regex pour les liens dans le text du tweet.
                                    $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                                    echo $twText; 
                                 ?>
                              </p>
                            </div>
                        </li>
                        <?php $twtmp++; ?>
                        <?php endif;?>
                        <?php endfor;//fin de la boucle pour les 5 tweets?>
                        <?php $cpttweets += $twtmp;//ajoute au compteur le nombre de tweet affichés  ?>

                      </ul>  
                    </div>
                    </div><!-- end carousel-->
                    <!-- Navigation dans le carousel -->
                    <div class="navPrev"></div>
                    <div class="navNext"></div>
                </article>
            </div>
        </div>
        <?php endif; ?>
        <?php //end top tweets ?>
        
        <!-- ARTICLES -->
        <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($actus) ) : ?>
        <div class="second-stage-content row">
            <?php //Affiche les deux premiers articles, s'ils existent?>
            <?php $actmp=0; ?>
            <?php for($i=$cptactus;$i<($cptactus+2);$i++) : ?>
            <?php if(isset($actus[$i])): ?>
              <article class="col-md-6 cible" style="border-bottom: 5px solid #9b59b6;" data-url="<?php echo $actus[$i]->url; ?>">
                <div class="block">
                   <div class="text text-block">
                        <h1><?php echo $actus[$i]->author; ?></h1>
                        <p><?php echo $actus[$i]->mainTitle; ?></p>
                   </div>
                   <div class="highlight-caption bottom-to-top">
                      <div class="highlight">
                         <div class="icon"><img alt="articles" src="css/asset/articles-icon-black.png"></div>
                         <div class="save">
                            <span><a data-toggle="tooltip" title="Voir le contenu" target="_blank" href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                            <span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux" href="javascript:void(0);" alt="save">SHARE</a></span>
                            <a data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $actus[$i]->author ?>" data-text="<?php echo $actus[$i]->mainTitle ?>" data-url="<?php echo $actus[$i]->url ?>">
                                <i class="glyphicon glyphicon-bookmark"></i>
                            </a>
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
          <?php endif; //end articles?>

          
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

                         <h2>Instagram</h2>
                         
                         <div class="save">
                            <span><a data-toggle="tooltip" title="Voir le contenu" target="_blank" href="<?php echo $inst[$i]->src ?>" alt="save">GO</a></span>
                            <span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux" href="javascript:void(0);" alt="save">SHARE</a></span>
                            <a data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-mediasrc="<?php echo $inst[$i]->src ?>" data-text="<?php echo $inst[$i]->title ?>" data-url="<?php echo $inst[$i]->src ?>"><i class="glyphicon glyphicon-bookmark"></i></a>
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
           <!-- End Pictures -->
           

           <!-- OTHERS ACTUS AND TWEETS -->
           <?php if( (isset($_GET["trend"]) && !empty($_GET["trend"])) || isset($actus) || isset($tweets)) : ?>
           <div class="regular-stage-content row">
              <?php 
              
              if($cptactus != 0){
                $j=0;
                for($i=$cptactus;$i<($cptactus+4);$i++) :?>
                <!-- OTHERS ARTICLES -->
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
                                <span><a data-toggle="tooltip" title="Voir le contenu" target="_blank" href="<?php echo $actus[$i]->url; ?>" alt="save">GO</a></span>
                                <span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux" href="javascript:void(0);" alt="save">SHARE</a></span>
                                <a data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $actus[$i]->author ?>" data-text="<?php echo $actus[$i]->mainTitle ?>" data-url="<?php echo $actus[$i]->url ?>"><i class="glyphicon glyphicon-bookmark"></i></a>
                             </div>
                          </div>
                       </div>
                    </div>

                 </article>
                 <!-- end articles -->
            <?php 
                $actmp++;
                $j++;
                endfor;
                $cptactus += 4;
              }//end boucle for articles

                //start boucle for tweets
              if($cpttweets != 0 && $cptactus ==0){
                $j=0;
                for($i=$cpttweets;$i<($cpttweets+4);$i++) :?>
                <!-- OTHERS TWEETS -->
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
                                <span><a data-toggle="tooltip" title="Voir le contenu" target="_blank" href="<?php echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                                <span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux" href="javascript:void(0);" alt="save">SHARE</a></span>
                                <a data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" alt="save" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $tweets[$i]->user ?>" data-text="<?php echo $tweets[$i]->text ?>" data-url="<?php echo $tweets[$i]->urlTweet ?>"><i class="glyphicon glyphicon-bookmark"></i></a>
                             </div>
                          </div>
                       </div>
                    </div>
                 </article>
                 <!-- End other tweets-->
                <?php 
                  $twtmp++;
                  $j++;
                endfor;
                $cpttweets += 4;
                //end boucle tweets
              }
            ?>
          </div>
          <?php endif; //end others actus & tweets?>
           
        
        <!-- VIDEOS -->
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
                         	<span><a data-toggle="tooltip" title="Voir le contenu" target"_blank" href="<?php echo $videos[$i]->url; ?>">GO</a></span>
                         	<span><a data-toggle="tooltip" title="Partager sur les réseaux sociaux"href="javascript:void(0);">SHARE</a></span>
                         	<a data-toggle="tooltip" title="Sauvegarder sur votre dashboard" href="javascript:void(0);" class="localstorage" data-trend="<?php echo $query ?>" data-source="<?php echo $videos[$i]->title ?>" data-videoid="<?php echo $videos[$i]->id ?>" data-url="<?php echo $videos[$i]->url ?>"><i class="glyphicon glyphicon-bookmark"></i></a>
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
           <!-- END videos -->


       </div>
       <!-- end content -->

  


      
      
  </section>
  <script src="js/jquery.js"></script> <!-- initialisation jQuery -->
  <script src="js/bootstrap.js"></script> <!-- initialisation bootstrap.js -->
  <script src="js/main.js"></script> <!-- initialisation main.js (carousel and notif) -->
  <script src="js/local_storage.js"></script> <!-- initialisation localstorage.js (save content)-->
  <script src="js/my_local_storage.js"></script> <!-- initialisation my_local_storage.js -->
  <script src="js/infiniteScroll.js"></script> <!--infiniteScroll.js (scroll infini for add content) -->
  <script>
    scroll.init({
      trend       : <?php echo "\"".$query."\"";?>,
      nbactus     : <?php echo $cptactus;?>,
      nbtweets    : <?php echo $cpttweets;?>,
      nbpics      : <?php echo $cptpics;?>,
      nbvids      : <?php echo $cptvid;?>,
      totaltweets : <?php echo count($tweets) ?>,
      totalactus  : <?php echo count($actus) ?>,
      totalpics   : <?php echo count($inst) ?>,
      totalvids   : <?php echo count($videos) ?>,
      initializer : function(){
          $("#content").append('<div id="loadergif"><img src="css/img/ajax-loader.gif" alt="loader ajax"></div>');
          $('#content').append('<div id="nocontent"><img src="css/asset/nocontent-logo.png" alt="No Content"/><p>Il n\'y a plus de contenu à afficher !</p></div>');
      },
      loading : function(){
          $('#loadergif').fadeIn(400);
      },
      endOfLoad : function(data){
          $('#loadergif').before(data);
          $('.hidden').fadeIn(400);
          $('#loadergif').fadeOut(400);
      },
      noContent : function(){
          $('#nocontent').fadeIn(400);
      }
    });
    $(window).scroll(function()
    {
      scroll.loadData();
    });

  </script>
  
   

</body>


</html>