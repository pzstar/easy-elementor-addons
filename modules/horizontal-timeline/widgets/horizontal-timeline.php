<?php

namespace EasyElementorAddons\Modules\HorizontalTimeline\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class HorizontalTimeline extends Widget_Base {

    public function get_name() {
        return 'eead-horizontal-timeline';
    }

    public function get_title() {
        return esc_html__('Horizontal Timeline', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-vertical-timeline';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['mcscrollbar'];
    }

    public function get_script_depends() {
        return ['mcscrollbar'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'items', [
                'label' => esc_html__('Items', 'easy-elementor-addons')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'enable', [
                'label' => esc_html__('Enable', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $repeater->add_control(
            'image', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'item_image',
                'default' => 'full'
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'meta', [
                'label' => esc_html__('Meta', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'point_heading', [
                'label' => esc_html__('Point', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'point_type', [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => array(
                    'icon' => esc_html__('Icon', 'easy-elementor-addons'),
                    'text' => esc_html__('Text', 'easy-elementor-addons'),
                )
            ]
        );

        $repeater->add_control(
            'icon', [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'solid',
                ],
                'condition' => ['point_type' => 'icon']
            ]
        );

        $repeater->add_control(
            'point_text', [
                'label' => esc_html__('Point Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'A',
                'condition' => ['point_type' => 'text']
            ]
        );

        $repeater->add_control(
            'button', [
                'label' => esc_html__('Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'button_text', [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More'
            ]
        );

        $repeater->add_control(
            'button_url', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ]
            ]
        );

        $this->add_control(
            'item_list', [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Item #1', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Thursday, August 31, 2020', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #2', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Friday, August 29, 2021', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #3', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Sunday, August 28, 2022', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #4', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Monday, August 27, 2023', 'easy-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{title}}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings', [
                'label' => esc_html__('Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'meta_position', [
                'label' => esc_html__('Meta Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'alternate',
                'options' => [
                    'top' => esc_html__('Top', 'easy-elementor-addons'),
                    'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
                    'alternate' => esc_html__('Alternate', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'display_option', [
                'label' => esc_html__('Display Option', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'scrollbar' => esc_html__('Scroll Bar', 'easy-elementor-addons'),
                    'carousel' => esc_html__('Carousel', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_responsive_control(
            'block_width', [
                'label' => esc_html__('Block Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 300,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-card' => 'min-width: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'display_option' => 'scrollbar'
                ]
            ]
        );

        $this->add_control(
            'alignment', [
                'label' => esc_html__('Text Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-card' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'title_html_tag', [
                'label' => esc_html__('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => eead_html_tags(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_settings', [
                'label' => esc_html__('Carousel Settings', 'easy-elementor-addons'),
                'condition' => [
                    'display_option' => 'carousel'
                ]
            ]
        );

        $this->add_responsive_control(
            'slides_to_show', [
                'label' => esc_html__('Slides To Show', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ]
            ]
        );

        $this->add_control(
            'infinite', [
                'label' => esc_html__('Infinite Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay', [
                'label' => esc_html__('Autoplay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pause_on_hover', [
                'label' => esc_html__('Pause on Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'autoplay_speed', [
                'label' => esc_html__('Autoplay Speed (in Seconds)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 15,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'size' => 5,
                    'unit' => 's',
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'arrows', [
                'label' => esc_html__('Navigation Arrows', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        /* Style Tab */
        $this->start_controls_section(
            'point_style_section', [
                'label' => esc_html__('Time Point', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'point_style', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'label_block' => false,
                'options' => [
                    'default' => esc_html__('Default', 'easy-elementor-addons'),
                    'framed' => esc_html__('Framed', 'easy-elementor-addons'),
                    'stacked' => esc_html__('Stacked', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'point_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'default' => 'center',
                'toggle' => false
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'point_background',
                'types' => ['classic', 'gradient'],
                'exclude' => [
                    'image',
                ],
                'color' => [
                    'default' => '#3858f4',
                ],
                'condition' => [
                    'point_style' => 'stacked',
                ],
                'selector' => '{{WRAPPER}} .eead-ht-point > span'
            ]
        );

        $this->add_control(
            'point_color', [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point .eead-ht-point-text, {{WRAPPER}} .eead-ht-point i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-ht-point svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .eead-ht-point-framed .eead-ht-point > span' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'point_icon_size', [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 21,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 250,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ht-point svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ]
            ]
        );

        $this->add_responsive_control(
            'point_size', [
                'label' => esc_html__('Point Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 70,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point > span' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'point_style!' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'point_gap', [
                'label' => esc_html__('Point Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ht-point-pos-left .eead-ht-point:after' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ht-point-pos-right .eead-ht-point:before' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'point_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point > span' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'point_style' => 'framed',
                ]
            ]
        );

        $this->add_control(
            'point_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-point > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'point_style!' => 'default',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'point_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-ht-point > span.eead-ht-point-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-title h2 a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-ht-title h2 a'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'title_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'none',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#444444',
                    ]
                ],
                'selector' => '{{WRAPPER}} .eead-ht-title h2 a'
            ]
        );

        $this->add_control(
            'title_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-title h2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'title_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-title h2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'title_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-title h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'description_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-ht-description'
            ]
        );

        $this->add_control(
            'description_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'readmore_style', [
                'label' => esc_html__('Read More', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'readmore_tabs'
        );

        $this->start_controls_tab(
            'readmore_tab_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'readmore_color_normal', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'readmore_bg_color_normal', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'readmore_border_color_normal', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a' => 'border: 1px solid {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'readmore_tab_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'readmore_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'readmore_bg_color_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a:hover' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'readmore_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-more-button a:hover' => 'border: 1px solid {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'readmore_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-more-button a',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'readmore_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-card .eead-more-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'readmore_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-card .eead-more-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'readmore_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-card .eead-more-button a' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'meta_style', [
                'label' => esc_html__('Meta', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'meta_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-meta,
                 {{WRAPPER}} .style2 .eead-ht-item:nth-child(even) .eead-ht-meta' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'meta_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-meta,
                 {{WRAPPER}} .style2 .eead-ht-item:nth-child(even) .eead-ht-meta' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-ht-meta'
            ]
        );

        $this->add_control(
            'meta_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'meta_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'none',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#444444',
                    ]
                ],
                'selector' => '{{WRAPPER}} .eead-ht-meta'
            ]
        );

        $this->add_control(
            'meta_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'meta_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ht-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout = $settings['layout'];

        $params = array(
            'items' => $settings['slides_to_show']['size'] ? (int) $settings['slides_to_show']['size'] : 3,
            'items_tablet' => isset($settings['slides_to_show_tablet']['size']) ? (int) $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => isset($settings['slides_to_show_mobile']['size']) ? (int) $settings['slides_to_show_mobile']['size'] : 1,
            'autoplay' => $settings['autoplay'] && $settings['autoplay'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] && $settings['infinite'] == 'yes' ? true : false,
            'pause' => isset($settings['autoplay_speed']['size']) ? (int) $settings['autoplay_speed']['size'] * 1000 : 500,
            'arrows' => $settings['arrows'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'prev_icon' => 'icofont-simple-left',
            'next_icon' => 'icofont-simple-right'
        );

        if (!empty($settings['prev_icon_arrow']['value'])) {
            $params['prev_icon'] = $settings['prev_icon_arrow']['value'];
        }

        if (!empty($settings['next_icon_arrow']['value'])) {
            $params['next_icon'] = $settings['next_icon_arrow']['value'];
        }

        $params = json_encode($params);

        $this->add_render_attribute('timeline-container', [
            'class' => [
                'eead-ht-list',
                'eead-ht-' . $settings['display_option'],
                'eead-ht-point-' .$settings['point_style'],
                'eead-ht-point-pos-' .$settings['point_position'],
                'eead-ht-meta-pos-' . $settings['meta_position']
            ]
        ]);

        if ($settings['display_option'] == 'carousel') {
            $this->add_render_attribute('timeline-container', [
                'class' => [
                    'owl-carousel'
                ],
                'data-params' => $params
            ]);
        }
        ?>

        <div class="eead-horizontal-timeline">
            <div <?php $this->print_render_attribute_string('timeline-container'); ?>>
                <?php
                $i = 0;
                foreach ($settings['item_list'] as $key => $item) {
                    if ($item['enable'] != 'yes') {
                        continue;
                    }
                    $alt_class = $i % 2 == 0 ? 'eead-ht-alt' : '';
                    ?>
                    <div class="eead-ht-card <?php echo esc_attr($alt_class); ?>">
                        <div class="eead-ht-content">
                            <div class="eead-ht-content-inner">
                                <div class="eead-ht-image">
                                    <?php
                                    echo Group_Control_Image_Size::get_attachment_image_html($item, 'item_image', 'image');
                                    ?>
                                </div>

                                <<?php echo $settings['title_html_tag']; ?> class="eead-ht-title">
                                    <?php
                                    echo esc_html($item['title']);
                                    ?>
                                </<?php echo $settings['title_html_tag']; ?>>

                                <div class="eead-ht-description">
                                    <p><?php echo esc_html($item['description']); ?></p>
                                </div>

                                <?php
                                if (!empty($item['button_url']['url'])) {
                                    $this->add_link_attributes('button_url' . $i, $item['button_url']);
                                    ?>
                                    <div class="eead-ht-more-button">
                                        <a <?php $this->print_render_attribute_string('button_url' . $i); ?>>
                                            <?php echo esc_html($item['button_text']); ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="eead-ht-point">
                            <?php
                            if ($item['point_type'] == 'icon') {
                                ?>
                                <span class="eead-ht-point-icon">
                                    <?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                                <?php
                            } elseif ($item['point_type'] == 'text') {
                                ?>
                                <span class="eead-ht-point-text">
                                    <?php echo esc_html($item['point_text']); ?>
                                </span>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="eead-ht-meta">
                            <span><?php echo esc_html($item['meta']); ?></span>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        </div>
        <?php
    }

}
