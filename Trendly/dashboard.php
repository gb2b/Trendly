<!DOCTYPE html>
<?php include("functions.php") ?>
<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - Dashboard</title>
   <meta content="" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">
   <link href="css/style.css" rel="stylesheet">
   <link href="css/bootstrap/bootstrap.css" rel="stylesheet">
   
	    <script id="trendTlp" type="text/template">
	   		<div class="inner-content">
		   		<span class="fav-icon"></span>
		   		<h3>{{title}}</h3>
		   		<p>{{texte}}</p>
		   		<div class="action-buttons">
			   		<span data-url="{{url}}{{mediasrc}}" class="open"><a href="{{url}}{{mediasrc}}" alt="#">Ouvrir</a></span>
			   		<span data-url="{{url}}{{mediasrc}}" class="share"><a href="#" alt="#">Partager</a></span>
			   		<span data-key="{{title}}" class="delete"><a href="#" alt="#">Supprimer</a></span>
		   		</div>
	   		</div>
        </script>
</head>

<body>
   <section class="container">
   		<div class="content row">
	   		     	<!-- accordeon with checkbox -->
   
    
    <article class="col-md-3 accordeon check">
	   			
		   			 <h1>Paris</h1>
			   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
		   			 
	   			 
	   			 
	   			 <input id="inner1" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				
	   				<div class="inner-content">
		   				<span class="fav-icon"></span>
		   				<h3>Libération</h3>
		   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
		   				
		   				<div class="action-buttons">
			   				<span><a href="#" alt="#">Ouvrir</a></span>
			   				<span><a href="#" alt="#">Partager</a></span>
			   				<span><a href="#" alt="#">Supprimer</a></span>
		   				</div>
	   				</div>
	   				
	   				<div class="inner-content">
		   				<span class="fav-icon"></span>
		   				
		   				<h3>Bing - Image</h3>
		   				
		   				<figure>	
		   					<img src="http://i.imgur.com/1xtOB7g.jpg" class="pic-image" alt="Pic"/>
		   				</figure>		   				
		   				<div class="action-buttons">
			   				<span><a href="#" alt="#">Ouvrir</a></span>
			   				<span><a href="#" alt="#">Partager</a></span>
			   				<span><a href="#" alt="#">Supprimer</a></span>
		   				</div>
	   				</div>

	   				
	   				<div class="inner-content">
		   				<span class="fav-icon"></span>
		   				<h3>Le monde</h3>
		   				<p>Philippines : les survivants enterrent leurs morts et 						appellent à l'aide</p>
		   				
		   				<div class="action-buttons">
			   				<span><a href="#" alt="#">Ouvrir</a></span>
			   				<span><a href="#" alt="#">Partager</a></span>
			   				<span><a href="#" alt="#">Supprimer</a></span>
		   				</div>
	   				</div>
	   			</div>
	   			
	   			<label for="inner1">
	   			<div class="dropdown-btn flat-blue"></div>
	   			</label>
	   			
	   			
    </article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>#TireurFou</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   	</p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			
	   			 <input id="inner2" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<div class="inner-content">
		   				<span class="fav-icon"></span>
		   				<h3>Libération</h3>
		   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
		   				
		   				<div class="action-buttons">
			   				<span><a href="#" alt="#">Ouvrir</a></span>
			   				<span><a href="#" alt="#">Partager</a></span>
			   				<span><a href="#" alt="#">Supprimer</a></span>
		   				</div>
	   				</div>
	   				
	   				<div class="inner-content">
		   				<span class="fav-icon"></span>
		   				<h3>Le monde</h3>
		   				<p>Philippines : les survivants enterrent leurs morts et 						appellent à l'aide</p>
		   				
		   				<div class="action-buttons">
			   				<span><a href="#" alt="#">Ouvrir</a></span>
			   				<span><a href="#" alt="#">Partager</a></span>
			   				<span><a href="#" alt="#">Supprimer</a></span>
		   				</div>
	   				</div>	 
	   				  	
	   				
	   				
	   				</div>
	   			
	   			<label for="inner2">
		   			
		   			 <div class="dropdown-btn flat-yellow"></div>
		   			
	   			</label>
	   			
	   		</article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>Directionners</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			
	   			 <input id="inner3" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner3">
		   			
		   			 <div class="dropdown-btn flat-red"></div>
		   			
	   			</label>
	   			
	   		</article>
	   		
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>PARIS</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			 
	   			 <input id="inner4" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner4">
		   			  <div class="dropdown-btn flat-green"></div>
		   			 
	   			 </label>
    </article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>#TireurFou</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			
	   			 <input id="inner5" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner5">
		   			
		   			 <div class="dropdown-btn flat-blue"></div>
		   			
	   			</label>
	   			
	   		</article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>Directionners</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			
	   			 <input id="inner6" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner6">
		   			
		   			 <div class="dropdown-btn flat-yellow"></div>
		   			
	   			</label>
	   			
	   		</article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>PARIS</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			 
	   			 <input id="inner7" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner7">
		   			 
		   			  <div class="dropdown-btn flat-red"></div>
		   			 
	   			 </label>
    </article>
	   		
	   		<article class="col-md-3 accordeon check">
	   			
	   			<h1>#TireurFou</h1>
	   			 <p>
			   			 24 Novembre 2013
			   			 <a href="#">Partager votre trendlist</a>
			   			 </p>
			   		<a class="delete-btn" href="#"></a>
	   			
	   			
	   			 <input id="inner8" type="checkbox" />
	   			
	   			<div class="fav-trends inner">
	   				<span class="fav-icon"></span>
	   				<h3>@Le parisien</h3>
	   				<p>PHOTO A PARTAGER. Tireur fou à #Paris : une nouvelle photo du suspect. Notre DIRECT ici http://t.co/42mEkVpZLI</p>
	   				
	   				<div class="action-buttons">
		   				<span><a href="#" alt="#">Ouvrir</a></span>
		   				<span><a href="#" alt="#">Partager</a></span>
		   				<span><a href="#" alt="#">Supprimer</a></span>
	   				</div>
	   			</div>
	   			
	   			<label for="inner8">
		   			
		   			 <div class="dropdown-btn flat-green"></div>
		   			
	   			</label>
	   			
	   		</article>
	   		
	   		     	 
     	       
   </section>
</body>
<script src="js/jquery.js"></script>
<script src="js/mustache.js"></script>

<script src="js/local_storage.js"></script>
<script src="js/my_local_storage.js"></script>


</html>