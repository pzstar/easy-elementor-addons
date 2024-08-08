<?php

namespace EasyElementorAddons\Modules\FlipBoxAdvanced\Widgets;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class FlipBoxAdvanced extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-flip-box-advanced';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('FlipBox Advanced', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-flip-box';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_flipbox_style',
            [
                'label' => esc_html__('Style Preset', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_flipbox_layout_style',
            [
                'label' => esc_html__('Design Variation', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'one' => esc_html__('Default', 'easy-elementor-addons'),
                    'two' => esc_html__('Front Image', 'easy-elementor-addons'),
                    'three' => esc_html__('Diagnonal', 'easy-elementor-addons'),
                    'four' => esc_html__('Front Icon', 'easy-elementor-addons')
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'animation_style',
            [
                'label' => esc_html__('Animation Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => esc_html__('Flip Horizontal', 'easy-elementor-addons'),
                    'vertical' => esc_html__('Flip Vertical', 'easy-elementor-addons'),
                    'fade' => esc_html__('Fade', 'easy-elementor-addons'),
                    'flipcard flipcard-rotate-top-down' => esc_html__('Cube - Top Down', 'easy-elementor-addons'),
                    'flipcard flipcard-rotate-down-top' => esc_html__('Cube - Down Top', 'easy-elementor-addons'),
                    'flipcard flipcard-rotate-left-right' => esc_html__('Cube - Left Right', 'easy-elementor-addons'),
                    'flipcard flipcard-rotate-right-left' => esc_html__('Cube - Right Left', 'easy-elementor-addons'),
                    'flip box' => esc_html__('Flip Box', 'easy-elementor-addons'),
                    'flip box fade' => esc_html__('Flip Box Fade', 'easy-elementor-addons'),
                    'flip box fade up' => esc_html__('Fade Up', 'easy-elementor-addons'),
                    'flip box fade hideback' => esc_html__('Fade Hideback', 'easy-elementor-addons'),
                    'flip box fade up hideback' => esc_html__('Fade Up Hideback', 'easy-elementor-addons'),
                    'nananana' => esc_html__('Nananana', 'easy-elementor-addons'),
                    'rollover' => esc_html__('Rollover', 'easy-elementor-addons'),
                    'flip3d' => esc_html__('3d Flip', 'easy-elementor-addons'),
                    'left-to-right' => esc_html__('Left to Right', 'easy-elementor-addons'),
                    'right-to-left' => esc_html__('Right to Left', 'easy-elementor-addons'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'easy-elementor-addons'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'easy-elementor-addons'),
                    'top-to-bottom-angle' => esc_html__('Diagonal (Top to Bottom)', 'easy-elementor-addons'),
                    'bottom-to-top-angle' => esc_html__('Diagonal (Bottom to Top)', 'easy-elementor-addons'),
                    'fade-in-out' => esc_html__('Fade In Out', 'easy-elementor-addons'),
                ],
                'default' => 'vertical',
                'prefix_class' => 'eead-fb-animate-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_front_box',
            [
                'label' => esc_html__('Front Box', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'front_icon_view',
            [
                'label' => esc_html__('Icon Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'easy-elementor-addons'),
                    'stacked' => esc_html__('Stacked', 'easy-elementor-addons'),
                    'framed' => esc_html__('Framed', 'easy-elementor-addons'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'front_icon_shape',
            [
                'label' => esc_html__('Shape', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => esc_html__('Circle', 'easy-elementor-addons'),
                    'square' => esc_html__('Square', 'easy-elementor-addons'),
                ],
                'default' => 'circle',
                'condition' => [
                    'front_icon_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'front_icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'description' => esc_html__('Please choose an icon from the list.', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-elementor',
                    'library' => 'brand',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'front_title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter text', 'easy-elementor-addons'),
                'default' => esc_html__('Front Title Here', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'front_text',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter text', 'easy-elementor-addons'),
                'default' => esc_html__('Add some nice text here.', 'easy-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'front_box_front_text_align',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'front_title_html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => eead_html_tags(),
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_back_box',
            [
                'label' => esc_html__('Back Box', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'back_icon_view',
            [
                'label' => esc_html__('View', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'easy-elementor-addons'),
                    'stacked' => esc_html__('Stacked', 'easy-elementor-addons'),
                    'framed' => esc_html__('Framed', 'easy-elementor-addons'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'back_icon_shape',
            [
                'label' => esc_html__('Shape', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => esc_html__('Circle', 'easy-elementor-addons'),
                    'square' => esc_html__('Square', 'easy-elementor-addons'),
                ],
                'default' => 'circle',
                'condition' => [
                    'back_icon_view!' => 'default',
                ],
            ]
        );

        $this->add_control(
            'back_icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'description' => esc_html__('Please choose an icon from the list.', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'brand',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter text', 'easy-elementor-addons'),
                'default' => esc_html__('Text Title', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'back_text',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter text', 'easy-elementor-addons'),
                'default' => esc_html__('Add some nice text here.', 'easy-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'front_box_back_text_align',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_title_html_tag',
            [
                'label' => esc_html__('HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => eead_html_tags(),
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section-action-button',
            [
                'label' => esc_html__('Action Button', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label' => esc_html__('Button Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Buy', 'easy-elementor-addons'),
                'default' => esc_html__('Buy Now', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link to', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('http://your-link.com', 'easy-elementor-addons'),
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section-general-style',
            [
                'label' => esc_html__('General', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'eead_el_flip_3d',
            [
                'label' => esc_html__('3d Flip Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'flip_3d_left' => esc_html__('Slide Right to Left', 'easy-elementor-addons'),
                    'flip_3d_right' => esc_html__('Slide Left to Right', 'easy-elementor-addons'),
                    'flip_3d_top' => esc_html__('Slide Top to Bottom', 'easy-elementor-addons'),
                    'flip_3d_bottom' => esc_html__('Slide Bottom to Top', 'easy-elementor-addons'),
                ],
                'default' => '3d_left',
                'condition' => [
                    'animation_style' => 'flip3d'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'flip_box_border',
                'label' => esc_html__('Box Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-flip-box-inner > div',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_height',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Flip Box Height', 'easy-elementor-addons'),
                'placeholder' => esc_html__('250', 'easy-elementor-addons'),
                'default' => esc_html__('250', 'easy-elementor-addons'),
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-inner' => 'height: {{VALUE}}px;',
                    '{{WRAPPER}}.eead-fb-animate-flipcard .eead-flip-box-front' => 'transform-origin: center center calc(-{{VALUE}}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);',
                    '{{WRAPPER}}.eead-fb-animate-flipcard .eead-flip-box-back' => 'transform-origin: center center calc(-{{VALUE }}px/2);-webkit-transform-origin:center center calc(-{{VALUE}}px/2);'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section-front-box-style',
            [
                'label' => esc_html__('Front Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_box_bg_color',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'default' => '#fff',
                'selector' => '{{WRAPPER}} .eead-flip-box-front',
                'condition' => [
                    'eead_flipbox_layout_style' => ['one', 'three', 'four']
                ]
            ]
        );

        $this->add_control(
            'front_box_image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'eead_flipbox_layout_style' => 'two',
                ],
            ]
        );

        $this->add_control(
            'front_box_background_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'front_box_title_color',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#393c3f',
                'selectors' => [
                    '{{WRAPPER}} .front-icon-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'front_title!' => ''
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_box_title_typography',
                'label' => esc_html__('Title Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .front-icon-title',
            ]
        );

        $this->add_control(
            'front_box_text_color',
            [
                'label' => esc_html__('Description Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#78909c',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_box_text_typography',
                'label' => esc_html__('Description Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-flip-box-front p',
            ]
        );

        $this->add_control(
            'front_box_icon_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4b00e7',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front .icon-wrapper i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'front_icon!' => ''
                ],
            ]
        );

        $this->add_control(
            'front_box_icon_fill_color',
            [
                'label' => esc_html__('Icon Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#41dcab',
                'selectors' => [
                    '{{WRAPPER}} .eead-fb-icon-view-stacked' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'front_icon_view' => 'stacked'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_box_icon_border',
                'label' => esc_html__('Box Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-flip-box-front .eead-fb-icon-view-framed, {{WRAPPER}} .eead-flip-box-front .eead-fb-icon-view-stacked',
                'label_block' => true,
                'condition' => [
                    'front_icon_view!' => 'default'
                ],
            ]
        );

        $this->add_control(
            'front_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-front .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 1.5,
                    'unit' => 'em',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                    ],
                ],
                'condition' => [
                    'front_icon_view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section-back-box-style',
            [
                'label' => esc_html__('Back Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_box_background',
                'label' => esc_html__('Back Box Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-flip-box-back',
            ]
        );

        $this->add_control(
            'back_box_title_color',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .back-icon-title' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_box_title_typography',
                'label' => esc_html__('Title Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .back-icon-title',
            ]
        );

        $this->add_control(
            'back_box_text_color',
            [
                'label' => esc_html__('Description Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_box_text_typography',
                'label' => esc_html__('Description Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-flip-box-back p',
            ]
        );

        $this->add_control(
            'back_box_icon_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFF',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back .icon-wrapper i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'back_icon!' => ''
                ],
            ]
        );

        $this->add_control(
            'back_box_icon_fill_color',
            [
                'label' => esc_html__('Icon Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back .eead-fb-icon-view-stacked' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'front_icon_view' => 'stacked'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_box_icon_border',
                'label' => esc_html__('Box Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-flip-box-back .eead-fb-icon-view-framed, {{WRAPPER}} .eead-flip-box-back .eead-fb-icon-view-stacked',
                'label_block' => true,
                'condition' => [
                    'back_icon_view!' => 'default'
                ],
            ]
        );

        $this->add_control(
            'back_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-back .icon-wrapper' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 1.5,
                    'unit' => 'em',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                    ],
                ],
                'condition' => [
                    'back_icon_view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_action_button_style',
            [
                'label' => esc_html__('Action Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('jlteead_flipbox_action_btn_style');

        $this->start_controls_tab(
            'jlteead_flipbox_action_btn_style_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4b00e7',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'jlteead_flipbox_action_btn_style_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4b00e7',
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button:hover',
            ]
        );

        $this->add_control(
            'border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_padding_hover',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-flip-box-wrapper .eead-flip-box-back .flipbox-content .eead-fb-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'eead_el_flipbox',
            'class',
            [
                'eead-flip-box'
            ]
        );

        $this->add_render_attribute('front-icon-wrapper', 'class', 'icon-wrapper');
        $this->add_render_attribute('front-icon-wrapper', 'class', 'eead-fb-icon-view-' . $settings['front_icon_view']);
        $this->add_render_attribute('front-icon-wrapper', 'class', 'eead-fb-icon-shape-' . $settings['front_icon_shape']);
        $this->add_render_attribute('front-icon-title', 'class', 'front-icon-title');
        $this->add_render_attribute('front-icon', 'class', $settings['front_icon']);
        $this->add_render_attribute('back-icon-wrapper', 'class', 'icon-wrapper');
        $this->add_render_attribute('back-icon-wrapper', 'class', 'eead-fb-icon-view-' . $settings['back_icon_view']);
        $this->add_render_attribute('back-icon-wrapper', 'class', 'eead-fb-icon-shape-' . $settings['back_icon_shape']);
        $this->add_render_attribute('back-icon-title', 'class', 'back-icon-title');
        $this->add_render_attribute('back-icon', 'class', $settings['back_icon']);
        $this->add_render_attribute('button', 'class', 'eead-fb-button');
        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('button', 'href', $settings['link']['url']);

            if (!empty($settings['link']['is_external'])) {
                $this->add_render_attribute('button', 'target', '_blank');
            }
        }

        $flip_box = $this->get_settings_for_display('front_box_image');
        if (isset($flip_box['id']) && $flip_box['id'] != "") {
            $flip_box_url_src = Group_Control_Image_Size::get_attachment_image_src(
                $flip_box['id'],
                'full',
                $settings
            );
        }

        if (!empty($flip_box['url'])) {
            $flip_box_url = $flip_box['url'];
        } else {
            $flip_box_url = isset($flip_box_url_src);
        }
        ?>

        <div class="eead-flip-box-wrapper <?php echo $settings['eead_flipbox_layout_style'] ?> <?php if ($settings['eead_el_flip_3d']) {
                echo $settings['eead_el_flip_3d'];
            }
            ; ?>">
            <div class="eead-flip-box-inner">
                <div class="eead-flip-box-front">
                    <div class="flipbox-content">

                        <?php
                        if ($settings['eead_flipbox_layout_style'] == "two") {
                            if (isset($flip_box_url) && $flip_box_url != "") {
                                ?>
                                <img src="<?php echo esc_url($flip_box_url); ?>" alt="<?php echo get_post_meta($flip_box['id'], '_wp_attachment_image_alt', true); ?>">
                                <?php
                            }
                        } else if (($settings['eead_flipbox_layout_style'] == "one") || ($settings['eead_flipbox_layout_style'] == "three")) {
                            if ((!empty($settings['icon']) || !empty($settings['front_icon']['value']))) {
                                ?>
                                    <div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
                                    <?php $this->eead_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], 'front-icon'); ?>
                                    </div>
                                <?php
                            }

                            if (!empty($settings['front_title'])) {
                                ?>
                                    <<?php echo tag_escape($settings['front_title_html_tag']); ?>                 <?php echo $this->get_render_attribute_string('front-icon-title'); ?>>
                                    <?php echo esc_html($settings['front_title']); ?>
                                    </<?php echo tag_escape($settings['front_title_html_tag']); ?>>
                                <?php
                            }
                            ?>
                                <p>
                                <?php echo esc_html($settings['front_text']); ?>
                                </p>

                            <?php
                        }
                        if ($settings['eead_flipbox_layout_style'] == "four") {
                            if (!empty($settings['front_icon'])) {
                                ?>
                                <div <?php echo $this->get_render_attribute_string('front-icon-wrapper'); ?>>
                                    <?php $this->eead_fa_icon_picker('fab fa-elementor', 'icon', $settings['front_icon'], 'front-icon'); ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="eead-flip-box-back">
                    <div class="flipbox-content">

                        <?php
                        if (!empty($settings['back_icon'])) {
                            ?>
                            <div <?php echo $this->get_render_attribute_string('back-icon-wrapper'); ?>>
                                <?php $this->eead_fa_icon_picker('fab fa-elementor', 'icon', $settings['back_icon'], 'back-icon'); ?>
                            </div>
                            <?php
                        }

                        if (!empty($settings['back_title'])) {
                            ?>
                            <<?php echo tag_escape($settings['back_title_html_tag']); ?>             <?php echo $this->get_render_attribute_string('back-icon-title'); ?>>
                                <?php echo esc_html($settings['back_title']); ?>
                            </<?php echo tag_escape($settings['back_title_html_tag']); ?>>
                            <?php
                        }

                        if (!empty($settings['back_text'])) {
                            ?>
                            <p>
                                <?php echo $settings['back_text']; ?>
                            </p>
                            <?php
                        }

                        if (!empty($settings['action_text'])) {
                            ?>
                            <div class="eead-fb-button-wrapper">
                                <a <?php $this->print_render_attribute_string('button'); ?>>
                                    <span class="elementor-button-text">
                                        <?php echo esc_html($settings['action_text']); ?>
                                    </span>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function eead_fa_icon_picker($font_name = 'fab fa-elementor', $fa4_name = "", $control_name = "", $attr_name = "", $extra_class = "", $settings = '') {

        if (!isset($settings[$fa4_name]) && !Icons_Manager::is_migration_allowed()) {
            $settings[$fa4_name] = 'fab fa-elementor';
        }

        $has_icon = !empty($settings[$fa4_name]);
        if ($has_icon and 'icon' == $control_name) {
            $this->add_render_attribute($attr_name, 'class', [$control_name . $extra_class]);
            $this->add_render_attribute($attr_name, 'aria-hidden', 'true');
        }

        if (!$has_icon && !empty($control_name['value'])) {
            $has_icon = true;
        }

        $migrated = isset($settings['__fa4_migrated'][$control_name]);
        $is_new = empty($settings[$fa4_name]);

        if ($is_new || $migrated) {
            Icons_Manager::render_icon($control_name, [
                'class' => $extra_class,
                'aria-hidden' => 'true'
            ]);
        } else {
            echo '<i ' . $this->get_render_attribute_string($attr_name) . '></i>';
        }
    }
}