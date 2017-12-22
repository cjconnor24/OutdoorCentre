<?php
session_start();
// ARRAY TO STORE ANY FILES WHICH NEED TO BE OUTPUT BEFORE BODY
$footerscripts = array();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Lomond Outdoor Adventures - Loch Lomond, Glasgow, Scotland</title>

    <link rel="shortcut icon" href="/favicon.ico">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--    ADDING JQUERY LOCALLY FOR OFFLINE DEV-->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css" media="screen">

<!--    <script type="text/javascript" src="/js/slider.js"></script>-->
    <script type="text/javascript">
        // SHOW AND HIDE MOBILE MENU - ANIMATE HAMBURGER
        $(document).ready(function(){

            $('.nav__hamburger').click(function(){
                $(this).toggleClass('open');
                $(".nav__menu").toggleClass( "open" );
            });


        });


        //

    </script>
</head>
<body>

<div id="overlay">



    <div class="weather">
        <i class="fa fa-times" id="close-weather" title="Close Window"></i>
        <h1> Weather Information</h1>
        <p>Below is the current 5-day forcast for [route].</p>

        <div class="loading-box">
            <img src="/img/logo.png" alt="Loading Graphic">
            <p>Loading Data...</p>
        </div>

        <div id="weather-box"></div>

        <p class="weather__copyright">Weather data provided by <a href="http://openweathermap.org/" target="_blank">&copy; OpenWeatherMap</a></p>

    </div>

</div>

<?php
// CHECK IF USER HAS AGREED TO EU COOKIES
include('includes/cookie-include.php');
?>

<div>
    <header>
        <nav>
            <div class="container">
                <a href="#" class="nav__brand"><span class="nav__brand__span">Lomond Adventures</span></a>

                <?php include('includes/navigation.php'); ?>

                <div class="nav__telephone">
                    <a href="tel:01236123456"><i class="fa fa-phone"></i></a>
                </div>

                <div class="nav__hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>
        </nav>



    </header>



    <div class="body">