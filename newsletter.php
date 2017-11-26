<?php


/**
 * Created by PhpStorm.
 * User: chrisconnor
 * Date: 26/11/2017
 * Time: 18:29
 */

// s
//if(is_ajax()){
    header('Content-Type: application/json');

    if(isset($_POST['email'])){

        $email = $_POST['email'];

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("HTTP/1.1 200 OK");
            echo "This is a valid email";
        } else {
            header("HTTP/1.1 500 Invalid Address");
            echo "This is not a valid email";
        }

    }

//    echo "HELLO";
//} else {
//    echo "THIS IS NOT AJAX";
//}


function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}