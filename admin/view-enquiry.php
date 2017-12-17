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
                $temp=array('message'=>$message,'encid'=>$enquiryid,'userid'=>$userid);
        print_r($temp);

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

    $query = $conn->prepare("SELECT 
enquiry.id enquiryid,
enquiry.name,
enquiry.email enquiryemail,
enquiry.created_at received,
enquiry.message enquirymessage,
activity.name activity,
response.id responseid,
response.message responsemessage,
response.created_at sent,
users.email,
CONCAT(users.fname,\" \",users.lname) fullname
 FROM enquiry LEFT JOIN response ON enquiry.id = response.enquiry
 LEFT JOIN activity ON enquiry.activity = activity.id
  LEFT JOIN users ON response.user = users.id WHERE enquiry.id = :enquiryid;");
    $query->bindParam(':enquiryid',$enquiryid);

    $query->execute();
    $count = $query->rowCount();

    if($count==1){

        $results = $query->fetchObject();
        $conn = null;
        ?>
            <h1>Enquiry #<?php echo $results->enquiryid; ?></h1>
            <p>Below are the details for Enquiry # <?php echo $results->enquiryid;?></p>

            <div class="row">

                    <div class="col-6">

                            <div class="panel">
                                    <div class="panel-heading"><i class="fa fa-user"></i> Customer Information</div>
                                    <div class="panel-body">
                                            <table class="table">
                                                    <tr>
                                                            <td><strong>User</strong></td>
                                                            <td><?php echo $results->name; ?></td>
                                                    </tr>
                                                    <tr>
                                                            <td><strong>Email</strong></td>
                                                            <td><?php echo $results->enquiryemail; ?></td>
                                                    </tr>
                                                    <tr>
                                                            <td><strong>Received</strong></td></td>
                                                            <td><?php echo date('d-m-Y H:m',strtotime($results->received)); ?></td>
                                                    </tr>
                                                    <tr>
                                                            <td><strong>Activity</strong></td>
                                                            <td><?php echo $results->activity; ?></td>
                                                    </tr>
                                            </table>
                                    </div>
                            </div>

                    </div>
                    <div class="col-6">
                            <div class="panel">
                                    <div class="panel-heading"><i class="fa fa-envelope-open"></i> Customer Enquiry</div>
                                    <div class="panel-body">
                            <?php echo $results->enquirymessage; ?>
                                    </div>
                            </div>
                    </div>


            </div>


            <div class="response">

                <?php
                // IF THE RESPONSE ID IS NULL, THIS HASNT BEEN REPLIED TO YET
                if($results->responseid==NULL){
                ?>
                    <h2>Response</h2>
                    <p>You can respond to the enquiry below.</p>

                    <form action="" method="post" id="enquiry-response-form">

                            <textarea name="message" class="text-box" id="message" required></textarea>
                            <input type="hidden" name="enquiryid" value="<?php echo $results->enquiryid;?>">

                            <input type="submit" name="submit" class="btn"  value="Send Response">

                    </form>
                <?php
                } else {
                        ?>


                    <h1>Reponse</h1>
                    <p>You responded below here are the details.</p>
                    <div class="row">
                            <div class="col-6">


                                    <div class="panel panel-green">
                                            <div class="panel-heading"><i class="fa fa-user-circle"></i> Staff Info</div>
                                            <div class="panel-body">
                                                    <table class="table">
                                                            <tr>
                                                                    <td>Staff</td>
                                                                    <td><?php echo $results->fullname;?></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Email</td>
                                                                    <td><?php echo $results->email;?></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Date Sent</td>
                                                                    <td><?php echo date('d-m-Y',strtotime($results->sent)); ?></td>
                                                            </tr>

                                                    </table>
                                            </div>
                                    </div>


                            </div>

                            <div class="col-6">
                                    <div class="panel panel-green">
                                            <div class="panel-heading"><i class="fa fa-envelope"></i> Response</div>
                                            <div class="panel-body">
                                    <?php echo $results->responsemessage;?></div>
                                    </div>
                            </div>
                            </div>
                    </div>
                    <?php
                }

                // FINALLY CLOSE THE CONNECTION
                $conn = NULL;
                ?>

            <p><a href="/admin/enquiries.php" class="btn btn-small"><i class="fa fa-arrow-circle-left"></i> Return to Enquiries</a></p>

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

