var _datas = {};
storage.init();


$("body").on('click', '.localstorage', function(event) {
	event.preventDefault();
	var today = new Date();
	_datas.title    = $(this).data('trend');
	_datas.source   = $(this).data('source');
	_datas.date = today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear();
	alert(_datas.date);
	_datas.url      = $(this).data('url');
	_datas.mediasrc = $(this).data('mediasrc');
	_datas.text     = $(this).data('text');
	storage.record(_datas);
});

