<?php

namespace EasyElementorAddons\Modules\BusinessHour\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use DateTime;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class BusinessHour extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-business-hour';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Business Hour', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-clock';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['jclock'];
    }

    /** Controls */
    protected function register_controls() {

        /** Enable 24-hour Time format depending on global WP settings. */
        $time_24hr = false;
        $wp_time_format = get_option('time_format');
        if ((strpos($wp_time_format, 'G') !== false) OR (strpos( $wp_time_format, 'H') !== false)) {
            $time_24hr = true;
        }

        $this->start_controls_section(
                'header_content', [
            'label' => esc_html__('Header Contents', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'business_hour_style', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Static', 'easy-elementor-addons'),
                    'dynamic' => esc_html__('Dynamic', 'easy-elementor-addons'),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'dynamic_timezone', [
                'label' => esc_html__('Timezone', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => 'Website Time',
                    '-0' => __('UT or UTC - GMT -0', 'easy-elementor-addons'),
                    '+1' => __('CET - GMT+1', 'easy-elementor-addons'),
                    '+2' => __('EET - GMT+2', 'easy-elementor-addons'),
                    '+3' => __('MSK - GMT+3', 'easy-elementor-addons'),
                    '+4' => __('SMT - GMT+4', 'easy-elementor-addons'),
                    '+5' => __('PKT - GMT+5', 'easy-elementor-addons'),
                    '+5.5' => __('IND - GMT+5.5', 'easy-elementor-addons'),
                    '+6' => __('OMSK / BD - GMT+6', 'easy-elementor-addons'),
                    '+7' => __('CXT - GMT+7', 'easy-elementor-addons'),
                    '+8' => __('CST / AWST / WST - GMT+8', 'easy-elementor-addons'),
                    '+9' => __('JST - GMT+9', 'easy-elementor-addons'),
                    '+10' => __('EAST - GMT+10', 'easy-elementor-addons'),
                    '+11' => __('SAKT - GMT+11', 'easy-elementor-addons'),
                    '+12' => __('IDLE  - GMT+12', 'easy-elementor-addons'),
                    '+13' => __('NZDT  - GMT+13', 'easy-elementor-addons'),
                    '-1' => __('WAT  - GMT-1', 'easy-elementor-addons'),
                    '-2' => __('AT  - GMT-2', 'easy-elementor-addons'),
                    '-3' => __('ART  - GMT-3', 'easy-elementor-addons'),
                    '-4' => __('AST  - GMT-4', 'easy-elementor-addons'),
                    '-5' => __('EST  - GMT-5', 'easy-elementor-addons'),
                    '-6' => __('CST  - GMT-6', 'easy-elementor-addons'),
                    '-7' => __('MST  - GMT-7', 'easy-elementor-addons'),
                    '-8' => __('PST  - GMT-8', 'easy-elementor-addons'),
                    '-9' => __('AKST  - GMT-9', 'easy-elementor-addons'),
                    '-10' => __('HST  - GMT-10', 'easy-elementor-addons'),
                    '-11' => __('NT  - GMT-11', 'easy-elementor-addons'),
                    '-12' => __('IDLW  - GMT-12', 'easy-elementor-addons'),
                    'custom' => "Custom",
                ],
                'condition'     => [
                    'business_hour_style' => 'dynamic',
                ],
            ]
        );

        $this->add_control(
            'custom_timezone_input', [
                'label' => esc_html__('Custom Timezone', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '+6',
                'placeholder' => '+6',
                'condition' => [
                    'dynamic_timezone' => 'custom',
                    'business_hour_style' => 'dynamic',
                ]
            ]
        );

        $this->add_control(
            'header_content_type', [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' =>  false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'easy-elementor-addons'),
                        'icon' => 'fa fa-ban',
                    ],
                    'date'  =>   [
                        'title' => esc_html__('Todays Date', 'easy-elementor-addons'),
                        'icon' => 'fa fa-calendar-check-o',
                    ],
                    'status' => [
                        'title' => esc_html__('Open Status', 'easy-elementor-addons'),
                        'icon' => 'fa fa-info',
                    ],
                    'text' => [
                        'title' => esc_html__('Custom Message', 'easy-elementor-addons'),
                        'icon' => 'fa fa-font',
                    ],
                ],
                'default'   =>  'date',
            ]
        );

        $this->add_control(
            'header_open_msg', [
                'label' => esc_html__('Open Message', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('We are open.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('We are open.', 'easy-elementor-addons'),
                'condition' => [
                    'header_content_type' => 'status',
                ],
            ]
        );

        $this->add_control(
            'header_closed_msg', [
                'label' => esc_html__('Closed Message', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Sorry, We are currently closed.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Sorry, We are closed.', 'easy-elementor-addons'),
                'condition' => [
                    'header_content_type' => 'status',
                ],
            ]
        );       

        // Custom Message
        $this->add_control(
            'header_text', [
                'label' => esc_html__('Custom Message', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your Custom Message', 'easy-elementor-addons'),
                'condition' => [
                    'header_content_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_content_alignment', [
                'label' => __('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'center' => esc_html__('Center', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                ],
                'default' => 'left',
                'condition' => [
                    'header_content_type!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'business_hours', [
            'label' => esc_html__('Business Hours', 'easy-elementor-addons'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'start_time', [
                'label' => esc_html__('Start Time', 'easy-elementor-addons'),
                'label_block' => false,
                'type' => Controls_Manager::DATE_TIME,
                'default' =>  $this->format_time('9:00'),//'H:i'
                'picker_options' => [
                    'enableTime' => true, 
                    'noCalendar' => true, 
                    'dateFormat' => $this->time_format_to_js( $wp_time_format ), 
                    'time_24hr' => $time_24hr
                ]
            ]
        );

        $repeater->add_control(
            'end_time', [
                'label' => esc_html__('End Time', 'easy-elementor-addons'),
                'label_block' => false,
                'type' => Controls_Manager::DATE_TIME,
                'default' =>  $this->format_time('20:00'),//'H:i'
                'picker_options' => [
                    'enableTime' => true, 
                    'noCalendar' => true, 
                    'dateFormat' => $this->time_format_to_js( $wp_time_format ), 
                    'time_24hr' => $time_24hr
                ]
            ]
        );

        /** Days of week. */
        $week = [
            'sun' => esc_html__('Sunday', 'easy-elementor-addons'),
            'mon' => esc_html__('Monday', 'easy-elementor-addons'),
            'tue' => esc_html__('Tuesday', 'easy-elementor-addons'),
            'wed' => esc_html__('Wednesday', 'easy-elementor-addons'),
            'thu' => esc_html__('Thursday', 'easy-elementor-addons'),
            'fri' => esc_html__('Friday', 'easy-elementor-addons'),
            'sat' => esc_html__('Saturday', 'easy-elementor-addons'),
        ];

        /** Add array offset, to set correct first day of week. */
        $week = $this->set_start_of_week($week);

        /** Create control foreach day of week. */
        $count = 0;
        foreach ($week as $key => $day) {
            $count++;

            /** Header. */
            $this->add_control(
                "{$key}_header", [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<h4><strong>'.$day.'</strong></h4>',
                ]
            );

            /** Day Label. */
            $this->add_control(
                "{$key}day_label", [
                    'label' => esc_html__('Day Label:', 'easy-elementor-addons'),
                    'label_block' => false,
                    'type' => Controls_Manager::TEXT,
                    'default' => $day,
                ]
            );

            /** Closed. */
            $default = '';
            if ($count > 5) {
                $default = 'yes';
            }
            $this->add_control(
                "{$key}_closed", [
                    'label' => esc_html__('Closed All Day:', 'easy-elementor-addons'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => $default,
                    'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                    'label_off' => esc_html__('No', 'easy-elementor-addons'),
                    'return_value' => 'yes',
                ]
            );

            $this->add_control(
                "{$key}_closed_day_msg", [
                    'label' => esc_html__('Closed All Day Message:', 'easy-elementor-addons'),
                    'label_block' => true,
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Closed All Day', 'easy-elementor-addons'),
                    'placeholder' => esc_html__('Closed All Day', 'easy-elementor-addons'),
                    'condition' => [
                        "{$key}_closed" => 'yes'
                    ]
                ]
            );

            /** Business Hours. */
            $this->add_control(
                "{$key}_business_hours", [
                    'label' => esc_html__('Business Hours:', 'easy-elementor-addons'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'prevent_empty' => false,
                    'default' => [
                        [
                            'start_time' => $this->format_time('9:00'),//'H:i',
                            'end_time' => $this->format_time('20:00'),//'H:i'
                        ]
                    ],
                    'title_field' => '{{{start_time}}} - {{{end_time}}}',
                    'condition' => [
                        "{$key}_closed" => '',
                    ],
                ]
            );

            /** Separator. */
            $this->add_control("{$key}_separator", ['type' => Controls_Manager::DIVIDER, 'style' => 'thick']);

        } // End Foreach.

        $this->end_controls_section();

        $this->start_controls_section(
                'footer_content', [
            'label' => esc_html__('Footer Contents', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'footer_content_type', [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block'   =>  false,
                'options' => [
                    'none' => [
                        'title' => esc_html__('Nothing', 'easy-elementor-addons'),
                        'icon' => 'fa fa-ban',
                    ],
                    'date' => [
                        'title' => esc_html__('Current Date', 'easy-elementor-addons'),
                        'icon' => 'fa fa-calendar-check-o',
                    ],
                    'status' => [
                        'title' => esc_html__('Current Status', 'easy-elementor-addons'),
                        'icon' => 'fa fa-info',
                    ],
                    'text' => [
                        'title' => esc_html__('Custom Message', 'easy-elementor-addons'),
                        'icon' => 'fa fa-font',
                    ],
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'footer_open_msg', [
                'label' => esc_html__('Open Message', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('We are open.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('We are open.', 'easy-elementor-addons'),
                'condition' => [
                    'footer_content_type' => 'status',
                ],
            ]
        );

        $this->add_control(
            'footer_closed_msg', [
                'label' => esc_html__('Closed Message', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Sorry, We are currently closed.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Sorry, We are closed.', 'easy-elementor-addons'),
                'condition' => [
                    'footer_content_type' => 'status',
                ],
            ]
        );

        // Custom Message
        $this->add_control(
            'footer_text', [
                'label' => esc_html__('Custom Message', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your Custom Message', 'easy-elementor-addons'),
                'condition' => [
                    'footer_content_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_content_alignment', [
                'label' => __( 'Alignment', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'center' => esc_html__('Center', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                ],
                'default' => 'left',
                'condition' => [
                    'footer_content_type!'  => 'none',
                ],
            ]
        );

        $this->end_controls_section();

        /*  Style Tabs  */
        $this->start_controls_section(
                'header_style', [
            'label' => esc_html__('Header Section', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_control(
                'content_bg_color', [
            'label' => esc_html__('Content Background', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .eead-header-content' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
            'time_style_heading', [
                'label' => __('Time Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_content_type' => 'date'
                ]
            ]
        );

        $this->add_control(
                'time_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-header-inner .eead-current-time' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'time_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-header-inner .eead-current-time',
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );
        
        $this->add_control(
                'time_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-header-inner .eead-current-time' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
            'date_style_heading', [
                'label' => __('Date Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_content_type' => 'date'
                ]
            ]
        );

        $this->add_control(
                'date_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-header-inner .eead-current-date' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'date_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-header-inner .eead-current-date',
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
                'date_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-header-inner .eead-current-date' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'header_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
            'status_style_heading', [
                'label' => __('Status Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_content_type' => 'status'
                ]
            ]
        );

        $this->add_control(
                'status_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-open-status,
                {{WRAPPER}} .eead-close-status' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'header_content_type' => 'status'
            ]
                ]
        );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'status_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-open-status, {{WRAPPER}} .eead-close-status',
            'condition' => [
                'header_content_type' => 'status'
            ]
                ]
        );
        
        $this->add_control(
                'status_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-open-status,
                {{WRAPPER}} .eead-close-status' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'header_content_type' => 'status'
            ]
                ]
        );

        $this->add_control(
            'custom_msg_style_heading', [
                'label' => __('Custom Message Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'header_content_type' => 'text'
                ]
            ]
        );

        $this->add_control(
                'custom_msg_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-custom-text' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'header_content_type' => 'text'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'custom_msg_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-custom-text',
            'condition' => [
                'header_content_type' => 'text'
            ]
                ]
        );
        
        $this->add_control(
                'custom_msg_margin', [
            'label' => esc_html__('Custom Message Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-custom-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'header_content_type' => 'text'
            ]
                ]
        );

        $this->end_controls_section();

        //Footer Styles
        $this->start_controls_section(
                'footer_style', [
            'label' => esc_html__('Footer Section', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_control(
                'footer_content_bg_color', [
            'label' => esc_html__('Content Background', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .eead-footer-content' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
            'footer_time_style_heading', [
                'label' => __('Time Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'footer_content_type' => 'date'
                ]
            ]
        );

        $this->add_control(
                'footer_time_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-current-time' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'footer_time_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-footer-inner .eead-current-time',
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );
        
        $this->add_control(
                'footer_time_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-current-time' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
            'footer_date_style_heading', [
                'label' => __('Date Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'footer_content_type' => 'date'
                ]
            ]
        );

        $this->add_control(
                'footer_date_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-current-date' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'footer_date_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-footer-inner .eead-current-date',
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
                'footer_date_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-current-date' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'footer_content_type' => 'date'
            ]
                ]
        );

        $this->add_control(
            'footer_status_style_heading', [
                'label' => __('Status Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'footer_content_type' => 'status'
                ]
            ]
        );

        $this->add_control(
                'footer_status_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-open-status,
                {{WRAPPER}} .eead-footer-inner .eead-close-status' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'footer_content_type' => 'status'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'footer_status_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-footer-inner .eead-open-status, {{WRAPPER}} .eead-footer-inner .eead-close-status',
            'condition' => [
                'footer_content_type' => 'status'
            ]
                ]
        );
        
        $this->add_control(
                'footer_status_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-open-status,
                {{WRAPPER}} .eead-footer-inner .eead-close-status' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'footer_content_type' => 'status'
            ]
                ]
        );

        $this->add_control(
            'footer_custom_msg_style_heading', [
                'label' => __('Custom Message Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'footer_content_type' => 'text'
                ]
            ]
        );

        $this->add_control(
                'footer_custom_msg_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-custom-text' => 'color: {{VALUE}}',
            ],
            'condition' => [
                'footer_content_type' => 'text'
            ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'footer_custom_msg_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-footer-inner .eead-custom-text',
            'condition' => [
                'footer_content_type' => 'text'
            ]
                ]
        );
        
        $this->add_control(
                'footer_custom_msg_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-footer-inner .eead-custom-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [
                'footer_content_type' => 'text'
            ]
                ]
        );

        $this->end_controls_section();

        //Business Hour Styles
        $this->start_controls_section(
                'work_hour_style', [
            'label' => esc_html__('Business Hours', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_responsive_control(
            'business_hours_day_align', [
                'label' => esc_html__('Day Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-row .eead-business-day,
                     {{WRAPPER}} .eead-business-hour-row .eead-business-time' => 'flex-basis: 50%;',
                     '{{WRAPPER}} .eead-business-hour-row .eead-business-day' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'business_hours_time_align', [
                'label' => esc_html__('Time Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
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
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-row .eead-business-day,
                     {{WRAPPER}} .eead-business-hour-row .eead-business-time' => 'flex-basis: 50%;',
                     '{{WRAPPER}} .eead-business-hour-row .eead-business-time' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
                'current_day_bg_color', [
            'label' => esc_html__('Current Day Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#ccc',
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-row.active-day' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'work_day_bg_color', [
            'label' => esc_html__('Work Days Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-row' => 'background-color: {{VALUE}}',
            ],
                ]
        );
        
        //Day Style
        $this->add_control(
            'day_style_heading', [
                'label' => __('Day Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
                'day_text_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-details .eead-business-day' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'day_text_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-business-hour-details .eead-business-day',
                ]
        );
        
        $this->add_control(
                'day_text_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-details .eead-business-day' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        //Business Day Time Style
        $this->add_control(
            'business_time_style_heading', [
                'label' => __('Business Time Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
                'business_time_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-details .eead-business-time' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'business_time_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-business-hour-details .eead-business-time',
                ]
        );
        
        $this->add_control(
                'business_time_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-details .eead-business-time' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'closed_all_day_color', [
            'label' => esc_html__('Closed All Day Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'separator' => 'before',
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-business-hour-details .eead-business-time .eead-closed-all-day' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'divider_style', [
                'label' => esc_html__('Divider', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'day_divider', [
                'label' => esc_html__('Divider', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'day_divider_style', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => esc_html__('Solid', 'easy-elementor-addons'),
                    'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
                    'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-details .eead-business-hour-row:not(:first-child)' => 'border-top-style: {{VALUE}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'day_divider_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-details .eead-business-hour-row:not(:first-child)' => 'border-top-color: {{VALUE}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'day_divider_weight', [
                'label' => esc_html__('Weight', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-details .eead-business-hour-row:not(:first-child)' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'stripped_style', [
                'label' => esc_html__('Striped Rows', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'business_hours_striped', [
                'label' => esc_html__('Enable Striped', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'business_hours_striped_odd_color', [
                'label' => esc_html__('Striped Odd Rows Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-details .eead-business-hour-row:nth-child(odd)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'business_hours_striped' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'striped_effect_even', [
                'label' => esc_html__('Striped Even Rows Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-business-hour-details .eead-business-hour-row:nth-child(even)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'business_hours_striped' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function set_time_zone(){
        $settingsTimeZone = $this->get_settings_for_display();
        if ( $settingsTimeZone['business_hour_style'] != 'default' ) { //static & dynamic checking
            if ( $settingsTimeZone['dynamic_timezone'] != 'default' ) { // timezone default checking
                // $ct_input = $settingsTimeZone['custom_timezone_input']; // ct = custom timezone
                // dynamic_timezone
                if ( $settingsTimeZone['dynamic_timezone'] == 'custom' ) { 
                    $ct_input = $settingsTimeZone['custom_timezone_input'] ? $settingsTimeZone['custom_timezone_input'] : '+6';
                } else {
                    $ct_input = $settingsTimeZone['dynamic_timezone'];
                }

                return $this->set_gmt_zone( $ct_input );
            } else {
                return $this->set_gmt_zone( get_option('gmt_offset') );
            }
        }
    }

    public function set_gmt_zone($reseive){

        $min = 60 * $reseive;
        $sign = $min < 0 ? "-" : "+";
        $absmin = abs($min);

        $tz = sprintf("%s%02d", $sign, $absmin/60, $absmin%60);
        $data = gmdate("g:i:s A", time() + 3600*($tz+date("I")));
        return $data;
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $start_of_week = get_option('start_of_week');

        $timeNotation = (get_option('time_format') == 'H:i') ? '24h' : '12h';
        $ct_input = get_option('gmt_offset');

        if ($settings['dynamic_timezone'] == 'custom') {
            $ct_input = (isset($settings['custom_timezone_input']) && !empty($settings['custom_timezone_input'])) ? $settings['custom_timezone_input'] : '+6';
        } else {
            $ct_input = $settings['dynamic_timezone'];
        }

        $this->add_render_attribute([
            'business-hours-data' => [ 
                'data-settings' => [
                    wp_json_encode(array_filter([
                        "id" => 'business-hours-' . $this->get_id(),
                        'business_hour_style' => $settings['business_hour_style'] == 'default' ? 'static' : 'dynamic',
                        "dynamic_timezone_default" =>  get_option('gmt_offset'),
                        "dynamic_timezone" => $settings['dynamic_timezone'] == 'default' ? get_option('gmt_offset') : $ct_input,
                        "timeNotation" => $timeNotation,
                    ])
                ),
                ],
            ],
        ]);
        ?>
        <div class="eead-business-hour-section" <?php $this->print_render_attribute_string('business-hours-data'); ?>>

            <?php if ($settings['header_content_type'] != 'none') { ?>
                <div class="eead-header-content align-<?php echo esc_attr($settings['header_content_alignment']); ?>">
                    <div class="eead-header-inner">
                    <?php
                    if ($settings['header_content_type'] == 'date') {
                        ?>
                        <div class="eead-current-time">
                            <?php
                            if($settings['business_hour_style'] == 'default'){
                                echo date(get_option('time_format'), current_time('timestamp'));
                            }else{
                                $cur_time = strtotime($this->set_time_zone());
                                echo date('h:i a', $cur_time);
                            }
                            ?>
                        </div>

                        <div class="eead-current-date">
                            <?php
                            if ($settings['business_hour_style'] == 'default'){
                                echo date(get_option('date_format'), current_time('timestamp'));
                            } else {
                                $cur_time = strtotime($this->set_time_zone());
                                echo date(get_option('date_format'), $cur_time);
                            }
                            ?>
                        </div>
                        <?php
                    } else if ($settings['header_content_type'] == 'status') {
                        ?>
                        <div class="eead-open-status">
                            <?php
                            if ($this->is_open($settings)) { 
                                echo wp_kses_post($settings['header_open_msg']); 
                            } else { 
                                echo wp_kses_post($settings['header_closed_msg']); 
                            }
                            ?>
                        </div>
                        <?php
                    } else if($settings['header_content_type'] == 'text') {
                        ?>
                        <div class="eead-custom-text">
                            <?php echo do_shortcode($settings['header_text']); ?>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            <?php } ?>

            <div class="eead-business-hour-details">
                <?php $week = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat']; 
                $week = $this->set_start_of_week($week);
                $active_day = strtolower(current_time('D')); // sun
                foreach ($week as $day) {
                    ?>
                    <div class="eead-business-hour-row<?php echo ($day == $active_day) ? ' active-day' : ''; ?>">
                        <div class="eead-business-day">
                            <?php echo wp_kses_post($settings["{$day}day_label"]); ?>
                        </div>
                        <div class="eead-business-time">
                            <?php
                            if ($settings["{$day}_closed"] === 'yes') {
                                ?>
                                <div class="eead-closed-all-day">
                                    <?php echo wp_kses_post($settings["{$day}_closed_day_msg"]); ?>
                                </div>
                                <?php
                            } else {
                                foreach ($settings["{$day}_business_hours"] as $hours) { ?>
                                    <?php echo esc_html($hours['start_time']); ?> - <?php echo esc_html($hours['end_time']); ?>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if ($settings['footer_content_type'] != 'none') { ?>
                <div class="eead-footer-content align-<?php echo esc_attr($settings['footer_content_alignment']); ?>">
                    <div class="eead-footer-inner">
                    <?php
                    if ($settings['footer_content_type'] == 'date') {
                        ?>
                        <div class="eead-current-time">
                            <?php
                            if ($settings['business_hour_style'] == 'default') {
                                echo date(get_option('time_format'), current_time('timestamp'));
                            } else {
                                $cur_time = strtotime($this->set_time_zone());
                                echo date('h:i a', $cur_time);
                            }
                            ?>
                        </div>

                        <div class="eead-current-date">
                            <?php
                            if ($settings['business_hour_style'] == 'default') {
                                echo date(get_option('date_format'), current_time('timestamp'));
                            } else {
                                $cur_time = strtotime($this->set_time_zone());
                                echo date(get_option('date_format'), $cur_time);
                            }
                            ?>
                        </div>
                        <?php
                    } else if ($settings[ 'footer_content_type' ] == 'status') {
                        ?>
                        <div class="eead-open-status">
                            <?php
                            if ($this->is_open($settings)) { 
                                echo wp_kses_post($settings['footer_open_msg']); 
                            } else { 
                                echo wp_kses_post($settings['footer_closed_msg']); 
                            }
                            ?>
                        </div>
                        <?php
                    } else if($settings['footer_content_type'] == 'text') {
                        ?>
                        <div class="eead-custom-text">
                            <?php echo do_shortcode($settings['footer_text']); ?>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?php
    }

    private function is_open( $settings ) {

        /** Get current day prefix. */
        $day = strtolower(current_time('D')); // mon

        /** Check closing day */
        if ($settings["{$day}_closed"] === 'yes') {
            return false;
        }

        /** Check, opened or not? */
        foreach ($settings["{$day}_business_hours"] as $hours) {

            $wp_time_format = get_option('time_format');
            $current_time = current_time($wp_time_format);

            $start_time = $hours['start_time'];
            $end_time = $hours['end_time'];

            /** Convert to same format. */
            $date1 = DateTime::createFromFormat( $wp_time_format, $current_time );
            $date2 = DateTime::createFromFormat( $wp_time_format, $start_time );
            $date3 = DateTime::createFromFormat( $wp_time_format, $end_time );

            /** If the current time between start_time and end_time - we are opened now. */
            if ($date1 > $date2 && $date1 < $date3) {
                return true;
            }
        }

        /** Closed by default. */
        return false;
    }

    private function format_time($time) {

        $wp_time_format = get_option('time_format');

        $time_obj = \DateTime::createFromFormat('H:i', $time);

        if (!$time_obj) {
            return $time;
        }

        return $time_obj->format($wp_time_format);

    }

    private function time_format_to_js( $time_format ) {
        $js_format = $time_format;

        // AM/PM
        $js_format = str_replace('a', 'K', $js_format);
        $js_format = str_replace('A', 'K', $js_format);
        $js_format = str_replace('g', 'G', $js_format);

        return $js_format;
    }

    private function set_start_of_week($week) {

        /** WordPress Start day of the week. */
        $start_of_week = get_option('start_of_week');

        /** Add offset to array. */
        for($i = 0; $i < $start_of_week; $i++) {
            $this->array_shift($week);
        }

        return $week;
    }

    private function array_shift(&$arr) {
        $keys = array_keys($arr);
        $val = $arr[$keys[0]];
        unset($arr[$keys[0]]);
        $arr[$keys[0]] = $val;
    }
}