var _datas = {};
storage.init({
	nom : "trend"
	});


$("body").on('click', '.localstorage', function(event) {
	event.preventDefault();
	_datas.title    = $(this).data('trend');
	_datas.source   = $(this).data('source');
	_datas.url      = $(this).data('url');
	_datas.mediasrc = $(this).data('mediasrc');
	_datas.text     = $(this).data('text');
	storage.record(_datas);
});

