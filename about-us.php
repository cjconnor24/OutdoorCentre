<?php include('includes/header.php');?>

<script type="text/javascript">
    $(document).ready(function(){

        // TODO: EXTRACT THIS INTO SEPARATE LOGIC FOR RE-USE

        // CREATE IMGAGES THE THEIR POSITIONING
        var imgArr = new Array(
            ['/img/full-size-hero/hero-11.jpg','right top'],
            ['/img/full-size-hero/hero-10.jpg','center center']
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
                <p><img class="responsive-img-100" src="/img/gallery/gallery-43.jpg" alt="Lomond Outdoor Centre"></p>
            </div>

            <div class="col-5">
                <p>Lomond Adventures is set in the pictureque village of Balmaha which is 10 miles from somewhere in the eastern part of the Loch Lomond National Park. The centre is in an old something or other and has excellent facilities for small and large groups.</p>
                <p>Inside there is a teaching room and dining room. The two-acre grounds include a camp fire area and pond so it's a great base for environmental studies as well as outdoor adventure activities in the mountains.</p>
                <p><a href="/contact.php" class="btn btn-orng btn-lg"><i class="fa fa-phone"></i> Get in Touch!</a></p>
            </div>



        </div>




<!--        <div class="row">-->
<!--        <div class="col-5">-->
<!--            <h2 class="heading">ACCOMMODATION</h2>-->
<!--        <p>Houses 32 young people and four staff in dormitories</p>-->
<!--        <p>16 beds plus two staff on each landing</p>-->
<!--        <p>Drying room</p>-->
<!--        <p>Dining room</p>-->
<!--        <p>Patio area with BBQ facilities</p>-->
<!--        <p>Wildflower meadow</p>-->
<!--        <p>Fenced conservation area with pond</p>-->
<!--        <p>Download the Balmaha Centre room plan</p>-->
<!--        </div>-->
<!---->
<!--            <div class="col-7">-->
<!---->
<!--                <h2 class="heading">WHAT ACTIVITIES ARE AVAILABLE AT Lomond Adventures?</h2>-->
<!--                <p>The great outdoors of the Brecon Beacons National Park are our backyard in Balmaha-on-Usk. There's the beautiful Monmouthshire & Brecon Canal for walks and cycling on the towpath as well as safe canoeing along its length.</p>-->
<!--                <p>The Taff Trail passes through Balmaha-on-Usk so there is off-road cycling (it's an old tram road that used to bring limestone down to the canal where you can still see old lime kilns). Mountains in sight of the centre include Tor y Foel and The Allt, or you can climb up to the ridge which encompasses Waun Fach and, further along, Pen y Fan.</p>-->
<!--                <p>There are plenty of easy walks as well as more strenous hill walks. Activities also on the doorstep include climbing and caving too. Take your pick!</p>-->
<!--            </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
    </div>



<?php include('includes/footer.php'); ?>


