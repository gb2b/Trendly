var storage = {
	defaults : {
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	record : function(datas){
		var actualLocalStorage = $.parseJSON(this.getItem(datas.title));
		if (datas.title.length > 0) {
			var newLocalStorage = $.makeArray(actualLocalStorage);
		}else{
			var newLocalStorage = new Array;
		}
		newLocalStorage.push(datas);
		localStorage.setItem(datas.title,JSON.stringify(newLocalStorage));
		this.params.recorded.call(this,datas);
	},
	render : function (title){
		var datas = new Array();
		if (title != null) {
			datas.push($.makeArray(localStorage.getItem(title)));
		}else{
			for(i in localStorage){
				datas.push($.makeArray(localStorage.getItem(i)));
			}
		}
		return datas;
	},
	deleteValueOfKey : function(title, key){
		var actualLocalStorage = $.parseJSON(this.render(title));
		for (var i = 0; i < actualLocalStorage.length; i++) {
			if (actualLocalStorage[i].key == key) {
				actualLocalStorage.splice(i, 1);
			}
		}
		actualLocalStorage = $.makeArray(actualLocalStorage);
		if (actualLocalStorage.length!=0) {
			localStorage.setItem(title,JSON.stringify(actualLocalStorage));
			return false;
		}else{
			localStorage.removeItem(title);
			return true;
		}
	},
	deleteKey : function(title){
		localStorage.removeItem(title);
	},
	getItem : function (title) {
		return localStorage.getItem(title);
	}
}