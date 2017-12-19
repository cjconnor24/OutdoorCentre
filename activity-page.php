<?php
include('includes/config.php');
include("includes/header.php");
?>

    <div id="full-size-map"></div>

    <div class="container nooverlap nohero">

        <!-- JS -->
        <script type="text/javascript">
            $(document).ready(function($) {

            });
        </script>


        <h1 class="heading">Activites</h1>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h2 class="heading">Sub-Heading</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h2 class="heading">Routes</h2>


        <?php

        //TODO: NOW THAT THIS ALL RESIDES IN DB - DON'T NEED TO CALL JSON
        // COULD REFACTOR TO CALLL DIRECTLY IN DB TO REDUCE ADDITIONAL STRAIN
        // ON SERVER BUILDER JSON TWICE FOR THIS PAGE

        if(isset($_GET['activity'])){
            $activity = $_GET['activity'];
        } else {
            $activity = 5;
        }

        include('includes/config.php');
        $url = $localurl."/routes/get-routes.php?activity=$activity";
        $ch = curl_init();

        // SETUP THE CURL REQUEST
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // GET THE RESULT
        $result = curl_exec($ch);
        $json = json_decode($result);

        // LOOP THROUGH THE FEATURES
        foreach($json->{'features'} as $walk) {

        // MAKE SURE LINE STRING AND NOT POINT
        if ($walk->{'geometry'}->{'type'} == "LineString") {

        // GET PROPERTIES
        $props = $walk->{'properties'};

        // GET AVERAGE LATLONG ON THE ROUTE FOR THE WEATHER
        $totalplots = count(($walk->{'geometry'}->{'coordinates'}));
        $middle = floor($totalplots/2);
        $latlong = $walk->{'geometry'}->{'coordinates'}[$middle];

        ?>
        <div class="route" id="route-<?php echo $props->{'routeid'}; ?>">

            <div class="route__map"></div>

            <div class="route__info">
                <h3 class="route__name"><?php echo $props->{'name'}; ?></h3>
                <p class="route__description"><?php echo $props->{'description'}; ?></p>

                <h3>Route Statistics</h3>
                <div class="route__info__stats">
                    <table>
                        <tr>
                            <td>Difficulty</td>
                            <td><?php echo $props->{'difficulty'}; ?></td>
                        </tr>
                        <tr>
                            <td>Distance</td>
                            <td><?php echo round($props->{'distance'},2); ?>km</td>
                        </tr>
                    </table>
                </div>

                <p><a href="#" data-long="<?php echo $latlong[0];?>" data-lat="<?php echo $latlong[1];?>" class="btn btn-orng check-weather"><i class="fa fa-cloud"></i> Check Weather</a> <a href="#" class="btn btn-orng"><i class="fa fa-map-marker"></i> View Route on Map</a></p>

            </div>

        </div>

        <?php
        } // END IF
        } // END LOOP
        ?>

    <script type="text/javascript">

        $(document).ready(function() {

            function getWeatherData(lat,long) {

                var apikey  = "<?php echo $weatherapi;?>";

                //weather or forecase
                var apiurl = 'https://api.openweathermap.org/data/2.5/forecast?lat='+lat+'&lon='+long+'&APPID='+apikey+'&mode=json&units=metric';

                var weatherData = [];

                $.get(apiurl,function(resp){

                    // DO NOTHING AND PASS TO CALLBACK

                },'json').done(receiver); // RUN THE CALLBACK FUNCTION


            }

            // CALL BACK FUNCTION
            function receiver(data, textStatus, XMLHttpRequest) {

                var weatherData = [];

                $("#weather-box").html('');

                // LOOP THROUGH THE RESULTS
                $(data.list).each(function(key,val) {

                    // GET THE DATE FROM THE CURRENT
                    var weatherdate = new Date(val.dt * 1000);

                    console.log(val);

                    // BUILD AN OBJECT
                    var weatherRow = {
                        datetime: val.dt * 1000,
                        stringdatetime: weatherdate.getFullYear() + '-' + weatherdate.getMonth() + '-' + weatherdate.getDate() + ' ' + weatherdate.getHours() + ':' + weatherdate.getMinutes(),
                        temp: val.main.temp,
                        wind: {
                            direction: val.wind.deg,
                            speed: val.wind.speed
                        },
                        description: val.weather[0].description,
                        icon: val.weather[0].icon

                    }

                    // ATTACH TO ARRAY
                    weatherData.push(weatherRow);

                });


//                var tstring = '<table>'
                var days = ["Sunday",'Mondy','Tuesday','Wednesday','Thursday','Friday','Satuday'];

                var table = $("<table class='accordion-content default'></table>");
                var thead = $("<thead><th>SYMBOL</th><th>TIME</th><th>TEMPERATURE</th><th>WIND SPEED</th><th>WIND DIRECTION</th><th class='hide'>OVERVIEW</th></thead>");
                var tbody = $("<tbody></tbody>");

                var curtime = new Date();
                var d = curtime.getDate();

                $('<h2 class="accordion-toggle"></h2>').text(days[curtime.getDay()]).appendTo('#weather-box');


                // LOOP AND BUILD TABLE
                    for(i = 0; i < weatherData.length; i++){

                        var weatherDate = new Date(weatherData[i].datetime);

                        console.log(weatherDate);

                        if(weatherDate.getDate()!=d){

                            thead.appendTo(table);
                            tbody.appendTo(table);

                            $('#weather-box').append(table);

                            $('<h2></h2>').text(days[weatherDate.getDay()]).appendTo('#weather-box');


                            table = $("<table></table>");
                            thead = $("<thead><th>SYMBOL</th><th>TIME</th><th>TEMPERATURE</th><th>WIND SPEED</th><th>WIND DIRECTION</th><th class='hide'>OVERVIEW</th></thead>");
                            tbody = $("<tbody></tbody>");

//                            tstring += '</table>';
//                            tstring += '<table style="width:100%">';
//                            tstring += "<thead>";
//                            tstring += "<tr>";
//                            tstring += "<th>"+days[weatherDate.getDay()]+"</th>";
//                            tstring += "<th>DATETIME</th>";
//                            tstring += "<th>Temperature</th>";
//                            tstring += "<th>Wind Speed</th>";
//                            tstring += "<th>Description</th>";
//                            tstring += "</thead>";

                            d = weatherDate.getDate();

                        }

                        var trow = $("<tr>");

                        var iconcell = $("<td></td>");
                        var iconurl = 'http://openweathermap.org/img/w/'+weatherData[i].icon+'.png';
                        var icon = $("<img>").attr("src",iconurl);
                        icon.appendTo(iconcell);
                        iconcell.appendTo(trow);

                        $("<td></td>").text(('0' + (weatherDate.getHours()+1)).slice(-2)+'00').appendTo(trow);
                        $("<td></td>").html(Math.round(weatherData[i].temp)+'&#8451;').appendTo(trow);
                        $("<td></td>").text(Math.round(weatherData[i].wind.speed)+' kmph').appendTo(trow);
                        $("<td></td>").text(weatherData[i].wind.speed+' degrees').appendTo(trow);
                        $("<td class='hide'></td>").text(weatherData[i].description).appendTo(trow);


                        // APPEND THE ROW TO THE BODY
                        trow.appendTo(tbody);

                    }

                // BUILD THE REMAINING ELEMENTS
                thead.appendTo(table);
                tbody.appendTo(table);


                // UPDATE THE TABLE
                $('#weather-box').append(table);

                $('body').addClass('noscrolling');


                $('.loading-box').slideUp('slow',function(){
                    $('#weather-box').slideDown('slow');
                })

            }

            // CLOSE THE OVERLAY
            $('#close-weather').click(function(){
                $('body').removeClass('noscrolling');
                $('#overlay').fadeOut('fast');
            })


            // WHEN WEATHER BUTTON CLICKED
            $(".check-weather").click(function (e) {

                e.preventDefault();

                $('#overlay').fadeIn('fast');

                // GET THE LAT AND LONG
                var lat = $(this).attr("data-lat");
                var long = $(this).attr("data-long");

                // GET THE WEATHER
                var weatherdata = getWeatherData(lat,long);

                // TODO: THE CALLBACKS ON THIS ARE A RIOT...WILL SORT ORDER IF GET TIME

            });

        });
    </script>

    <script>
        // INITIALISE THE MAP
        function initMap() {

            var lochlomond = {lat: 56.085865, lng: -4.548176};
            var map = new google.maps.Map(document.getElementById('full-size-map'), {
                zoom: 14,
                center: lochlomond,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: true,
                streetViewControl: false,
                rotateControl: true,
                fullscreenControl: true
//                mapTypeId: 'terrain'
            });

            // LOAD IN THE ROUTES FROM GEOJSON
//            map.data.loadGeoJson('/routes/larger-geojson.json');

            map.data.loadGeoJson('/routes/get-routes.php?activity=<?php echo $activity;?>');

//            http://outdoor.localhost

            // CREATE AN INFO WINDOW TO WORK WITH
            var infowindow = new google.maps.InfoWindow();

            // WHEN USER CLICKS ROUTE
            map.data.addListener('click', function(event) {

                // ZOOM FIRST
                var bounds = new google.maps.LatLngBounds();
                processPoints(event.feature.getGeometry(), bounds.extend, bounds);
                map.fitBounds(bounds);

                // MAKE SURE ISNT A POINT BEFORE CALULCATING DISTANCE
                if(!(event.feature.getGeometry() instanceof google.maps.Data.Point)) {

                    // GET THE DISTANCE OF THE ROUTE - OMG THIS TOOK A WHILE
                    var distance = google.maps.geometry.spherical.computeLength(event.feature.getGeometry().getArray());
                    var distancekm = distance / 1000;
                    var distancemiles = distance * 0.000621371;

                    console.log("DISTANCE IN MILES: " + distancemiles);
                    console.log("DISTANCE IN METERS: " + distance);
                    console.log("DISTANCE IN KMS: " + distancekm);

                }

                var myHTML = event.feature.getProperty("name");
                var routeID = event.feature.getProperty("routeid");
                infowindow.setContent(generateContent(myHTML,(distancekm ? distancekm : ''),routeID));
                // position the infowindow on the marker
//                infowindow.setPosition(event.feature.getGeometry());
                infowindow.setPosition(event.latLng);

                // anchor the infowindow on the marker
                infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
                infowindow.open(map);
            });

            // ZOOM TO SHOW ALL THE ROUTES
            var bounds = new google.maps.LatLngBounds();
            map.data.addListener('addfeature', function(e) {
                processPoints(e.feature.getGeometry(), bounds.extend, bounds);
                map.fitBounds(bounds);
            });


            // MOUSE OVER MAKE STROKE THICK
            map.data.addListener('mouseover', function(event) {
                map.data.revertStyle();
                map.data.overrideStyle(event.feature, {strokeWeight: 8});

            });

            map.data.addListener('mouseout', function(event) {
                map.data.revertStyle();
            });

            // GET STROKE COLOR FROM GEOJSON
            map.data.setStyle(function(feature) {

//                if((feature.getGeometry() instanceof google.maps.Data.Point)) {
//                    console.log("THIS ONE WAS A POINT");
//                }

                    var color = feature.getProperty('stroke');

                return {
                    strokeColor: color
                };
            });

        }

        //CREATE INFO WINDOW FOR ROUTE
        function createInfoWindow(poly, content) {

            google.maps.event.addListener(poly, 'click', function(event) {
                // infowindow.content = content;
                infowindow.setContent(content);

                // infowindow.position = event.latLng;
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });
        }

        // FUNCTION TO CALCULATE THE BOUNDS OF THE ROUTE FOR ZOOMING
        function processPoints(geometry, callback, thisArg) {

            if (geometry instanceof google.maps.LatLng) {

                callback.call(thisArg, geometry);

            } else if (geometry instanceof google.maps.Data.Point) {

                callback.call(thisArg, geometry.get());

            } else {

                geometry.getArray().forEach(function(g) {
                    processPoints(g, callback, thisArg);
                });
            }
        }

        // BUILD THE CONTENT FOR THE WINDOW
        function generateContent(title,body,routeid){

            var contentstring = "";
            contentstring+= "<div class='map-info-window'>";
            contentstring+= "<h1>"+title+routeid+"</h1>";
            contentstring+= "<p>Here is some info on the route</p>";
            contentstring+= "<p>"+body+"</p>";
            contentstring+= "<p><a href='#route-"+routeid+"' id='weatherButton' class='btn btn-orng'><i class='fa fa-eye'></i> View Route Data</a></p>";
            contentstring+= "</div>";

            return contentstring;
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&callback=initMap&libraries=geometry">
    </script>

    </div>



<?php
include("includes/footer.php");
