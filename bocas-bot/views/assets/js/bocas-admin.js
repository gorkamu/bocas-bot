jQuery(function($) {
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });


    //$('.vye-bc-delete-service-btn').on('click', function() {
    //    var keyName = $(this).parent().parent().parent().data('key');
    //    var id = $(this).parent().parent().parent().data('id');
    //    var keyPart = keyName.split("_");
    //
    //    $.ajax({
    //        url:"/wp-admin/admin-ajax.php",
    //        type: 'POST',
    //        data: {
    //            action: 'delete_service',
    //            hash_token: $(this).data('token'),
    //            key: keyPart[1],
    //            id: id
    //        },
    //        success: function(data){
    //            console.log(data);
    //            if(data.code === 200) {
    //                $('.alert').removeClass('alert-danger').addClass('alert-success');
    //                $('tr[data-id="'+data.id+'"]').remove();
    //            }else{
    //                $('.alert').removeClass('alert-success').addClass('alert-danger');
    //            }
    //            $('.alert-msg').html(data.msg);
    //            $('.alert').show();
    //        }
    //    });
    //});

});