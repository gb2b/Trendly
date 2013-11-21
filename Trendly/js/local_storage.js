var storage = {
	defaults : {
<<<<<<< HEAD
		nom : "key",
=======
>>>>>>> 01fb14ea46ab8299ae3963af68eda705f6f0a37e
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
<<<<<<< HEAD
		var datas = {};
		for(i in localStorage){
			datas.trend=localStorage.getItem(i);
		}
		return this;
	},
	record : function(datas){
		localStorage.setItem(this.params.nom,JSON.stringify(datas));
=======
		return this;
	},
	record : function(datas){
		localStorage.setItem(datas.date,JSON.stringify(datas));
>>>>>>> 01fb14ea46ab8299ae3963af68eda705f6f0a37e
		this.params.recorded.call(this,datas);
	}
}