<?php
/*
Plugin Name: Bocas Bot - Auto WP Comments Scheduler
Description: 🔥 Used by millions, Bocas Bot is quite possibly the <strong>best plugin to schedule your own and fake comments</strong> on your posts
Version:     0.0.1
Author:      Gorkamu
Author URI:  http://www.gorkamu.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define( 'BOCAS_BOT__VERSION', '0.0.1' );
define( 'BOCAS_BOT__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BOCAS_BOT__SRC_DIR', BOCAS_BOT__PLUGIN_DIR . 'src/' );
define( 'BOCAS_BOT__VIEWS_DIR', BOCAS_BOT__PLUGIN_DIR . 'views/' );

register_activation_hook( __FILE__, array('BocasBot', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array('BocasBot', 'plugin_deactivation' ) );

require_once( BOCAS_BOT__SRC_DIR . 'class.bocas-bot.php' );

add_action( 'init', array('BocasBot', 'init' ) );
add_action('plugins_loaded', array ('BocasBot', 'setup' ) );


if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( BOCAS_BOT__SRC_DIR . 'class.bocas-bot-admin.php' );
    require_once( BOCAS_BOT__SRC_DIR . 'class.spintax.php' );
    add_action( 'init', array('BocasBot_Admin', 'init' ) );
}