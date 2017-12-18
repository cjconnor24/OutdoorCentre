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




    <div class="container nooverlap nohero">

        <h1 class="heading">Activites</h1>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h2 class="heading">Sub-Heading</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h2 class="heading">Routes</h2>

        <div class="route">

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
            var map = new google.maps.Map(document.getElementById('route-12'), {
                zoom: 14,
                center: lochlomond,
                disableDefaultUI: true,
                mapTypeId: 'terrain'
            });

            map.data.loadGeoJson('/routes/test-route-2.json');

            var marker = new google.maps.Marker({
                position: lochlomond,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&callback=initMap">
    </script>

<?php
include("includes/footer.php");
