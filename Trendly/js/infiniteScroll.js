var scroll = {
    //Valeurs par défauts pour le scroll infini : On récupère le nombre d'actus actuel
      defaults : {
        trend       : "trend",
        nbactus     : 6,
        nbtweets    : 5,
        nbpics      : 4,
        nbvids      : 2,
        totaltweets : 30,
        totalactus  : 10,
        totalpics   : 10,
        totalvids   : 10,
        initializer : function(){},
        loading : function(){},
        endOfLoad : function(data){},
        noContent : function(){}
    },

    //Initilisation du scroll
    init : function(options){
        this.params=$.extend(this.defaults,options);
        this.params.initializer();
        $(window).data('ajaxready', true);
        $('.top-content a').tooltip({placement:'bottom'});
        $('a').tooltip({placement:'top'});
        return this;
    },

    //Chargement du content au scroll , avec ajax
    loadData : function(){
        var deviceAgent = navigator.userAgent.toLowerCase();
        var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
        var _this = this;
        //Si l'ajax est déjà en marche, on annule la recherche de data
        if ($(window).data('ajaxready') == false) return;
        
        // Dès qu'on arrive en bas de page, on active l'ajax
        if
            (
              ($(window).scrollTop() + window.innerHeight + 150 > $(document).height())
              || 
              (agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height())
              
              )
        {
            // S'ils existent encore du content affiché, on appel l'ajax
          if((this.params.nbtweets < this.params.totaltweets && this.params.nbtweets != 0) || (this.params.nbactus < this.params.totalactus && this.params.nbactus != 0) || (this.params.nbpics < this.params.totalpics && this.params.nbpics != 0) || (this.params.nbvids < this.params.totalvids && this.params.nbvids != 0) ){
                // lorsqu'on commence un traitement, on met ajaxready à false pour éviter un nouveau chargement au scroll
                $(window).data('ajaxready', false);
                this.params.loading();
                //Ajax
                $.post(
                    "scroll-content.php",
                    "&trend="+this.params.trend+"&nbactus="+this.params.nbactus+"&nbtweets="+this.params.nbtweets+"&nbpics="+this.params.nbpics+"&nbvids="+this.params.nbvids,
                    function(data, textStatus) {
                        if(textStatus == "success"){
                        // On affiche les datas reçues
                          _this.params.endOfLoad(data);
                          $(window).data('ajaxready', true);
                      }
                      
                  }
                  );
                //On augmente le nombre de content déjà affichés, pour le prochain chargement
                this.params.nbactus += this.params.nbactus; 
                this.params.nbpics  += this.params.nbpics;
                this.params.nbvids  += this.params.nbvids;
                if(this.params.nbactus > this.params.totalactus || this.params.nbactus ==0) this.params.nbtweets += 3;
            } else {
                //Si plus de content à afficher, on le signale
                this.params.noContent();
            }
        }
    }

}







