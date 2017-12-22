
$(document).ready(function(){

    $('#route-update').submit(function(e){

        var routeid = $("input[name=routeid]").val();
        var formData = $('#route-update').serialize();

        console.log(formData);

        e.preventDefault();

        $.post('/admin/route-edit.php?id='+routeid,formData,function(resp){

            console.log(resp);

            if(resp.status=='success'){
                //SUCCESS HANDLING
                // PREPEND RESULT BOX
                alert(resp.message);
//                        location.reload();
                window.location.replace("/admin/routes.php");


            } else {
                // ERROR HANDLING
                alert(resp.message);
            }

        },'json');

    })

});