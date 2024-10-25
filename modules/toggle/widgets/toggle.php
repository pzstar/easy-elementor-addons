<?php

namespace EasyElementorAddons\Modules\Toggle\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Toggle extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-toggle';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Toggle Content', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-toggle';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_primary',
            [
                'label' => esc_html__('Primary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'primary_label',
            [
                'label' => esc_html__('Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Annual', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'primary_content_type',
            [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__('Image', 'easy-elementor-addons'),
                    'content' => esc_html__('Content', 'easy-elementor-addons'),
                    'template' => esc_html__('Saved Templates', 'easy-elementor-addons'),
                ],
                'default' => 'content',
            ]
        );

        $this->add_control(
            'primary_templates',
            [
                'label' => esc_html__('Select Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => get_elementor_templates(),
                'condition' => [
                    'primary_content_type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'primary_content',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Primary Content', 'easy-elementor-addons'),
                'condition' => [
                    'primary_content_type' => 'content',
                ],
            ]
        );

        $this->add_control(
            'primary_image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'primary_content_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'primary_image',
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'primary_content_type' => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_secondary',
            [
                'label' => esc_html__('Secondary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'secondary_label',
            [
                'label' => esc_html__('Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Lifetime', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'secondary_content_type',
            [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__('Image', 'easy-elementor-addons'),
                    'content' => esc_html__('Content', 'easy-elementor-addons'),
                    'template' => esc_html__('Saved Templates', 'easy-elementor-addons'),
                ],
                'default' => 'content',
            ]
        );

        $this->add_control(
            'secondary_templates',
            [
                'label' => esc_html__('Select Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => get_elementor_templates(),
                'condition' => [
                    'secondary_content_type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'secondary_content',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Secondary Content', 'easy-elementor-addons'),
                'condition' => [
                    'secondary_content_type' => 'content',
                ],
            ]
        );

        $this->add_control(
            'secondary_image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'secondary_content_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'secondary_image',
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'secondary_content_type' => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'default_display',
            [
                'label' => esc_html__('Default Display', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'primary' => esc_html__('Primary', 'easy-elementor-addons'),
                    'secondary' => esc_html__('Secondary', 'easy-elementor-addons'),
                ],
                'default' => 'primary',
            ]
        );

        $this->add_control(
            'switch_style',
            [
                'label' => esc_html__('Switch Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons')
                ],
                'default' => 'style1',
            ]
        );

        $this->add_control(
            'toggle_position',
            [
                'label' => esc_html__('Toggle Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'before' => esc_html__('Before', 'easy-elementor-addons'),
                    'after' => esc_html__('After', 'easy-elementor-addons'),
                    'before-after' => esc_html__('Before', 'easy-elementor-addons') . ' + ' . esc_html__('After', 'easy-elementor-addons'),
                ],
                'default' => 'before',
            ]
        );

        $this->end_controls_section();

        /* Style Settings */
        $this->start_controls_section(
            'section_toggle_switch_style',
            [
                'label' => esc_html__('Switch', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_switch_alignment',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-switch-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_switch_width',
            [
                'label' => esc_html__('Switch Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-switch' => '--eead-toggle-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_switch_height',
            [
                'label' => esc_html__('Switch Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-switch' => '--eead-toggle-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_switch_gap',
            [
                'label' => esc_html__('Spacing Between Switch & Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-switch-inner' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_switch_spacing',
            [
                'label' => esc_html__('Spacing Between Switch & Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-switch-before' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-toggle-switch-after' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_switch_round',
            [
                'label' => esc_html__('Rounded', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->start_controls_tabs('tabs_switch');

        $this->start_controls_tab(
            'tab_switch_primary',
            [
                'label' => esc_html__('Primary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_bg_color',
            [
                'label' => esc_html__('Switch Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#EEEEEE',
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container' => '--eead-toggle-switch-bg-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_handle_color',
            [
                'label' => esc_html__('Switch Handle Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#EEEEEE',
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container' => '--eead-toggle-switch-handle-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_switch_secondary',
            [
                'label' => esc_html__('Secondary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_bg_color_active',
            [
                'label' => esc_html__('Switch Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#EEEEEE',
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container' => '--eead-toggle-switch-bg-active-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_handle_color_active',
            [
                'label' => esc_html__('Switch Handle Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#EEEEEE',
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container' => '--eead-toggle-switch-handle-active-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_label_style',
            [
                'label' => esc_html__('Labels', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-toggle-label',
            ]
        );

        $this->start_controls_tabs('tabs_label_style');

        $this->start_controls_tab(
            'tab_label_primary',
            [
                'label' => esc_html__('Primary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'label_text_color_primary',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-label-primary' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_active_text_color_primary',
            [
                'label' => esc_html__('Active Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container:not(.eead-switch-on) .eead-toggle-label-primary' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_label_secondary',
            [
                'label' => esc_html__('Secondary', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'label_text_color_secondary',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-label-secondary' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_active_text_color_secondary',
            [
                'label' => esc_html__('Active Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-container.eead-switch-on .eead-toggle-label-secondary' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-toggle-section',
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-section' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-toggle-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'selector' => '{{WRAPPER}} .eead-toggle-content',
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .eead-toggle-content',
			]
		);

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-toggle-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_toggle_content($content) {
        $settings = $this->get_settings_for_display();

        if ($settings[$content . '_content_type'] === 'content') {
            echo $this->parse_text_editor($settings[$content . '_content']);
        } else if ($settings[$content . '_content_type'] === 'image') {
            echo Group_Control_Image_Size::get_attachment_image_html($settings, $content . '_image', $content . '_image');
        } else if ($settings[$content . '_content_type'] === 'template') {
            if (!empty($settings[$content . '_templates'])) {
                $template_id = $settings[$content . '_templates'];
                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id);
            }
        }
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('toggle-container', 'class', 'eead-toggle-container');
        if ($settings['default_display'] == 'secondary') {
            $this->add_render_attribute('toggle-container', 'class', 'eead-switch-on');
        }
        ?>

        <div <?php echo $this->get_render_attribute_string('toggle-container'); ?>>
            <?php
            if ($settings['toggle_position'] === 'before' || $settings['toggle_position'] === 'before-after') {
                $this->before_after_toggle('before');
            }
            ?>

            <div class='eead-toggle-content'>
                <div class="eead-toggle-section eead-toggle-primary">
                    <?php echo $this->render_toggle_content('primary'); ?>
                </div>

                <div class="eead-toggle-section eead-toggle-secondary">
                    <?php echo $this->render_toggle_content('secondary'); ?>
                </div>
            </div>

            <?php
            if ($settings['toggle_position'] === 'after' || $settings['toggle_position'] === 'before-after') {
                $this->before_after_toggle('after');
            }
            ?>
        </div>
        <?php
    }

    protected function before_after_toggle($toggle_position = 'before') {
        $settings = $this->get_settings();

        $this->add_render_attribute('toggle-switch-' . $toggle_position,
            [
                'class' => [
                    'eead-toggle-switch-container',
                    'eead-toggle-switch-' . $toggle_position,
                    'eead-toggle-switch-' . $settings['switch_style']
                ]
            ]
        );

        if ($settings['toggle_switch_round'] !== 'yes') {
            $this->add_render_attribute('toggle-switch-' . $toggle_position, 'class', 'eead-toggle-square-switch');
        }
        ?>

        <div <?php echo $this->get_render_attribute_string('toggle-switch-' . $toggle_position); ?>>
            <div class="eead-toggle-switch-inner">

                <?php if ($settings['primary_label']) { ?>
                    <div class="eead-toggle-label eead-toggle-label-primary">
                        <?php echo esc_html($settings['primary_label']); ?>
                    </div>
                <?php } ?>

                <div class="eead-toggle-switch">
                    <label class="eead-toggle-switch-label">
                        <input class="eead-toggle-switch-checkbox" type="checkbox" <?php checked(('secondary' === $settings['default_display']), true); ?>>
                        <span class="eead-toggle-slider"></span>
                    </label>
                </div>

                <?php if ($settings['secondary_label']) { ?>
                    <div class="eead-toggle-label eead-toggle-label-secondary">
                        <?php echo esc_html($settings['secondary_label']); ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php
    }
}