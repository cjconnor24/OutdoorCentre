<?php
##### PERFORM AJAX LOGIC


if($_POST) {

    header('Content-type: application/json');

    // SETUP THE VARIABLES - NO VALIDATION FOR SPEED - RELYING ON HTML5
    $routeid = $_POST['routeid'];
    $name = $_POST['name'];
    $activity = $_POST['activity'];
    $difficulty = $_POST['difficulty'];
    $description = $_POST['description'];
    $enabled = (isset($_POST['enabled']) && $_POST['enabled']=="on" ? 1 : 0);

//    print_r($_POST);

    include('../includes/dbConnect.php');

    $query = $conn->prepare("UPDATE route SET name = :name, activity = :activity, difficulty = :difficulty, description = :description, enabled = :enabled WHERE id = :routeid");
    $query->bindParam(":name",$name);
    $query->bindParam(":activity",$activity);
    $query->bindParam(":difficulty",$difficulty);
    $query->bindParam(":description",$description);
    $query->bindParam(":enabled",$enabled);
    $query->bindParam(":routeid",$routeid);

    if($query->execute()){

        $response = array("status"=>"success","message"=>"Your route was updated.");
        echo json_encode($response);

    } else {

        $response = array("status"=>"error","message"=>"There was an issue updating your route.");
        echo json_encode($response);

    }

    exit();
}

?>
<?php

#########################

include('includes/header.php'); ?>

<p><a href="/admin/routes.php" class="btn"><i class="fa fa-arrow-left"></i> Return to Routes.</a></p>

 <h1>Edit Route</h1>
<p>Please edit the route below</p>

<?php
include('../includes/dbConnect.php');

if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
    echo "<p>There was an issue</p>";
    include("includes/footer.php");
    exit();
} else {
    $id = $_GET['id'];
}


$query = $conn->prepare("SELECT route.id routeid, route.name routename, route.difficulty routedifficulty, route.enabled enabled, route.description routedescription, activity.id activityid, activity.name activityname FROM route LEFT JOIN activity ON route.activity = activity.id WHERE route.id=:routeid");
$query->bindParam(":routeid",$id);

$query->execute();
$count = $query->rowCount();

$results = $query->fetch(PDO::FETCH_ASSOC);


if($count == 1) {

    // GET THE CATEGORY DROPDOWN
    $query = $conn->prepare("SELECT id activityid, name activityname FROM activity;");
    $query->execute();
    $activities = $query->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="result"></div>
    <form action="" method="post" id="route-update">

        <div class="form-group">
        <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $results['routename'];?>" placeholder="Route Name" required>
        </div>

        <div class="row">

            <div class="col-6">
        <div class="form-group">
            <label for="name">Activity</label>
            <select name="activity" required>
                <?php foreach($activities as $activity){?>
                    <option value="<?php echo $activity['activityid'];?>" <?php echo ($activity['activityid']==$results['activityid'] ? 'selected' : '');?>><?php echo $activity['activityname'];?></option>
                <?php }?>
            </select>
        </div>
            </div>

        <div class="col-6">
        <div class="form-group">
            <label for="name">Difficulty</label>
            <select name="difficulty" required>
                <?php for($i = 1; $i <= 3; $i++){?>
                <option value="<?php echo $i;?>" <?php echo ($results['routedifficulty']==$i ? 'selected' : '');?>><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>
        </div>

        </div>

        <div class="form-group">
            <label for="description">Route Description</label>
            <textarea name="description" required><?php echo $results['routedescription'];?></textarea>
        </div>

        <div class="form-group">
            <label for="description">Enable Route</label>
            <label class="switch">
                <input type="checkbox" name="enabled" <?php echo ($results['enabled']==1 ? 'checked' : '');?>>
                <span class="slider"></span>
            </label>
        </div>
        <input type="hidden" name="routeid" value="<?php echo $results['routeid'];?>">
        <input type="submit" class="btn" value="Save Route Details">

    </form>

    <script type="text/javascript">

        $(document).ready(function(){

            $('#route-update').submit(function(e){

                var routeid = $("input[name=routeid]").val();
                var formData = $('#route-update').serialize();

                console.log(formData);

                e.preventDefault();

                $.post('/admin/route-edit.php?id='+routeid,formData,function(resp){

                    console.log(resp);

                    if(resp.status=='success'){
                        // TODO: SUCCESS HANDLING
                        // PREPEND RESULT BOX
                        alert(resp.message);
//                        location.reload();
                        window.location.replace("/admin/routes.php");


                    } else {
                        // TODO: ERROR HANDLING
                        alert(resp.message);
                    }

                },'json');

            })

        });

    </script>


    <?php
} else {
    ?>
    <p>Sorry, this route doesn't exist.</p>
    <?php
}


include('includes/footer.php'); ?>

