<?php

// s
//if(is_ajax()){
//    header('Content-Type: application/json');

    if(isset($_POST['email']) || !empty($_POST['email'])){

        $email = $_POST['email'];
        $response = array();

        // CHECK EMAIL IS VALID
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            include('includes/dbConnect.php');

            // CHECK IF IT EXISTS FIRST
            $query = $conn->prepare("SELECT id FROM newsletter WHERE email=?");
            $query->bindParam(1,$email);
            $query->execute();
            $count = $query->rowCount();

            // CHECK IF EXISTS, IF NOT, ADD TO DB
            // DON'T OUTPUT FALSE RESULT FOR SECURITY
            if($count==0) {

                $query = $conn->prepare("INSERT INTO newsletter (email,datetime) values(?,NOW())");
                $query->bindParam(1, $email);
                $query->execute();

            }


//            DITCH THE CONNECTION
            $conn = null;


            header("HTTP/1.1 200 OK");
            $response[] = array("Your email address was added to mailing list.");
            echo json_encode($response);

        } else {

            header("HTTP/1.1 500 Invalid Email Address");
            $response[] = "Invalid email";
            echo json_encode($response);

        }

    } else {

        header("HTTP/1.1 500 No Email Address");
        $response[] = "Email address cannot be empty";
        echo json_encode($response);
    }

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}