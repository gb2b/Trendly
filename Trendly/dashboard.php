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
			   		<h1>{{title}}</h1>
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
			   		<p>{{text}}{{#mediasrc}}<img src="{{mediasrc}}">{{/mediasrc}}{{#videoid}}<iframe width="100%" height="215" src="//www.youtube.com/embed/{{videoid}}" frameborder="0" allowfullscreen></iframe>{{/videoid}}</p>
			   		<div class="action-buttons">
				   		<span data-url="{{url}}{{mediasrc}}" class="open"><a href="{{url}}{{mediasrc}}" alt="#">Ouvrir</a></span>
				   		<span data-url="{{url}}{{mediasrc}}" class="share"><a title="Facebook" href="https://www.facebook.com/sharer.php?u={{url}}{{mediasrc}}&t={{source}}" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">Partager</a></span>
				   		<span data-key="{{key}}" data-trend="{{title}}" class="delete"><a href="#" alt="#">Supprimer</a></span>
			   		</div>
		   		</div>
        </script>
</head>

<body>
   <section class="container">
   		<div class="content row">
		</div>
	</section>
</body>
<script src="js/jquery.js"></script>
<script src="js/mustache.js"></script>

<script src="js/local_storage.js"></script>
<!-- <script src="js/my_local_storage.js"></script> -->
<script src="js/dashboard.js"></script>


</html>