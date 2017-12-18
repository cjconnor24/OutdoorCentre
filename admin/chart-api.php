<?php

include('../includes/dbConnect.php');

header("Content-type: application/json");

$chart = $_GET['id'];

// CURRENT YEAR AND MONTH
$month = date('m');
$year = date('Y');

if($chart==1) {

    $query = $conn->prepare("SELECT COUNT(*) total, activity.name label FROM enquiry LEFT JOIN activity ON enquiry.activity = activity.id GROUP BY label;");

} else if($chart==2) {



    $query = $conn->prepare("SELECT COUNT(*) total,DATE(created_at) label FROM enquiry WHERE MONTH(created_at) = :month AND YEAR(created_at) = :year GROUP BY label ORDER BY label ASC;");
    $query->bindParam(":month",$month);
    $query->bindParam(":year",$year);



} else if ($chart==3){

    $query = $conn->prepare("SELECT COUNT(*) total, DATE(datetime) label FROM newsletter WHERE MONTH(datetime) = :month AND YEAR(datetime) = :year GROUP BY DATE(datetime);");
    $query->bindParam(":month",$month);
    $query->bindParam(":year",$year);

}



$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$label = array();

foreach($results as $row){
        $data[] = $row['total'];
        $label[] = $row['label'];
}

$response = array("labels"=>$label,"data"=>$data);

echo json_encode($response);

?>