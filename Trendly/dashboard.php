<!DOCTYPE html>
<?php include("functions.php") ?>
<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - Dashboard</title>
   <meta content="Dashboard Trendly, retrouvez les contenus que vous avez sauvegardé" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">
   <link href="css/style.css" rel="stylesheet">
   <link href="css/bootstrap/bootstrap.css" rel="stylesheet">

   		<script id="trendUpTlp" type="text/template">
	   		<article class="col-md-3-bis accordeon check">
			   		<h1 id="trendname">{{title}}</h1>
						<p>
						{{date}}
						<a title="Facebook" href="https://www.facebook.com/sharer.php?u=http://preprod.apps-mog.com/TestTrends/result.php?trend={{title}}&t={{source}}" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">Partager</a>
						</p>
					<a class="delete-btn" data-trend="{{title}}" href="#"><i class="glyphicon glyphicon-trash"></i></a> 
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
				   		<span data-url="{{url}}{{mediasrc}}" class="open"><a href="{{url}}{{mediasrc}}" target="_blank" alt="#">Ouvrir</a></span>
				   		<span data-url="{{url}}{{mediasrc}}" class="share"><a title="Facebook" href="https://www.facebook.com/sharer.php?u={{url}}{{mediasrc}}&t={{source}}" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">Partager</a></span>
				   		<span data-key="{{key}}" data-trend="{{title}}" class="delete"><a href="#" alt="#">Supprimer</a></span>
			   		</div>
		   		</div>
        </script>
</head>

<body>
	<?php include_once("analytics.php") ?>
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
			    	<span>trendly</span></a>
			    </div>
			    <!-- END LOGO -->
			    
			</div><!-- /.navbar-header -->
		
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <ul class="nav navbar-nav">
			    
			    </ul>
			    
		    
		    <!-- INFO BUTTON -->
		    <?php include("header.php"); ?>
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
<script src="js/notifications.js"></script>
<script src="js/mustache.js"></script>

<script src="js/local_storage.js"></script>
<!-- <script src="js/my_local_storage.js"></script> -->
<script src="js/dashboard.js"></script>


</html>