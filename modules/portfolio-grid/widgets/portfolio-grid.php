<?php

namespace EasyElementorAddons\Modules\PortfolioGrid\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Portfolio Grid Widget
 */
class PortfolioGrid extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-portfolio-grid';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Portfolio Grid', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['eead-portfolio-grid', 'dashicons'];
    }

    public function get_script_depends() {
        return ['eead-portfolio-grid'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'grid_items_section',
            [
                'label' => esc_html__('Grid Items', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => esc_html__('Info', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'website_link',
            [
                'label' => esc_html__('Link to', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://www.example.com', 'easy-elementor-addons'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'item_filter_ids',
            [
                'label' => esc_html__('Filter ID(s)', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_responsive_control(
            'column_width',
            [
                'label' => esc_html__('Column Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'grid-column: span {{VALUE}};'
                ],
            ]
        );

        $repeater->add_responsive_control(
            'column_height',
            [
                'label' => esc_html__('Column Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'grid-row: span {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Portfolio Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'title' => esc_html__('Title 1', 'easy-elementor-addons'),
                        'info' => esc_html__('Lorem ipsum dolor...', 'easy-elementor-addons'),
                        'image' => Utils::get_placeholder_image_src(),
                        'item_filter_ids' => 'filter-1 filter-2'
                    ],
                    [
                        'title' => esc_html__('Title 2', 'easy-elementor-addons'),
                        'info' => esc_html__('Lorem ipsum dolor...', 'easy-elementor-addons'),
                        'image' => Utils::get_placeholder_image_src(),
                        'item_filter_ids' => 'filter-2'
                    ],
                    [
                        'title' => esc_html__('Title 3', 'easy-elementor-addons'),
                        'info' => esc_html__('Lorem ipsum dolor...', 'easy-elementor-addons'),
                        'image' => Utils::get_placeholder_image_src(),
                        'item_filter_ids' => 'filter-3'
                    ],
                    [
                        'title' => esc_html__('Title 4', 'easy-elementor-addons'),
                        'info' => esc_html__('Lorem ipsum dolor...', 'easy-elementor-addons'),
                        'image' => Utils::get_placeholder_image_src(),
                        'item_filter_ids' => 'filter-2 filter-3'
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'hr_img_size',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );

        $this->add_control(
            'info_html_tag',
            [
                'label' => esc_html__('Info HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'p' => 'p',
                ],
                'default' => 'p',
            ]
        );

        $this->add_control(
            'img_size',
            [
                'label' => esc_html__('Image Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'large',
                'options' => eead_get_image_sizes(),
            ]
        );

        $this->add_control(
            'layout_default',
            [
                'label' => esc_html__('Default Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'eead-fpg-grid-view' => [
                        'title' => esc_html__('Grid', 'easy-elementor-addons'),
                        'icon' => 'fas fa-th-large',
                    ],
                    'eead-fpg-list-view' => [
                        'title' => esc_html__('List', 'easy-elementor-addons'),
                        'icon' => 'fas fa-th-list',
                    ],
                ],
                'default' => 'eead-fpg-grid-view',
                'toggle' => false
            ]
        );

        $this->add_control(
            'layout_menu',
            [
                'label' => esc_html__('Show Layout Switcher', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'show_label' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filters_section',
            [
                'label' => esc_html__('Filters', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater2 = new Repeater();

        $repeater2->add_control(
            'filter_name',
            [
                'label' => esc_html__('Filter Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater2->add_control(
            'filter_id',
            [
                'label' => esc_html__('Filter ID', 'easy-elementor-addons'),
                'description' => esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows A-Z 0-9  & underscore chars without spaces.', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater2->add_control(
            'filter_default',
            [
                'label' => esc_html__('Default Filter', 'easy-elementor-addons'),
                'description' => esc_html__('There must be a default filter in the menu.', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => '',
                'show_label' => true,
            ]
        );

        $this->add_control(
            'list2',
            [
                'label' => esc_html__('Filters', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'filter_name' => esc_html__('All', 'easy-elementor-addons'),
                        'filter_id' => esc_html__('all', 'easy-elementor-addons'),
                        'filter_default' => 'yes'
                    ],
                    [
                        'filter_name' => esc_html__('Filter 1', 'easy-elementor-addons'),
                        'filter_id' => esc_html__('filter-1', 'easy-elementor-addons')
                    ],
                    [
                        'filter_name' => esc_html__('Filter 2', 'easy-elementor-addons'),
                        'filter_id' => esc_html__('filter-2', 'easy-elementor-addons')
                    ],
                    [
                        'filter_name' => esc_html__('Filter 3', 'easy-elementor-addons'),
                        'filter_id' => esc_html__('filter-3', 'easy-elementor-addons')
                    ]
                ],
                'title_field' => '{{{ filter_name }}}',
            ]
        );

        $this->add_control(
            'filter_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'filter_menu',
            [
                'label' => esc_html__('Show Menu', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'show_label' => true,
            ]
        );

        $this->end_controls_section();

        // section start
        $this->start_controls_section(
            'grid_item_style',
            [
                'label' => esc_html__('Grid Item', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_item_bg',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.1)',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container li .eead-fpg-inner' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_item_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container li .eead-fpg-inner'
            ]
        );

        $this->add_control(
            'grid_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container li .eead-fpg-inner' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_item_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container li .eead-fpg-inner'
            ]
        );

        $this->end_controls_section();

        // section start
        $this->start_controls_section(
            'grid_view_style',
            [
                'label' => esc_html__('Grid View', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_item_animation',
            [
                'label' => esc_html__('Hover Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HOVER_ANIMATION
            ]
        );

        $this->add_control(
            'grid_item_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'grid_item_width',
            [
                'label' => esc_html__('Max. Item Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1400,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-grid-view' => 'grid-template-columns:repeat(auto-fit, minmax({{SIZE}}{{UNIT}}, 1fr));'
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_gap',
            [
                'label' => esc_html__('Grid Gap (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-grid-view' => 'grid-gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_view_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'grid_txt_placement',
            [
                'label' => esc_html__('Text Box Placement', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'below-img',
                'options' => [
                    'in-img' => esc_html__('On the image', 'easy-elementor-addons'),
                    'below-img' => esc_html__('Below the image', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_responsive_control(
            'grid_view_img_height',
            [
                'label' => esc_html__('Grid Item Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 2000,
                'step' => 10,
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.in-img.eead-fpg-grid-view li' => 'height: {{VALUE}}px;'
                ],
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_responsive_control(
            'grid_view_v_align',
            [
                'label' => esc_html__('Text Box Vertical Align', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-grid-view figcaption' => 'justify-content: {{VALUE}};'
                ],
                'toggle' => false,
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_responsive_control(
            'grid_view_text_align',
            [
                'label' => esc_html__('Text Align', 'easy-elementor-addons'),
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-grid-view figcaption' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_view_txt_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption',
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_control(
            'grid_view_txt_border_radius',
            [
                'label' => esc_html__('Text Box Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_responsive_control(
            'grid_view_txt_padding',
            [
                'label' => esc_html__('Text Box Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_view_txt_margin',
            [
                'label' => esc_html__('Text Box Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_control(
            'grid_view_hr_2',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->start_controls_tabs('tabs_overlay_style');

        $this->start_controls_tab(
            'tab_overlay_normal',
            [
                'label' => esc_html__('Overlay', 'easy-elementor-addons'),
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'grid_view_txt_bg',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption',
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_overlay_hover',
            [
                'label' => esc_html__('Overlay Hover', 'easy-elementor-addons'),
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'grid_view_txt_bg_hover',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view figcaption:hover',
                'condition' => ['grid_txt_placement' => 'in-img']
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'grid_view_hr_3',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'grid_view_title_typography',
                'label' => esc_html__('Title Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-title',
            ]
        );

        $this->add_control(
            'grid_view_title_color',
            [
                'label' => esc_html__('Title Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'grid_view_title_margin',
            [
                'label' => esc_html__('Title Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'grid_view_info_typography',
                'label' => esc_html__('Info Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-info',
            ]
        );

        $this->add_control(
            'grid_view_info_color',
            [
                'label' => esc_html__('Info Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-info' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'grid_view_info_margin',
            [
                'label' => esc_html__('Info Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view li .eead-fpg-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'grid_view_hr_4',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'grid_view_img_padding',
            [
                'label' => esc_html__('Image Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_view_img_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-grid-view img' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'list_view_style',
            [
                'label' => esc_html__('List View', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_view_img_width',
            [
                'label' => esc_html__('Image Width (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li figure' => 'grid-template-columns: {{SIZE}}{{UNIT}} 1fr;'
                ],
            ]
        );

        $this->add_responsive_control(
            'list_view_grid_gap',
            [
                'label' => esc_html__('Grid Gap (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li:last-child' => 'margin-bottom: 0;'
                ],
            ]
        );

        $this->add_control(
            'list_view_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'list_view_text_align',
            [
                'label' => esc_html__('Text Align', 'easy-elementor-addons'),
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-list-view figcaption' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_view_txt_padding',
            [
                'label' => esc_html__('Text Box Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view figcaption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'list_view_hr_2',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_view_title_typography',
                'label' => esc_html__('Title Typography', 'easy-elementor-addons'),

                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-title',
            ]
        );

        $this->add_control(
            'list_view_title_color',
            [
                'label' => esc_html__('Title Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_view_title_margin',
            [
                'label' => esc_html__('Title Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_view_info_typography',
                'label' => esc_html__('Info Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-info',
            ]
        );

        $this->add_control(
            'list_view_info_color',
            [
                'label' => esc_html__('Info Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-info' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'list_view_info_margin',
            [
                'label' => esc_html__('Info Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view li .eead-fpg-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'list_view_hr_3',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'list_view_img_padding',
            [
                'label' => esc_html__('Image Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'list_view_img_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-container.eead-fpg-list-view img' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'toolbar_style',
            [
                'label' => esc_html__('Toolbar', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'toolbar_bg',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'toolbar_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar'
            ]
        );

        $this->add_control(
            'toolbar_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'toolbar_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar'
            ]
        );

        $this->add_control(
            'toolbar_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'toolbar_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'toolbar_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        // section start
        $this->start_controls_section(
            'filters_style',
            [
                'label' => esc_html__('Filters', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['filter_menu' => 'yes']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filters_typography',
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label',
            ]
        );

        $this->start_controls_tabs('tabs_filters_style');

        $this->start_controls_tab(
            'tab_filters_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'filters_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'filters_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.1)',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filters_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label'
            ]
        );

        $this->add_control(
            'filters_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'filters_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_filters_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'filters_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li label.active' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'filters_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li label.active' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filters_border_hover',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label:hover,{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li label.active'
            ]
        );

        $this->add_control(
            'filters_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li label.active' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'filters_shadow_hover',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label:hover,{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li label.active'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'filters_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'filters_max_width',
            [
                'label' => esc_html__('Max. Label Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 900,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label' => 'max-width:{{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'filters_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon) label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'filters_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li:not(.eead-fpg-mobile-icon)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        // section start
        $this->start_controls_section(
            'mobile_menu_style',
            [
                'label' => esc_html__('Mobile Menu Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['filter_menu' => 'yes']
            ]
        );

        $this->add_control(
            'mobile_menu_icon_size',
            [
                'label' => esc_html__('Icon Size (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label .dashicons:before' => 'font-size:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label .dashicons' => 'font-size:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->start_controls_tabs('tabs_mobile_menu_style');

        $this->start_controls_tab(
            'tab_mobile_menu_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'mobile_menu_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobile_menu_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label'
            ]
        );

        $this->add_control(
            'mobile_menu_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mobile_menu_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_mobile_menu_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'mobile_menu_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobile_menu_border_hover',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label:hover'
            ]
        );

        $this->add_control(
            'mobile_menu_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mobile_menu_shadow_hover',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label:hover'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'mobile_menu_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'mobile_menu_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-search-wrapper li.eead-fpg-mobile-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        // section start
        $this->start_controls_section(
            'layout_style',
            [
                'label' => esc_html__('Layout Menu', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['layout_menu' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'layout_icon_size',
            [
                'label' => esc_html__('Icon Size (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label .dashicons:before' => 'font-size:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label .dashicons' => 'font-size:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->start_controls_tabs('tabs_layout_style');

        $this->start_controls_tab(
            'tab_layout_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'layout_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'layout_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.1)',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'layout_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label'
            ]
        );

        $this->add_control(
            'layout_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'layout_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_layout_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'layout_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label.active' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'layout_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label.active' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'layout_border_hover',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label:hover,{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label.active'
            ]
        );

        $this->add_control(
            'layout_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label.active' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'layout_shadow_hover',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label:hover,{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label.active'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'layout_hr_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'layout_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fpg-toolbar .eead-fpg-view-options li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $settings_id = $this->get_id();
        if ($settings['list2']) {
            ?>
            <form id="tmea_fpg_form-<?php echo esc_attr($settings_id); ?>" name="tmea_fpg_form-<?php echo esc_attr($settings_id); ?>" class="eead-fpg-toolbar">
                <?php if ($settings['filter_menu']) { ?>
                    <ul class="eead-fpg-search-wrapper">
                        <li class="eead-fpg-mobile-icon">
                            <label>
                                <span class="dashicons dashicons-menu-alt"></span>
                            </label>
                        </li>
                        <?php foreach ($settings['list2'] as $item) { ?>
                            <li>
                                <input id="eead-fpg-filter-<?php echo esc_attr($settings_id); ?>-<?php echo esc_attr($item['filter_id']); ?>" type="radio" <?php checked((isset($item['filter_default']) && $item['filter_default']), true); ?> name="filter" value="<?php echo esc_attr($item['filter_id']); ?>" style="display:none">
                                <label for="eead-fpg-filter-<?php echo esc_attr($settings_id); ?>-<?php echo esc_attr($item['filter_id']); ?>" class="<?php echo ((isset($item['filter_default']) && $item['filter_default']) ? 'active' : ''); ?>">
                                    <?php echo esc_html($item['filter_name']); ?>
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php
                }

                if ($settings['layout_menu']) {
                    ?>
                    <ul class="eead-fpg-view-options">
                        <li>
                            <input id="eead-fpg-show-grid-<?php echo esc_attr($settings_id); ?>" type="radio" <?php checked(($settings['layout_default'] == 'eead-fpg-grid-view'), true); ?> name="view" value="show-grid" style="display:none">
                            <label for="eead-fpg-show-grid-<?php echo esc_attr($settings_id); ?>" class="<?php echo (($settings['layout_default'] == 'eead-fpg-grid-view') ? 'active' : ''); ?>">
                                <span class="dashicons dashicons-grid-view"></span>
                            </label>
                        </li>
                        <li>
                            <input id="eead-fpg-show-list-<?php echo esc_attr($settings_id); ?>" type="radio" <?php checked(($settings['layout_default'] == 'eead-fpg-list-view'), true); ?> name="view" value="show-list" style="display:none">
                            <label for="eead-fpg-show-list-<?php echo esc_attr($settings_id); ?>" class="<?php echo (($settings['layout_default'] == 'eead-fpg-list-view') ? 'active' : ''); ?>">
                                <span class="dashicons dashicons-list-view"></span>
                            </label>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </form>
            <?php
        }

        if ($settings['list']) {
            ?>
            <ol class="eead-fpg-container <?php echo esc_attr($settings['layout_default']) . ' ' . esc_attr($settings['grid_txt_placement']); ?> eead-fpg-zoom-in" style="display:none;">
                <?php foreach ($settings['list'] as $item) { ?>
                    <li data-filter="<?php echo esc_attr($item['item_filter_ids']); ?>" class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                        <div class="eead-fpg-inner elementor-animation-<?php echo esc_attr($settings['grid_item_animation']); ?>">
                            <?php
                            $target = $item['website_link']['is_external'] ? ' target="_blank"' : '';
                            $nofollow = $item['website_link']['nofollow'] ? ' rel="nofollow"' : '';

                            if ($item['website_link']['url']) {
                                echo '<a href="' . esc_url($item['website_link']['url']) . '"' . $target . $nofollow . '>';
                            }
                            ?>
                            <figure>
                                <?php
                                $img_url = '';
                                $img_alt = '';

                                if ($item['image']['url'] && $item['image']['url'] != Utils::get_placeholder_image_src()) {
                                    $img_array = wp_get_attachment_image_src($item['image']['id'], $settings['img_size'], true);
                                    $img_url = $img_array[0];
                                    $img_alt = get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true);
                                } else if ($item['image']['url'] == Utils::get_placeholder_image_src()) {
                                    $img_url = Utils::get_placeholder_image_src();
                                }

                                if (!empty($img_url)) {
                                    echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '" />';
                                }
                                ?>

                                <figcaption>
                                    <?php
                                    if (!empty($item['title'])) {
                                        echo '<' . esc_attr($settings['title_html_tag']) . ' class="eead-fpg-title">' . esc_html($item['title']) . '</' . esc_attr($settings['title_html_tag']) . '>';
                                    }
                                    if (!empty($item['info'])) {
                                        echo '<' . esc_attr($settings['info_html_tag']) . ' class="eead-fpg-info">' . do_shortcode($item['info']) . '</' . esc_attr($settings['info_html_tag']) . '>';
                                    }
                                    ?>
                                </figcaption>
                            </figure>
                            <?php
                            if ($item['website_link']['url']) {
                                echo '</a>';
                            }
                            ?>
                        </div>
                    </li>
                <?php } ?>
            </ol>
        <?php }
    }

}