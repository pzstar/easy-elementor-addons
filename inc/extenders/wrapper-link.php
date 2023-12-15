<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

Class WrapperLink {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        // Add section settings
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/section_eead_wrapper_link/before_section_end', [$this, 'register_controls'], 10, 2);
        // Add column settings
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/column/section_eead_wrapper_link/before_section_end', [$this, 'register_controls'], 10, 2);
        // Add widget settings
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/common/section_eead_wrapper_link/before_section_end', [$this, 'register_controls'], 10, 2);

        add_action('elementor/frontend/before_render', [$this, 'wrapper_link_before_render'], 10, 1);

        // render scripts
        add_action('elementor/frontend/widget/before_render', [$this, 'should_script_enqueue']);
        add_action('elementor/preview/enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function register_controls($elems) {

        $elems->add_control(
            'eead_wrapper_link', [
                'label' => __('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'default' => ['url' => ''],
                'dynamic' => ['active' => true],
                'render_type' => 'none',
            ]
        );
    }

    public function register_section($element) {
        if ('section' === $element->get_name() || 'column' === $element->get_name()) {
            $tabs = Controls_Manager::TAB_LAYOUT;

        } else {
            $tabs = Controls_Manager::TAB_CONTENT;
        }

        $element->start_controls_section(
            'section_eead_wrapper_link', [
                'tab' => $tabs,
                'label' => esc_html__('Wrapper Link', 'easy-elementor-addons'),
            ]
        );

        $element->end_controls_section();
    }

    public function wrapper_link_before_render($widget) {
        $element_link = $widget->get_settings_for_display('eead_wrapper_link');

        if ($element_link && !empty($element_link['url'])) {
            $widget->add_render_attribute(
                '_wrapper', [
                    'data-eead-wrapper-link' => json_encode($element_link),
                    'style' => 'cursor: pointer',
                    'class' => 'eead-element-link'
                ]
            );
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_script('wrapper-link');
    }

    public function should_script_enqueue($widget) {
        $element_link = $widget->get_settings_for_display('eead_wrapper_link');

        if ($element_link && !empty($element_link['url'])) {
            $this->enqueue_scripts();
        }
    }
}

WrapperLink::instance();