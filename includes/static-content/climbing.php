<h1 class="heading">Climbing at Lomond Adventures</h1>
<p><img src="/img/gallery/gallery-3.jpg" class="responsive-img-50 float-right" alt="Rock Climbing">Rock climbing is an activity in which participants climb up, down or across natural rock formations or artificial rock walls. The goal is to reach the summit of a formation or the endpoint of a usually pre-defined route without falling. Due to the length and extended endurance required and because accidents are more likely to happen on the descent than the ascent, rock climbers do not usually climb back down the route. It is very rare for a climber to downclimb, especially on the larger multiple pitches (class III- IV and /or multi-day grades IV-VI climbs). Professional rock climbing competitions have the objectives of either completing the route in the quickest possible time or attaining the farthest point on an increasingly difficult route. Scrambling, another activity involving the scaling of hills and similar formations, is similar to rock climbing. However, rock climbing is generally differentiated by its sustained use of hands to support the climber's weight as well as to provide balance.</p>

<div class="row">
    <div class="col-6">
    <h2 class="heading">ROCK CLIMBING GALLERY</h2>

        <div class="gallery">

            <?php for($i=4;$i<=19;$i++){

            echo "<div><a href='#' data-featherlight='/img/gallery/gallery-$i.jpg'><img src=\"/img/gallery/thumbs/gallery-$i.jpg\" alt=\"IMG\"></a></div>";


            }?>

        </div>
        <link rel="stylesheet" href="/css/featherlight.min.css">
        <?php

        $footerscripts[] = '/js/featherlight.min.js';

        ?>

    </div>

    <div class="col-6">
<?php include('includes/upcoming-courses.php');?>
    </div>

</div>
