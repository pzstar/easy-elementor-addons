<?php

/**
 * Plugin Name: Easy Elementor Addons - Addons Pack for Elementor Page Builder Plugin
 * Plugin URI: https://demo.hashthemes.com/easy-elementor-addons/
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 1.0.3
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: easy-elementor-addons
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('EEAD_VERSION', '1.0.3');

define('EEAD_FILE', __FILE__);
define('EEAD_PLUGIN_BASENAME', plugin_basename(EEAD_FILE));
define('EEAD_PATH', plugin_dir_path(EEAD_FILE));
define('EEAD_URL', plugins_url('/', EEAD_FILE));

define('EEAD_ASSETS_URL', EEAD_URL . 'assets/');

if (!class_exists('Easy_Elementor_Addons')) {

    class Easy_Elementor_Addons {

        private static $instance = null;

        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (self::$instance == null) {
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

            /** Includes the autoloader for libraries installed with Composer. */
            require EEAD_PATH . 'vendor/autoload.php';
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
                $admin_message = '<p>' . esc_html__('Ops! Easy Elementor Addons is not working because you need to activate the Elementor plugin first.', 'easy-elementor-addons') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'easy-elementor-addons')) . '</p>';
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }

                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $admin_message = '<p>' . esc_html__('Ops! Easy Elementor Addons is not working because you need to install the Elementor plugin', 'easy-elementor-addons') . '</p>';
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
            $widgets = $this->get_all_default_widgets();
            if (get_option('eead_widgets') == false) {
                update_option('eead_widgets', $widgets);
            }
        }

        public function get_all_default_widgets() {
            $modules_list = [];
            $modules_list = [
                'accordion-block',
                'advanced-button',
                'advanced-heading',
                'advanced-icon-box',
                'advanced-map',
                'animated-heading',
                'business-hour',
                'charts',
                'circular-progressbar',
                'countdown',
                'counter-block',
                'drop-bar',
                'dual-button',
                'dual-heading',
                'feature-list',
                'filterable-gallery',
                'flip-box',
                'flip-box-advanced',
                'horizontal-scroll',
                'horizontal-tab-block',
                'horizontal-timeline',
                'hotspot-block',
                'icon-list',
                'image-accordion',
                'image-comparison',
                'image-gallery',
                'link-effect',
                'logo-carousel',
                'logo-grid',
                'lottie',
                'morphing-layouts',
                'multi-scroll',
                'one-page-navigation',
                'pie-chart',
                'popup-modal',
                'popup-video',
                'portfolio-block',
                'pricing-list',
                'pricing-table',
                'progressbar',
                'scroll-image',
                'scroll-nav',
                'slider-block',
                'slinky-vertical-menu',
                'social-share',
                'step-flow',
                'sticky-video',
                'switcher-block',
                'team-member',
                'team-member-carousel',
                'testimonial-block',
                'testimonial-slider',
                'threesixty-image',
                'tilt-hover-image',
                'toggle-block',
                'twitter-feed',
                'twitter-feed-carousel',
                'vertical-tab-block',
                'vertical-timeline',
                'video-player',
                'weather-block'
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
