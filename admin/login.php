<?php
session_start();

// FUNCTION TO CHECK IF AJAX REQUEST
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}



// MAKE SURE AJAX REQUEST
if(is_ajax()) {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        // ERROR CHECKING
        $errors = array();

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

        // IF NO ERRORS
        if (count($errors) == 0) {
            
            include('../includes/dbConnect.php');
            $query = $conn->prepare("SELECT id, email, CONCAT(fname, lname) name FROM users WHERE email=:email AND password = :password");
            $query->bindParam(":email", $email);
            $query->bindParam(":password", $password);

            // CHECK QUERY IS SUCCESSFUL
            if ($query->execute()) {

                $count = $query->rowCount();
                $results = $query->fetch(PDO::FETCH_ASSOC);
                $conn = null;

                // IF ONLY 1 ROW RETURNED ITS A MATCH
                if ($count == 1) {

                    // IF NOT EXISTING, WRITE TO SESSION
                    // TODO: ADD AN EXPIRY - SAY 30 MINS?
                    if (!isset($_SESSION['user'])) {
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['name'] = $results['name'];
                    }

                    $response = array('status' => 'success', 'message' => 'You will now be logged in.');

                    // IF TRYING TO ACCESS A PARTICULAR PAGE, REDIRECT TO THAT PAGE
                    if(isset($_SESSION['redirect'])){
                        $response['redirect'] = urldecode($_SESSION['redirect']);
                    }

                    // OUTPUT JSON BACK TO AJAX CALL
                    echo json_encode($response);

                } else {

                    // OUTPUT JSON BACK TO AJAX CALL
                    $response = array('status' => 'error', 'message' => 'Sorry, your username and / or password were incorrect.');
                    echo json_encode($response);

                }

            }


        } else {

            // OUTPUT JSON BACK TO AJAX CALL
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
    <link rel="stylesheet" href="/admin/css/admin-login.css">

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

        <script type="text/javascript" src="/admin/js/login.js"></script>


        <p class="login-box__return"><a href="/"><i class="fa fa-arrow-left"></i> Return to Lomond Adventure</a></p>

    </div>

</div>

</body>
</html>