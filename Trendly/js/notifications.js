  //Notification pour un contenu supprimé

$("body").on('click', '.delete-btn', function(event) {
	  	var trendname = document.querySelector('.trendname').innerHTML;
		$("#listnotif").append("<li class=\"notif\"><p>Votre Trendlist \""+ trendname +"\" a bien été supprimée !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
	})
});
$("body").on('click', '.delete', function(event) {
		var trendname = document.querySelector('.trendname').innerHTML;
		$("#listnotif").append("<li class=\"notif\"><p>Votre contenu pour \""+ trendname +"\" a bien été supprimé !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
  		$(this).parent().parent().remove();
	})
});