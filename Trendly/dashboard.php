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
   		<script id="trendUpTlp" type="text/template">
	   		<article class="col-md-3 accordeon check">
			   		<h1 class="trendname">{{title}}</h1>
						<p>
						{{date}}
						<a title="Facebook" href="https://www.facebook.com/sharer.php?u=http://preprod.apps-mog.com/TestTrends/result.php?trend={{title}}&t={{source}}" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">Partager</a>
						</p>
					<a class="delete-btn" data-trend="{{title}}" href="#"></a> 
		   		 <input id="inner1" type="checkbox" />
		   		<div class="fav-trends inner">
		   		</div>
		   		<label for="inner1">
	   			<div class="dropdown-btn flat-blue"></div>
	   			</label>
		   	</article>
	   	</script>
	   	
	    <script id="trendTlp" type="text/template">
		   		<div class="inner-content" data-trend="{{key}}">
			   		<span class="fav-icon"></span>
			   		<h3>{{source}}</h3>
			   		<p>{{text}}</p>
			   		{{#mediasrc}}<figure><img src="{{mediasrc}}" class="pic-image"></figure>{{/mediasrc}}{{#videoid}}<iframe width="100%" height="215" src="//www.youtube.com/embed/{{videoid}}" frameborder="0" allowfullscreen></iframe>{{/videoid}}
			   		<div class="action-buttons">
				   		<span data-url="{{url}}{{mediasrc}}" class="open"><a href="{{url}}{{mediasrc}}" alt="#">Ouvrir</a></span>
				   		<span data-url="{{url}}{{mediasrc}}" class="share"><a title="Facebook" href="https://www.facebook.com/sharer.php?u={{url}}{{mediasrc}}&t={{source}}" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">Partager</a></span>
				   		<span data-key="{{key}}" data-trend="{{title}}" class="delete"><a href="#" alt="#">Supprimer</a></span>
			   		</div>
		   		</div>
        </script>
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
			    	<a href="search.php"><img src="css/asset/logo-b.png" alt="Logo - Trendly">
			    	<span>Trendly - Les Trends en un clic</span></a>
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

  <ul id="listnotif">
    <!-- <p>Votre contenu a bien été enregistré !  <i class="glyphicon glyphicon-remove-circle close"></i></p> -->
  </ul>
   <section class="container">

   		<div class="content row">
		</div>
	</section>
</body>
<script src="js/jquery.js"></script>
<script>
	  //Notification pour un contenu supprimé

   	$("body").on('click', '.delete-btn', function(event) {
   		  	var trendname = document.querySelector('.trendname').innerHTML;

		$("#listnotif").append("<li class=\"notif\"><p>Votre Trendlist \""+ trendname +"\" a bien été supprimée !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
	  		$(this).parent().parent().fadeOut(500);
		})
  	});
  	$("body").on('click', '.delete', function(event) {
  			var trendname = document.querySelector('.trendname').innerHTML;
		$("#listnotif").append("<li class=\"notif\"><p>Votre contenu pour \""+ trendname +"\" a bien été supprimé !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
	  		$(this).parent().parent().fadeOut(500);
	  		$(this).parent().parent().remove();
		})
  	});
</script>
<script src="js/mustache.js"></script>

<script src="js/local_storage.js"></script>
<!-- <script src="js/my_local_storage.js"></script> -->
<script src="js/dashboard.js"></script>


</html>