<h1 class="heading">Canoeing at Lomond Adventures</h1>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

<div class="row">
    <div class="col-6">
    <h2 class="heading">CANOEING GALLERY</h2>

        <div class="gallery">

            <?php for($i=1;$i<=16;$i++){

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
