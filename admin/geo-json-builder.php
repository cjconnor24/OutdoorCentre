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

function calculateLineString($coordinates){

    $runningTotal = 0;
    $count = count($coordinates);

//    echo "THere are $count rows";

//    print_r($coordinates);

    for($i = 1 ; $i < $count ; $i++){

//        echo "$i<br>";

        $current1 = $coordinates[$i-1];
        $current2 = $coordinates[$i];

        $runningTotal += distance($current1[1], $current1[0], $current2[1], $current2[0], 'K');

    }

    return $runningTotal;


}


header("Content-type: application/json");

$json_data = $_POST['json_data'];
$activity = $_POST['activity'];

//echo $activity;

// START
//
//include('../includes/config.php');
//$url = $localurl."/routes/noname.json";
//$ch = curl_init();
//
//// SETUP THE CURL REQUEST
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//    'Content-Type: application/json'
//));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//// GET THE RESULT
//$result = curl_exec($ch);


$json = json_decode($json_data,true);

include('../includes/dbConnect.php');

foreach($json['features'] as &$route){

    // CHECK ITS LINE STRING
    if($route['geometry']['type']=='LineString') {

        // IMPORT THE PROPERTIES - NAME STROKE ETC.
        $route['properties'];
        $name = (isset($route['properties']['name']) ? $route['properties']['name'] : '');

        // IMPORT THE CO-ORDINATES - ARRAY CONVERT TO JSON
        $coordinates = json_encode($route['geometry']['coordinates']);

        // IMPORT THE DISTANCE
        $distance = calculateLineString($route['geometry']['coordinates']);

//        $activity = 5;

        $insertstatement = "INSERT INTO route (name,coordinates,activity,distance) VALUES (:name,:coordinates,:activity,:distance)";
        $query = $conn->prepare($insertstatement);
        $query->bindParam(":name", $name);
        $query->bindParam(":coordinates", $coordinates);
        $query->bindParam(":activity", $activity);
        $query->bindParam(":distance", $distance);

        $query->execute();

    }

}


$conn = NULL;

$response = array('status'=>'succes','message'=>'this was completed.');
echo json_encode($response);

//END

//print_r($json);

//echo json_encode($json['features'][0]['geometry']['coordinates']);

//echo json_encode($json);

