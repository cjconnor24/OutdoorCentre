$(function(){

    $('.cookies').delay(1500).fadeIn();

    // SET COOKIE TO SAY AGREED
    $('.cookies__link-agree').click(function(e){

        e.preventDefault();

        // do it in php...need a plugin for jquery
        $.getJSON('/cookie-set.php',function(resp){

            if(resp.status=='success'){
                $('.cookies__message').text('Thank you!');
                $('#cookie-law').delay(500).fadeOut();
            }
        })

    });

})