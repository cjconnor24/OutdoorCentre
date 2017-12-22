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

                $(".result:first").slideDown(500);

                scrollToResult();

                $("#contact-form")[0].reset();

            } else {

                // UPDATE THE BOX WITH RELEVANT MESSAGES AND CLASSES

                updateResult(resp.message,'bg-error','fa-times');

                // BUILD A UL LIST WITH THE ERRORS
                var list = $(".result:first").append('<ul></ul>').find('ul');
                $(resp.errors).each(function(key,val){
                    list.append('<li>'+val+'</li>');
                })

                $(".result:first").slideDown(500);

                scrollToResult();

            }

        },'json');

    });
});

function updateResult(message,bgClass,faClass){

    var resultBox = $('.result:first');
    resultBox.find('.message').text(message);
    $(".result:first").addClass(bgClass);
    $(".result:first").find('.fa').addClass(faClass);

}


function scrollToResult(){

    $('html, body').animate({
        scrollTop: $(".result:first").offset().top-200
    }, 500);

    return true;
}

/**
 * Clear any previous results in the results box.
 * @returns {boolean}
 */
function clearResult(){


    var resultBox = $(".result:first");
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