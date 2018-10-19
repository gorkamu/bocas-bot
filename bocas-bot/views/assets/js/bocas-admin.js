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

            if('?page=settings' === window.location.search){
                $('.bocas-delete-profile').show()
            }
        });

        $('.bocas-trash').on('click', removeUserAgent);

        $('.bocas-delete-profile').on('click', (e) => {
            e.preventDefault();
            let profile = $('select[name="profile"] option:selected').data('profile-id');
            $.ajax({
                url:"/wp-admin/admin-ajax.php",
                type: 'POST',
                data: {
                    action: 'bocas_admin_remove_profile',
                    profile: profile
                },
                success: function(data){
                    console.log(data);
                    if(data.code === 200 && data.success) {
                        location.reload();
                    }else{

                    }

                }
            });
        });

        function removeUserAgent() {
            let userAgentId = $(this).data('id');
            $.ajax({
                url:"/wp-admin/admin-ajax.php",
                type: 'POST',
                data: {
                    action: 'bocas_admin_remove_user_agent',
                    user_agent: userAgentId
                },
                success: function(data){
                    console.log(data);
                    if(data.code === 200 && data.success) {
                        location.reload();
                    }else{

                    }
                }
            });
        }

        function getUrlVars() {
            let vars = [], hash;
            let hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(let i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }

            return vars;
        }
    });
});