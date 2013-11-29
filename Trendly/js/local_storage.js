var storage = {
	defaults : {
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	//'record' function saves the data in the local storage
	record : function(datas){
		//Fetches all data from datas.title and adds newLocalStorage
		var actualLocalStorage = $.parseJSON(this.getItem(datas.title));
		if (datas.title.length > 0) {
			var newLocalStorage = $.makeArray(actualLocalStorage);
		}else{
			var newLocalStorage = new Array;
		}
		//Adds all data passed as parameter to the newLocalStorage table.
		newLocalStorage.push(datas);
		//newLocalStorage est reparsé en JSON puis remplace le localstorage d'index datas.title
		localStorage.setItem(datas.title,JSON.stringify(newLocalStorage));
		this.params.recorded.call(this,datas);
	},
	//render pushes an array containing all the the data from the localstorage indexed as 'datas.title'
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
	//Deletes the value of a line from the localstorage indexed as datas.title
	deleteValueOfKey : function(title, key){
		//Reads the data from the localstorage sent back and deletes the value corresponding to datas.key.
		var actualLocalStorage = $.parseJSON(this.render(title));
		for (var i = 0; i < actualLocalStorage.length; i++) {
			if (actualLocalStorage[i].key == key) {
				actualLocalStorage.splice(i, 1);
			}
		}
		actualLocalStorage = $.makeArray(actualLocalStorage);
		//If there are no mo values in the localstorage line, the line as a whole is deleted.
		if (actualLocalStorage.length!=0) {
			localStorage.setItem(title,JSON.stringify(actualLocalStorage));
			return false;
		}else{
			this.deleteKey(title);
			return true;
		}
	},
	//Deletes a line from the localstorage
	deleteKey : function(title){
		localStorage.removeItem(title);
	},
	//Fetches a line from the localstorage depending on the name of the line
	getItem : function (title) {
		return localStorage.getItem(title);
	}
}