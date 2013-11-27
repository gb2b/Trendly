var load = document.getElementById("loading");
    load.style.display = "block" ;

$(".help").on('click',function(event){
  $("#modal").fadeIn(200);
});

var onplayed=false;
$("#player").on('mouseover',function(event){onplayed=true});
$("#player").on('mouseout',function(event){onplayed=false});
$("#modal").on('click',function(event){
	if(!onplayed){
		$("#modal").fadeOut(200);
	}
});
  
