<?php include('includes/header.php');?>

<div id="location-map"></div>

<script src="/js/contact-map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbs8Wb7fnp6cMbiuuWfJbX-3X3ItHC2Rw&callback=initMap"></script>


<div class="container overlap">

    <h1 class="heading">Get in Touch!</h1>

    <p>To get in contact with us, simply fill in the form below. Alternatively you can email us.</p>

    <div class="result lg">
        <p class="text"><i class="fa"></i> <span class="message"></span></p>
    </div>

    <form action="" method="post" id="contact-form">

        <div class="row">

            <div class="col-6 col-s-12">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" value="" placeholder="Enter your email address">
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone Number</label>
                    <input type="text" name="telephone" value="" placeholder="Enter your telephone" >
                </div>

                <div class="form-group">
                    <label for="category">Enquiry Category</label>
                    <select name="category" id="category" required>
                        <option value="">Please select</option>
                        <?php
                        include('includes/dbConnect.php');

                        $query = $conn->prepare("SELECT id, name FROM activity ORDER BY name ASC;");

                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach($results as $rows){
                        ?>
                        <option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
                        <?php  } ?>
                    </select>
                </div>

            </div>

            <div class="col-6 col-s-12">

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" placeholder="Enter your message here"></textarea>
                </div>

                <div class="form-group">
                    <label for="newsletter">Sign up to Newsletter?</label>
                    <label class="switch">
                        <input type="checkbox" name="newsletter">
                        <span class="slider"></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-orng"><i class="fa fa-envelope"></i> Contact Us</button>
                <button type="reset" class="btn btn-khak"><i class="fa fa-pencil"></i> Clear Form</button>

            </div>

        </div>

    </form>
    <script type="text/javascript" src="/js/contact-form.js"></script>

</div>

<?php include('includes/footer.php'); ?>
