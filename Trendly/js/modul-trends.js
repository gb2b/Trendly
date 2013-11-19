       

        var formu = document.forms['search'];
        var element = formu.elements['trend'];
        var trend = document.querySelector(".titletrend");

        function submit(event){
          formu.submit();
        }


        var compteur = 0;
        var opaque = [1,0.9,0.8,0.7,0.6,0.5,0.4,0.3,0.2,0.1];
        

        var start = 0;


        function stopAnimation(element)
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
        }

        var startfunction= function(nombre){
          var positiondepart = [0,1,2,3,4,5,6];
          return positiondepart[nombre];
        }

        var endfunction = function(nombre){
          var positionfin = [3,4,5,6,7,8,9];
          return positionfin[nombre];
        }

        var width = 520,
            height = 520,
            cwidth = 24;

        var p = Math.PI * 2;

        var color = d3.scale.ordinal()
                    .range(["#DF6C4F","#ECD06F","#ECD06F","#00A651","#00A651","#00A651","#1A99AA","#1A99AA","#1A99AA","#1A99AA"]);

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
               var arcs = document.querySelectorAll('.arc');
                for (var l = 0; l < arcs.length; l++) {
                  stopAnimation(arcs[l]);
                }
                //trend.innerHTML = name;
                //$("#trends-description").show();

                //arcAppear();
             })
            .on("mouseout", function(d,i,j){
                d3.select(this).style("opacity", function(d,i){return opaque[j];});
                d3.select(this).style("cursor", "default");
                var arcs = document.querySelectorAll('.arc');
                for (var l = 0; l < arcs.length; l++) {
                  playAnimation(arcs[l]);
                  
                }
                //$("#trends-description").hide();

                //arcDisappear();

            })
            .on("click",function(d,i,j){
                 var key = function(d,i) {
                    var map = d3.map(trends);
                    idkey = map.keys();
                    namekey = idkey[j];
                    return namekey;
                };
                
                searchname = key(d,i,j);
                document.location.href="result.php?trend="+searchname; // Le contenu de la variable s -> le trend est transmis dans l'url
            });
        /* 
        var arcTest = d3.svg.arc()
            .startAngle(0)
            .endAngle(p-2)
            .innerRadius(520-80)
            .outerRadius(520);

        var canvas = d3.select('#trends-desc').append("svg")
            .attr("width", 800)
            .attr("height", 800)
            .append("path")
            .attr("d",arcTest)
            .attr("fill", "white");

        //Make an SVG Container
        var svgContainer = d3.select("#trends-desc").append("svg")
            .attr("width", 100)
            .attr("height", 100);

        //Draw the Circle
        var circle = svgContainer.append("circle")
            .attr("cx", 30)
            .attr("cy", 30)
            .attr("r", 20)
            .attr("fill","red");
        

        function arcAppear(){
            canvas.attr("visibility", "visible");
        }

        function arcDisappear(){
            canvas.attr("visibility", "hidden");
        }
        */

        load.style.display = "none" ;