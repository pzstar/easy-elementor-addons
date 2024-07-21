<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class AdvancedTileScroll {

    private static $_instance = NULL;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        // Add section for settings
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/eead_advanced_tile_scroll_section/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/frontend/section/before_render', [$this, 'section_tile_scroll_before_render'], 10, 1);
    }

    public function section_tile_scroll_before_render($section) {
        $settings = $section->get_settings_for_display();

        if ('yes' === $settings['eead_advanced_tile_scroll_show']) {
            wp_enqueue_script('eead-advanced-tile-scroll');
            wp_enqueue_script('uikit');
        }
    }

    public function register_controls($section) {

        $section->add_control(
            'eead_advanced_tile_scroll_show',
            [
                'label' => esc_html__('Use Tile Scroll?', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
                'prefix_class' => 'eead-advanced-tile-scroll-',
                'frontend_available' => true,
                'render_type' => 'template',
            ]
        );

        $section->start_controls_tabs(
            'tabs_eead_advanced_tile_scroll'
        );

        $section->start_controls_tab(
            'tabs_eead_advanced_tile_content',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'eead_advanced_tile_scroll_title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Item #1', 'easy-elementor-addons'),
                'label_block' => true,
                'render_type' => 'ui',
            ]
        );

        $repeater->add_control(
            'eead_advanced_tile_scroll_images',
            [
                'label' => esc_html__('Images', 'easy-elementor-addons'),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $repeater->add_control(
            'eead_advanced_tile_scroll_x_start',
            [
                'label' => esc_html__('Start', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 550,
                ],
            ]
        );

        $repeater->add_control(
            'eead_advanced_tile_scroll_x_end',
            [
                'label' => esc_html__('End', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $section->add_control(
            'eead_advanced_tile_scroll_elements',
            [
                'label' => esc_html__('Tile Scroll Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ eead_advanced_tile_scroll_title }}}',
                'frontend_available' => true,
                'render_type' => 'none',
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes'
                ],
                'default' => [
                    [

                        'eead_advanced_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_advanced_tile_scroll_x_end' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                    ],
                    [

                        'eead_advanced_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'eead_advanced_tile_scroll_x_end' => [
                            'unit' => 'px',
                            'size' => -150,
                        ]
                    ],
                    [

                        'eead_advanced_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_advanced_tile_scroll_x_end' => [
                            'unit' => 'px',
                            'size' => 150,
                        ]
                    ],
                    [

                        'eead_advanced_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'eead_advanced_tile_scroll_x_end' => [
                            'unit' => 'px',
                            'size' => -150,
                        ]
                    ],
                    [

                        'eead_advanced_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_advanced_tile_scroll_x_end' => [
                            'unit' => 'px',
                            'size' => 150,
                        ]
                    ]
                ],
            ]
        );

        $section->end_controls_tab();

        $section->start_controls_tab(
            'tabs_eead_advanced_tile_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes'
                ]
            ]
        );

        $section->add_control(
            'eead_advanced_tile_scroll_display',
            [
                'label' => esc_html__('Scroll Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'easy-elementor-addons'),
                    'vertical' => esc_html__('Vertical', 'easy-elementor-addons'),
                ],
                'frontend_available' => true,
                'render_type' => 'template',
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes'
                ]
            ]
        );

        $section->add_control(
            'eead_advanced_tile_scroll_rotate',
            [
                'label' => esc_html__('Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-tile-scroll--horizontal .eead-advanced-tile-scroll__wrap' => 'top: 50%; transform: translate3d(-50%, -50%, 0) rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes',
                    'eead_advanced_tile_scroll_display' => 'horizontal'
                ]
            ]
        );

        $section->add_responsive_control(
            'eead_advanced_tile_scroll_item_width',
            [
                'label' => esc_html__('Width Adjustment', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.5,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-advanced-tile-scroll-item-width: {{SIZE}}%;',
                ],
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes',
                    'eead_advanced_tile_scroll_display' => 'horizontal'
                ]
            ]
        );

        $section->add_responsive_control(
            'eead_advanced_tile_scroll_height',
            [
                'label' => esc_html__('Height Adjustment', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['vw'],
                'default' => [
                    'unit' => 'vw',
                    'size' => 52,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-advanced-tile-scroll-height: {{SIZE}}vw;',
                ],
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes',
                ]
            ]
        );

        $section->add_responsive_control(
            'eead_advanced_tile_scroll_gap',
            [
                'label' => esc_html__('Grid Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-advanced-tile-scroll-margin: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes'
                ]
            ]
        );

        $section->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eead_advanced_tile_scroll_gap',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-advanced-tile-scroll__line-img',
                'separator' => 'before'
            ]
        );

        $section->add_responsive_control(
            'eead_advanced_tile_title_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-tile-scroll__line-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $section->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eead_advanced_tile_scroll_shadow',
                'label' => esc_html__('Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-advanced-tile-scroll__line-img',
            ]
        );

        $section->end_controls_tab();

        $section->end_controls_tabs();

        $section->add_control(
            'eead_advanced_tile_scroll_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(__('Please use proper size (for example: 640px X 560px) and optimize image for this gallery because tile gallery will show full size image so if you use large image that can slow down your scroll animation and page loading time', 'easy-elementor-addons')),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'condition' => [
                    'eead_advanced_tile_scroll_show' => 'yes',
                ],
                'separator' => 'before'
            ]
        );
    }

    public function register_section($element) {
        $element->start_controls_section(
            'eead_advanced_tile_scroll_section',
            [
                'tab' => Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__('Tile Scroll', 'easy-elementor-addons'),
            ]
        );

        $element->end_controls_section();
    }

}

AdvancedTileScroll::instance();