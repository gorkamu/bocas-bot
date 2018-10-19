<?php

class BocasBot
{

    /** @var bool $initiated */
    private static $initiated = false;

    /**
     * init function
     */
    public static function init()
    {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }
    }

    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks()
    {
        self::$initiated = true;
    }

    /**
     * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
     * @static
     */
    public static function plugin_activation()
    {
        self::bocas_update_db();
        wp_schedule_event( time(), 'hourly', 'bocas_publish_cron');
    }

    /**
     * Create database tables
     */
    private static function bocas_update_db()
    {
        global $wpdb;

        try {
            $value = null;

            $row = $wpdb->get_results("show variables like 'sql_mode'");
            if ($row) {
                $value = $row[0]->Value;
            }

            $sql = "SET sql_mode = ''";
            $wpdb->query($sql);

            $sql = "ALTER TABLE wp_comments ADD comment_bocas BOOLEAN";
            $wpdb->query($sql);

            $charsetCollate = $wpdb->get_charset_collate();
            $tableName = $wpdb->prefix . "user_agents";
            $sql = "CREATE TABLE $tableName (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              name tinytext NOT NULL,
              user_agent text NOT NULL,
              PRIMARY KEY  (id)
            ) $charsetCollate;";
            $wpdb->query($sql);

            $userAgents = self::loadUserAgents();
            foreach ($userAgents as $name => $userAgent) {
                $sql = "INSERT INTO $tableName (name, user_agent) VALUES('$name', '$userAgent')";
                $wpdb->query($sql);
            }

            $tableName = $wpdb->prefix . "profiles";
            $sql = "CREATE TABLE $tableName (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              name tinytext NOT NULL,
              author text NOT NULL,
              email text NOT NULL,
              web text NOT NULL,
              content text NOT NULL,
              PRIMARY KEY  (id)
            ) $charsetCollate;";
            $wpdb->query($sql);

            $sql = sprintf("SET sql_mode = '%s'", $value);
            $wpdb->query($sql);

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        } catch (Exception $e) {

        }
    }

    /**
     * setup()
     * <br/>
     */
    public static function setup()
    {
        add_action('bocas_publish_cron', ['BocasBot', 'bocas_publish']);
    }

    /**
     * bocas_publish()
     * <br/>
     */
    public static function bocas_publish()
    {
        global $wpdb;

        $sql = "SELECT * FROM $wpdb->comments WHERE comment_bocas=1 AND comment_approved=0 AND date_format(comment_date, '%Y-%m-%d') = '" . date('Y-m-d') . "'";
        $comments = $wpdb->get_results($sql);

        if($comments){
            $sql = "UPDATE $wpdb->comments SET comment_approved = 1 WHERE comment_bocas=1 AND comment_approved = 0 AND date_format(comment_date, '%Y-%m-%d') = '" . date('Y-m-d') . "'";
            $wpdb->query($sql);
        }
    }

    /**
     * Removes all connection options
     * @static
     */
    public static function plugin_deactivation( )
    {
        self::bocas_drop_db();
        wp_clear_scheduled_hook( 'bocas_publish_cron' );
    }

    /**
     * Drop database tables
     */
    private static function bocas_drop_db()
    {
        global $wpdb;

        try {
            $value = null;

            $row = $wpdb->get_results("show variables like 'sql_mode'");
            if ($row) {
                $value = $row[0]->Value;
            }

            $sql = "SET sql_mode = ''";
            $wpdb->query($sql);

            $sql = 'ALTER TABLE wp_comments DROP COLUMN comment_bocas';
            $wpdb->query($sql);

            $tableName = $wpdb->prefix . "user_agents";
            $sql = "DROP TABLE $tableName";
            $wpdb->query($sql);

            $tableName = $wpdb->prefix . "profiles";
            $sql = "DROP TABLE $tableName";
            $wpdb->query($sql);

            $sql = sprintf("SET sql_mode = '%s'", $value);
            $wpdb->query($sql);

        } catch (Exception $e) {

        }
    }

    /**
     * view()
     * <br/>
     *
     * Function to include a view
     *
     * @param $name
     * @param array $args
     */
    public static function view( $name, $scope, array $args = array() )
    {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        foreach ( $args AS $key => $val ) {
            $$key = $val;
        }

        $file = BOCAS_BOT__VIEWS_DIR. $scope .'/'. $name . '.php';

        include($file);
    }

    /**
     * csv_string_to_array()
     * <br/>
     *
     * @param $string
     * @param string $delimiter
     * @return array
     */
    public static function save_csv_comments_string($string, $delimiter=',')
    {
        $csv = str_replace("\r", "<br>", $string);

        $header = NULL;
        $data = [];
        $rows = explode(PHP_EOL, $csv);

        foreach($rows as $row_str)
        {
            $row = str_getcsv($row_str);

            if(!$header) {
                $header = $row;
            } else {
                if(count($header)!=count($row)){
                    continue;
                }
                $data[] = array_combine($header, $row);
            }
        }

        foreach($data as $key => $comment) {
            self::__insert_comment($comment);
        }

        return $data;
    }

    /**
     * save_csv_comments_file()
     * <br/>
     *
     * @param $file
     * @param string $mode
     * @return array
     */
    public static function save_csv_comments_file($file, $mode = 'r+')
    {
        $fh = fopen($file, $mode);
        $lines = [];

        $header = NULL;

        while( ($row = fgetcsv($fh, 8192)) !== FALSE ) {
            if(!$header) {
                $header = $row;
            } else {
                if(count($header)!=count($row)){
                    continue;
                }
                $lines[] = array_combine($header, $row);
            }
        }

        foreach($lines as $key => $line) {
            self::__insert_comment($line);
        }

        return $lines;
    }

    /**
     * __insert_comment()
     * <br/>
     *
     * @param $comment
     */
    private static function __insert_comment($comment)
    {
        global $wpdb;

        $wpdb->insert($wpdb->comments, [
            'comment_post_ID' => sanitize_text_field($comment['post']),
            'comment_author' => BocasBot_Admin::getSpintax()->process(sanitize_text_field($comment['name'])),
            'comment_author_email' => BocasBot_Admin::getSpintax()->process(sanitize_text_field($comment['email'])),
            'comment_author_url' => BocasBot_Admin::getSpintax()->process(sanitize_text_field($comment['web'])),
            'comment_author_IP' => sanitize_text_field($comment['ip']),
            'comment_date' => date('Y-m-d G:i:s', strtotime(sanitize_text_field($comment['date']))),
            'comment_date_gmt' => date('Y-m-d G:i:s', strtotime(sanitize_text_field($comment['date']))),
            'comment_content' => BocasBot_Admin::getSpintax()->process(sanitize_text_field($comment['content'])),
            'comment_karma' => 0,
            'comment_approved' => sanitize_text_field($comment['status']),
            'comment_agent' => sanitize_text_field($comment['user-agent']),
            'comment_type' => '',
            'comment_parent' => 0,
            'user_id' => 0,
            'comment_bocas' => 1
        ], '%s');
    }

    /**
     * @param $date
     * @return null|string
     */
    public static function datePretify($date)
    {
        $result = null;
        if('0000-00-00 00:00:00' === $date) {
            $result = '--';
        }else{
            $result = str_replace(' 00:00:00','',$date);
        }
        return $result;
    }

    /**
     * @return array|null|object
     */
    public static function getUserAgents()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . "user_agents";
        $sql = "SELECT name, user_agent from $tableName";
        $results = $wpdb->get_results( $sql, OBJECT );

        return $results;

    }

    /**
     * @return array
     */
    public static function loadUserAgents()
    {
        return [
            'Windows 10 Chrome 42' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
            'OSX Chrome 51' => 'Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36',
            'OSX Safari' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9',
            'Windows 10 Chrome 47' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
            'Ubuntu Firefox 15' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1',
            'Samsung Galaxy Tab A Chrome 38' => 'Mozilla/5.0 (Linux; Android 5.0.2; SAMSUNG SM-T550 Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/3.3 Chrome/38.0.2125.102 Safari/537.36',
            'IOS 9 Safari' => 'Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
            'BQ Android Chrome 38' => 'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
            'Chrome 42' => 'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
        ];
    }
}