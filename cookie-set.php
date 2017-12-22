<?php
// SET COOKIE
header("Content-type: application/json");
setcookie("cookie_agree", "agreed", time()+86400*30, "/");
$response = array('status'=>'success');
echo json_encode($response);

?>