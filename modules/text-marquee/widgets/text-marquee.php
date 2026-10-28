<?php

namespace EasyElementorAddons\Modules\TextMarquee\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Text Marquee Widget
 */
class TextMarquee extends Widget_Base {

    public function get_name() {
        return 'eead-text-marquee';
    }

    public function get_title() {
        return esc_html__('Text Marquee', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-icons-text-marquee';
    }

    public function get_keywords() {
        return ['marquee', 'scrolling text', 'ticker', 'news ticker', 'text slider', 'running text', 'eead'];
    }

    /**
     * Drop the inner .elementor-widget-container wrapper when Elementor's
     * Optimized Markup feature is active.
     */
    public function has_widget_inner_wrapper(): bool {
        return !\Elementor\Plugin::$instance->experiments->is_feature_active('e_optimized_markup');
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_items', [
                'label' => esc_html__('Items', 'easy-elementor-addons')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text', [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
                'default' => esc_html__('Marquee item', 'easy-elementor-addons'),
                'description' => esc_html__('You can use <em>, <strong> and <mark> to highlight words.', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'media', [
                'label' => esc_html__('Icon / Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'none',
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'easy-elementor-addons'),
                        'icon' => 'eicon-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'easy-elementor-addons'),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'easy-elementor-addons'),
                        'icon' => 'eicon-image',
                    ],
                ]
            ]
        );

