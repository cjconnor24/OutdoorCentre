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

    <div class="result lg">
        <p class="text"><i class="fa"></i> <span class="message"></span></p>
    </div>

    <form action="" method="post" id="contact-form">

        <div class="row">

            <div class="col-6">

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
    <script type="text/javascript">
        $(document).ready(function(){

            // SUBMIT THE FORM
            $('#contact-form').submit(function(e){

                e.preventDefault();
                var formData = $(this).serialize();

                console.log(formData);

                $.post('contact-form.php',formData,function(resp){

                    clearResult();

                    if(resp.status=="success"){

                        updateResult(resp.message,'bg-success','fa-check');

                        $(".result").slideDown('slow');

                        scrollToResult();

                        $("#contact-form")[0].reset();

                    } else {

                        // UPDATE THE BOX WITH RELEVANT MESSAGES AND CLASSES

                        updateResult(resp.message,'bg-error','fa-times');

                        // BUILD A UL LIST WITH THE ERRORS
                        var list = $(".result").append('<ul></ul>').find('ul');
                        $(resp.errors).each(function(key,val){
                            list.append('<li>'+val+'</li>');
                        })

                        $(".result").slideDown('fast');

                        scrollToResult();

                    }

                },'json');

            });
        });

        function updateResult(message,bgClass,faClass){

            var resultBox = $('.result');
            resultBox.find('.message').text(message);
            $(".result").addClass(bgClass);
            $(".result").find('.fa').addClass(faClass);

        }


        function scrollToResult(){

            $('html, body').animate({
                scrollTop: $(".result").offset().top-200
            }, 500);

            return true;
        }

        /**
         * Clear any previous results in the results box.
         * @returns {boolean}
         */
        function clearResult(){


            var resultBox = $(".result");
            resultBox.find('.message').text('');

            // REMOVE THE CLASSES
            resultBox
                .removeClass('bg-error')
                .removeClass('bg-success')
                .removeClass('fa-times').removeClass('fa-check');

            resultBox.find('ul').remove();
            console.log("Clear function ran");

            return true;

        }


    </script>
    <?php include('ipsum.php');?>
</div>

<?php include('includes/footer.php'); ?>


