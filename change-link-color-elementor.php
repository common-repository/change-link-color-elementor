<?php
/**
 * Plugin Name: Change Link Color Elementor
 * Plugin URI: https://mostafijur.me/
 * Description: Allow users to change the text editor link color.
 * Author: Mostafijur Rahman
 * Version: 1.0.0
 * License: GPLv2 or later
 * Text Domain: changelinkcolor
 */

/**
 * Exit if directly accessing 
 */  
 if( ! defined( 'ABSPATH' ) ){
    exit;
 }


// Change link color elementor main class
class Change_Link_Color_Elementor{

    /**
     * Initialize the plugin
     */
    function __construct() {
        $this->includes_file();
    }

    /**
     * Include change link color main class
     * 
     */ 
    public function includes_file(){
        include_once 'includes/class-change-link-color.php';
    }

    /**
     * Version
     * 
     * @var float
     */
    const VERSION = '1.0.0';

    /**
     * Return object a single instance of this class.
     * 
     */ 
    protected static $instance = null;

    public static function get_the_instance(){
        if( null == self::$instance ){
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Get main file path
     * 
     * @return string
     */
    public static function get_the_main_file(){
        return __FILE__;
    }

    /**
     * Get the plugin dir path
     * 
     * @return string
     */
    public function get_the_plugin_dir_path(){
        return plugin_dir_path( __FILE__ );
    }

    /**
     * Get the plugin dir url
     * 
     * @return string
     */
    public static function get_plugin_dir_url(){
        return plugin_dir_url( __FILE__ );
    }

    /**
     * Get the plugin url
     * 
     * @return string
     */ 
    public static function get_the_plugin_url(){
        return untrailingslashit( plugins_url( '/', __FILE__ ));

    }

}

add_action( 'plugins_loaded', array('Change_Link_Color_Elementor', 'get_the_instance') );