<?php

namespace EasyElementorAddons\Modules\ImageGallery\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class ImageGallery extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-image-gallery';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Image Gallery', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['lightgallery'];
    }

    public function get_script_depends() {
        return ['lightgallery', 'isotope', 'imagesloaded'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_gallery',
            [
                'label' => esc_html__('Gallery', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'gallery_type',
            [
                'label' => esc_html__('Gallery Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'filterable',
                'options' => array(
                    'default' => esc_html__('Default', 'easy-elementor-addons'),
                    'filterable' => esc_html__('Filterable', 'easy-elementor-addons'),
                ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'filter_label',
            [
                'label' => esc_html__('Filter Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => '',
                'dynamic' => array(
                    'active' => true,
                ),
            ]
        );

        $repeater->add_control(
            'image_group',
            [
                'label' => esc_html__('Add Images', 'easy-elementor-addons'),
                'type' => Controls_Manager::GALLERY,
                'dynamic' => array(
                    'active' => true,
                ),
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label' => esc_html__('Gallery Images', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '',
                'separator' => 'before',
                'condition' => array(
                    'gallery_type' => 'filterable',
                ),
            ]
        );

        $this->add_control(
            'image_group_standard',
            [
                'label' => esc_html__('Add Images', 'easy-elementor-addons'),
                'type' => Controls_Manager::GALLERY,
                'dynamic' => array(
                    'active' => true,
                ),
                'separator' => 'before',
                'condition' => array(
                    'gallery_type' => 'default',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter_section',
            [
                'label' => esc_html__('Filter', 'easy-elementor-addons'),
                'condition' => array(
                    'gallery_type' => 'filterable',
                ),
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__('Show Filter', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => array(
                    'gallery_type' => 'filterable',
                ),
            ]
        );

        $this->add_control(
            'filter_all_label',
            [
                'label' => esc_html__('All Filter Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All', 'easy-elementor-addons'),
                'condition' => array(
                    'gallery_type' => 'filterable',
                    'show_filter' => 'yes',
                ),
            ]
        );

        $this->add_responsive_control(
            'filter_alignment',
            [
                'label' => esc_html__('Align', 'easy-elementor-addons'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'right-align',
                'options' => array(
                    'left-align' => array(
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'center-align' => array(
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ),
                    'right-align' => array(
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-gallery-filters.left-align' => 'justify-content: flex-start;',
                    '{{WRAPPER}} .eead-gallery-filters.right-align' => 'justify-content: flex-end;',
                    '{{WRAPPER}} .eead-gallery-filters.center-align' => 'justify-content: center;',
                ),
                'condition' => array(
                    'gallery_type' => 'filterable',
                    'show_filter' => 'yes',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'caption_section',
            [
                'label' => esc_html__('Caption', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'show_caption',
            [
                'label' => esc_html__('Show Caption', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'caption_type',
            [
                'label' => esc_html__('Caption Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'caption',
                'options' => array(
                    'caption' => esc_html__('Image Caption', 'easy-elementor-addons'),
                    'title' => esc_html__('Image Title', 'easy-elementor-addons'),
                    'description' => esc_html__('Image Description', 'easy-elementor-addons'),
                    'title_description' => esc_html__('Title & Description', 'easy-elementor-addons')
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'show_lightbox',
            [
                'label' => esc_html__('Show Lightbox', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
                    'grid' => esc_html__('Grid', 'easy-elementor-addons'),
                    'masonry' => esc_html__('Masonry', 'easy-elementor-addons'),
                    // 'justified' => esc_html__('Justified', 'easy-elementor-addons'),
                ),
            ]
        );

        $this->add_control(
            'image_spacing',
            [
                'label' => esc_html__('Spacing Between Images (px)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 2
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-gallery-item-inner' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 600,
                        'step' => 1,
                    ]
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-image-gallery-wrapper.grid .eead-gallery-item' => 'height: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .eead-image-gallery-wrapper.grid .eead-gallery-item' => 'height: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-image-gallery-wrapper.grid .eead-gallery-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Style Tabs */
        $this->start_controls_section(
            'filter_style',
            [
                'label' => esc_html__('Filter', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'filter_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-container .eead-gallery-filters' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->start_controls_tabs(
            'filter_tabs'
        );

        $this->start_controls_tab(
            'filter_normal_tab',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'filter_text_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-container .eead-gallery-filters .eead-gallery-filter' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-image-gallery-container .eead-gallery-filters .eead-gallery-filter:not(.eead-active)',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_active_tab',
            [
                'label' => esc_html__('Active', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'filter_active_text_color',
            [
                'label' => esc_html__('Active Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-container .eead-gallery-filters .eead-gallery-filter.eead-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'active_filter_typography',
                'label' => esc_html__('Active Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-image-gallery-container .eead-gallery-filters .eead-gallery-filter.eead-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'overlay_style',
            [
                'label' => esc_html__('Overlay', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-item-inner::after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'zoom_button_style',
            [
                'label' => esc_html__('Zoom Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'zoom_button_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'zoom_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail a' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail p',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_title_style',
            [
                'label' => esc_html__('Image Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail .eead-caption-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'image_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-image-gallery-wrapper .eead-gallery-image-detail .eead-caption-title',
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ($settings['gallery_type'] == 'filterable') {
            $images = $this->get_images();
        } else {
            $images = $settings['image_group_standard'];
        }
        $layout = $settings['layout'];

        $gallery_settings = [];
        $gallery_settings['layout'] = $layout;
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $gallery_settings['post_id'] = \Elementor\Plugin::$instance->editor->get_post_id();
        } else {
            $gallery_settings['post_id'] = get_the_ID();
        }

        $gallery_settings['template_id'] = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();

        $gallery_settings['widget_id'] = $this->get_id();
        $this->add_render_attribute('gallery-settings', [
            'data-settings' => wp_json_encode($gallery_settings),
        ]);
        ?>
        <div class="eead-image-gallery-container" <?php echo wp_kses_post($this->get_render_attribute_string('gallery-settings')); ?>>

            <?php $this->render_filters(); ?>

            <div class="eead-image-gallery-wrapper <?php echo esc_attr($layout); ?>">
                <?php
                foreach ($images as $key => $value) {
                    $filter_label = $settings['gallery_type'] == 'filterable' ? $value['filter_label'] : '';
                    ?>
                    <div class="eead-gallery-item <?php echo esc_attr(strtolower(str_replace(' ', '-', $filter_label))); ?>">
                        <div class="eead-gallery-item-inner">
                            <img class="eead-gallery-image" src="<?php echo esc_url($value['url']); ?>">

                            <div class="eead-gallery-image-detail">
                                <?php if ($settings['show_lightbox'] == 'yes') { ?>
                                    <a href="<?php echo esc_url($value['url']); ?>" class="eead-gallery-lightbox">
                                        <i class="fa fa-search"></i>
                                    </a>
                                <?php } ?>

                                <?php $this->get_caption($value['id']); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function get_caption($image_id) {
        $settings = $this->get_settings_for_display();

        if ($settings['show_caption'] == 'yes') {
            $image_desc = get_post($image_id);
            if ($settings['caption_type'] == 'caption') {
                $caption_text = $image_desc->post_excerpt;
            } else if ($settings['caption_type'] == 'title') {
                $caption_text = $image_desc->post_title;
            } else if ($settings['caption_type'] == 'description') {
                $caption_text = $image_desc->post_content;
            } else if ($settings['caption_type'] == 'title_description') {
                ?>
                            <h2 class="eead-caption-title"><?php echo esc_html($image_desc->post_title); ?></h2>
                            <p class="eead-caption-desc"><?php echo esc_html($image_desc->post_content); ?></p>
                <?php
            }

            if ($settings['caption_type'] != 'title_description') {
                ?>
                <p><?php echo esc_html($caption_text); ?></p>
                <?php
            }
        }
    }

    protected function get_images() {
        $settings = $this->get_settings_for_display();
        $gallery_type = $settings['gallery_type'];
        $gallery = [];

        if ($gallery_type == 'filterable') {
            $i = 0;
            foreach ($settings['gallery_images'] as $key => $item) {
                foreach ($item['image_group'] as $key2 => $image) {
                    $gallery[$i]['id'] = $image['id'];
                    $gallery[$i]['url'] = $image['url'];
                    $index = $key + 1;
                    $gallery[$i]['filter_label'] = !empty($item['filter_label']) ? $item['filter_label'] : 'Group-' . $index;
                    $i++;
                }
            }
        }
        return $gallery;
    }

    protected function render_filters() {
        $settings = $this->get_settings_for_display();
        if ($settings['gallery_type'] == 'filterable' and $settings['show_filter'] === 'yes') {

            $gallery = $settings['gallery_images'];
            if (!empty($gallery)) {
                ?>
                <div class="eead-gallery-filters <?php echo $settings['filter_alignment']; ?>">
                    <div class="eead-gallery-filter eead-active" data-filter="*" data-gallery-index="all">
                        <?php echo ('' !== $settings['filter_all_label']) ? esc_html($settings['filter_all_label']) : esc_html__('All', 'easy-elementor-addons'); ?>
                    </div>

                    <?php
                    foreach ($gallery as $index => $item) {
                        $filter_label = $item['filter_label'];
                        $filter_name = $item['filter_label'];
                        if (empty($filter_label)) {
                            $filter_label = esc_html__('Group ', 'easy-elementor-addons');
                            $filter_label .= ($index + 1);
                            $filter_name = esc_html__('Group-', 'easy-elementor-addons');
                            $filter_name .= ($index + 1);
                        }
                        ?>
                        <div class="eead-gallery-filter" data-filter=".<?php echo esc_attr(strtolower(str_replace(' ', '-', $filter_name))); ?>" data-gallery-index="eead-group-<?php echo esc_attr($index + 1); ?>"><?php echo wp_kses_post($filter_label); ?></div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        }
    }

}