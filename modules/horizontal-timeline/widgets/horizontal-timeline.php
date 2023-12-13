<?php

namespace EasyElementorAddons\Modules\HorizontalTimeline\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Utils;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class HorizontalTimeline extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-horizontal-timeline';
    }

    /** Widget Title */
    public function get_title() {
        return __('Horizontal Timeline Block', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-time-line eead-icon-rotate';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return [ 'mcscrollbar' ];
    }

    public function get_script_depends() {
        return [ 'mcscrollbar' ];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'items', [
            'label' => __('Items', 'easy-elementor-addons'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'enable', [
                'label' => __('Enable', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'easy-elementor-addons'),
                'label_off' => __('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'image', [
                'label' => __('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'item_image',
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
            ]
        );

        $repeater->add_control(
            'meta', [
                'label' => __('Meta', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => __('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'point_heading', [
                'label' => __('Point', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'point_type', [
                'label' => __('Point Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => array(
                    'icon' => __('Icon', 'easy-elementor-addons'),
                    'text' => __('Text', 'easy-elementor-addons'),
                ),
            ]
        );

        $repeater->add_control(
            'icon', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'solid',
                ],
                'condition' => ['point_type' => 'icon']
            ]
        );

        $repeater->add_control(
            'point_text', [
                'label' => __('Point Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'A',
                'condition' => ['point_type' => 'text']
            ]
        );

        $repeater->add_control(
            'button', [
                'label' => __('Button', 'easy-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'button_text', [
                'label' => __('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
            ]
        );

        $repeater->add_control(
            'button_url', [
                'label' => __('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'item_list', [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Item #1', 'easy-elementor-addons'),
                        'description'  => __('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => __('Thursday, August 31, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => __('Item #2', 'easy-elementor-addons'),
                        'description'  => __('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => __('Thursday, August 29, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => __('Item #3', 'easy-elementor-addons'),
                        'description'  => __('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => __('Thursday, August 28, 2018', 'easy-elementor-addons'),
                    ],
                    [
                        'title' => __('Item #4', 'easy-elementor-addons'),
                        'description'  => __('Lorem ipsum dolor sit amet, mea ei viderer probatus consequuntur, sonet vocibus lobortis has ad. Eos erant indoctum an, dictas invidunt est ex, et sea consulatu torquatos. Nostro aperiam petentium eu nam, mel debet urbanitas ad, idque complectitur eu quo. An sea autem dolore dolores.', 'easy-elementor-addons'),
                        'meta' => __('Thursday, August 27, 2018', 'easy-elementor-addons'),
                    ],
                ],
                'title_field' => '{{{title}}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'settings', [
            'label' => __('Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'layout', [
                'label' => __('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1'  => __('Style 1', 'easy-elementor-addons'),
                    'style2' => __('Style 2', 'easy-elementor-addons'),
                    'style3' => __('Style 3', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'position', [
                'label' => __('Layout Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
            ]
        );

        $this->add_control(
            'alignment', [
                'label' => __('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-htimeline-card' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
       
        /*Style Tab*/
        $this->start_controls_section(
                'title_style', [
            'label' => __('Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-title h2 a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => __('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-htimeline-title h2 a',
                ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'title_border',
                'label' => __('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-htimeline-title h2 a',
            ]
        );

        $this->add_control(
            'title_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-htimeline-title h2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
                'title_padding', [
            'label' => __('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-title h2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => __('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-title h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => __('Description', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-description' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => __('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-htimeline-description',
                ]
        );

        $this->add_control(
                'description_margin', [
            'label' => __('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'readmore_style', [
            'label' => __('Read More', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->start_controls_tabs(
                'readmore_tabs'
        );

        $this->start_controls_tab(
                'readmore_tab_normal', [
            'label' => __('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'readmore_color_normal', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_bg_color_normal', [
            'label' => __('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_border_color_normal', [
            'label' => __('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a' => 'border: 1px solid {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'readmore_tab_hover', [
            'label' => __('Hover', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'readmore_color_hover', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_bg_color_hover', [
            'label' => __('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a:hover' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'readmore_border_color_hover', [
            'label' => __('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-more-button a:hover' => 'border: 1px solid {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'readmore_typography',
            'label' => __('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-more-button a',
            'separator' => 'before',
                ]
        );

        $this->add_control(
            'readmore_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-htimeline-card .eead-more-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
                'readmore_padding', [
            'label' => __('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-card .eead-more-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'readmore_margin', [
            'label' => __('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-card .eead-more-button a' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'meta_style', [
            'label' => __('Meta', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'meta_color', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-meta,
                 {{WRAPPER}} .style2 .eead-htimeline-item:nth-child(even) .eead-htimeline-meta' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'meta_bg_color', [
            'label' => __('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-meta,
                 {{WRAPPER}} .style2 .eead-htimeline-item:nth-child(even) .eead-htimeline-meta' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'meta_typography',
            'label' => __('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-htimeline-meta',
                ]
        );

        $this->add_control(
                'meta_margin', [
            'label' => __('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'meta_border',
                'label' => __('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-htimeline-meta',
            ]
        );

        $this->add_control(
            'meta_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-htimeline-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
                'meta_padding', [
            'label' => __('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'time_point_style', [
            'label' => __('Time Point', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'time_point_color', [
            'label' => __('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-item .eead-point-icon i,
                 {{WRAPPER}} .eead-htimeline-item .eead-point-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'time_point_bg_color', [
            'label' => __('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-item .eead-point-icon,
                 {{WRAPPER}} .eead-htimeline-item .eead-point-text' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'time_point_outline_color', [
            'label' => __('Outline Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .style1 .eead-point-icon,
                 {{WRAPPER}} .style1 .eead-point-text,
                 {{WRAPPER}} .style2 .eead-point-icon,
                 {{WRAPPER}} .style2 .eead-point-text' => 'border: 3px solid {{VALUE}}',

                '{{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-icon,
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-text' => 'border: 10px solid {{VALUE}}'
            ],
            'condition' => ['layout!' => 'style2' ]
                ]
        );

        $this->add_control(
                'timeline_color', [
            'label' => __('Time Line Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-wrap .style1 .eead-point-icon:before, 
                 {{WRAPPER}} .eead-htimeline-wrap .style1 .eead-point-text:before,
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-icon:before, 
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-text:before,
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-icon:after,
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-point-text:after' => 'background: {{VALUE}}',
                '{{WRAPPER}} .eead-htimeline-wrap .style1 .eead-htimeline-card-content,
                 {{WRAPPER}} .eead-htimeline-wrap .style3 .eead-htimeline-card-content' => 'border: 1px solid {{VALUE}}'
            ],
            'condition' => ['layout!' => 'style2' ]
                ]
        );

        $this->add_control(
                'timeline_circle_color', [
            'label' => __('Circle Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-htimeline-wrap .style3 .eead-htimeline-circle' => 'background: {{VALUE}}'
            ],
            'condition' => ['layout' => 'style3' ]
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'time_point_typography',
            'label' => __('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-htimeline-item .eead-point-text',
                ]
        );

        $this->end_controls_section();        
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $position = $settings['position'];
        $layout = $settings['layout'];
        ?>

        <style>
            .eead-htimeline-lists #mCSB_1_container {
                display: flex; 
            }
        </style>

        <div class="eead-htimeline-wrap">
            <div class="eead-htimeline-line"></div>

            <div class="eead-htimeline-lists eead-horizontal-timeline-scrollbar <?php echo esc_attr($layout) . ' ' . esc_attr($position); ?>">
                <?php
                foreach($settings['item_list'] as $key => $item) {
                    if($item['enable'] != 'yes') {
                        continue;
                    }
                    ?>

                    <div class="eead-htimeline-item">
                        <div class="eead-htimeline-card">
                            <div class="eead-htimeline-card-content">

                                <?php
                                if ($settings['layout'] != 'style3') {
                                    ?>
                                    <div class="eead-htimeline-post-image">
                                        <?php  
                                        if( !$item['image'] ) {
                                            $placeholder_img = \Elementor\Utils::get_placeholder_image_src();
                                            echo '<img src="'.esc_url($placeholder_img).'" >';
                                        } else {
                                            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($item, 'item_image', 'image');
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                if ($settings['layout'] == 'style3') {
                                    ?>
                                    <div class="eead-htimeline-meta">
                                        <span><?php echo esc_html($item['meta']); ?></span>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="eead-htimeline-title">
                                    <h2>
                                        <?php
                                        if (!empty($item['button_url']['url']) && !empty($item['title'])) { 
                                            echo '<a href="' . esc_url($item['button_url']['url']) . '">';
                                            echo esc_html($item['title']); 
                                            echo '</a>';
                                        }
                                        else {
                                            echo esc_html($item['title']); 
                                        }
                                        ?>
                                    </h2>
                                </div>

                                <?php
                                if ($settings['layout'] == 'style1') {
                                    ?>
                                    <div class="eead-htimeline-meta">
                                        <span><?php echo esc_html($item['meta']); ?></span>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="eead-htimeline-description">
                                    <p><?php echo esc_html($item['description']); ?></p>
                                </div>

                                <?php 
                                if ($settings['layout'] == 'style1' || $settings['layout'] == 'style2') { 
                                    if ($item['button_url']['url']) {
                                        ?>
                                        <div class="eead-more-button">
                                            <a href="<?php echo esc_url($item['button_url']['url']); ?>">
                                                <?php echo esc_html($item['button_text']); ?>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } 
                                ?>
                            </div>

                            <?php
                            if( $settings['layout'] == 'style3' ) {
                                echo '<div class="eead-htimeline-circle"></div>';
                            }
                            ?>
                            
                            <?php
                            if ($settings['layout'] == 'style1' || $settings['layout'] == 'style3') {
                                if ($item['point_type'] == 'icon') {
                                    ?>
                                    <div class="eead-point-icon">
                                        <?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>    
                                    </div>
                                <?php 
                                } 
                                else if ($item['point_type'] == 'text') {
                                    ?>
                                    <div class="eead-point-text">
                                        <?php echo esc_html($item['point_text']); ?>
                                    </div>
                                    <?php 
                                } 
                            } 
                            ?>

                            <?php
                            if ($settings['layout'] == 'style2') {
                                ?>
                                <div class="eead-htimeline-meta">
                                    <span><?php echo esc_html($item['meta']); ?></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}