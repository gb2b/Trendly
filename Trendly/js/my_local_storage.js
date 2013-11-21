var datas = {};
storage.init({
	nom : "trend"
	});

var lien = $('.localstorage');

lien.on('click', function(event) {
	event.preventDefault();
	console.log(datas);
	datas.trend = $(this).data("trend");
	storage.record(datas);
});