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

        .fade-in {
            opacity: 0;
            animation: fadeIn ease 1;
            animation-fill-mode: forwards;
            animation-duration: 1s;
            animation-delay: 0.3s;
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

        input[type=text], input[type=password], input[type=submit], button[type=submit] {
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

        <div class="login-box__result success">
            <p id="flash">Sorry, but your username and / or password are incorrect.</p>
        </div>

        <form action="" method="post">

    <div class="form-group">
        <label for="username">username:</label>
        <input type="text" name="username" value="" placeholder="Please enter your username" required>
    </div>

    <div class="form-group">
        <label for="username">username:</label>
        <input type="password" name="username" value="" placeholder="Please enter your username" required>
    </div>

    <div class="form-group">
        <button type="submit"><i class="fa fa-sign-in"></i> LOGIN</button>
    </div>

        </form>

    </div>

</div>

</body>
</html>