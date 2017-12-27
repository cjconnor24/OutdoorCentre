</div>

<footer>

    <div class="container">

        <div class="row">

            <div class="col-4 col-m-6">
                <h2>Contact Us</h2>
                <ul class="footer__menu">
                    <li><a href="#"><i class="fa fa-phone"></i> 0141 123 1234</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> email@lomondoutdoors.com</a></li>
                    <li><a href="#"><i class="fa fa-map"></i> 123 Lomond Street, Loch Lomond</a></li>
                </ul>

            </div>

            <div class="col-2 col-m-6">
                <h2>Facilities</h2>
                <ul class="footer__menu">
                    <?php
                    $facilities = array('Facilities'=>'/facilities.php','Equipment Hire'=>'/equipment-hire.php');
                    foreach($facilities as $key=>$facility){
                        echo "<li><a href=\"$facility\">$key</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-2 col-m-6 "><h2>Activities</h2>
                <ul class="footer__menu">
                    <?php
                    foreach($navactivities as $activity) {
                        ?>
                        <li><a href="/activity-page.php?activity=<?php echo $activity['id'];?>"><?php echo $activity['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ul></div>

            <div class="col-4 col-m-12"><h2>Social Media</h2>

                <ul class="footer__socialmenu">
                    <li><a href="#"><i class="fa fa-linkedin"></i> <span>LinkedIn</span></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i> <span>Instagram</span></a></li>
                </ul>

                <div class="newsletter">
                    <h2>Newsletter</h2>
                    <p>Keep up-to-date with our events</p>
                    <form method="post" id="newsletter-signup-form">

                        <div>
                            <label for="email">Email</label>
                            <div>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required/>
                                <button type="submit" id="newsletter-signup"><i class="fa fa-pencil-square-o"></i> Sign Up</button>
                            </div>
                        </div>
                        <div class="result">
                            <p class="text"><i class="fa fa-envelope"></i> <span class="message"></span></p>
                        </div>

                    </form>

                    <script type="text/javascript" src="/js/newsletter-signup.js"></script>

                </div>

            </div>




        </div>

    </div>

    <p class="footer__copyright">Lomond Outdoor Adventures <?php echo date("Y");?> &copy;</p>

</footer>

</div>

<?php
// OUTPUT THE FOOTER SCRIPTS IF ANY
if(isset($footerscripts) && count($footerscripts)>0){

    foreach($footerscripts as $script){
        echo "<script type='text/javascript' src='$script'></script>";
    }

}
?>
</body>
</html>
