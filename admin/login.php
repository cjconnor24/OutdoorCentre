<?php
session_start();


function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}



// MAKE SURE AJAX REQUEST
if(is_ajax()) {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $errors = array();

//        print_r($_POST);

        if (!isset($_POST['email']) || $_POST['email'] == '') {
            $errors[] = "Please enter your email.";
        } else {
            $email = $_POST['email'];
        }

        if (!isset($_POST['password']) || $_POST['password'] == '') {
            $errors[] = "Please enter your email.";
        } else {
            $password = sha1($_POST['password']);
        }

        if (count($errors) == 0) {


            include('../includes/dbConnect.php');
            $query = $conn->prepare("SELECT id, email, CONCAT(fname, lname) name FROM users WHERE email=:email AND password = :password");
            $query->bindParam(":email", $email);
            $query->bindParam(":password", $password);

            if ($query->execute()) {

                $count = $query->rowCount();
                $results = $query->fetch(PDO::FETCH_ASSOC);

                if ($count == 1) {

                    if (!isset($_SESSION['user'])) {
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['name'] = $results['name'];
                    }

                    $response = array('status' => 'success', 'message' => 'You will now be logged in.');

                    if(isset($_SESSION['redirect'])){
                        $response['redirect'] = urldecode($_SESSION['redirect']);
                    }

                    echo json_encode($response);

                } else {

                    $response = array('status' => 'error', 'message' => 'Sorry, your username and / or password were incorrect.');
                    echo json_encode($response);

                }

            }


        } else {

            $response = array('status' => 'error', 'message' => 'There was an issue with your login.', 'messages' => $errors);
            echo json_encode($response);

        }

        exit();

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow">

    <title>Admin Lomond Outdoor Adventures</title>


    <link rel="shortcut icon" href="/favicon.ico">

    <script src="/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <style type="text/css">

        @import url('https://fonts.googleapis.com/css?family=Oswald:400,700');
        html, * {
            padding:0;
            margin:0;
        }
        * {
            box-sizing: border-box;
        }
        body {
            background:#202334;
            font-size:16px;
            font-family:Arial,Arial, Helvetica, sans-serif;
            color:#FFF;
        }

        @keyframes fadeIn { from { opacity:0;transform:  translate(0px,50px); } to { opacity:1;transform:  translate(0px,0px); } }
        @keyframes fadeOut { from { opacity:1;transform:  translate(0px,0px); } to { opacity:0;transform:  translate(0px,-250px); } }

        .fade-in {
            opacity: 0;
            animation: fadeIn ease 1;
            animation-fill-mode: forwards;
            animation-duration: 1s;
            animation-delay: 0.3s;
        }
        .fade-out {
            animation: fadeOut ease 1;
            animation-fill-mode: forwards;
            animation-duration: 1s;
            animation-delay: 1s;
        }

        #login {
            /*display:flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
        }
        h1 {
            font-family:Oswald, Arial, Helvetica, sans-serif;
        }
        .login-box {

            max-width:400px;
            width:80%;
            margin:0 auto;
            text-align: center;

        }
        .login-box__text {
            text-transform:uppercase;
            margin:0 0 2em 0;
        }
        .login-box__logo {
            width:50%;
            margin:2em auto;
        }
        .login-box__result {
            margin:2em 0;
            display:none;
            color:#FFF;
            padding:1em;
            font-size:1em;
            border-radius:5px;
        }
        .error {
            background:#8b0000;
        }
        .success {
            background:#28a745;
        }
        label {
            display:none;
        }

        input[type=email], input[type=password], input[type=submit], button[type=submit] {
            display:block;
            width:100%;
            padding:0 2em;
            height:50px;
            margin:0 0 1em 0;
            border:none;
            border-radius:5px;
        }
        input[type=submit], button[type=submit] {

            background:deepskyblue;
            color:#FFF;
            padding:0;
            font-size:20px;
            text-transform: uppercase;
            font-family:Oswald, Arial, Helvetica, sans-serif;
            transition:background-color 0.5s ease;
            cursor: pointer;
        }
        input[type=submit]:hover, button[type=submit]:hover {
            background: #00eaff;
        }

    </style>
</head>
<body>



<div id="login">

    <div class="login-box fade-in">

        <img src="/admin/img/admin-logo.svg" class="login-box__logo" alt="Lomond Adventure">

        <div class="login-box__text">
        <h1>Lomond Aventures</h1>
        <p>ADMINISTRATION</p>
        </div>

        <div class="login-box__result">
            <p id="flash">Sorry, but your username and / or password are incorrect.</p>
        </div>

        <form action="" method="post" id="login-form">

    <div class="form-group">
        <label for="email">email:</label>
        <input type="email" name="email" value="" placeholder="Please enter your username" required>
    </div>

    <div class="form-group">
        <label for="username">username:</label>
        <input type="password" name="password" value="" placeholder="Please enter your username" required>
    </div>

    <div class="form-group">
        <button type="submit" name="submit" value="submit"><i class="fa fa-sign-in"></i> LOGIN</button>
    </div>

        </form>

        <script type="text/javascript">

//            TODO: TIDY UP - MOVE JS AND CSS EXTERNAL

            $(function(){

                $('#login-form').submit(function(e){

                    e.preventDefault();
                    var formData = $(this).serialize();
                    console.log(formData);

                    $.post('/admin/login.php',formData,function(resp){

                        if(resp.status=='error'){

                            var resultBox = $('.login-box__result');
                            resultBox.find('p').text(resp.message);
                            resultBox.addClass('error')
                            .slideDown('slow').delay(10000).slideUp('slow',function(e){
                                e.removeClass('error');
                            });

                        } else {

                            var resultBox = $('.login-box__result');
                            resultBox.find('p').text(resp.message);
                            resultBox.addClass('success').slideDown('fast').delay(3000);

                            //                        <div class="login-box fade-in">
                            $('.login-box').removeClass('fade-in').delay(1000).addClass('fade-out');

                            setTimeout(function() {

                                if(resp.redirect!==undefined){
                                    window.location.replace(resp.redirect);
                                } else {
                                    window.location.replace("/admin/");
                                }

                            }, 2000);








                        }

                        console.log(resp);

                    },'json');

                })

            })

        </script>



    </div>

</div>

</body>
</html>