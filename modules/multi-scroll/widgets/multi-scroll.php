<?php

namespace EasyElementorAddons\Modules\MultiScroll\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Responsive\Responsive;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class MultiScroll extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-multi-scroll';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Multi Scroll', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-scroll';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['multiscroll'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'content_templates', [
                'label' => __('Content', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'template_height_hint', [
                'label' => '<span style="line-height: 1.4em;">It\'s recommended that templates be the same height</span>',
                'type' => Controls_Manager::RAW_HTML,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'notice', [
                'label' => __('Names are reversed in RTL mode', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $repeater->add_control(
            'left_content', [
                'label' => __('Left Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'text' => __('Text Editor', 'easy-elementor-addons'),
                    'temp' => __('Elementor Template', 'easy-elementor-addons'),
                ),
                'default' => 'temp',
            ]
        );

        $repeater->add_control(
            'left_side_text', [
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.',
                'label_block' => true,
                'dynamic' => array( 'active' => true ),
                'condition' => array(
                    'left_content' => 'text',
                ),
            ]
        );

        $repeater->add_control(
            'live_temp_content', [
                'label' => __('Template Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'classes' => 'eead-live-temp-title control-hidden',
                'label_block' => true,
                'condition' => array(
                    'left_content' => 'temp',
                ),
            ]
        );

        $repeater->add_control(
            'left_side_template_live', [
                'type' => Controls_Manager::BUTTON,
                'label_block' => true,
                'button_type' => 'default eead-btn-block',
                'text' => __('Create / Edit Template', 'easy-elementor-addons'),
                'event' => 'createLiveTemp',
                'condition' => array(
                    'left_content' => 'temp',
                ),
            ]
        );

        $repeater->add_control(
            'left_side_template', [
                'label' => __('Left Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => eead_get_elementor_page_list(),
                'multiple' => false,
                'condition' => array(
                    'left_content' => 'temp',
                ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hide_left_section_tabs', [
                'label' => __('Hide on Tabs', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option works only when multiscroll disabled on tablets', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'hide_left_section_mobs', [
                'label' => __('Hide on Mobiles', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option works only when multiscroll disabled on mobiles', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'right_content', [
                'label' => __('Right Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'text' => __('Text Editor', 'easy-elementor-addons'),
                    'temp' => __('Elementor Template', 'easy-elementor-addons'),
                ),
                'default' => 'temp',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'right_side_text', [
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.',
                'label_block' => true,
                'dynamic' => array('active' => true),
                'condition' => array(
                    'right_content' => 'text',
                ),
            ]
        );

        $repeater->add_control(
            'live_temp_content_extra', [
                'label' => __('Template Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'classes' => 'eead-live-temp-title control-hidden',
                'label_block' => true,
                'condition' => array(
                    'right_content' => 'temp',
                ),
            ]
        );

        $repeater->add_control(
            'right_side_template_live', [
                'type' => Controls_Manager::BUTTON,
                'label_block' => true,
                'button_type' => 'default eead-btn-block',
                'text' => __('Create / Edit Template', 'easy-elementor-addons'),
                'event' => 'createLiveTemp',
                'condition' => array(
                    'right_content' => 'temp',
                ),
            ]
        );

        $repeater->add_control(
            'right_side_template', [
                'label' => __('Right Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => eead_get_elementor_page_list(),
                'multiple' => false,
                'condition' => array(
                    'right_content' => 'temp',
                ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hide_right_section_tabs', [
                'label' => __('Hide on Tabs', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option works only when multiscroll disabled on tablets', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'hide_right_section_mobs', [
                'label' => __('Hide on Mobiles', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option works only when multiscroll disabled on mobiles', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'left_side_repeater', [
                'label' => __('Sections', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu', [
                'label' => __('Navigation', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'nav_menu_switch', [
                'label' => __('Navigation Menu', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('This option works only on the frontend', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'navigation_menu_pos', [
                'label' => __('Horizontal Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left'   => array(
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ),
                    'center' => array(
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ),
                    'right'  => array(
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ),
                ),
                'default' => 'left',
                'prefix_class' => 'eead-mscroll-nav-',
                'condition' => array(
                    'nav_menu_switch' => 'yes',
                ),
            ]
        );

        $this->add_responsive_control(
            'navigation_menu_vpos', [
                'label' => __('Vertical Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'top' => array(
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-up',
                    ),
                    'bottom' => array(
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-down',
                    ),
                ),
                'default' => 'top',
                'prefix_class' => 'eead-mscroll-nav-',
                'condition' => array(
                    'nav_menu_switch' => 'yes',
                ),
            ]
        );

        $nav_repeater = new Repeater();

        $nav_repeater->add_control(
            'nav_menu_item', [
                'label' => __('List Item', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'nav_menu_repeater', [
                'label' => __('List Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $nav_repeater->get_controls(),
                'title_field' => '{{{ nav_menu_item }}}',
                'condition' => array(
                    'nav_menu_switch' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'navigation_dots', [
                'label' => __('Navigation Dots', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'dots_tooltips', [
                'label' => __('Dots Tooltips Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Add text for each navigation dot separated by \',\'', 'easy-elementor-addons'),
                'condition'   => array(
                    'navigation_dots' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'navigation_dots_pos', [
                'label' => __('Dots Horizontal Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'left' => __('Left', 'easy-elementor-addons'),
                    'right' => __('Right', 'easy-elementor-addons'),
                ),
                'default' => 'right',
                'condition' => array(
                    'navigation_dots' => 'yes',
                ),
            ]
        );

        $this->add_control(
            'navigation_dots_v_pos', [
                'label' => __('Dots Vertical Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'top' => __('Top', 'easy-elementor-addons'),
                    'middle' => __('Middle', 'easy-elementor-addons'),
                    'bottom' => __('Bottom', 'easy-elementor-addons'),
                ),
                'default' => 'middle',
                'condition' => array(
                    'navigation_dots' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'advanced_options', [
                'label' => __('Advanced Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'left_width', [
                'label' => esc_html__('Left Section Width (%)', 'eead-multi-scroll'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => '%',
                'default' => array(
                    'size' => 50,
                ),
            ]
        );

        $this->add_control(
            'right_width', [
                'label' => esc_html__('Right Section Width (%)', 'eead-multi-scroll'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => '%',
                'default' => array(
                    'size' => 50,
                ),
            ]
        );

        $this->add_control(
            'scroll_container_height', [
                'label' => __('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'fit' => __('Fit to Screen', 'easy-elementor-addons'),
                    'min' => __('Min Height', 'easy-elementor-addons'),
                ),
                'default' => 'min',
            ]
        );

        $this->add_responsive_control(
            'container_min_height', [
                'label' => __('Min Height (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => array(
                    'size' => 500,
                ),
                'range' => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 600,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-inner' => 'min-height: {{SIZE}}px',
                ),
                'condition' => array(
                    'scroll_container_height' => 'min',
                ),
            ]
        );

        $this->add_control(
            'keyboard_scrolling', [
                'label' => __('Keyboard Scrolling', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => array(
                    'scroll_container_height' => 'min',
                ),
            ]
        );

        $this->add_control(
            'loop_top', [
                'label' => __('Loop Top', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Defines whether scrolling up in the first section should scroll to the last one or not.', 'easy-elementor-addons'),

            ]
        );

        $this->add_control(
            'loop_bottom', [
                'label' => __('Loop Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Defines whether scrolling down in the last section should scroll to the first one or not.', 'easy-elementor-addons'),

            ]
        );

        $this->add_control(
            'scroll_speed', [
                'label' => __('Scroll Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'title' => __('Set scolling speed in seconds, default: 0.7', 'easy-elementor-addons'),
                'default' => 0.7,
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-inner .eead-scroll-easing'    => '-webkit-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -moz-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -o-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22)',
                ),
            ]
        );

        $this->add_control(
            'scroll_responsive_tabs', [
                'label' => __('Disable on Tabs', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Disable multiscroll on tabs', 'easy-elementor-addons'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'scroll_responsive_mobs', [
                'label' => __('Disable on Mobiles', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Disable multiscroll on mobile phones', 'easy-elementor-addons'),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'left_side_text', [
                'label' => __('Left Side', 'easy-elementor-addons'),
                'tab' => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );

        $this->add_control(
            'left_side_background', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'left_text_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-left-text' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'left_text_background', [
                'label' => __('Text Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-left-text' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'left_text_typography',
                'selector' => '{{WRAPPER}} .eead-multiscroll-left-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'left_text_border',
                'selector' => '{{WRAPPER}} .eead-multiscroll-left-text',
            ]
        );

        $this->add_control(
            'left_text_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-left-text' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'left_text_vertical', [
                'label' => __('Vertical Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'top' => array(
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-up',
                    ),
                    'middle' => array(
                        'title' => __('Middle', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-justify',
                    ),
                    'bottom' => array(
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-down',
                    ),
                ),
                'default' => 'middle',
                'selectors' => array(
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'left_text_margin', [
                'label' => __('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-left-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'left_text_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-left-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'right_side_text', [
                'label' => __('Right Side', 'easy-elementor-addons'),
                'tab' => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );

        $this->add_control(
            'right_side_background', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'right_text_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-right-text' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'right_text_background', [
                'label' => __('Text Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-right-text' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'right_text_typography',
                'selector' => '{{WRAPPER}} .eead-multiscroll-right-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'right_text_border',
                'selector' => '{{WRAPPER}} .eead-multiscroll-right-text',
            ]
        );

        $this->add_control(
            'right_text_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-right-text' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'right_text_vertical', [
                'label' => __('Vertical Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'top' => array(
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-up',
                    ),
                    'middle' => array(
                        'title' => __('Middle', 'easy-elementor-addons'),
                        'icon' => 'fa fa-align-justify',
                    ),
                    'bottom' => array(
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'fa fa-long-arrow-down',
                    ),
                ),
                'default' => 'middle',
                'selectors' => array(
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'right_text_margin', [
                'label' => __('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-right-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'right_text_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-multiscroll-right-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'navigation_style', [
                'label' => __('Navigation Dots', 'easy-elementor-addons'),
                'tab' => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => array(
                    'navigation_dots' => 'yes',
                ),
            ]
        );

        $this->start_controls_tabs('navigation_style_tabs');

        $this->start_controls_tab(
            'dots_style_tab', [
                'label' => __('Dots', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'tooltips_color', [
                'label' => __('Tooltips Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-tooltip' => 'color: {{VALUE}};',
                ),
                'condition' => array(
                    'navigation_dots' => 'yes',
                    'dots_tooltips!' => '',
                ),
            ]
        );

        $this->add_control(
            'tooltips_font', [
                'label' => __('Tooltips Text Font', 'easy-elementor-addons'),
                'type' => Controls_Manager::FONT,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-tooltip' => 'font-family: {{VALUE}};',
                ),
                'condition' => array(
                    'navigation_dots' => 'yes',
                    'dots_tooltips!' => '',
                ),
            ]
        );

        $this->add_control(
            'dots_color', [
                'label' => __('Dots Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-nav span' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'active_dot_color', [
                'label' => __('Active Dot Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-nav li .active span' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'dots_border_color', [
                'label' => __('Dots Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-nav span' => 'border-color: {{VALUE}};',
                ),
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'container_style_tab', [
                'label' => __('Container', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'navigation_background', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-nav' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'navigation_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .multiscroll-nav' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'label' => __('Shadow', 'easy-elementor-addons'),
                'name' => 'navigation_box_shadow',
                'selector' => '{{WRAPPER}} .multiscroll-nav',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'navigation_menu_style', [
                'label' => __('Navigation Menu', 'easy-elementor-addons'),
                'tab' => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => array(
                    'nav_menu_switch' => 'yes',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'navigation_items_typography',
                'selector' => '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item .eead-scroll-nav-link',
            ]
        );

        $this->start_controls_tabs('navigation_menu_style_tabs');

        $this->start_controls_tab(
            'normal_style_tab', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'normal_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item .eead-scroll-nav-link'  => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'normal_hover_color', [
                'label' => __('Text Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item .eead-scroll-nav-link:hover'  => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'normal_background', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item'  => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'label' => __('Shadow', 'easy-elementor-addons'),
                'name' => 'normal_shadow',
                'selector' => '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'active_style_tab', [
                'label' => __('Active', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'active_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item.active .eead-scroll-nav-link'  => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'active_hover_color', [
                'label' => __('Text Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item.active .eead-scroll-nav-link:hover'  => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'active_background', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item.active'  => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'label' => __('Shadow', 'easy-elementor-addons'),
                'name' => 'active_shadow',
                'selector' => '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item.active',
            ]
        );

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'navigation_items_border',
                'selector' => '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'navigation_items_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'navigation_items_margin', [
                'label' => __('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'navigation_items_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-scroll-nav-menu .eead-scroll-nav-item .eead-scroll-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $navigation_dots = ('yes' === $settings['navigation_dots']) ? true : false;
        $top_loop = ('yes' === $settings['loop_top']) ? true : false;
        $bottom_loop = ('yes' === $settings['loop_bottom']) ? true : false;
        $dots_text = explode(',', $settings['dots_tooltips']);
        $nav_items = $settings['nav_menu_repeater'];
        $anchors_arr = array();

        if ('yes' === $settings['nav_menu_switch']) {
            foreach ( $nav_items as $index => $item ) {
                array_push($anchors_arr, 'section_' . $index);
            }
        }

        $scoll_settings = array(
            'dots' => $navigation_dots,
            'leftWidth' => !empty($settings['left_width']['size']) ? $settings['left_width']['size'] : 50,
            'rightWidth' => !empty($settings['right_width']['size']) ? $settings['right_width']['size'] : 50,
            'dotsText' => $dots_text,
            'dotsPos' => $settings['navigation_dots_pos'],
            'dotsVPos' => $settings['navigation_dots_v_pos'],
            'topLoop' => $top_loop,
            'btmLoop' => $bottom_loop,
            'anchors' => $anchors_arr,
            'hideTabs' => ('yes' === $settings['scroll_responsive_tabs']) ? true : false,
            'tabSize' => ('yes' === $settings['scroll_responsive_tabs']) ? Responsive::get_breakpoints()['lg'] : Responsive::get_breakpoints()['lg'],
            'hideMobs' => ('yes' === $settings['scroll_responsive_mobs']) ? true : false,
            'mobSize' => ('yes' === $settings['scroll_responsive_mobs']) ? Responsive::get_breakpoints()['md'] : Responsive::get_breakpoints()['md'],
            'cellHeight' => !empty($settings['container_min_height']['size']) ? $settings['container_min_height']['size'] : 500,
            'fit' => $settings['scroll_container_height'],
            'keyboard' => ('yes' === $settings['keyboard_scrolling']) ? true : false,
            'rtl' => is_rtl(),
            'id' => esc_attr( $id ),
        );

        $this->add_render_attribute('multiscroll_wrapper', 'class', 'eead-multiscroll-wrap');

        $this->add_render_attribute(
            'multiscroll_inner', [
                'id' => 'eead-multiscroll-' . esc_attr($id),
                'class' => array(
                    'eead-multiscroll-inner',
                    'eead-scroll-' . esc_attr($settings['scroll_container_height']),
                ),
            ]
        );

        $this->add_render_attribute(
            'multiscroll_menu', [
                'id' => 'eead-scroll-nav-menu-' . esc_attr($id),
                'class' => array(
                    'eead-scroll-nav-menu',
                    'eead-scroll-responsive',
                ),
            ]
        );

        $this->add_render_attribute('right_template', 'class', array( 'eead-multiscroll-temp', 'eead-multiscroll-right-temp', 'eead-multiscroll-temp-' . esc_attr($id)));
        $this->add_render_attribute('left_template', 'class', array( 'eead-multiscroll-temp', 'eead-multiscroll-left-temp', 'eead-multiscroll-temp-' . esc_attr($id)));
        $this->add_render_attribute('left_side', 'class', 'eead-multiscroll-left-' . esc_attr($id));
        $this->add_render_attribute('right_side', 'class', 'eead-multiscroll-right-' . esc_attr($id));
        $this->add_inline_editing_attributes('left_side_text', 'advanced');
        $this->add_inline_editing_attributes('right_side_text', 'advanced');
        $this->add_render_attribute('left_side_text', 'class', 'eead-multiscroll-left-text');
        $this->add_render_attribute('right_side_text', 'class', 'eead-multiscroll-right-text');
        $templates = $settings['left_side_repeater'];
        ?>

        <div <?php echo wp_kses_post($this->get_render_attribute_string('multiscroll_wrapper')); ?> data-settings="<?php echo wp_json_encode($scoll_settings); ?>">
            <?php if ('yes' === $settings['nav_menu_switch']) { ?>
                <ul <?php echo wp_kses_post($this->get_render_attribute_string('multiscroll_menu')); ?>>
                    <?php foreach ($nav_items as $index => $item) { ?>
                        <li data-menuanchor="<?php echo esc_attr('section_' . $index); ?>" class="eead-scroll-nav-item">
                            <a class="eead-scroll-nav-link" href="<?php echo esc_attr('#section_' . $index); ?>"><?php echo wp_kses_post($item['nav_menu_item']); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'multiscroll_inner' ) ); ?>>
                <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'left_side' ) ); ?>>
                    <?php
                    foreach ($templates as $index => $section) :
                        if ('yes' === $section['hide_left_section_tabs']) {
                            $this->add_render_attribute('left_section' . $index, 'data-hide-tabs', true);
                        }
                        if ('yes' === $section['hide_left_section_mobs']) {
                            $this->add_render_attribute('left_section' . $index, 'data-hide-mobs', true);
                        }
                        ?>
                    <div <?php echo wp_kses_post($this->get_render_attribute_string('left_template') . $this->get_render_attribute_string('left_section' . $index)); ?>>
                        <?php
                        if ('temp' === $section['left_content']) :
                            $template = empty($section['left_side_template']) ? $section['live_temp_content'] : $section['left_side_template'];
                            echo $this->get_template_content($template); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            else :
                                ?>
                                <div <?php echo wp_kses_post($this->get_render_attribute_string('left_side_text')); ?>>
                                    <?php echo $this->parse_text_editor($section['left_side_text']); ?>
                                </div>
                                <?php
                            endif;
                            ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div <?php echo wp_kses_post($this->get_render_attribute_string('right_side')); ?>>
                    <?php
                    foreach ( $templates as $index => $section ) :
                        if ('yes' === $section['hide_right_section_tabs']) {
                            $this->add_render_attribute('right_section' . $index, 'data-hide-tabs', true);
                        }
                        if ('yes' === $section['hide_right_section_mobs']) {
                            $this->add_render_attribute('right_section' . $index, 'data-hide-mobs', true);
                        }
                        ?>
                    <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'right_template' ) . $this->get_render_attribute_string( 'right_section' . $index ) ); ?>>
                        <?php
                        if ('temp' === $section['right_content']) {
                            $template = empty($section['right_side_template']) ? $section['live_temp_content_extra'] : $section['right_side_template'];
                            echo $this->get_template_content($template); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        } else {
                            ?>
                            <div <?php echo wp_kses_post($this->get_render_attribute_string('right_side_text')); ?>>
                                <?php echo $this->parse_text_editor($section['right_side_text']); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }


    /**
     * Get Elementor Template HTML Content
     *
     * @since 3.6.0
     * @access public
     *
     * @param string $title Template Title.
     *
     * @return $template_content string HTML Markup of the selected template.
     */
    public function get_template_content($title) {
        $frontend = Plugin::$instance->frontend;
        $id = $this->get_id_by_title($title);
        $id = apply_filters('wpml_object_id', $id, 'elementor_library', true);
        $template_content = $frontend->get_builder_content_for_display($id, true);
        return $template_content;
    }

    /**
     * Get ID By Title
     *
     * Get Elementor Template ID by title
     *
     * @since 3.6.0
     * @access public
     *
     * @param string $title template title.
     *
     * @return string $template_id template ID.
     */
    public function get_id_by_title($title) {
        $template = get_page_by_title($title, OBJECT, 'elementor_library');
        $template_id = isset($template->ID) ? $template->ID : $title;
        return $template_id;
    }
}
