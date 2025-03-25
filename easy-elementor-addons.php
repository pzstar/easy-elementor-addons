<?php

/**
 * Plugin Name: Easy Elementor Addons - Addons Pack for Elementor Page Builder Plugin
 * Plugin URI: https://demo.hashthemes.com/easy-elementor-addons/
 * Description: Elementor addons for WordPress Themes developed by HashThemes https://hashthemes.com
 * Version: 2.1.9
 * Author: HashThemes
 * Author URI: https://hashthemes.com/
 * Text Domain: easy-elementor-addons
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * Elementor tested up to: 3.27
 * Elementor Pro tested up to: 3.2.1
 * Requires Plugins:  elementor
 */
/* If this file is called directly, abort */
if (!defined('WPINC')) {
    die();
}

define('EEAD_VERSION', '2.1.9');

define('EEAD_FILE', __FILE__);
define('EEAD_PLUGIN_BASENAME', plugin_basename(EEAD_FILE));
define('EEAD_PATH', plugin_dir_path(EEAD_FILE));
define('EEAD_URL', plugins_url('/', EEAD_FILE));

define('EEAD_ASSETS_URL', EEAD_URL . 'assets/');
// define('EEAD_API_DEBUG', true);

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
            require EEAD_PATH . 'inc/sticky-container.php';
            require EEAD_PATH . 'inc/admin-menu/admin-menu-class.php';
            require EEAD_PATH . 'templates/templates.php';
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

        public static function get_all_widgets_list() {
            $all_wid = apply_filters('eead_all_widgets_list', array(
                'accordion' => array(
                    'name' => 'Accordion',
                    'icon' => 'eead-icons-accordion',
                    'description' => esc_html__('Displays the FAQ of your clients within a beautiful UI.', 'easy-elementor-addons')
                ),
                'advanced-button' => array(
                    'name' => 'Advanced Button',
                    'icon' => 'eead-icons-button',
                    'description' => esc_html__('Allows you to place responsive buttons with different animations, hover effects and many more.', 'easy-elementor-addons')
                ),
                'advanced-heading' => array(
                    'name' => 'Advanced Heading',
                    'icon' => 'eead-icons-advanced-heading',
                    'description' => esc_html__('Place a unique heading with border, animations, etc.', 'easy-elementor-addons')
                ),
                'advanced-icon-box' => array(
                    'name' => 'Advanced Icon Box',
                    'icon' => 'eead-icons-icon-text',
                    'description' => esc_html__('Lets you create an icon box where you can place an icon with the title, and description.', 'easy-elementor-addons')
                ),
                'advanced-map' => array(
                    'name' => 'Advanced Map',
                    'icon' => 'eead-icons-map',
                    'description' => esc_html__('Add fully customizable maps with advanced styling and multiple location markers.', 'easy-elementor-addons')
                ),
                'animated-heading' => array(
                    'name' => 'Animated Heading',
                    'icon' => 'eead-icons-animated-heading',
                    'description' => esc_html__('Place the animated heading to display your deals, offers, discounts or features of your services in an eye catchy way.', 'easy-elementor-addons')
                ),
                'business-hour' => array(
                    'name' => 'Business Hour',
                    'icon' => 'eead-icons-business-hours',
                    'description' => esc_html__('Displays the timetable of the business hour of your company.', 'easy-elementor-addons')
                ),
                'circular-progressbar' => array(
                    'name' => 'Circular Progressbar',
                    'icon' => 'eead-icons-circular-bar',
                    'description' => esc_html__('Displays the work progress of your company in a circular layout.', 'easy-elementor-addons')
                ),
                'countdown' => array(
                    'name' => 'Countdown',
                    'icon' => 'eead-icons-count-down',
                    'description' => esc_html__('Create engaging countdown timers to highlight offers, events, or launches.', 'easy-elementor-addons')
                ),
                'counter' => array(
                    'name' => 'Counter',
                    'icon' => 'eead-icons-counter',
                    'description' => esc_html__('Let you place a beautiful stats counter of your business by highlighting the achievements.', 'easy-elementor-addons')
                ),
                'drop-bar' => array(
                    'name' => 'Drop Bar',
                    'icon' => 'eead-icons-drop-box',
                    'description' => esc_html__('Display a short information on the drop bar and display it in different positions, animation effects.', 'easy-elementor-addons')
                ),
                'dual-button' => array(
                    'name' => 'Dual Button',
                    'icon' => 'eead-icons-dual-buttons',
                    'description' => esc_html__('Design stylish dual-action buttons with unique layouts and effects.', 'easy-elementor-addons')
                ),
                'dual-heading' => array(
                    'name' => 'Dual Heading',
                    'icon' => 'eead-icons-dual-heading',
                    'description' => esc_html__('Allows you to display the heading in dual effects.', 'easy-elementor-addons')
                ),
                'feature-list' => array(
                    'name' => 'Feature List',
                    'icon' => 'eead-icons-feature-list',
                    'description' => esc_html__('Showcase features or services with icons, text, and custom layouts.', 'easy-elementor-addons')
                ),
                'flip-box' => array(
                    'name' => 'Flip Box',
                    'icon' => 'eead-icons-flip-box',
                    'description' => esc_html__('Display your information, custom text or even product detail in a customizable flip box.', 'easy-elementor-addons')
                ),
                'horizontal-tab' => array(
                    'name' => 'Horizontal Tab',
                    'icon' => 'eead-icons-horizontal-tab',
                    'description' => esc_html__('Allows you to showcase different information in a responsive horizontal tab.', 'easy-elementor-addons')
                ),
                'horizontal-timeline' => array(
                    'name' => 'Horizontal Timeline',
                    'icon' => 'eead-icons-horizontal-timeline',
                    'description' => esc_html__('Adds a horizontal timeline to display the evolution, history and success story of your company in a responsive timeline.', 'easy-elementor-addons')
                ),
                'hotspot' => array(
                    'name' => 'Hotspot',
                    'icon' => 'eead-icons-hot-spot',
                    'description' => esc_html__('Add hotspot tooltips of different parts of the images.', 'easy-elementor-addons')
                ),
                'icon-list' => array(
                    'name' => 'Icon List',
                    'icon' => 'eead-icons-icon-list',
                    'description' => esc_html__('List down your contents with beautiful icons or png images.', 'easy-elementor-addons')
                ),
                'image-accordion' => array(
                    'name' => 'Image Accordion',
                    'icon' => 'eead-icons-image-accordion',
                    'description' => esc_html__('Images are displayed in a stacked layout that expands or collapses when clicked, showing or hiding additional images or content', 'easy-elementor-addons')
                ),
                'image-comparison' => array(
                    'name' => 'Image Comparison',
                    'icon' => 'eead-icons-compare',
                    'description' => esc_html__('To showcase the images before and after editing the images.', 'easy-elementor-addons')
                ),
                'image-gallery' => array(
                    'name' => 'Filterable Gallery',
                    'icon' => 'eead-icons-image-gallery',
                    'description' => esc_html__('Build dynamic, filterable image or video galleries with ease.', 'easy-elementor-addons')
                ),
                'link-effect' => array(
                    'name' => 'Link Effect',
                    'icon' => 'eead-icons-link',
                    'description' => esc_html__('Customize your hyperlink by adding different animation effects.', 'easy-elementor-addons')
                ),
                'logo-carousel' => array(
                    'name' => 'Logo Carousel',
                    'icon' => 'eead-icons-logo-carousel',
                    'description' => esc_html__('Highlight the logo of your clients, partners, or sponsor in a beautiful carousel.', 'easy-elementor-addons')
                ),
                'logo-grid' => array(
                    'name' => 'Logo Grid',
                    'icon' => 'eead-icons-logo-grid',
                    'description' => esc_html__('Highlight the logo of your clients, partners, or sponsor in a beautiful logo grid.', 'easy-elementor-addons')
                ),
                'lottie' => array(
                    'name' => 'Lottie',
                    'icon' => 'eead-icons-lottie',
                    'description' => esc_html__('Embed lightweight, animated Lottie files to enhance interactivity.', 'easy-elementor-addons')
                ),
                'one-page-navigation' => array(
                    'name' => 'One Page Navigation',
                    'icon' => 'eead-icons-one-page-nav',
                    'description' => esc_html__('Place an extra navigator to navigate different contents present in a single page.', 'easy-elementor-addons')
                ),
                'pie-chart' => array(
                    'name' => 'Pie Chart',
                    'icon' => 'eead-icons-pie-chart',
                    'description' => esc_html__('Display your company progress in a beautiful pie chart.', 'easy-elementor-addons')
                ),
                'popup-modal' => array(
                    'name' => 'Popup Modal',
                    'icon' => 'eead-icons-popup',
                    'description' => esc_html__('Place an animated popup with different animations.', 'easy-elementor-addons')
                ),
                'popup-video' => array(
                    'name' => 'Popup Video',
                    'icon' => 'eead-icons-video-popup',
                    'description' => esc_html__('Add eye-catching video popups to boost user engagement.', 'easy-elementor-addons')
                ),
                'pricing-list' => array(
                    'name' => 'Pricing List',
                    'icon' => 'eead-icons-pricing-list',
                    'description' => esc_html__('Showcase the pricing of your products in a unique fashion.', 'easy-elementor-addons')
                ),
                'pricing-table' => array(
                    'name' => 'Pricing Table',
                    'icon' => 'eead-icons-pricing-table',
                    'description' => esc_html__('Display the pricing plan of your services in a beautifully designed pricing table.', 'easy-elementor-addons')
                ),
                'progressbar' => array(
                    'name' => 'Progressbar',
                    'icon' => 'eead-icons-progress-bar',
                    'description' => esc_html__('Allows you to showcase your work progress in an attractive progress bar.', 'easy-elementor-addons')
                ),
                'scroll-image' => array(
                    'name' => 'Scroll Image',
                    'icon' => 'eead-icons-scroll-image',
                    'description' => esc_html__('Let’s you showcase a long and full width image in a short space. Automatically scroll the images when hovered over.', 'easy-elementor-addons')
                ),
                'slider' => array(
                    'name' => 'Slider',
                    'icon' => 'eead-icons-slider',
                    'description' => esc_html__('Highlight your announcements, deals or even products in a responsive slider.', 'easy-elementor-addons')
                ),
                'social-share' => array(
                    'name' => 'Social Share',
                    'icon' => 'eead-icons-social-share',
                    'description' => esc_html__('Add social share buttons to share your pages or posts to different social media networks in a single click.', 'easy-elementor-addons')
                ),
                'step-flow' => array(
                    'name' => 'Step Flow',
                    'icon' => 'eead-icons-step-flow',
                    'description' => esc_html__('Present step-by-step processes with a clean and professional layout.', 'easy-elementor-addons')
                ),
                'sticky-video' => array(
                    'name' => 'Sticky Video',
                    'icon' => 'eead-icons-sticky-video',
                    'description' => esc_html__('Keep videos visible while users scroll through the page.', 'easy-elementor-addons')
                ),
                'switcher' => array(
                    'name' => 'Switcher',
                    'icon' => 'eead-icons-switcher',
                    'description' => esc_html__('To display multiple web contents in a switcher for comparison.', 'easy-elementor-addons')
                ),
                'team-member' => array(
                    'name' => 'Team',
                    'icon' => 'eead-icons-team',
                    'description' => esc_html__('Display your team members of your company/organization.', 'easy-elementor-addons')
                ),
                'team-carousel' => array(
                    'name' => 'Team Carousel',
                    'icon' => 'eead-icons-team-carousel',
                    'description' => esc_html__('Display your team members of your company/organization in an attractive carousel.', 'easy-elementor-addons')
                ),
                'testimonial' => array(
                    'name' => 'Testimonial',
                    'icon' => 'eead-icons-testimonial',
                    'description' => esc_html__('Showcase the positive words given by your clients in a stunning way.', 'easy-elementor-addons')
                ),
                'testimonial-carousel' => array(
                    'name' => 'Testimonial Carousel',
                    'icon' => 'eead-icons-testimonial-carousel',
                    'description' => esc_html__('Showcase the positive words given by your client in a beautiful slider.', 'easy-elementor-addons')
                ),
                'toggle' => array(
                    'name' => 'Toggle',
                    'icon' => 'eead-icons-toggle',
                    'description' => esc_html__('Display multiple contents and toggle them for comparison.', 'easy-elementor-addons')
                ),
                'twitter-feed' => array(
                    'name' => 'Twitter Feed',
                    'icon' => 'eead-icons-twitter-x',
                    'description' => esc_html__('Display real-time Twitter feeds directly on your website.', 'easy-elementor-addons')
                ),
                'vertical-tab' => array(
                    'name' => 'Vertical Tab',
                    'icon' => 'eead-icons-vertical-tab',
                    'description' => esc_html__('Allows you to showcase different information in a responsive vertical tab.', 'easy-elementor-addons')
                ),
                'vertical-timeline' => array(
                    'name' => 'Vertical Timeline',
                    'icon' => 'eead-icons-vertical-timeline',
                    'description' => esc_html__('Adds a vertical timeline to represent the evolution, history and success story of your company in a responsive timeline.', 'easy-elementor-addons')
                ),
                'video-player' => array(
                    'name' => 'Video Player',
                    'icon' => 'eead-icons-video-player',
                    'description' => esc_html__('Allow you to embed the videos from Youtube, Vimeo or from your local computer.', 'easy-elementor-addons')
                ),
                'weather' => array(
                    'name' => 'Weather Block',
                    'icon' => 'eead-icons-weather',
                    'description' => esc_html__('Adds a weather report of a city with humidity, Pressure and Wind Speed.', 'easy-elementor-addons')
                ),
            ));
            ksort($all_wid);
            return $all_wid;
        }

        public static function get_all_default_widgets() {
            return array_keys(self::get_all_widgets_list());
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