<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "lomond";



try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//        echo "Connected to the database successfully";

} catch(PDOException $e){

    echo "Connection failed ".$e->getMessage();

}


?>