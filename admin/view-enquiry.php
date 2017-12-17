<?php
include('includes/header.php');

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

        $conn = null;
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

            <h2>Response</h2>
            <p>You can respond to the enquiry below.</p>

            <form action="post">

                    <textarea name="message" class="text-box" id="message" required></textarea>

                    <input type="submit" name="submit" class="btn"  value="Send Response">

            </form>

        <?php
    } else {
        echo "<p>That doesn't exist</p>";
    }

}
?>

<?php include('includes/footer.php'); ?>

