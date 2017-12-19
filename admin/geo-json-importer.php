<?php
include('includes/header.php'); ?>

<p><a href="/admin/routes.php" class="btn"><i class="fa fa-map-o"></i> Return to Routes.</a></p>

 <h1>Edit Route</h1>
<p>Please edit the route below</p>

<p><strong style="color:red;">NOTE:</strong> This has not been secured...it's simply for testing purpose and importing test data.</p>

<?php

if(isset($_POST['submit'])){

    if(isset($_FILES['routefile'])) {
        print_r($_FILES['routefile']);
        print_r($_POST);

//        echo "THIS LOADED";


        $errors = array();
        // CHECK FILE SIZE
        if ($_FILES["routefile"]["size"] > 500000) {
            $errors[] = "Sorry, your file is too large.";
        }

        $jsondata = file_get_contents($_FILES['routefile']['tmp_name']);

    }
    $activity = $_POST['activity'];

//    echo $activity;
//    echo $jsondata;

    $data = array('activity'=>$activity,'json_data'=>$jsondata);

    $postvars = http_build_query($data);

    //echo "<pre>";
//    echo $postvars;
//    echo "</pre>";
    include('../includes/config.php');

    $url = $localurl."/admin/geo-json-builder.php";

    $ch = curl_init();


    // SETUP THE CURL REQUEST
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // GET THE RESULT
    $result = curl_exec($ch);

    echo $result;

    $json = json_decode($result,true);

    // CLOSE THE CONNECTION
    curl_close($ch);

}

?>


<?php

include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT id,name FROM activity;");
$query->execute();
$count = $query->rowCount();
$activities = $query->fetchAll(PDO::FETCH_ASSOC);

?>
    <form action="" method="post" id="route-update" enctype="multipart/form-data">

        <div class="form-group">
            <label for="activity">Routes Category</label>
            <select name="activity" id="activity">
                <?php foreach($activities as $activity){  ?>
                <option value="<?php echo $activity['id'];?>"><?php echo $activity['name'];?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="routefile">Route Description</label>
            <input type="file" name="routefile" id="routefile">
        </div>


        <input type="submit" class="btn" name="submit" value="Import Routes">

    </form>


<?php include('includes/footer.php'); ?>

