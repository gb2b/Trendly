<?php 
  include("functions.php");
  $trends = getTrendsPonderation($auth,$cache,false);
  $trendsMob = getTrendsPonderation($auth,$cache,true);
?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Trendly - Search a Trend</title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
  
        <!-- Favicon & FontAwesome -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="icon" type="image/png" href="css/asset/favicon.png" />
        
        <!-- Css Design -->
       
        <link rel="stylesheet" href="css/style.css">
        
        <link href="css/bootstrap/bootstrap.css" rel="stylesheet">
        
         <link rel="stylesheet" href="css/media-queries.css">
        <!-- <link rel="stylesheet" href="css/trendly.css">-->
        

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
		      <li>
		      	<a class="info-icon" href="#">
		      		<div class="help">
		      			<i class="glyphicon glyphicon-info-sign help" style="color: #fff;"></i>
		      		</div>
		      	</a>
		      </li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav><!-- /.navbar -->
		
		<!-- END OF THE NAV BAR -->
	</header>
	<!-- END OF THE HEADER -->
    
    <!-- START OF THE CONTENT -->  
    <div class="container">
    
    <section class="bottom-search row">
		
		
			<div>

	          <form action="result.php" autocomplete="off" id="search">
	             <fieldset class="col-md-12">
	                 
	                <input id="trend" name="trend" placeholder="Search a trend"  type="text"> 
	                <label for="trend"></label>
	                <input type="submit" value="">
	               
	                
	             </fieldset><!-- /.fieldset -->
	
	             
	          </form><!-- /.form -->
      
          </div>

		
		
		</section><!-- /.bottom-search -->

	
	<div class="row">
	        
		<section>
			<!-- START OF THE LOADING -->  
			
			<div id="loading">
				<div class="content">
						<div id="loader">
							<div class="outer"></div>
							<div class="inner"></div>
						</div><!-- /.loader -->
					<p class="text">Chargement des trends...</p>
				</div><!-- /.content -->
			</div><!-- /.loading -->
			
			<!-- END OF THE LOADING -->  
			            
			            
			            
			<!-- START OF THE MODULE -->            
			<div id="module"></div>
			<!-- END OF THE MODULE -->  
			
			
			<!-- START OF THE BASIC LIST-->
			<div class="basic-list row">
				<h2>Top Trends</h2>
				<ul>
					<?php foreach($trendsMob as $t): ?>
					<li class="col-md-6"><a href="result?trend=<?php echo $t?>"><?php echo $t ?></a></li>
					<?php endforeach; ?>
				</ul>
				
			</div>
			<!-- START OF THE BASIC LIST-->
			
		</section>
	        
	</div><!-- /.row -->
		
</div><!-- /.container -->
			
            
 
     <!-- END OF THE CONTENT -->  
    
    
    <!-- POPUP VIDEO --> 
    <div id="modal">
      <div id="player">
        <video id="video" controls src="css/video/trendly_module.mp4">
        Ici la description alternative
        </video>
      </div>
    </div>
    <!-- POPUP VIDEO --> 
   


    
</body>
    <script type="text/javascript"> 
      var trends = <?php echo $trends ?>;
    </script>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.5.1"></script>

    <script type="text/javascript" src="js/main-search.js"></script>
    <script type="text/javascript" src="js/modul-trends2.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/my_module_trends2.js" type="text/javascript"></script>
</html>