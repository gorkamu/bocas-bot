jQuery(function($) {
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $('#generate_ip_btn').on('click', () => {
            let ip = (Math.floor(Math.random() * 255) + 1)+"."+(Math.floor(Math.random() * 255) + 0)+"."+(Math.floor(Math.random() * 255) + 0)+"."+(Math.floor(Math.random() * 255) + 0);
            $('#ip').val(ip);
        });

        $('select[name="profile"]').on('change', () => {
            let url = getUrlVars();
            let el = $(this).find("option:selected");

            if('add-bocas-comment' === url['page']) {
                $('#name').val(el.data('profile-author'));
            }else{
                $('#name').val(el.data('profile-name'));
            }

            $('#author').val(el.data('profile-author'));
            $('#email').val(el.data('profile-email'));
            $('#web').val(el.data('profile-web'));
            $('#content').val(el.data('profile-content'));
        });
    });

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }


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