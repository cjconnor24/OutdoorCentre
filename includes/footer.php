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
                    $facilities = array('Boat Hire','Equipment Hire','Life Jacket Hire');
                    foreach($facilities as $facility){
                        echo "<li><a href=\"#\">$facility</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-2 col-m-6"><h2>Activities</h2>
                <ul class="footer__menu">
                    <?php
                    $activities = array('Hiking','Kayaking','Canoeing','Climbing','Sailing');
                    foreach($activities as $facility){
                        echo "<li><a href=\"#\">$facility</a></li>";
                    }
                    ?>
                </ul></div>

            <div class="col-4 col-m-6"><h2>Social Media</h2>

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
                    <div class="result">
                        <p>Your email address was successfully added.</p>
                    </div>
                        <div>
                            <label for="email">Email</label>
                            <div>
                                <input type="text" id="email" name="email" placeholder="Enter your email" />
                                <button type="submit" id="newsletter-signup"><i class="fa fa-pencil-square-o"></i> Sign Up</button>
                            </div>
                        </div>

                    </form>

                    <script type="text/javascript">
                    $(document).ready(function(){

                        console.log("Doc is ready");
                        $('#newsletter-signup-form').submit(function(e){

                            e.preventDefault();
                            console.log("Form submitted newsletter");
                            $.ajax({
                                type: "POST",
                                url: '/newsletter.php',
                                data: $('#newsletter-signup-form').serialize(),
                                success: function(resp){
                                    console.log(resp.responseJSON);
                                },
                                error: function(resp){
                                    console.log(resp.responseJSON);
                                },
                                dataType: 'json'
                            });


                        });

                    });


                    </script>

                </div>

            </div>




        </div>

    </div>

    <p class="footer__copyright">Lomond Outdoor Adventures <?php echo date("Y");?> &copy;</p>

</footer>

</div>
</body>
</html>