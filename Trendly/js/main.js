//Slider pour les tweets
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


  //Permet d'accéder à la source d'un contenu en cliquant sur son bloc
  var onsaved = false;
  $("#content").on('click','.save',function(event) {onsaved = true;})
  $("#content").on('mouseout','.save',function(event){onsaved = false;})

  $('#content').on('click',".cible",function(event) {
    if(!onsaved)
    {
      event.preventDefault();
      url = $(this).data('url');
      window.open(url);
      return false;
    }
  });


  //Notification pour un contenu sauvegardé
   $("body").on('click', '.localstorage', function(event) {
    $("#listnotif").append("<li class=\"notif\"><p>Le contenu a bien été ajouté à <a href='dashboard.php' style=\'color:#2980b9\'>votre dashboard</a> !  <span class=\"close\">Close</span></p></li>");
    $(".notif").fadeIn(500);
    $(".notif:first").delay(3000).fadeOut(500,function(){
      $(this).remove();
    });
    $(".notif").on('click','.close',function(event){
      $(this).parent().parent().fadeOut(500);
      $(this).parent().parent().remove();
    })
    
  });


 



