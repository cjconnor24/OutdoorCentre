<?php

include('../includes/dbConnect.php');

header("Content-type: application/json");

$query = $conn->prepare("SELECT COUNT(*) total, activity.name FROM enquiry LEFT JOIN activity ON enquiry.activity = activity.id GROUP BY activity.name;");
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$label = array();

foreach($results as $row){
        $data[] = $row['total'];
        $label[] = $row['name'];
}

$response = array("labels"=>$label,"data"=>$data);

echo json_encode($response);

?>