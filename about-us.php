<?php include('includes/header.php');?>

<script type="text/javascript">
    $(document).ready(function(){

        // TODO: EXTRACT THIS INTO SEPARATE LOGIC FOR RE-USE

        // CREATE IMGAGES THE THEIR POSITIONING
        var imgArr = new Array(
            ['/img/full-size-hero/hero-11.jpg','right top'],
            ['/img/full-size-hero/hero-10.jpg','center center']
        );

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

<div class="hero about-us">

    <div class="container">

        <h1 class="hero__header">Welcome to Lomond Adventures</h1>
        <p class="hero__p">The number one adventure location.</p>

        <p><a href="#" class="btn btn-lg btn-orng">FIND OUT MORE</a></p>

    </div>

</div>

    <div class="container overlap">
        <h1 class="heading">About Lomond Adventures</h1>

        <div class="row">

            <div class="col-7">
                <p><img class="responsive-img-100" src="/img/gallery/gallery-36.jpg" alt="Lomond Outdoor Centre"></p>
            </div>

            <div class="col-5">
                <p>Lomond Adventures is set in the pictureque village of Balmaha which is 10 miles from somewhere in the eastern part of the Loch Lomond National Park. The centre is in an old something or other and has excellent facilities for small and large groups.</p>
                <p>Inside there is a teaching room and dining room. The two-acre grounds include a camp fire area and pond so it's a great base for environmental studies as well as outdoor adventure activities in the mountains.</p>
                <p><a href="/contact.php" class="btn btn-orng btn-lg"><i class="fa fa-phone"></i> Get in Touch!</a></p>
            </div>



        </div>

    </div>

<?php include('includes/footer.php'); ?>


