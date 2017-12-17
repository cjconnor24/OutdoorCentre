<?php
// AJAX RESPONSE

// CHECK IF
if(isset($_POST['message'])){

        // SET ASIDE A SPACE FOR ERRORS
        $errors = array();

        // CHECK THE MESSAGE ISNT BLANK
        if(!isset($_POST['message']) && $_POST['message']==""){

                $errors[] = "The message cannot be blank";

        } else {

                $message = $_POST['message'];

        }

        // CHECK THE ENQUIRY ID IS SET
        if(!isset($_POST['enquiryid']) && $_POST['enquiryid']==""){

                $errors[] = "There was an issue creating the response";

        } else {

                $enquiryid = $_POST['enquiryid'];

        }

    //TODO: UPDATE THIS TO LOGGED IN USER
    $userid = 1;

        // CHECK FOR ERRORS BEFORE PROCEEDING
    if(count($errors)==0){

        include('../includes/dbConnect.php');
        $query = $conn->prepare("INSERT INTO response (message,enquiry,user,created_at) VALUES(:message,:enquiryid,:userid,NOW());");
        $query->bindParam(":message",$message);
        $query->bindParam(":enquiryid",$enquiryid);

        $query->bindParam(":userid",$userid);

        // IF SUCCESS
        if($query->execute()){
                // TODO: SEND SUCCESS JSON
            echo "<p>This was added to the DB";
        } else {
                // TODO: SEND ERROR JSON
            echo "<p>There was an issue adding it to the DB";
        }

    } else {
            // TODO: SEND ERROR JSON
    }

    exit();
}

?>

<?php
//

include('includes/header.php');
?>
<p><a href="/admin/enquiries.php" class="btn btn-small"><i class="fa fa-arrow-circle-left"></i> Return to Enquiries</a></p>
<?php

// MAKE SURE ID IS SET AND IS A NUMBER
if(isset($_GET['id']) && is_numeric($_GET['id'])) {

    $enquiryid = $_GET['id'];

    include("../includes/dbConnect.php");

    $query = $conn->prepare("SELECT enquiry.id,
enquiry.name,
 enquiry.email,
 enquiry.message,
 enquiry.created_at,
 activity.name AS activity FROM enquiry LEFT JOIN activity ON enquiry.activity = activity.id WHERE enquiry.id = :enquiryid;");
    $query->bindParam(':enquiryid',$enquiryid);

    $query->execute();
    $count = $query->rowCount();

    if($count==1){

        $results = $query->fetchObject();

//        $conn = null;
        ?>
            <h1>Enquiry #<?php echo $results->id; ?></h1>
            <p>Below are the details for Enquiry # <?php echo $results->id;?></p>

            <div class="row">

                    <div class="col-6">

                            <h2>Customer Information</h2>

                            <table class="table">
                                    <tr>
                                            <td>User</td>
                                            <td><?php echo $results->name; ?></td>
                                    </tr>
                                    <tr>
                                            <td>Email</td>
                                            <td><?php echo $results->email; ?></td>
                                    </tr>
                                    <tr>
                                            <td>Submitted</td>
                                            <td><?php echo date('d-m-Y',strtotime($results->created_at)); ?></td>
                                    </tr>
                                    <tr>
                                            <td>Activity</td>
                                            <td><?php echo $results->activity; ?></td>
                                    </tr>
                            </table>

                    </div>
                    <div class="col-6">
                            <h2>Message</h2>
                            <div class="enquiry__message"><?php echo $results->message; ?></div>
                    </div>


            </div>

            <div class="response">

                <?php

                $query = $conn->prepare("SELECT id FROM response WHERE enquiry = :enquiryid");
                $query->bindParam(":enquiryid",$_GET['id']);

                $query->execute();
                $count = $query->rowCount();

                if($count==0){

                ?>
                    <h2>Response</h2>
                    <p>You can respond to the enquiry below.</p>

                    <form action="" method="post" id="enquiry-response-form">

                            <textarea name="message" class="text-box" id="message" required></textarea>
                            <input type="hidden" name="enquiryid" value="<?php echo $results->id;?>">

                            <input type="submit" name="submit" class="btn"  value="Send Response">

                    </form>
                <?php
                } else {
                        ?>
                    <h2>Reponse</h2>
                    <p>You responded below here are the details.</p>

                    <div class="row">
                            <div class="col-6">
                                    <table class="table">
                                            <tr>
                                                    <td>User</td>
                                                    <td>Chris Connor</td>
                                            </tr>
                                            <tr>
                                                    <td>Email</td>
                                                    <td>cjconnor24@connordesign.com</td>
                                            </tr>
                                            <tr>
                                                    <td>Date</td>
                                                    <td>11/10/1987</td>
                                            </tr>

                                    </table>
                            </div>
                            <div class="col-6">

                            </div>
                    </div>
                    <?php
                }

                // FINALLY CLOSE THE CONNECTION
                $conn = NULL;
                ?>

            </div>

            <script type="text/javascript">

                //                $(document).ready(function(){
                //
                //                    $("#enquiry-response-form").submit(function(e){
                //
                //                        e.preventDefault();
                //                        console.log($(this).serialize());
                //
                //                        var formData = $(this).serialize();
                //
                //                        $.post('view-enquiry.php',
                //                        formData,function(resp){
                //                            console.log(resp);
                //                            })
                //
                //                    })
                //
                //                });

            </script>

        <?php
    } else {
        echo "<p>That doesn't exist</p>";
    }

}
?>

<?php include('includes/footer.php'); ?>

