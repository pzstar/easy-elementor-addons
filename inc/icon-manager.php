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
        $tabs = array(
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

        $this->share_icon_styles($tabs);

        // Keep the tabs of other themes and plugins.
        return array_merge((array) $icons_args, $tabs);
    }

    // Load each icon font once: Elementor's tab handle points to the shared, versioned stylesheet.
    private function share_icon_styles($tabs) {
        $shared = array(
            'materialdesignicons.css' => 'materialdesignicons-7.4.47',
            'icofont.css' => 'icofont-1.0.1',
        );

        foreach ($tabs as $tab) {
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
    }

}

EEAD_Icon_Manager::instance();
