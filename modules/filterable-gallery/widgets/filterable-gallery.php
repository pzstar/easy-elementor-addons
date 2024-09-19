<?php

namespace EasyElementorAddons\Modules\FilterableGallery\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
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
                'label' => esc_html__('All Gallery Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
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
                    ['filter_control' => 'Control Name'],
                ],
                'fields' => [
                    [
                        'name' => 'filter_control',
                        'label' => esc_html__('Control Name', 'easy-elementor-addons'),
                        'type' => Controls_Manager::TEXT,
                        'dynamic' => ['active' => true],
                        'label_block' => true,
                        'default' => esc_html__('Gallery Control Name', 'easy-elementor-addons'),
                    ],
                ],
                'title_field' => '{{filter_control}}',
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

        $this->add_control(
            'enable_gallery',
            [
                'label' => esc_html__('Enable Photo Gallery', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true,
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
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => esc_html__('Item Name', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'gallery_item_content',
            [
                'label' => esc_html__('Item Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elit.'
            ]
        );

        $repeater->add_control(
            'gallery_filter_name',
            [
                'label' => esc_html__('Control Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '',
                'description' => esc_html__('Enter the control name from Filterable Control Settings, separated with comma. | e.g. Control 1, Control 2', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'gallery_show_price',
            [
                'label' => esc_html__('Show Price', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true'
            ]
        );

        $repeater->add_control(
            'gallery_item_price',
            [
                'label' => esc_html__('Item Price', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('$100', 'easy-elementor-addons'),
                'condition' => [
                    'gallery_show_price' => 'true'
                ]
            ]
        );

        $repeater->add_control(
            'gallery_show_rating',
            [
                'label' => esc_html__('Show Ratings', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true'
            ]
        );

        $repeater->add_control(
            'gallery_item_rating',
            [
                'label' => esc_html__('Item Ratings', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('5', 'easy-elementor-addons'),
                'condition' => [
                    'gallery_show_rating' => 'true'
                ]
            ]
        );

        $repeater->add_control(
            'gallery_show_category',
            [
                'label' => esc_html__('Show Category', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true'
            ]
        );

        $repeater->add_control(
            'gallery_item_category',
            [
                'label' => esc_html__('Item Category', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('Landscapes', 'easy-elementor-addons'),
                'condition' => [
                    'gallery_show_category' => 'true'
                ]
            ]
        );

        $repeater->add_control(
            'gallery_show_video',
            [
                'label' => esc_html__('Enable Video', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true',
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
                    'gallery_show_video' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_show_lighbox',
            [
                'label' => esc_html__('Lightbox Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true',
                'condition' => [
                    'gallery_show_video!' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_show_link',
            [
                'label' => esc_html__('Link Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'true',
                'condition' => [
                    'gallery_show_video!' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'gallery_image_link',
            [
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition' => [
                    'gallery_show_video!' => 'true',
                    'gallery_show_link' => 'true',
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

        $this->add_control(
            'gallery_style',
            [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hoverer',
                'options' => [
                    'hoverer' => esc_html__('Overlay', 'easy-elementor-addons'),
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
                    'eead-slide-up' => esc_html__('Slide In Up', 'easy-elementor-addons'),
                    'eead-fade-in' => esc_html__('Fade In', 'easy-elementor-addons'),
                    'eead-zoom-in' => esc_html__('Zoom In ', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'gallery_style' => 'hoverer',
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
            'gallery_popup_caption',
            [
                'label' => esc_html__('Enable Popup Caption', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'easy-elementor-addons'),
                'label_off' => esc_html__('Hide', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
            'items_to_show',
            [
                'label' => esc_html__('Items To Display', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => false,
                'default' => 6,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'filter_duration',
            [
                'label' => esc_html__('Animation Duration (ms)', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 500,
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
                'frontend_available' => true,
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
            ]
        );

        $this->add_control(
            'gallery_image_height',
            [
                'label' => esc_html__('Image Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '300',
                'condition' => [
                    'gallery_grid_style' => 'grid',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item .eead-fg-item-thumbnail' => 'height: {{VALUE}}px;',
                ],
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
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'load_more_align',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eead-filterable-gallery-loadmore' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'images_per_page',
            [
                'label' => esc_html__('Images Per Load', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 6,
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
                'dynamic' => ['active' => true],
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
                'dynamic' => ['active' => true],
                'default' => esc_html__('No more items!', 'easy-elementor-addons'),
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'sm',
                'options' => [
                    'xs' => esc_html__('Extra Small', 'easy-elementor-addons'),
                    'sm' => esc_html__('Small', 'easy-elementor-addons'),
                    'md' => esc_html__('Medium', 'easy-elementor-addons'),
                    'lg' => esc_html__('Large', 'easy-elementor-addons'),
                    'xl' => esc_html__('Extra Large', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Button Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
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
                'default' => 'after',
                'options' => [
                    'after' => esc_html__('After', 'easy-elementor-addons'),
                    'before' => esc_html__('Before', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Gallery Content Wrap Style
         */
        $this->start_controls_section(
            'section_fg_style_settings',
            [
                'label' => esc_html__('Gallery Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery',
            ]
        );

        $this->add_control(
            'fg_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery',
            ]
        );

        $this->add_control(
            'fg_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_container_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Control Style
         */
        $this->start_controls_section(
            'section_fg_control_style_settings',
            [
                'label' => esc_html__('Control', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style!' => 'layout_3'
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_control_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_control_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_control_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery-control ul li.control',
            ]
        );

        $this->start_controls_tabs('fg_control_tabs');

        $this->start_controls_tab('fg_control_normal', [
            'label' => esc_html__('Normal', 'easy-elementor-addons')
        ]);

        $this->add_control(
            'fg_control_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_control_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_control_normal_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery-control ul > li.control',
            ]
        );

        $this->add_control(
            'fg_control_normal_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul > li.control' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_control_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery-control ul li.control',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('cta_btn_hover', [
            'label' => esc_html__('Active', 'easy-elementor-addons')
        ]);

        $this->add_control(
            'fg_control_active_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.eead-fg-active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_control_active_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control.eead-fg-active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_control_active_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-filter-gallery-control ul > li.control.eead-fg-active',
            ]
        );

        $this->add_control(
            'fg_control_active_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-filter-gallery-control ul li.control.eead-fg-active' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_control_active_shadow',
                'selector' => '{{WRAPPER}} .eead-filter-gallery-control ul li.control.eead-fg-active',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Filterable Gallery Item Style
         */
        $this->start_controls_section(
            'section_fg_item_style_settings',
            [
                'label' => esc_html__('Item', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_item_shadow',
                'selector' => '{{WRAPPER}} .eead-fg-item-list.eead-fg-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_item_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-list.eead-fg-item',
            ]
        );

        $this->add_control(
            'fg_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fg_grid_hover_transition',
            [
                'label' => esc_html__('Hover Transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'px' => [
                        'max' => 4000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption' => 'transition: {{SIZE}}ms;',
                ],
                'condition' => [
                    'gallery_hover_style!' => 'eead-none',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_container_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Gallery Hoverer Style
         */
        $this->start_controls_section(
            'section_fg_item_cap_style_settings',
            [
                'label' => esc_html__('Item Hover', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => ['hoverer']
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_hoverer_content_alignment',
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
                'prefix_class' => 'eead-fg-hoverer-content-align-',
            ]
        );

        $this->add_control(
            'fg_item_cap_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.7)',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .gallery-item-hoverer-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_cap_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_hover_title_typography_heading',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_item_hover_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer .fg-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_hover_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer .fg-item-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_item_hover_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer .fg-item-title',
            ]
        );

        $this->add_control(
            'fg_item_hover_content_typography_heading',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_item_hover_content_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer .fg-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_item_hover_content_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer .fg-item-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_item_cap_shadow',
                'selector' => '{{WRAPPER}} .eead-fg-item-thumbnail .eead-fg-item-caption',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_item_cap_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption.caption-style-hoverer',
            ]
        );

        $this->end_controls_section();

        /**
         * Layout 3 Thumb Image Style
         */
        $this->start_controls_section(
            'fg_item_thumb_style',
            [
                'label' => esc_html__('Thumbnail Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_item_thubm_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .fg-layout-3-item-thumb',
            ]
        );

        $this->add_responsive_control(
            'fg_item_thubm_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fg-layout-3-item-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fg-layout-3-item .eead-fg-item-caption.card-hover-bg.caption-style-hoverer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Video Gallery Item Style
         */
        $this->start_controls_section(
            'section_fg_video_item_style',
            [
                'label' => esc_html__('Video item hover', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style!' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'fg_video_item_hover_bg',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, .7)',
                'selectors' => [
                    '{{WRAPPER}} .video-popup-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_video_item_hover_bg_trans',
            [
                'label' => esc_html__('Background transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'px' => 350,
                ],
                'range' => [
                    'px' => [
                        'max' => 4000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-popup-bg' => 'transition: {{SIZE}}ms;',
                ],
            ]
        );

        $this->add_control(
            'fg_video_item_hover_icon_size',
            [
                'label' => esc_html__('Icon size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'default' => [
                    'px' => 62,
                ],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ],
                    'em' => [
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-popup > img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fg_video_item_icon_hover_scale',
            [
                'label' => esc_html__('Hover icon scale', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '1.1',
                'selectors' => [
                    '{{WRAPPER}} .video-popup:hover > img' => 'transform: scale({{VALUE}});',
                ],
            ]
        );

        $this->add_control(
            'fg_video_item_icon_hover_scale_transition',
            [
                'label' => esc_html__('Icon transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'px' => 350,
                ],
                'range' => [
                    'px' => [
                        'max' => 4000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-popup > img' => 'transition: {{SIZE}}ms;',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Card Gallery Item Style
         */
        $this->start_controls_section(
            'section_fg_item_content_style_settings',
            [
                'label' => esc_html__('Gallery Card', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => ['card', 'layout_3']
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_content_alignment',
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
                'prefix_class' => 'eead-fg-card-content-align-',
            ]
        );

        $this->add_control(
            'fg_item_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f1f2f9',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item-caption.caption-style-card' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .fg-layout-3-item-content' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'gallery_style' => 'card'
                ],
            ]
        );

        $this->add_control(
            'fg_item_layout_3_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .fg-layout-3-item-content' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'fg_item_card_hover_bg_color',
            [
                'label' => esc_html__('Hover Overlay Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.7)',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.card-hover-bg' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'gallery_style' => ['card', 'layout_3']
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_item_content_shadow',
                'selector' => '{{WRAPPER}} .eead-fg-item-list.eead-fg-item-caption.caption-style-card, {{WRAPPER}} .fg-layout-3-item-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_item_content_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-list.eead-fg-item-caption.caption-style-card, {{WRAPPER}} .fg-layout-3-item-content',
            ]
        );

        $this->add_responsive_control(
            'fg_item_content_container_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-list.eead-fg-item-caption.caption-style-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .fg-layout-3-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_content_title_typography_settings',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_item_content_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-card .fg-item-title' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'gallery_style' => 'card'
                ],
            ]
        );

        $this->add_control(
            'fg_item_layout_3_content_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#031d3c',
                'selectors' => [
                    '{{WRAPPER}} .fg-layout-3-item-content .fg-item-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gallery_style' => 'layout_3'
                ],
            ]
        );

        $this->add_control(
            'fg_item_content_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-card .fg-item-title:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .fg-layout-3-item-content .fg-item-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_item_content_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption.caption-style-card .fg-item-title, {{WRAPPER}} .fg-layout-3-item-content .fg-item-title',
            ]
        );

        $this->add_control(
            'fg_item_content_text_typography_settings',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_item_content_text_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption.caption-style-card .fg-item-content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gallery_style' => 'card'
                ],
            ]
        );

        $this->add_control(
            'fg_item_layout_3_content_text_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7f8995',
                'selectors' => [
                    '{{WRAPPER}} .fg-layout-3-item-content .fg-item-content p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gallery_style' => 'layout_3'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_item_content_text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption.caption-style-card .fg-item-content, {{WRAPPER}} .fg-layout-3-item-content .fg-item-content p',
            ]
        );

        $this->end_controls_section();

        /**
         * Hoverer Icon Style
         */
        $this->start_controls_section(
            'section_fg_item_hover_icons_style',
            [
                'label' => esc_html__('Icons', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'fg_item_icon_exact_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 120,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_icon_size',
            [
                'label' => esc_html__('Icon Font Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                    'em' => [
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_item_icon_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span',
            ]
        );

        $this->add_control(
            'fg_item_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_icon_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'fg_item_icon_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('fg_icons_style');

        $this->start_controls_tab(
            'fg_icons_style_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'fg_item_icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3c25f7',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'fg_icons_style_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'fg_item_icon_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3c25f7',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_icon_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'fg_item_icon_transition',
            [
                'label' => esc_html__('Transition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-item-caption .eead-fg-item-buttons > a span' => 'transition: {{SIZE}}ms;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_item_price_style',
            [
                'label' => esc_html__('Price', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'gallery_item_price_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fg-caption-head .fg-item-price' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'gallery_item_price_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .fg-caption-head .fg-item-price'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_item_rating_style',
            [
                'label' => esc_html__('Ratings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'gallery_item_rating_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fg-caption-head .fg-item-ratings' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'gallery_item_rating_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .fg-caption-head .fg-item-ratings'
            ]
        );

        $this->add_control(
            'gallery_item_rating_star_color',
            [
                'label' => esc_html__('Star Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fg-caption-head .fg-item-ratings i' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'gallery_item_categoryegory_style',
            [
                'label' => esc_html__('Category', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'gallery_item_categoryegory_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .fg-item-category span'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gallery_item_categoryegory_background',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fg-item-category span',
            ]
        );

        $this->add_responsive_control(
            'gallery_item_categoryegory_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fg-item-category span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'fg_search_form_style',
            [
                'label' => esc_html__('Search Form', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gallery_style' => 'layout_3'
                ]
            ]
        );

        $this->add_control(
            'fg_sf_controls',
            [
                'label' => esc_html__('Controls', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_sf_controls_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7f8995',
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap button' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'fg_sf_controls_background',
            [
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap button' => 'background: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_sf_controls_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-filter-trigger > span'
            ]
        );

        $this->add_responsive_control(
            'fg_sf_controls_icon_space',
            [
                'label' => esc_html__('Icon Space', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-trigger > i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fg-filter-trigger img' => 'margin-left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_controls_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 14,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-trigger > i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-fg-filter-trigger img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_controls_width',
            [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                    '%' => [
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_controls_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_controls_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_sf_controls_box_shadow',
                'selector' => '{{WRAPPER}} .fg-filter-wrap button'
            ]
        );

        $this->add_control(
            'fg_sf_separator',
            [
                'label' => esc_html__('Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'sf_left_border_size',
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
                    '{{WRAPPER}} .fg-filter-wrap button' => 'border-right: {{SIZE}}px solid;',
                ]
            ]
        );

        $this->add_control(
            'sf_left_border_color',
            [
                'label' => esc_html__('Separator Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#abb5ff',
                'selectors' => [
                    '{{WRAPPER}} .fg-filter-wrap button' => 'border-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'fg_sf',
            [
                'label' => esc_html__('Form', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'fg_sf_background',
            [
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filters .eead-fg-search-box' => 'background: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'fg_sf_placeholder',
            [
                'label' => esc_html__('Placeholder', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search Gallery Item...', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'fg_sf_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-search-box input[type="text"]::-webkit-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-fg-search-box input[type="text"]::-moz-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-fg-search-box input[type="text"]:-ms-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .eead-fg-search-box input[type="text"]:-moz-placeholder' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_form_width',
            [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                    '%' => [
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-search-box' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_form_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filters .eead-fg-search-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'fg_sf_form_box_shadow',
                'selector' => '{{WRAPPER}} .eead-fg-filters .eead-fg-search-box'
            ]
        );

        $this->add_control(
            'fg_sf_dropdown',
            [
                'label' => esc_html__('Dropdown', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'fg_sf_dropdown_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-dropdown li.control' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'fg_sf_dropdown_hover_color',
            [
                'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-dropdown li.control:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'fg_sf_dropdown_bg',
                'types' => ['classic', 'gradient'],
                'exclude' => [
                    'image',
                ],
                'selector' => '{{WRAPPER}} .eead-fg-filter-dropdown',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fg_sf_dropdown_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-fg-filter-dropdown li.control'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'fg_sf_dropdown_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'selector' => '{{WRAPPER}} .eead-fg-filter-dropdown li.control'
            ]
        );

        $this->add_responsive_control(
            'fg_sf_dropdown_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-dropdown li.control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'fg_sf_dropdown_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-fg-filter-dropdown.open-filters' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Load More Button Style
         */
        $this->start_controls_section(
            'section_loadmore_button_style',
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
                'selector' => '{{WRAPPER}} .eead-gallery-load-more .eead-filterable-gallery-load-more-text',
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'load_more_button_box_shadow',
                'selector' => '{{WRAPPER}} .eead-gallery-load-more',
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin_top',
            [
                'label' => esc_html__('Top Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more .eead-filterable-gallery-load-more-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-gallery-load-more img.eead-filterable-gallery-load-more-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ]
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
                    '{{WRAPPER}} .eead-gallery-load-more .fg-load-more-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-gallery-load-more .fg-load-more-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .eead-gallery-load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'load_more_button_border_normal',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-gallery-load-more',
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_load_more_button_style');

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
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_text_color_normal',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-load-more:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination' => 'yes',
                    'load_more_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function sorter_class($string) {
        $sorter_class = strtolower($string);
        $sorter_class = str_replace(' ', '-', $sorter_class);
        $sorter_class = str_replace('&', 'and', $sorter_class);
        $sorter_class = str_replace('amp;', '', $sorter_class);
        $sorter_class = str_replace('/', 'slash', $sorter_class);
        $sorter_class = str_replace("'", 'apostrophe', $sorter_class);
        $sorter_class = str_replace('"', 'apostrophe', $sorter_class);
        $sorter_class = str_replace(',-', ' eead-cf-', $sorter_class);
        $sorter_class = str_replace('.', '-', $sorter_class);
        $sorter_class = str_replace(',', ' ', $sorter_class);
        return $sorter_class;
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
        $all_text = ($settings['filter_all_label'] != '') ? esc_html($settings['filter_all_label']) : esc_html__('All', 'easy-elementor-addons');

        if ($settings['enable_filter'] == 'yes') {
            ?>
            <div class="eead-filter-gallery-control">
                <ul>
                    <?php
                    if (trim($all_text)) {
                        ?>
                        <li data-load-more-status="0" class="eead-fg-filter-control eead-fg-all-control eead-fg-active" data-filter="*"><?php echo esc_attr($all_text); ?></li>
                        <?php
                    }

                    foreach ($settings['filters_tabs'] as $key => $control) {
                        ?>
                        <li data-load-more-status="0" class="eead-fg-filter-control <?php echo (($key == 0 && empty($settings['filter_all_label'])) ? 'eead-fg-active' : ''); ?>" data-filter=".eead-cf-<?php echo esc_attr(sanitize_title($control['filter_control'])); ?>">
                            <?php echo esc_html($control['filter_control']); ?>
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
            <div class="eead-fg-filters">
                <div class="fg-filter-wrap">
                    <button id="eead-fg-filter-trigger" class="eead-fg-filter-trigger">
                        <span>
                            <?php
                            if ($settings['filter_all_label']) {
                                echo wp_kses_post($settings['filter_all_label']);

                            } elseif (isset($settings['filters_tabs']) && !empty($settings['filters_tabs'])) {
                                echo $settings['filters_tabs'][0]['filter_control'];
                            }
                            ?>
                        </span>

                        <i class="fas fa-angle-down"></i>
                    </button>

                    <ul class="eead-fg-filter-dropdown">
                        <?php if ($settings['filter_all_label']) { ?>
                            <li class="eead-fg-filter-control eead-fg-active" data-filter="*"><?php echo wp_kses_post($settings['filter_all_label']); ?></li>
                        <?php } ?>

                        <?php foreach ($settings['filters_tabs'] as $key => $control) {
                            ?>
                            <li class="eead-fg-filter-control <?php echo (($key == 0 && empty($settings['filter_all_label'])) ? 'eead-fg-active' : ''); ?>" data-filter=".eead-cf-<?php echo esc_attr(sanitize_title($control['filter_control'])); ?>">
                                <?php echo esc_html($control['filter_control']); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <form class="eead-fg-search-box" id="eead-fg-search-box" autocomplete="off">
                    <input type="text" id="eead-fg-search-input" placeholder="<?php echo $settings['fg_sf_placeholder']; ?>" />
                </form>

            </div>
            <?php
        }
    }

    protected function render_gallery_item() {
        $settings = $this->get_settings_for_display();
    }

    protected function render_loadmore_button() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('load-more-button', 'class', [
            'eead-gallery-load-more',
            'elementor-button',
            'elementor-size-' . $settings['button_size'],
        ]);

        if ($settings['pagination'] == 'yes') {
            ?>
            <div class="eead-filterable-gallery-loadmore">
                <a href="#" <?php $this->print_render_attribute_string('load-more-button'); ?>>
                    <span class="eead-btn-loader"></span>
                    <?php
                    Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']);
                    ?>
                    <span class="eead-filterable-gallery-load-more-text">
                        <?php echo wp_kses_post($settings['load_more_text']); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }

    protected function render_gallery_class($classes) {
        $classes = explode(',', $classes);
        $classes = array_map(function ($a) {
            return 'eead-cf-' . sanitize_title($a);
        }, $classes);

        return $classes;
    }


    protected function gallery_items() {
        $settings = $this->get_settings_for_display();
        $gallery_items = $settings['gallery_items'];
        $gallery_store = [];

        $counter = 0;

        foreach ($gallery_items as $gallery) {
            $gallery_store[$counter]['title'] = $gallery['gallery_item_name'];
            $gallery_store[$counter]['content'] = $gallery['gallery_item_content'];
            $gallery_store[$counter]['id'] = $gallery['_id'];
            $gallery_store[$counter]['image'] = $gallery['gallery_image'];
            $gallery_store[$counter]['image'] = $gallery['gallery_image']['url'];
            $gallery_store[$counter]['image_id'] = $gallery['gallery_image']['id'];
            $gallery_store[$counter]['maybe_link'] = $gallery['gallery_show_link'];
            $gallery_store[$counter]['link'] = $gallery['gallery_image_link'];
            $gallery_store[$counter]['video_gallery_switch'] = $gallery['gallery_show_video'];

            if (isset($gallery['gallery_item_video_link']) && !empty($gallery['gallery_item_video_link']) && (strpos($gallery['gallery_item_video_link'], 'youtu.be') != false)) {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $gallery['gallery_item_video_link'], $matches);
                $gallery_store[$counter]['video_link'] = !empty($matches) ? sprintf('https://www.youtube.com/watch?v=%s', $matches[1]) : '';

            } else {
                $gallery_store[$counter]['video_link'] = $gallery['gallery_item_video_link'];
            }

            $gallery_store[$counter]['show_lightbox'] = $gallery['gallery_show_lighbox'];
            $gallery_store[$counter]['controls'] = isset($gallery['gallery_filter_name']) && $gallery['gallery_filter_name'] ? implode(' ', $this->render_gallery_class($gallery['gallery_filter_name'])) : '';
            $gallery_store[$counter]['price_switch'] = $gallery['gallery_show_price'];
            $gallery_store[$counter]['price'] = $gallery['gallery_item_price'];
            $gallery_store[$counter]['ratings_switch'] = $gallery['gallery_show_rating'];
            $gallery_store[$counter]['ratings'] = $gallery['gallery_item_rating'];
            $gallery_store[$counter]['category_switch'] = $gallery['gallery_show_category'];
            $gallery_store[$counter]['category'] = $gallery['gallery_item_category'];
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
            if ($settings['gallery_link_to'] == 'buttons') {
                ?>
                <div class="eead-fg-item-caption card-hover-bg caption-style-hoverer <?php echo $settings['gallery_hover_style']; ?>">
                    <?php $this->render_fg_buttons($item); ?>
                </div>
                <?php
            }

            if (isset($item['video_gallery_switch']) && ($item['video_gallery_switch'] === 'true')) {
                $icon_url = isset($item['play_icon']['url']) ? $item['play_icon']['url'] : '';
                $video_url = isset($item['video_link']) ? $item['video_link'] : '#';
                ?>
                <a href="<?php echo esc_url($video_url); ?>" class="video-popup eead-magnific-link eead-magnific-video-link mfp-iframe">
                    <div class="video-popup-bg"></div>
                    <?php if (!empty($icon_url)) { ?>
                        <img src="<?php echo esc_url($icon_url); ?>">
                    <?php } ?>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function render_fg_buttons($item) {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="eead-fg-item-buttons">
            <?php
            if ($item['show_lightbox']) {
                ?>
                <a href="<?php echo esc_url($item['image']); ?>" class="eead-magnific-link" data-elementor-open-lightbox="no">
                    <span class="fg-item-icon-inner">
                        <?php
                        Icons_Manager::render_icon($settings['gallery_zoom_icon'], ['aria-hidden' => 'true']);
                        ?>
                    </span>
                </a>
                <?php
            }

            if ($item['maybe_link']) {
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
                        <span class="fg-item-icon-inner">
                            <?php
                            Icons_Manager::render_icon($settings['gallery_link_icon'], ['aria-hidden' => 'true']);
                            ?>
                        </span>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }

    protected function render_gallery_items($init_show = 0) {
        $settings = $this->get_settings_for_display();
        $gallery = $this->gallery_items();
        $gallery_markup = [];
        $caption_style = $settings['gallery_style'] == 'card' ? 'caption-style-card' : 'caption-style-hoverer';

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
                    <div class="eead-fg-item-caption <?php echo $caption_style; ?> <?php echo $settings['gallery_hover_style']; ?>">

                        <?php if ('hoverer' == $settings['gallery_style']) { ?>
                            <div class="gallery-item-hoverer-bg"></div>
                        <?php } ?>

                        <div class="gallery-item-caption-over">
                            <?php
                            if (!empty($item['title'])) {
                                ?>
                                <<?php echo esc_attr($settings['title_tag']); ?> class="fg-item-title">
                                    <?php echo esc_html($item['title']); ?>
                                </<?php echo esc_attr($settings['title_tag']); ?>>
                                <?php
                            }

                            if (!empty($item['content'])) {
                                ?>
                                <div class="fg-item-content"><?php echo wpautop($item['content']); ?></div>
                                <?php
                            }

                            if ($settings['gallery_link_to'] == 'buttons') {
                                echo $this->render_fg_buttons($item);
                            }
                            ?>
                            <div class="fg-caption-head">
                                <?php
                                if (isset($item['price_switch']) && $item['price_switch'] == 'true') {
                                    ?>
                                    <div class="fg-item-price">
                                        <?php echo $item['price']; ?>
                                    </div>
                                    <?php
                                }
                                if (isset($item['ratings_switch']) && $item['ratings_switch'] == 'true') {
                                    ?>
                                    <div class="fg-item-ratings">
                                        <i class="fas fa-star"></i>
                                        <?php echo $item['ratings']; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

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

            $gallery_markup[] = $this->minifyHTML(html: $html);
        }

        return $gallery_markup;

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $filter_duration = !empty($settings['filter_duration']) ? $settings['filter_duration'] : 500;

        $this->add_render_attribute(
            'gallery',
            [
                'class' => 'eead-filter-gallery',
                'data-filter-type' => $settings['filter_type'],
                'data-mfp_caption' => $settings['gallery_popup_caption']
            ]
        );

        $gallery_settings = [
            'grid_style' => $settings['gallery_grid_style'],
            'popup' => $settings['gallery_link_to'],
            'duration' => $filter_duration,
            'gallery_enabled' => $settings['enable_gallery'],
        ];

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            //$gallery_settings['post_id'] = \Elementor\Plugin::$instance->editor->get_post_id();
        } else {
            //$gallery_settings['post_id'] = get_the_ID();
        }

        //$gallery_settings['widget_id'] = $this->get_id();
        $no_more_items_text = $settings['nomore_items_text'];
        $grid_class = $settings['gallery_grid_style'] == 'grid' ? 'eead-filter-gallery-grid' : 'masonry';

        $this->add_render_attribute('gallery-items-wrap', [
            'class' => ['eead-filter-gallery-container', $grid_class],
            'data-images-per-page' => $settings['images_per_page'],
            'data-total-gallery-items' => count($settings['gallery_items']),
            'data-nomore-item-text' => $no_more_items_text,
            'data-init-show' => $settings['items_to_show'],
            'data-settings' => wp_json_encode($gallery_settings),
            'data-gallery-items' => wp_json_encode($this->render_gallery_items())
        ]);
        ?>

        <div <?php $this->print_render_attribute_string('gallery'); ?>>

            <?php
            if ($settings['filter_type'] == 'normal') {
                $this->render_filters();
            } else {
                $this->render_search_filters();
            }
            ?>

            <div <?php $this->print_render_attribute_string('gallery-items-wrap'); ?>>
                <?php
                $init_show = absint($settings['items_to_show']);

                for ($i = 0; $i < $init_show; $i++) {
                    if (array_key_exists($i, $this->render_gallery_items())) {
                        echo $this->render_gallery_items()[$i];
                    }
                }
                ?>
            </div>

            <?php
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                //$this->render_editor_script();
            }

            $this->render_loadmore_button();
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
        ?>
        <script type="text/javascript">jQuery(document).ready(function ($) {
                $('.eead-filter-gallery-container').each(function () {
                    var $node_id = '<?php echo $this->get_id(); ?>',
                        $scope = $('[data-id="' + $node_id + '"]'),
                        $gallery = $(this),
                        $settings = $gallery.data('settings'),
                        fg_items = $gallery_items = $gallery.data('gallery-items'),
                        $layout_mode = ($settings.grid_style == 'masonry' ? 'masonry' : 'fitRows'),
                        $gallery_enabled = ($settings.gallery_enabled == 'yes' ? true : false),
                        input = $scope.find('#eead-fg-search-input'),
                        searchRegex, buttonFilter, timer;
                    $init_show_setting = $gallery.data("init-show");
                    fg_items.splice(0, $init_show_setting)
                    var filterControls = $scope.find(".eead-fg-filter-dropdown").eq(0)

                    if ($gallery.closest($scope).length < 1) {
                        return;
                    }

                    // init isotope
                    var layoutMode = $('.eead-filter-gallery').data('layout-mode');
                    var mfpCaption = $('.eead-filter-gallery').data('mfp_caption');

                    var $isotope_gallery = $gallery.isotope({
                        itemSelector: '.eead-filterable-gallery-item-wrap',
                        layoutMode: $layout_mode,
                        percentPosition: true,
                        filter: function () {
                            var $this = $(this);
                            var $result = searchRegex ? $this.text().match(searchRegex) : true;

                            if (buttonFilter == undefined) {
                                if (layoutMode != 'layout_3') {
                                    buttonFilter = $scope.find('.eead-filter-gallery-control ul li').first().data('filter');
                                } else {
                                    buttonFilter = $scope.find('.eead-fg-filter-dropdown li').first().data('filter');
                                }
                            }

                            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                            return $result && buttonResult;
                        }
                    });

                    // Popup
                    $($scope).magnificPopup({
                        delegate: ".eead-magnific-link",
                        type: "image",
                        gallery: {
                            enabled: $gallery_enabled
                        },
                        image: {
                            titleSrc: function (item) {
                                if (mfpCaption == "yes") {
                                    return item.el.parents('.gallery-item-caption-over').find('.fg-item-title').html() || item.el.parents('.eead-fg-item-caption').find('.fg-item-title').html() || item.el.parents('.eead-filterable-gallery-item-wrap').find('.fg-item-title').html();
                                }
                            }
                        }
                    });

                    // filter
                    $scope.on("click", ".control", function () {
                        var $this = $(this);
                        buttonFilter = $(this).attr('data-filter');
                        //delegateAbc = $(this).attr('data-filter') + ' a.eead-magnific-link';

                        if ($scope.find('#eead-fg-filter-trigger > span')) {
                            $scope.find('#eead-fg-filter-trigger > span').text($this.text());
                        }

                        $this.siblings().removeClass("active");
                        $this.addClass("active");
                        $isotope_gallery.isotope();
                    });

                    //quick search
                    input.on('input', function () {
                        var $this = $(this);
                        clearTimeout(timer);
                        timer = setTimeout(function () {
                            searchRegex = new RegExp($this.val(), 'gi');
                            $isotope_gallery.isotope();
                        }, 600);
                    });

                    // not necessary, just in case
                    $isotope_gallery.imagesLoaded().progress(function () {
                        $isotope_gallery.isotope('layout');
                    });

                    // resize
                    $('.eead-filterable-gallery-item-wrap', $gallery).resize(function () {
                        $isotope_gallery.isotope('layout');
                    });

                    // Load more button
                    $scope.on("click", ".eead-gallery-load-more", function (e) {
                        e.preventDefault();

                        var $this = $(this),
                            $init_show = $(".eead-filter-gallery-container", $scope).children(".eead-filterable-gallery-item-wrap").length,
                            $total_items = $gallery.data("total-gallery-items"),
                            $images_per_page = $gallery.data("images-per-page"),
                            $nomore_text = $gallery.data("nomore-item-text"),
                            enable_filter = $(".eead-filter-gallery-control", $scope).length,
                            $items = [];
                        var filter_name = $(".eead-filter-gallery-control li.eead-fg-active'", $scope).data('filter');

                        if (filterControls.length > 0) {
                            filter_name = $(".eead-fg-filter-dropdown li.eead-fg-active'", $scope).data('filter');
                        }

                        let item_found = 0;
                        let index_list = []
                        for (const [index, item] of fg_items.entries()) {
                            if (filter_name !== '' && filter_name !== '*' && enable_filter) {
                                let element = $($(item)[0]);
                                if (element.is(filter_name)) {
                                    ++item_found;
                                    $items.push($(item)[0]);
                                    index_list.push(index);
                                }

                                if ((fg_items.length - 1) === index) {
                                    $(".eead-filter-gallery-control li.eead-fg-active'", $scope).data('load-more-status', 1)
                                    $this.hide()
                                }
                            } else {
                                ++item_found;
                                $items.push($(item)[0]);
                                index_list.push(index);
                            }

                            if (item_found === $images_per_page) {
                                break;
                            }
                        }

                        if (index_list.length > 0) {
                            fg_items = fg_items.filter(function (item, index) {
                                return !index_list.includes(index);
                            });
                        }

                        if (fg_items.length < 1) {
                            $this.html('<div class="no-more-items-text">' + $nomore_text + "</div>");
                            setTimeout(function () {
                                $this.fadeOut("slow");
                            }, 600);
                        }

                        // append items
                        $gallery.append($items);
                        $isotope_gallery.isotope("insert", $items);
                        $isotope_gallery.imagesLoaded().progress(function () {
                            $isotope_gallery.isotope("layout");
                        });
                    });
                });
            });
        </script>
        <?php
    }
}