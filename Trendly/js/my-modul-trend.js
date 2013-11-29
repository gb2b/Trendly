       module.init({
            //Arrêt de l'animation sur les arcs
            stopAnimation :  function(element) {
                //CSS property who doesn't work in stylesheet
                $(element).css("-webkit-animation-play-state", "paused");
                $(element).css("-moz-animation-play-state", "paused");
                $(element).css("-ms-animation-play-state", "paused");
                $(element).css("animation-play-state", "paused");
            },
            playAnimation : function(element) {
                $(element).css("-webkit-animation-play-state", "running");
                $(element).css("-moz-animation-play-state", "running");
                $(element).css("-ms-animation-play-state", "running");
                $(element).css("animation-play-state", "running");
            }
       });


        var p = Math.PI * 2;

        //color pour chaque arc
        var color = d3.scale.ordinal()
                    .range(["#d43e3e","#e9da5b","#e9da5b","#29b947","#29b947","#29b947","#2980b9","#2980b9","#2980b9","#2980b9"]);

        //Initialisation de d3js
        var pie = d3.layout.pie()
            .sort(null);

        var arc = d3.svg.arc();

        var svg = d3.select("#module").append("svg")
            .attr("width", module.params.width)
            .attr("height", module.params.height)
            .append("g")
            .attr("transform", "translate(" + module.params.width / 2 + "," + module.params.height / 2 + ")");

        var gs = svg.selectAll("g")
            .data(d3.values(trends))
            .enter()
            .append("g")
            .attr("class", "arc");
          
       
        var path = gs.selectAll("path")
            .data(function(d) { return pie(d); })
            .enter().append("path")
            
            .attr("fill", function(d, i,j) { return color(j); })

            .attr("d", function(d, i, j) { 
                //Don't work in object
                //Créer l'arc avec un début et une fin, ainsi qu'une grosseur
              start=Math.floor(Math.random()*7);
              return arc.startAngle(module.startfunction(start, module.params.positiondepart))
                      .endAngle(module.endfunction(start, module.params.positionfin))
                      .innerRadius(function(){
                          if(j===0){
                            return 40+module.params.cwidth*(j);
                          } 
                          else {return 40+module.params.cwidth*j;}
                      })
                      .outerRadius(module.params.cwidth*(j+1))(d)
            })
            //Ajout d'une opacity pour chaque arc
            .style("opacity", function(){module.params.compteur++;return module.params.opaque[module.params.compteur-1];})
            
            //Instructions au mouseover sur un arc
            .on("mouseover", function(d,i,j){
                if(module.params.cpt==0){
                        d3.select(this).style("opacity", 1);
                        d3.select(this).style("cursor", "pointer");
                        var key = function(d,i) {
                            //Fonction pour récupérer le trend
                            var map = d3.map(trends);
                            idkey = map.keys();
                            namekey = idkey[j];
                            return namekey;
                        };
                        var name = key(d,i,j);
                        //Affiche trend dans le champs de recherche
                        module.params.element.value = name;
                        //Stop l'animation sur l'arc
                        module.params.stopAnimation($(this).parent());
                }   
             })
            //Instructions au mouseout
            .on("mouseout", function(d,i,j){
                if(module.params.cpt==0){
                    d3.select(this).style("opacity", function(d,i){return module.params.opaque[j];});
                    d3.select(this).style("cursor", "default");

                    module.params.playAnimation($(this).parent());
                }
            })
            //Instructions au clic
            .on("click",function(d,i,j){
                 var key = function(d,i) {
                    var map = d3.map(trends);
                    idkey = map.keys();
                    namekey = idkey[j];
                    return namekey;
                };
                searchname = key(d,i,j);
                //Renvoie l'utilisateur sur la page de résultats pour le trend
                document.location.href="result.php?trend="+searchname; 
            });

        //On enlève le loader une fois que le module apparaît
        load.style.display = "none" ;