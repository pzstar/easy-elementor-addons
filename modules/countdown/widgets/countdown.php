<?php

namespace EasyElementorAddons\Modules\Countdown\Widgets;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Countdown extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-countdown';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Countdown', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-counter-circle';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'countdown' ];
    }

    public function get_style_depends() {
        return [  ];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'eead_section_countdown_general_settings',
            [
                'label' => esc_html__( 'Timer', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_countdown_due_time',
            [
                'label'       => esc_html__( 'Countdown Due Date & Time', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date( "Y-m-d", strtotime( "+ 1 day" ) ),
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_label_view',
            [
                'label'   => esc_html__( 'Label Position', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'eead-countdown-label-block',
                'options' => [
                    'eead-countdown-label-block'  => esc_html__( 'Block', 'easy-elementor-addons' ),
                    'eead-countdown-label-inline' => esc_html__( 'Inline', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_label_padding_left',
            [
                'label'       => esc_html__( 'Left spacing for Labels', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SLIDER,
                'description' => esc_html__( 'Use when you select inline labels', 'easy-elementor-addons' ),
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eead-countdown-label' => 'padding-left:{{SIZE}}px;',
                ],
                'condition'   => [
                    'eead_countdown_label_view' => 'eead-countdown-label-inline',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_alignment',
            [
                'label'   => esc_html__( 'Label Position', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'left'  => esc_html__( 'Left', 'easy-elementor-addons' ),
                    'center' => esc_html__( 'Center', 'easy-elementor-addons' ),
                    'right' => esc_html__( 'Right', 'easy-elementor-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'countdown_expire_type',
            [
                'label'       => esc_html__( 'Expire Type', 'easy-elementor-addons' ),
                'label_block' => false,
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Display message or redirect to specific link on expire.', 'easy-elementor-addons' ),
                'options'     => [
                    'none'     => esc_html__( 'None', 'easy-elementor-addons' ),
                    'text'     => esc_html__( 'Message', 'easy-elementor-addons' ),
                    'url'      => esc_html__( 'Redirection Link', 'easy-elementor-addons' ),
                ],
                'default'     => 'none',
            ]
        );

        $this->add_control(
            'countdown_expiry_text_title',
            [
                'label'     => esc_html__( 'Expiry Title', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'description' => esc_html__('On Expiry, this title will be shown in the message.', 'easy-elementor-addons'),
                'default'   => esc_html__( 'Finished Countdown!', 'easy-elementor-addons' ),
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'countdown_expiry_text',
            [
                'label'     => esc_html__( 'Expiry Content', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::WYSIWYG,
                'description' => esc_html__('On Expiry, this text will be shown in the message.', 'easy-elementor-addons'),
                'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'easy-elementor-addons' ),
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'countdown_expiry_redirection',
            [
                'label'     => esc_html__( 'Redirect URL', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => ['active' => true],
                'condition' => [
                    'countdown_expire_type' => 'url',
                ],
                'default'   => '#',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_countdown_content_settings',
            [
                'label' => esc_html__( 'Content', 'easy-elementor-addons' ),
            ]
        );

        $this->add_responsive_control(
            'eead_section_countdown_layout',
            [
                'label'   => esc_html__( 'Layout', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'  => esc_html__( 'List', 'easy-elementor-addons' ),
                    'table-cell' => esc_html__( 'Grid', 'easy-elementor-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-items>li' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_days',
            [
                'label'        => esc_html__( 'Show Days', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'eead_countdown_days_label',
            [
                'label'       => esc_html__( 'Label for Days', 'easy-elementor-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'Days', 'easy-elementor-addons' ),
                'condition'   => [
                    'eead_countdown_days' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_hours',
            [
                'label'        => esc_html__( 'Show Hours', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'eead_countdown_hours_label',
            [
                'label'       => esc_html__( 'Label for Hours', 'easy-elementor-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'Hours', 'easy-elementor-addons' ),
                'condition'   => [
                    'eead_countdown_hours' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_minutes',
            [
                'label'        => esc_html__( 'Show Minutes', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'eead_countdown_minutes_label',
            [
                'label'       => esc_html__( 'Label for Minutes', 'easy-elementor-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'Minutes', 'easy-elementor-addons' ),
                'condition'   => [
                    'eead_countdown_minutes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_seconds',
            [
                'label'        => esc_html__( 'Show Seconds', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'eead_countdown_seconds_label',
            [
                'label'       => esc_html__( 'Label for Seconds', 'easy-elementor-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default'     => esc_html__( 'Seconds', 'easy-elementor-addons' ),
                'condition'   => [
                    'eead_countdown_seconds' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_countdown_styles_general',
            [
                'label' => esc_html__( 'Countdown Styles', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_countdown_is_gradient',
            [
                'label'        => __( 'Use Gradient Background?', 'easy-elementor-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'easy-elementor-addons' ),
                'label_off'    => __( 'Hide', 'easy-elementor-addons' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'eead_countdown_background',
                'label'     => __( 'Box Background Color', 'easy-elementor-addons' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .eead-countdown-item > div',
                'condition' => [
                    'eead_countdown_is_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_background',
            [
                'label'     => esc_html__( 'Box Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'eead_countdown_is_gradient' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'eead_countdown_item_bottom_margin',
            [
                'label'     => esc_html__( 'Space Between Boxes', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-items>li' => 'margin-bottom:{{SIZE}}px;',
                ],
                'condition' => [
                    'eead_section_countdown_layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_spacing',
            [
                'label'     => esc_html__( 'Space Between Boxes', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
                    '{{WRAPPER}} .eead-countdown-container'  => 'margin-right: -{{SIZE}}px; margin-left: -{{SIZE}}px;',
                ],
                'condition' => [
                    'eead_section_countdown_layout' => 'table-cell',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_container_margin_bottom',
            [
                'label'     => esc_html__( 'Space Below Container', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-container' => 'margin-bottom:{{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .eead-countdown-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'eead_countdown_box_border',
                'label'    => esc_html__( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-countdown-item > div',
            ]
        );

        $this->add_control(
            'eead_countdown_box_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eead_countdown_box_shadow',
                'selector' => '{{WRAPPER}} .eead-countdown-item > div',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_separator_style_settings',
            [
                'label' => esc_html__( 'Separator', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_countdown_separator',
            [
                'label'        => esc_html__( 'Show Separator', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'eead-countdown-show-separator',
                'default'      => '',
            ]
        );

        $this->add_control(
            'eead_countdown_separator_style',
            [
                'label'     => __( 'Separator Style', 'easy-elementor-addons' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'dotted',
                'options'   => [
                    'solid'  => __( 'Solid', 'easy-elementor-addons' ),
                    'dotted' => __( 'Dotted', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'eead_countdown_separator' => 'eead-countdown-show-separator',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_separator_position_top',
            [
                'label'      => __( 'Position Top', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-countdown-digits::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_separator_position_left',
            [
                'label'      => __( 'Position Left', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 98,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-countdown-digits::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_separator_color',
            [
                'label'     => esc_html__( 'Separator Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'eead_countdown_separator' => 'eead-countdown-show-separator',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-digits::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'eead_countdown_separator_typography',
                'selector'  => '{{WRAPPER}} .eead-countdown-digits::after',
                'condition' => [
                    'eead_countdown_separator' => 'eead-countdown-show-separator',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_countdown_expire_style',
            [
                'label'     => esc_html__( 'Expire Message', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_expire_message_alignment',
            [
                'label'       => esc_html__( 'Text Alignment', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'     => 'left',
                'selectors'   => [
                    '{{WRAPPER}} .eead-countdown-finish-message' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_eead_countdown_expire_title',
            [
                'label'     => __( 'Title Style', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'eead_countdown_expire_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-finish-message .expiry-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'eead_countdown_expire_title_typography',
                'selector'  => '{{WRAPPER}} .eead-countdown-finish-message .expiry-title',
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_expire_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .eead-countdown-finish-message .expiry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_eead_countdown_expire_message',
            [
                'label'     => __( 'Content Style', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'eead_countdown_expire_message_color',
            [
                'label'     => esc_html__( 'Text Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-finish-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'eead_countdown_expire_message_typography',
                'selector'  => '.eead-countdown-finish-text',
                'condition' => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_countdown_expire_message_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .eead-countdown-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'countdown_expire_type' => 'text',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_days_style_settings',
            [
                'label' => esc_html__( 'Days', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'eead_countdown_days_background_color',
                'label'     => __( 'Background Color', 'easy-elementor-addons' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-days',
                'condition' => [
                    'eead_countdown_is_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_days_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-days' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'eead_countdown_is_gradient' => '',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_days_digit_color',
            [
                'label'     => esc_html__( 'Digit Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-days .eead-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_days_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-days .eead-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_days_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-days' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_hour_style_settings',
            [
                'label' => esc_html__( 'Hour', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'eead_countdown_hours_background_color',
                'label'     => __( 'Background Color', 'easy-elementor-addons' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-hours',
                'condition' => [
                    'eead_countdown_is_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_hours_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-hours' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'eead_countdown_is_gradient' => '',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_hours_digit_color',
            [
                'label'     => esc_html__( 'Digit Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-hours .eead-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_hours_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-hours .eead-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_hours_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-hours' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_minute_style_settings',
            [
                'label' => esc_html__( 'Minute', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'eead_countdown_minutes_background_color',
                'label'     => __( 'Background Color', 'easy-elementor-addons' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-minutes',
                'condition' => [
                    'eead_countdown_is_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_minutes_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-minutes' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'eead_countdown_is_gradient' => '',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_minutes_digit_color',
            [
                'label'     => esc_html__( 'Digit Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-minutes .eead-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_minutes_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-minutes .eead-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_minutes_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-minutes' => 'border-color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_section();

        $this->start_controls_section(
            'eead_seconds_style_settings',
            [
                'label' => esc_html__( 'Seconds', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'eead_countdown_seconds_background_color',
                'label'     => __( 'Background Color', 'easy-elementor-addons' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-seconds',
                'condition' => [
                    'eead_countdown_is_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_seconds_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-seconds' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'eead_countdown_is_gradient' => '',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_seconds_digit_color',
            [
                'label'     => esc_html__( 'Digit Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-seconds .eead-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_seconds_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-seconds .eead-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_countdown_seconds_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-item > div.eead-countdown-seconds' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_countdown_digits_style_settings',
            [
                'label' => esc_html__( 'Countdown Digits', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_countdown_digits_color',
            [
                'label'     => esc_html__( 'Digits Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eead_countdown_digit_typography',
                'selector' => '{{WRAPPER}} .eead-countdown-digits',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'eead_countdown_label_style_settings',
            [
                'label' => esc_html__( 'Countdown Label', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_countdown_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333',
                'selectors' => [
                    '{{WRAPPER}} .eead-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eead_countdown_label_typography',
                'selector' => '{{WRAPPER}} .eead-countdown-label',
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $get_due_date = esc_attr( $settings['eead_countdown_due_time'] );
        $due_date = date( "M d Y G:i:s", strtotime( $get_due_date ) );

        $this->add_render_attribute( 'eead-countdown', [
            'class'             =>  'eead-countdown-wrapper',
            'data-countdown-id' => esc_attr( $this->get_id() ),
            'data-expire-type'  => $settings['countdown_expire_type']
        ]);

        if ( $settings['countdown_expire_type'] == 'text' ) {
            if ( !empty( $settings['countdown_expiry_text'] ) ) {
                $this->add_render_attribute( 'eead-countdown', 'data-expiry-text', wp_kses_post( $settings['countdown_expiry_text'] ) );
            }

            if ( !empty( $settings['countdown_expiry_text_title'] ) ) {
                $this->add_render_attribute( 'eead-countdown', 'data-expiry-title', wp_kses_post( $settings['countdown_expiry_text_title'] ) );
            }
        } elseif ( $settings['countdown_expire_type'] == 'url' ) {
            $this->add_render_attribute( 'eead-countdown', 'data-redirect-url', $settings['countdown_expiry_redirection'] );
        }

        // label view
        $this->add_render_attribute( 'eead-countdown-container', [
            'class' => [
                'eead-countdown-container',
                $settings['eead_countdown_label_view'],
                (isset($settings['eead_countdown_label_view_tablet']) ? $settings['eead_countdown_label_view_tablet'] : 'eead-countdown-label-block') . '-tablet',
                (isset($settings['eead_countdown_label_view_mobile']) ? $settings['eead_countdown_label_view_mobile'] : 'eead-countdown-label-block') . '-mobile',
                $settings['eead_countdown_separator'] === 'eead-countdown-show-separator' ? 'eead-countdown-show-separator eead-countdown-separator-' . $settings['eead_countdown_separator_style'] : '',
            ],
        ] );
        ?>

        <div <?php $this->print_render_attribute_string( 'eead-countdown' ); ?>>
            <div <?php $this->print_render_attribute_string( 'eead-countdown-container' ); ?>>
                <ul id="eead-countdown-<?php echo esc_attr( $this->get_id() ); ?>" class="eead-countdown-items" data-date="<?php echo esc_attr( $due_date ); ?>">
                    <?php if ( !empty( $settings['eead_countdown_days'] ) ) { ?>
                        <li class="eead-countdown-item">
                            <div class="eead-countdown-days">
                                <span data-days class="eead-countdown-digits">00</span>
                                <?php if ( !empty( $settings['eead_countdown_days_label'] ) ) { ?>
                                    <span class="eead-countdown-label"><?php echo esc_attr( $settings['eead_countdown_days_label'] ); ?></span>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $settings['eead_countdown_hours'] ) ) { ?>
                        <li class="eead-countdown-item">
                            <div class="eead-countdown-hours">
                                <span data-hours class="eead-countdown-digits">00</span>
                                <?php if ( !empty( $settings['eead_countdown_hours_label'] ) ) { ?>
                                    <span class="eead-countdown-label"><?php echo esc_attr( $settings['eead_countdown_hours_label'] ); ?></span>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $settings['eead_countdown_minutes'] ) ) { ?>
                        <li class="eead-countdown-item">
                            <div class="eead-countdown-minutes">
                                <span data-minutes class="eead-countdown-digits">00</span>
                                <?php if ( !empty( $settings['eead_countdown_minutes_label'] ) ) { ?>
                                    <span class="eead-countdown-label"><?php echo esc_attr( $settings['eead_countdown_minutes_label'] ); ?></span>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ( !empty( $settings['eead_countdown_seconds'] ) ) { ?>
                        <li class="eead-countdown-item">
                            <div class="eead-countdown-seconds">
                                <span data-seconds class="eead-countdown-digits">00</span>
                                <?php if ( !empty( $settings['eead_countdown_seconds_label'] ) ) { ?>
                                    <span class="eead-countdown-label"><?php echo esc_attr( $settings['eead_countdown_seconds_label'] ); ?></span>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>

    <?php

    }

}
