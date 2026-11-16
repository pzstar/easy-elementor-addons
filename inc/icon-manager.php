<?php

namespace EasyElementorAddons;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class EEAD_Icon_Manager {

    private static $instance = NULL;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function __construct() {
        $this->init();
    }

    public function init() {
        // Custom icon filter
        add_filter('elementor/icons_manager/additional_tabs', [$this, 'icons']);
    }

    public function icons($icons_args = array()) {
        $icons_args = array(
            'eead-mdi-icon' => array(
                'name' => 'eead-mdi-icon',
                'label' => esc_html__('EEA - MaterialDesign Icons', 'easy-elementor-addons'),
                'labelIcon' => 'mdi-rhombus',
                'prefix' => 'mdi-',
                'displayPrefix' => 'mdi',
                'url' => EEAD_URL . 'assets/fonts/materialdesignicons/materialdesignicons.css',
                'icons' => eead_materialdesignicons_array(),
                'ver' => EEAD_VERSION,
            ),
            'eead-icofont-icon' => array(
                'name' => 'eead-icfont-icon',
                'label' => esc_html__('EEA - Iconfont Icons', 'easy-elementor-addons'),
                'labelIcon' => 'mdi-rhombus',
                'prefix' => 'icofont-',
                'displayPrefix' => '',
                'url' => EEAD_URL . 'assets/fonts/icofont/icofont.css',
                'icons' => eead_icofont_icon_array(),
                'ver' => EEAD_VERSION,
            ),
        );

        return $icons_args;
    }

}

EEAD_Icon_Manager::instance();

if (!function_exists(__NAMESPACE__ . '\\eead_share_elementor_icon_styles')) {

    /*
     *  Elementor registers every icon tab's stylesheet under its own handle
     *  (elementor-icons-<tab name>), so a library already loaded by a theme or
     *  plugin was loaded a second time. HashThemes products load each library
     *  under one shared, versioned handle; register Elementor's handle first as
     *  an empty one that only depends on the shared stylesheet. Elementor's own
     *  registration then does nothing, and the file loads once.
     *
     *  Runs as the last additional_tabs filter, which Elementor applies just
     *  before it registers the tab stylesheets. The tabs pass through unchanged.
     */

    function eead_share_elementor_icon_styles($tabs) {
        $shared = array(
            'materialdesignicons.css' => 'materialdesignicons-7.4.47',
            'icofont.css' => 'icofont-1.0.1',
            'eleganticons.css' => 'eleganticons-1.0',
            'essentialicon.css' => 'essentialicon-1.0',
            'essential-icon.css' => 'essentialicon-1.0',
            'fontawesome-6.3.0.css' => 'fontawesome-7.3.1',
        );

        foreach ((array) $tabs as $tab) {
            if (empty($tab['name']) || empty($tab['url'])) {
                continue;
            }

            $file = basename((string) strtok($tab['url'], '?'));

            if (!isset($shared[$file])) {
                continue;
            }

            if (!wp_style_is($shared[$file], 'registered')) {
                wp_register_style($shared[$file], $tab['url'], array(), null);
            }

            if (!wp_style_is('elementor-icons-' . $tab['name'], 'registered')) {
                wp_register_style('elementor-icons-' . $tab['name'], false, array($shared[$file]), null);
            }
        }

        return $tabs;
    }

}

add_filter('elementor/icons_manager/additional_tabs', __NAMESPACE__ . '\\eead_share_elementor_icon_styles', PHP_INT_MAX);
