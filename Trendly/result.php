<?php 
   include("functions.php");

   if(isset($_GET['trend']) && !empty($_GET['trend'])){
      $query = $_GET['trend'];
   }
   $tweets = getSearchTweets($auth, $query, $cache);
   //$videos = getVideoYoutube($auth, $cache, $query);

   

?>

<!DOCTYPE html>

<html>
<head>
   <meta charset="utf-8">
   <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

   <title>Trendly - Search : <?php if(isset($query)) echo $query; ?></title>
   <meta content="" name="description">
   <meta content="width=device-width,initial-scale=1" name="viewport">
   <link href="css/result.css" rel="stylesheet">
   <link href="css/css/bootstrap.css" rel="stylesheet">
</head>

<body>
   <section class="container">
      <form autocomplete="off">
         <fieldset>
            <input id="trend" name="trend" placeholder="Search a trend" required=
            "" type="text" value="<?php if(isset($_GET['trend']) && !empty($_GET['trend'])){echo $_GET['trend'];}?>"> <label for="trend"></label>
         </fieldset>

         <div>
            <input type="submit" value=" ">
         </div>
      </form>

      <div class="top-content row">
         <div class="block">
            <article>
               <div class="text text-block">
                  <h1>@<?php echo $tweets[0]->user; ?></h1>

                  <p><?php if($tweets){
                        //$twText=preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+).*((http|https):\/\/[A-Za-z0-9.\/]+)(.*)/", "$1<a href=\"$2\">$2</a> <a href=\"$4\">$4</a>", $tweets[0]->text);
                        $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[0]->text);
                        echo $twText;
                  }  ?>
               </p>
               </div>

               <div class="highlight-caption bottom-to-top">
                  <div class="highlight">
                     <div class="icon"><img alt="twitter" src=
                     "css/asset/twitter-ico-b.png"></div>

                     <h2>Twitter</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                     
                  </div>
               </div>
            </article>
         </div>
      </div>

      <div class="second-stage-content row">
         <article class="col-md-6" style="border-bottom: 5px solid #9b59b6;">
            <div class="block">
               <div class="text text-block">
                  <h1>Le Monde</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon-black.png"></div>

                     <h2>Le Monde</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
         </article>

         <article class="col-md-6" style="border-bottom: 5px solid #9b59b6;">
            <div class="block">
               <div class="text text-block">
                  <h1>Le Monde</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon-black.png"></div>

                     <h2>Le Monde</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                     
                  </div>
               </div>
            </div>
         </article>
      </div>

            
            <div class="image-stage-content row">
         <figure class="col-md-6 pic">
             <img src="http://i.imgur.com/IYvlJo3.jpg" class="pic-image" alt="Pic"/>
           <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Instagram</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
            
         </figure>

         <figure class="col-md-6 pic">
             <img src="http://i.imgur.com/1xtOB7g.jpg" class="pic-image" alt="Pic"/>
          <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Instagram</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
            
         </figure>
         
         
         
          </div>
          
          <div class="image-stage-content row">
         <figure class="col-md-6 pic">
             <img src="http://i.imgur.com/cc14CVy.jpg" class="pic-image" alt="Pic"/>
          <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Instagram</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
            
         </figure>

         <figure class="col-md-6 pic">
             <img src="http://i.imgur.com/xL0j0Te.png" class="pic-image" alt="Pic"/>
          <div class="highlight-caption left-to-right">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Instagram</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>            
         </figure>   
         
       </div>
       
       
       <div class="regular-stage-content row">
         <article class="col-md-3 col-md-offset-0" style=
         "background-color: #d35400;">
            <div class="block">
               <div class="text text-block">
                  <h1>LE MONDE</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="twitter" src=
                     "css/asset/videos-icon.png"></div>

                     <h2>Youtube</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
         </article>

         <article class="col-md-3 col-md-offset-0" style=
         "background-color: #f39c12;">
            <div class="block">
               <div class="text text-block">
                  <h1>EURONEWS</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Euronews</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
         </article>

         <article class="col-md-3 col-md-offset-0" style=
         "background-color: #1abc9c;">
            <div class="block">
               <div class="text text-block">
                  <h1>EURONEWS</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Euronews</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
         </article>

         <article class="col-md-3 col-md-offset-0" style=
         "background-color: #34495e;">
            <div class="block">
               <div class="text text-block">
                  <h1>EURONEWS</h1>

                  <p>Philippines : les survivants enterrent leurs morts et
                  appellent à l'aide.</p>
               </div>

               <div class="highlight-caption top-to-bottom">
                  <div class="highlight">
                     <div class="icon"><img alt="articles" src=
                     "css/asset/articles-icon.png"></div>

                     <h2>Euronews</h2>
                     
                     <div class="save">
                        <span><a href="#" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                  </div>
               </div>
            </div>
         </article>
     
      </div>

       
       
       <div class="video-stage-content row">
         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

      </div>

      
      
</section>
</body>
</html>