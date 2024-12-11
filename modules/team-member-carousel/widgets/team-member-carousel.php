<?php

namespace EasyElementorAddons\Modules\TeamMemberCarousel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TeamMemberCarousel extends Widget_Base {

    public function get_name() {
        return 'eead-team-member-carousel';
    }

    public function get_title() {
        return esc_html__('Team Carousel', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-icons-team-carousel';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_team_member', [
                'label' => esc_html__('Team Members', 'easy-elementor-addons')
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('team_member_tabs');

        $repeater->start_controls_tab(
            'tab_content', [
                'label' => esc_html__('Content', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'team_member_name', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => esc_html__('John Doe', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'team_member_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => esc_html__('WordPress Developer', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'team_member_description', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => esc_html__('Enter member description here which describes the position of member in company', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'team_member_image', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                )
            ]
        );

        $repeater->add_control(
            'link_type', [
                'label' => esc_html__('Link Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => array(
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'image' => esc_html__('Image', 'easy-elementor-addons'),
                    'title' => esc_html__('Title', 'easy-elementor-addons'),
                )
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ),
                ),
                'placeholder' => 'https://www.your-link.com',
                'default' => array(
                    'url' => '#',
                ),
                'condition' => array(
                    'link_type!' => 'none',
                )
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_social_links', [
                'label' => esc_html__('Social Links', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'facebook_url', [
                'name' => 'facebook_url',
                'label' => esc_html__('Facebook', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Facebook page or profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'twitter_url', [
                'name' => 'twitter_url',
                'label' => esc_html__('Twitter', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Twitter profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'instagram_url', [
                'label' => esc_html__('Instagram', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Instagram profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'linkedin_url', [
                'label' => esc_html__('Linkedin', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Linkedin profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'youtube_url', [
                'label' => esc_html__('YouTube', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter YouTube profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'pinterest_url', [
                'label' => esc_html__('Pinterest', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Pinterest profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'dribbble_url', [
                'label' => esc_html__('Dribbble', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter Dribbble profile URL of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'email', [
                'label' => esc_html__('Email', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter email ID of team member', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'phone', [
                'label' => esc_html__('Contact Number', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                    ),
                ),
                'description' => esc_html__('Enter contact number of team member', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'team_member_details', [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => array(
                    array(
                        'team_member_name' => 'Team Member #1',
                        'team_member_position' => 'Business Analyst',
                        'facebook_url' => '#',
                        'twitter_url' => '#',
                        'instagram_url' => '#',
                    ),
                    array(
                        'team_member_name' => 'Team Member #2',
                        'team_member_position' => 'Manager',
                        'facebook_url' => '#',
                        'twitter_url' => '#',
                        'instagram_url' => '#',
                    ),
                    array(
                        'team_member_name' => 'Team Member #3',
                        'team_member_position' => 'Engineer',
                        'facebook_url' => '#',
                        'twitter_url' => '#',
                        'instagram_url' => '#',
                    ),
                ),
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ team_member_name }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_box_settings', [
                'label' => esc_html__('General Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons')
                ]
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
            'member_social_links', [
                'label' => esc_html__('Show Social Icons', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_settings', [
                'label' => esc_html__('Carousel Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_responsive_control(
            'items', [
                'label' => esc_html__('Visible Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 3),
                'tablet_default' => array('size' => 2),
                'mobile_default' => array('size' => 1),
                'range' => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ),
                ),
                'size_units' => ''
            ]
        );

        $this->add_responsive_control(
            'margin', [
                'label' => esc_html__('Items Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 10),
                'tablet_default' => array('size' => 10),
                'mobile_default' => array('size' => 10),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                ),
                'size_units' => ''
            ]
        );

        $this->add_control(
            'slider_speed', [
                'label' => esc_html__('Slider Speed', 'easy-elementor-addons'),
                'description' => esc_html__('Duration of transition between slides (in ms)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 600),
                'range' => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 3000,
                        'step' => 1,
                    ),
                ),
                'size_units' => '',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay', [
                'label' => esc_html__('Autoplay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'pause_on_interaction', [
                'label' => esc_html__('Pause on Interaction', 'easy-elementor-addons'),
                'description' => esc_html__('Disables autoplay completely on first interaction with the carousel.', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => array(
                    'autoplay' => 'yes',
                )
            ]
        );

        $this->add_control(
            'autoplay_speed', [
                'label' => esc_html__('Autoplay Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 3000),
                'range' => array(
                    'px' => array(
                        'min' => 500,
                        'max' => 5000,
                        'step' => 1,
                    ),
                ),
                'size_units' => '',
                'condition' => array(
                    'autoplay' => 'yes',
                )
            ]
        );

        $this->add_control(
            'infinite_loop', [
                'label' => esc_html__('Infinite Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'grab_cursor', [
                'label' => esc_html__('Grab Cursor', 'easy-elementor-addons'),
                'description' => esc_html__('Shows grab cursor when you hover over the slider', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'easy-elementor-addons'),
                'label_off' => esc_html__('Hide', 'easy-elementor-addons'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'name_navigation_heading', [
                'label' => esc_html__('Navigation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'arrows', [
                'label' => esc_html__('Arrows', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'dots', [
                'label' => esc_html__('Pagination', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'pagination_type', [
                'label' => esc_html__('Pagination Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bullets',
                'options' => array(
                    'bullets' => esc_html__('Dots', 'easy-elementor-addons'),
                    'fraction' => esc_html__('Fraction', 'easy-elementor-addons'),
                ),
                'condition' => array(
                    'dots' => 'yes',
                )
            ]
        );

        $this->end_controls_section();

        /* Style Controls */
        $this->start_controls_section(
            'section_member_content_style', [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'member_box_alignment', [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member' => 'text-align: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'member_box_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-content-normal' => 'background-color: {{VALUE}};',
                ),
                'condition' => ['layout' => 'style1']
            ]
        );

        $this->add_control(
            'member_image_box_overlay_color', [
                'label' => esc_html__('Overlay Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-content-normal' => 'background-color: {{VALUE}};',
                ),
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->add_responsive_control(
            'member_box_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-content-normal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_image_style', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'member_image_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-image img, 
					 {{WRAPPER}} .eead-team-member-overlay-content-wrap:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            ]
        );

        $this->add_control(
            'member_image_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_name_style', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_name_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-name'
            ]
        );

        $this->add_control(
            'member_name_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-name' => 'color: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'member_name_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-name' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_position_style', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_position_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-position'
            ]
        );

        $this->add_control(
            'member_position_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-position' => 'color: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'member_position_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-position' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_description_style', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-description'
            ]
        );

        $this->add_control(
            'member_description_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-description' => 'color: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'member_description_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_social_links_style', [
                'label' => esc_html__('Social Icons', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'member_icons_gap', [
                'label' => esc_html__('Icons Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => 10),
                'size_units' => array('%', 'px'),
                'range' => array(
                    'px' => array(
                        'max' => 60,
                    ),
                ),
                'tablet_default' => array(
                    'unit' => 'px',
                ),
                'mobile_default' => array(
                    'unit' => 'px',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->add_responsive_control(
            'member_icon_size', [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'max' => 30,
                    ),
                ),
                'default' => array(
                    'size' => '14',
                    'unit' => 'px',
                ),
                'tablet_default' => array(
                    'unit' => 'px',
                ),
                'mobile_default' => array(
                    'unit' => 'px',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->start_controls_tabs('tabs_links_style');

        $this->start_controls_tab(
            'tab_links_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'member_links_icons_color', [
                'label' => esc_html__('Icons Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'member_links_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member.style1 .eead-team-member-image .eead-team-member-social-links-wrap a,
					 {{WRAPPER}} .eead-team-member.style2 .eead-team-member-social-links .eead-team-member-social-icon-wrap' => 'background-color: {{VALUE}};',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'member_links_border',
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
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap'
            ]
        );

        $this->add_control(
            'member_links_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            ]
        );

        $this->add_responsive_control(
            'member_links_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'separator' => 'before',
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_links_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'member_links_icons_color_hover', [
                'label' => esc_html__('Icons Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap:hover .eead-team-member-social-icon' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'member_links_bg_color_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member.style1 .eead-team-member-image .eead-team-member-social-links-wrap a:hover,
					 {{WRAPPER}} .eead-team-member.style2 .eead-team-member-social-links .eead-team-member-social-icon-wrap:hover' => 'background-color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'member_links_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap:hover' => 'border-color: {{VALUE}};',
                )
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arrows_style', [
                'label' => esc_html__('Arrows', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'arrows' => 'yes',
                )
            ]
        );

        $this->add_control(
            'select_arrow', [
                'label' => esc_html__('Choose Arrow', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'default' => array(
                    'value' => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ),
                'skin' => 'inline',
                'exclude_inline_options' => 'svg',
                'recommended' => array(
                    'fa-regular' => array(
                        'arrow-alt-circle-right',
                        'caret-square-right',
                        'hand-point-right',
                    ),
                    'fa-solid' => array(
                        'angle-right',
                        'angle-double-right',
                        'chevron-right',
                        'chevron-circle-right',
                        'arrow-right',
                        'long-arrow-alt-right',
                        'caret-right',
                        'caret-square-right',
                        'arrow-circle-right',
                        'arrow-alt-circle-right',
                        'toggle-right',
                        'hand-point-right',
                    ),
                )
            ]
        );

        $this->add_responsive_control(
            'arrows_size', [
                'label' => esc_html__('Arrows Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array('size' => '22'),
                'range' => array(
                    'px' => array(
                        'min' => 15,
                        'max' => 100,
                        'step' => 1,
                    ),
                ),
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->add_responsive_control(
            'left_arrow_position', [
                'label' => esc_html__('Align Left Arrow', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => -100,
                        'max' => 40,
                        'step' => 1,
                    ),
                ),
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->add_responsive_control(
            'right_arrow_position', [
                'label' => esc_html__('Align Right Arrow', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => -100,
                        'max' => 40,
                        'step' => 1,
                    ),
                ),
                'size_units' => array('px'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->start_controls_tabs('tabs_arrows_style');

        $this->start_controls_tab(
            'tab_arrows_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'arrows_bg_color_normal', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'background-color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'arrows_color_normal', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'arrows_border_normal',
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
                'selector' => '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'arrows_border_radius_normal', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrows_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'arrows_bg_color_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'arrows_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'arrows_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next:hover, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev:hover' => 'border-color: {{VALUE}};',
                )
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'arrows_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-button-next, {{WRAPPER}} .swiper-container-wrap .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dots_style', [
                'label' => esc_html__('Dots', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_responsive_control(
            'dots_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                ),
                'default' => [
                    'size' => 45,
                    'unit' => '%',
                ],
                'size_units' => '%',
                'selectors' => array(
                    '{{WRAPPER}} .swiper-pagination.swiper-pagination-bullets' => 'left: {{SIZE}}%',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_responsive_control(
            'dots_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 2,
                        'max' => 40,
                        'step' => 1,
                    ),
                ),
                'size_units' => '',
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_responsive_control(
            'dots_spacing', [
                'label' => esc_html__('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ),
                ),
                'size_units' => '',
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->start_controls_tabs('tabs_dots_style');

        $this->start_controls_tab(
            'tab_dots_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_control(
            'dots_color_normal', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_control(
            'active_dot_color_normal', [
                'label' => esc_html__('Active Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'dots_border_normal',
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
                'selector' => '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet',
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_control(
            'dots_border_radius_normal', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_responsive_control(
            'dots_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'allowed_dimensions' => 'vertical',
                'placeholder' => array(
                    'top' => '',
                    'right' => 'auto',
                    'bottom' => '',
                    'left' => 'auto',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullets' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_control(
            'dots_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->add_control(
            'dots_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-container-wrap .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'bullets',
                )
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_fraction_style', [
                'label' => esc_html__('Pagination: Fraction', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'fraction',
                )
            ]
        );

        $this->add_control(
            'fraction_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'fraction',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'fraction_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition' => array(
                    'dots' => 'yes',
                    'pagination_type' => 'fraction',
                )
            ]
        );

        $this->end_controls_section();
    }

    protected function get_image($item, $index) {
        $settings = $this->get_settings();
        $image_url = Group_Control_Image_Size::get_attachment_image_src($item['team_member_image']['id'], 'thumbnail', $settings);

        if ($image_url) {
            $image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($item['team_member_image'])) . '">';
        } else {
            $image_html = '<img src="' . esc_url($item['team_member_image']['url']) . '">';
        }

        if (!empty($item['team_member_image']['url'])) {
            if ($item['link_type'] == 'image' && !empty($item['link']['url'])) {
                $link_key = $this->get_repeater_setting_key('link', 'team_member_image', $index);
                $this->add_link_attributes($link_key, $item['link']);
                $image = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('link'), $image_html);
            } else {
                $image = $image_html;
            }
        }
        return $image;
    }

    protected function get_content($item) {
        $settings = $this->get_settings_for_display();
        $description = '';

        if ($this->get_description()) {
            $description = $this->get_description($item);
        }
        return $description;
    }

    protected function get_description($item) {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('team_member_description', 'class', 'eead-team-member-description');

        if (!empty($item['team_member_description'])) {
            ?>
            <div <?php echo $this->get_render_attribute_string('team_member_description'); ?>>
                <?php echo esc_html($item['team_member_description']); ?>
            </div>
            <?php
        }
    }

    protected function get_social_links($item) {
        $settings = $this->get_settings_for_display();
        $social_links = [];

        $social_links['facebook'] = $item['facebook_url'] ? $item['facebook_url'] : '';
        $social_links['twitter'] = $item['twitter_url'] ? $item['twitter_url'] : '';
        $social_links['instagram'] = $item['instagram_url'] ? $item['instagram_url'] : '';
        $social_links['linkedin'] = $item['linkedin_url'] ? $item['linkedin_url'] : '';
        $social_links['youtube'] = $item['youtube_url'] ? $item['youtube_url'] : '';
        $social_links['pinterest'] = $item['pinterest_url'] ? $item['pinterest_url'] : '';
        $social_links['dribbble'] = $item['dribbble_url'] ? $item['dribbble_url'] : '';
        $social_links['envelope'] = $item['email'] ? $item['email'] : '';
        $social_links['phone-alt'] = $item['phone'] ? $item['phone'] : '';
        ?>
        <div class="eead-team-member-social-links-wrap">
            <ul class="eead-team-member-social-links">
                <?php
                foreach ($social_links as $icon_id => $icon_url) {
                    if ($icon_url) {
                        if ($icon_id == 'envelope') {
                            ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr($icon_url); ?>">
                                    <span class="eead-team-member-social-icon-wrap">
                                        <i class="eead-team-member-social-icon far fa fa-<?php echo esc_attr($icon_id) ?>"></i>
                                    </span>
                                </a>
                            </li>
                            <?php
                        } elseif ($icon_id == 'phone-alt') {
                            ?>
                            <li>
                                <a href="tel:<?php echo esc_attr($icon_url); ?>">
                                    <span class="eead-team-member-social-icon-wrap">
                                        <i class="eead-team-member-social-icon fas fa fa-<?php echo esc_attr($icon_id) ?>"></i>
                                    </span>
                                </a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <a href="<?php echo esc_attr($icon_url); ?>">
                                    <span class="eead-team-member-social-icon-wrap">
                                        <i class="eead-team-member-social-icon fab fa-<?php echo esc_attr($icon_id) ?>"></i>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <?php
    }

    protected function get_member_position($item) {
        $settings = $this->get_settings_for_display();
        $position = '';
        $this->add_inline_editing_attributes('team_member_position', 'none');
        $this->add_render_attribute('team_member_position', 'class', 'eead-team-member-position');

        if ($item['team_member_position'] != '') {
            $position .= sprintf('<%1$s %2$s>%3$s</%1$s>', 'h2', $this->get_render_attribute_string('team_member_position'), $item['team_member_position']);
        }

        return $position;
    }

    protected function get_member_name($item, $index) {
        $settings = $this->get_settings_for_display();
        if ($item['team_member_name'] == '') {
            return;
        }

        $member_key = $this->get_repeater_setting_key('team_member_name', 'team_member_details', $index);
        $link_key = $this->get_repeater_setting_key('link', 'team_member_details', $index);

        $this->add_render_attribute($member_key, 'class', 'eead-team-member-name');

        if ($item['link_type'] == 'title' && !empty($item['link']['url'])) {
            if (!empty($item['link']['url'])) {
                $this->add_link_attributes($link_key, $item['link']);
            }

            printf('<%1$s class="eead-team-member-name"><a %3$s>%4$s</a></%1$s>', 'h1', $this->get_render_attribute_string($member_key), $this->get_render_attribute_string($link_key), $item['team_member_name']);
        } else {
            printf('<%1$s class="eead-team-member-name">%2$s</%1$s>', 'h1', $item['team_member_name']);
        }
    }

    protected function render_arrows() {
        $settings = $this->get_settings_for_display();
        $id = esc_attr($this->get_id());
        $migration_allowed = Icons_Manager::is_migration_allowed();

        if (!isset($settings['arrow']) && !Icons_Manager::is_migration_allowed()) {
            $settings['arrow'] = 'fa fa-angle-right';
        }

        $has_icon = !empty($settings['arrow']);
        if (!$has_icon && !empty($settings['select_arrow']['value'])) {
            $has_icon = true;
        }

        $migrated = isset($settings['__fa4_migrated']['select_arrow']);
        $is_new = !isset($settings['arrow']) && $migration_allowed;

        if ('yes' === $settings['arrows']) {
            if ($has_icon) {
                if ($is_new || $migrated) {
                    $next_arrow = str_replace('left', 'right', $settings['select_arrow']['value']);
                    $prev_arrow = str_replace('right', 'left', $settings['select_arrow']['value']);
                } else {
                    $next_arrow = $settings['arrow'];
                    $prev_arrow = str_replace('right', 'left', $settings['arrow']);
                }
            } else {
                $next_arrow = 'fa fa-angle-right';
                $prev_arrow = 'fa fa-angle-left';
            }
            if (!empty($settings['arrow']) || (!empty($settings['select_arrow']['value']) && $is_new)) {
                ?>
                <div class="swiper-button-prev swiper-button-prev-<?php echo $id; ?>">
                    <i aria-hidden="true" class="<?php echo esc_attr($prev_arrow); ?>"></i>
                </div>

                <div class="swiper-button-next swiper-button-next-<?php echo $id; ?>">
                    <i aria-hidden="true" class="<?php echo esc_attr($next_arrow); ?>"></i>
                </div>
                <?php
            }
        }
    }

    protected function render() {
        $id = esc_attr($this->get_id());
        $settings = $this->get_settings_for_display();
        $member_details_arr = $settings['team_member_details'];
        $this->add_render_attribute('team-member-carousel-wrap', 'class', 'swiper-container-wrap eead-team-member-carousel-wrap');

        $slider_settings = $this->slider_settings();
        $this->add_render_attribute(
            'team-member-carousel', [
                'class' => ['eead-team-member-wrapper', 'eead-team-member-carousel', 'eead-swiper-slider', 'swiper-container'],
                'id' => 'swiper-container-' . $id,
                'data-slider-settings' => isset($slider_settings) ? wp_json_encode($slider_settings) :
                    ''
            ]
        );

        $rtl_class = is_rtl() ? 'dir="rtl"' :
            '';
        ?>
        <div <?php echo $this->get_render_attribute_string('team-member-carousel-wrap'); ?>>
            <div <?php echo $this->get_render_attribute_string('team-member-carousel'); ?>>
                <div class="swiper-wrapper">
                    <?php foreach ($member_details_arr as $index => $item) {
                        ?>
                        <div class="swiper-slide">
                            <div class="eead-team-member <?php echo esc_attr($settings['layout']); ?>">
                                <div class="eead-team-member-image">
                                    <?php
                                    echo $this->get_image($item, $index);
                                    if ($settings['layout'] == 'style1') {
                                        $this->get_social_links($item);
                                    }
                                    ?>
                                </div>

                                <div class="eead-team-member-content eead-team-member-content-normal">
                                    <?php
                                    if ($settings['layout'] == 'style1') {
                                        $this->get_member_name($item, $index);
                                        echo $this->get_member_position($item);
                                        $this->get_description($item);
                                    } else if ($settings['layout'] == 'style2') {
                                        echo '<div class="eead-mini-wrap">';
                                        $this->get_member_name($item, $index);
                                        echo $this->get_member_position($item);
                                        $this->get_description($item);
                                        $this->get_social_links($item);
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if ($settings['dots'] == 'yes') { ?>
                <div class="swiper-pagination swiper-pagination-<?php echo esc_attr($id); ?>"></div>
            <?php } ?>
            <?php $this->render_arrows(); ?>
        </div>
        <?php
    }

    protected function slider_settings() {
        $settings = $this->get_settings_for_display();
        $id = esc_attr($this->get_id());

        $slider_settings = [
            'direction' => 'horizontal',
            'effect' => isset($settings['carousel_effect']) && $settings['carousel_effect'] ? $settings['carousel_effect'] : 'slide',
            'speed' => !empty($settings['slider_speed']['size']) ? $settings['slider_speed']['size'] : 400,
            'slidesPerView' => !empty($settings['items'
            ]['size']) ? absint($settings['items']['size']) : 3,
            'spaceBetween' => !empty($settings['margin']['size']) ? absint($settings['margin']['size']) : 10,
            'grabCursor' => $settings['grab_cursor'] === 'yes',
            'autoHeight' => true,
            'loop' => $settings['infinite_loop'] === 'yes',
        ];

        if ($settings['autoplay'] == 'yes') {
            if (isset($settings['autoplay_speed']['size'])) {
                $autoplay_speed = $settings['autoplay_speed']['size'];
            } else if ($settings['autoplay_speed']) {
                $autoplay_speed = $settings['autoplay_speed'];
            }
        } else {
            $autoplay_speed = 100000;
        }

        $slider_settings['autoplay'] = [
            'delay' => $autoplay_speed,
            'disableOnInteraction' => $settings['pause_on_interaction'] === 'yes'
        ];

        if (isset($settings['dots']) && $settings['dots'] == 'yes') {
            $slider_settings['pagination'] = [
                'el' => '.swiper-pagination-' . $id,
                'type' => $settings['pagination_type'],
                'clickable' => true
            ];
        }

        if ($settings['arrows'] == 'yes') {
            $slider_settings['navigation'] = [
                'nextEl' => '.swiper-button-next-' . $id,
                'prevEl' => '.swiper-button-prev-' . $id
            ];
        }

        $slider_settings['breakpoints'] = [
            '320' => [
                'spaceBetween' => !empty($settings['margin_mobile']['size']) ? absint($settings['margin_mobile']['size']) : 10,
                'slidesPerView' => !empty($settings['items_mobile']['size']) ? absint($settings['items_mobile']['size']) : 1
            ],
            '768' => [
                'spaceBetween' => !empty($settings['margin_tablet']['size']) ? absint($settings['margin_tablet']['size']) : 10,
                'slidesPerView' => !empty($settings['items_tablet']['size']) ? absint($settings['items_tablet']['size']) : 2
            ],
            '1024' => [
                'spaceBetween' => !empty($settings['margin']['size']) ? absint($settings['margin']['size']) : 10,
                'slidesPerView' => !empty($settings['items']['size']) ? absint($settings['items']['size']) : 3
            ],
        ];

        return $slider_settings;
    }

}
