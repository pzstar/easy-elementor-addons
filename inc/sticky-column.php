<?php

namespace EasyElementorAddons;

use Elementor\Controls_Manager;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Sticky_Column {

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
        add_filter('elementor/element/column/layout/after_section_start', [$this, 'add_controls']);
        add_action('elementor/frontend/column/before_render', [$this, 'render_attribute'], 10);
    }

    public function add_controls($section) {
        $section->add_control(
            'eea_sidebar_sticky',
            [
                'label' => __('Enable Sticky Sidebar', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'render_type' => 'template',
                'return_value' => 'true',
            ]
        );

        $section->add_control(
            'eea_sidebar_sticky_top_spacing',
            array(
                'label' => __('Top Spacing(px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'condition' => array(
                    'eea_sidebar_sticky' => 'true',
                ),
                'render_type' => 'template',
            )
        );

        $section->add_control(
            'eea_sidebar_sticky_bottom_spacing',
            array(
                'label' => __('Bottom Spacing(px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'condition' => array(
                    'eea_sidebar_sticky' => 'true',
                ),
                'render_type' => 'template',
            )
        );

        $section->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
    }

    public function render_attribute($widget) {
        $settings = $widget->get_settings_for_display();
        if ('true' === $settings['eea_sidebar_sticky']) {
            $top_spacing = $settings['eea_sidebar_sticky_top_spacing'] ? $settings['eea_sidebar_sticky_top_spacing'] : 0;
            $bottom_spacing = $settings['eea_sidebar_sticky_bottom_spacing'] ? $settings['eea_sidebar_sticky_bottom_spacing'] : 0;
            $widget->add_render_attribute('_wrapper', array(
                'class' => 'eea-elementor-sticky-column',
                'data-top-spacing' => absint($top_spacing),
                'data-bottom-spacing' => absint($bottom_spacing)
            )
            );
        }
    }
}

Sticky_Column::instance();