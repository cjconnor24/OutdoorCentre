<h1 class="heading">Hill Walking at Lomond Adventures</h1>
<p><img src="/img/gallery/gallery-13.jpg" class="responsive-img-50 float-left" alt="Hill Walking">A Munro is a mountain in Scotland with a height over 3,000 feet (914 m). Munros are named after Sir Hugh Munro, 4th Baronet (1856–1919), who produced the first list of such hills, known as Munro's Tables, in 1891. A Munro top is a summit that is not regarded as a separate mountain and which is over 3,000 feet. In the 2012 revision of the tables, published by the Scottish Mountaineering Club, there are 282 Munros and 227 further subsidiary tops. Of these 200 have a topographic prominence of over 150 m (492 ft) and are regarded by Peakbaggers as Real Munros.[1] There are 88 Metric Munros which are Scottish mountains over 1000m with a topographic prominence of over 200 m (656 ft). The best known Munro is Ben Nevis, the highest mountain in the British Isles.</p>
 <p>The Munros of Scotland present challenging conditions to hikers, particularly in winter. A popular practice amongst hillwalkers is "Munro bagging", the aim being to climb all of the listed Munros. As of 2017, more than 6,000 had reported completing their round. The first continuous round of the Munros was completed by Hamish Brown in 1974, whilst the current holder of the record for the fastest continuous round is Stephen Pyke, who completed his 2010 round in just under 40 days.</p>

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
