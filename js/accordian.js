// SIMPLE ACCORDIAN FUNCTION
$(document).ready(function($) {
    $('.accordion').find('.accordion-toggle').click(function(){

        $(this).next().slideToggle('fast');
        $(".accordion-content").not($(this).next()).slideUp('fast');

    });
});