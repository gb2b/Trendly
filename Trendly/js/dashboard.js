jQuery(document).ready(function($) {
	//Initiates an object that handles the localstorage
	storage.init();
	//Receives the data as an Array in the localstorage.
	var datas = storage.render();
	//Fetches the templates from the page's php.
	var templateUpTrend = $('#trendUpTlp').html();
	var templateTrend   = $('#trendTlp').html();
	var colors          = ["flat-red", "flat-green", "flat-blue", "flat-yellow"];
	var colori          = 0;
	//Runs through the successive lignes of the localstorage.
	for (var i = 0; i < datas.length; i++) {
		var inner = "inner"+i;
		var data = JSON.parse(datas[i]);
		//Adds data in the templates via Mustache, then inserts the templates in the page.
		var html = Mustache.to_html(templateUpTrend, data[0]);
		$('.content').append(html);
		//Réglages de détails d'affichage Settings for the 'detail' display
		$('article').eq(i).find('input').attr('id', inner);
		$('article').eq(i).find('label').attr('for', inner);
		$('.dropdown-btn').eq(i).addClass(colors[colori]);
		//Runs through the successive values of the line from localstorage.
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
	//On click of link classed as .delete-btn, the ligne is deleted from the localstorage, and we get visual feedback.
	$('body').on('click', '.delete-btn', function(event) {
		event.preventDefault();
		storage.deleteKey($(this).data('trend'));
		$(this).parent("article").remove();
	});
	//On click of link marked as .span-delete, the value of the corresponding ligne is deleted from the localstorage, and we get visual feedback.
	$('body').on('click', 'span.delete', function(event) {
		event.preventDefault();
		if (storage.deleteValueOfKey($(this).data('trend'), parseInt($(this).data('key')))) {
			$(this).parent().parent().parent().parent("article").remove();			
		}else{
			$(this).parent().parent(".inner-content").remove();
		}

	});
});