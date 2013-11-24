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




var cible = $('.cible');
var save = $('.save');
var onsaved = false;
save.on('click', function(event) {onsaved = true;})
save.on('mouseout',function(event){onsaved=false;})

cible.on('click', function(event) {
  if(!onsaved)
  {event.preventDefault();
  url = $(this).data('url');
  window.open(url);
  return false;}
});