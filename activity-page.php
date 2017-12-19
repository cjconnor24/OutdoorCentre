<?php
include('includes/config.php');
include("includes/header.php");
?>

    <!--    <div class="hero">-->
    <!---->
    <!--        <div class="container">-->
    <!--            <h1>Activities</h1>-->
    <!--            <p>There are a wide range of activities and sports on offer at Lomond adventures.</p>-->
    <!--            <p>Take a look below for more information on everything that we offer.</p>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->
    <!--    <video playsinline autoplay muted loop poster="polina.jpg" id="bgvid">-->
    <!--        <source src="/video/bg-video.mp4" type="video/mp4">-->
    <!--    </video>-->



    <div id="full-size-map"></div>




    <div class="container nooverlap nohero">

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

                <p><a href="#" class="btn btn-orng check-weather"><i class="fa fa-cloud"></i> Check Weather</a> <a href="#" class="btn btn-orng check-weather"><i class="fa fa-map-marker"></i> View Route on Map</a></p>

            </div>

        </div>

        <?php
        } // END IF
        } // END LOOP
        ?>

    <script type="text/javascript">

        $(document).ready(function(){


            $.getJSON( "/routes/larger-geojson.json", function( resp ) {

                $.each( resp, function( key, val ) {
                    // DO SOMETHING
                });

            });


            // TEMP WEATHER STUFF
            $("#weatherButton").click(function(e){

                e.preventDefault();
                var apikey  = "<?php echo $weatherapi;?>";
                var apiurl = 'https://api.openweathermap.org/data/2.5/weather?lat=56.085865&lon=-4.548176'+'&APPID='+apikey;

                $.get(apiurl,function(resp){

                    console.log(resp);
                    var sunset = new Date(resp.sys.sunset*1000);
                    console.log("Sunset is at: "+sunset.getHours() + ':' + sunset.getMinutes());

                });

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
