<?php 
  include("functions.php");
?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Trendly : Les tendances de demain</title>
        <meta name="description" content="">


        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
  
        <!-- Bootstrap & FontAwesome -->
        <link href="css/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

        <!-- Css reset for all browsers -->
        <link rel="stylesheet" href="css/reset.css">
        
        <!-- Css Design -->
        <link rel="stylesheet" href="css/design.css">
        <!-- <link rel="stylesheet" href="css/trendly.css">-->
        

</head>
<body onclick="fctclic(this);">      
      <div id="trend-desc">
          <h2 class="trend-title">Trend</h2>
          <p>
            Top : <span class="top">1</span><br/>
          </p>
          <p class="buttons">
              <a href="" class="seetrend"><span class="glyphicon glyphicon-flash"></span> See Trend</a><br/>
              <a href="" class="favtrend"><span class="glyphicon glyphicon-bookmark"></span> Add Trend</a>
          </p>
      </div>

    <div class="container">
      
      <div class="row">
        
      	<section>
            <div id="loading">
              <div class="load-content">
                <div id="loader">
                  <div class="outer"></div>
                  <div class="inner"></div>
                </div>
                <p class="load-text">Chargement des trends...</p>
              </div>
            </div>
            
            <div id="module"></div>
      	</section>
        
      </div>

      <div class="row">

          <form action="result.php" autocomplete="off" id="search">
             <fieldset class="col-md-11">
                <input id="trend" name="trend" placeholder="Search a trend"  type="text"> <label for="trend"></label>
             </fieldset>

             <div class="col-md-1">
                <input type="submit" value="">
             </div>
          </form>
      
      </div>
    </div>
 
  	<script>
      // print_r(getTrendGnews($cache));
      <?php print_r(getTrendsPonderation($auth, $cache)); ?>


    </script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?2.5.1"></script>
  	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
      var load = document.getElementById("loading");
      load.style.display = "block" ;

    </script>
    <script src="js/modul-trends.js" type="text/javascript"></script>
    
</body>
</html>