<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

Class SectionSticky {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        // Add section for settings
        add_action('elementor/element/after_section_end', [$this, 'register_controls'], 10, 3);
        add_action('elementor/frontend/section/before_render', [$this, 'sticky_before_render'], 10, 1);
        add_action('elementor/frontend/section/after_render', [$this, 'sticky_script_render'], 10, 1);
    }

    public function register_controls($section, $section_id) {

        static $layout_sections = ['section_advanced'];

        if ( !in_array($section_id, $layout_sections) ) {
            return;
        }

        $section->start_controls_section(
            'section_sticky_controls', [
                'label' => __('Section Sticky', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'section_sticky_on', [
                'label' => esc_html__('Enable Sticky', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => esc_html__('Set sticky options by enable this option.', 'easy-elementor-addons'),
            ]
        );

        $section->add_control(
            'section_sticky_offset', [
                'label' => esc_html__('Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_active_bg', [
                'label' => esc_html__('Active Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.uk-sticky.uk-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_sticky_active_padding', [
                'label' => esc_html__('Active Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.uk-sticky.uk-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'label' => esc_html__('Active Box Shadow', 'easy-elementor-addons'),
                'name' => 'section_sticky_active_shadow',
                'selector' => '{{WRAPPER}}.uk-sticky.uk-active',
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_animation', [
                'label' => esc_html__('Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => eead_transition_options(),
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_bottom', [
                'label' => esc_html__('Scroll Until', 'easy-elementor-addons'),
                'description' => esc_html__('If you don\'t want to scroll after specific section so set that section ID/CLASS here. for example: #section1 or .section1 it\'s support ID/CLASS', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_on_scroll_up', [
                'label' => esc_html__('Sticky on Scroll Up', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description' => esc_html__('Set sticky options when you scroll up your mouse.', 'easy-elementor-addons'),
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'description' => esc_html__('By default, the element sticks to the top of the viewport. You can set the position option to use a different position.', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'auto' => 'Auto',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_zindex', [
                'label' => esc_html__('Z-Index', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => -1000,
                'max' => 9999,
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}}.uk-sticky.uk-active' => 'z-index: {{VALUE}};',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_off_media', [
                'label' => __('Turn Off', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '960' => [
                        'title' => __('On Tablet', 'easy-elementor-addons'),
                        'icon' => 'eicon-device-tablet',
                    ],

                    '768' => [
                        'title' => __('On Mobile', 'easy-elementor-addons'),
                        'icon' => 'eicon-device-mobile',
                    ],
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $section->end_controls_section();
    }

    public function sticky_before_render($section) {
        $settings = $section->get_settings_for_display();
        if (!empty($settings['section_sticky_on']) == 'yes') {
            $sticky_option = [];
            if (!empty($settings['section_sticky_on_scroll_up'])) {
                $sticky_option['show-on-up'] = 'show-on-up: true';
            }

            if (!empty($settings['section_sticky_offset']['size'])) {
                $sticky_option['offset'] = 'offset: ' . $settings['section_sticky_offset']['size'];
            }

            if (!empty($settings['section_sticky_animation'])) {
                $sticky_option['animation'] = 'animation: eead-animation-' . $settings['section_sticky_animation'] . '; top: 100';
            }

            if (!empty($settings['section_sticky_bottom'])) {
                $sticky_option['bottom'] = 'bottom: ' . $settings['section_sticky_bottom'];
            }

            if (!empty($settings['section_sticky_position'])) {
                $sticky_option['position'] = 'position: ' . $settings['section_sticky_position'];
            }

            if (!empty($settings['section_sticky_off_media'])) {
                $sticky_option['media'] = 'media: ' . $settings['section_sticky_off_media'];
            }

            $section->add_render_attribute('_wrapper', 'uk-sticky', implode(";", $sticky_option));
            $section->add_render_attribute('_wrapper', 'class', 'eead-sticky');
        }
    }

    public function sticky_script_render($section) {

        if ($section->get_settings('section_sticky_on') == 'yes') {
            wp_enqueue_script('eead-section-sticky');
            wp_enqueue_script('uikit');
        }
    }
}

SectionSticky::instance();
