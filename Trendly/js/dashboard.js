jQuery(document).ready(function($) {
	storage.init();
	var datas = storage.render();
	var templateUpTrend = $('#trendUpTlp').html();
	var templateTrend = $('#trendTlp').html();
	var colors = ["flat-red", "flat-green", "flat-blue", "flat-yellow"];
	var colori = 0;
	for (var i = 0; i < datas.length; i++) {
		var inner = "inner"+i;
		var data = JSON.parse(datas[i]);
		var html = Mustache.to_html(templateUpTrend, data[0]);
		$('.content').append(html);
		$('article').eq(i).find('input').attr('id', inner);
		$('article').eq(i).find('label').attr('for', inner);
		$('.dropdown-btn').eq(i).addClass(colors[colori]);
		for (var j = 0; j < data.length; j++) {
			var html2 = Mustache.to_html(templateTrend, data[j]);
			$('.inner').eq(i).append(html2);
		}
		if (colori>3) {
			colori = 0;
		}else{
			colori++;
		}
	}

	$('body').on('click', '.delete-btn', function(event) {
		event.preventDefault();
		storage.deleteKey($(this).data('trend'));
		$(this).parent("article").remove();
	});
	$('body').on('click', 'span.delete', function(event) {
		event.preventDefault();
		if (storage.deleteValueOfKey($(this).data('trend'), parseInt($(this).data('key')))) {
			$(this).parent().parent().parent().parent("article").remove();			
		}else{
			$(this).parent().parent(".inner-content").remove();
		}

	});
});
