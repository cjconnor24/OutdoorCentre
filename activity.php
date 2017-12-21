<?php include('includes/header.php');?>

<div class="hero">

    <div class="container">
        <h1>Activities</h1>
        <p>There are a wide range of activities and sports on offer at Lomond adventures.</p>
        <p>Take a look below for more information on everything that we offer.</p>
    </div>

</div>


    <div class="container overlap">

        <h1 class="heading">Activites</h1>


        <?php
//        $activities = array("Canoeing","Kayaking","Climbing","Hill Walking");
//        for($i = 0; $i<4; $i++) {

            include('includes/dbConnect.php');
            $query = $conn->query('SELECT id, name, description FROM activity;');
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $row){
        ?>
        <div class="activity">

            <div class="activity__img">
            <img src="/img/placeholder-1.jpg" alt="<?php echo $row['name'];?>">
            </div>

            <div class="activity__content">
            <h2 class="activity__heading"><?php echo $row['name'];?></h2>
            <p><?php echo $row['description'];?></p>
            <p><a href="/activity-page.php?id=<?php echo $row['id'];?>" class="activity__button">More Info <i class="fa fa-info-circle"></i></a></p>
            </div>

        </div>

        <?php } ?>


    </div>



<?php include('includes/footer.php'); ?>


