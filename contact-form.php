<?php

    header('Content-Type: application/json');


        $errors = array();

        // ERROR CHECK
        if($_POST['name']=="" || !isset($_POST['name'])){
            $errors[] = "Please enter your name.";
        } else {
            $name = $_POST['name'];
        }

        if($_POST['email']=="" || !isset($_POST['email'])){

            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $errors[] = "Please enter a valid email address.";
            }

        } else {
            $email = $_POST['email'];
        }

        // TELEPHONE OPTIONAL
        if(isset($_POST['telephone'])){
            $telephone = $_POST['telephone'];
        }

        // NEWLETTER OPTIONAL
        if(isset($_POST['newsletter'])){
            $newsletter = true;
        }

        if($_POST['category']=="" || !isset($_POST['category'])){
            $errors[] = "Please select a category.";
        } else {
            $category = $_POST['category'];
        }

        if($_POST['message']=="" || !isset($_POST['message'])){
            $errors[] = "Please enter a message for your enquiry.";
        } else {
            $message = $_POST['message'];
        }

        if(count($errors)!=0){
            $response = array(
                "status"=>"error",
                "message"=>"We encountered some errors trying to process your enquiry.",
                "errors"=>$errors
            );
            echo json_encode($response);
        } else {


            include('includes/dbConnect.php');

            $prequery = "INSERT INTO enquiry (name,email,telephone,category,message,created_at) values(?,?,?,?,?,NOW())";

            $query = $conn->prepare($prequery);
            $query->bindParam(1, $name);
            $query->bindParam(2, $email);
            $query->bindParam(3, $telephone);
            $query->bindParam(4, $category);
            $query->bindParam(5, $message);

            if($query->execute()){

                // IF USER WISHES TO BE ADDED TO NEWSLETTER, ADD THEM
                if(isset($newsletter)) {

                    include('includes/config.php');

                    // ADD THE ADDRESS TO THE MAILING LIST ALSO
                    $url = $localurl.'newsletter.php';

                    // PREPARE THE DATA AND POST TO THE NEWSLETTER SCRIPT
                    $data = array(
                        'email' => $email
                    );

                    $postvars = http_build_query($data);
                    $ch = curl_init();

                    // SETUP THE CURL REQUEST
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, count($data));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    // GET THE RESULT
                    $result = curl_exec($ch);
                    $json = json_decode($result,true);

                    // CLOSE THE CONNECTION
                    curl_close($ch);

                }

                // GET THE ID OF THE ENQUIRY
                $refno = $conn->lastInsertId();

                // TODO: ACTUALLY MAIL THE CLIENT AND THE ADMINISTRATOR WITH THE INFO

                $response = array(
                    "status"=>"success",
                    "message"=>"Your enquiry has been sent to the centre. Your reference number is: ".sprintf("OUT-%05d",$refno)
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "status"=>"error",
                    "message"=>"We encountered some errors trying to process your enquiry:",
                    "errors"=>array("There was a problem saving your enquiry. (SQL ERROR)")
                );
                echo json_encode($response);
            }




            // DITCH THE CONNECTION
            $conn = null;



        }


function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
