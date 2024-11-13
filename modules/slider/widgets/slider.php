<?php

namespace EasyElementorAddons\Modules\Slider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Slider Widget
 */
class Slider extends Widget_Base {

    public function get_name() {
        return 'eead-slider';
    }

    public function get_title() {
        return esc_html__('Slider', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eicon-slides';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['owlcarousel'];
    }

    public function get_script_depends() {
        return ['owlcarousel'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section', [
                'label' => esc_html__('Content', 'easy-elementor-addons')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slider_image', [
                'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'slider_title', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_caption', [
                'label' => esc_html__('Subtitle', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'placeholder' => esc_html__('Type your description here', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'slider_button_text', [
                'label' => esc_html__('Button Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Details', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'slider_button_link', [
                'label' => esc_html__('Button Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('Enter URL', 'easy-elementor-addons'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slider_text_alignment', [
                'label' => esc_html__('Text Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => esc_html__('Center', 'easy-elementor-addons'),
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons')
                ]
            ]
        );

        $this->add_control(
            'slider_block', [
                'label' => esc_html__('Sliders', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_title' => esc_html__('Slider #1', 'easy-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{ slider_title }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'normal_slider_settings', [
                'label' => esc_html__('Slider Settings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'thumbnail',
                'label' => esc_html__('Image Size', 'easy-elementor-addons'),
                'default' => 'full'
            ]
        );

        $this->add_control(
            'slider_transition', [
                'label' => esc_html__('Slider Transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => esc_html__('Slide', 'easy-elementor-addons'),
                    'fade' => esc_html__('Fade', 'easy-elementor-addons')
                ]
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
            'infinite', [
                'label' => esc_html__('Infinite Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
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
            'speed', [
                'label' => esc_html__('Animation Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500
            ]
        );

        $this->add_control(
            'dots', [
                'label' => esc_html__('Navigation Dots', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'arrows', [
                'label' => esc_html__('Navigation Arrows', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'auto_height', [
                'label' => esc_html__('Auto Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style', [
                'label' => esc_html__('Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'box_bg_color',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-slide-caption'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'box_border',
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
                'selector' => '{{WRAPPER}} .eead-slide-caption'
            ]
        );

        $this->add_control(
            'box_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'box_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
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
                    '{{WRAPPER}} .eead-slide-cap-title' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'title_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-cap-title span' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-slide-cap-title'
            ]
        );

        $this->add_responsive_control(
            'title_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-cap-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'title_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-cap-title span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'caption_style', [
                'label' => esc_html__('Caption', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'caption_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-cap-desc' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'caption_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-slide-cap-desc'
            ]
        );

        $this->add_responsive_control(
            'caption_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-cap-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-slide-button a'
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'normal_button_tab', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'button_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button a' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'button_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'button_border',
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
                'selector' => '{{WRAPPER}} .eead-slide-button a'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_button_tab', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'button_bg_hover_color', [
                'label' => esc_html__('Background Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button:hover a' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'button_hover_color', [
                'label' => esc_html__('Color (Hover)', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button:hover a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'button_border_hover',
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
                'selector' => '{{WRAPPER}} .eead-slide-button a:hover'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slide-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_control(
            'dots_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'dots_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
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
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_normal', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'border-color: {{VALUE}}',
                ]
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
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_active', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot.active' => 'border-color: {{VALUE}}',
                ]
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
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* Arrow Style */
        $this->start_controls_section(
            'arrow_style', [
                'label' => esc_html__('Naviagation Arrow Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'arrow_position', [
                'label' => esc_html__('Slider Transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'eead-arrow-outside',
                'options' => [
                    'eead-arrow-inside' => esc_html__('Inside', 'easy-elementor-addons'),
                    'eead-arrow-outside' => esc_html__('Outside', 'easy-elementor-addons')
                ]
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
        $slider_transition = $settings['slider_transition'];
        ?>

        <div id="eead-home-slider-section" class="eead-home-slider-section <?php echo esc_attr($settings['arrow_position']); ?>">
            <?php
            $sliders = $settings['slider_block'];
            $params = array(
                'autoplay' => $settings['autoplay'] && $settings['autoplay'] == 'yes' ? true : false,
                'loop' => $settings['infinite'] && $settings['infinite'] == 'yes' ? true : false,
                'pause' => isset($settings['autoplay_speed']['size']) && !empty($settings['autoplay_speed']['size']) ? (int) $settings['autoplay_speed']['size'] * 1000 : NULL,
                'speed' => (int) $settings['speed'],
                'dots' => $settings['dots'] == 'yes' ? true : false,
                'arrows' => $settings['arrows'] == 'yes' ? true : false,
                'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
                'auto_height' => $settings['auto_height'] == 'yes' ? true : false
            );
            $params = json_encode($params);
            ?>

            <div class="eead-slid er owl-c arousel <?php echo esc_attr($slider_class); ?>" data-params='<?php echo $params; ?>' data-transition="<?php echo esc_attr($slider_transition) ?>">
                <?php
                if (!empty($sliders)) {
                    foreach ($sliders as $key => $slider) {
                        $image = $slider['slider_image']['url'];
                        $title = $slider['slider_title'];
                        $caption = $slider['slider_caption'];
                        $button_text = $slider['slider_button_text'];
                        $button_link = $slider['slider_button_link']['url'];
                        $alignment = $slider['slider_text_alignment'];
                        ?>
                        <div class="eead-slide">
                            <?php
                            if ($image) {
                                $image_url = Group_Control_Image_Size::get_attachment_image_src($slider['slider_image']['id'], 'thumbnail', $settings);

                                if ($image_url) {
                                    echo '<img src="' . esc_url($image_url) . '">';
                                } else {
                                    echo '<img src="' . esc_url($slider['slider_image']['url']) . '">';
                                }
                            }
                            ?>

                            <div class="eead-slide-caption eead-slide-<?php echo esc_attr($alignment); ?>">
                                <?php if ($title) { ?>
                                    <div class="eead-slide-cap-title">
                                        <span><?php echo wp_kses_post($title); ?></span>
                                    </div>
                                <?php } ?>

                                <?php if ($caption) { ?>
                                    <div class="eead-slide-cap-desc">
                                        <?php echo wp_kses_post($caption); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($button_link) { ?>
                                    <div class="eead-slide-button">
                                        <a href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }

}
