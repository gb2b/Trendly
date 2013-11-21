var storage = {
	defaults : {
		recorded : function(){}
	},
	init : function(options){
		this.params=$.extend(this.defaults,options);
		return this;
	},
	record : function(datas){
		localStorage.setItem(datas.date,JSON.stringify(datas));
		this.params.recorded.call(this,datas);
	}
}