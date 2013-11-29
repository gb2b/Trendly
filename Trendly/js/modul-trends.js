var module = {
    //Initialisation du module
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
    //envoie paramètres au d3js
    init : function(options){
        this.params=$.extend(this.defaults,options);
    },
    //Fonction pour l'aléatoire du début de l'arc
    startfunction : function(nombre, positiondepart){
        return positiondepart[nombre];
    },
    //Fonction pour l'aléatoire de la fin de l'arc
    endfunction : function(nombre, positionfin){
        return positionfin[nombre];
    }
}
