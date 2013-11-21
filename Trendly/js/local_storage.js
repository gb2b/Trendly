var storage = {
	defaults : {
		nom : "key",
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		var datas = {};
		for(i in localStorage){
			datas.trend=localStorage.getItem(i);
		}
		return this;
	},
	record : function(datas){
		localStorage.setItem(this.params.nom,JSON.stringify(datas));
		this.params.recorded.call(this,datas);
	}
}