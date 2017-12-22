$(function(){

    $('#login-form').submit(function(e){

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        // CHECK CREDENTIALS AGAINST DB
        $.post('/admin/login.php',formData,function(resp){

            // IF ERROR
            if(resp.status=='error'){

                // UPDATE USER
                var resultBox = $('.login-box__result');
                resultBox.find('p').text(resp.message);
                resultBox.addClass('error')
                    .slideDown('slow').delay(10000).slideUp('slow',function(e){
                    e.removeClass('error');
                });

            } else {

                // UPDATE AND REDIRECT TO ADMIN
                var resultBox = $('.login-box__result');
                resultBox.find('p').text(resp.message);
                resultBox.addClass('success').slideDown('fast').delay(3000);

                $('.login-box').removeClass('fade-in').delay(1000).addClass('fade-out');

                // WAIT ON ANIMATION
                setTimeout(function() {

                    if(resp.redirect!==undefined){
                        window.location.replace(resp.redirect);
                    } else {
                        window.location.replace("/admin/");
                    }

                }, 2000);

            }

            console.log(resp);

        },'json');

    })

})