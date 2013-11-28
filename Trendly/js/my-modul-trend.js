       module.init({
            stopAnimation :  function() {
                //CSS property who doesn't work in stylesheet
                $(this.element).css("-webkit-animation-play-state", "paused");
                $(this.element).css("-moz-animation-play-state", "paused");
                $(this.element).css("-ms-animation-play-state", "paused");
                $(this.element).css("animation-play-state", "paused");
            },
            playAnimation : function() {
                $(this.element).css("-webkit-animation-play-state", "running");
                $(this.element).css("-moz-animation-play-state", "running");
                $(this.element).css("-ms-animation-play-state", "running");
                $(this.element).css("animation-play-state", "running");
            }
       });


        var p = Math.PI * 2;

        var color = d3.scale.ordinal()
                    .range(["#d43e3e","#e9da5b","#e9da5b","#29b947","#29b947","#29b947","#2980b9","#2980b9","#2980b9","#2980b9"]);

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
            .style("opacity", function(){module.params.compteur++;return module.params.opaque[module.params.compteur-1];})
            
            .on("mouseover", function(d,i,j){
                if(module.params.cpt==0){
                        d3.select(this).style("opacity", 1);
                        d3.select(this).style("cursor", "pointer");
                        var key = function(d,i) {
                            var map = d3.map(trends);
                            idkey = map.keys();
                            namekey = idkey[j];
                            return namekey;
                        };
                        var name = key(d,i,j);
                        module.params.element.value = name;
                        module.params.stopAnimation($(this).parent());
                }   
                //trend.innerHTML = name;
                //$("#trends-description").show();

                //arcAppear();
             })
            .on("mouseout", function(d,i,j){
                if(module.params.cpt==0){
                    d3.select(this).style("opacity", function(d,i){return module.params.opaque[j];});
                    d3.select(this).style("cursor", "default");

                    module.params.playAnimation($(this).parent());
                }
            })

            .on("click",function(d,i,j){
                 var key = function(d,i) {
                    var map = d3.map(trends);
                    idkey = map.keys();
                    namekey = idkey[j];
                    return namekey;
                };
                searchname = key(d,i,j);
                document.location.href="result.php?trend="+searchname; // Le contenu de la variable trend-> le trend est transmis dans l'url
            });


        load.style.display = "none" ;