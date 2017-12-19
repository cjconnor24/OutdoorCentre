<?php
if(isset($_GET['activity'])){

    header("Content-type: application/json");

    $activity = $_GET['activity'];

    include('../includes/dbConnect.php');

    // SETUP AND EXECUTE THE QUERY
    $query = $conn->prepare("SELECT * FROM route WHERE activity = :activityid AND enabled = 1");
    $query->bindParam(":activityid",$activity);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // START TO BUILD THE STRUCT OF THE GEOJSON AS AN ARRAY
    $maintree = array();
    $maintree['type'] = 'FeatureCollection';
    $maintree['features'] = array();

    // LOOP THROUGH EACH ROUTE AND BUILD THE GEOJSON
    foreach($results as $route) {

        // SETUP THE BRANCHES
        $jsonroute['type']='Feature';
        $jsonroute['properties'] = array();
        $jsonroute['geometry'] = array();

        // PROPS
        $jsonroute['properties']['routeid'] = $route['id'];
        $jsonroute['properties']['name'] = $route['name'];
        $jsonroute['properties']['description'] = $route['description'];
        $jsonroute['properties']['difficulty'] = $route['difficulty'];
        $jsonroute['properties']['distance'] = $route['distance'];

        // GEOMETRY
        $jsonroute['geometry']['type'] = "LineString";
        $jsonroute['geometry']['coordinates'] = json_decode($route['coordinates']);

        // LINK THIS TO MAIN FEATURE BRANCH
        $maintree['features'][] = $jsonroute;


    }


    echo json_encode($maintree);
    exit();

//    print_r($results);

    // SETUP COORDINATES
//    echo json_encode(json_decode($results['coordinates']));


} else {
    echo "<p>You may not access this page directly</p>";
}

