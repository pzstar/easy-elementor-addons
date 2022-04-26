<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

Class CustomCursor {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/element/common/_section_border/after_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'], 10, 2);
    }

    public function register_controls($elems) {
        $elems->start_controls_section(
            'eead_cursor_effects_section', [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__('Custom Cursor', 'easy-elementor-addons'),
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_show', [
                'label'              => __('Show Cursor Effects', 'easy-elementor-addons'),
                'type'               => Controls_Manager::SWITCHER,
                'return_value'       => 'yes',
                'prefix_class'       => 'eead-custom-cursor-',
                'frontend_available' => true,
                'render_type'        => 'template',
            ]
        );

        $elems->start_controls_tabs(
            'eead_cursor_effects_tabs'
        );

        $elems->start_controls_tab(
            'eead_cursor_effects_tab_layout', [
                'label'     => esc_html__('Layout', 'easy-elementor-addons'),
                'condition' => [
                    'eead_cursor_effects_show' => 'yes'
                ],
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_source', [
                'label'              => esc_html__('Source', 'easy-elementor-addons'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'default',
                'frontend_available' => true,
                'render_type'        => 'template',
                'options'            => [
                    'default' => esc_html__('Default', 'easy-elementor-addons'),
                    'text'    => esc_html__('Text', 'easy-elementor-addons'),
                    'image'   => esc_html__('Image', 'easy-elementor-addons'),
                    'icons'   => esc_html__('Icons', 'easy-elementor-addons'),
                ],
                'condition'          => [
                    'eead_cursor_effects_show' => 'yes'
                ],
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_image_src', [
                'label'              => esc_html__('Image', 'easy-elementor-addons'),
                'type'               => Controls_Manager::MEDIA,
                'frontend_available' => true,
                'render_type'        => 'template',
                'default'            => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'          => [
                    'eead_cursor_effects_source' => 'image'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_icons', [
                'label'              => esc_html__('Icons', 'easy-elementor-addons'),
                'type'               => Controls_Manager::ICONS,
                'frontend_available' => true,
                'render_type'        => 'template',
                'condition'          => [
                    'eead_cursor_effects_source' => 'icons'
                ],
                'default'            => [
                    'value'   => 'fas fa-laugh-wink',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_style', [
                'label'              => __('Style', 'easy-elementor-addons'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'ep-cursor-style-1',
                'options'            => [
                    'ep-cursor-style-1' => __('Style 1', 'easy-elementor-addons'),
                    'ep-cursor-style-2' => __('Style 2', 'easy-elementor-addons'),
                    'ep-cursor-style-3' => __('Style 3', 'easy-elementor-addons'),
                ],
                'frontend_available' => true,
                'render_type'        => 'template',
                'condition'          => [
                    'eead_cursor_effects_show'   => 'yes',
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_text_label', [
                'label'              => esc_html__('Text Label', 'easy-elementor-addons'),
                'type'               => Controls_Manager::TEXT,
                'default'            => esc_html__('HELLO', 'easy-elementor-addons'),
                'selectors'          => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => '--cursor-text-label:"{{VALUE}}"'
                ],
                'frontend_available' => true,
                'render_type'        => 'template',
                'condition'          => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_speed', [
                'label'              => __('Speed', 'easy-elementor-addons'),
                'type'               => Controls_Manager::SLIDER,
                'size_units'         => ['px'],
                'range'              => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.001,
                    ]
                ],
                'default'            => [
                    'unit' => 'px',
                    'size' => 0.075,
                ],
                'frontend_available' => true,
                'render_type'        => 'none',
                'condition'          => [
                    'eead_cursor_effects_show'   => 'yes',
                    'eead_cursor_effects_source' => 'default'
                ]

            ]
        );

        $elems->add_control(
            'eead_cursor_effects_disable_default_cursor', [
                'label'        => __('Disable Default Cursor', 'easy-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'separator'    => 'before',
                'condition'    => [
                    'eead_cursor_effects_show' => 'yes'
                ],
                'selectors'    => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => 'cursor: none'
                ]
            ]
        );

        $elems->end_controls_tab();

        $elems->start_controls_tab(
            'eead_cursor_effects_tab_style', [
                'label'     => esc_html__('Style', 'easy-elementor-addons'),
                'condition' => [
                    'eead_cursor_effects_show' => 'yes'
                ],
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_primary', [
                'label'     => esc_html__('Primary', 'easy-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_primary_color', [
                'label'     => esc_html__('Color', 'easy-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => '--cursor-ball-color: {{VALUE}}',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => ['default', 'icons']
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_primary_size', [
                'label'     => esc_html__('Size', 'easy-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => '--cursor-ball-size:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_secondary', [
                'label'     => esc_html__('Secondary', 'easy-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        $elems->add_control(
            'eead_cursor_effects_secondary_color', [
                'label'     => esc_html__('Color', 'easy-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => '--cursor-circle-color: {{VALUE}}',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_secondary_size', [
                'label'     => esc_html__('Size', 'easy-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes' => '--cursor-circle-size:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'default'
                ]
            ]
        );

        //TEXT
        $elems->add_control(
            'eead_cursor_effects_text_color', [
                'label'     => esc_html__('Color', 'easy-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'eead_cursor_effects_text_background',
                'label'     => esc_html__('Background', 'easy-elementor-addons'),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text',
                'condition' => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_text_padding', [
                'label'      => esc_html__('Padding', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'eead_cursor_effects_text_border',
                'label'     => esc_html__('Border', 'easy-elementor-addons'),
                'selector'  => '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text',
                'condition' => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_text_radius', [
                'label'      => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'eead_cursor_effects_text_typography',
                'label'     => esc_html__('Typography', 'easy-elementor-addons'),
                'selector'  => '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-text',
                'condition' => [
                    'eead_cursor_effects_source' => 'text'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_image_size', [
                'label'     => esc_html__('Size', 'easy-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-image' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'image'
                ]
            ]
        );

        $elems->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'eead_cursor_effects_image_border',
                'label'     => esc_html__('Border', 'easy-elementor-addons'),
                'selector'  => '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-image',
                'condition' => [
                    'eead_cursor_effects_source' => 'image'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_image_radius', [
                'label'      => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_cursor_effects_source' => 'image'
                ]
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_effects_icons_size', [
                'label'     => esc_html__('Size', 'easy-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.eead-custom-cursor-yes .eead-cursor-icons' => 'font-size:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_cursor_effects_source' => 'icons'
                ]
            ]
        );
        $elems->end_controls_tab();

        $elems->end_controls_tabs();

        $elems->end_controls_section();
    }
}

CustomCursor::instance();
