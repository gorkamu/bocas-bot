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
        $icon = sprintf('data:image/svg+xml;base64,%s', base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#F4900C" d="M35 19c0-2.062-.367-4.039-1.04-5.868-.46 5.389-3.333 8.157-6.335 6.868-2.812-1.208-.917-5.917-.777-8.164.236-3.809-.012-8.169-6.931-11.794 2.875 5.5.333 8.917-2.333 9.125-2.958.231-5.667-2.542-4.667-7.042-3.238 2.386-3.332 6.402-2.333 9 1.042 2.708-.042 4.958-2.583 5.208-2.84.28-4.418-3.041-2.963-8.333C2.52 10.965 1 14.805 1 19c0 9.389 7.611 17 17 17s17-7.611 17-17z"/><path fill="#FFCC4D" d="M28.394 23.999c.148 3.084-2.561 4.293-4.019 3.709-2.106-.843-1.541-2.291-2.083-5.291s-2.625-5.083-5.708-6c2.25 6.333-1.247 8.667-3.08 9.084-1.872.426-3.753-.001-3.968-4.007C7.352 23.668 6 26.676 6 30c0 .368.023.73.055 1.09C9.125 34.124 13.342 36 18 36s8.875-1.876 11.945-4.91c.032-.36.055-.722.055-1.09 0-2.187-.584-4.236-1.606-6.001z"/></svg>'));

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

        $userAgents = $wpdb->get_results("SELECT name, user_agent FROM wp_user_agents");
        $profiles = $wpdb->get_results("SELECT id, name, author, email, web, content FROM wp_profiles");

        BocasBot::view('bocas-admin-comments', 'backend', [
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

        $query = "SELECT wc.*, wp.ID, wp.post_title, wp.guid FROM $wpdb->comments AS wc INNER JOIN $wpdb->posts AS wp ON wp.ID = wc.comment_post_ID WHERE wc.comment_bocas = 1;";
        $comments = $wpdb->get_results($query);

        BocasBot::view('bocas-admin-bulk-comments', 'backend', [
            'comments' => $comments
        ] );
    }

    // http://www.wordreference.com/sinonimos/adulto

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

        $query = "SELECT wc.*, wp.ID, wp.post_title, wp.guid FROM $wpdb->comments AS wc INNER JOIN $wpdb->posts AS wp ON wp.ID = wc.comment_post_ID WHERE wc.comment_bocas = 1;";
        $comments = $wpdb->get_results($query);
        $profiles = $wpdb->get_results("SELECT id, name, author, email, web, content FROM wp_profiles");

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

            $tableName = 'wp_profiles';

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

            wp_safe_redirect(admin_url('admin.php?page=bocas-bot'));
        }
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

            $tableName = 'wp_comments';

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

            // {Maria {de la O | Rodriguez | Antonieta} de todos los santos | Juan {el preparado | el constitucionalista} mola}
            // {maria.{delao| rodriguez| antonieta89}@gmail.com| juan.{elpreparado|elconstitucionalista}@hotmail.com}
            // {un {componente | componente | aspecto} importante de SEO | útil para {obtener | ganar} backlinks}.

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

            $tableName = 'wp_user_agents';

            if(
                (!isset($_POST['name']) || is_null($_POST['name'])) &&
                (!isset($_POST['user_agent']) || is_null($_POST['user_agent']))
            ){
                wp_safe_redirect(admin_url('admin.php?page=add-bocas-comment'));
            }

            // {Maria {de la O | Rodriguez | Antonieta} de todos los santos | Juan {el preparado | el constitucionalista} mola}
            // {maria.{delao| rodriguez| antonieta89}@gmail.com| juan.{elpreparado | elconstitucionalista}@hotmail.com}
            // {un {componente | componente | aspecto} importante de SEO | útil para {obtener | ganar} backlinks}.

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
//        if ( in_array( $hook_suffix, apply_filters( 'akismet_admin_page_hook_suffixes', array(
//            'index.php', # dashboard
//            'edit-comments.php',
//            'comment.php',
//            'post.php',
//            'settings_page_akismet-key-config',
//            'jetpack_page_akismet-key-config',
//            'plugins.php',
//        ) ) ) ) {
//
//        }

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
