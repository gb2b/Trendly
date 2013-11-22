var _datas = {};
storage.init({
	nom : "trend"
	});

var lien = $('.localstorage');

lien.on('click', function(event) {
	event.preventDefault();
	_datas.trend = $(this).data('trend');
	storage.record(_datas);
});

