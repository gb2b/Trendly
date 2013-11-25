var storage = {
	defaults : {
		nom : "key",
		recorded : function(){},
		counter : 0
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	record : function(datas){
		var actualLocalStorage = $.parseJSON(this.getItem(datas));
		console.log(datas.title.length);
		if (datas.title.length > 0) {
			var newLocalStorage = $.makeArray(actualLocalStorage);
		}else{
			var newLocalStorage = new Array;
		}
		newLocalStorage.push(datas);
		if (actualLocalStorage != null) {
			localStorage.setItem(datas.title,JSON.stringify(newLocalStorage));
		}else{
			localStorage.setItem(datas.title,JSON.stringify(datas));
		}
		this.getItem(datas);
		this.params.recorded.call(this,datas);
	},
	getItem : function (datas) {
		return localStorage.getItem(datas.title);
	},
	checkout : function (key) {
		return localStorage.getItem(key);
	}
}