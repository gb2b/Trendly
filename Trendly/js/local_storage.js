var storage = {
	defaults : {
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	record : function(datas){
		var actualLocalStorage = $.parseJSON(this.getItem(datas));
		console.log(datas.title.length);
		if (datas.title.length > 0) {
			var newLocalStorage = datas.title;
			newLocalStorage.push($.makeArray(actualLocalStorage));
		}else{
			var newLocalStorage = new Array;
		}
		if (actualLocalStorage != null) {
			localStorage.setItem(datas.title,JSON.stringify(newLocalStorage));
		}else{
			localStorage.setItem(datas.title,JSON.stringify(datas));
		}
		this.params.recorded.call(this,datas);
	},
	getItem : function (datas) {
		return localStorage.getItem(datas.title);
	},
	checkout : function (key) {
		return localStorage.getItem(key);
	}
}