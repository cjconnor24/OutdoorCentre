$(document).ready(function(){

    $('#newsletter-signup-form').submit(function(e){

        e.preventDefault();

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '/newsletter.php',
            data: $('#newsletter-signup-form').serialize(),
            success: function(resp){

                var resultBox = $("#newsletter-signup-form").find(".result");

                if(resp.status=="success"){

                    // ADD THE JSON MESSAGE
                    resultBox.find('.message').html(resp.message);
                    resultBox
                        .removeClass('bg-error')
                        .addClass('bg-success');

                    // CLEAR THE EMAIL ADDRESS
                    $("#email").val('');

                    // SLIDE DOWN AND DISPLAY THE BOX - REMOVE ANY ERRORS
                    resultBox.slideDown('slow',function(){

                        resultBox
                            .delay(5000)
                            .slideUp('slow');

                    });

                } else {

                    resultBox.find('.message').html(resp.message);

                    // ADD CLASS BEFORE SHOTING
                    resultBox.addClass('bg-error');
                    resultBox.slideDown('fast');

                }
            }
        });


    });

});