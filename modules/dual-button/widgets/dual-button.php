<?php

namespace EasyElementorAddons\Modules\DualButton\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class DualButton extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-dual-button';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Dual Button', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-flip-box';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
            'dual_btn_settings_field',
            [
                'label' => __( 'Button Settings', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button_layout',
            [
                'label'   => __( 'Layout', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => __( 'Horizontal', 'easy-elementor-addons' ),
                    'vertical'   => __( 'Vertical', 'easy-elementor-addons' ),
                ],
                'default' => 'horizontal',
            ]
        );

        $start = is_rtl() ? 'end' : 'start';
        $end   = is_rtl() ? 'start' : 'end';

        $this->add_responsive_control(
            'button_align',
            [
                'label'                => __( 'Alignment', 'easy-elementor-addons' ),
                'type'                 => Controls_Manager::CHOOSE,
                'options'              => [
                    'flex-start' => [
                        'title' => __( 'Left', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors_dictionary' => [
                    'flex-start' => 'flex-' . $start,
                    'flex-end'   => 'flex-' . $end,
                ],
                'selectors'            => [
                    '{{WRAPPER}} .eead-dual-button-main-wrapper' => 'justify-content: {{VALUE}}',
                ],
                'default'              => 'center',
            ]
        );

        $this->start_controls_tabs( 'tabs_dual_buttons_tabs' );

        $this->start_controls_tab(
            'tab_primary_btn_tab',
            [
                'label' => esc_html__( 'Primary Button', 'easy-elementor-addons' ),
            ]
        );
            
        $this->add_control(
            'button1_text',
            [
                'label'       => __( 'Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => 'true',
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __( 'Primary Button', 'easy-elementor-addons' ),
                'placeholder' => __( 'Primary Button', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button1_link',
            [
                'label'       => __( 'Link', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'easy-elementor-addons' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'button1_icon_new',
            [
                'label'            => __( 'Icon', 'easy-elementor-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'button1_icon',
            ]
        );

        $this->add_control(
            'button1_icon_align',
            [
                'label'   => __( 'Icon Position', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => __( 'Before', 'easy-elementor-addons' ),
                    'after'  => __( 'After', 'easy-elementor-addons' ),
                ],

            ]
        );

        $this->add_control(
            'button1_icon_spacing',
            [
                'label'     => __( 'Icon Spacing', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1.icon-before .eead-db-icon-wrapper' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .eead-button-1.icon-after .eead-db-icon-wrapper'  => 'margin-left: {{SIZE}}px;',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_secondary_btn_tab',
            [
                'label' => esc_html__( 'Secondary Button', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button2_text',
            [
                'label'       => __( 'Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => 'true',
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __( 'Secondary Button', 'easy-elementor-addons' ),
                'placeholder' => __( 'Secondary Button', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button2_link',
            [
                'label'       => __( 'Link', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'easy-elementor-addons' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'button2_icon_new',
            [
                'label'            => __( 'Icon', 'easy-elementor-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'button2_icon',
            ]
        );

        $this->add_control(
            'button2_icon_align',
            [
                'label'   => __( 'Icon Position', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => __( 'Before', 'easy-elementor-addons' ),
                    'after'  => __( 'After', 'easy-elementor-addons' ),
                ],

            ]
        );

        $this->add_control(
            'button2_icon_spacing',
            [
                'label'     => __( 'Icon Spacing', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2.icon-before .eead-db-icon-wrapper' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .eead-button-2.icon-after .eead-db-icon-wrapper'  => 'margin-left: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_separator',
            [
                'label' => __( 'Separator', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'separator_text',
            [
                'label'       => __( 'Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'description' => __( 'Please leave the field blank to hide separator.', 'easy-elementor-addons'),
                'default'     => __( 'OR', 'easy-elementor-addons' ),
                'placeholder' => __( 'OR', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'separator_icon_new',
            [
                'label'            => __( 'Icon', 'easy-elementor-addons' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'separator_icon',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'General', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_animation',
            [
                'label'        => __( 'Animation', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'none'    => __( 'None', 'easy-elementor-addons' ),
                    'animation_1' => __( 'Style 1', 'easy-elementor-addons' ),
                    'animation_2' => __( 'Style 2', 'easy-elementor-addons' ),
                    'animation_3' => __( 'Style 3', 'easy-elementor-addons' ),
                    'animation_4' => __( 'Style 4', 'easy-elementor-addons' ),
                    'animation_5' => __( 'Style 5', 'easy-elementor-addons' ),
                    'animation_6' => __( 'Style 6', 'easy-elementor-addons' ),
                    'animation_7' => __( 'Style 7', 'easy-elementor-addons' ),
                    'animation_8' => __( 'Style 8', 'easy-elementor-addons' ),
                ],
                'prefix_class' => 'animation-',
                'render_type'  => 'template',
                'default'      => 'none',
            ]
        );

        $this->add_control(
            'button_spacing',
            [
                'label'     => __( 'Spacing', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-dual-button-wrapper.button-style-horizontal .eead-button-1-wrapper' => is_rtl() ? 'margin-left: calc({{SIZE}}px/2) !important;' : 'margin-right: calc({{SIZE}}px/2);',
                    '{{WRAPPER}} .eead-dual-button-wrapper.button-style-horizontal .eead-button-2-wrapper' => is_rtl() ? 'margin-right: calc({{SIZE}}px/2) !important;' : 'margin-left: calc({{SIZE}}px/2);',
                    '{{WRAPPER}} .eead-dual-button-wrapper.button-style-vertical .eead-button-1-wrapper'   => 'margin-bottom: calc({{SIZE}}px/2);',
                    '{{WRAPPER}} .eead-dual-button-wrapper.button-style-vertical .eead-button-2-wrapper'   => 'margin-top: calc({{SIZE}}px/2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-button-1-wrapper,{{WRAPPER}} .eead-button-2-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .eead-dual-button-wrapper',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_primary_button',
            [
                'label' => __( 'Secondary Button', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                
                'selector' => '{{WRAPPER}} .eead-button-1-wrapper',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button1_color',
            [
                'label'     => __( 'Text Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1-wrapper .eead-button-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button1_icon_color',
            [
                'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1-wrapper .eead-db-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-button-1-wrapper .eead-db-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button1_background_color',
                'label'    => __( 'Background Color', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-button-1-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button1_text_hover_color',
            [
                'label'     => __( 'Text Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1-wrapper:hover .eead-button-1  ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button1_icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1-wrapper:hover .eead-db-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-button-1-wrapper:hover .eead-db-icon-wrapper svg' => 'fill : {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button1_background_color_hover',
                'label'    => __( 'Background Color', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}}.animation-none .eead-button-1-wrapper:hover,{{WRAPPER}} .eead-button-1-wrapper:hover:before,{{WRAPPER}} .eead-button-1-wrapper:before',
            ]
        );

        $this->add_control(
            'button1_border_hover_color',
            [
                'label'     => __( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'button1_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-1-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'button1_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width'  => [
                        'default' => [
                            'top'    => 0,
                            'right'  => 0,
                            'bottom' => 0,
                            'left'   => 0,
                            'unit'   => 'px',
                        ],
                    ],
                    'color'  => [
                        'default' => '#0c0c0c',
                    ],
                ],
                'selector'       => '{{WRAPPER}} .eead-button-1-wrapper',
                'separator'      => 'before',
            ]
        );

        $this->add_control(
            'button1_border_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-button-1-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.animation-none .eead-button-1-wrapper:hover,{{WRAPPER}} .eead-button-1-wrapper:hover:before,{{WRAPPER}} .eead-button-1-wrapper:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button1_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-dual-button-wrapper .eead-button-1-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_secondary_button',
            [
                'label' => __( 'Secondary Button', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => ' typography',
                
                'selector' => '{{WRAPPER}} .eead-button-2-wrapper',
            ]
        );

        $this->start_controls_tabs( 'tabs_button2_style' );

        $this->start_controls_tab(
            'tab_button2_normal',
            [
                'label' => __( 'Normal', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button2_color',
            [
                'label'     => __( 'Text Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2-wrapper .eead-button-2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_icon_color',
            [
                'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2-wrapper .eead-db-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-button-2-wrapper .eead-db-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button2_background_color',
                'label'    => __( 'Background Color', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-button-2-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button2_hover',
            [
                'label' => __( 'Hover', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'button2_text_hover_color',
            [
                'label'     => __( 'Text Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2-wrapper:hover .eead-button-2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2-wrapper:hover .eead-db-icon-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'button2_background_color_hover',
                'label'    => __( 'Background Color', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}}.animation-none .eead-button-2-wrapper:hover,{{WRAPPER}} .eead-button-2-wrapper:hover:before,{{WRAPPER}} .eead-button-2-wrapper:before',
            ]
        );

        $this->add_control(
            'button2_border_hover_color',
            [
                'label'     => __( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'button2_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-2-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'button2_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width'  => [
                        'default' => [
                            'top'    => 0,
                            'right'  => 0,
                            'bottom' => 0,
                            'left'   => 0,
                            'unit'   => 'px',
                        ],
                    ],
                    'color'  => [
                        'default' => '#0c0c0c',
                    ],
                ],
                'selector'       => '{{WRAPPER}} .eead-button-2-wrapper',
                'separator'      => 'before',
            ]
        );

        $this->add_control(
            'button2_border_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-button-2-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.animation-none .eead-button-2-wrapper:hover,{{WRAPPER}} .eead-button-2-wrapper:hover:before,{{WRAPPER}} .eead-button-2-wrapper:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button2_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-dual-button-wrapper .eead-button-2-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_separator',
            [
                'label' => __( 'Separator', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'separator_icon_size',
            [
                'label'     => __( 'Size', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => '40',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator'                          => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .button-style-horizontal .eead-button-separator-wrapper .eead-button-separator' => 'top:50%; right: calc(-{{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .button-style-vertical .eead-button-separator-wrapper .eead-button-separator'   => 'left: calc(50% - {{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'separator_typography',
                'label'     => __( 'Typography', 'easy-elementor-addons' ),
               
                'selector'  => '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator',
                'condition' => [
                    'separator_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'separator_icon_width',
            [
                'label'     => __( 'Icon Size', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => '14',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator svg'   => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'separator_text' => '',
                ],
            ]
        );

        $this->add_control(
            'separator_icon_color',
            [
                'label'     => __( 'Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                
                'selectors' => [
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator svg' => 'fill : {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_background_color',
            [
                'label'     => __( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'separator_border',
                'placeholder' => '1px',
                'selector'    => '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator',
            ]
        );

        $this->add_control(
            'separator_border_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'separator_box_shadow',
                'selector' => '{{WRAPPER}} .eead-button-separator-wrapper .eead-button-separator',
            ]
        );
        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
		$settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'main_wrapper', 'class', 'eead-dual-button-main-wrapper' );
        if ( is_rtl() ) {
            $this->add_render_attribute( 'main_wrapper', 'class', 'eead-dual-button-rtl' );
        }

        $this->add_render_attribute( 'button1', 'class', 'eead-button-1-wrapper' );
        if ( ! empty( $settings['button1_link']['url'] ) ) {
            $this->add_link_attributes( 'button1', $settings['button1_link'] );
        }

        $this->add_render_attribute( 'button2', 'class', 'eead-button-2-wrapper' );
        if ( ! empty( $settings['button2_link']['url'] ) ) {
            $this->add_link_attributes( 'button2', $settings['button2_link'] );
        }

        $this->add_render_attribute( 'button1_inner', [
            'class' => ['eead-button-1', 'icon-' . $settings['button1_icon_align']] 
        ]);

        $this->add_render_attribute( 'button2_inner', [
            'class' => ['eead-button-2', 'icon-' . $settings['button2_icon_align']] 
        ]);

        $this->add_render_attribute( 'wrapper', [
            'class' => ['eead-dual-button-wrapper', 'button-style-' . $settings['button_layout']] 
        ]);

        if ( $settings['button_animation'] !== 'none' ) {
            if ( $settings['button_animation'] === 'animation_1' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-sweep-left' );
                $this->add_render_attribute( 'button2', 'class', 'eead-sweep-right' );
            } elseif ( $settings['button_animation'] === 'animation_2' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-sweep-right' );
                $this->add_render_attribute( 'button2', 'class', 'eead-sweep-left' );
            } elseif ( $settings['button_animation'] === 'animation_3' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-bounce-left' );
                $this->add_render_attribute( 'button2', 'class', 'eead-bounce-right' );
            } elseif ( $settings['button_animation'] === 'animation_4' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-bounce-right' );
                $this->add_render_attribute( 'button2', 'class', 'eead-bounce-left' );
            } elseif ( $settings['button_animation'] === 'animation_5' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-sweep-top' );
                $this->add_render_attribute( 'button2', 'class', 'eead-sweep-bottom' );
            } elseif ( $settings['button_animation'] === 'animation_6' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-sweep-bottom' );
                $this->add_render_attribute( 'button2', 'class', 'eead-sweep-top' );
            } elseif ( $settings['button_animation'] === 'animation_7' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-bounce-top' );
                $this->add_render_attribute( 'button2', 'class', 'eead-bounce-bottom' );
            } elseif ( $settings['button_animation'] === 'animation_8' ) {
                $this->add_render_attribute( 'button1', 'class', 'eead-bounce-bottom' );
                $this->add_render_attribute( 'button2', 'class', 'eead-bounce-top' );
            }
        }

        ?>
        <div <?php $this->print_render_attribute_string( 'main_wrapper' ); ?>>
            <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                <div class="eead-button1">
                    <a <?php $this->print_render_attribute_string( 'button1' ); ?>>
                        <div <?php $this->print_render_attribute_string( 'button1_inner' ); ?>>
                            <?php if ( $settings['button1_icon_new'] !== '' ) { ?>
                                <div class="eead-db-icon-wrapper">
                                    <?php
                                    if ( isset( $settings['__fa4_migrated']['button1_icon_new'] ) || empty( $settings['button1_icon'] ) ) {
                                        Icons_Manager::render_icon( $settings['button1_icon_new'], [ 'aria-hidden' => 'true' ] );
                                    } else { ?>
                                        <i class="<?php echo $settings['button1_icon']; ?>"></i>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="eead-button-text"><?php echo $settings['button1_text']; ?></div>
                        </div>
                    </a>

                    <?php if ( ( !empty($settings['separator_icon_new']['value']) || !empty($settings['separator_text']) ) && ! is_rtl() ) { ?>
                        <span class="eead-button-separator-wrapper">
                            <span class="eead-button-separator">
                                <span>
                                    <?php
                                    if ( !empty($settings['separator_icon_new']) ) {
                                        if ( isset( $settings['__fa4_migrated']['separator_icon_new'] ) || empty( $settings['separator_icon'] ) ) {
                                            Icons_Manager::render_icon( $settings['separator_icon_new'], [ 'aria-hidden' => 'true' ] );
                                        } else { ?>
                                            <i class="<?php echo $settings['separator_icon']; ?>"></i>
                                            <?php
                                        }
                                    }
                                    if ( !empty($settings['separator_text']) ) {
                                        echo $settings['separator_text'];
                                    }
                                    ?>
                                </span>
                            </span>
                        </span>
                    <?php } ?>
                </div>
                <div class="eead-button2">
                    <?php if ( ( !empty($settings['separator_icon_new']['value']) || !empty($settings['separator_text']) ) && is_rtl() ) { ?>
                        <span class="eead-button-separator-wrapper">
                            <span class="eead-button-separator">
                                <span>
                                    <?php
                                    if ( !empty($settings['separator_icon_new']) ) {
                                        if ( $separator_icon_migrated || $separator_icon_is_new ) {
                                            Icons_Manager::render_icon( $settings['separator_icon_new'], [ 'aria-hidden' => 'true' ] );
                                        } else { ?>
                                            <i class="<?php echo $settings['separator_icon']; ?>"></i>
                                            <?php
                                        }
                                    }
                                    if ( !empty($settings['separator_text']) ) {
                                        echo $settings['separator_text'];
                                    }
                                    ?>
                                </span>
                            </span>
                        </span>
                    <?php } ?>
                    <a <?php $this->print_render_attribute_string( 'button2' ); ?>>
                        <div <?php $this->print_render_attribute_string( 'button2_inner' ); ?>>
                            <?php if ( !empty($settings['button2_icon_new']) ) { ?>
                                <div class="eead-db-icon-wrapper">
                                    <?php
                                    if ( isset( $settings['__fa4_migrated']['button2_icon_new'] ) || empty( $settings['button2_icon'] ) ) {
                                        Icons_Manager::render_icon( $settings['button2_icon_new'], [ 'aria-hidden' => 'true' ] );
                                    } else { ?>
                                        <i class="<?php echo $settings['button2_icon']; ?>"></i>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="eead-button-text"><?php echo $settings['button2_text']; ?></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
		
    }
   
}
