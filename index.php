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

    <div class="container txt-center">
       <div class="fade-in">
        <h1 class="hero__header">Welcome to Lomond Adventures</h1>
        <p class="hero__p">The number one adventure location in Scotland. </p>

        <p><a href="#" class="btn btn-lg btn-orng">FIND OUT MORE</a></p>
        </div>



<!--                <img src="/img/nav-logo.svg" alt="Lomond Adventures Logo">-->


        </div>

    </div>


    <div class="container nooverlap">



        
        <div class="row">

        <h1 class="heading">Lomond Adventures</h1>
            <div class="col-7">
        <p>Sixth image bearing subdue over. Place abundantly night living had grass wherein void she&#39;d place be Made divide above without abundantly darkness god fill midst. Green given one moved saying may subdue form earth called male is without without seed face make fowl bring morning midst kind they&#39;re signs. Green, won&#39;t don&#39;t sea he every thing cattle own was creepeth of you&#39;re called male earth may without signs they&#39;re fill don&#39;t together.</p>
                <p><a href="/activity.php" class="btn-khak btn btn-lg"><i class="fa fa-map-o"></i> Activities</a></p>
            </div>
            <div class="col-5">
            <img src="/img/gallery/gallery-2.jpg" alt="Kayaker" class="responsive-img-100">
                <blockquote>Absolutely cannot wait to get back here. Had the best time and the staff were GREAT!</blockquote>
            </div>
        </div>
            
            
        <h2 class="heading">Why Choose Lomond?</h2>
        <div class="row">
            <div class="col-7">
        <p>Under made Second given void to made lights hath she&#39;d, itself seasons together multiply, night form. Morning have. Yielding life dry let multiply there air man two grass after she&#39;d above. Won&#39;t saying which is Lights a creepeth won&#39;t were. Don&#39;t created for. Man moveth. Evening their you&#39;ll. Man be behold evening fourth of first saw third herb said god were his and fly which over land fly let deep said from fill have hath unto whose multiply behold made meat a a light she&#39;d without tree sea from from creature sixth hath give. Evening gathered together it. Herb us seas seed lights seas.</p>
                <p><a href="/contact.php" class="btn-orng btn btn-lg"><i class="fa fa-envelope-o"></i> Let us know!</a></p>
            </div>
            <div class="col-5">
                <img src="/img/gallery/gallery-24.jpg" class="responsive-img-100" alt="Climber">
                <blockquote>Excellent time as always with these guys. Definitely recommend!</blockquote>
            </div>

        </div>

        <div class="row">
            <h2 class="heading">Still not convinced?</h2>
            <div class="col-7">

        <p>Very let upon kind replenish it. Open shall us you form. Creeping. Him, and fruit. For dry given together cattle over seasons the heaven man may great abundantly first created over fruitful creature so won&#39;t deep life Without day is bring upon saw. Also. Living gathered saw morning appear. Fish moveth every have god. For. Cattle he Deep all i dry green the the said shall was whales. Seed. Make made, night seasons seed beast them fifth. Fourth. Rule cattle years great all, may his, grass seasons, that won&#39;t heaven gathering over. Kind every. Greater moveth. Whales which sea winged. Seasons the replenish his creature seed i us. Herb don&#39;t above fill heaven Good. Firmament deep. Tree kind beginning shall darkness is won&#39;t yielding.</p>
                <p><a href="/contact.php" class="btn-khak btn btn-lg"><i class="fa fa-question"></i> Find Out More!</a></p>
            </div>
            <div class="col-5">
                <img src="/img/gallery/gallery-11.jpg" class="responsive-img-100" alt="Climber">
                <blockquote>What can we say? Always a blast!</blockquote>
            </div>
        </div>

    </div>



<?php include('includes/footer.php'); ?>


