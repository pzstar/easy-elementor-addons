<?php

namespace EasyElementorAddons\Modules\AdvancedIconBox\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Icons_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Advanced Icon Widget
 */
class AdvancedIconBox extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-advanced-icon-box';
    }

    /** Widget Title */
    public function get_title() {
        return __('Advanced Icon Box', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['waypoint', 'uikit'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_content_icon_box', [
                'label' => __('Icon Box', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'icon_type', [
                'label' => __('Icon Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'icon',
                'prefix_class' => 'eead-icon-type-',
                'render_type' => 'template',
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'easy-elementor-addons'),
                        'icon' => 'eicon-star'
                    ],
                    'image' => [
                        'title' => __('Image', 'easy-elementor-addons'),
                        'icon' => 'eicon-image'
                    ]
                ]
            ]
        );

        $this->add_control(
            'selected_icon', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'fa-solid',
                ],
                'render_type' => 'template',
                'condition' => [
                    'icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
            'image', [
                'label' => __('Image Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'title_text', [
                'label' => __('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Icon Box Heading', 'easy-elementor-addons'),
                'placeholder' => __('Enter your title', 'easy-elementor-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_title_text', [
                'label' => __('Subtitle Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Icon Box Sub Heading', 'easy-elementor-addons'),
                'placeholder' => __('Enter your sub title', 'easy-elementor-addons'),
                'label_block' => true,
                'condition' => [
                    'show_sub_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_separator', [
                'label' => __('Title Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,           
            ]
        );

        $this->add_control(
            'description_text', [
                'label' => __('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'easy-elementor-addons'),
                'placeholder' => __('Enter your description', 'easy-elementor-addons'),
                'rows' => 10
            ]
        );

        $this->add_control(
            'position', [
                'label' => __('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'default' => 'top',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle' => false,
                'render_type' => 'template',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'selected_icon[value]',
                            'operator' => '!=',
                            'value' => ''
                        ],
                        [
                            'name' => 'image[url]',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'icon_inline', [
                'label' => __('Icon Inline', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'position' => ['left', 'right']
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_alignment', [
                'label' => __('Icon Vertical Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'toggle' => false,
                'prefix_class' => 'elementor-vertical-align-',
                'condition' => [
                    'position' => ['left', 'right'],
                    'icon_inline' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align', [
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
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_readmore', [
                'label' => __('Read More', 'easy-elementor-addons'),
                'condition' => [
                    'readmore' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'readmore_text', [
                'label' => __('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => __('Read More', 'easy-elementor-addons'),
                'placeholder' => __('Read More', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'readmore_link', [
                'label' => __('Link to', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'easy-elementor-addons'),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'readmore' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'advanced_readmore_icon', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'readmore_icon',
                'separator' => 'before',
                'label_block' => true,
                'condition' => [
                    'readmore' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'readmore_icon_align', [
                'label' => __('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left' => __( 'Left', 'easy-elementor-addons' ),
                    'right' => __( 'Right', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'advanced_readmore_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'readmore_icon_indent', [
                'label' => __('Icon Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'advanced_readmore_icon[value]!' => '',
                    'readmore_text!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore .eead-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore .eead-button-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'readmore_on_hover', [
                'label' => __('Show on Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'eead-readmore-on-hover-',
            ]
        );

        $this->add_responsive_control(
            'readmore_horizontal_offset', [
                'label' => __('Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -50,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'readmore_on_hover' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_vertical_offset', [
                'label' => __('Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}}.eead-readmore-on-hover-yes .eead-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset.SIZE || 0}}px, {{readmore_vertical_offset.SIZE || 0}}px);',
                    '(tablet){{WRAPPER}}.eead-readmore-on-hover-yes .eead-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset_tablet.SIZE || 0}}px, {{readmore_vertical_offset_tablet.SIZE || 0}}px);',
                    '(mobile){{WRAPPER}}.eead-readmore-on-hover-yes .eead-advanced-icon-box-readmore' => 'transform: translate({{readmore_horizontal_offset_mobile.SIZE || 0}}px, {{readmore_vertical_offset_mobile.SIZE || 0}}px);',
                ],
                'condition' => [
                    'readmore_on_hover' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_badge', [
                'label' => __('Badge', 'easy-elementor-addons'),
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text', [
                'label' => __('Badge Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('New', 'easy-elementor-addons'),
                'placeholder' => 'Type Badge Title',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'badge_position', [
                'label' => __('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => get_element_position(),
            ]
        );

        $this->add_responsive_control(
            'badge_horizontal_offset', [
                'label' => __('Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'step' => 2,
                        'max' => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_vertical_offset', [
                'label' => __('Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_rotate', [
                'label' => __('Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset.SIZE || 0}}px, {{badge_vertical_offset.SIZE || 0}}px) rotate({{badge_rotate.SIZE || 0}}deg);',
                    '(tablet){{WRAPPER}} .eead-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset_tablet.SIZE || 0}}px, {{badge_vertical_offset_tablet.SIZE || 0}}px) rotate({{badge_rotate_tablet.SIZE || 0}}deg);',
                    '(mobile){{WRAPPER}} .eead-advanced-icon-box-badge' => 'transform: translate({{badge_horizontal_offset_mobile.SIZE || 0}}px, {{badge_vertical_offset_mobile.SIZE || 0}}px) rotate({{badge_rotate_mobile.SIZE || 0}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional', [
                'label' => __('Additional Options', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'readmore', [
                'label' => __('Read More Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'badge', [
                'label' => __('Badge', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'title_size', [
                'label' => __('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
            ]
        );

        $this->add_responsive_control(
            'top_icon_vertical_offset', [
                'label' => __('Icon Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'position' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'top_icon_horizontal_offset', [
                'label' => __('Icon Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'position' => 'top',
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{top_icon_horizontal_offset.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset.SIZE}}px);',
                    '(tablet){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{top_icon_horizontal_offset_tablet.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset_tablet.SIZE}}px);',
                    '(mobile){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{top_icon_horizontal_offset_mobile.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset_mobile.SIZE}}px);',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_right_icon_horizontal_offset', [
                'label' => __('Icon Horizontal Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'position' => ['left', 'right'],
                ],
            ]
        );

        $this->add_responsive_control(
            'left_right_icon_vertical_offset', [
                'label' => __('Icon Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'condition' => [
                    'position' => ['left', 'right'],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{left_right_icon_horizontal_offset.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset.SIZE}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{left_right_icon_horizontal_offset_tablet.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset_tablet.SIZE}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .eead-advanced-icon-box-icon' => 'transform: translate({{left_right_icon_horizontal_offset_mobile.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset_mobile.SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_style_icon_box', [
                'label' => __('Icon/Image', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'selected_icon[value]',
                            'operator' => '!=',
                            'value' => ''
                        ],
                        [
                            'name' => 'image[url]',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ]
            ]
        );

        $this->start_controls_tabs('icon_colors');

        $this->start_controls_tab(
            'icon_colors_normal', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'icon_color', [
                'label' => __('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'show_svg_icon_color', [
                'label' => __('Enable Svg Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_fill_color', [
                'label' => __('Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                    'show_svg_icon_color' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_stroke_color', [
                'label' => __('Stroke Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper svg' => 'stroke: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                    'show_svg_icon_color' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'icon_background',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'icon_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'icon_border',
                'placeholder' => '1px',
                'separator' => 'before',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper'
            ]
        );

        $this->add_control(
            'icon_radius', [
                'label' => __('Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [
                    'icon_radius_advanced_show!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_radius_advanced_show', [
                'label' => __('Advanced Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_radius_advanced', [
                'label' => __('Radius', 'easy-elementor-addons'),
                'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', 'easy-elementor-addons'), '75% 25% 43% 57% / 46% 29% 71% 54%', 'https://9elements.github.io/fancy-border-radius/'),
                'type' => Controls_Manager::TEXT,
                'size_units' => [ 'px', '%' ],
                'separator' => 'after',
                'default' => '75% 25% 43% 57% / 46% 29% 71% 54%',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper'     => 'border-radius: {{VALUE}}; overflow: hidden;',
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper img' => 'border-radius: {{VALUE}}; overflow: hidden;'
                ],
                'condition' => [
                    'icon_radius_advanced_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'icon_shadow',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper',
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space', [
                'label' => __('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'separator' => 'before',
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .eead-advanced-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-left .eead-advanced-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-top .eead-advanced-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-advanced-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_fullwidth', [
                'label' => __('Image Fullwidth', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'width: 100%;box-sizing: border-box;',
                ],
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size', [
                'label' => __( 'Size', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'vh', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name' => 'image_fullwidth',
                            'operator' => '==',
                            'value' => ''
                        ],
                        [
                            'name' => 'icon_type',
                            'operator' => '==',
                            'value' => 'icon'
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'rotate', [
                'label' => __( 'Rotate', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_background_rotate', [
                'label' => __('Background Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_heading', [
                'label' => __('Image Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity', [
                'label' => __('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'background_hover_transition', [
                'label' => __('Transition Duration', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box img' => 'transition-duration: {{SIZE}}s',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'icon_hover_color', [
                'label' => __('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_hover_fill_color', [
                'label' => __('Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                    'show_svg_icon_color' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_hover_stroke_color', [
                'label' => __('Stroke Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper svg' => 'stroke: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                    'show_svg_icon_color' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'icon_hover_background',
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper:after',
            ]
        );

        $this->add_control(
            'icon_hover_animation', [
                'label' => __('Hover Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_control(
            'icon_hover_border_color', [
                'label' => __('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper'  => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_radius', [
                'label' => __('Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'  'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper'
            ]
        );

        $this->add_control(
            'icon_hover_rotate', [
                'label' => __('Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max'  => 360,
                        'min'  => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_rotate', [
                'label' => __('Background Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_hover_heading', [
                'label' => __('Image Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name' => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity_hover', [
                'label' => __('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-icon-wrapper img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title', [
                'label' => __('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_style_normal', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space', [
                'label' => __('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_style_hover', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_color_hover', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography_hover',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_title', [
                'label' => __('Sub Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_sub_title' => 'yes',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'sub_title_bottom_space', [
                'label' => __('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_sub_title_style');

        $this->start_controls_tab(
            'tab_sub_title_style_normal', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'sub_title_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-sub-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_sub_title_style_hover', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'sub_title_color_hover', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'sub_title_typography_hover',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-sub-title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_description', [
                'label' => __('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_responsive_control(
            'description_bottom_space', [
                'label' => __('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_description_style' );

        $this->start_controls_tab(
            'tab_description_style_normal', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'description_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-content .eead-advanced-icon-box-description',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_description_style_hover', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'description_color_hover', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'description_typography_hover',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box:hover .eead-advanced-icon-box-content .eead-advanced-icon-box-description',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_title_separator', [
                'label' => __('Title Separator', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_separator_type', [
                'label' => __('Select Separator Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'line',
                'options' => [
                    'line' => __('Line', 'easy-elementor-addons'),
                    'line-circle' => __('Line Circle', 'easy-elementor-addons'),
                    'line-cross' => __('Line Cross', 'easy-elementor-addons'),
                    'line-star' => __('Line Star', 'easy-elementor-addons'),
                    'line-dashed' => __('Line Dashed', 'easy-elementor-addons'),
                    'heart' => __('Heart', 'easy-elementor-addons'),
                    'dashed' => __('Dashed', 'easy-elementor-addons'),
                    'floret' => __('Floret', 'easy-elementor-addons'),
                    'rectangle' => __('Rectangle', 'easy-elementor-addons'),
                    'leaf' => __('Leaf', 'easy-elementor-addons'),
                    'slash' => __('Slash', 'easy-elementor-addons'),
                    'triangle' => __('Triangle', 'easy-elementor-addons'),
                    'wave' => __('Wave', 'easy-elementor-addons'),
                    'kiss-curl' => __('Kiss Curl', 'easy-elementor-addons'),
                    'zemik' => __('Zemik', 'easy-elementor-addons'),
                    'finest' => __('Finest', 'easy-elementor-addons'),
                    'furrow' => __('Furrow', 'easy-elementor-addons'),
                    'peak' => __('Peak', 'easy-elementor-addons'),
                    'melody' => __('Melody', 'easy-elementor-addons'),
                    'bloomstar' => __('Bloomstar', 'easy-elementor-addons'),
                    'bobbleaf' => __('Bobbleaf', 'easy-elementor-addons'),
                    'demaxa' => __('Demaxa', 'easy-elementor-addons'),
                    'fill-circle' => __('Fill Circle', 'easy-elementor-addons'),
                    'finalio' => __('Finalio', 'easy-elementor-addons'),
                    'jemik' => __('Jemik', 'easy-elementor-addons'),
                    'separk' => __('Separk', 'easy-elementor-addons'),
                    'zigzag-dot' => __('Zigzag Dot', 'easy-elementor-addons'),
                    'zozobe' => __('Zozobe', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'divider_align', [
                'label' => __('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper' => 'text-align: {{VALUE}}; margin: 0 auto; margin-{{VALUE}}: 0;',
                ],
                'condition' => [
                    'title_separator_type!' => ['line', 'dashed', 'line-circle', 'line-cross', 'line-dashed', 'line-star', 'slash', 'rectangle', 'triangle', 'wave', 'kiss-curl', 'zemik', 'finest', 'furrow']
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'divider_line_align', [
                'label' => __('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper' => 'text-align: {{VALUE}}; margin: 0 auto; margin-{{VALUE}}: 0;',
                ],
                'condition'   => [
                    'title_separator_type' => ['line', 'dashed', 'line-circle', 'line-cross', 'line-dashed', 'line-star', 'slash', 'rectangle', 'triangle', 'wave', 'kiss-curl', 'zemik', 'finest', 'furrow']
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'title_separator_border_style', [
                'label' => __('Separator Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid' => __('Solid', 'easy-elementor-addons'),
                    'dotted' => __('Dotted', 'easy-elementor-addons'),
                    'dashed' => __('Dashed', 'easy-elementor-addons'),
                    'groove' => __('Groove', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_separator_line_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_separator_height', [
                'label' => __('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 15,
                    ]
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_separator_width', [
                'label' => __('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ]
                ],
                'condition' => [
                    'title_separator_type' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_separator_svg_fill_color', [
                'label' => __('Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_separator_svg_stroke_color', [
                'label' => __('Stroke Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper svg *' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max_width', [
                'label' => __('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1200,
                        'min' => 100,
                    ],
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'line_cap', [
                'label' => __('Line Cap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ep_square',
                'options' => [
                    'ep_square' => __('Square', 'easy-elementor-addons'),
                    'ep_round' => __('Rounded', 'easy-elementor-addons'),
                    'ep_butt' => __('Butt', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_svg_stroke_width', [
                'label' => __('Stroke Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 10,
                        'min' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper svg *' => 'stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_crop', [
                'label' => __('Divider Crop', 'easy-elementor-addons'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper svg' => 'transform: scale({{SIZE}}) scale(0.01)',
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
            ]
        );

        $this->add_responsive_control(
            'max_height', [
                'label' => __('Match Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title_separator_type!' => 'line'
                ],
            ]
        );

        $this->add_control(
            'title_separator_spacing', [
                'label' => __('Separator Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-title-separator-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_readmore', [
                'label' => __('Read More', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'readmore' => 'yes',
                ],              
            ]
        );

        $this->start_controls_tabs('tabs_readmore_style');

        $this->start_controls_tab(
            'tab_readmore_normal', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'readmore_text_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'readmore_background',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore', 
                'separator' => 'before', 
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'readmore_border',
                'placeholder' => '1px',
                'separator' => 'before',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore'
            ]
        );

        $this->add_responsive_control(
            'readmore_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'readmore_shadow',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore',
            ]
        );

        $this->add_responsive_control(
            'readmore_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'readmore_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_readmore_hover', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'readmore_hover_text_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'readmore_hover_background',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore:hover',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'readmore_hover_border_color', [
                'label' => __('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-readmore:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'readmore_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'readmore_hover_shadow',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-readmore:hover',
            ]
        );

        $this->add_control(
            'readmore_hover_animation', [
                'label' => __('Hover Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge', [
                'label' => __('Badge', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color', [
                'label' => __('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-badge span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'badge_background',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-badge span', 
                'separator' => 'before', 
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'badge_border',
                'placeholder' => '1px',
                'separator' => 'before',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-badge span'
            ]
        );

        $this->add_responsive_control(
            'badge_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'after', 
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-badge span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'badge_shadow',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-badge span',
            ]
        );

        $this->add_responsive_control(
            'badge_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box-badge span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'badge_typography',
                'selector' => '{{WRAPPER}} .eead-advanced-icon-box-badge span',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_additional', [
                'label' => __('Additional', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding', [
                'label' => __('Content Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-advanced-icon-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'outer_box_padding', [
                'label' => __('Content Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_inline_spacing', [
                'label' => __('Icon Inline Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'position' => ['left', 'right'],
                    'icon_inline' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-advanced-icon-box .eead-icon-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_icon() {
        $settings = $this->get_settings_for_display();

        if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            // add old default
            $settings['icon'] = 'fa fa-star';
        }

        $has_icon  = !empty($settings['icon']);

        $has_image = !empty($settings['image']['url']);

        if ($has_icon && ('icon' == $settings['icon_type'])) {
            $this->add_render_attribute('font-icon', 'class', $settings['selected_icon']);
            $this->add_render_attribute('font-icon', 'aria-hidden', 'true');

        } elseif ($has_image && ('image' == $settings['icon_type'])) {
            $this->add_render_attribute('image-icon', 'src', $settings['image']['url']);
            $this->add_render_attribute('image-icon', 'alt', $settings['title_text']);
        }

        if (!$has_icon && !empty($settings['selected_icon']['value'])) {
            $has_icon = true;
        }

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        if ($has_icon or $has_image) { ?>
            <div class="eead-advanced-icon-box-icon">
                <span class="eead-icon-wrapper elementor-animation-<?php echo esc_attr($settings['icon_hover_animation']); ?>">

                    <?php
                    if ($has_icon && 'icon' == $settings['icon_type']) { 
                        if ($is_new || $migrated) {
                            Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
                        } else {
                            ?>
                            <i <?php $this->print_render_attribute_string('font-icon'); ?>></i>
                            <?php
                        }

                    } elseif ($has_image && 'image' == $settings['icon_type'] ) {
                        ?>
                        <img <?php $this->print_render_attribute_string('image-icon'); ?>>
                    <?php } ?>
                </span>
            </div>
            <?php
        }
    }

    protected function render_icon_heading() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('advanced-icon-box-title', 'class', 'eead-advanced-icon-box-title');

        if ('yes' == $settings['icon_inline']) {
            $this->add_render_attribute('advanced-icon-box-icon-heading', 'class', 'eead-icon-heading eead-flex eead-flex-middle');
        }

        if ('right' == $settings['position']) {
            $this->add_render_attribute('advanced-icon-box-icon-heading', 'class', 'eead-flex-row-reverse');
        }

        $this->add_render_attribute('advanced-icon-box-sub-title', 'class', 'eead-advanced-icon-box-sub-title');

        ?>
        <div <?php $this->print_render_attribute_string('advanced-icon-box-icon-heading'); ?>>

            <?php $this->render_icon(); ?>

            <div class="eead-icon-box-title-wrapper">

                <?php
                if ($settings['title_text']) {
                    ?>
                    <<?php echo esc_html($settings['title_size']); ?> class="eead-advanced-icon-box-title">
                        <span <?php echo $this->get_render_attribute_string('title_text'); ?>>
                            <?php echo wp_kses($settings['title_text'], eead_allow_tags('title')); ?>
                        </span>
                    </<?php echo esc_html($settings['title_size']); ?>>
                    <?php
                }

                if (isset($settings['sub_title_text']) && !empty($settings['sub_title_text'])) {
                    ?>
                    <div <?php echo $this->get_render_attribute_string('advanced-icon-box-sub-title'); ?>>
                        <?php echo wp_kses($settings['sub_title_text'], eead_allow_tags('title')); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function render_heading() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('advanced-icon-box-title', 'class', 'eead-advanced-icon-box-title');

        $this->add_render_attribute('advanced-icon-box-sub-title', 'class', 'eead-advanced-icon-box-sub-title');
        if ($settings['title_text']) {
            ?>
            <<?php echo esc_html($settings['title_size']); ?> class="eead-advanced-icon-box-title">
                <span <?php echo $this->get_render_attribute_string('title_text'); ?>>
                    <?php echo wp_kses($settings['title_text'], eead_allow_tags('title')); ?>
                </span>
            </<?php echo esc_html($settings['title_size']); ?>>
            <?php
        }

        if (isset($settings['sub_title_text']) && !empty($settings['sub_title_text'])) {
            ?>
            <div <?php echo $this->get_render_attribute_string('advanced-icon-box-sub-title'); ?>>
                <?php echo wp_kses($settings['sub_title_text'], eead_allow_tags('title')); ?>
            </div>
            <?php
        }
    }

    public function render_svg_image() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'svg-image', [
            'class' => 'eead-animation-stroke',
            'eead-svg' => 'stroke-animation: true;'
        ]);

        $align = ($settings['divider_align'] == 'left' || $settings['divider_align'] == 'right') ? '-' . $settings['divider_align'] : '';
        $svg_image = EEAD_ASSETS_URL . 'img/divider/' . $settings['title_separator_type'] . $align . '.svg';

        $line_cap = $settings['line_cap'];
        ?>
        <img class="eead-animation-stroke <?php echo esc_attr($line_cap); ?>" src="<?php echo esc_url($svg_image); ?>" alt="advanced animation stroke">
        <?php
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('description_text', 'class', 'eead-advanced-icon-box-description');
        $this->add_inline_editing_attributes('title_text', 'none');
        $this->add_inline_editing_attributes('description_text');

        $this->add_render_attribute('readmore', 'class', ['eead-advanced-icon-box-readmore', 'eead-display-inline-block']);

        if (!empty($settings['readmore_link']['url'])) {
            $this->add_render_attribute('readmore', 'href', $settings['readmore_link']['url']);

            if ($settings['readmore_link']['is_external']) {
                $this->add_render_attribute('readmore', 'target', '_blank');
            }

            if ($settings['readmore_link']['nofollow']) {
                $this->add_render_attribute('readmore', 'rel', 'nofollow');
            }
        }

        if ($settings['readmore_hover_animation']) {
            $this->add_render_attribute('readmore', 'class', 'elementor-animation-' . $settings['readmore_hover_animation']);
        }

        $this->add_render_attribute('advanced-icon-box', 'class', 'eead-advanced-icon-box');        

        if (!isset($settings['readmore_icon']) && !Icons_Manager::is_migration_allowed()) {
            // add old default
            $settings['readmore_icon'] = 'fas fa-arrow-right';
        }

        $readmore_migrated = isset($settings['__fa4_migrated']['advanced_readmore_icon']);
        $readmore_is_new = empty($settings['readmore_icon']) && Icons_Manager::is_migration_allowed();
        ?>
        <div <?php $this->print_render_attribute_string('advanced-icon-box'); ?>>

            <?php
            if ('' == $settings['icon_inline']) {
                $this->render_icon();
            }
            ?>

            <div class="eead-advanced-icon-box-content">

                <?php
                if ('yes' == $settings['icon_inline']) {
                    $this->render_icon_heading();

                } else {
                    $this->render_heading();
                }
 
                if ($settings['show_separator']) {

                    if ('line' == $settings['title_separator_type']) {
                        ?>
                        <div class="eead-title-separator-wrapper">
                            <div class="eead-title-separator"></div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="eead-title-separator-wrapper">
                            <?php $this->render_svg_image(); ?>
                        </div>
                        <?php
                    }
                }
                ?>

                <?php
                if ($settings['description_text']) {
                    ?>
                    <div <?php $this->print_render_attribute_string('description_text'); ?>>
                        <?php echo $this->parse_text_editor($settings['description_text']); ?>
                    </div>
                    <?php
                }
                ?>

                <?php
                if ($settings['readmore']) {
                    ?>
                    <a <?php echo $this->get_render_attribute_string( 'readmore' ); ?>>
                        <?php echo esc_html($settings['readmore_text']); 
                        if ($settings['advanced_readmore_icon']['value']) : ?>

                            <span class="eead-button-icon-align-<?php echo $settings['readmore_icon_align'] ?>">
                                <?php if ( $readmore_is_new || $readmore_migrated ) :
                                    Icons_Manager::render_icon( $settings['advanced_readmore_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] );
                                else : ?>
                                    <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                                <?php endif; ?>
                            </span>

                        <?php endif; ?>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php if ($settings['badge'] && '' != $settings['badge_text']) : ?>
            <div class="eead-advanced-icon-box-badge eead-position-<?php echo esc_attr($settings['badge_position']); ?>">
                <span class="eead-badge eead-padding-small"><?php echo esc_html($settings['badge_text']); ?></span>
            </div>
        <?php endif;
    }
}
