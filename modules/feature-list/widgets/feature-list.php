<?php

namespace EasyElementorAddons\Modules\FeatureList\Widgets;

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class FeatureList extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-feature-list';
    }

    /** Widget Title */
    public function get_title() {
        return __('Feature List', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-editor-h1';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'eead_section_feature_list_content_settings', [
                'label' => __('Content Settings', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'eead_feature_list_icon_type', [
                'label' => __('Icon Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'easy-elementor-addons'),
                        'icon'  => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __('Image', 'easy-elementor-addons'),
                        'icon' => 'eicon-image',
                    ],
                ],
                'default'     => 'icon',
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'eead_feature_list_icon_new', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'eead_feature_list_icon',
                'condition' => [
                    'eead_feature_list_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_img', [
                'label' => __('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'eead_feature_list_icon_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_title', [
                'label' => __('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Title', 'easy-elementor-addons'),
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_subtitle', [
                'label' => __('Subtitle', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_content', [
                'label' => __('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'easy-elementor-addons'),
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_link', [
                'label' => __('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => __('https://your-link.com', 'easy-elementor-addons'),
            ]
        );

        // Each icon custom color style
        $repeater->add_control(
            'eead_feature_list_icon_enable_each_style', [
                'label' => __('Custom Icon Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('ON', 'easy-elementor-addons'),
                'label_off' => __('OFF', 'easy-elementor-addons'),
                'return_value' => 'on',
                'default' => '',
                'fa4compatibility' => 'eead_feature_list_icon',
                'condition' => [
                    'eead_feature_list_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_icon_individual_color', [
                'label' => __('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'fa4compatibility' => 'eead_feature_list_icon',
                'condition' => [
                    'eead_feature_list_icon_enable_each_style' => 'on',
                ],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_icon_individual_bg_color', [
                'label' => __('Icon Background', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'fa4compatibility' => 'eead_feature_list_icon',
                'condition' => [
                    'eead_feature_list_icon_enable_each_style' => 'on',
                ],
            ]
        );

        $repeater->add_control(
            'eead_feature_list_icon_individual_box_bg_color', [
                'label' => __('Icon Box Background', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'fa4compatibility' => 'eead_feature_list_icon',
                'condition' => [
                    'eead_feature_list_icon_enable_each_style' => 'on',
                ],
            ]
        );

        $this->add_control(
            'eead_feature_list', [
                'label' => __('Feature Item', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    [
                        'eead_feature_list_icon_new' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'eead_feature_list_title' => __('Feature List Item 1', 'easy-elementor-addons'),
                        'eead_feature_list_subtitle' => 'Consectetur adipisi cing elit',
                        'eead_feature_list_content' => 'Lorem ipsum dolor sit amet, consectetur adipisi cing elit, sed do eiusmod tempor incididunt ut abore et dolore magna',
                    ],
                    [
                        'eead_feature_list_icon_new' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'eead_feature_list_title' => __('Feature List Item 2', 'easy-elementor-addons'),
                        'eead_feature_list_subtitle' => 'Rem ipsum dolor sit amet', 'easy-elementor-addons',
                        'eead_feature_list_content' => 'Lorem ipsum dolor sit amet, consectetur adipisi cing elit, sed do eiusmod tempor incididunt ut abore et dolore magna',
                    ],
                    [
                        'eead_feature_list_icon_new' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'eead_feature_list_title' => __('Feature List Item 3', 'easy-elementor-addons'),
                        'eead_feature_list_subtitle' => 'Seo eiusmod tempor incididunt ut',
                        'eead_feature_list_content' => 'Lorem ipsum dolor sit amet, consectetur adipisi cing elit, sed do eiusmod tempor incididunt ut abore et dolore magna',
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{eead_feature_list_icon_new.value}}" aria-hidden="true"></i> {{{eead_feature_list_title}}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_feature_list_additional_settings', [
                'label' => __('Additional Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'eead_feature_list_title_size', [
                'label' => __('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'eead_feature_list_icon_shape', [
                'label' => __('Icon Shape', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'circle',
                'label_block' => false,
                'options' => [
                    'circle' => __('Circle', 'easy-elementor-addons'),
                    'square' => __('Square', 'easy-elementor-addons'),
                    'rhombus' => __('Rhombus', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'eead_feature_list_icon_layout', [
                'label' => __('Icon Box Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'stacked',
                'label_block' => false,
                'options' => [
                    'framed' => __('Framed', 'easy-elementor-addons'),
                    'stacked' => __('Stacked', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_icon_position', [
                'label' => __('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'top' => [
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 'left',
                'tablet_default' => 'left',
                'mobile_default' => 'left',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_text_align', [
                'label' => __('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'condition' => [
                    'eead_feature_list_icon_position' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_space_between', [
                'label' => __('Space Between', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-items .eead-feature-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .eead-feature-list-items .eead-feature-list-item:not(:first-child)' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .eead-feature-list-items.connector-type-modern .eead-feature-list-item:not(:last-child):before' => 'height: calc(100% + {{SIZE}}{{UNIT}})',
                    'body.rtl {{WRAPPER}} .eead-feature-list-items .eead-feature-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->end_controls_section();

        /* Icon Style */
        $this->start_controls_section(
            'eead_section_feature_list_style_icon', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'eead_feature_list_icon_background',
                'types' => ['classic', 'gradient'],
                'exclude'  => [
                    'image',
                ],
                'color' => [
                    'default' => '#3858f4',
                ],
                'selector' => '{{WRAPPER}} .eead-feature-list-items .eead-feature-list-icon-box .eead-feature-list-icon-inner',
            ]
        );

        $this->add_control(
            'eead_feature_list_secondary_color', [
                'label' => __('Secondary Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-items.framed .eead-feature-list-icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'eead_feature_list_icon_layout' => 'framed',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'eead_feature_list_icon_color', [
                'label' => __( 'Color', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-items .eead-feature-list-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-feature-list-items .eead-feature-list-icon svg' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_icon_circle_size', [
                'label' => __('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 70,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-feature-list-items.connector-type-classic .connector' => 'right: calc(100% - {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_icon_size', [
                'label' => __('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 21,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-feature-list-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_icon_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eead_feature_list_icon_border_width', [
                'label' => __('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon-inner' => 'padding: {{SIZE}}{{UNIT}};',

                ],
                'condition' => [
                    'eead_feature_list_icon_layout' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'eead_feature_list_icon_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-feature-list-icon-box .eead-feature-list-icon-inner .eead-feature-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_feature_list_icon_layout' => 'framed',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_icon_space', [
                'label' => __('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'tablet_default'  => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'mobile_default'  => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .-icon-position-left .eead-feature-list-content-box, {{WRAPPER}} .-icon-position-right .eead-feature-list-content-box, {{WRAPPER}} .-icon-position-top .eead-feature-list-content-box' => 'margin: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .-mobile-icon-position-left .eead-feature-list-content-box' => 'margin: 0 0 0 {{SIZE}}{{UNIT}} !important;',
                    '(mobile){{WRAPPER}} .-mobile-icon-position-right .eead-feature-list-content-box' => 'margin: 0 {{SIZE}}{{UNIT}} 0 0 !important;',
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_align', [
                'label' => __('Vertical Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'eead_feature_list_icon_position!' => 'top'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_feature_list_title_style', [
                'label' => __('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'eead_feature_list_title_bottom_space', [
                'label' => __('Title Bottom Space', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-item .eead-feature-list-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'eead_feature_list_title_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#414247',
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-title, {{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-title > a, {{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-title:visited' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_feature_list_title_typography',
                'selector' => '{{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-title, {{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-title a',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_feature_list_description_style', [
                'label' => __('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_feature_list_description_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_feature_list_description_typography',
                'selector' => '{{WRAPPER}} .eead-feature-list-content-box .eead-feature-list-content',
                'fields_options' => [
                    'font_size' => ['default' => ['unit' => 'px', 'size' => 16]],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_section_feature_list_subtitle_style', [
                'label' => __('Subtitle', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_feature_list_subtitle_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-feature-list-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_feature_list_subtitle_typography',
                'selector' => '{{WRAPPER}} .eead-feature-list-subtitle',
                'fields_options' => [
                    'font_size' => ['default' => ['unit' => 'px', 'size' => 13]],
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('eead_feature_list', [
            'id' => 'eead-feature-list-' . esc_attr($this->get_id()),
            'class' => [
                'eead-feature-list-items',
                $settings['eead_feature_list_icon_shape'],
                $settings['eead_feature_list_icon_layout'],
            ],
        ]);

        $this->add_render_attribute(
            'eead_feature_list_wrapper', [
                'class' => [
                    '-icon-position-' . $settings['eead_feature_list_icon_position'],
                    '-tablet-icon-position-' . (isset($settings['eead_feature_list_icon_position_tablet']) ? $settings['eead_feature_list_icon_position_tablet'] : 'left'),
                    '-mobile-icon-position-' . (isset($settings['eead_feature_list_icon_position_mobile']) ? $settings['eead_feature_list_icon_position_mobile'] : 'left'),
                ],
            ]
        );
        ?>
        <div class="eead-feature-list-main-wrapper">
            <div <?php $this->print_render_attribute_string('eead_feature_list_wrapper'); ?>>
                <ul <?php $this->print_render_attribute_string('eead_feature_list'); ?>>

                    <?php foreach ($settings['eead_feature_list'] as $index => $item) { 

                        $this->add_render_attribute('eead_feature_list_icon' . $index, 'class', 'eead-feature-list-icon fl-icon-'.$index);
                        $this->add_render_attribute('eead_feature_list_title' . $index, 'class', 'eead-feature-list-title');
                        $this->add_render_attribute('eead_feature_list_content' . $index, 'class', 'eead-feature-list-content');

                        // Icon
                        $icon_color = ($item['eead_feature_list_icon_enable_each_style'] == 'on' && isset($item['eead_feature_list_icon_individual_color'])) ? esc_attr($item['eead_feature_list_icon_individual_color']) : '' ;
                        $icon_bg = (($item['eead_feature_list_icon_enable_each_style'] == 'on') ? ' style="background-color:' . esc_attr($item['eead_feature_list_icon_individual_bg_color']) . '"' : '');
                        $icon_box_bg = (($item['eead_feature_list_icon_enable_each_style'] == 'on') ? ' style="background-color:' . esc_attr($item['eead_feature_list_icon_individual_box_bg_color']) . '"' : '');

                        $feature_title_tag = $settings['eead_feature_list_title_size'];

                        if ($item['eead_feature_list_link']['url']) {
                            $this->add_render_attribute('eead_feature_list_title_anchor' . $index, [
                                'href' =>  esc_url($item['eead_feature_list_link']['url']),
                                'target' => $item['eead_feature_list_link']['is_external'] ? '_blank' : '_self',
                                'rel' => $item['eead_feature_list_link']['nofollow'] ? 'nofollow' : ''
                            ]);

                            $this->add_render_attribute('eead_feature_list_link' . $index, [
                                'href' => $item['eead_feature_list_link']['url'],
                                'target' => $item['eead_feature_list_link']['is_external'] ? '_blank' : '',
                                'rel' => $item['eead_feature_list_link']['nofollow'] ? 'nofollow' : ''
                            ]);
                        }

                        $feature_icon_tag = ($item['eead_feature_list_link']['url'] ? 'a' : 'span');
                        $feature_list_icon_box_css = ($settings['eead_feature_list_icon_position'] == 'left' || $settings['eead_feature_list_icon_position'] == 'right') ? 'style="display: flex; align-items: ' . $settings['icon_vertical_align'] . '"' : null; 
                        ?>
                        <li class="eead-feature-list-item">
                            <div class="eead-feature-list-icon-box" <?php echo $feature_list_icon_box_css; ?>>
                                <div class="eead-feature-list-icon-inner"<?php echo $icon_box_bg; ?>>
                                    <<?php echo esc_attr($feature_icon_tag) . ' ' . $this->get_render_attribute_string('eead_feature_list_icon' . $index) . $this->get_render_attribute_string( 'eead_feature_list_link' . $index) . $icon_bg; ?>>
                                    <?php  
                                    if ($item['eead_feature_list_icon_type'] == 'icon' && (!empty( $item['eead_feature_list_icon']) || !empty($item['eead_feature_list_icon_new']))) {

                                        if (empty( $item['eead_feature_list_icon']) || isset($item['__fa4_migrated']['eead_feature_list_icon_new'])) {
                                            if ($item['eead_feature_list_icon_new']['library'] == 'svg' && $icon_color) {
                                                ?>
                                                <style>
                                                    #eead-feature-list-<?php echo esc_attr($this->get_id()); ?> .eead-feature-list-icon.fl-icon-<?php echo esc_attr($index); ?> svg {
                                                        color: <?php echo $icon_color; ?> !important; 
                                                        fill: <?php echo $icon_color; ?> !important;
                                                    }
                                                </style>
                                                <?php
                                            }
                                            Icons_Manager::render_icon($item['eead_feature_list_icon_new'], ['aria-hidden' => 'true', 'style' => "color:{$icon_color};"]);
                                        } else {
                                            echo '<i class="' . esc_attr($item['eead_feature_list_icon']) . '" aria-hidden="true"></i>';
                                        }
                                    }
                                    else if ($item['eead_feature_list_icon_type'] == 'image') {
                                        $this->add_render_attribute( 
                                            'feature_list_image' . $index, [
                                                'src' => esc_url($item['eead_feature_list_img']['url']),
                                                'class' => 'eead-feature-list-img',
                                                'alt' => esc_attr(get_post_meta( $item['eead_feature_list_img']['id'], '_wp_attachment_image_alt', true)),
                                            ]
                                        );
                                        echo '<img ' . $this->get_render_attribute_string('feature_list_image' . $index) . '>';
                                    }
                                    ?>
                                    </<?php echo esc_attr($feature_icon_tag); ?>>
                                </div>
                            </div>

                            <div class="eead-feature-list-content-box">
                                <<?php echo esc_attr($feature_title_tag) . ' ' . $this->get_render_attribute_string('eead_feature_list_title' . $index); ?>> 
                                    <?php if (!empty( $item['eead_feature_list_link']['url'] )) { ?>
                                        <a <?php $this->print_render_attribute_string('eead_feature_list_title_anchor' . $index) ?>>
                                    <?php } ?>
                                        <?php echo wp_kses_post($item['eead_feature_list_title']); ?>
                                    <?php if (!empty($item['eead_feature_list_link']['url'])) { ?>
                                        </a>
                                    <?php } ?>
                                </<?php echo esc_attr($feature_title_tag); ?>>

                                <div class="eead-feature-list-subtitle">
                                    <?php echo esc_html($item['eead_feature_list_subtitle']); ?>
                                </div>

                                <p <?php $this->print_render_attribute_string('eead_feature_list_content' . $index); ?>>
                                    <?php echo wp_kses_post($item['eead_feature_list_content']); ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php
    }
}
