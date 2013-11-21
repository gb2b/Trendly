var datas = {};
storage.init();

var lien = document.getElementsByClassName("localstorage");

$('body').on('click', '.localstorage', function(event) {
	event.preventDefault();
	alert($(this).data('trend'));
	/* Act on the event */
});