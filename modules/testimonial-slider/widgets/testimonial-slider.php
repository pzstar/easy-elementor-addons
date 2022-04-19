<?php
namespace EasyElementorAddons\Modules\TestimonialSlider\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TestimonialSlider extends Widget_Base {

	public function get_name() {
		return 'eead-testimonial-slider-block';
	}

	public function get_title() {
		return esc_html__( 'Testimonial Slider', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

    public function get_style_depends() {
        return [ 'owlcarousel' ];
    }

    public function get_script_depends() {
        return [ 'owlcarousel' ];
    }

	protected function register_controls() {
	   $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'easy-elementor-addons'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'name', [
            'label' => __('Name', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'John Doe'
                ]
        );

        $repeater->add_control(
                'designation', [
            'label' => __('Designation', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Support Engineer'
                ]
        );

        $repeater->add_control(
                'testimonial_title', [
            'label' => __('Testimonial Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => ''
                ]
        );

        $repeater->add_control(
                'testimonial_content', [
            'label' => __('Testimonial Content', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXTAREA,
            'rows' => 8,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Quisque maximus ex eros, at tincidunt arcu placerat tempus. Quisque at lacinia mauris, a auctor urna. Donec laoreet tincidunt nisi ac sodales.'
                ]
        );

        $this->add_control(
                'testimonials', [
            'label' => __('Testimonials', 'easy-elementor-addons'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ name }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->add_control(
                'image_shape', [
            'label' => __('Image Shape', 'easy-elementor-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'eead-square',
            'options' => [
                'eead-square' => __('Square', 'easy-elementor-addons'),
                'eead-round' => __('Round', 'easy-elementor-addons')
            ],
                ]
        );

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'easy-elementor-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
                'style1' => __('Style 1', 'easy-elementor-addons'),
                'style2' => __('Style 2', 'easy-elementor-addons'),
                'style3' => __('Style 3', 'easy-elementor-addons')
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_settings', [
            'label' => esc_html__('Carousel Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => __('Autoplay', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_on_hover', [
            'label' => __('Pause on Hover', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'infinite', [
            'label' => __('Infinite Loop', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed (in Seconds)', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 15,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 5,
                'unit' => 's',
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'speed', [
            'label' => __('Animation Speed', 'easy-elementor-addons'),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
                ]
        );

        $this->add_control(
                'dots', [
            'label' => __('Navigation Dots', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'arrows', [
            'label' => __('Navigation Arrow', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'auto_height', [
            'label' => __('Auto Height', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
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
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
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
            ],
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
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_style', [
            'label' => esc_html__('General Styles', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'content_bg_color', [
            'label' => esc_html__('Backgrond Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-each-slider' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'content_border_color', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-block.style1.eead-testimonial-slider .eead-testimonial-each-slider' => 'border: 5px solid {{VALUE}}',
            ],
            'condition' => ['layout' => 'style1']
                ]
        );

        $this->add_control(
            'each_slide_padding',
            [
                'label'      => esc_html__( 'Slide Item Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-testimonial-each-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'label' => __( 'Box Shadow', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-testimonial-each-slider',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'name_style', [
            'label' => esc_html__('Name', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'name_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-member-name' => 'color: {{VALUE}}'
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'name_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-testimonial-member-name',
                ]
        );

        $this->add_control(
                'name_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-member-name' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'designation_style', [
            'label' => esc_html__('Designation', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'designation_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-member-designation' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'designation_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-testimonial-member-designation',
                ]
        );

        $this->add_control(
                'designation_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-member-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'testimonial_style', [
            'label' => esc_html__('Testimonial', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'testimonial_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'testimonial_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt',
                ]
        );

        $this->add_control(
                'backquote_color', [
            'label' => esc_html__('Backquote Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-backquote' => 'color: {{VALUE}}',
            ],
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->add_control(
                'testimonial_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'testimonial_border_color', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content:before' => 'background: {{VALUE}}',
            ],
            'separator' => 'before',
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->add_control(
                'testimonial_border_height', [
            'label' => __('Border Height', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 8,
                    'step' => 1
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content:before' => 'height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->add_control(
                'testimonial_border_width', [
            'label' => __('Border Width', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                    'step' => 1
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content:before' => 'width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->add_control(
                'testimonial_border_margin', [
            'label' => esc_html__('Border Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'testimonial_title_style', [
            'label' => esc_html__('Testimonial Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'testimonial_title_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content h3' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'testimonial_title_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-testimonial-content h3',
                ]
        );

        $this->add_control(
                'testimonial_title_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-testimonial-content h3' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'dot_style', [
            'label' => esc_html__('Naviagation Dot Style', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label'                 => __( 'Alignment', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'flex-start'      => [
                        'title' => __( 'Left', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'     => [
                        'title' => __( 'Right', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ]
                ],
                'default'               => 'center',
                'selectors'             => [
                    '{{WRAPPER}} .owl-dots'   => 'display:flex; justify-content: {{VALUE}}; align-items: center;',
                ],
            ]
        );

        $this->add_responsive_control(
                'dots_spacing', [
            'label' => esc_html__('Spacing', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
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
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}'
            ]
                ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'        => 'dot_border',
                'label'       => esc_html__( 'Border', 'easy-elementor-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .owl-dots .owl-dot',
            ]
        );

        $this->add_control(
            'dots_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dots_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-dots .owl-dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'dots_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->start_controls_tabs(
                'dot_tabs'
        );

        $this->start_controls_tab(
                'dot_style_normal_tab', [
            'label' => esc_html__('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_normal', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_active_tab', [
            'label' => esc_html__('Active', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color_active', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_active', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot.active' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_hover_tab', [
            'label' => esc_html__('Hover', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color_hover', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_hover', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-dots .owl-dot:hover' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /*Arrow Style*/
        $this->start_controls_section(
                'arrow_style', [
            'label' => esc_html__('Naviagation Arrow Style', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'        => 'arrow_border',
                'label'       => esc_html__( 'Border', 'easy-elementor-addons' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .owl-nav button',
            ]
        );

        $this->add_control(
            'arrow_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;display: flex; align-items: center; justify-content: center;',
                ],
            ]
        );

        $this->start_controls_tabs(
                'arrow_tabs'
        );

        $this->start_controls_tab(
                'arrow_style_normal_tab', [
            'label' => esc_html__('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'arrow_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_border_color_normal', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'arrow_style_hover_tab', [
            'label' => esc_html__('Hover', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'arrow_bg_color_hover', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color_hover', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_border_color_hover', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .owl-nav button:hover' => 'border-color: {{VALUE}}',
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
        $testimonial_class = [
            $settings['image_shape'],
            $settings['layout']
        ];
        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'pause' => (int) $settings['autoplay_speed']['size'] * 1000,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false,
            'arrows' => $settings['arrows'] == 'yes' ? true : false,
            'items' => (int) $settings['slides_to_show']['size'],
            'items_tablet' => (int) isset($settings['slides_to_show_tablet']['size']) ? $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => (int) isset($settings['slides_to_show_mobile']['size']) ? $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) isset($settings['slides_margin_tablet']['size']) ? $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => (int) isset($settings['slides_margin_mobile']['size']) ? $settings['slides_margin_mobile']['size'] : 20,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'auto_height' => $settings['auto_height'] == 'yes' ? true : false,
        );
        ?>
        <div class="eead-testimonial-block eead-testimonial-slider <?php echo esc_attr(implode(' ', $testimonial_class)) ?>">
            <div class="eead-testimonial-all-slides owl-carousel" data-params='<?php echo json_encode($params); ?>'>
                <?php                
                if($settings['layout'] == 'style3') {
                    $this->get_style3();
                }else if($settings['layout'] == 'style2') {
                    $this->get_style2();
                }else {
                    $this->get_style1();
                }
                ?>
            </div>
        </div>

        <?php
    }

    protected function get_style1() {
        $settings = $this->get_settings_for_display();

        if ($settings['testimonials']) {
        ?>
            <?php foreach ($settings['testimonials'] as $item) { ?>
                <div class="eead-testimonial-each-slider">
                    <div class="eead-testimonial-image">
                        <?php
                        $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                        if (!$image_url) {
                            $image_url = Utils::get_placeholder_image_src();
                        }
                        echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($item['image'])) . '" />';
                        ?>
                    </div>

                    <div class="eead-testimonial-holder">
                        <div class="eead-testimonial-content">
                            <?php
                            if(!empty($item['testimonial_title'])) {
                                printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($item['testimonial_title']));
                            }

                            if (!empty($item['testimonial_content'])) {
                                echo '<div class="eead-testimonial-txt">';
                                echo wp_kses_post($item['testimonial_content']);
                                echo '</div>';
                            }
                            ?>
                        </div> 

                        <div class="eead-testimonial-name-wrap">
                            <h1 class="eead-testimonial-member-name">
                                <?php echo esc_html($item['name']); ?>
                            </h1>

                            <div class="eead-testimonial-member-designation">
                                <?php echo esc_html($item['designation']); ?>
                            </div>
                        </div>
                    </div>  
                </div>
            <?php } ?>
        <?php 
        } 
    }

    protected function get_style2() {
        $settings = $this->get_settings_for_display();

        if ($settings['testimonials']) {
        ?>
            <?php foreach ($settings['testimonials'] as $item) { ?>
                <div class="eead-testimonial-each-slider">
                    <div class="eead-testimonial-content">
                        <?php
                        if(!empty($item['testimonial_title'])) {
                            printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($item['testimonial_title']));
                        }

                        if (!empty($item['testimonial_content'])) {
                            echo '<div class="eead-testimonial-txt">';
                            echo wp_kses_post($item['testimonial_content']);
                            echo '</div>';
                        }
                        ?>
                    </div> 

                    <div class="eead-footer-section">
                        <div class="eead-testimonial-image">
                            <?php
                        $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                        if (!$image_url) {
                            $image_url = Utils::get_placeholder_image_src();
                        }
                        echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($item['image'])) . '" />';
                        ?>
                        </div>

                        <div class="eead-testimonial-name-wrap">
                            <h1 class="eead-testimonial-member-name">
                                <?php echo esc_html($item['name']); ?>
                            </h1>

                            <div class="eead-testimonial-member-designation">
                                <?php echo esc_html($item['designation']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php 
        } 
    }

    protected function get_style3() {
        $settings = $this->get_settings_for_display();

        if ($settings['testimonials']) {
        ?>
            <?php foreach ($settings['testimonials'] as $item) { ?>
                <div class="eead-testimonial-each-slider">
                    <div class="eead-testimonial-backquote"><i class="icofont-quote-left"></i></div>

                    <div class="eead-testimonial-content">
                        <?php
                        if(!empty($item['testimonial_title'])) {
                            printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($item['testimonial_title']));
                        }

                        if (!empty($item['testimonial_content'])) {
                            echo '<div class="eead-testimonial-txt">';
                            echo wp_kses_post($item['testimonial_content']);
                            echo '</div>';
                        }
                        ?>
                    </div> 

                    <div class="eead-testimonial-image">
                        <?php
                        $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                        if (!$image_url) {
                            $image_url = Utils::get_placeholder_image_src();
                        }
                        echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($item['image'])) . '" />';
                        ?>
                    </div>

                    <div class="eead-testimonial-name-wrap">
                        <h1 class="eead-testimonial-member-name">
                            <?php echo esc_html($item['name']); ?>
                        </h1>

                        <div class="eead-testimonial-member-designation">
                            <?php echo esc_html($item['designation']); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php 
        } 
    }


}
