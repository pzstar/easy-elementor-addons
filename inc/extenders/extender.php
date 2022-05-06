<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

Class Extender {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function get_extenders() {
        $extenders = array(
            'backdrop-effect',
            'visibility-controls',
            'custom-cursor',
            'background-overlay',
            'wrapper-link',
            'notation',
            'tooltip',
            'tile-scroll',
            'section-sticky'
        );
        return $extenders;
    }

    private function get_active_extenders() {
        $options = get_option('eead-options');
        $active_extenders = $this->get_extenders();

        if (isset($options['enabled_elementor_extenders'])) {
            $active_extenders = array_keys($options['enabled_elementor_extenders']);
        }

        return $active_extenders;
    }

    private function is_extender_active($extender_id) {
        $active_extenders = $this->get_active_extenders();

        if (in_array($extender_id, $active_extenders)) {
            return true;
        }
    }

    public function __construct() {
        if ($this->is_extender_active('visibility-controls')) {
            $this->include_conditions();
        }

        $get_extenders = $this->get_extenders();

        if (!empty($get_extenders)) {
            foreach ($get_extenders as $extender) {
                if (!$this->is_extender_active($extender)) {
                    continue;
                }
                $file = EEAD_PATH . 'inc/extenders/' . $extender . '.php';
                if (file_exists($file)) {
                    require_once($file);
                }
            }

            // For Extenders Scripts
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'extenders_scripts']);
        }
    }

    public function extenders_scripts() {
        wp_enqueue_script('eead-extenders', EEAD_URL . 'inc/extenders/assets/js/extenders.js', [], EEAD_VERSION, true);
        wp_enqueue_style('eead-extenders', EEAD_URL . 'inc/extenders/assets/css/extenders.css', [], EEAD_VERSION);

        // if ($this->is_extender_active('custom-cursor')) {
            wp_register_script('custom-cursor', EEAD_URL . 'inc/extenders/assets/js/custom-cursor.js', [], EEAD_VERSION, true);
        //     wp_enqueue_script('paper-core', EEAD_URL . 'assets/lib/paper/paper-core.js', [], EEAD_VERSION, true);
        //     wp_enqueue_script('simplex-noise', EEAD_URL . 'assets/lib/simplex-noise/simplex-noise.min.js', [], EEAD_VERSION, true);
        // }
        wp_register_script('tltp-anime', EEAD_URL . 'inc/extenders/assets/js/anime.min.js', [], EEAD_VERSION, true);
        wp_register_script('charming', EEAD_URL . 'inc/extenders/assets/js/charming.min.js', [], EEAD_VERSION, true);
        wp_register_script('eead-tooltip', EEAD_URL . 'inc/extenders/assets/js/eead-tooltip.js', [], EEAD_VERSION, true);
        wp_register_script('wrapper-link', EEAD_URL . 'inc/extenders/assets/js/wrapper-link.js', [], EEAD_VERSION, true);
        wp_register_script('eead-background-overlay', EEAD_URL . 'inc/extenders/assets/js/background-overlay.js', [], EEAD_VERSION, true);
        wp_register_script('eead-notation', EEAD_URL . 'inc/extenders/assets/js/notation.js', [], EEAD_VERSION, true);
        wp_enqueue_script('eead-tile-scroll', EEAD_URL . 'inc/extenders/assets/js/eead-tile-scroll.js', [], EEAD_VERSION, true);
        wp_register_script('eead-section-sticky', EEAD_URL . 'inc/extenders/assets/js/eead-section-sticky.js', [], EEAD_VERSION, true);
    }

    public function include_conditions() {
        $get_conditions = [
            'condition',
            'authentication',
            'role',
            'post-type',
            'static-page',
            'date',
            'date-time-before',
            'time',
            'day',
            'os',
            'browser',
            'ex-url',
            'search-engine-url',
        ];

        foreach ($get_conditions as $condition) {
            $file = EEAD_PATH . 'inc/extenders/conditions/' . $condition . '.php';
            if (file_exists($file)) {
                require_once($file);
            }
        }
    }
}

Extender::instance();