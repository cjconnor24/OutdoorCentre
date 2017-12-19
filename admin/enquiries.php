<?php

include("includes/secure.php");

include('includes/header.php'); ?>

 <h1>Enquiries</h1>

<?php
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT
enquiry.id enquiryid,
enquiry.name enquiryname,
enquiry.email enquiryemail,
enquiry.created_at received,
activity.name activityname,
response.id responseid
FROM enquiry LEFT JOIN response ON response.enquiry = enquiry.id
LEFT JOIN activity ON activity.id = enquiry.activity;");

$query->execute();
$count = $query->rowCount();

include('_partials/_enquiry-table.php');

include('includes/footer.php'); ?>

