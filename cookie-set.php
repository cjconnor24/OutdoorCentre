<?php
// SET COOKIE
header("Content-type: application/json");
setcookie("cookie_agree", "agreed", time()+86400*1, "/"); // SET TO ONE DAY FOR DEMO PURPOSES
$response = array('status'=>'success');
echo json_encode($response);

?>