        $repeater->add_control(
            'icon', [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'media' => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'image', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media' => 'image'
                ]
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => 'https://your-link.com'
            ]
        );

        $repeater->add_control(
            'item_custom_style', [
                'label' => esc_html__('Custom Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'item_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.eead-tm-item, {{WRAPPER}} {{CURRENT_ITEM}}.eead-tm-item a' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}}',
                ],
                'condition' => [
                    'item_custom_style' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'item_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.eead-tm-item' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'item_custom_style' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'item_outline', [
                'label' => esc_html__('Outline Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'item_custom_style' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'items', [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['text' => esc_html__('Fast & lightweight', 'easy-elementor-addons')],
                    ['text' => esc_html__('Fully responsive', 'easy-elementor-addons')],
                    ['text' => esc_html__('No coding needed', 'easy-elementor-addons')],
                    ['text' => esc_html__('Easy to customize', 'easy-elementor-addons')],
                    ['text' => esc_html__('Built for Elementor', 'easy-elementor-addons')],
                ],
                'title_field' => '{{{ text }}}'
            ]
        );

        $this->add_control(
            'html_tag', [
                'label' => esc_html__('HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => eead_html_tags(),
                'default' => 'span',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_separator', [
                'label' => esc_html__('Separator', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'separator_type', [
                'label' => esc_html__('Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'easy-elementor-addons'),
                        'icon' => 'eicon-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'easy-elementor-addons'),
                        'icon' => 'eicon-star',
                    ],
                    'text' => [
                        'title' => esc_html__('Text', 'easy-elementor-addons'),
                        'icon' => 'eicon-t-letter',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'easy-elementor-addons'),
                        'icon' => 'eicon-image',
                    ],
                ]
            ]
        );

        $this->add_control(
            'separator_icon', [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-asterisk',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'separator_type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'separator_text', [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '/',
                'condition' => [
                    'separator_type' => 'text'
                ]
            ]
        );

        $this->add_control(
            'separator_image', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'separator_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'separator_spin', [
                'label' => esc_html__('Spin Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'eead-tm-spin-',
                'condition' => [
                    'separator_type!' => 'none'
                ]
            ]
        );

        $this->add_control(
            'separator_spin_duration', [
                'label' => esc_html__('Spin Duration (s)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 30,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-separator' => '--eead-tm-spin: {{SIZE}}s',
                ],
                'condition' => [
                    'separator_type!' => 'none',
                    'separator_spin' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_motion', [
                'label' => esc_html__('Motion', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'direction', [
                'label' => esc_html__('Direction', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'up' => [
                        'title' => esc_html__('Up', 'easy-elementor-addons'),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'down' => [
                        'title' => esc_html__('Down', 'easy-elementor-addons'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'speed', [
                'label' => esc_html__('Speed (px per second)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'size' => 60,
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'vertical_height', [
                'label' => esc_html__('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 300,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee.eead-tm-vertical' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'direction' => ['up', 'down']
                ]
            ]
        );

        $this->add_control(
            'hover_action', [
                'label' => esc_html__('On Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'pause',
                'options' => [
                    'none' => esc_html__('Keep Moving', 'easy-elementor-addons'),
                    'pause' => esc_html__('Pause', 'easy-elementor-addons'),
                    'slow' => esc_html__('Slow Down', 'easy-elementor-addons'),
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'scroll_effect', [
                'label' => esc_html__('Page Scroll Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'speed' => esc_html__('Speed Up While Scrolling', 'easy-elementor-addons'),
                    'direction' => esc_html__('Follow Scroll Direction', 'easy-elementor-addons'),
                ],
                'description' => esc_html__('Follow Scroll Direction reverses the marquee while the page is scrolled up.', 'easy-elementor-addons'),
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'draggable', [
                'label' => esc_html__('Drag to Scroll', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Visitors can drag or swipe the marquee.', 'easy-elementor-addons'),
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'reduced_motion', [
                'label' => esc_html__('Respect Reduced Motion', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'description' => esc_html__('Shows the items without movement to visitors who turned off animations in their system settings.', 'easy-elementor-addons'),
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'edge_fade', [
                'label' => esc_html__('Fade Edges', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'prefix_class' => 'eead-tm-fade-',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'edge_fade_size', [
                'label' => esc_html__('Fade Size (%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 40,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => '--eead-tm-fade: {{SIZE}}%',
                ],
                'condition' => [
                    'edge_fade' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        /* Style: Marquee */
        $this->start_controls_section(
            'section_style_marquee', [
                'label' => esc_html__('Marquee', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'marquee_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-text-marquee'
            ]
        );

        $this->add_responsive_control(
            'marquee_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'marquee_border',
                'selector' => '{{WRAPPER}} .eead-text-marquee'
            ]
        );

        $this->add_responsive_control(
            'marquee_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'marquee_shadow',
                'selector' => '{{WRAPPER}} .eead-text-marquee'
            ]
        );

        $this->add_responsive_control(
            'items_gap', [
                'label' => esc_html__('Space Between', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 32,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => '--eead-tm-gap: {{SIZE}}{{UNIT}}',
                ],
                'render_type' => 'template',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'items_align', [
                'label' => esc_html__('Vertical Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'baseline' => [
                        'title' => esc_html__('Baseline', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-group' => 'align-items: {{VALUE}}',
                ],
                'condition' => [
                    'direction' => ['left', 'right']
                ]
            ]
        );

        $this->end_controls_section();

        /* Style: Items */
        $this->start_controls_section(
            'section_style_items', [
                'label' => esc_html__('Items', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_typography',
                'selector' => '{{WRAPPER}} .eead-tm-item'
            ]
        );

        $this->add_control(
            'text_style', [
                'label' => esc_html__('Text Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'filled',
                'options' => [
                    'filled' => esc_html__('Filled', 'easy-elementor-addons'),
                    'outline' => esc_html__('Outline', 'easy-elementor-addons'),
                    'alternate' => esc_html__('Alternate Filled & Outline', 'easy-elementor-addons'),
                ],
                'prefix_class' => 'eead-tm-text-'
            ]
        );

        $this->add_control(
            'outline_width', [
                'label' => esc_html__('Outline Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.5,
                        'max' => 6,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'size' => 1.5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => '--eead-tm-stroke: {{SIZE}}px',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'item_text_shadow',
                'selector' => '{{WRAPPER}} .eead-tm-item'
            ]
        );

        $this->start_controls_tabs('item_style_tabs');

        $this->start_controls_tab(
            'item_normal_tab', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'item_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item, {{WRAPPER}} .eead-tm-item a' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'item_background', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'highlight_color', [
                'label' => esc_html__('Highlight Color', 'easy-elementor-addons'),
                'description' => esc_html__('For words wrapped in <em>, <strong> or <mark>.', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item em, {{WRAPPER}} .eead-tm-item strong, {{WRAPPER}} .eead-tm-item mark' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'mark_background', [
                'label' => esc_html__('Mark Background', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item mark' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_hover_tab', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'item_text_color_hover', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item:hover, {{WRAPPER}} .eead-tm-item:hover a' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'item_background_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item:hover' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'item_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item:hover' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'item_fill_on_hover', [
                'label' => esc_html__('Fill Outline on Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'eead-tm-hover-fill-',
                'condition' => [
                    'text_style!' => 'filled'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'item_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .eead-tm-item'
            ]
        );

        $this->add_responsive_control(
            'item_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /* Style: Item Icon / Image */
        $this->start_controls_section(
            'section_style_media', [
                'label' => esc_html__('Item Icon / Image', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'media_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'before',
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => esc_html__('After', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'eead-tm-media-'
            ]
        );

        $this->add_responsive_control(
            'media_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 1,
                    'unit' => 'em',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-media' => '--eead-tm-media-size: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'media_spacing', [
                'label' => esc_html__('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'default' => [
                    'size' => 0.4,
                    'unit' => 'em',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-item' => 'gap: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'media_color', [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-media' => 'color: {{VALUE}}; -webkit-text-stroke: 0',
                    '{{WRAPPER}} .eead-tm-media svg' => 'fill: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'media_radius', [
                'label' => esc_html__('Image Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-media img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /* Style: Separator */
        $this->start_controls_section(
            'section_style_separator', [
                'label' => esc_html__('Separator', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'separator_type!' => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'separator_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => 0.5,
                    'unit' => 'em',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-separator' => '--eead-tm-sep-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'separator_type!' => 'text'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'separator_typography',
                'selector' => '{{WRAPPER}} .eead-tm-separator',
                'condition' => [
                    'separator_type' => 'text'
                ]
            ]
        );

        $this->add_control(
            'separator_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-separator' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-tm-separator svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'separator_type!' => 'image'
                ]
            ]
        );

        $this->add_responsive_control(
            'separator_offset', [
                'label' => esc_html__('Vertical Offset', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-tm-separator' => 'top: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'direction' => ['left', 'right']
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Text allowed in an item: plain text with a few inline highlight tags. */
    private function item_text($text) {
        return wp_kses($text, [
            'em' => [],
            'strong' => [],
            'mark' => [],
            'b' => [],
            'i' => [],
            'span' => ['class' => []],
        ]);
    }

    private function render_media($item) {
        if ('icon' === $item['media'] && !empty($item['icon']['value'])) {
            echo '<span class="eead-tm-media eead-tm-media-icon">';
            Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
            echo '</span>';
        } elseif ('image' === $item['media'] && !empty($item['image']['url'])) {
            $alt = !empty($item['image']['id']) ? get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true) : '';
            echo '<span class="eead-tm-media eead-tm-media-image"><img src="' . esc_url($item['image']['url']) . '" alt="' . esc_attr($alt) . '" loading="lazy" decoding="async"></span>';
        }
    }

    private function render_separator($settings) {
        $type = $settings['separator_type'];
        if ('icon' === $type && !empty($settings['separator_icon']['value'])) {
            echo '<span class="eead-tm-separator" aria-hidden="true"><span class="eead-tm-separator-inner">';
            Icons_Manager::render_icon($settings['separator_icon'], ['aria-hidden' => 'true']);
            echo '</span></span>';
        } elseif ('text' === $type && '' !== $settings['separator_text']) {
            echo '<span class="eead-tm-separator" aria-hidden="true"><span class="eead-tm-separator-inner">' . esc_html($settings['separator_text']) . '</span></span>';
        } elseif ('image' === $type && !empty($settings['separator_image']['url'])) {
            echo '<span class="eead-tm-separator eead-tm-separator-image" aria-hidden="true"><span class="eead-tm-separator-inner"><img src="' . esc_url($settings['separator_image']['url']) . '" alt="" loading="lazy" decoding="async"></span></span>';
        }
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['items'])) {
            return;
        }

        $direction = in_array($settings['direction'], ['left', 'right', 'up', 'down'], true) ? $settings['direction'] : 'left';
        $vertical = in_array($direction, ['up', 'down'], true);
        $tag = eead_check_allowed_html_tags($settings['html_tag'], 'span');

        $speed = [];
        foreach (['', '_tablet', '_mobile'] as $device) {
            if (isset($settings['speed' . $device]['size']) && '' !== $settings['speed' . $device]['size']) {
                $speed[ltrim($device, '_') ?: 'desktop'] = (float) $settings['speed' . $device]['size'];
            }
        }

        $this->add_render_attribute('marquee', [
            'class' => ['eead-text-marquee', 'eead-tm-' . $direction, $vertical ? 'eead-tm-vertical' : 'eead-tm-horizontal'],
            'data-settings' => wp_json_encode([
                'direction' => $direction,
                'speed' => $speed,
                'hover' => in_array($settings['hover_action'], ['none', 'pause', 'slow'], true) ? $settings['hover_action'] : 'pause',
                'scroll' => in_array($settings['scroll_effect'], ['none', 'speed', 'direction'], true) ? $settings['scroll_effect'] : 'none',
                'drag' => 'yes' === $settings['draggable'],
                'reducedMotion' => 'yes' === $settings['reduced_motion'],
            ]),
        ]);

        if ('yes' === $settings['draggable']) {
            $this->add_render_attribute('marquee', 'class', 'eead-tm-draggable');
        }
        ?>
        <div <?php $this->print_render_attribute_string('marquee'); ?>>
            <div class="eead-tm-track">
                <div class="eead-tm-group">
                    <?php
                    foreach ($settings['items'] as $index => $item) {
                        $item_key = 'item-' . $index;
                        $this->add_render_attribute($item_key, 'class', ['eead-tm-item', 'elementor-repeater-item-' . $item['_id']]);
                        if ('yes' === $item['item_custom_style'] && 'yes' === $item['item_outline']) {
                            $this->add_render_attribute($item_key, 'class', 'eead-tm-outline');
                        }
                        $has_link = !empty($item['link']['url']);
                        if ($has_link) {
                            $this->add_link_attributes('link-' . $index, $item['link']);
                        }
                        ?>
                        <<?php echo esc_attr($tag); ?> <?php $this->print_render_attribute_string($item_key); ?>>
                            <?php if ($has_link) { ?>
                                <a <?php $this->print_render_attribute_string('link-' . $index); ?>>
                            <?php
                            }
                            $this->render_media($item);
                            echo '<span class="eead-tm-text">' . $this->item_text($item['text']) . '</span>';
                            if ($has_link) {
                                echo '</a>';
                            }
                            ?>
                        </<?php echo esc_attr($tag); ?>>
                        <?php
                        $this->render_separator($settings);
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}
