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

   <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
</head>

<body>
   <section class="container">
     <form autocomplete="off">
         <fieldset>
            <input id="trend" name="trend" placeholder="Search a trend" required=
            "" type="text" value="<?php if(isset($query)) echo $query; ?>"> <label for="trend"></label>
         </fieldset>

         <div>
            <input type="submit" value=" ">
         </div>
      </form>

     <div class="top-content row">
         <div class="block">
            <article>
            <div class="container">
            <div class="carousel">
            <ul>
            <?php for($i=0;$i<5;$i++):?>
            <li>
            
            
            
               <div class="text text-block">
                  <h1><?php if(isset($tweets))echo "<a href='http://twitter.com/".$tweets[$i]->user."'>@".$tweets[$i]->user."</a>"; else echo "Pas de tweet";?></h1>

                  <p>
                     <?php 
                        if(isset($tweets)){
                        //$twText=preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+).*((http|https):\/\/[A-Za-z0-9.\/]+)(.*)/", "$1<a href=\"$2\">$2</a> <a href=\"$4\">$4</a>", $tweets[0]->text);
                           if(isset($tweets[$i]->urls)){
                              $twText = preg_replace("/(.*)((http|https):\/\/[A-Za-z0-9.\/]+)/", "$1<a href=\"$2\">$2</a>", $tweets[$i]->text);
                           } else $twText = $tweets[$i]->text;
                           echo $twText;
                        }  
                     ?>
               </p>
               </div>

               <div class="highlight-caption bottom-to-top">
                  <div class="highlight">
                     <div class="icon"><img alt="twitter" src=
                     "css/asset/twitter-ico-b.png"></div>

                     <h2>Twitter</h2>
                     
                     <div class="save">
                        <span><a href="<?php if(isset($tweets)) echo $tweets[$i]->urlTweet; ?>" alt="save">GO</a></span>
                        <span><a href="#" alt="save">SHARE</a></span>
                        <a href="#" alt="save">LOGO</a>
                     </div>
                     
                  </div>
               </div>
               
               
               
            </li>
            <?php endfor; ?>
            
            
            </ul>  
            </div>
            </div>   
        <div class="navPrev"></div>
        <div class="navNext"></div>
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

       
       
     <!--  <div class="video-stage-content row">
         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

         <div class="col-md-6">
            <object width="560" height="315"><param name="movie" value="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/Ke6ureLcpkk?version=3&amp;hl=fr_FR" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>         </div>

      </div>-->
         
   
  
         

      
      

      
      
</section>
</body>


<script>
var speed = 600,
    currSel = 0,
    itemCount = $('.carousel ul li')
                    .length,
    itemWidth = $('.carousel ul li')
                  .css('width')
                    .split('px')[0] ;

$('.navNext').on('click',function(){
  currSel =(currSel+1)%itemCount;
  console.log((currSel*itemWidth));
  $('.carousel ul')
    .animate(
      {marginLeft:
       '-'
       +(currSel*itemWidth)
       +'px'}
      ,speed);
});
$('.navPrev').on('click',function(){
  currSel =((currSel==0)
                ?itemCount
                :(currSel))-1 ;
  console.log((currSel*itemWidth));
  $('.carousel ul')
    .animate(
      {marginLeft:
       '-'
       +(currSel*itemWidth)
       +'px'}
      ,speed);
});

</script>


</html>