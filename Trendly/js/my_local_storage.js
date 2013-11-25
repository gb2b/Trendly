var _datas = {};
storage.init({
	nom : "trend"
	});


$("body").on('click', '.localstorage', function(event) {
	event.preventDefault();
	_datas.trend = $(this).data('trend');
	storage.record(_datas);
});

