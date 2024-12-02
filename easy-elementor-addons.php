<?php

/**
 * Plugin Name: Easy Elementor Addons - Addons Pack for Elementor Page Builder Plugin
 * Plugin URI: https://demo.hashthemes.com/easy-elementor-addons/
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 2.0.6
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: easy-elementor-addons
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * Elementor tested up to: 3.25
 * Elementor Pro tested up to: 3.2.1
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('EEAD_VERSION', '2.0.6');

define('EEAD_FILE', __FILE__);
define('EEAD_PLUGIN_BASENAME', plugin_basename(EEAD_FILE));
define('EEAD_PATH', plugin_dir_path(EEAD_FILE));
define('EEAD_URL', plugins_url('/', EEAD_FILE));

define('EEAD_ASSETS_URL', EEAD_URL . 'assets/');

if (!class_exists('Easy_Elementor_Addons')) {

    class Easy_Elementor_Addons {

        private static $instance = NULL;

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (self::$instance == NULL) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // Run On Plugin Activation 
            register_activation_hook(__FILE__, array($this, 'plugin_activation'));

            // Load necessary files.
            add_action('plugins_loaded', array($this, 'init'));
        }

        public function load_plugin_textdomain() {
            load_plugin_textdomain('easy-elementor-addons', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function init() {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', array($this, 'required_plugins_notice'));
                return;
            }

            require EEAD_PATH . 'inc/widget-loader.php';
            require EEAD_PATH . 'inc/helper-functions.php';
            require EEAD_PATH . 'inc/icon-manager.php';
            require EEAD_PATH . 'inc/sticky-column.php';
            require EEAD_PATH . 'inc/admin-menu/admin-menu-class.php';
            require EEAD_PATH . 'inc/live-editor/live-editor-class.php';
            //require EEAD_PATH . 'inc/cross-domain-cp/cross-domain-cp-integration.php';

        }

        public function required_plugins_notice() {
            $screen = get_current_screen();
            if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ($this->is_elementor_installed()) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }

                $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $admin_message = '<p>' . esc_html__('Oops! Easy Elementor Addons is not working because you need to activate the Elementor plugin first.', 'easy-elementor-addons') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'easy-elementor-addons')) . '</p>';
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }

                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $admin_message = '<p>' . esc_html__('Oops! Easy Elementor Addons is not working because you need to install the Elementor plugin', 'easy-elementor-addons') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'easy-elementor-addons')) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }

        /**
         * Check if theme has elementor installed
         *
         * @return boolean
         */
        public function is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset($installed_plugins[$file_path]);
        }

        public function plugin_activation() {
            $widgets = self::get_all_default_widgets();
            if (get_option('eead_widgets') == false) {
                update_option('eead_widgets', $widgets);
            }
        }

        public static function get_all_default_widgets() {
            $modules_list = [
                'accordion',
                'advanced-button',
                'advanced-heading',
                'advanced-icon-box',
                'advanced-map',
                'animated-heading',
                'animated-icon', //premium
                'business-hour',
                'caption-hover-effect', //premium
                'charts', //premium
                'circular-progressbar',
                'countdown',
                'counter',
                'drop-bar',
                'dual-button',
                'dual-heading',
                'feature-list',
                'filterable-gallery', //premium
                'flip-box',
                'flip-box-advanced', //premium
                'horizontal-scroll', //premium
                'horizontal-tab',
                'horizontal-timeline',
                'hotspot',
                'icon-list',
                'image-accordion',
                'image-comparison',
                'image-gallery',
                'link-effect',
                'logo-carousel',
                'logo-grid',
                'lottie',
                'morphing-layouts', //premium
                'multi-scroll', //premium
                'one-page-navigation',
                'pie-chart',
                'popup-modal',
                'popup-video',
                'portfolio',
                'portfolio-grid',
                'pricing-list',
                'pricing-table',
                'progressbar',
                'scroll-image',
                'scroll-nav',
                'slider',
                'slinky-vertical-menu', //premium
                'social-share',
                'step-flow',
                'sticky-video',
                'switcher',
                'team-member',
                'team-member-carousel',
                'testimonial',
                'testimonial-slider',
                'text-marquee', //premium
                'threed-text', //premium
                'threesixty-image', //premium
                'tilt-hover-image', //premium
                'toggle',
                'twitter-feed',
                'twitter-feed-carousel',
                'vertical-tab',
                'vertical-timeline',
                'video-player',
                'weather'
            ];

            return $modules_list;
        }
    }

}

/**
 * Returns instanse of the plugin class.
 *
 * @since  1.0.0
 * @return object
 */
if (!function_exists('easy_elementor_addons')) {

    function easy_elementor_addons() {
        return Easy_Elementor_Addons::get_instance();
    }

}

easy_elementor_addons();