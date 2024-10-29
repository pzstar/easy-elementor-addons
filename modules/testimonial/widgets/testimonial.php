<?php

namespace EasyElementorAddons\Modules\Testimonial\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Testimonial extends Widget_Base {

    public function get_name() {
        return 'eead-testimonial';
    }

    public function get_title() {
        return esc_html__('Testimonial', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-testimonial';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content', [
                'label' => esc_html__('Content', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'image', [
                'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'name', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'John Doe'
            ]
        );

        $this->add_control(
            'designation', [
                'label' => esc_html__('Designation', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Support Engineer'
            ]
        );

        $this->add_control(
            'testimonial_title', [
                'label' => esc_html__('Testimonial Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => ''
            ]
        );

        $this->add_control(
            'testimonial_content', [
                'label' => esc_html__('Testimonial', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 8,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings', [
                'label' => esc_html__('Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full'
            ]
        );

        $this->add_control(
            'image_shape', [
                'label' => esc_html__('Image Shape', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'eead-square',
                'options' => [
                    'eead-square' => esc_html__('Square', 'easy-elementor-addons'),
                    'eead-round' => esc_html__('Round', 'easy-elementor-addons')
                ]
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons')
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'general_style', [
                'label' => esc_html__('General Styles', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'content_bg_color', [
                'label' => esc_html__('Backgrond Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-block.style1, 
                 {{WRAPPER}} .eead-testimonial-block.style2,
                 {{WRAPPER}} .eead-testimonial-block.style3' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'content_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-block.style1' => 'border: 5px solid {{VALUE}}',
                ],
                'condition' => ['layout' => 'style1']
            ]
        );

        $this->add_control(
            'padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'testimonial_box_shadow',
                'label' => esc_html__('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-testimonial-block'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'name_style', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'name_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-member-name' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'name_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-testimonial-member-name'
            ]
        );

        $this->add_control(
            'name_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-member-name' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'designation_style', [
                'label' => esc_html__('Designation', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-member-designation' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'designation_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-testimonial-member-designation'
            ]
        );

        $this->add_control(
            'designation_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-member-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_style', [
                'label' => esc_html__('Testimonial', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'testimonial_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'testimonial_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt'
            ]
        );

        $this->add_control(
            'backquote_color', [
                'label' => esc_html__('Backquote Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-backquote' => 'color: {{VALUE}}',
                ],
                'condition' => ['layout' => 'style3']
            ]
        );

        $this->add_control(
            'testimonial_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content .eead-testimonial-txt' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->add_control(
            'testimonial_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content:before' => 'background: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'testimonial_border_height', [
                'label' => esc_html__('Border Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content:before' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'testimonial_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content:before' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'testimonial_border_margin', [
                'label' => esc_html__('Border Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_title_style', [
                'label' => esc_html__('Testimonial Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'testimonial_title_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content h3' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'testimonial_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-testimonial-content h3'
            ]
        );

        $this->add_control(
            'testimonial_title_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-testimonial-content h3' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="eead-testimonial-block <?php echo esc_attr($settings['image_shape']) . ' ' . esc_attr($settings['layout']) ?>">
            <?php
            if ($settings['layout'] == 'style1') {
                ?>
                <div class="eead-testimonial-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'image'); ?>
                </div>

                <div class="eead-testimonial-holder">
                    <div class="eead-testimonial-content">
                        <?php
                        if (!empty($settings['testimonial_title'])) {
                            printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($settings['testimonial_title']));
                        }

                        if (!empty($settings['testimonial_content'])) {
                            echo '<div class="eead-testimonial-txt">';
                            echo wp_kses_post($settings['testimonial_content']);
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="eead-testimonial-name-wrap">
                        <h1 class="eead-testimonial-member-name">
                            <?php echo esc_html($settings['name']); ?>
                        </h1>

                        <div class="eead-testimonial-member-designation">
                            <?php echo esc_html($settings['designation']); ?>
                        </div>
                    </div>
                </div>
            <?php } else if ($settings['layout'] == 'style2') { ?>
                    <div class="eead-testimonial-content">
                        <?php
                        if (!empty($settings['testimonial_title'])) {
                            printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($settings['testimonial_title']));
                        }

                        if (!empty($settings['testimonial_content'])) {
                            echo '<div class="eead-testimonial-txt">';
                            echo wp_kses_post($settings['testimonial_content']);
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="eead-footer-section">
                        <div class="eead-testimonial-image">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'image'); ?>
                        </div>

                        <div class="eead-testimonial-name-wrap">
                            <h1 class="eead-testimonial-member-name">
                            <?php echo esc_html($settings['name']); ?>
                            </h1>

                            <div class="eead-testimonial-member-designation">
                            <?php echo esc_html($settings['designation']); ?>
                            </div>
                        </div>
                    </div>
            <?php } else if ($settings['layout'] == 'style3') { ?>
                        <div class="eead-testimonial-backquote"><i class="icofont-quote-left"></i></div>

                        <div class="eead-testimonial-content">
                        <?php
                        if (!empty($settings['testimonial_title'])) {
                            printf('<h3 class="eead-testimonial-title">%1$s</h3>', esc_html($settings['testimonial_title']));
                        }

                        if (!empty($settings['testimonial_content'])) {
                            echo '<div class="eead-testimonial-txt">';
                            echo wp_kses_post($settings['testimonial_content']);
                            echo '</div>';
                        }
                        ?>
                        </div>

                        <div class="eead-testimonial-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumb', 'image'); ?>
                        </div>

                        <div class="eead-testimonial-name-wrap">
                            <h1 class="eead-testimonial-member-name">
                        <?php echo esc_html($settings['name']); ?>
                            </h1>

                            <div class="eead-testimonial-member-designation">
                        <?php echo esc_html($settings['designation']); ?>
                            </div>
                        </div>
            <?php } ?>
        </div>
        <?php
    }

}
