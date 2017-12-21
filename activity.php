<?php include('includes/header.php');?>

<div class="hero">

    <div class="container txt-center">
        <h1>Activities</h1>
        <p>There are a wide range of activities and sports on offer at Lomond adventures.</p>
        <p>Take a look below for more information on everything that we offer.</p>
    </div>

</div>


    <div id="activity-list" class="container overlap">

        <h1 class="heading">Activites</h1>

        <div class="row">
        <?php
//        $activities = array("Canoeing","Kayaking","Climbing","Hill Walking");
//        for($i = 0; $i<4; $i++) {

            include('includes/dbConnect.php');
            $query = $conn->query('SELECT id, name, description FROM activity;');
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $i = 1;

            foreach($results as $row){
        ?>

        <div class="activity <?php echo strtolower($row['name']);?>">

<!--            <div class="activity__img">-->
<!--                <img src="/img/activities/--><?php //echo str_replace(" ","-",strtolower($row['name']));?><!--.jpg" alt="--><?php //echo $row['name'];?><!--">-->
<!--            </div>-->

            <div class="activity__content" data-bg="/img/activities/<?php echo str_replace(" ","-",strtolower($row['name']));?>.jpg"">
                <h2 class="activity__heading"><?php echo $row['name'];?></h2>
                <p><?php echo $row['description'];?></p>
                <a href="/activity-page.php?id=<?php echo $row['id'];?>" class="btn btn-orng">Find Out More <i class="fa fa-info-circle"></i></a>
            </div>

        </div>

        <?php

            $i++; // INCREASE COUNT FOR CREATING ROWS

                if($i%2){
//                    echo "</div><div class='row'>";
                }
            } ?>
        </div>


    </div>



<?php include('includes/footer.php'); ?>


