<?php include('includes/header.php');?>

<div class="hero">

    <div class="container"></div>

</div>


    <div class="container overlap">

        <h1 class="heading">Activites</h1>


        <?php
        $activities = array("Kayaking","Canoeing","Climbing","Walking");
        for($i = 0; $i<4; $i++) {

        ?>
        <div class="activity">

            <div class="activity__img">
            <img src="/img/placeholder-<?php echo $i+1;?>.jpg" alt="<?php echo $activities[$i];?>">
            </div>

            <div class="activity__content">
            <h2 class="activity__heading"><?php echo $activities[$i];?></h2>
            <p>Kayaking is absolutely brilliant fun and very good fun to do. You can do lots of kayaking and some dummy text just to pad this out.</p>
                <?php if($i==3){
                   echo "<p>Kayaking is absolutely brilliant fun and very good fun to do. You can do lots of kayaking and some dummy text just to pad this out.</p>";
                }?>
            <p><a href="#" class="activity__button">More Info <i class="fa fa-info-circle"></i></a></p>
            </div>

        </div>

        <?php } ?>


    </div>



<?php include('includes/footer.php'); ?>


