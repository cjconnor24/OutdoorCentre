<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow">

    <title>Admin Lomond Outdoor Adventures</title>


    <link rel="shortcut icon" href="/favicon.ico">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--    ADDING JQUERY LOCALLY FOR OFFLINE DEV-->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/admin/css/admin-styles.css" media="screen">

</head>
<body>

<div id="main-container">

    <div id="side-bar">
        <img class="side-bar__logo" src="/admin/img/admin-logo.svg" alt="Admin Logo">
        <h2 class="side-bar__heading">Admin Section</h2>
        <p class="side-bar__user"><i class="fa fa-user"></i> Chris Connor</p>
        <nav>
            <ul>
                <?php include('navigation.php'); ?>
            </ul>
        </nav>

        <p class="side-bar__copyright">&copy; Lomond Adventures <?php echo date("Y");?></p>

    </div>

    <div id="main-body">