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

<div id="full-size-map">as</div>




    <div class="container nooverlap nohero">

        <h1 class="heading">Activites</h1>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h2 class="heading">Sub-Heading</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h2 class="heading">Routes</h2>

        <?php

        include('includes/config.php');
        $url = $localurl."/routes/larger-geojson.json";
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



        echo "<pre>";



        foreach($json->{'features'} as $walk) {

            if ($walk->{'geometry'}->{'type'} == "LineString") {

                $props = $walk->{'properties'};

                echo $props->{'name'};

            }


//            $walk->{'properties'}->{'name'} . "<br />";
        }

//        print_r($json);


//        foreach($json as $row){
//            print_r($row);
//        }
        echo "</pre>";
        ?>

        <div class="route" id="route-1">

            <div class="route__map" id="route-12"></div>

            <div class="route__info">
                <h3>Route Name</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

                <h3>Route Statistic</h3>
                <div class="route__info__stats">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>Another</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>Another</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>Another</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>Another</td>
                        </tr>
                    </table>
                </div>

                <p><a href="#" id="weatherButton">Weather </a></p>

            </div>

        </div>

    </div>
<!--<div id="test" style="height: 500px;width:500px;display:block;"></div>-->

<script type="text/javascript">

    $(document).ready(function(){

        $("a[href^='#']").click(function(e) {
            e.preventDefault();

            var position = $($(this).attr("href")).offset().top;

            $("body, html").animate({
                scrollTop: position
            } /* speed */ );
        });


        $.getJSON( "/routes/larger-geojson.json", function( resp ) {

//            console.log(data);
//            var items = [];
            $.each( resp, function( key, val ) {
//
//                console.log(val[0].properties.name);
////                items.push( "<li id='" + key + "'>" + val + "</li>" );
            });
//            });
//
//            $( "<ul/>", {
//                "class": "my-new-list",
//                html: items.join( "" )
//            }).appendTo( "body" );
        });


//        TEMP WEATHER STUFF
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

            map.data.loadGeoJson('/routes/larger-geojson.json');

            var infowindow = new google.maps.InfoWindow();

            // When the user clicks, open an infowindow
            map.data.addListener('click', function(event) {

                // ZOOM FIRST
                var bounds = new google.maps.LatLngBounds();
                processPoints(event.feature.getGeometry(), bounds.extend, bounds);
                map.fitBounds(bounds);

                // GET THE DISTANCE OF THE ROUTE - OMG THIS TOOK A WHILE
                var distance = google.maps.geometry.spherical.computeLength(event.feature.getGeometry().getArray());
                var distancekm = distance/1000;
                var distancemiles = distance * 0.000621371;

                console.log("DISTANCE IN MILES: "+distancemiles);
                console.log("DISTANCE IN METERS: "+distance);
                console.log("DISTANCE IN KMS: "+distancekm);

                var myHTML = event.feature.getProperty("name");
                infowindow.setContent(generateContent(myHTML,myHTML));
                // position the infowindow on the marker
//                infowindow.setPosition(event.feature.getGeometry());
                infowindow.setPosition(event.latLng);

                // anchor the infowindow on the marker
                infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
                infowindow.open(map);
            });



//            map.data.setStyle({
//                fillColor: 'green',
//                strokeWeight: 5,
//                strokeColor: '#e17645'
//            });

            // ZOOM TO SHOW ALL THE ROUTES
            var bounds = new google.maps.LatLngBounds();
            map.data.addListener('addfeature', function(e) {
                processPoints(e.feature.getGeometry(), bounds.extend, bounds);
                map.fitBounds(bounds);
            });

            // WHEN CLICKED - ZOOM TO SPECIFIC ROUTE
//            map.data.addListener('click', function(e) {
//                var bounds = new google.maps.LatLngBounds();
//                processPoints(e.feature.getGeometry(), bounds.extend, bounds);
//                map.fitBounds(bounds);
//            });

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

        function generateContent(title,body){

            var contentstring = "";
            contentstring+= "<div class='map-info-window'>";
            contentstring+= "<h1>"+title+"</h1>";
            contentstring+= "<p>Here is some info on the route</p>";
            contentstring+= "<p><a href='#route-1' class='btn btn-orng'><i class='fa fa-eye'></i> View Route Data</a></p>";
            contentstring+= "</div>";

            return contentstring;
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&callback=initMap&libraries=geometry">
    </script>

<?php
include("includes/footer.php");
