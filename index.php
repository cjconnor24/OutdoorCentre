<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lomond Outdoor Adventures</title>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div>
<header>
<nav>
    <div class="container">
    <a href="#" class="nav__brand"><span class="nav__brand__span">Lomond Adventures</span></a>
    <ul class="nav__menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Facilites</a></li>
        <li><a href="#">Activities</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    </div>
</nav>

    <div class="hero">

        <div class="container">

            <h1 class="hero__header">Welcome to Lomond Adventures</h1>
            <p class="hero__p">The number one adventure location.</p>
            <p><a href="#" class="btn btn-orng">FIND OUT MORE</a></p>
            <p><a href="#" class="btn btn-lg btn-orng">FIND OUT MORE</a></p>

        </div>

    </div>

</header>



<div class="body">

<div class="container overlap">

<?php include('ipsum.php');?>
<?php include('ipsum.php');?>

</div>

</div>

<footer>

    <div class="container">

    <div class="row">
        <div class="col-3">
            <h2>Contact Us</h2>

        </div>

        <div class="col-3">
            <h2>Facilities</h2>
            <ul class="nav__menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Facilites</a></li>
                <li><a href="#">Activities</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="col-3"><h2>Activities</h2>
            <ul class="nav__menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Facilites</a></li>
                <li><a href="#">Activities</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul></div>
        <div class="col-3"><h2>Social Media</h2>

            <ul class="sm-menu">
                <li><a href="#"><i class="fa fa-linkedin"></i> <span>LinkedIn</span></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i> <span>Instagram</span></a></li>
            </ul>

            <div class="newsletter">
                <h2>Newsletter</h2>
                <p>Keep up-to-date with our events</p>
                <form action="" method="post">

                    <div>
                        <label for="email">Email</label>
                        <div>
                        <input type="text" placeholder="Enter your email" />
                        <button type="submit">Sign Up</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

    </div>

    <p class="footer__copyright">Lomond Outdoor Adventures <?php echo date("Y");?> &copy;</p>

</footer>

</div>
</body>
</html>