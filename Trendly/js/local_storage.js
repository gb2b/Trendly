var storage = {
	defaults : {
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	//record function record datas in local storage
	record : function(datas){
		//récupération des données correspondante à datas.title et ajout newLocalStorage
		var actualLocalStorage = $.parseJSON(this.getItem(datas.title));
		if (datas.title.length > 0) {
			var newLocalStorage = $.makeArray(actualLocalStorage);
		}else{
			var newLocalStorage = new Array;
		}
		//ajout des datas passées en paramètre dans le tableau newLocalStorage
		newLocalStorage.push(datas);
		//newLocalStorage est reparsé en JSON puis remplace le localstorage d'index datas.title
		localStorage.setItem(datas.title,JSON.stringify(newLocalStorage));
		this.params.recorded.call(this,datas);
	},
	//render envoie un tableau contenant les données du localstorage d'index datas.title
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
	//Supprime une valeur d'une ligne du localstorage d'index datas.title
	deleteValueOfKey : function(title, key){
		//Analyse des données de la ligne du localstorage renvoyée et suppression de la valeur correspondante à datas.key
		var actualLocalStorage = $.parseJSON(this.render(title));
		for (var i = 0; i < actualLocalStorage.length; i++) {
			if (actualLocalStorage[i].key == key) {
				actualLocalStorage.splice(i, 1);
			}
		}
		actualLocalStorage = $.makeArray(actualLocalStorage);
		//Si il n'y a plus de valeur dans la ligne du localstorage, alors la ligne entière est supprimée.
		if (actualLocalStorage.length!=0) {
			localStorage.setItem(title,JSON.stringify(actualLocalStorage));
			return false;
		}else{
			this.deleteKey(title);
			return true;
		}
	},
	//Suppression d'une ligne du localstorage
	deleteKey : function(title){
		localStorage.removeItem(title);
	},
	//Récupération d'une ligne du localstorage en fonction du nom de la ligne
	getItem : function (title) {
		return localStorage.getItem(title);
	}
}