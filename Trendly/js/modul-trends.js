       

        var formu = document.forms['search'];
        var element = formu.elements['trend'];
        var trend = document.querySelector(".titletrend");
        var clic = false;
        var cpt = 0;


        var compteur = 0;
        var opaque = [1,0.9,0.8,0.7,0.6,0.5,0.4,0.3,0.2,0.1];
        

        var start = 0;


        function stopAnimation(element)
        {
/*          $(element).css("-webkit-animation-play-state", "paused");
            $(element).css("-moz-animation-play-state", "paused");
            $(element).css("-ms-animation-play-state", "paused");
            $(element).css("animation-play-state", "paused");*/
            $(element).addClass('stopAnimation').removeClass('playAnimation');
        }
        function playAnimation(element)
        {
/*            $(element).css("-webkit-animation-play-state", "running");
            $(element).css("-moz-animation-play-state", "running");
            $(element).css("-ms-animation-play-state", "running");
            $(element).css("animation-play-state", "running");*/
            $(element).addClass('playAnimation').removeClass('stopAnimation');
        }

        var startfunction= function(nombre){
          var positiondepart = [0,1,2,3,4,5,6];
          return positiondepart[nombre];
        }

        var endfunction = function(nombre){
          var positionfin = [4,4,5,6,8,8,9];
          return positionfin[nombre];
        }

        var width = 520,
            height = 520,
            cwidth = 24;

        var p = Math.PI * 2;

        var color = d3.scale.ordinal()
                    .range(["#d43e3e","#e9da5b","#e9da5b","#29b947","#29b947","#29b947","#2980b9","#2980b9","#2980b9","#2980b9"]);

        var pie = d3.layout.pie()
            .sort(null);

        var arc = d3.svg.arc();


        var svg = d3.select("#module").append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

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
              start=Math.floor(Math.random()*7);
              return arc.startAngle(startfunction(start))
                      .endAngle(endfunction(start))
                      .innerRadius(function(){
                          if(j===0){
                            return 40+cwidth*(j);
                          } 
                          else {return 40+cwidth*j;}
                      })
                      .outerRadius(cwidth*(j+1))(d)
            })
            .style("opacity", function(){compteur++;return opaque[compteur-1];})
            
            .on("mouseover", function(d,i,j){
                if(cpt==0){
                        d3.select(this).style("opacity", 1);
                        d3.select(this).style("cursor", "pointer");
                        var key = function(d,i) {
                            var map = d3.map(trends);
                            idkey = map.keys();
                            namekey = idkey[j];
                            return namekey;
                        };
                        var name = key(d,i,j);
                        element.value = name;
                       
                       stopAnimation($(this).parent());
                }   
                //trend.innerHTML = name;
                //$("#trends-description").show();

                //arcAppear();
             })
            .on("mouseout", function(d,i,j){
                if(cpt==0){
                    d3.select(this).style("opacity", function(d,i){return opaque[j];});
                    d3.select(this).style("cursor", "default");

                    playAnimation($(this).parent());
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