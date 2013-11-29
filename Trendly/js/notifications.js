  //Notification pour un contenu supprimé

$("body").on('click', '.delete-btn', function(event) {
		$("#listnotif").append("<li class=\"notif\"><p>Votre Trendlist a bien été supprimée !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
  		$(this).parent().parent().remove();
	})
});
$("body").on('click', '.delete', function(event) {
		$("#listnotif").append("<li class=\"notif\"><p>Votre contenu pour a bien été supprimé !  <i class=\"glyphicon glyphicon-remove-circle close\"></i></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
  		$(this).parent().parent().remove();
	})
});