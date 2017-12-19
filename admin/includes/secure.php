<?php
session_start();

$page = urlencode($_SERVER['REQUEST_URI']);

$_SESSION['redirect'] = $page;

if(!isset($_SESSION['user'])){

    // SESSION ISN'T SET - BOUNCE BACK TO LOGIN
    header("Location: /admin/login.php");

}