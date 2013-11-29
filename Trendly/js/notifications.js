
//Notification pour une trendlist supprimée
$("body").on('click', '.delete-btn', function(event) {
		$("#listnotif").append("<li class=\"notif\"><p>Votre Trendlist a bien été supprimée !   <span class=\"close\">Close</span></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
  		$(this).parent().parent().remove();
	})
});

  //Notification pour un contenu supprimé
$("body").on('click', '.delete', function(event) {
		$("#listnotif").append("<li class=\"notif\"><p>Votre contenu a bien été supprimé !   <span class=\"close\">Close</span></p></li>");
		$(".notif").fadeIn(500);
		$(".notif").on('click','.close',function(event){
  		$(this).parent().parent().fadeOut(500);
  		$(this).parent().parent().remove();
	})
});