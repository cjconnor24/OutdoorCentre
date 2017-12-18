<?php

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";

echo distance(19.820664, -155.468066, 20.709722, -156.253333, "K") . " Kilometers HAWII<br>";



exit();

header("Content-type: application/json");

include('../includes/config.php');
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
$json = json_decode($result,true);

foreach($json['features'] as &$route){

    // TODO: IMPORT THE PROPERTIES - NAME STROKE ETC.
    // TODO: IMPORT THE CO-ORDINATES - ARRAY CONVERT TO JSON

    $route['properties']['chris'] = 'connor';

//    print_r($route['properties']);
}

//print_r($json);

echo json_encode($json);

