<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Plugin;

Class BackgroundOverlay {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/element/common/_section_background/after_section_end', [$this,'register_controls'], 10, 2);
        add_action('elementor/element/after_add_attributes', [$this,'background_overlay_render'], 10, 1);
    }

    public function register_controls($elems) {
        $elems->start_controls_section(
            'eead_section_background_overlay', [
                'label' => esc_html__('Background Over/Underlay', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,
                'condition' => [
                    '_background_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $elems->start_controls_tabs('eead_tabs_background_overlay');

        $elems->start_controls_tab(
            'eead_tab_background_overlay_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $elems->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'eead_background_overlay',
                'selector' => '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before',
            ]
        );

        $elems->add_control(
            'eead_background_overlay_opacity', [
                'label' => esc_html__('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'eead_background_overlay_background' => ['classic', 'gradient'],
                ],
            ]
        );

        $elems->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name' => 'eead_css_filters',
                'selector' => '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before',
            ]
        );

        $elems->add_control(
            'eead_overlay_blend_mode', [
                'label' => __('Blend Mode', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Normal', 'easy-elementor-addons'),
                    'multiply' => __('Multiply', 'easy-elementor-addons'),
                    'screen' => __('Screen', 'easy-elementor-addons'),
                    'overlay' => __('Overlay', 'easy-elementor-addons'),
                    'darken' => __('Darken', 'easy-elementor-addons'),
                    'lighten' => __('Lighten', 'easy-elementor-addons'),
                    'color-dodge' => __('Color Dodge', 'easy-elementor-addons'),
                    'saturation' => __('Saturation', 'easy-elementor-addons'),
                    'color' => __('Color', 'easy-elementor-addons'),
                    'luminosity' => __('Luminosity', 'easy-elementor-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before' => 'mix-blend-mode: {{VALUE}}',
                ],
            ]
        );

        $elems->add_responsive_control(
            'eead_background_overlay_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $elems->end_controls_tab();

        $elems->start_controls_tab(
            'eead_tab_background_overlay_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $elems->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'eead_background_overlay_hover',
                'selector' => '{{WRAPPER}}.eead-background-overlay-yes:hover > .elementor-widget-container:before',
            ]
        );

        $elems->add_control(
            'eead_background_overlay_hover_opacity', [
                'label' => esc_html__('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes:hover > .elementor-widget-container:before' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'eead_background_overlay_hover_background' => [ 'classic', 'gradient' ],
                ],
            ]
        );

        $elems->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name' => 'eead_css_filters_hover',
                'selector' => '{{WRAPPER}}.eead-background-overlay-yes:hover > .elementor-widget-container:before',
            ]
        );

        $elems->add_control(
            'eead_background_overlay_hover_transition_duration', [
                'label' => esc_html__('Transition Duration', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before' => 'transition: background {{SIZE}}s;',
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_background_overlay_hover_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $elems->end_controls_tab();

        $elems->end_controls_tabs();

        $elems->add_responsive_control(
            'eead_background_overlay_margin', [
                'label' => __('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-overlay-margin-top: {{TOP}}{{UNIT}};  --eead-overlay-margin-right: {{RIGHT}}{{UNIT}}; --eead-overlay-margin-bottom: {{BOTTOM}}{{UNIT}}; --eead-overlay-margin-left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $elems->add_control(
            'eead_background_overlay_zindex', [
                'label' => __('Z-Index', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => [
                    'active' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container:before' => 'z-index: {{VALUE}};',
                ]
            ]
        );

        $elems->add_control(
            'eead_background_overlay_position_relative', [
                'label' => esc_html__('Position Relative', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container' => 'position: relative;',
                ]
            ]
        );

        $elems->add_control(
            'eead_background_overlay_widget_zindex', [
                'label' => __('Widget Z-Index', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '-1',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['eead_background_overlay_position_relative' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}}.eead-background-overlay-yes > .elementor-widget-container' => 'z-index: {{VALUE}};',
                ]
            ]
        );

        $elems->end_controls_section();
    }

    public function background_overlay_render( $widget ) {
        $settings = $widget->get_settings_for_display();

        if (in_array($widget->get_name(), ['column', 'section'])) {
            return;
        }

        if (Plugin::instance()->editor->is_edit_mode()) {
            return;
        }

        $overlay_bg = isset($settings['eead_background_overlay_background']) ? $settings['eead_background_overlay_background'] : '';
        $overlay_bg_hover = isset($settings['eead_background_overlay_hover_background']) ? $settings['eead_background_overlay_hover_background'] : '';
        $has_background_overlay = (in_array( $overlay_bg, ['classic', 'gradient'], true) || in_array($overlay_bg_hover, ['classic', 'gradient'], true));

        if ($has_background_overlay) {
            $widget->add_render_attribute('_wrapper', 'class', 'eead-background-overlay-yes');
            wp_enqueue_script('eead-background-overlay');
        }
    }
}

BackgroundOverlay::instance();
