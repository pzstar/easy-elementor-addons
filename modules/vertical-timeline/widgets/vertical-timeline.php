<?php

namespace EasyElementorAddons\Modules\VerticalTimeline\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class VerticalTimeline extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-vertical-timeline';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Vertical Timeline Block', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-time-line';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'items',
            [
                'label' => esc_html__('Items', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'enable',
            [
                'label' => esc_html__('Enable', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'item_image',
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
            ]
        );

        $repeater->add_control(
            'meta',
            [
                'label' => esc_html__('Meta', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'point_heading',
            [
                'label' => esc_html__('Point', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'solid',
                ]
            ]
        );

        $repeater->add_control(
            'button',
            [
                'label' => esc_html__('Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'item_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Item #1', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Thursday, August 31, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #2', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Thursday, August 29, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #3', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Thursday, August 28, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #4', 'easy-elementor-addons'),
                        'description' => esc_html__('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => esc_html__('Thursday, August 27, 2018', 'easy-elementor-addons'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'square-plus'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__('H1', 'square-plus'),
                    'h2' => esc_html__('H2', 'square-plus'),
                    'h3' => esc_html__('H3', 'square-plus'),
                    'h4' => esc_html__('H4', 'square-plus'),
                    'h5' => esc_html__('H5', 'square-plus'),
                    'h6' => esc_html__('H6', 'square-plus'),
                    'div' => esc_html__('div', 'square-plus'),
                    'span' => esc_html__('span', 'square-plus'),
                    'p' => esc_html__('p', 'square-plus')
                ],
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => esc_html__('Layout Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'toggle' => false,
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
                    ],
                ],
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label' => esc_html__('Content Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'toggle' => false,
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
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_width',
            [
                'label' => esc_html__('Content Width (%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 60,
                ],
                'condition' => [
                    'layout_style!' => 'center',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-wrap .eead-card-right .eead-vtimeline-each-wrap, {{WRAPPER}} .eead-vtimeline-wrap .eead-card-left .eead-vtimeline-each-wrap' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .eead-vtimeline-wrap .eead-card-right .eead-vtimeline-inner:before' => 'left: calc(100% - {{SIZE}}%);',
                    '{{WRAPPER}} .eead-vtimeline-wrap .eead-card-left .eead-vtimeline-inner:before' => 'left: {{SIZE}}%;'
                ],
            ]
        );

        $this->end_controls_section();

        /* Style Tab */
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'frame_style',
            [
                'label' => esc_html__('Frame Style', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'boxed' => esc_html__('Boxed', 'easy-elementor-addons'),
                    'bordered' => esc_html__('Bordered', 'easy-elementor-addons')
                ],
            ]
        );

        $this->add_control(
            'frame_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card, {{WRAPPER}} .eead-frame-boxed .eead-vtimeline-card:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['frame_style' => 'boxed']
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'frame_box_shadow',
                'selector' => '{{WRAPPER}} .eead-vtimeline-card',
                'condition' => ['frame_style' => 'boxed']
            ]
        );

        $this->add_control(
            'frame_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['frame_style' => 'bordered']
            ]
        );

        $this->add_control(
            'frame_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['frame_style!' => 'none']
            ]
        );

        $this->add_responsive_control(
            'frame_padding',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['frame_style!' => 'none']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_box_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-wrap.style3 .eead-vtimeline-heading-box,
                {{WRAPPER}} .eead-vtimeline-wrap.style3 .eead-vtimeline-heading-box:before' => 'background: {{VALUE}}',
                ],
                'condition' => ['style' => 'style3']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-title',
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card .eead-vtimeline-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-vtimeline-card .eead-vtimeline-description',
            ]
        );

        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-card .eead-vtimeline-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'readmore_style',
            [
                'label' => esc_html__('Read More', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmore_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-vtimeline-more-button a',
            ]
        );

        $this->add_control(
            'readmore_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->start_controls_tabs(
            'readmore_tabs'
        );

        $this->start_controls_tab(
            'readmore_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'readmore_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'readmore_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'readmore_style_active_tab',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'readmore_active_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'readmore_active_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a:hover' => 'background: {{VALUE}}',
                ],
                'condition' => ['style' => 'style1']
            ]
        );

        $this->add_control(
            'readmore_active_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'readmore_border',
                'selector' => '{{WRAPPER}} .eead-vtimeline-more-button a',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'readmore_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'readmore_button_box_shadow',
                'selector' => '{{WRAPPER}} .eead-vtimeline-more-button a',
            ]
        );

        $this->add_responsive_control(
            'readmore_text_padding',
            [
                'label' => esc_html__('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-more-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'meta_style',
            [
                'label' => esc_html__('Meta', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-meta' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'meta_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-meta, {{WRAPPER}} .eead-vtimeline-wrap .eead-vtimeline-meta:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-meta',
            ]
        );

        $this->add_control(
            'meta_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-each-wrap .eead-vtimeline-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'time_point_style',
            [
                'label' => esc_html__('Time Point', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'time_point_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-point' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-vtimeline-point svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'time_point_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-point' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'time_point_outline_color',
            [
                'label' => esc_html__('Outline Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-point' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'timeline_color',
            [
                'label' => esc_html__('Time Line Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-wrap .eead-vtimeline-inner:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'point_size',
            [
                'label' => esc_html__('Point Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-point' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-vtimeline-point i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-vtimeline-point svg' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="eead-vtimeline-wrap <?php echo esc_attr($settings['style']); ?>">
            <div class="<?php echo 'eead-card-' . esc_attr($settings['layout_style']) . ' eead-frame-' . esc_attr($settings['frame_style']); ?>">
                <div class="eead-vtimeline-inner">

                    <?php foreach ($settings['item_list'] as $key => $item) { ?>

                        <?php
                        if ($item['enable'] != 'yes') {
                            continue;
                        }
                        ?>
                        <div class="eead-vtimeline-each-wrap">
                            <?php if ($settings['style'] == 'style3') { ?>
                                <div class="eead-vtimeline-heading-box">
                                    <?php $this->get_timeline_title($item); ?>

                                    <div class="eead-vtimeline-point">
                                        <?php
                                        \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="eead-vtimeline-card">
                                <?php if ($settings['style'] == 'style1' || $settings['style'] == 'style2') { ?>
                                    <div class="eead-vtimeline-point">
                                        <?php
                                        \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                                        if ($settings['style'] == 'style1') {
                                            ?>
                                            <div class="eead-vtimeline-meta">
                                                <span><?php echo esc_html($item['meta']); ?></span>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="eead-vtimeline-post-image">
                                        <?php if ($settings['style'] == 'style2' && !empty($item['meta'])) { ?>
                                            <div class="eead-vtimeline-meta">
                                                <span><?php echo esc_html($item['meta']); ?></span>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if (!$item['image']) {
                                            $placeholder_img = \Elementor\Utils::get_placeholder_image_src();
                                            echo '<img src="' . esc_url($placeholder_img) . '" >';
                                        } else {
                                            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'item_image', 'image');
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    if ($settings['style'] == 'style2') {
                                        echo '<div class="eead-desc-wrap">';
                                    }

                                    $this->get_timeline_title($item);
                                    ?>

                                    <div class="eead-vtimeline-description">
                                        <p><?php echo wp_kses_post($item['description']); ?></p>
                                    </div>

                                    <?php $this->get_timeline_button($item); ?>

                                    <?php
                                    if ($settings['style'] == 'style2') {
                                        echo '</div>';
                                    }
                                    ?>
                                <?php } else { ?>

                                    <div class="eead-vtimeline-post-image">

                                        <?php if (!empty($item['meta'])) { ?>
                                            <div class="eead-vtimeline-meta">
                                                <span><?php echo esc_html($item['meta']); ?></span>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if (!$item['image']) {
                                            $placeholder_img = \Elementor\Utils::get_placeholder_image_src();
                                            echo '<img src="' . esc_url($placeholder_img) . '" >';
                                        } else {
                                            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'item_image', 'image');
                                        }
                                        ?>
                                    </div>

                                    <div class="eead-vtimeline-description">
                                        <p><?php echo wp_kses_post($item['description']); ?></p>
                                    </div>

                                    <?php $this->get_timeline_button($item); ?>
                                <?php } ?>
                            </div>
                        </div> <!--eead-timeline-each-wrap-->

                    <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }

    protected function get_timeline_title($item) {
        $settings = $this->get_settings_for_display();
        $target = $item['button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $item['button_url']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
        <<?php echo $settings['title_html_tag']; ?> class="eead-vtimeline-title">
            <?php
            if (!empty($item['button_url']['url'])) {
                printf('<a href="%1$s" %2$s>%3$s</a>', $item['button_url']['url'], $target . $nofollow, esc_html($item['title']));
            } else {
                echo esc_html($item['title']);
            }
            ?>
        </<?php echo $settings['title_html_tag']; ?>>
        <?php
    }

    protected function get_timeline_button($item) {
        $target = $item['button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $item['button_url']['nofollow'] ? ' rel="nofollow"' : '';
        if ($item['button_url']['url']) {
            ?>
            <div class="eead-vtimeline-more-button">
                <a href="<?php echo $item['button_url']['url']; ?>" <?php echo $target . $nofollow; ?>>
                    <?php echo esc_html($item['button_text']); ?>
                </a>
            </div>
            <?php
        }
    }

}
