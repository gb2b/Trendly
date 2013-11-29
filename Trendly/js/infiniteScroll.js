var scroll = {
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
        initializer : function(){
          $("#content").append('<div id="loadergif"><img src="css/img/ajax-loader.gif" alt="loader ajax"></div>');
          $('#content').append('<div id="nocontent"><img src="css/asset/nocontent-logo.png" alt="No Content"/><p>Il n\'y a plus de contenu à afficher !</p></div>');
        },
        loading : function(){
            $('#loadergif').fadeIn(400);
        },
        endOfLoad : function(data){
            $('#loadergif').before(data);
            $('.hidden').fadeIn(400);
            $('#loadergif').fadeOut(400);
        },
        noContent : function(){
            $('#nocontent').fadeIn(400);
        }
    },

    init : function(options){
        this.params=$.extend(this.defaults,options);
        this.params.initializer();
        $(window).data('ajaxready', true);
        $('.top-content a').tooltip({placement:'bottom'});
        $('a').tooltip({placement:'top'});
        return this;
    },

    loadData : function(){
        var deviceAgent = navigator.userAgent.toLowerCase();
        var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
        var _this = this;
        if ($(window).data('ajaxready') == false) return;
        
        if
            (
              ($(window).scrollTop() + window.innerHeight + 150 > $(document).height())
              || 
              (agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height())
              
              )
        {
          if((this.params.nbtweets < this.params.totaltweets && this.params.nbtweets != 0) || (this.params.nbactus < this.params.totalactus && this.params.nbactus != 0) || (this.params.nbpics < this.params.totalpics && this.params.nbpics != 0) || (this.params.nbvids < this.params.totalvids && this.params.nbvids != 0) ){
                // lorsqu'on commence un traitement, on met ajaxready à false
                $(window).data('ajaxready', false);
                this.params.loading();
                $.post(
                    "scroll-content.php",
                    "&trend="+this.params.trend+"&nbactus="+this.params.nbactus+"&nbtweets="+this.params.nbtweets+"&nbpics="+this.params.nbpics+"&nbvids="+this.params.nbvids,
                    function(data, textStatus) {
                        if(textStatus == "success"){
                            console.log(this);
                          _this.params.endOfLoad(data);
                          $(window).data('ajaxready', true);
                      }
                      
                  }
                  );
                this.params.nbactus += this.params.nbactus; 
                this.params.nbpics  += this.params.nbpics;
                this.params.nbvids  += this.params.nbvids;
                if(this.params.nbactus > this.params.totalactus || this.params.nbactus ==0) this.params.nbtweets += 3;
            } else {
                this.params.noContent();
            }
        }
    }

}







