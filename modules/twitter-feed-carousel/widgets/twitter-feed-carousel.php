<?php

namespace EasyElementorAddons\Modules\TwitterFeedCarousel\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TwitterFeedCarousel extends Widget_Base {

   
    public function get_name() {
        return 'eead-twitter-feed-carousel';
    }

    
    public function get_title() {
        return esc_html__('Twitter Feed Carousel', 'easy-elementor-addons');
    }

    
    public function get_icon() {
        return 'eead-element-icon eead-twitter1';
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
            'eead_section_twitter_feed_carousel_acc_settings', [
                'label' => esc_html__('Account Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_twitter_feed_ac_name', [
                'label' => esc_html__('Username', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '@hash_themes',
                'label_block' => true,
                'description' => esc_html__('Enter @ sign before your username.', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_twitter_feed_hashtag_name', [
                'label' => esc_html__('Hashtag Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => esc_html__('Remove # sign from your hashtag name.', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_twitter_feed_consumer_key', [
                'label' => esc_html__('Consumer Key', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'wwC72W809xRKd9ySwUzXzjkmS',
                'description' => 'Click <a href="https://apps.twitter.com/app/" target="_blank">here</a> to create or get your <b>consumer key.</b>'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_consumer_secret', [
                'label' => esc_html__('Consumer Secret', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'rn54hBqxjve2CWOtZqwJigT3F5OEvrriK2XAcqoQVohzr2UA8h',
                'description' => 'Click <a href="https://apps.twitter.com/app/" target="_blank">here</a> to create or get your <b>consumer secret.</b>'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_data_cache_limit', [
                'label' => esc_html__('Data Cache Time', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 60,
                'description' => esc_html__('Cache expiration time (Minutes)', 'easy-elementor-addons')
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_twitter_feed_carousel_layout_settings', [
                'label' => esc_html__('Layout Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_twitter_feed_content_length', [
                'label' => esc_html__('Content Length', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => false,
                'min' => 1,
                'max' => 400,
                'default' => 400
            ]
        );

        $this->add_control(
            'eead_twitter_feed_post_limit', [
                'label' => esc_html__('Post Limit', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => false,
                'default' => 10
            ]
        );

        $this->add_control(
            'eead_twitter_feed_media', [
                'label' => esc_html__('Show Media Elements', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('no', 'easy-elementor-addons'),
                'default' => 'true',
                'return_value' => 'true'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_twitter_feed_carousel_card_settings', [
                'label' => esc_html__('Card Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_twitter_feed_show_avatar', [
                'label' => esc_html__('Show Avatar', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('no', 'easy-elementor-addons'),
                'default' => 'true',
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_avatar_style', [
                'label' => esc_html__('Avatar Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => 'Circle',
                    'square' => 'Square',
                ],
                'default' => 'circle',
                'condition' => [
                    'eead_twitter_feed_show_avatar' => 'true',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_show_date', [
                'label' => esc_html__('Show Date', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('no', 'easy-elementor-addons'),
                'default' => 'true',
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_show_read_more', [
                'label' => esc_html__('Show Read More', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('no', 'easy-elementor-addons'),
                'default' => 'true',
                'return_value' => 'true'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_settings', [
                'label' => esc_html__('Carousel Settings', 'easy-elementor-addons')
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
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
            'autoplay', [
                'label' => esc_html__('Autoplay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
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
                'default' => 'no'
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
                'type' => Controls_Manager::SWITCHER
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 0,
                    'unit' => 'px',
                ]
            ]
        );

        $this->add_control(
            'center_image_bigger', [
                'label' => esc_html__('Center Image Bigger', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layout' => 'style3']
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Twitter Feed Card Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'eead_section_twitter_feed_carousel_card_style_settings', [
                'label' => esc_html__('Card Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_twitter_feed_card_container_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-twitter-feed-item-content' => 'padding: 0 {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'eead_twitter_feed_card_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item-inner'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner, {{WRAPPER}} .swiper-slide' => 'border-radius: {{SIZE}}px;',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'eead_twitter_feed_card_shadow',
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item-inner'
            ]
        );

        $this->end_controls_section();

        /**
         * Card Hover Style
         */
        $this->start_controls_section(
            'eead_section_twitter_feed_card_hover_settings', [
                'label' => esc_html__('Card Hover Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_hover_title_color', [
                'label' => esc_html__('Title Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner:hover .eead-twitter-feed-item-author' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_hover_content_color', [
                'label' => esc_html__('Content Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner:hover .eead-twitter-feed-item-content p' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_hover_link_color', [
                'label' => esc_html__('Link Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner:hover .eead-twitter-feed-item-content a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_hover_date_color', [
                'label' => esc_html__('Date Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner:hover .eead-twitter-feed-item-header .eead-twitter-feed-item-date' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_card_border_hover_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item-inner:hover' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'eead_twitter_feed_card_hover_bg',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item-inner:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'eead_twitter_feed_card_hover_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item-inner:hover'
            ]
        );

        $this->end_controls_section();

        /**
         * Tab Style (Twitter Feed Typography Style)
         */
        $this->start_controls_section(
            'eead_section_twitter_feed_carousel_card_typo_settings', [
                'label' => esc_html__('Color &amp; Typography', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'eead_twitter_feed_title_heading', [
                'label' => esc_html__('Title Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'eead_twitter_feed_title_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-author' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_twitter_feed_title_typography',
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-author'
            ]
        );

        // Content Style
        $this->add_control(
            'eead_twitter_feed_content_heading', [
                'label' => esc_html__('Content Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_content_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-content p' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_twitter_feed_content_typography',
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-content p'
            ]
        );

        // Content Link Style
        $this->add_control(
            'eead_twitter_feed_content_link_heading', [
                'label' => esc_html__('Link Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'eead_twitter_feed_content_link_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-content a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_content_link_hover_color', [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-content a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_twitter_feed_content_link_typography',
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-content a'
            ]
        );

        $this->end_controls_section();

        /**
         * Avatar Style
         */
        $this->start_controls_section(
            'eead_section_twitter_feed_avatar_style', [
                'label' => esc_html__('Avatar', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eead_twitter_feed_show_avatar' => 'true',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_avatar_width', [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 38,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-avatar img' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'eead_twitter_feed_avatar_height', [
                'label' => esc_html__('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-avatar img' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'eead_twitter_feed_avatar_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-avatar img'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'eead_twitter_feed_avatar_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-twitter-feed-item .eead-twitter-feed-item-avatar img'
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot span' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'dots_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'dots_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot span' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_normal', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot span' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_active', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'dot_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-dots .owl-dot:hover span' => 'border-color: {{VALUE}}',
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

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'arrow_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button'
            ]
        );

        $this->add_control(
            'arrow_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;display: flex; align-items: center; justify-content: center;',
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'arrow_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-twitter-feed-carousel .owl-nav button:hover' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $params = array(
            'items' => (int) $settings['slides_to_show']['size'],
            'items_tablet' => (int) isset($settings['slides_to_show_tablet']['size']) ? $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => (int) isset($settings['slides_to_show_mobile']['size']) ? $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) isset($settings['slides_margin_tablet']['size']) ? $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => (int) isset($settings['slides_margin_mobile']['size']) ? $settings['slides_margin_mobile']['size'] : 20,
            'autoplay' => $settings['autoplay'] && $settings['autoplay'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] && $settings['infinite'] == 'yes' ? true : false,
            'pause' => isset($settings['autoplay_speed']['size']) ? (int) $settings['autoplay_speed']['size'] * 1000 : 500,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false,
            'arrows' => $settings['arrows'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'auto_height' => $settings['auto_height'] == 'yes' ? true : false,
            'stagepadding' => (int) $settings['slides_stagepadding']['size'],
            'stagepadding_tablet' => (int) isset($settings['slides_stagepadding_tablet']['size']) ? $settings['slides_stagepadding_tablet']['size'] : 0,
            'stagepadding_mobile' => (int) isset($settings['slides_stagepadding_mobile']['size']) ? $settings['slides_stagepadding_mobile']['size'] : 0,
            'center_image_bigger' => $settings['center_image_bigger'] == 'yes' ? true : false,
        );
        $params = json_encode($params);

        $items = $this->get_twitter_feed_render_items($this->get_id(), $settings);

        if (empty($items['errors'])) {
            ?>
            <div class="eead-twitter-feed eead-twitter-feed-carousel swiper-container eead-twitter-feed-<?php echo $this->get_id() ?>" <?php //echo $this->get_render_attribute_string('eead-twitter-feed-carousel-wrap');   ?>>
                <div class="swiper-wrapper eead-twitter-feed-carousel-slides owl-carousel" data-params='<?php echo $params; ?>'>
                    <?php $this->twitter_feed_render_items($items, $settings, 'swiper-slide'); ?>
                </div>
            </div>
            <?php
        } else if ($this->elementor()->editor->is_edit_mode()) {
            foreach ($items['errors'] as $error) {
                ?>
                    <p><?php echo esc_html($error['message']); ?></p>
                <?php
            }
        }
    }

    protected function elementor() {
        return Plugin::$instance;
    }

    public function get_twitter_feed_render_items($id, $settings) {
        $token = get_option($id . '_' . $settings['eead_twitter_feed_ac_name'] . '_tf_token');
        $items = get_transient($id . '_' . $settings['eead_twitter_feed_ac_name'] . '_tf_cache');
        $html = '';

        if (empty($settings['eead_twitter_feed_consumer_key']) || empty($settings['eead_twitter_feed_consumer_secret'])) {
            return;
        }

        if ($items === false) {
            if (empty($token)) {
                $credentials = base64_encode($settings['eead_twitter_feed_consumer_key'] . ':' . $settings['eead_twitter_feed_consumer_secret']);

                add_filter('https_ssl_verify', '__return_false');

                $response = wp_remote_post('https://api.twitter.com/oauth2/token', [
                    'method' => 'POST',
                    'httpversion' => '1.1',
                    'blocking' => true,
                    'headers' => [
                        'Authorization' => 'Basic ' . $credentials,
                        'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
                    ],
                    'body' => ['grant_type' => 'client_credentials'],
                ]);

                $body = json_decode(wp_remote_retrieve_body($response));

                if ($body) {
                    update_option($id . '_' . $settings['eead_twitter_feed_ac_name'] . '_tf_token', $body->access_token);
                    $token = $body->access_token;
                }
            }

            $args = array(
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => "Bearer $token",
                ),
            );

            add_filter('https_ssl_verify', '__return_false');

            $response = wp_remote_get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $settings['eead_twitter_feed_ac_name'] . '&count=999&tweet_mode=extended', [
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => [
                    'Authorization' => "Bearer $token",
                ]
            ]);

            if (!is_wp_error($response)) {
                $items = json_decode(wp_remote_retrieve_body($response), true);
                set_transient($id . '_' . $settings['eead_twitter_feed_ac_name'] . '_tf_cache', $items, 1800);
            }
        }

        if (empty($items)) {
            return;
        }

        if ($settings['eead_twitter_feed_hashtag_name']) {
            foreach ($items as $key => $item) {
                $match = false;

                if ($item['entities']['hashtags']) {
                    foreach ($item['entities']['hashtags'] as $tag) {
                        if (strcasecmp($tag['text'], $settings['eead_twitter_feed_hashtag_name']) == 0) {
                            $match = true;
                        }
                    }
                }

                if ($match == false) {
                    unset($items[$key]);
                }
            }
        }

        return array_splice($items, 0, $settings['eead_twitter_feed_post_limit']);
    }

    public function twitter_feed_render_items($items, $settings, $class = '') {

        foreach ($items as $item) {
            $delimeter = (isset($item['full_text']) && strlen($item['full_text']) > $settings['eead_twitter_feed_content_length']) ? '...' : '';
            ?>
            <div class="eead-twitter-feed-item <?php echo $class; ?>">
                <div class="eead-twitter-feed-item-inner">
                    <div class="eead-twitter-feed-item-header">

                        <?php if ($settings['eead_twitter_feed_show_avatar'] == 'true') { ?>
                            <a class="eead-twitter-feed-item-avatar avatar-<?php echo $settings['eead_twitter_feed_avatar_style']; ?>" href="//twitter.com/<?php echo $settings['eead_twitter_feed_ac_name']; ?>" target="_blank">
                                <img src="<?php echo esc_url($item['user']['profile_image_url_https']); ?>">
                            </a>
                        <?php } ?>

                        <a class="eead-twitter-feed-item-meta" href="//twitter.com/<?php echo $settings['eead_twitter_feed_ac_name']; ?>" target="_blank">
                            <span class="eead-twitter-feed-item-author"><?php echo $item['user']['name']; ?></span>
                        </a>

                        <?php if ($settings['eead_twitter_feed_show_date'] == 'true') { ?>
                            <span class="eead-twitter-feed-item-date">
                                <?php printf(__('%s ago', 'easy-elementor-addons'), human_time_diff(strtotime($item['created_at']))); ?>
                            </span>
                        <?php } ?>
                    </div>

                    <div class="eead-twitter-feed-item-content">
                        <?php
                        $link_free_text = isset($item['entities']['urls'][0]['url']) ? str_replace($item['entities']['urls'][0]['url'], '', $item['full_text']) : $item['full_text'];
                        echo '<p>' . substr($link_free_text, 0, $settings['eead_twitter_feed_content_length']) . $delimeter . '</p>';
                        ?>

                        <?php if ($settings['eead_twitter_feed_show_read_more'] == 'true') { ?>
                            <a href="//twitter.com/<?php echo $item['user']['screen_name']; ?>/status/<?php echo $item['id_str']; ?>" target="_blank" class="read-more-link">
                                <?php esc_html_e('Read More', 'easy-elementor-addons'); ?>
                            </a>
                        <?php } ?>
                    </div>

                    <?php
                    if (isset($item['extended_entities']['media'][0]) && $settings['eead_twitter_feed_media'] == 'true') {
                        if ($item['extended_entities']['media'][0]['type'] == 'photo') {
                            ?>
                            <img src="<?php echo esc_url($item['extended_entities']['media'][0]['media_url_https']); ?>">
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }

}
