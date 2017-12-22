<?php include('includes/header.php');?>

<div id="location-map">

</div>

<script>
    function initMap() {

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
        var map = new google.maps.Map(document.getElementById('location-map'), {
            zoom: 15,
            center: lochlomond,
            disableDefaultUI: true,
            mapTypeId: 'terrain'
        });
        map.setOptions({styles: style['retro']});

        var contentString = '<div class="map-info-window">'+
            '<h1>Lomond Adventures</h1>'+
            '<p>123 Loch Lomond <br>Loch Lomond <br><br>G21 123</p>'+
            '<p><strong>tel</strong> 0141 123 1234</p>'+
            '<p><strong>email</strong> <a href="mailto:reception@lomondoutdoors.com">reception@lomondoutdoors.com</a></p>'+
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
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&callback=initMap">
</script>


<div class="container overlap">

    <h1 class="heading">Get in Touch!</h1>

    <p>To get in contact with us, simply fill in the form below. Alternatively you can email us.</p>

    <div class="result lg">
        <p class="text"><i class="fa"></i> <span class="message"></span></p>
    </div>

    <form action="" method="post" id="contact-form">

        <div class="row">

            <div class="col-6">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" value="" placeholder="Enter your email address">
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone Number</label>
                    <input type="text" name="telephone" value="" placeholder="Enter your telephone" >
                </div>

                <div class="form-group">
                    <label for="category">Enquiry Category</label>
                    <select name="category" id="category" required>
                        <option value="">Please select</option>
                        <?php
                        include('includes/dbConnect.php');

                        $query = $conn->prepare("SELECT id, name FROM activity ORDER BY name ASC;");

                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach($results as $rows){
                        ?>
                        <option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
                        <?php  } ?>
                    </select>
                </div>

            </div>

            <div class="col-6">

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Enter your message here"></textarea>
                </div>

                <div class="form-group">
                    <label for="newsletter">Sign up to Newsletter?</label>
                    <label class="switch">
                        <input type="checkbox" name="newsletter">
                        <span class="slider"></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-orng"><i class="fa fa-envelope"></i> Contact Us</button>
                <button type="reset" class="btn btn-khak"><i class="fa fa-pencil"></i> Clear Form</button>

            </div>

        </div>

    </form>
    <script type="text/javascript" src="/js/contact-form.js"></script>

</div>

<?php include('includes/footer.php'); ?>


