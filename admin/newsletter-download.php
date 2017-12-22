<?php
include('includes/secure.php');
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT * FROM newsletter;");
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

$output = "";
$output.= "id,email,signupdate\n";

foreach($results as $row){
    $output.= $row['id'].','.$row['email'].','.$row['datetime']."\n";
}

header("Content-Type: text/csv");
//header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".time()."_lomond_mailing_list.csv\"");

echo trim($output);

?>