$(function(){

    $('.cookies').delay(3000).fadeIn();

    // SET COOKIE TO SAY AGREED
    $('.cookies__link-agree').click(function(e){

        e.preventDefault();

        // DO IT IN PHP...NEED A PLUGIN FOR JQUERY
        $.getJSON('/cookie-set.php',function(resp){

            if(resp.status=='success'){
                $('#cookie-law').delay(500).fadeOut();
            }
        })

    });

})