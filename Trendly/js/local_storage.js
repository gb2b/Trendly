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
		var newLocalStorage = new Array;
		newLocalStorage[datas.title] = datas; 
		if (actualLocalStorage != null) {
			newLocalStorage[datas.title].push(actualLocalStorage);
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