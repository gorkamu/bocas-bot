<?php


class BocasBot_Admin
{

    /** @var bool $initiated */
    private static $initiated = false;

    /** @var  $spin */
    private static $spin;

    /**
     * Init function
     */
    public static function init()
    {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }

        self::$spin = new Spintax();
    }

    /**
     * init_hooks function
     */
    public static function init_hooks()
    {
        self::$initiated = true;

        add_action('admin_init', ['BocasBot_Admin', 'bocas_admin_init']);
        add_action('admin_menu', ['BocasBot_Admin', 'bocas_menu']);
        add_action('admin_enqueue_scripts', ['BocasBot_Admin', 'bocas_load_resources']);
        add_action('admin_post_bocas_admin_add_comment', ['BocasBot_Admin', 'bocas_admin_add_comment']);
        add_action('admin_post_bocas_admin_add_profile', ['BocasBot_Admin', 'bocas_admin_add_profile']);
        add_action('admin_post_bocas_admin_bulk_comments',['BocasBot_Admin', 'bocas_admin_bulk_comments']);
        add_action('admin_post_bocas_admin_add_user_agent', ['BocasBot_Admin', 'bocas_admin_add_user_agent']);
        add_action('wp_ajax_bocas_admin_remove_profile', ['BocasBot_Admin', 'bocas_admin_remove_profile']);
        add_action('wp_ajax_bocas_admin_remove_user_agent', ['BocasBot_Admin', 'bocas_admin_remove_user_agent']);

    }

    /**
     * bocas_admin_init()
     * </br>
     *
     * Function to init the plugin resources
     */
    public static function bocas_admin_init()
    {
        //load_plugin_textdomain('bocas');
    }

    /**
     * bocas_menu()
     * </br>
     *
     * Function to add the plugin top-level menu entry
     */
    public static function bocas_menu()
    {
        $icon = sprintf('data:image/svg+xml;base64,%s', base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="1200px" height="1200px" viewBox="0 0 1200 1200" enable-background="new 0 0 1200 1200" xml:space="preserve">
<path fill="none" d="M346.004,812.113c0.043-0.211,0.088-0.418,0.132-0.629l-1.034-2.275  C345.391,810.184,345.689,811.152,346.004,812.113z"/>
<path stroke="#CA3132" stroke-width="0.4946" stroke-miterlimit="2.613" d="M713.799,869.9c0,0,32.84-135.254,64.363-199.604  c23.646-65.65,69.616-111.618,69.616-118.179c0-6.563,130.032-149.696,130.032-149.696s-13.131,0-43.34-5.254  c-38.093,5.248-60.431-17.07-60.431-17.07s-52.539-57.78-101.14-108.991c-43.341-51.212-133.979-2.624-133.979-2.624  s-85.379,55.15-153.681-5.254c-82.755-44.648-149.74,26.264-149.74,26.264s-99.831,89.297-130.04,111.616  c-30.208,22.324-9.192,31.517-9.192,31.517l55.163,70.913L406.42,397.168c0,0,28.899,39.396,88.008,40.71  c-28.899,31.517-110.333,174.645-110.333,174.645s-62.821,116.639-38.996,196.688l1.035,2.275  c56.578-273.949,206.087-367.045,206.087-367.045l34.154-1.314c0,0,111.744,16.882,178.854-55.278  c-0.179-0.186-0.271-0.288-0.271-0.288s-23.646-27.572-22.325-31.518c1.316-3.939-31.522,36.765-81.438,44.643  c-49.903,7.884-81.434-27.572-81.434-27.572s-3.938-22.324-28.899-2.624c-32.839,40.704-97.195,22.317-97.195,22.317  s-42.038-15.749-51.237-55.145c0,0-31.523,24.949-51.225,11.816c-45.977-19.7-11.823-53.842-11.823-53.842  s27.585-26.263,77.5-32.832c59.109,1.315,99.825,36.771,99.825,36.771s43.348,34.141,94.577,3.938  c51.219-36.765,99.825-38.086,99.825-38.086s38.093,0,64.363,26.271c51.218,44.642,49.901,73.536,49.901,73.536  s11.829,10.508-15.762,26.263c-3.288,2.739-6.525,4.638-9.662,5.881c16.194-4.535,28.104-19.911,28.104-19.911  s10.515-1.314,17.077-1.314c15.763,34.147,55.169,36.771,55.169,36.771s57.802-5.254,7.886,28.887  c-161.552,148.388-220.666,384.75-220.666,384.75s-10.079,64.346-62.374,145.191l2.36,0.547l0.013-0.008  C674.809,938.15,713.799,869.9,713.799,869.9z"/>
<path fill="#CA3132" stroke="#CA3132" stroke-width="0.4946" stroke-miterlimit="2.613" d="M1061.875,369.589  c0,0-112.951-27.572-165.49-211.421c0,0-21.021-89.298-90.638-107.677c-132.651-7.869-195.7,81.377-195.729,81.419  c-0.012-0.042-36.802-144.433-197.026-44.642c0,0-45.978,27.577-97.201,110.307c-21.01,122.117-178.634,207.477-178.634,207.477  s-26.271,17.07,1.313,43.333c0,0,136.604,85.354,47.292,174.644c0,0-111.646,191.727-43.346,369.002  c76.186,164.135,228.55,156.264,228.55,156.264s68.302,14.436,130.04-40.709c56.56-45.146,96.323-92.824,124.145-135.834  c52.295-80.846,62.374-145.191,62.374-145.191s59.114-236.363,220.666-384.75c49.916-34.142-7.886-28.888-7.886-28.888  s-39.406-2.624-55.168-36.771c-6.563,0-17.077,1.314-17.077,1.314s-11.911,15.376-28.105,19.911  c-17.938,7.108-32.593-7.292-34.724-9.529c-67.108,72.16-178.854,55.277-178.854,55.277l-34.154,1.314  c0,0-149.509,93.097-206.087,367.045c-0.043,0.209-0.088,0.418-0.132,0.629c-0.314-0.961-0.613-1.932-0.902-2.904  c-23.826-80.049,38.995-196.688,38.995-196.688S465.53,469.396,494.43,437.878c-59.108-1.314-88.008-40.71-88.008-40.71  L251.434,503.538l-55.163-70.913c0,0-21.016-9.191,9.192-31.517c30.209-22.318,130.04-111.616,130.04-111.616  s66.986-70.912,149.74-26.263c68.301,60.403,153.681,5.253,153.681,5.253s90.639-48.587,133.979,2.624  c48.601,51.211,101.14,108.991,101.14,108.991s22.338,22.318,60.431,17.07c30.209,5.254,43.34,5.254,43.34,5.254  S847.78,545.554,847.78,552.118s-45.97,52.529-69.616,118.179c-31.523,64.35-64.363,199.604-64.363,199.604  s-38.99,68.25-86.274,102.391c61.731-2.629,158.521-86.629,158.521-86.629s57.787-74.863,84.063-186.473  c31.522-128.693,197.024-291.521,197.024-291.521S1098.658,376.152,1061.875,369.589z M506.862,892.963  c0,0,28.899-14.445,68.302-156.264c2.624-18.387,22.324-55.158,22.324-55.158c68.308-156.257,128.725-202.222,128.725-202.222  s43.34-27.572,48.606,6.563c18.393,24.955-24.96,39.401-24.96,39.401s-59.104,78.79-81.439,140.508  c-6.57,14.447-74.864,261.313-74.864,261.313s-3.668,14.4-13.575,28.822c-12.279,17.873-34.143,35.777-70.487,26.334  c-27.065-18.861-21.357-48.982-13.251-68.949C501.118,901.301,506.862,892.963,506.862,892.963z M675.399,128.51  c15.421-34.152,53.854-44.648,53.854-44.648s64.362-14.44,85.378,22.325c0,0,13.131,24.947,5.247,39.395  c-21.009,49.896-52.532,23.64-52.532,23.64s-13.133-9.192-14.446-15.762c-9.206-22.317-30.229-1.309-30.229-1.309  S674.084,191.551,675.399,128.51z M424.967,124.187c32.846-59.095,78.816-56.465,78.816-56.465s53.854,1.315,60.424,40.71  c10.501,39.396-22.331,63.028-22.331,63.028s-22.331,18.386-42.032-15.756c-9.199-27.578-31.529-10.507-31.529-10.507  S411.836,191.154,424.967,124.187z M404.003,484.425c30.208-19.701,26.265,13.131,26.265,13.131s1.313,17.071-15.763,18.379  c-61.18,62.51-95.171,132.93-114.662,193.834c-18.589,58.08-23.987,107.506-27.194,133.148  c-6.563,52.521-34.147,47.273-34.147,47.273s-28.899,1.303-34.146-45.959c-6.171-79.186,23.1-151.523,61.004-210.236  C324.258,542.761,404.003,484.425,404.003,484.425z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M799.953,397.377  c3.137-1.243,6.374-3.142,9.662-5.881c27.591-15.755,15.762-26.263,15.762-26.263s1.314-28.895-49.902-73.536  c-26.271-26.271-64.362-26.271-64.362-26.271s-48.606,1.322-99.825,38.086c-51.23,30.202-94.577-3.938-94.577-3.938  s-40.716-35.456-99.825-36.771c-49.915,6.569-77.5,32.832-77.5,32.832s-34.154,34.142,11.823,53.842  c19.701,13.133,51.225-11.816,51.225-11.816c9.199,39.396,51.237,55.145,51.237,55.145s64.355,18.386,97.195-22.317  c24.961-19.701,28.899,2.624,28.899,2.624s31.53,35.457,81.434,27.571c49.915-7.877,82.755-48.581,81.438-44.642  c-1.321,3.945,22.325,31.517,22.325,31.517s0.092,0.104,0.27,0.289c0.366-0.395,0.732-0.788,1.098-1.187  C777.967,398.805,789.801,400.219,799.953,397.377z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M503.783,67.721  c0,0-45.971-2.63-78.816,56.466c-13.131,66.967,43.348,21.01,43.348,21.01s22.33-17.07,31.529,10.507  c19.701,34.142,42.032,15.756,42.032,15.756s32.833-23.633,22.331-63.028C557.638,69.037,503.783,67.721,503.783,67.721z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M729.254,83.862  c0,0-38.434,10.496-53.854,44.648c-1.315,63.041,47.271,23.641,47.271,23.641s21.021-21.01,30.229,1.309  c1.313,6.569,14.446,15.762,14.446,15.762s31.523,26.257,52.532-23.64c7.884-14.447-5.247-39.395-5.247-39.395  C793.616,69.421,729.254,83.862,729.254,83.862z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M774.819,485.881  c-5.268-34.135-48.606-6.563-48.606-6.563s-60.417,45.964-128.725,202.222c0,0-19.7,36.771-22.324,55.158  c-39.402,141.816-68.302,156.264-68.302,156.264s-5.744,8.338-10.621,20.35c-8.106,19.967-13.814,50.088,13.251,68.949  c36.346,9.443,58.208-8.461,70.486-26.334c9.908-14.422,13.576-28.822,13.576-28.822s68.294-246.865,74.864-261.314  c22.336-61.719,81.439-140.507,81.439-140.507S793.212,510.836,774.819,485.881z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M404.003,484.425  c0,0-79.745,58.336-138.645,149.573c-37.904,58.713-67.177,131.051-61.005,210.236c5.248,47.26,34.147,45.957,34.147,45.957  s27.585,5.248,34.147-47.273c3.206-25.643,8.605-75.066,27.194-133.148c19.491-60.902,53.482-131.323,114.662-193.833  c17.076-1.31,15.762-18.38,15.762-18.38S434.211,464.725,404.003,484.425z"/>
<path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.4946" stroke-miterlimit="2.613" d="M799.953,397.377  c-10.152,2.842-21.986,1.428-33.627-10.717c-0.364,0.399-0.73,0.792-1.098,1.187C767.36,390.085,782.014,404.486,799.953,397.377z"/>
</svg>'));

        add_menu_page(
            'Bocas Bot',
            'Bocas Bot',
            'manage_options',
            'bocas-bot',
            ['BocasBot_Admin', 'bocas_admin_comments_view'],
            $icon,
            20
        );

        add_submenu_page(
            'bocas-bot',
            'Add Comment',
            'Add Comment',
            'manage_options',
            'add-bocas-comment',
            ['BocasBot_Admin', 'bocas_admin_add_comment_view']
        );

        add_submenu_page(
            'bocas-bot',
            'Bulk Comments',
            'Bulk Comments',
            'manage_options',
            'bulk-bocas-comments',
            ['BocasBot_Admin', 'bocas_admin_bulk_comments_view']
        );

        add_submenu_page(
            'bocas-bot',
            'Settings',
            'Settings',
            'manage_options',
            'settings',
            ['BocasBot_Admin', 'bocas_admin_comments_view']
        );

        remove_submenu_page('bocas-bot', 'bocas-bot');
    }

    /**
     * bocas_admin_comments_view()
     * </br>
     *
     * Function to display the main plugin admin view
     */
    public static function bocas_admin_comments_view()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        global $wpdb;

        $userAgents = $wpdb->get_results("SELECT id, name, user_agent FROM {$wpdb->base_prefix}user_agents");
        $profiles = $wpdb->get_results("SELECT id, name, author, email, web, content FROM {$wpdb->base_prefix}profiles");

        BocasBot::view('bocas-admin-settings', 'backend', [
            'userAgents' => $userAgents,
            'profiles' => $profiles
        ] );
    }

    /**
     * bocas_admin_bulk_comments_view()
     * </br>
     *
     */
    public static function bocas_admin_bulk_comments_view()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        global $wpdb;

        $query = "SELECT wc.*, wp.ID, wp.post_title, wp.guid FROM $wpdb->comments AS wc INNER JOIN $wpdb->posts AS wp ON wp.ID = wc.comment_post_ID WHERE wc.comment_bocas = 1 AND wc.comment_approved NOT IN ('trash');";
        $comments = $wpdb->get_results($query);

        BocasBot::view('bocas-admin-bulk-comments', 'backend', [
            'comments' => $comments
        ] );
    }

    /**
     * bocas_admin_bulk_comments()
     * <br/>
     *
     */
    public function bocas_admin_bulk_comments()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if('bocas_admin_bulk_comments' === sanitize_text_field($_POST['action']) ) {
            if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']){
                $overrides = ['test_form' => false, 'test_type' => false];
                $movefile = wp_handle_upload( $_FILES['fileToUpload'], $overrides );

                if ($movefile && ! isset( $movefile['error'])) {
                    BocasBot::save_csv_comments_file($movefile['file']);
                    unlink($movefile['file']);
                }
            }

            if(isset($_POST['csv']) && $_POST['csv']){
                BocasBot::save_csv_comments_string($_POST['csv']);
            }

            wp_safe_redirect(admin_url('admin.php?page=bulk-bocas-comments'));
        }
    }

    /**
     * bocas_admin_add_comment_view()
     * </br>
     *
     * Function to display the attached services view
     */
    public static function bocas_admin_add_comment_view()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        global $wpdb;

        $posts = $wpdb->get_results("SELECT ID, post_title  FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish'");
        $comments = $wpdb->get_results("SELECT wc.*, wp.ID, wp.post_title, wp.guid FROM $wpdb->comments AS wc INNER JOIN $wpdb->posts AS wp ON wp.ID = wc.comment_post_ID WHERE wc.comment_bocas = 1 AND wc.comment_approved NOT IN ('trash');");
        $profiles = $wpdb->get_results("SELECT id, name, author, email, web, content FROM {$wpdb->base_prefix}profiles");

        BocasBot::view('bocas-admin-add-comment', 'backend', [
            'posts' => $posts,
            'userAgents' => BocasBot::getUserAgents(),
            'comments' => $comments,
            'profiles' => $profiles
        ]);
    }

    public static function bocas_admin_add_profile()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if('bocas_admin_add_profile' === sanitize_text_field($_POST['action'])) {
            global $wpdb;

            $tableName = $wpdb->base_prefix.'profiles';

            if(
                (!isset($_POST['name']) || is_null($_POST['name'])) &&
                (!isset($_POST['author']) || is_null($_POST['author'])) &&
                (!isset($_POST['email']) || is_null($_POST['email'])) &&
                (!isset($_POST['web']) || is_null($_POST['web'])) &&
                (!isset($_POST['content']) || is_null($_POST['content']))
            ){
                wp_safe_redirect(admin_url('admin.php?page=add-bocas-comment'));
            }

            if(isset($_POST['profile']) && "" !== $_POST['profile']){
                $wpdb->update($tableName, [
                    'name' => sanitize_text_field($_POST['name']),
                    'author' => sanitize_text_field($_POST['author']),
                    'email' => sanitize_text_field($_POST['email']),
                    'web' => sanitize_text_field($_POST['web']),
                    'content' => sanitize_text_field($_POST['content'])
                ], ['id' => $_POST['profile']]);
            }else{
                $wpdb->insert($tableName, [
                    'name' => sanitize_text_field($_POST['name']),
                    'author' => sanitize_text_field($_POST['author']),
                    'email' => sanitize_text_field($_POST['email']),
                    'web' => sanitize_text_field($_POST['web']),
                    'content' => sanitize_text_field($_POST['content'])
                ], '%s');
            }

            wp_safe_redirect(admin_url('admin.php?page=settings'));
        }
    }

    /**
     * bocas_admin_remove_profile()
     * <br/>
     *
     * Function to remove the selected profile
     *
     * @throws Exception
     */
    public static function bocas_admin_remove_profile()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if(!isset($_POST['profile'])) {
            throw new Exception('Missing parameter', 500);
        }

        $profile = sanitize_text_field($_POST['profile']);

        global $wpdb;

        try {
            $tableName = $wpdb->base_prefix.'profiles';
            $wpdb->delete($tableName, ['id' => $profile]);
            $result = [
                'action' => 'bocas_admin_remove_profile',
                'profile' => $profile,
                'success' => true,
                'code' => 200
            ];
        } catch (Exception $e) {
            $result = [
                'action' => 'bocas_admin_remove_profile',
                'succes' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }

        wp_send_json($result);
    }

    /**
     * bocas_admin_remove_user_agent()
     * <br/>
     *
     * Function to remove the selected profile
     *
     * @throws Exception
     */
    public static function bocas_admin_remove_user_agent()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if(!isset($_POST['user_agent'])) {
            throw new Exception('Missing parameter', 500);
        }

        $userAgent = sanitize_text_field($_POST['user_agent']);

        global $wpdb;

        try {
            $tableName = $wpdb->base_prefix.'user_agents';
            $wpdb->delete($tableName, ['id' => $userAgent]);
            $result = [
                'action' => 'bocas_admin_remove_user_agent',
                'userAgent' => $userAgent,
                'success' => true,
                'code' => 200
            ];
        } catch (Exception $e) {
            $result = [
                'action' => 'bocas_admin_remove_user_agent',
                'succes' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }

        wp_send_json($result);
    }

    /**
     * bocas_admin_add_comment()
     * </br>
     *
     * Function to add a new comment
     */
    public static function bocas_admin_add_comment()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if('bocas_admin_add_comment' === sanitize_text_field($_POST['action'])) {
            global $wpdb;

            $tableName = sprintf("%scomments",$wpdb->base_prefix);

            if(
                (!isset($_POST['post']) || is_null($_POST['post'])) &&
                (!isset($_POST['name']) || is_null($_POST['name'])) &&
                (!isset($_POST['email']) || is_null($_POST['email'])) &&
                (!isset($_POST['web']) || is_null($_POST['web'])) &&
                (!isset($_POST['ip']) || is_null($_POST['ip'])) &&
                (!isset($_POST['date']) || is_null($_POST['date'])) &&
                (!isset($_POST['content']) || is_null($_POST['content'])) &&
                (!isset($_POST['status']) || is_null($_POST['status'])) &&
                (!isset($_POST['user-agent']) || is_null($_POST['user-agent']))
            ){
                wp_safe_redirect(admin_url('admin.php?page=add-bocas-comment'));
            }

            $wpdb->insert($tableName, [
                'comment_post_ID' => sanitize_text_field($_POST['post']),
                'comment_author' => self::$spin->process(sanitize_text_field($_POST['name'])),
                'comment_author_email' => self::$spin->process(sanitize_text_field($_POST['email'])),
                'comment_author_url' => self::$spin->process(sanitize_text_field($_POST['web'])),
                'comment_author_IP' => sanitize_text_field($_POST['ip']),
                'comment_date' => date('Y-m-d G:i:s', strtotime(sanitize_text_field($_POST['date']))),
                'comment_date_gmt' => date('Y-m-d G:i:s', strtotime(sanitize_text_field($_POST['date']))),
                'comment_content' => self::$spin->process(sanitize_text_field($_POST['content'])),
                'comment_karma' => 0,
                'comment_approved' => sanitize_text_field($_POST['status']),
                'comment_agent' => sanitize_text_field($_POST['user-agent']),
                'comment_type' => '',
                'comment_parent' => 0,
                'user_id' => 0,
                'comment_bocas' => true
            ], '%s');

            wp_safe_redirect(admin_url('admin.php?page=add-bocas-comment'));
        }
    }

    /**
     * bocas_admin_add_user_agent
     * <br/>
     */
    public static function bocas_admin_add_user_agent()
    {
        if(!current_user_can('manage_options')){
            wp_die( 'You are not allowed to be on this page.' );
        }

        if('bocas_admin_add_user_agent' === sanitize_text_field($_POST['action'])) {
            global $wpdb;

            $tableName = $wpdb->base_prefix.'user_agents';

            if(
                (!isset($_POST['name']) || is_null($_POST['name'])) &&
                (!isset($_POST['user_agent']) || is_null($_POST['user_agent']))
            ){
                wp_safe_redirect(admin_url('admin.php?page=add-bocas-comment'));
            }

            $wpdb->insert($tableName, [
                'name' => sanitize_text_field($_POST['name']),
                'user_agent' => sanitize_text_field($_POST['user_agent']),
            ], '%s');

            wp_safe_redirect(admin_url('admin.php?page=bocas-bot'));
        }
    }

    /**
     * bocas_load_resources()
     * </br>
     *
     * Function to load assets
     */
    public static function bocas_load_resources()
    {
        wp_register_script('bootstrap_js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
        wp_enqueue_script('bootstrap_js');
        wp_register_style('bootstrap_css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap_css');

        wp_register_script('jquery_ui_js', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
        wp_enqueue_script('jquery_ui_js');
        wp_register_style('jquery_ui_css', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
        wp_enqueue_style('jquery_ui_css');

        wp_register_style('datetimepicker_css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css');
        wp_enqueue_style('datetimepicker_css');

        wp_enqueue_style('bocas-admin-css', plugins_url( 'views/assets/css/bocas-admin.css' , dirname(__FILE__) ) );
        wp_enqueue_script('bocas-admin-js', plugins_url( 'views/assets/js/bocas-admin.js' , dirname(__FILE__) ), [], BOCAS_BOT__VERSION, true );
    }

    /**
     * @return mixed
     */
    public static function getSpintax()
    {
        return self::$spin;
    }

}
