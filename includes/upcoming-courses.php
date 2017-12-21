<h2 class="heading">Upcoming Courses</h2>

<?php

// FUNCTION FOR GETTING CACHED WEATHER FILE NAME
function get_weather_json_name($lat, $long){

    $nlat = round($lat,2);
    $nlong = round($long,2);

    $fn = $nlat."_".$nlong;
    $fn = str_replace("-","",$fn);
    $fn = str_replace(".","-",$fn);

    $path = 'cache/weather/';
    return $path.$fn.".json";


}

if(isset($_GET['activity'])){
    $activity = $_GET['activity'];
} else {
    $activity = 5;
}

include('includes/dbConnect.php');
$query = $conn->prepare("SELECT * FROM course WHERE activity=:activity AND datetime > NOW();");
$query->bindParam(":activity",$activity);
$query->execute();
$count = $query->rowCount();

if($count > 0) {

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    echo "<p>Below are a list of upcoming course. Click the course for more information.</p>";


    ?>
    <div class="accordion">
        <?php
        foreach($results as $course) {
            $i = 0;
            $date = strtotime($course['datetime']);
            ?>
            <div class="accordion-toggle"><?php echo $course['name'];?><span><i class="fa fa-calendar-o"></i> <?php echo date("jS F Y ha",$date);?></span></div>
            <div class="accordion-content <?php echo ($i=0 ? 'default' : '');?>">
                <p><?php echo $course['description'];?></p>
                <p><a href="/contact.php" class="btn btn-orng"><i class="fa fa-pencil-square-o"></i> Sign Up</a></p>
            </div>
            <?php
            $i++;
        } // END FOR EACH
        ?>
    </div>
    <?php
    // IF NO COURSES...
} else {
    echo "<p><em>There are no upcoming courses for this activity.</em></p>";
}
?>

<script type="text/javascript" src="/js/accordian.js"></script>

</div>

<div class="col-6">
    <h2 class="heading">Sub-Heading</h2>
    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
</div>


</div>