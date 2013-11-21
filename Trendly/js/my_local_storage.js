var datas = {};
<<<<<<< HEAD
storage.init({
	nom : "trend"
	});

var lien = $('.localstorage');

lien.on('click', function(event) {
	event.preventDefault();
	console.log(datas);
	datas.trend = $(this).data("trend");
	storage.record(datas);
=======
storage.init();

var lien = document.getElementsByClassName("localstorage");

$('body').on('click', '.localstorage', function(event) {
	event.preventDefault();
	alert($(this).data('trend'));
	/* Act on the event */
>>>>>>> 01fb14ea46ab8299ae3963af68eda705f6f0a37e
});