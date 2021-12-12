<?php
namespace EasyElementorAddons\Modules\PopupVideo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PopupVideo extends Widget_Base {

	public function get_name() {
		return 'eead-popup-video-block';
	}

	public function get_title() {
		return esc_html__( 'Popup Video', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-navigation-vertical';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

    public function get_script_depends() {
        return [ 'magnific-popup' ];
    }

    public function get_style_depends() {
        return [ 'magnific-popup' ];
    }

	protected function _register_controls() {
		
	   $this->start_controls_section(
            'eead_video_popup_content_section',
            [
                'label' => esc_html__( 'Video', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_video_popup_button_style',
            [
                'label' => esc_html__( 'Button Style', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'text'  => esc_html__( 'Text', 'easy-elementor-addons' ),
                    'icon' => esc_html__( 'Icon', 'easy-elementor-addons' ),
                    'both' => esc_html__( 'Both', 'easy-elementor-addons' ),
                ],
            ]
        );

         $this->add_control(
            'eead_video_popup_button_title',
            [
                'label' =>esc_html__( 'Button Title', 'easy-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Play Video', 'easy-elementor-addons' ),
                'default' =>esc_html__( 'Play', 'easy-elementor-addons' ),
                'condition' => [
                    'eead_video_popup_button_style' => ['text', 'both']
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
         );

         $this->add_control(
            'eead_video_popup_button_icons__switch',
            [
                'label' => esc_html__('Enable Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'condition' => [
                    'eead_video_popup_button_style' => ['icon', 'both'],
                ]
            ]
        );

         $this->add_control(
            'eead_video_popup_button_icons',
            [
                'label' =>esc_html__( 'Button Icon', 'easy-elementor-addons' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-play',
                    'library' => 'fa-solid',
                ],
                'label_block' => true,
                'condition' => [
                    'eead_video_popup_button_style'         => ['icon', 'both'],
                    'eead_video_popup_button_icons__switch' => 'yes'
                ]
            ]
         );
         $this->add_control(
            'eead_video_popup_icon_align',
            [
                'label' =>esc_html__( 'Icon Position', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' =>esc_html__( 'Before', 'easy-elementor-addons' ),
                    'after' =>esc_html__( 'After', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'eead_video_popup_button_style' => 'both',
                    'eead_video_popup_button_icons__switch' => 'yes'
                ]
            ]
        );

         $this->add_control(
            'eead_video_popup_video_type',
            [
                'label'     => esc_html__( 'Video Type', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'youtube',
                'options'   => [
                      'youtube'=> esc_html__( 'youtube', 'easy-elementor-addons' ),
                ]
            ]
        );

        $this->add_control(
            'eead_video_popup_url',
            [
                'label' => esc_html__( 'URL to embed', 'easy-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html( 'https://www.youtube.com/watch?v=MLpWrANjFbI' ),
                'default' => esc_html('https://www.youtube.com/watch?v=MLpWrANjFbI'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'eead_video_popup_video_ripple_effect',
            [
                'label' =>esc_html__( 'Ripple Effect Button', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
         );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_video_popup_controls_section',
            [
                'label' => esc_html__( 'Play Settings', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_video_popup_start_time',
            [
                'label' => esc_html__( 'Start Time (in sec)', 'easy-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'input_type' => 'number',
                'placeholder' =>  '',
                'default' => '0',
                'condition' => ['eead_video_popup_video_type' => 'youtube' ]
            ]
        );

        $this->add_control(
            'eead_video_popup_end_time',
            [
                'label' => esc_html__( 'End Time (in sec)', 'easy-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'input_type' => 'number',
                'placeholder' => '',
                'default' => '',
                'condition' => ['eead_video_popup_video_type' => 'youtube']
            ]
        );
        $this->add_control(
            'eead_video_popup_auto_play',
            [
                'label' => esc_html__( 'Auto Play', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => '1',
                'default' => '0',
            ]
        );

        $this->add_control(
            'eead_video_popup_video_mute',
            [
                'label' => esc_html__( 'Mute', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => '1',
                'default' => '0',
            ]
        );

        $this->add_control(
            'eead_video_popup_video_loop',
            [
                'label' => esc_html__( 'Loop', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => '1',
                'default' => '0',
            ]
        );

        $this->add_control(
            'eead_video_popup_video_player_control',
            [
                'label' => esc_html__( 'Player Control', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => '1',
                'default' => '0',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_video_popup_style_section',
            [
                'label' => esc_html__( 'Wrapper', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_title_align', [
                'label'          =>esc_html__( 'Alignment', 'easy-elementor-addons' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [

                    'left'       => [
                        'title'  =>esc_html__( 'Left', 'easy-elementor-addons' ),
                        'icon'   => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title'  =>esc_html__( 'Center', 'easy-elementor-addons' ),
                        'icon'   => 'fa fa-align-center',
                    ],
                    'right'      => [
                        'title'  =>esc_html__( 'Right', 'easy-elementor-addons' ),
                        'icon'   => 'fa fa-align-right',
                    ],
                    'justify'    => [
                        'title'  =>esc_html__( 'Justified', 'easy-elementor-addons' ),
                        'icon'   => 'fa fa-align-justify',
                    ],
                ],
                'default'        => 'center',
                'selectors' => [
                    '{{WRAPPER}} .video-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_video_wrap_padding',
            [
                'label' => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .video-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'eead_video_wrap_border',
                'label' => esc_html__( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .video-content',
            ]
        );

        $this->add_control(
            'eead_video_wrap_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .video-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        /* Style Controls */
        $this->start_controls_section(
            'eead_video_popup_section_style',
            [
                'label' =>esc_html__( 'Button', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_video_popup_btn_ripple_color',
            [
                'label' => esc_html__( 'Ripple Color', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn.ripple-btn:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-video-popup-btn.ripple-btn:after' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-video-popup-btn.ripple-btn > i:after' => 'color: {{VALUE}}',
                ],
                'default' => '#DF6EB8',
                'condition' => [
                    'eead_video_popup_video_ripple_effect' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-video-popup-btn svg' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_btn_width',
            [
                'label' => esc_html__( 'Width', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_btn_height',
            [
                'label' => esc_html__( 'Height', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_btn_line_height',
            [
                'label' => esc_html__( 'Line height', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'line-height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs( 'eead_video_popup_button_style_tabs' );

        $this->start_controls_tab(
            'eead_video_popup_button_normal',
            [
                'label' =>esc_html__( 'Normal', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_video_popup_btn_text_color',
            [
                'label' =>esc_html__( 'Text Color', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-video-popup-btn svg path'    => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'eead_video_popup_btn_bg_color',
                'default' => '',
                'selector' => '{{WRAPPER}} .eead-video-popup-btn',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eead_video_popup_btn_tab_button_hover',
            [
                'label' =>esc_html__( 'Hover', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_video_popup_btn_hover_color',
            [
                'label' =>esc_html__( 'Text Color', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-video-popup-btn:hover svg path'  => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'eead_video_popup_btn_bg_hover_color',
                'default' => '',
                'selector' => '{{WRAPPER}} .eead-video-popup-btn:hover',
            )
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'eead_video_popup_text_padding',
            [
                'label' =>esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_typography_shadow',
            [
                'label' => __( 'Typography & Shadows', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'eead_video_popup_btn_typography',
                'label' =>esc_html__( 'Text Typography', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-video-popup-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eead_video_popup_btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-video-popup-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'eead_video_popup_btn_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-video-popup-btn',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_video_popup_border_style',
            [
                'label' =>esc_html__( 'Border', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_video_popup_btn_border_style',
            [
                'label' => esc_html_x( 'Border Type', 'Border Control', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'easy-elementor-addons' ),
                    'solid' => esc_html_x( 'Solid', 'Border Control', 'easy-elementor-addons' ),
                    'double' => esc_html_x( 'Double', 'Border Control', 'easy-elementor-addons' ),
                    'dotted' => esc_html_x( 'Dotted', 'Border Control', 'easy-elementor-addons' ),
                    'dashed' => esc_html_x( 'Dashed', 'Border Control', 'easy-elementor-addons' ),
                    'groove' => esc_html_x( 'Groove', 'Border Control', 'easy-elementor-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'eead_video_popup_btn_border_dimensions',
            [
                'label' => esc_html_x( 'Width', 'Border Control', 'easy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'eead_video_popup__button_border_style' );
        $this->start_controls_tab(
            'eead_video_popup__button_border_normal',
            [
                'label' =>esc_html__( 'Normal', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_video_popup_btn_border_color',
            [
                'label' => esc_html_x( 'Color', 'Border Control', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'eead_video_popup_btn_tab_button_border_hover',
            [
                'label' =>esc_html__( 'Hover', 'easy-elementor-addons' ),
            ]
        );
        $this->add_control(
            'eead_video_popup_btn_hover_border_color',
            [
                'label' => esc_html_x( 'Color', 'Border Control', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'eead_video_popup_btn_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'easy-elementor-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn, {{WRAPPER}} .eead-video-popup-btn:before' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'eead_video_popup_icon_style',
            [
                'label' => esc_html__( 'Icon', 'easy-elementor-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eead_video_popup_button_icons__switch' => 'yes',
                    'eead_video_popup_button_style' => ['both']
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_icon_padding_right',
            [
                'label' => esc_html__( 'Padding Right', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn > i' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_video_popup_button_style' => 'both',
                    'eead_video_popup_icon_align' => 'before'
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_video_popup_icon_padding_left',
            [
                'label' => esc_html__( 'Padding Left', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-video-popup-btn > i' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'eead_video_popup_button_style' => 'both',
                    'eead_video_popup_icon_align' => 'after'
                ]
            ]
        );

        $this->end_controls_section();
	}

    private function video_icon() {
        $settings = $this->get_settings_for_display();
        $migrated = isset( $settings['__fa4_migrated']['eead_video_popup_button_icons'] );
        $is_new = empty( $settings['eead_video_popup_button_icon'] );

        if ( $is_new || $migrated ) {
            Icons_Manager::render_icon( $settings['eead_video_popup_button_icons'], [ 'aria-hidden' => 'true' ] );
        } else { ?>
            <i class="<?php echo esc_attr($settings['eead_video_popup_button_icon']); ?>" aria-hidden="true"></i>
            <?php
        }
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
        extract($settings);
        $eead_video_popup_url = $eead_video_popup_url."?autoplay={$eead_video_popup_auto_play}&loop={$eead_video_popup_video_loop}&controls={$eead_video_popup_video_player_control}&mute={$eead_video_popup_video_mute}&start={$eead_video_popup_start_time}&end={$eead_video_popup_end_time}&version=3";
        ?>
        <div class="eead-popup-video-wrap">
            <div class="eead-video-content video-content">
                <a href="<?php echo esc_url($eead_video_popup_url); ?>" class="eead-video-popup eead-video-popup-btn <?php echo esc_attr($eead_video_popup_button_style == 'icon' ? 'eead_icon_button': '') ?> <?php echo esc_attr($eead_video_popup_video_ripple_effect=="yes"?"ripple-btn":''); ?>">
                    <?php if($eead_video_popup_button_style == 'text') { ?>
                        <span><?php echo esc_html($eead_video_popup_button_title); ?></span>
                    <?php } ?>
                    
                    <?php 
                    if($eead_video_popup_button_style == 'icon' && !empty($eead_video_popup_button_icons)) { 
                        echo $this->video_icon(); 
                    } 
                    if($eead_video_popup_button_style == 'both') { 
                        if($eead_video_popup_icon_align == 'before' && !empty($eead_video_popup_button_icons)) { 
                            echo $this->video_icon(); 
                        } 
                        ?>
                        <span><?php echo esc_html($eead_video_popup_button_title); ?></span>
                        <?php 
                        if($eead_video_popup_icon_align == 'after' && !empty($eead_video_popup_button_icons)) { 
                            echo $this->video_icon(); 
                        } 
                    } 
                    ?>
                </a>
            </div>
        </div>
        <?php
    }
}