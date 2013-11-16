<?php //include("connexion/bdd.php"); ?>
<?php //include("scripts/functions.php"); ?>
<?php $time = microtime(TRUE); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
    </head>
    <body marginwidth="0" marginheight="0"  topmargin="0" leftmargin="0">

       <?php 
       if (isset($_GET["api"]) && $_GET["api"]=="fb") {
           include 'scripts/fboauth/init-fb.php';
       }else{
            include 'scripts/twitteroauth/init-tw.php';
       }
        
       ?>
       <?php echo strftime("%k:%M", time()) ?>
    </body>
</html>
<?php echo round(microtime(TRUE)-$time,3); ?>