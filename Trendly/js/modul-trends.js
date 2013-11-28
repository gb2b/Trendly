var module = {
    defaults : {
        formu          : document.forms['search'],
        element        : document.querySelector("#trend"),
        trend          : document.querySelector(".titletrend"),
        clic           : false,
        cpt            : 0,
        compteur       : 0,
        opaque         : [1,0.9,0.8,0.7,0.6,0.5,0.4,0.3,0.2,0.1],
        start          : 0,
        positiondepart : [0,1,2,3,4,5,6],
        positionfin    : [4,4,5,6,8,8,9],
        width          : 520,
        height         : 520,
        cwidth         : 24,              
        stopAnimation  : function(element){ 
        },
        playAnimation  : function(element){
        
        }
    },
    init : function(options){
        this.params=$.extend(this.defaults,options);
    },
    startfunction : function(nombre, positiondepart){
        return positiondepart[nombre];
    },
    endfunction : function(nombre, positionfin){
        return positionfin[nombre];
    }
}
/*        function stopAnimation(element)
        {
          $(element).css("-webkit-animation-play-state", "paused");
            $(element).css("-moz-animation-play-state", "paused");
            $(element).css("-ms-animation-play-state", "paused");
            $(element).css("animation-play-state", "paused");
        }
        function playAnimation(element)
        {
            $(element).css("-webkit-animation-play-state", "running");
            $(element).css("-moz-animation-play-state", "running");
            $(element).css("-ms-animation-play-state", "running");
            $(element).css("animation-play-state", "running");
        }*/