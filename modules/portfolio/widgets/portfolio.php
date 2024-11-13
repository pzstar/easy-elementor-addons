<?php

namespace EasyElementorAddons\Modules\Portfolio\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Portfolio extends Widget_Base {

    public function get_name() {
        return 'eead-portfolio';
    }

    public function get_title() {
        return esc_html__('Portfolio', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-portfolio-grid';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['light-gallery', 'owlcarousel'];
    }

    public function get_script_depends() {
        return ['light-gallery', 'owlcarousel'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'items', [
                'label' => esc_html__('Portfolio', 'easy-elementor-addons')
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
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                )
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
                'default' => esc_html__('Title', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'category', [
                'label' => esc_html__('Category', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Premium', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'link_button', [
                'label' => esc_html__('Link Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'link_button_icon', [
                'label' => esc_html__('Link Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-link',
                    'library' => 'solid',
                ]
            ]
        );

        $repeater->add_control(
            'link_button_url', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ]
            ]
        );

        $repeater->add_control(
            'zoom_button', [
                'label' => esc_html__('Zoom Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'zoom_button_icon', [
                'label' => esc_html__('Zoom Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-search',
                    'library' => 'solid',
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
                        'category' => esc_html__('Free', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #2', 'easy-elementor-addons'),
                        'category' => esc_html__('Premium', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Item #3', 'easy-elementor-addons'),
                        'category' => esc_html__('Premium', 'easy-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{ title }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings', [
                'label' => esc_html__('Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons')
                ]
            ]
        );

        $this->add_control(
            'layout_type', [
                'label' => esc_html__('Layout Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'eead-portfolio-default',
                'options' => [
                    'eead-portfolio-carousel' => esc_html__('Carousel', 'easy-elementor-addons'),
                    'eead-portfolio-default' => esc_html__('Default', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_responsive_control(
            'image_height', [
                'label' => esc_html__('Image Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-image' => 'height: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-image' => 'height: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-image' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_min_width', [
                'label' => esc_html__('Image Min Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop'],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-portfolio-lists.eead-portfolio-default' => 'grid-template-columns: repeat(auto-fit, minmax({{SIZE}}{{UNIT}}, 1fr));'
                ],
                'condition' => ['layout_type' => 'eead-portfolio-default']
            ]
        );

        $this->add_responsive_control(
            'grid_space', [
                'label' => esc_html__('Grid Space', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-portfolio-lists.eead-portfolio-default' => 'grid-gap: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .eead-portfolio-lists.eead-portfolio-default' => 'grid-gap: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-portfolio-lists.eead-portfolio-default' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout_type' => 'eead-portfolio-default']
            ]
        );

        $this->add_control(
            'show_zoom', [
                'label' => esc_html__('Show Zoom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'show_link', [
                'label' => esc_html__('Show Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'show_category', [
                'label' => esc_html__('Show Category', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_section', [
                'label' => esc_html__('Carousel Settings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['layout_type' => 'eead-portfolio-carousel']
            ]
        );

        $this->add_control(
            'autoplay', [
                'label' => esc_html__('Autoplay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER
            ]
        );

        $this->add_control(
            'infinite', [
                'label' => esc_html__('Infinite Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pause_duration', [
                'label' => esc_html__('Pause Duration', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 5,
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'no_of_slides', [
                'label' => esc_html__('No of Slides', 'easy-elementor-addons'),
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

        $this->add_responsive_control(
            'slides_margin', [
                'label' => esc_html__('Spacing Between Slides', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile']
            ]
        );

        $this->add_responsive_control(
            'slides_stagepadding', [
                'label' => esc_html__('Stage Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile']
            ]
        );

        $this->add_control(
            'nav', [
                'label' => esc_html__('Nav Arrow', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'easy-elementor-addons'),
                'label_off' => esc_html__('Hide', 'easy-elementor-addons'),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'dots', [
                'label' => esc_html__('Dots', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'easy-elementor-addons'),
                'label_off' => esc_html__('Hide', 'easy-elementor-addons'),
                'default' => ''
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
                    '{{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-details .eead-portfolio-title h2' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-details .eead-portfolio-title h2'
            ]
        );

        $this->add_control(
            'title_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-details .eead-portfolio-title h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style', [
                'label' => esc_html__('Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'btn_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size', [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-portfolio-button a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .eead-portfolio-button a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-portfolio-button a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs(
            'button_tabs'
        );

        $this->start_controls_tab(
            'link_btn_tab', [
                'label' => esc_html__('Link Button', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'link_btn_color_normal', [
                'label' => esc_html__('Color (Normal)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-link-btn' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'link_btn_bg_color_normal', [
                'label' => esc_html__('Background Color (Normal)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-link-btn' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'link_btn_color_hover', [
                'label' => esc_html__('Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-link-btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'link_btn_bg_color_hover', [
                'label' => esc_html__('Background Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-link-btn:hover' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'zoom_btn_tab', [
                'label' => esc_html__('Zoom Button', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'zoom_btn_color_normal', [
                'label' => esc_html__('Color (Normal)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-zoom-portfolio' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'zoom_btn_bg_color_normal', [
                'label' => esc_html__('Background Color (Normal)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-zoom-portfolio' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'zoom_btn_color_hover', [
                'label' => esc_html__('Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-zoom-portfolio:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'zoom_btn_bg_color_hover', [
                'label' => esc_html__('Background Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-button a.eead-zoom-portfolio:hover' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'overlay_style', [
                'label' => esc_html__('Overlay', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'overlay_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-portfolio-section.style1 .eead-portfolio-item .eead-portfolio-image:before,
                    {{WRAPPER}} .eead-portfolio-section.style2 .eead-portfolio-card .eead-portfolio-details'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'category_style', [
                'label' => esc_html__('Category', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'category_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-details .eead-portfolio-category' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'category_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-portfolio-lists .eead-portfolio-card .eead-portfolio-details .eead-portfolio-category' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dot_style', [
                'label' => esc_html__('Naviagation Dot Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'dot_tabs'
        );

        $this->start_controls_tab(
            'dot_style_normal_tab', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'dot_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dot_border_color_normal',
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
                'selector' => '{{WRAPPER}} .owl-dots .owl-dot'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'dot_style_active_tab', [
                'label' => esc_html__('Active', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'dot_color_active', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dot_border_color_active',
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
                'selector' => '{{WRAPPER}} .owl-dots .owl-dot.active'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'dot_style_hover_tab', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'dot_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dot_border_color_hover',
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
                'selector' => '{{WRAPPER}} .owl-dots .owl-dot:hover'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dots_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'dots_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .owl-dots' => 'display: flex;justify-content: center;'
                ]
            ]
        );

        $this->add_control(
            'dots_top_margin', [
                'label' => esc_html__('Margin Top', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots' => 'margin-top: {{SIZE}}{{UNIT}};display: flex;justify-content: center;'
                ]
            ]
        );

        $this->add_control(
            'dots_right_margin', [
                'label' => esc_html__('Dots Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'arrow_style', [
                'label' => esc_html__('Naviagation Arrow Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'arrow_border',
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
                'selector' => '{{WRAPPER}} .owl-nav button'
            ]
        );

        $this->add_control(
            'arrow_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'arrow_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;display: flex; align-items: center; justify-content: center;',
                ]
            ]
        );

        $this->start_controls_tabs(
            'arrow_tabs'
        );

        $this->start_controls_tab(
            'arrow_style_normal_tab', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'arrow_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_border_color_normal', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'arrow_style_hover_tab', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'arrow_bg_color_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-nav button:hover' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout_type = $settings['layout_type'];

        $this->add_render_attribute('portfolio-lists', [
            'class' => 'eead-portfolio-lists ' . esc_attr($layout_type),
        ]);

        if ($layout_type == 'eead-portfolio-carousel') {
            $params = [
                'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
                'pause' => $settings['autoplay'] == 'yes' ? (int) $settings['pause_duration']['size'] * 1000 : '',
                'items' => (int) isset($settings['no_of_slides']['size']) ? $settings['no_of_slides']['size'] : 3,
                'items_tablet' => (int) isset($settings['no_of_slides_tablet']['size']) ? $settings['no_of_slides_tablet']['size'] : 2,
                'items_mobile' => (int) isset($settings['no_of_slides_mobile']['size']) ? $settings['no_of_slides_mobile']['size'] : 1,
                'margin' => (int) isset($settings['slides_margin']['size']) ? $settings['slides_margin']['size'] : '',
                'margin_tablet' => (int) isset($settings['slides_margin_tablet']['size']) ? $settings['slides_margin_tablet']['size'] : '',
                'margin_mobile' => (int) isset($settings['slides_margin_mobile']['size']) ? $settings['slides_margin_mobile']['size'] : '',
                'loop' => $settings['infinite'] && $settings['infinite'] == 'yes' ? true : false,
                'stagepadding' => (int) isset($settings['slides_stagepadding']['size']) ? $settings['slides_stagepadding']['size'] : '',
                'stagepadding_tablet' => (int) isset($settings['slides_stagepadding_tablet']['size']) ? $settings['slides_stagepadding_tablet']['size'] : '',
                'stagepadding_mobile' => (int) isset($settings['slides_stagepadding_mobile']['size']) ? $settings['slides_stagepadding_mobile']['size'] : '',
                'nav' => $settings['nav'] == 'yes' ? true : false,
                'dots' => $settings['dots'] == 'yes' ? true : false
            ];
            $params = json_encode($params);

            $this->add_render_attribute('portfolio-lists', [
                'class' => 'owl-carousel',
                'data-params' => $params
            ]);
        }
        ?>
        <div class="eead-portfolio-section <?php echo esc_attr($settings['style']); ?>">

            <div <?php echo $this->get_render_attribute_string('portfolio-lists'); ?>>

                <?php
                foreach ($settings['item_list'] as $key => $item) {

                    if ($item['enable'] != 'yes') {
                        continue;
                    }
                    ?>

                    <div class="eead-portfolio-item">
                        <div class="eead-portfolio-card">
                            <div class="eead-portfolio-image">
                                <?php
                                if (!$item['image']) {
                                    $placeholder_img = Utils::get_placeholder_image_src();
                                    echo '<img src="' . esc_url($placeholder_img) . '" >';
                                } else {
                                    echo Group_Control_Image_Size::get_attachment_image_html($item, 'item_image', 'image');
                                }

                                if ($settings['style'] == 'style1') {
                                    ?>
                                    <div class="eead-portfolio-button">
                                        <?php if ($settings['show_link'] == 'yes' && $item['link_button_url']['url']) { ?>
                                            <a href="<?php echo esc_url($item['link_button_url']['url']); ?>" class="eead-link-btn">
                                                <?php Icons_Manager::render_icon($item['link_button_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>

                                        <?php if ($settings['show_zoom'] == 'yes' && $item['image']['url']) { ?>
                                            <a href="<?php echo esc_url($item['image']['url']); ?>" class="eead-zoom-portfolio">
                                                <?php Icons_Manager::render_icon($item['zoom_button_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="eead-portfolio-details">
                                <div class="eead-portfolio-title">
                                    <h2><?php echo esc_html($item['title']); ?></h2>
                                </div>

                                <?php if ($settings['style'] == 'style2') { ?>
                                    <div class="eead-portfolio-button">
                                        <?php if ($settings['show_link'] == 'yes' && $item['link_button_url']['url']) { ?>
                                            <a href="<?php echo esc_url($item['link_button_url']['url']); ?>" class="eead-link-btn">
                                                <?php Icons_Manager::render_icon($item['link_button_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>

                                        <?php if ($settings['show_zoom'] == 'yes' && $item['image']['url']) { ?>
                                            <a href="<?php echo esc_url($item['image']['url']); ?>" class="eead-zoom-portfolio">
                                                <?php Icons_Manager::render_icon($item['zoom_button_icon'], ['aria-hidden' => 'true']); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if ($settings['show_category'] == 'yes' && $item['category'] != '') { ?>
                                    <div class="eead-portfolio-category">
                                        <span><?php echo esc_html($item['category']); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}
