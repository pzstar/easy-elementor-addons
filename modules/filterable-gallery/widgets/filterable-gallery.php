<?php

namespace EasyElementorAddons\Modules\FilterableGallery\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Filterable Gallery Widget
 */
class FilterableGallery extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-filterable-gallery';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Filterable Gallery', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-gallery-grid';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['magnific-popup', 'isotope'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }

    /** Controls */
    protected function register_controls() {

        /**
         * Filter Gallery Control Settings
         */
        $this->start_controls_section(
            'filter_controls',
            [
                'label' => esc_html__('Filters', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'enable_filter',
            [
                'label' => esc_html__('Enable Filter', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'filter_all_label',
            [
                'label' => esc_html__('All Filter Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'All',
                'condition' => [
                    'enable_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filters_tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    ['filter_title' => 'Filter Title'],
                ],
                'fields' => [
                    [
                        'name' => 'filter_title',
                        'label' => esc_html__('Filter Title', 'easy-elementor-addons'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Filter Title', 'easy-elementor-addons'),
                    ],
                ],
                'title_field' => '{{filter_title}}',
                'condition' => [
                    'enable_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_type',
            [
                'label' => esc_html__('Filter Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__('Normal', 'easy-elementor-addons'),
                    'with-search' => esc_html__('With Search', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'enable_filter' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'search_filter_placeholder',
            [
                'label' => esc_html__('Search Placeholder Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search Items', 'easy-elementor-addons'),
                'condition' => [
                    'filter_type' => 'with-search',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'gallery_items_section',
            [
                'label' => esc_html__('Gallery Items', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'gallery_image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'gallery_item_name',
            [
                'label' => esc_html__('Item Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Item Name', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'gallery_item_content',
            [
                'label' => esc_html__('Item Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 6,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elit.'
            ]
        );

        $repeater->add_control(
            'gallery_filter_name',
            [
                'label' => esc_html__('Enter Filter Titles', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'description' => esc_html__('Enter the filter names from Filters Settings, separated with comma. | e.g. Filter 1, Filter 2', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'gallery_show_price',
            [
                'label' => esc_html__('Show Price', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes'
            ]
        );

        $repeater->add_control(
            'gallery_item_price',
            [
                'label' => esc_html__('Item Price', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$100', 'easy-elementor-addons'),
                'condition' => [
                    'gallery_show_price' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'gallery_show_rating',
            [
                'label' => esc_html__('Show Ratings', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes'
            ]
        );

        $repeater->add_control(
            'gallery_item_rating',
            [
                'label' => esc_html__('Item Ratings', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5', 'easy-elementor-addons'),
                'condition' => [
                    'gallery_show_rating' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'gallery_show_video',
            [
                'label' => esc_html__('Enable Video PopUp', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'gallery_item_video_link',
            [
                'label' => esc_html__('Video Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'https://www.youtube.com/watch?v=kB4U67tiQLA',
                'condition' => [
                    'gallery_show_video' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_show_lighbox',
            [
                'label' => esc_html__('Lightbox Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'condition' => [
                    'gallery_show_video!' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_show_link',
            [
                'label' => esc_html__('Link Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'condition' => [
                    'gallery_show_video!' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_image_link',
            [
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition' => [
                    'gallery_show_video!' => 'yes',
                    'gallery_show_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gallery_items',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['gallery_item_name' => 'Item 1'],
                    ['gallery_item_name' => 'Item 2'],
                    ['gallery_item_name' => 'Item 3'],
                    ['gallery_item_name' => 'Item 4'],
                    ['gallery_item_name' => 'Item 5'],
                    ['gallery_item_name' => 'Item 6'],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{gallery_item_name}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Gallery Settings
         */
        $this->start_controls_section(
            'gallery_settings_section',
            [
                'label' => esc_html__('Gallery Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_responsive_control(
            'gallery_columns',
            [
                'label' => esc_html__('Columns', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'prefix_class' => 'eead-fg-grid%s-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'gallery_grid_style',
            [
                'label' => esc_html__('Grid Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'easy-elementor-addons'),
                    'masonry' => esc_html__('Masonry', 'easy-elementor-addons'),
                ],
                'prefix_class' => 'eead-fg-style-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'gallery_style',
            [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => esc_html__('Overlay', 'easy-elementor-addons'),
                    'card' => esc_html__('Card', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'gallery_hover_style',
            [
                'label' => esc_html__('Hover Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'eead-fade-in',
                'options' => [
                    'eead-none' => esc_html__('None', 'easy-elementor-addons'),
                    'eead-fade-in' => esc_html__('Fade In', 'easy-elementor-addons'),
                    'eead-slide-left' => esc_html__('Slide Left', 'easy-elementor-addons'),
                    'eead-slide-right' => esc_html__('Slide Right', 'easy-elementor-addons'),
                    'eead-slide-top' => esc_html__('Slide Top', 'easy-elementor-addons'),
                    'eead-slide-bottom' => esc_html__('Slide Bottom', 'easy-elementor-addons'),
                    'eead-zoom-in' => esc_html__('Zoom In ', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'gallery_link_to',
            [
                'label' => esc_html__('Link to', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'buttons',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'media' => esc_html__('Image Pop Up', 'easy-elementor-addons'),
                    'buttons' => esc_html__('Buttons', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'enable_gallery',
            [
                'label' => esc_html__('Enable Prev/Next Lightbox Gallery', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'gallery_link_to!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'gallery_zoom_icon',
            [
                'label' => esc_html__('Lightbox Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'default' => [
                    'value' => 'fas fa-search-plus',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'gallery_link_to' => 'buttons',
                ],
            ]
        );

        $this->add_control(
            'gallery_link_icon',
            [
                'label' => esc_html__('Link Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'default' => [
                    'value' => 'fas fa-link',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'gallery_link_to' => 'buttons',
                ],
            ]
        );

        $this->add_control(
            'video_play_icon',
            [
                'label' => esc_html__('Play Video Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'gallery_link_to' => 'buttons',
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__('H1', 'easy-elementor-addons'),
                    'h2' => esc_html__('H2', 'easy-elementor-addons'),
                    'h3' => esc_html__('H3', 'easy-elementor-addons'),
                    'h4' => esc_html__('H4', 'easy-elementor-addons'),
                    'h5' => esc_html__('H5', 'easy-elementor-addons'),
                    'h6' => esc_html__('H6', 'easy-elementor-addons'),
                    'span' => esc_html__('Span', 'easy-elementor-addons'),
                    'p' => esc_html__('P', 'easy-elementor-addons'),
                    'div' => esc_html__('Div', 'easy-elementor-addons')
                ],
            ]
        );

        $this->add_control(
            'filter_duration',
            [
                'label' => esc_html__('Animation Duration (ms)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => false,
                'default' => 500,
                'min' => 100,
                'max' => 8000,
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'gallery_image_spacing',
            [
                'label' => esc_html__('Image Spacing(px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-list' => 'padding: calc({{SIZE}}px/2);',
                    '{{WRAPPER}} .eead-filter-gallery-container' => 'margin: calc({{SIZE}}px/2 * -1);',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'image_dynamic_height',
            [
                'label' => esc_html__('Dynamic Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'gallery_grid_style' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'gallery_image_height_px',
            [
                'label' => esc_html__('Image Height(px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 800,
                    ],
                ],
                'default' => [
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-thumbnail' => 'padding-bottom: {{SIZE}}px;',
                ],
                'condition' => [
                    'gallery_grid_style' => 'grid',
                    'image_dynamic_height' => ''
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'gallery_image_height_per',
            [
                'label' => esc_html__('Image Height(%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-thumbnail' => 'padding-bottom: {{SIZE}}%;',
                ],
                'condition' => [
                    'gallery_grid_style' => 'grid',
                    'image_dynamic_height' => 'yes'
                ],
                'render_type' => 'template'
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Gallery Load More Button
         */
        $this->start_controls_section(
            'section_pagination',
            [
                'label' => esc_html__('Load More Button', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__('Enable', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
            ]
        );

        $this->add_control(
            'items_to_show',
            [
                'label' => esc_html__('Items to Display Initially', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => false,
                'min' => 1,
                'max' => 100,
                'default' => 6,
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'images_per_page',
            [
                'label' => esc_html__('Items to Display on Clicking Load More Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 200,
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'load_more_text',
            [
                'label' => esc_html__('Button Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Load More', 'easy-elementor-addons'),
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nomore_items_text',
            [
                'label' => esc_html__('No More Items Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('No More Items!', 'easy-elementor-addons'),
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => esc_html__('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'row-reverse',
                'options' => [
                    'row-reverse' => esc_html__('After', 'easy-elementor-addons'),
                    'row' => esc_html__('Before', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'button_icon[value]!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-loadmore a.eead-fg-loadmore-btn' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'items_style_section',
            [
                'label' => esc_html__('Item', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-item',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Control Style
         */
        $this->start_controls_section(
            'filter_style_section',
            [
                'label' => esc_html__('Filter Buttons', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'filter_type' => 'normal',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_btn_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li',
            ]
        );

        $this->add_responsive_control(
            'filter_btn_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_btn_padding',
            [
                'label' => esc_html__('Buttton Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('filter_btn_tabs');

        $this->start_controls_tab('filter_btn_normal', [
            'label' => esc_html__('Normal', 'easy-elementor-addons')
        ]);

        $this->add_control(
            'filter_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_btn_normal_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'filter_btn_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('cta_btn_hover', [
            'label' => esc_html__('Active', 'easy-elementor-addons')
        ]);

        $this->add_control(
            'filter_btn_active_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li.eead-fg-active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_btn_active_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li.eead-fg-active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'filter_btn_active_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li.eead-fg-active',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'filter_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'filter_btn_spacing',
            [
                'label' => esc_html__('Button Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-normal-filter ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter_search_style_section',
            [
                'label' => esc_html__('Filter Search', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_filter_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery button.eead-fg-filter-trigger, {{WRAPPER}} .eead-fg-search-box input, {{WRAPPER}} .eead-fg-filter-dropdown',
            ]
        );

        $this->add_responsive_control(
            'search_filter_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_filter_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery button.eead-fg-filter-trigger, {{WRAPPER}} .eead-fg-search-box input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_control(
            'search_filter_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f8ff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter-box' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_control(
            'search_filter_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery button.eead-fg-filter-trigger, {{WRAPPER}} .eead-fg-search-box input, {{WRAPPER}} .eead-fg-search-box input::placeholder' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_filter_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter-box',
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'search_filter_border_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter-box',
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_control(
            'search_filter_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-filter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_control(
            'search_filter_separator',
            [
                'label' => esc_html__('Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'search_filter_sep_border_size',
            [
                'label' => esc_html__('Separator Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-select-filter' => 'border-right: {{SIZE}}px solid;',
                ]
            ]
        );

        $this->add_control(
            'search_filter_sep_border_color',
            [
                'label' => esc_html__('Separator Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#dcedfe',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-select-filter' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'search_filter_dropdown',
            [
                'label' => esc_html__('Dropdown', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'search_filter_dropdown_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_filter_dropdown_color_hover',
            [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown li:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'search_filter_dropdown_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'filter_type!' => 'normal',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_filter_dropdown_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_filter_dropdown_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'selector' => '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown'
            ]
        );

        $this->add_control(
            'search_filter_dropdown_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery ul.eead-fg-filter-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Gallery Hoverer Style
         */
        $this->start_controls_section(
            'overlay_caption_style_section',
            [
                'label' => esc_html__('Overlay Caption', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'overlay'
                ],
            ]
        );

        $this->add_control(
            'overlay_caption_alignment',
            [
                'label' => esc_html__('Text Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-style-overlay .eead-fg-item-caption ' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'overlay_caption_v_alignment',
            [
                'label' => esc_html__('Vertical Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-caption' => 'align-items: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'overlay_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.7)',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-caption-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'overlay_caption_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_caption_title_heading',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_caption_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'overlay_caption_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-title',
            ]
        );

        $this->add_control(
            'overlay_caption_title_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_caption_content_typography_heading',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'overlay_caption_content_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-content, {{WRAPPER}} .eead-filter-gallery .eead-fg-caption-head' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'overlay_caption_content_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-content,{{WRAPPER}} .eead-filter-gallery .eead-fg-caption-head',
            ]
        );

        $this->add_control(
            'overlay_caption_content_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-overlay .eead-fg-item-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Card Gallery Item Style
         */
        $this->start_controls_section(
            'card_caption_style_section',
            [
                'label' => esc_html__('Card Caption', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'card'
                ],
            ]
        );

        $this->add_responsive_control(
            'card_caption_alignment',
            [
                'label' => esc_html__('Content Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'default' => 'center',
                'prefix_class' => 'eead-fg-card-caption-align-',
            ]
        );

        $this->add_control(
            'card_caption_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-caption' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'card_caption_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'card_caption_title_heading',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_caption_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-caption .eead-fg-item-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_caption_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-caption .eead-fg-item-title',
            ]
        );

        $this->add_control(
            'card_caption_content_heading',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_caption_content_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-caption-head, {{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_caption_content_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-caption-head, {{WRAPPER}} .eead-filter-gallery .eead-fg-style-card .eead-fg-item-content',
            ]
        );

        $this->end_controls_section();

        /**
         * Hoverer Icon Style
         */
        $this->start_controls_section(
            'overlay_button_style_section',
            [
                'label' => esc_html__('Gallery/Link Buttons', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_button_size',
            [
                'label' => esc_html__('Button Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('overlay_button_tabs');

        $this->start_controls_tab(
            'overlay_button_style_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'overlay_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_button_icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'overlay_button_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'overlay_button_style_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'overlay_button_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_button_icon_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-item-buttons a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        /**
         * Video Gallery Item Style
         */
        $this->start_controls_section(
            'video_button_style',
            [
                'label' => esc_html__('Video Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'video_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-video-popup' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_button_icon_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-video-popup' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_button_size',
            [
                'label' => esc_html__('Button Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                    'em' => [
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    ' .eead-filter-gallery .eead-fg-video-popup' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'video_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                    'em' => [
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    ' .eead-filter-gallery .eead-fg-video-popup i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ' .eead-filter-gallery .eead-fg-video-popup svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Load More Button Style
         */
        $this->start_controls_section(
            'loadmore_button_style_section',
            [
                'label' => esc_html__('Load More Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'load_more_button_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'load_more_button_box_shadow',
                'selector' => '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn',
            ]
        );

        $this->add_responsive_control(
            'load_more_button_margin_top',
            [
                'label' => esc_html__('Top Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'load_more_button_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'load_more_button_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn',
            ]
        );

        $this->add_control(
            'load_more_button_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50
                    ]
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('tabs_load_more_button');

        $this->start_controls_tab(
            'tab_load_more_button_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_bg_color_normal',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'load_more_button_text_color_normal',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-filter-gallery .eead-fg-loadmore a.eead-fg-loadmore-btn svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'load_more_button_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'load_more_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-loadmore .eead-fg-loadmore-btn:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function minifyHTML($html) {
        // Remove extra spaces, newlines, and tabs
        $search = [
            '/\>[^\S ]+/s',     // Remove whitespaces after tags, except space
            '/[^\S ]+\</s',     // Remove whitespaces before tags, except space
            '/(\s)+/s',         // Shorten multiple whitespace sequences to a single space
            '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s' // Remove HTML comments, tabs, and newlines
        ];

        $replace = [
            '>',
            '<',
            '\\1',
            ''
        ];

        $minified = preg_replace($search, $replace, $html);

        return $minified;
    }

    protected function render_filters() {
        $settings = $this->get_settings_for_display();
        $all_text = $settings['filter_all_label'] != '' ? esc_html($settings['filter_all_label']) : '';

        if ($settings['enable_filter'] == 'yes') {
            ?>
            <div class="eead-fg-normal-filter eead-fg-filter">
                <ul>
                    <?php
                    if (!empty(trim($all_text))) {
                        ?>
                        <li data-load-more-status="0" class="eead-fg-filter-control eead-fg-all-control eead-fg-active" data-filter="*"><?php echo esc_attr($all_text); ?></li>
                        <?php
                    }

                    foreach ($settings['filters_tabs'] as $key => $control) {
                        ?>
                        <li data-load-more-status="0" class="eead-fg-filter-control <?php echo (($key == 0 && empty($settings['filter_all_label'])) ? 'eead-fg-active' : ''); ?>" data-filter=".eead-cf-<?php echo esc_attr(sanitize_title($control['filter_title'])); ?>">
                            <?php echo esc_html($control['filter_title']); ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    }

    protected function render_search_filters() {
        $settings = $this->get_settings_for_display();
        if ($settings['enable_filter'] == 'yes') {
            ?>
            <div class="eead-fg-search-filter eead-fg-filter">
                <div class="eead-fg-filter-box">
                    <div class="eead-fg-select-filter">
                        <button id="eead-fg-filter-trigger" class="eead-fg-filter-trigger">
                            <span>
                                <?php
                                if ($settings['filter_all_label']) {
                                    echo wp_kses_post($settings['filter_all_label']);

                                } elseif (isset($settings['filters_tabs']) && !empty($settings['filters_tabs'])) {
                                    echo $settings['filters_tabs'][0]['filter_title'];
                                }
                                ?>
                            </span>

                            <i class="eead-fg-dropdown-icon"></i>
                        </button>

                        <ul class="eead-fg-filter-dropdown">
                            <?php if ($settings['filter_all_label']) { ?>
                                <li class="eead-fg-filter-control eead-fg-active" data-filter="*"><?php echo wp_kses_post($settings['filter_all_label']); ?></li>
                            <?php } ?>

                            <?php foreach ($settings['filters_tabs'] as $key => $control) {
                                ?>
                                <li data-load-more-status="0" class="eead-fg-filter-control <?php echo (($key == 0 && empty($settings['filter_all_label'])) ? 'eead-fg-active' : ''); ?>" data-filter=".eead-cf-<?php echo esc_attr(sanitize_title($control['filter_title'])); ?>">
                                    <?php echo esc_html($control['filter_title']); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <form class="eead-fg-search-box" id="eead-fg-search-box" autocomplete="off">
                        <input type="text" id="eead-fg-search-input" placeholder="<?php echo $settings['search_filter_placeholder']; ?>" />
                    </form>
                </div>
            </div>
            <?php
        }
    }

    protected function render_loadmore_button() {
        $settings = $this->get_settings_for_display();

        if ($settings['pagination'] == 'yes') {
            ?>
            <div class="eead-fg-loadmore">
                <a href="#" class="eead-fg-loadmore-btn">
                    <span class="eead-fg-btn-loader"></span>
                    <?php
                    Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']);
                    ?>
                    <span>
                        <?php echo wp_kses_post($settings['load_more_text']); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }

    protected function render_filter_class($classes) {
        $classes = explode(',', $classes);
        $classes = array_map(function ($a) {
            return 'eead-cf-' . sanitize_title($a);
        }, $classes);

        return $classes;
    }


    protected function get_gallery_items() {
        $settings = $this->get_settings_for_display();
        $gallery_items = $settings['gallery_items'];
        $gallery_store = [];

        $counter = 0;

        foreach ($gallery_items as $gallery) {
            $gallery_store[$counter]['title'] = $gallery['gallery_item_name'];
            $gallery_store[$counter]['content'] = $gallery['gallery_item_content'];
            $gallery_store[$counter]['image'] = $gallery['gallery_image']['url'];
            $gallery_store[$counter]['image_id'] = $gallery['gallery_image']['id'];
            $gallery_store[$counter]['show_link'] = isset($gallery['gallery_show_link']) && $gallery['gallery_show_link'] == 'yes' ? true : false;
            $gallery_store[$counter]['link'] = $gallery['gallery_image_link'];
            $gallery_store[$counter]['show_video'] = isset($gallery['gallery_show_video']) && $gallery['gallery_show_video'] == 'yes' ? true : false;

            if (isset($gallery['gallery_item_video_link']) && !empty($gallery['gallery_item_video_link']) && (strpos($gallery['gallery_item_video_link'], 'youtu.be') != false)) {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $gallery['gallery_item_video_link'], $matches);
                $gallery_store[$counter]['video_link'] = !empty($matches) ? sprintf('https://www.youtube.com/watch?v=%s', $matches[1]) : '';

            } else {
                $gallery_store[$counter]['video_link'] = isset($gallery['gallery_item_video_link']) && $gallery['gallery_item_video_link'] == 'yes' ? true : false;
            }

            $gallery_store[$counter]['show_lightbox'] = isset($gallery['gallery_show_lighbox']) && $gallery['gallery_show_lighbox'] == 'yes' ? true : false;
            ;
            $gallery_store[$counter]['controls'] = isset($gallery['gallery_filter_name']) && $gallery['gallery_filter_name'] ? implode(' ', $this->render_filter_class($gallery['gallery_filter_name'])) : '';
            $gallery_store[$counter]['show_price'] = isset($gallery['gallery_show_price']) && $gallery['gallery_show_price'] == 'yes' ? true : false;
            $gallery_store[$counter]['price'] = $gallery['gallery_item_price'];
            $gallery_store[$counter]['show_rating'] = isset($gallery['gallery_show_rating']) && $gallery['gallery_show_rating'] == 'yes' ? true : false;
            $gallery_store[$counter]['ratings'] = $gallery['gallery_item_rating'];
            $counter++;
        }

        return $gallery_store;
    }

    protected function render_gallery_thumb($item) {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="eead-fg-item-thumbnail">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo esc_attr(get_post_meta($item['image_id'], '_wp_attachment_image_alt', true)); ?>" class="eead-fg-item-thumbnail-image">

            <?php
            if ('card' == $settings['gallery_style'] && $settings['gallery_link_to'] == 'buttons') {
                ?>
                <div class="eead-fg-item-thumb-caption <?php echo $settings['gallery_hover_style']; ?>">
                    <?php
                    echo $this->render_fg_buttons($item);
                    echo $this->render_fg_video_button($item);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function render_fg_buttons($item) {
        $settings = $this->get_settings_for_display();
        if (!$item['show_video']) {
            ?>
            <div class="eead-fg-item-buttons">
                <?php
                if ($item['show_lightbox']) {
                    ?>
                    <a href="<?php echo esc_url($item['image']); ?>" class="eead-magnific-link" data-elementor-open-lightbox="no">
                        <?php
                        Icons_Manager::render_icon($settings['gallery_zoom_icon'], ['aria-hidden' => 'true']);
                        ?>
                    </a>
                    <?php
                }

                if ($item['show_link']) {
                    $link_attr = 'href="' . esc_url($item['link']['url']) . '"';

                    if ($item['link']['nofollow']) {
                        $link_attr .= 'rel="nofollow"';
                    }

                    if ($item['link']['is_external']) {
                        $link_attr .= 'target="_blank"';
                    }

                    if (!empty($item['link']['url'])) {
                        ?>
                        <a <?php echo $link_attr; ?>>
                            <?php
                            Icons_Manager::render_icon($settings['gallery_link_icon'], ['aria-hidden' => 'true']);
                            ?>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }

    protected function render_fg_video_button($item) {
        $settings = $this->get_settings_for_display();
        if ($item['show_video']) {
            $video_url = isset($item['video_link']) ? $item['video_link'] : '#';
            ?>
            <a href="<?php echo esc_url($video_url); ?>" class="eead-fg-video-popup eead-magnific-link eead-fg-video-link">
                <?php
                Icons_Manager::render_icon($settings['video_play_icon'], ['aria-hidden' => 'true']);
                ?>
            </a>
            <?php
        }
    }

    protected function render_gallery_items($init_show = 0) {
        $settings = $this->get_settings_for_display();
        $gallery = $this->get_gallery_items();
        $caption_hover_class = ('card' !== $settings['gallery_style']) ? $settings['gallery_hover_style'] : '';
        $gallery_markup = [];

        foreach ($gallery as $item) {
            $html = '';
            ob_start();
            ?>
            <div class="eead-fg-item-list <?php echo $item['controls']; ?>" data-search-key="<?php echo esc_attr(strtolower(str_replace(" ", "-", $item['title']))); ?>">
                <div class="eead-fg-item">
                    <?php
                    if ($settings['gallery_link_to'] === 'media') {
                        echo '<a href="' . esc_url($item['image']) . '" class="eead-magnific-link media-content-wrap" data-elementor-open-lightbox="no">';
                    }

                    $this->render_gallery_thumb($item);
                    ?>
                    <div class="eead-fg-item-caption <?php esc_attr_e($caption_hover_class); ?>">

                        <?php if ('overlay' == $settings['gallery_style']) { ?>
                            <div class="eead-fg-item-caption-overlay"></div>
                        <?php } ?>

                        <div class="eead-fg-item-caption-content">
                            <?php
                            if (!empty($item['title'])) {
                                ?>
                                <<?php echo esc_attr($settings['title_tag']); ?> class="eead-fg-item-title">
                                    <?php echo esc_html($item['title']); ?>
                                </<?php echo esc_attr($settings['title_tag']); ?>>
                                <?php
                            }

                            if ($item['show_price'] || $item['show_rating']) {
                                ?>
                                <div class="eead-fg-caption-head">
                                    <?php
                                    if ($item['show_price']) {
                                        ?>
                                        <div class="eead-fg-item-price">
                                            <?php echo $item['price']; ?>
                                        </div>
                                        <?php
                                    }
                                    if ($item['show_rating']) {
                                        ?>
                                        <div class="eead-fg-item-ratings">
                                            <i class="fas fa-star"></i>
                                            <?php echo $item['ratings']; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }

                            if (!empty($item['content'])) {
                                ?>
                                <div class="eead-fg-item-content"><?php echo esc_html($item['content']); ?></div>
                                <?php
                            }

                            if ('card' !== $settings['gallery_style'] && $settings['gallery_link_to'] == 'buttons') {
                                echo $this->render_fg_buttons($item);
                                echo $this->render_fg_video_button($item);
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($settings['gallery_link_to'] == 'media') {
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
            <?php
            $html = ob_get_clean();

            $gallery_markup[] = $this->minifyHTML($html);
        }

        return $gallery_markup;

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $filter_duration = !empty($settings['filter_duration']) ? $settings['filter_duration'] : 500;
        $total_items = count($settings['gallery_items']);
        $items_to_show = isset($settings['items_to_show']) ? $settings['items_to_show'] : $total_items;

        $gallery_settings = [
            'grid_style' => $settings['gallery_grid_style'],
            'duration' => $filter_duration,
            'gallery_enabled' => $settings['enable_gallery'],
            'filter_type' => $settings['filter_type'],
        ];

        $no_more_items_text = $settings['nomore_items_text'];
        $gallery_style = 'eead-fg-style-' . $settings['gallery_style'];

        $this->add_render_attribute('gallery-items-wrap', [
            'class' => ['eead-filter-gallery-container', $gallery_style],
            'data-images-per-page' => $settings['images_per_page'],
            'data-total-gallery-items' => $total_items,
            'data-nomore-item-text' => $no_more_items_text,
            'data-init-show' => $items_to_show,
            'data-settings' => wp_json_encode($gallery_settings),
            'data-gallery-items' => wp_json_encode($this->render_gallery_items())
        ]);
        ?>

        <div id="eead-filter-gallery-container-<?php echo $id; ?>" class="eead-filter-gallery">

            <?php
            if ($settings['filter_type'] == 'normal') {
                $this->render_filters();
            } else {
                $this->render_search_filters();
            }
            ?>

            <div <?php $this->print_render_attribute_string('gallery-items-wrap'); ?>>
                <?php
                for ($i = 0; $i < $items_to_show; $i++) {
                    if (array_key_exists($i, $this->render_gallery_items())) {
                        echo $this->render_gallery_items()[$i];
                    }
                }
                ?>
            </div>

            <?php
            $this->render_loadmore_button();

            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                $this->render_editor_script();
            }
            ?>
        </div>
        <?php
    }

    /**
     * Render masonry script
     *
     * @access protected
     */
    protected function render_editor_script() {
        $id = '#eead-filter-gallery-container-' . $this->get_id();
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                setTimeout(function () {
                    var $container = $('<?php echo $id; ?>'),
                        $gallery = $container.find('.eead-filter-gallery-container'),
                        $settings = $gallery.data("settings"),
                        fg_items = $gallery.data("gallery-items"),
                        $init_show_setting = $gallery.data("init-show"),
                        $layout_mode = $settings.grid_style === "masonry" ? "masonry" : "fitRows",
                        $gallery_enabled = $settings.gallery_enabled === "yes",
                        filterType = $settings.filter_type,
                        buttonFilter;

                    // setup isotope
                    var $isotope_gallery = $gallery.isotope({
                        itemSelector: ".eead-fg-item-list",
                        layoutMode: $layout_mode,
                        percentPosition: true,
                        stagger: 30,
                        transitionDuration: $settings.duration + "ms",
                        filter: function filter() {
                            var $this = $(this);
                            if (filterType == "normal") {
                                buttonFilter = $container.find(".eead-fg-normal-filter ul li").first().attr("data-filter");
                            } else {
                                buttonFilter = $container.find(".eead-fg-search-filter ul li").first().attr("data-filter");
                            }
                            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                            return buttonResult;
                        }
                    });
                    $isotope_gallery.addClass('eead-isotope-initialized');
                }, 1000);
            });
        </script>
        <?php
    }
}