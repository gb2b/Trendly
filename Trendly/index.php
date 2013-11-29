<?php 
if (isset($_COOKIE["visited"]) && $_COOKIE["visited"]==true && $_GET["back"]!=true) {
	header("Location: search.php");
}
setcookie("visited", true, time()+360*24*3600);
 ?>
<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly : les Tendances du net</title>
   <meta content="" name="description">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link href="css/style.css" rel="stylesheet">
   <link href="css/bootstrap/bootstrap.css" rel="stylesheet">
   <link rel="stylesheet" href="css/media-queries.css">
   <link href="css/asset/favicon.png" rel="icon" type="image/png">
</head>

<body>

	
<!-- START OF THE HEADER -->
   <header class="container">
      <article class="col-md-12">
         <img alt="Logo - Trendly" src="css/asset/logo.png">

         <h1>trendly</h1>

         <p>Soyez au courant des dernières tendances</p>
         <a href="search.php">GO
            
            <!-- START OF THE ARROW DOWN SVG BTN -->
            <svg version="1.1" id="arrowStart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="42.427px" height="23.334px" viewBox="0 0 42.427 23.334" enable-background="new 0 0 42.427 23.334" xml:space="preserve">
                <polygon points="40.305,0 21.213,19.092 2.122,0 0,2.121 19.092,21.213 21.213,23.334 23.334,21.213 42.427,2.121 "/>
            </svg>
            <!-- END OF THE ARROW DOWN SVG BTN -->
         
          </a>
      </article><!--./article-->
   </header><!--./container-->
<!-- START OF THE HEADER -->

   
   <section class="stage-one">
   		
   		<h1>Trendly, c'est quoi ?</h1>
   		
   		<div class="article-container row">
	   		<article class="article-1 col-md-4">
	   			
	   			
	   			
	   			<div class="ico-stage-one"></div>
	   			
	   			<p>
	   				Le module de Trendly est une représentation 
		   			DataViZ des 10 mots les plus Trends à 
		   			l’heure actuelle en France.
		   		</p>
	   		
	   		</article>
	   		
	   		<article class="article-2 col-md-4">
	   			
	   			<div class="ico-stage-two"></div>
	   			
	   			<p>
	   				Sélectionnez ou recherchez le trend qui vous 
	   				intéresse pour avoir accès aux différents 
	   				contenus liés a celui-ci.
	   				(Articles, images, videos, tweets).
		   		</p>
	   		
	   		</article>
	   		
	   		<article class="article-3 col-md-4">
	   		
	   			<div class="ico-stage-three"></div>
	   			
	   			<p>
					Visualisez en un clin d’oeil les actualités en 
					rapport avec ce trend, et libre à vous de le 
					partager ou de sauvegarder les contenus
					intéressant sur votre dashoard.
		   		</p>
	   		
	   		</article>

   		</div>
   
   </section><!--./stage-one-->
   
   
   <section class="stage-two">
   	
   		<div class="bg"></div>	
   	   
   </section><!--./stage-two-->

      <section class="stage-three">
   	
      	<div class="article-container row">
	   		<article class="article-1 col-md-12">
	   			
	   			<h1>Video d'introduction</h1>
	   			 <!-- VIDEO --> 
				
				      <div id="player">
					        <video id="video" controls src="css/video/trendly_module.mp4">
					        Ici la description alternative
					        </video>
				      </div>
				 
				 <!-- VIDEO --> 
					   	
	   		
	   		</article>
	   		

   	   
   </section><!--./stage-three-->


  
</body>
</html>
          
