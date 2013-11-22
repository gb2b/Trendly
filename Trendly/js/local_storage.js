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
		this.params.counter = parseInt(this.checkMax())+1;
		if (this.checkValueExist(datas) == false) {
			localStorage.setItem(this.params.counter,JSON.stringify(datas));
		}
		this.params.recorded.call(this,datas);
	},
	checkMax : function () {
		var max = 0;
		for(i in localStorage){
			max++;
		}
		return max;
	},
	checkValueExist : function (datas) {
		var exist = false;
		var data = JSON.stringify(datas);
		for (i in localStorage) {
			if (localStorage.getItem(i) == data) {
				console.log(localStorage.getItem(i));
				console.log(data);
				exist = true;
			}
		}
		return exist;
	},
	checkout : function (key) {
		return localStorage.getItem(key);
	}
}