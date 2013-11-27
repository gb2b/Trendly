var _datas = {};
var mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
storage.init();


$("body").on('click', '.localstorage', function(event) {
	event.preventDefault();
	var today       = new Date();
	_datas.key  = today.getTime();
	_datas.title    = $(this).data('trend');
	_datas.source   = $(this).data('source');
	_datas.date     = today.getDate()+" "+mois[today.getMonth()+1]+" "+today.getFullYear();
	_datas.url      = $(this).data('url');
	_datas.mediasrc = $(this).data('mediasrc');
	_datas.text     = $(this).data('text');
	storage.record(_datas);
});

