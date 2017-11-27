<?php include('includes/header.php');?>

<div class="hero">

    <div class="container">

        <h1 class="hero__header">Welcome to Lomond Adventures</h1>
        <p class="hero__p">The number one adventure location.</p>

        <p><a href="#" class="btn btn-lg btn-orng">FIND OUT MORE</a></p>

    </div>

</div>


    <div class="container overlap">

        <h1>Get in Touch!</h1>

        <p>To get in contact with us, simply fill in the form below. Alternatively you can email us.</p>

        <form action="" method="post">

            <div class="row">

                <div class="col-6">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" value="" placeholder="Enter your email address" required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Telephone Number</label>
                        <input type="text" name="telephone" value="" placeholder="Enter your telephone" >
                    </div>

                    <div class="form-group">
                        <label for="category">Enquiry Category</label>
                        <select name="category" id="category">
                            <option value="">Please select</option>
                            <option value="1">Kayaking</option>
                            <option value="2">Climbing</option>
                            <option value="3">Hill Walking</option>
                            <option value="4">Swimming</option>
                        </select>
                    </div>

                </div>

                <div class="col-6">

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" placeholder="Enter your message here" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="newsletter">Sign up to Newsletter?</label>
                        <label class="switch">
                            <input type="checkbox" name="newsletter">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-orng btn-lg">Contact Us</button>
                    <button type="reset" class="btn btn-khak btn-lg">Clear Form</button>

                </div>

            </div>

        </form>

        <?php include('ipsum.php');?>
    </div>

<?php include('includes/footer.php'); ?>


