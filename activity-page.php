<?php
include('includes/config.php');
include("includes/header.php");

// TODO: HOOK UP CATGOERIES TO DB
// TODO: CHECK WEATHER - ADD SUNRISE SUNSET
?>

    <div id="full-size-map"></div>

    <div class="container nooverlap nohero">

        <!-- JS -->
        <script type="text/javascript">
            $(document).ready(function($) {

            });
        </script>

        <p><a href="/activity.php" class="btn-back btn btn-small btn-orng"><i class="fa fa-arrow-left"></i> Return to Activity Listings</a></p>

        <h1 class="heading">Activites</h1>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <div class="row">

            <div class="col-6">
            <h2 class="heading">Upcoming Courses</h2>

                <?php

                // FUNCTION FOR GETTING CACHED WEATHER FILE NAME
                function get_weather_json_name($lat, $long){

                    $nlat = round($lat,2);
                    $nlong = round($long,2);

                    $fn = $nlat."_".$nlong;
                    $fn = str_replace("-","",$fn);
                    $fn = str_replace(".","-",$fn);

                    $path = 'cache/weather/';
                    return $path.$fn.".json";


                }

                if(isset($_GET['activity'])){
                    $activity = $_GET['activity'];
                } else {
                    $activity = 5;
                }

                include('includes/dbConnect.php');
                $query = $conn->prepare("SELECT * FROM course WHERE activity=:activity AND datetime > NOW();");
                $query->bindParam(":activity",$activity);
                $query->execute();
                $count = $query->rowCount();

                if($count > 0) {

                    $results = $query->fetchAll(PDO::FETCH_ASSOC);

                    echo "<p>Below are a list of upcoming course. Click the course for more information.</p>";


                ?>
                <div class="accordion">
                    <?php
                    foreach($results as $course) {
                        $i = 0;
                        $date = strtotime($course['datetime']);
                        ?>
                        <div class="accordion-toggle"><?php echo $course['name'];?><span><i class="fa fa-calendar-o"></i> <?php echo date("jS F Y ha",$date);?></span></div>
                        <div class="accordion-content <?php echo ($i=0 ? 'default' : '');?>">
                            <p><?php echo $course['description'];?></p>
                            <p><a href="/contact.php" class="btn btn-orng"><i class="fa fa-pencil-square-o"></i> Sign Up</a></p>
                        </div>
                        <?php
                        $i++;
                    } // END FOR EACH
                    ?>
                </div>
                    <?php
                    // IF NO COURSES...
                    } else {
                    echo "<p><em>There are no upcoming courses for this activity.</em></p>";
                    }
                    ?>

                <script type="text/javascript" src="/js/accordian.js"></script>

            </div>

            <div class="col-6">
            <h2 class="heading">Sub-Heading</h2>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
            </div>


        </div>

        <h2 class="heading">Routes</h2>

        <div class="row route-row">
        <?php

        include('includes/dbConnect.php');


        //TODO: NOW THAT THIS ALL RESIDES IN DB - DON'T NEED TO CALL JSON
        // COULD REFACTOR TO CALLL DIRECTLY IN DB TO REDUCE ADDITIONAL STRAIN
        // ON SERVER BUILDER JSON TWICE FOR THIS PAGE



        include('includes/config.php');
        $url = $localurl."/routes/get-routes.php?activity=$activity";
        $ch = curl_init();

        // SETUP THE CURL REQUEST
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        // GET THE RESULT
        $result = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($result);

        $i = 1;

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

            <?php

            // GET WEATHER AND OUTPUT
            $weatherfilepath = get_weather_json_name($latlong[0], $latlong[1]);

            // CHECK IF THERE IS ALREADY A CACHED FILE FOR THIS LOCATION
            if(file_exists($weatherfilepath))

                // CHECK THE AGE OF THE FILE
                $weatherfilemodified = filemtime($weatherfilepath);
                $timethreshold = (60*30);
                $timedifference = time() - $weatherfilemodified;

                if($timedifference > $timethreshold) {

                    //
                    $url = "http://api.openweathermap.org/data/2.5/weather?lat=" . $latlong[1] . "&lon=" . $latlong[0] . "&appid=" . $weatherapi."&units=metric";
                    $ch = curl_init();

                    // SETUP THE CURL REQUEST
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // GET THE RESULT
                    $result = curl_exec($ch);
                    $json = json_decode($result);


                    // WRITE TO FILE
                    $fn = $weatherfilepath;
                    $file = fopen($fn,'w');
                    fwrite($file,$result);
                    fclose($file);
                    curl_close($ch);

                } else {

                    $result = file_get_contents($weatherfilepath);
                    $json = json_decode($result);

                }

            //EXTRACT THE WEATHER VARIABLES REQUIRED
            $weather = array();
            $weather['id'] = intval($json->weather[0]->id);
            $weather['hi'] = $json->main->temp_max;
            $weather['low'] = $json->main->temp_min;
            $weather['sunrise'] = $json->sys->sunrise;
            $weather['sunset'] = $json->sys->sunset;
            $weather['icon'] = $json->weather[0]->icon;
            $weather['description'] = $json->weather[0]->description;

            // IMPORT ARRAY FOR WEATHER ICON CODES
            include('includes/weather.php');
            $weathericon = (!($weather['id'] > 699 && $weather['id'] < 800) && !($weather['id'] > 899 && $weather['id']< 1000) ? 'day-' : '').$weathericons[$weather['id']]['icon'];
            ?>
            <div class="route__weather">
                <div class="route_weather_container">
                    <h3>Current Weather</h3>

                <div class="route__weather__sun">
                    <p> <i class="wi wi-sunrise"></i> <?php echo date('H:m',$weather['sunrise']);?> <i class="wi wi-sunset"></i> <?php echo date('H:m',$weather['sunset']);?></p>
                </div>

                <div class="route__weather__icon">
                    <i class="main-icon wi wi-<?php echo $weathericon;?>"></i>
                </div>


                    <div class="route__weather__description">
                        <p><?php echo ucwords($weather['description']);?></p>
                    </div>

                <div class="route__weather__temp">
                    <p><i class="wi wi-thermometer-exterior"></i> Low <?php echo $weather['low'];?>&#8451;  <i class="wi wi-thermometer"></i> High <?php echo $weather['hi'];?>&#8451;</p>

                </div>
                </div>
            </div>

            <div class="spacer"></div>
            <!-- ROUTE INFO SECTION -->
            <div class="route__info">

                <h3 class="route__name"><?php echo $props->{'name'}; ?></h3>
                <p class="route__description"><?php echo $props->{'description'}; ?></p>

                <h3>Route Statistics</h3>
                <div class="route__info__stats">
                    <table>
                        <tr>
                            <td><strong>Difficulty</strong></td>
                            <td><?php echo $props->{'difficulty'}; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Distance</strong></td>
                            <td><?php echo round($props->{'distance'},2); ?>km</td>
                        </tr>
                    </table>
                </div>

                <a href="#" data-long="<?php echo $latlong[0];?>" data-lat="<?php echo $latlong[1];?>" class="btn btn-orng check-weather"><i class="fa fa-cloud"></i> Five Day Forecast</a> <a href="#" class="btn btn-orng"><i class="fa fa-map-marker"></i> View Route on Map</a>

            </div>


        </div>

        <?php

            if($i%2==0){
                echo "</div><div class='row route-row'>";
            }

            $i++; // INCREMENT COUNTER SO I CAN IMPLEMENT THE ROWS

        } // END IF
        } // END LOOP
        ?>
        </div>

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

                var table = $("<table></table>");
                var thead = $("<thead><th>SYMBOL</th><th>TIME</th><th>TEMPERATURE</th><th>WIND SPEED</th><th>WIND DIRECTION</th><th class='hide'>OVERVIEW</th></thead>");
                var tbody = $("<tbody></tbody>");

                var curtime = new Date();
                var d = curtime.getDate();

                $('<h2></h2>').text(days[curtime.getDay()]).appendTo('#weather-box');


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

                    // WIND DIRECTION
                    var winddir = $("<td></td>").text(Math.round(weatherData[i].wind.direction)+' degrees ').appendTo(trow);

                    // BUILD THE ICON AND ROTATE TO SUIT THE ANGLE OF THE WIND
                    $("<i class='fa fa-arrow-circle-up'></i>").css({ WebkitTransform: 'rotate(' + Math.round(weatherData[i].wind.direction) + 'deg)'}).css('color','#e17645').css('font-size','1.5em').appendTo(winddir);
                    winddir.appendTo(trow);

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

        // INTIALISE WITH JQUERY INSTEAD OF CALLBACK
        $(function(){

            // ENCAPSULATING IN FUNCTION SO AS TO CALL FROM GOOGLE MAPS ALSO
            function enableSmooth() {

                $('a[href*="#"]')
                // Remove links that don't actually link to anything
                    .not('[href="#"]')
                    .not('[href="#0"]')
                    .click(function (event) {
                        // On-page links
                        if (
                            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                            &&
                            location.hostname == this.hostname
                        ) {
                            // Figure out element to scroll to
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            // Does a scroll target exist?
                            if (target.length) {
                                // Only prevent default if animation is actually gonna happen
                                event.preventDefault();
                                $('html, body').animate({
                                    scrollTop: target.offset().top - 200
                                }, 1000, function () {
                                    // Callback after animation
                                    // Must change focus!
                                    var $target = $(target);
                                    $target.focus();
                                    if ($target.is(":focus")) { // Checking if the target was focused
                                        return false;
                                    } else {
                                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                        $target.focus(); // Set focus again
                                    }
                                    ;
                                });
                            }
                        }
                    });

            }

            // CALL SO THAT APPLIES TO PAGE ALSO
            enableSmooth();


            var style = {
                retro: [
                    {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
                    {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
                    {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
                    {
                        featureType: 'administrative',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#c9b2a6'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#dcd2be'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#ae9e90'}]
                    },
                    {
                        featureType: 'landscape.natural',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#93817c'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#a5b076'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#447530'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{color: '#f5f1e6'}]
                    },
                    {
                        featureType: 'road.arterial',
                        elementType: 'geometry',
                        stylers: [{color: '#fdfcf8'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{color: '#f8c967'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#e9bc62'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry',
                        stylers: [{color: '#e98d58'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#db8555'}]
                    },
                    {
                        featureType: 'road.local',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#806b63'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#8f7d77'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#ebe3cd'}]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#b9d3c2'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#92998d'}]
                    }
                ]};

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
            });

            var contentString = '<div class="map-info-window">'+
                '<h1>Lomond Adventures</h1>'+
                '<p>This is the location of our centre to allow you see the proximity of the routes on the map.</p>'+
                '<p>Should you have any specific questions, please do not hesitate to <a href="/contact.php">Contact Us</a>.</p>'+
                '</div>';

            var centreinfo = new google.maps.InfoWindow({
                content: contentString
            });

            var image = new google.maps.MarkerImage("/img/center-marker.png", null, null, null, new google.maps.Size(53,80));

            var marker = new google.maps.Marker({
                position: lochlomond,
                map: map,
                icon: image,
                animation: google.maps.Animation.DROP,
                title: 'Lomond Adventures Centre'
            });

            marker.addListener('click', function() {
                centreinfo.open(map, marker);
            });

            // APPLY THE RETRO THEME
            map.setOptions({styles: style['retro']});


            // LOAD IN THE ROUTES FROM GEOJSON
            map.data.loadGeoJson('/routes/get-routes.php?activity=<?php echo $activity;?>');

            // CREATE AN INFO WINDOW TO WORK WITH
            var infowindow = new google.maps.InfoWindow();

            // TRIGGER SMOOTH SCROLL
            google.maps.event.addListener(infowindow, 'domready', function () {
                enableSmooth();
            });

            // WHEN USER CLICKS ROUTE
            map.data.addListener('click', function(event) {

                // ZOOM FIRST
                var bounds = new google.maps.LatLngBounds();
                processPoints(event.feature.getGeometry(), bounds.extend, bounds);
                map.fitBounds(bounds);

                // MAKE SURE ISNT A POINT BEFORE CALULCATING DISTANCE
//                if(!(event.feature.getGeometry() instanceof google.maps.Data.Point)) {
//
//                    // GET THE DISTANCE OF THE ROUTE - OMG THIS TOOK A WHILE
//                    var distance = google.maps.geometry.spherical.computeLength(event.feature.getGeometry().getArray());
//                    var distancekm = distance / 1000;
//                    var distancemiles = distance * 0.000621371;
//
//                    console.log("DISTANCE IN MILES: " + distancemiles);
//                    console.log("DISTANCE IN METERS: " + distance);
//                    console.log("DISTANCE IN KMS: " + distancekm);
//
//                }

                //routeid,title,distance,difficulty

                var routeName = event.feature.getProperty("name");
                var routeID = event.feature.getProperty("routeid");
                var difficulty = event.feature.getProperty("difficulty");
                var distance = parseFloat(event.feature.getProperty("distance")).toFixed(2);
                infowindow.setContent(generateContent(routeID,routeName,distance,difficulty));
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

                // SET COLOURS AND GET RATINGS
                var ratings = ['#27C664','#E17645','#E14545'];
                var color = ratings[feature.getProperty('difficulty')-1];

                return {
                    strokeColor: color,
                    strokeWeight: 10
                };
            });

        });



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
        function generateContent(routeid,title,distance,difficulty){

            var contentstring = "";
            contentstring+= "<div class='map-info-window'>";
            contentstring+= "<h1>"+title+"</h1>";
            contentstring+= "<div class='difficulty d"+difficulty+"'>"+difficulty+"</div>";
            contentstring+= "<p><strong>Distance:</strong> "+distance+" km<br><strong>Difficulty:</strong> "+difficulty+"</p>";
            contentstring+= "<p><a href='#route-"+routeid+"' id='weatherButton' class='btn btn-orng'><i class='fa fa-eye'></i> View Full Route Data</a></p>";
            contentstring+= "</div>";

            return contentstring;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&libraries=geometry">
    </script>

    </div>



<?php
include("includes/footer.php");
