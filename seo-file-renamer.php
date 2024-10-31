<?php
/*
 * Plugin Name: SEO File Renamer
 * Version: 1.0.3
 * Description: A super simple plugin for uploaded file name sanitization.
 * Author: Kinski & Bourke
 * Author URI: https://kinskiandbourke.com/
 * Tags: seo, renamer, google search, sanitization
 * Requires at least: 5.1.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: seo-file-renamer
 */

if ( ! class_exists( 'WordPress_SEO_File_Renamer' ) ) :

    class WordPress_SEO_File_Renamer {
        public $defaults = array();
        public $options = array();
        public function __construct() {
            $this->define_constants();
            $this->init_hooks();
        }

        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        private function define_constants() {
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER', 'seo-file-renamer' );
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_BN', plugin_basename( __FILE__ ) );

            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_URL', plugin_dir_url( __FILE__ ) );
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_CSS_URL', WORDPRESS_SEO_FILE_RENAMER_URL . 'assets/css' );
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_IMG_URL', WORDPRESS_SEO_FILE_RENAMER_URL . 'assets/images' );
            // DIR
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_DIR', plugin_dir_path( __FILE__ ) );
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_LIB_DIR', WORDPRESS_SEO_FILE_RENAMER_DIR . '/lib' );
            $this->define( 'WORDPRESS_SEO_FILE_RENAMER_ADMIN_DIR', WORDPRESS_SEO_FILE_RENAMER_LIB_DIR . '/admin' );
        }

        private function init_hooks() {
            add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), array( $this, 'plugin_url' ) );
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_print_styles', array( $this, 'admin_styles' ) );
            add_filter( 'sanitize_file_name', array( $this, 'sanitize_file_name_chars' ), 10, 3 );
        }

        public function sanitize_file_name_chars( $filename ) {
            $options = get_option( 'wp_seo_file_renamer_settings' );
            $name = isset( $options['name'] ) && $options['name'] ? esc_attr( $options['name'] ) : 0;

            $sanitized_filename = remove_accents( $filename ); // Convert to ASCII

            // Standard replacements
            $invalid = array( ' ' => '-',  '%20' => '-',   '_' => '-', ' ' => '-', '​' => '-' );
            $sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);
            $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
            $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
            $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
            $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
            $sanitized_filename = ltrim($sanitized_filename, '-');

            // $sanitized_filename = strtoupper($sanitized_filename); // Make a string uppercase
            if( ! $name ) {
                $sanitized_filename = strtolower( $sanitized_filename ); // Lowercase
            }

            return $sanitized_filename;
        }

        public function admin_menu() {
            add_menu_page(
                __( 'SEO File Renamer', 'seo-file-renamer' ),
                __( 'SEO File Renamer', 'seo-file-renamer' ),
                'manage_options',
                'seo-file-renamer',
                array( $this, 'settings' ),
                WORDPRESS_SEO_FILE_RENAMER_URL . '/assets/images/seo-renamer-icon.svg'
            );

            //call register settings function
            add_action( 'admin_init', array( $this, 'register_setting' ) );
        }

        public function register_setting() {
            register_setting( 'wp_seo_file_renamer_settings', 'wp_seo_file_renamer_settings' );
        }

        public function settings(){
            include( WORDPRESS_SEO_FILE_RENAMER_ADMIN_DIR . '/page.php' );
        }

        public function plugin_url( $actions ){
            $custom_links = array(
                '<a href="' . admin_url( 'admin.php?page=seo-file-renamer' ) . '">'.__( 'Settings', 'seo-file-renamer' ).'</a>',
            );
            
            $actions = array_merge( $actions, $custom_links );
            return $actions;
        }

        public function admin_styles(){
            wp_register_style( 'seo-file-renamer-admin', WORDPRESS_SEO_FILE_RENAMER_CSS_URL . '/admin.css' );
            wp_enqueue_style( 'seo-file-renamer-admin' );
        }   
    }

    add_action( 'plugins_loaded', 'wp_seo_file_renamer', 5 );
    function wp_seo_file_renamer(){
        new WordPress_SEO_File_Renamer;
    }

endif;