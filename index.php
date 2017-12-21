<?php include('includes/header.php');?>

<script type="text/javascript">
    $(document).ready(function(){

        // TODO: EXTRACT THIS INTO SEPARATE LOGIC

        // CREATE IMGAGES THE THEIR POSITIONING
        var imgArr = new Array(
            ['/img/full-size-hero/hero-1.jpg','center center'],
            ['/img/full-size-hero/hero-2.jpg','center center'],
            ['/img/full-size-hero/hero-3.jpg','center bottom'],
            ['/img/full-size-hero/hero-4.jpg','center center'],
            ['/img/full-size-hero/hero-5.jpg','left bottom']
        );

        console.log("THIS RUNNS");

        var preloadArr = new Array();
        var i;

        // PRELOAD THE IMAGES
        for(i=0; i < imgArr.length; i++){
            preloadArr[i] = new Image();
            preloadArr[i].src = imgArr[i][0];
        }

        var currImg = 1;
        var intID = setInterval(changeImg, 6000);

        // CHANGE THE IMAGE
        function changeImg(){

            // CHANGE THE IMAGE AND THE BG POSITION
            var current = currImg++%imgArr.length;
            $('.hero').css('background-image','url(' + preloadArr[current].src +')');
            $('.hero').css('background-position',imgArr[current][1]);

        }

    });
</script>

<div class="hero fullscreen">

    <div class="container">



        <div class="fade-in">
        <h1 class="hero__header">Welcome to Lomond Adventures</h1>
        <p class="hero__p">The number one adventure location.</p>

        <p><a href="#" class="btn btn-lg btn-orng">FIND OUT MORE</a></p>
        </div>



<!--                <img src="/img/nav-logo.svg" alt="Lomond Adventures Logo">-->


        </div>

    </div>


    <div class="container nooverlap">
        <?php include('ipsum.php');?>
    </div>

    <div class="band">
        <div class="container">
            <?php include('ipsum.php');?>

        </div>

    </div>

    <div class="container">
        <?php include('ipsum.php');?>
    </div>

<?php include('includes/footer.php'); ?>


