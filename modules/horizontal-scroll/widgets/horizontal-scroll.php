<?php

namespace EasyElementorAddons\Modules\HorizontalScroll\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class HorizontalScroll extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-horizontal-scroll';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Horizontal Scroll', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-featured-image';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['scrollmagic', 'tweenmax'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'content_templates', [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'notices', [
                'raw' => esc_html__('<p>Important:</p><ul><li>Please make sure that "Stretch Section" option is disabled for sections below.</li></ul>', 'easy-elementor-addons'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $temp_repeater = new Repeater();

        $temp_repeater->add_control(
            'template_type', [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'template' => esc_html__('Elementor Template', 'easy-elementor-addons'),
                    'id' => esc_html__('Section ID', 'easy-elementor-addons'),
                ),
                'default' => 'id',
            ]
        );

        $temp_repeater->add_control(
            'live_temp_content', [
                'label' => esc_html__('Template Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'classes' => 'eead-live-temp-title control-hidden',
                'label_block' => true,
                'condition' => array(
                    'template_type' => 'template',
                ),
            ]
        );

        $temp_repeater->add_control(
            'section_template_live', [
                'type' => Controls_Manager::BUTTON,
                'label_block' => true,
                'button_type' => 'default eead-btn-block',
                'text' => esc_html__('Create / Edit Template', 'easy-elementor-addons'),
                'event' => 'createLiveTemp',
                'condition' => array(
                    'template_type' => 'template',
                ),
            ]
        );

        $temp_repeater->add_control(
            'section_template', [
                'label' => esc_html__('Elementor Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => eead_get_elementor_page_list(),
                'multiple' => false,
                'label_block' => true,
                'condition' => array(
                    'template_type' => 'template',
                ),
            ]
        );

        $temp_repeater->add_control(
            'anchor_id', [
                'label' => esc_html__('Anchor ID', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('This ID will be used to anchor your links to this slide', 'easy-elementor-addons'),
                'dynamic' => array('active' => true),
                'condition' => array(
                    'template_type' => 'template',
                ),
            ]
        );

        $temp_repeater->add_control(
            'section_id', [
                'label' => esc_html__('Section ID', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'condition' => array(
                    'template_type' => 'id',
                ),
            ]
        );

        $temp_repeater->add_control(
            'scroll_bg_transition', [
                'label' => esc_html__('Scroll Background Transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $temp_repeater->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'scroll_bg',
                'types' => array('classic'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => array(
                    'scroll_bg_transition' => 'yes',
                ),
            ]
        );

        $temp_repeater->add_control(
            'hide_section', [
                'label' => esc_html__('Hide Section On', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => array(
                    'desktop' => esc_html__('Desktop', 'easy-elementor-addons'),
                    'tablet' => esc_html__('Tablet', 'easy-elementor-addons'),
                    'mobile' => esc_html__('Mobile', 'easy-elementor-addons'),
                ),
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'section_repeater', [
                'label' => esc_html__('Sections', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $temp_repeater->get_controls(),
                'title_field' => '{{{"template" === template_type ? section_template : section_id}}}',
                'prevent_empty' => false,
            ]
        );

        $this->add_control(
            'scroll_bg_speed', [
                'label' => esc_html__('Background Transition Speed (sec)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-bg-layer' => 'transition-duration: {{SIZE}}s;',
                ),
            ]
        );

        $this->add_control(
            'fixed_content_heading', [
                'label' => esc_html__('Fixed Content Template', 'easy-elementor-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'live_temp_content_extra', [
                'label' => esc_html__('Template Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'classes' => 'eead-live-temp-title control-hidden',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'fixed_template_live', [
                'type' => Controls_Manager::BUTTON,
                'label_block' => true,
                'button_type' => 'default eead-btn-block',
                'text' => esc_html__('Create / Edit Template', 'easy-elementor-addons'),
                'event' => 'createLiveTemp',
            ]
        );

        $this->add_control(
            'fixed_template', [
                'label' => esc_html__('Fixed Content Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => eead_get_elementor_page_list(),
                'label_block' => true,
                'multiple' => false,
            ]
        );

        $this->add_responsive_control(
            'fixed_content_voffset', [
                'label' => esc_html__('Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 600,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-hscroll-fixed-content' => 'top: {{SIZE}}{{UNIT}}',
                ),
                'condition'  => array(
                    'fixed_template!' => '',
                ),
            ]
        );

        $this->add_responsive_control(
            'fixed_content_hoffset', [
                'label' => esc_html__('Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array( 'px', 'em', '%' ),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 600,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-fixed-content' => 'left: {{SIZE}}{{UNIT}}',
                ),
                'condition' => array(
                    'fixed_template!' => '',
                ),
            ]
        );

        $this->add_control(
            'fixed_content_zindex', [
                'label' => esc_html__('z-index', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-fixed-content' => 'z-index: {{VALUE}}',
                ),
                'condition' => array(
                    'fixed_template!' => '',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'advanced_settings', [
                'label' => esc_html__('Advanced Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'slides', [
                'label' => esc_html__('Number of Slides in Viewport', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'description' => esc_html__('Select the number of slides to appear in your browser viewport. For example, 1.5 means half of the next slide will appear on viewport', 'easy-elementor-addons'),
                'range' => array(
                    'px' => array(
                        'min' => 1,
                        'step' => 0.1,
                    ),
                ),
                'default' => array(
                    'size' => 1,
                ),
                'tablet_default' => array(
                    'size' => 0.5,
                ),
                'mobile_default' => array(
                    'size' => 0.5,
                ),
            ]
        );

        $this->add_responsive_control(
            'distance', [
                'label' => esc_html__('Scroll Distance Beyond Last Slide', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'description' => esc_html__('Set value in pixels for the scroll distance after last slide before scroll down to next section', 'easy-elementor-addons'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 300,
                    ),
                ),
                'default' => array(
                    'size' => 0,
                ),
            ]
        );

        $this->add_responsive_control(
            'trigger_offset', [
                'label' => esc_html__('Offset (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'description' => esc_html__('Offset at which the horizontal scroll is triggered', 'easy-elementor-addons'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 600,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-sections-wrap' => 'padding-top: {{SIZE}}px',
                ),
            ]
        );

        $this->add_control(
            'scroll_effect', [
                'label' => esc_html__('Scroll Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'normal' => esc_html__('Normal', 'easy-elementor-addons'),
                    'snap' => esc_html__('Snappy', 'easy-elementor-addons'),
                ),
                'default' => 'normal',
            ]
        );

        $this->add_control(
            'disable_snap', [
                'label' => esc_html__('Disable Snappy Effect on Touch Devices', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
                'condition' => array(
                    'scroll_effect' => 'snap',
                ),
            ]
        );

        $this->add_responsive_control(
            'scroll_speed', [
                'label' => esc_html__('Decrease Scroll Speed by', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('For example, 2 means that scene scroll speed will be decreased to half', 'easy-elementor-addons'),
                'min' => 1,
                'default' => 1,
                'conditions' => array(
                    'relation' => 'or',
                    'terms' => array(
                        array(
                            'name' => 'scroll_effect',
                            'value' => 'normal',
                        ),
                        array(
                            'name' => 'disable_snap',
                            'value' => 'true',
                        ),
                    ),
                ),
            ]
        );

        $this->add_control(
            'progress_bar', [
                'label' => esc_html__('Progress Bar', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
            ]
        );

        $this->add_responsive_control(
            'progress_offset_left', [
                'label' => esc_html__('Progress Bar Left Posiion (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 200,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-progress' => 'left: {{SIZE}}px',
                ),
                'condition' => array(
                    'progress_bar' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'progress_offset_bottom', [
                'label' => esc_html__('Progress Bar Bottom Posiion (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 200,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-progress' => 'bottom: {{SIZE}}px',
                ),
                'condition' => array(
                    'progress_bar' => 'true',
                ),
            ]
        );

        $this->add_control(
            'opacity_transition', [
                'label' => esc_html__('Opacity Scroll Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'separator' => 'before',
                'default' => 'true',
                'condition' => array(
                    'entrance_animation!' => 'true',
                    'rtl_mode!' => 'true',
                ),
            ]
        );

        $this->add_control(
            'entrance_animation', [
                'label' => esc_html__('Trigger Entrance Animations on Scroll', 'easy-elementor-addons'),
                'description' => esc_html__('This option will trigger entrance animations for inner widgets each time you scroll to a slide', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'scroll_effect' => 'snap',
                    'opacity_transition!' => 'true',
                    'rtl_mode!' => 'true',
                ),

            ]
        );

        $this->add_control(
            'keyboard_scroll', [
                'label' => esc_html__('Keyboard Scrolling', 'easy-elementor-addons'),
                'description' => esc_html__('Enable or disable scrolling slides using Keyboard', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rtl_mode', [
                'label' => esc_html__('RTL Mode', 'easy-elementor-addons'),
                'description'  => esc_html__('Enable this option to change scroll direction to RTL', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'prefix_class' => 'eead-hscroll-rtl-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'disable_on', [
                'label' => esc_html__('Disable Horizonal Scroll On', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => array(
                    'tablet' => esc_html__('Tablet', 'easy-elementor-addons'),
                    'mobile' => esc_html__('Mobile', 'easy-elementor-addons'),
                ),
                'multiple' => true,
                'label_block' => true,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'navigation', [
                'label' => esc_html__('Navigation', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'nav_dots', [
                'label' => esc_html__('Navigation Dots', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'nav_dots_position', [
                'label' => esc_html__('Navigation Dots Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                ),
                'default' => 'bottom',
                'prefix_class' => 'eead-hscroll-dots-',
                'condition' => array(
                    'nav_dots' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'nav_dots_offset', [
                'label' => esc_html__('Dots Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 5,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => 1,
                        'max' => 10,
                    ),
                ),
                'condition' => array(
                    'nav_dots' => 'true',
                ),
                'selectors'  => array(
                    '{{WRAPPER}}.eead-hscroll-dots-bottom .eead-hscroll-nav' => 'bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.eead-hscroll-dots-left .eead-hscroll-nav' => 'left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.eead-hscroll-dots-right .eead-hscroll-nav' => 'right: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'tooltips', [
                'label' => esc_html__('Tooltips', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'nav_dots' => 'true',
                ),
            ]
        );

        $this->add_control(
            'dots_tooltips', [
                'label' => esc_html__('Dots Tooltips Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
                'description' => esc_html__('Add text for each navigation dot separated by \',\'', 'easy-elementor-addons'),
                'label_block' => 'true',
                'condition' => array(
                    'nav_dots' => 'true',
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_control(
            'nav_arrows', [
                'label' => esc_html__('Navigation Arrows', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'nav_arrow_left', [
                'label' => esc_html__('Left Arrow Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => array(
                    'library' => 'fa-solid',
                    'value' => 'fas fa-angle-left',
                ),
                'condition' => array(
                    'nav_arrows' => 'true',
                ),
            ]
        );

        $this->add_control(
            'nav_arrow_right', [
                'label' => esc_html__('Right Arrow Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => array(
                    'library' => 'fa-solid',
                    'value' => 'fas fa-angle-right',
                ),
                'condition' => array(
                    'nav_arrows' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_pos', [
                'label' => esc_html__('Arrows Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'range' => array(
                    'px' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -10,
                        'max' => 10,
                    ),
                ),
                'condition' => array(
                    'nav_arrows' => 'true',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-arrow-right' => 'right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eead-hscroll-arrow-left' => 'left: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'loop', [
                'label' => esc_html__('Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'scroll_effect' => 'normal',
                    'nav_arrows' => 'true',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pagination', [
                'label' => esc_html__('Pagination Numbers', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'pagination_number', [
                'label' => esc_html__('Enable Pagination Number', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->add_responsive_control(
            'pagination_hor', [
                'label' => esc_html__('Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 300,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 30,
                    ),
                ),
                'condition' => array(
                    'pagination_number' => 'true',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-hscroll-pagination' => 'left: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->add_responsive_control(
            'pagination_ver', [
                'label' => esc_html__('Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 300,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 30,
                    ),
                ),
                'condition'  => array(
                    'pagination_number' => 'true',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-hscroll-pagination' => 'bottom: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'responsive', [
                'label' => esc_html__('Responsive Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'override_columns', [
                'label' => esc_html__('Put Columns Next to Each Other', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('This option will force the columns to be positioned next to each other on small screens'),
                'prefix_class' => 'eead-hscroll-force-',
                'return_value' => 'true',
                'default' => 'true',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_dots_style', [
                'label' => esc_html__('Navigation Dots', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'nav_dots' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'dots_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'dot_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-dot' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eead-hscroll-carousel-icon' => 'background-color: {{VALUE}}; color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'active_color', [
                'label' => esc_html__('Active Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-item.active .eead-hscroll-nav-dot' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'dot_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-item .eead-hscroll-nav-dot' => 'border-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'active_border_color', [
                'label' => esc_html__('Active Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-item.active .eead-hscroll-nav-dot' => 'border-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_responsive_control(
            'dot_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-item .eead-hscroll-nav-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'tooltips_heading', [
                'label' => esc_html__('Tooltips', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'condition' => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'tooltip_spacing', [
                'label' => esc_html__('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'selectors' => array(
                    '{{WRAPPER}}.eead-hscroll-dots-bottom .eead-hscroll-nav-tooltip' => 'bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.eead-hscroll-dots-left .eead-hscroll-nav-tooltip' => 'left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.eead-hscroll-dots-right .eead-hscroll-nav-tooltip' => 'right: {{SIZE}}{{UNIT}}',
                ),
                'condition'  => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_control(
            'tooltip_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-tooltip' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_control(
            'tooltip_background_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-tooltip' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}.eead-hscroll-dots-left .eead-hscroll-nav-tooltip::after' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}}.eead-hscroll-dots-right .eead-hscroll-nav-tooltip::after' => 'border-left-color: {{VALUE}}',
                ),
                'condition' => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'tooltip_typography',
                'selector' => '{{WRAPPER}} .eead-hscroll-nav-tooltip',
                'condition' => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'tooltip_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
                'condition'  => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'tooltip_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-nav-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
                'condition' => array(
                    'tooltips' => 'true',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_arrows_style', [
                'label' => esc_html__('Navigation Arrows', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'nav_arrows' => 'true',
                ),
            ]
        );

        $this->add_responsive_control(
            'arrow_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-wrap-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eead-hscroll-wrap-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-arrow i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-hscroll-arrow svg' => 'fill: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_hover_color', [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-arrow:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-hscroll-arrow:hover svg' => 'fill: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_background', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-wrap-icon' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_hover_background', [
                'label' => esc_html__('Hover Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-wrap-icon:hover' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-wrap-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            ]
        );

        $this->add_control(
            'arrow_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-wrap-icon' => 'padding: {{SIZE}}{{UNIT}}',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'progress_style', [
                'label' => esc_html__('Progress Bar', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'progress_bar' => 'true',
                ),
            ]
        );

        $this->add_control(
            'progress_color', [
                'label' => esc_html__('Progress Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-progress-line' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'progress_background_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-progress' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pagination_style', [
                'label' => esc_html__('Pagination Numbers', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'pagination_number' => 'true',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'pagination_typography',
                'selector' => '{{WRAPPER}} .eead-hscroll-pagination span',
            ]
        );

        $this->add_control(
            'pagination_spacing', [
                'label' => esc_html__('Spacing Between', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-total-slides:before'  => 'margin: 0 {{SIZE}}px',
                ),
            ]
        );

        $this->add_control(
            'pagination_numbers_current_color', [
                'label' => esc_html__('Current Slide Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-current-slide' => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'pagination_numbers_sep_color', [
                'label' => esc_html__('Separator Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-total-slides:before' => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_control(
            'pagination_numbers_total_color', [
                'label' => esc_html__('Total Slides Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-total-slides' => 'color: {{VALUE}}',
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'pagination_background',
                'types' => array('classic', 'gradient'),
                'selector' => '{{WRAPPER}} .eead-hscroll-pagination',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'pagination_border',
                'selector' => '{{WRAPPER}} .eead-hscroll-pagination',
            ]
        );

        $this->add_control(
            'pagination_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'em'),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-hscroll-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            ]
        );

        $this->add_responsive_control(
            'pagination_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container', [
                'label' => esc_html__('Container', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'container_background', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-outer-wrap' => 'background-color: {{VALUE}}',
                ),
            ]
        );

        $this->add_responsive_control(
            'container_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-hscroll-outer-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        $this->add_render_attribute(
            'wrap', [
                'id' => 'eead-hscroll-wrap-' . $widget_id,
                'class' => 'eead-hscroll-wrap',
            ]
        );

        if ('true' !== $settings['nav_arrows']) {
            $this->add_render_attribute('wrap', 'class', 'eead-hscroll-arrows-hidden');
        }

        if ('true' !== $settings['nav_dots']) {
            $this->add_render_attribute('wrap', 'class', 'eead-hscroll-dots-hidden');
        }

        $this->add_render_attribute(
            'scroller_wrap', [
                'id' => 'eead-hscroll-scroller-wrap-' . $widget_id,
                'class' => 'eead-hscroll-scroller-wrap',
                'data-progress' => 'bottom',
            ]
        );

        $this->add_render_attribute('progress_wrap', 'class', 'eead-hscroll-progress');

        if ('true' !== $settings['progress_bar']) {
            $this->add_render_attribute('progress_wrap', 'class', 'eead-hscroll-progress-hidden');
        }

        $this->add_render_attribute(
            'progress', [
                'id' => 'eead-hscroll-progress-line-' . $widget_id,
                'class' => 'eead-hscroll-progress-line',
            ]
        );

        $templates = $settings['section_repeater'];
        $count = count($templates);
        $disable_snap = false;

        if ('snap' === $settings['scroll_effect'] && 'true' === $settings['disable_snap']) {
                $disable_snap = true;
        }

        $opacity = ('true' === $settings['opacity_transition']) ? true : false;
        $pagination = ('true' === $settings['pagination_number']) ? true : false;

        if ('true' === $settings['tooltips']) {
            $tooltips = explode(',', $settings['dots_tooltips']);
        }

        $slides = !empty($settings['slides']['size']) ? floatval($settings['slides']['size']) : 1;
        $distance = !empty($settings['distance']['size']) ? floatval($settings['distance']['size']) : 0;
        $speed = !empty($settings['scroll_speed']) ? intval($settings['scroll_speed']) : 1;

        $hscroll_settings = array(
            'id' => $widget_id,
            'templates' => $templates,
            'slides' => $slides,
            'slides_tablet' => empty($settings['slides_tablet']['size']) ? $slides : floatval($settings['slides_tablet']['size']),
            'slides_mobile' => empty($settings['slides_mobile']['size']) ? $slides : floatval($settings['slides_mobile']['size']),
            'distance' => $distance,
            'distance_tablet' => empty( $settings['distance_tablet']['size']) ? $slides : floatval($settings['distance_tablet']['size']),
            'distance_mobile' => empty( $settings['distance_mobile']['size']) ? $slides : floatval($settings['distance_mobile']['size']),
            'snap' => $settings['scroll_effect'],
            'disableSnap' => intval( $disable_snap ),
            'speed' => $speed,
            'speed_tablet' => empty( $settings['scroll_speed_tablet']) ? $speed : intval($settings['scroll_speed_tablet']),
            'speed_mobile' => empty( $settings['scroll_speed_mobile']) ? $speed : intval($settings['scroll_speed_mobile']),
            'opacity' => intval($opacity),
            'loop' => $settings['loop'],
            'enternace' => $settings['entrance_animation'],
            'keyboard' => $settings['keyboard_scroll'],
            'pagination' => intval($pagination),
            'rtl' => $settings['rtl_mode'],
            'arrows' => 'true' === (esc_html($settings['nav_arrows'])) ? true : false,
            'dots' => 'true' === (esc_html($settings['nav_dots'])) ? true : false,
            'disableOn' => $settings['disable_on'],
        );

        // Fix warning trying to access array offset with value null.
        if ('true' === $settings['nav_arrows']) {
            $hscroll_settings['leftArrow'] = esc_html($settings['nav_arrow_left']['value']);
            $hscroll_settings['rightArrow'] = esc_html($settings['nav_arrow_right']['value']);
        }

        $this->add_render_attribute(
            'spacer', [
                'id' => 'eead-hscroll-spacer-' . $widget_id,
                'class' => 'eead-hscroll-spacer',
            ]
        );

        $this->add_render_attribute('nav', 'class', 'eead-hscroll-nav');
        $this->add_render_attribute('wrap', 'data-settings', wp_json_encode($hscroll_settings));

        ?>
        <div class="eead-hscroll-outer-wrap">
            <div <?php $this->print_render_attribute_string('spacer'); ?>></div>

            <div <?php $this->print_render_attribute_string('wrap'); ?>>
                <?php
                foreach ($templates as $index => $section) {
                    if ('yes' === $section['scroll_bg_transition']) {
                        $list_item_key = 'eead_hscroll_bg_layer_' . esc_attr($index);
                        $this->add_render_attribute(
                            $list_item_key, [
                                'class'      => array(
                                    'eead-hscroll-bg-layer',
                                    'elementor-repeater-item-' . esc_attr($section['_id']),
                                ),
                                'data-layer' => $index,
                            ]
                        );

                        if (0 === $index) {
                            $this->add_render_attribute($list_item_key, 'class', 'eead-hscroll-layer-active');
                        }

                        ?>
                        <div <?php echo $this->print_render_attribute_string($list_item_key); ?>></div>
                        <?php
                    }
                }

                if (!empty($settings['fixed_template']) || ! empty($settings['live_temp_content_extra'])) {
                    ?>
                    <div class="eead-hscroll-fixed-content">
                        <?php
                        $template_title = empty($settings['fixed_template']) ? $settings['live_temp_content_extra'] : $settings['fixed_template'];
                        echo $this->get_el_template_content($template_title); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </div>
                    <?php
                }
                if (0 !== $count) {
                    ?>
                    <div class="eead-hscroll-arrow eead-hscroll-arrow-left">
                        <div class="eead-hscroll-wrap-icon">
                            <?php
                            Icons_Manager::render_icon(
                                $settings['nav_arrow_left'], array(
                                    'class' => 'eead-hscroll-prev',
                                    'aria-hidden' => 'true',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="eead-hscroll-slider">
                    <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'scroller_wrap' ) ); ?>>
                        <div class="eead-hscroll-sections-wrap" data-scroll-opacity="<?php echo esc_attr( $opacity ); ?>">
                            <?php
                            foreach ($templates as $index => $section) {
                                $this->add_render_attribute(
                                    'section_' . $index, [
                                        'id' => 'section_' . $widget_id . $index,
                                        'class' => 'eead-hscroll-temp',
                                        'data-hide' => $section['hide_section'],
                                    ]
                                );

                                if ('id' === $section['template_type']) {
                                    $this->add_render_attribute(
                                        'section_' . $index, [
                                            'data-section' => $section['section_id'],
                                        ]
                                    );
                                } else {
                                    if (!empty($section['anchor_id'])) {
                                        $this->add_render_attribute(
                                            'section_' . $index, [
                                                'data-section' => $section['anchor_id'],
                                            ]
                                        );
                                    }
                                }
                                if ($opacity) {
                                    if (0 !== $index && !$settings['rtl_mode']) {
                                        $this->add_render_attribute('section_' . $index, 'class', 'eead-hscroll-hide');
                                    } elseif ($count - 1 !== $index && $settings['rtl_mode']) {
                                        $this->add_render_attribute('section_' . $index, 'class', 'eead-hscroll-hide');
                                    }
                                }
                                ?>
                                <div <?php $this->print_render_attribute_string('section_' . $index); ?>>
                                    <?php
                                    if ('template' === $section['template_type']) {
                                        $template_title = empty($section['section_template']) ? $section['live_temp_content'] : $section['section_template'];
                                        echo wp_kses_post($this->get_template_content($template_title));
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div <?php $this->print_render_attribute_string('progress_wrap'); ?>>
                            <div <?php $this->print_render_attribute_string('progress'); ?>></div>
                        </div>
                    </div>
                </div>
                <?php if (0 !== $count) { ?>
                    <div class="eead-hscroll-arrow eead-hscroll-arrow-right">
                        <div class="eead-hscroll-wrap-icon">
                            <?php
                            Icons_Manager::render_icon(
                                $settings['nav_arrow_right'], [
                                    'class' => 'eead-hscroll-next',
                                    'aria-hidden' => 'true',
                                ]
                            );
                            ?>
                        </div>
                    </div>

                    <div <?php $this->print_render_attribute_string('nav'); ?>>
                        <ul class="eead-hscroll-nav-list dots">
                            <?php
                            foreach ($templates as $index => $section) :
                                $this->add_render_attribute(
                                    'item_' . $index, [
                                        'class' => 'eead-hscroll-nav-item',
                                        'data-slide' => 'section_' . $widget_id . $index,
                                    ]
                                );
                                ?>
                                <li <?php $this->print_render_attribute_string('item_' . $index); ?>>
                                    <span class="eead-hscroll-nav-dot"></span>
                                    <?php if ('true' === $settings['tooltips'] && ! empty($tooltips[$index])) : ?>
                                        <span class="eead-hscroll-nav-tooltip"><?php echo esc_html($tooltips[$index]); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php
                }
                if (0 !== $count && $settings['pagination_number']) {
                    ?>
                    <div class="eead-hscroll-pagination">
                        <span class="eead-hscroll-page-item eead-hscroll-current-slide">01</span>
                        <span class="eead-hscroll-page-item eead-hscroll-total-slides">
                            <?php echo wp_kses_post($count > 9 ? $count : sprintf('0%s', $count)); ?>
                        </span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    public function get_template_content( $title ) {
        $frontend = Plugin::$instance->frontend;
        $id = $this->get_id_by_title( $title );
        $id = apply_filters( 'wpml_object_id', $id, 'elementor_library', true );
        $template_content = $frontend->get_builder_content_for_display( $id, true );
        return $template_content;
    }

    public function get_id_by_title( $title ) {
        $query = new \WP_Query(
            array(
                'post_type' => 'elementor_library',
                'title' => $title,
                'post_status' => 'all',
                'posts_per_page' => 1,
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false,
                'orderby' => 'post_date ID',
                'order' => 'ASC',
            )
        );
         
        if (!empty($query->post)) {
            $template = $query->post;
        } else {
            $template = null;
        }
        $template_id = isset($template->ID) ? $template->ID : $title;
        return $template_id;
    }

    public function get_el_template_content($title, $id = false) {
        $frontend = Plugin::$instance->frontend;
        if (!$id) {
            $id = $this->get_id_by_title($title);

            $id = apply_filters('wpml_object_id', $id, 'elementor_library', true);
        } else {
            $id = $title;
        }
        $template_content = $frontend->get_builder_content_for_display($id, true);
        return $template_content;
    }
}
