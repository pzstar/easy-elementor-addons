<?php

namespace EasyElementorAddons\Modules\ToggleBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class ToggleBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-toggle-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Toggle Block', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-post-navigation';
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
                'label'                 => __( 'Primary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'primary_label',
            [
                'label'                 => __( 'Label', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Annual', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'primary_content_type',
            [
                'label'                 => __( 'Content Type', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'image'         => __( 'Image', 'easy-elementor-addons' ),
                    'content'       => __( 'Content', 'easy-elementor-addons' ),
                    'template'      => __( 'Saved Templates', 'easy-elementor-addons' ),
                ],
                'default'               => 'content',
            ]
        );

        $this->add_control(
            'primary_templates',
            [
                'label'       => __( 'Select Template', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => get_elementor_templates(),
                'condition'             => [
                    'primary_content_type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'primary_content',
            [
                'label'                 => __( 'Content', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::WYSIWYG,
                'default'               => __( 'Primary Content', 'easy-elementor-addons' ),
                'condition'             => [
                    'primary_content_type'      => 'content',
                ],
            ]
        );

        $this->add_control(
            'primary_image',
            [
                'label'                 => __( 'Image', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'             => [
                    'primary_content_type'      => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'primary_image',
                'default'               => 'full',
                'separator'             => 'none',
                'condition'             => [
                    'primary_content_type'      => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_secondary',
            [
                'label'                 => __( 'Secondary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'secondary_label',
            [
                'label'                 => __( 'Label', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Lifetime', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'secondary_content_type',
            [
                'label'                 => __( 'Content Type', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'image'         => __( 'Image', 'easy-elementor-addons' ),
                    'content'       => __( 'Content', 'easy-elementor-addons' ),
                    'template'      => __( 'Saved Templates', 'easy-elementor-addons' ),
                ],
                'default'               => 'content',
            ]
        );

        $this->add_control(
            'secondary_templates',
            [
                'label'       => __( 'Select Template', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => get_elementor_templates(),
                'condition'             => [
                    'secondary_content_type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'secondary_content',
            [
                'label'                 => __( 'Content', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::WYSIWYG,
                'default'               => __( 'Secondary Content', 'easy-elementor-addons' ),
                'condition'             => [
                    'secondary_content_type' => 'content',
                ],
            ]
        );

        $this->add_control(
            'secondary_image',
            [
                'label'                 => __( 'Image', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'             => [
                    'secondary_content_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'secondary_image',
                'default'               => 'full',
                'separator'             => 'none',
                'condition'             => [
                    'secondary_content_type' => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label'                 => __( 'Settings', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'default_display',
            [
                'label'                 => __( 'Default Display', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'primary'       => __( 'Primary', 'easy-elementor-addons' ),
                    'secondary'     => __( 'Secondary', 'easy-elementor-addons' ),
                ],
                'default'               => 'primary',
            ]
        );

        $this->add_control(
            'switch_style',
            [
                'label'                 => __( 'Switch Style', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'style1'  => __( 'Style 1', 'easy-elementor-addons' ),
                    'style2'  => __( 'Style 2', 'easy-elementor-addons' ),
                    'style3'  => __( 'Style 3', 'easy-elementor-addons' )
                ],
                'default'               => 'style1',
            ]
        );

        $this->add_control(
            'toggle_position',
            [
                'label'                 => __( 'Toggle Position', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                    'before'        => __( 'Before', 'easy-elementor-addons' ),
                    'after'         => __( 'After', 'easy-elementor-addons' ),
                    'before-after'  => __( 'Before', 'easy-elementor-addons' ) . ' + ' . __( 'After', 'easy-elementor-addons' ),
                ],
                'default'               => 'before',
            ]
        );

        $this->end_controls_section();

        /* Style Settings */
        $this->start_controls_section(
            'section_toggle_switch_style',
            [
                'label'             => __( 'Switch', 'easy-elementor-addons' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_switch_alignment',
            [
                'label'                 => __( 'Alignment', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
                'default'               => 'center',
                'options'               => [
                    'left'          => [
                        'title'     => __( 'Left', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-left',
                    ],
                    'center'        => [
                        'title'     => __( 'Center', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-center',
                    ],
                    'right'         => [
                        'title'     => __( 'Right', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class'          => 'eead-toggle-',
                'frontend_available'    => true,
            ]
        );

        $this->add_responsive_control(
            'toggle_switch_size',
            [
                'label'                 => __( 'Switch Controller Size', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px' ],
                'range'                 => [
                    'px'   => [
                        'min' => 15,
                        'max' => 60,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-container' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_switch_spacing',
            [
                'label'                 => __( 'Labels Spacing', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px'   => [
                        'max' => 80,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-container' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_switch_gap',
            [
                'label'                 => __( 'Content Spacing', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px'   => [
                        'max' => 80,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-before' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-toggle-switch-after' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_switch' );

        $this->start_controls_tab(
            'tab_switch_primary',
            [
                'label'             => __( 'Primary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'toggle_switch_primary_background',
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .eead-toggle-slider',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'toggle_switch_primary_border',
                'label'                 => __( 'Border', 'easy-elementor-addons' ),
                'placeholder'           => '1px',
                'selector'              => '{{WRAPPER}} .eead-toggle-switch-container.eead-toggle-switch-style1,
                                            {{WRAPPER}} .eead-toggle-switch-container.eead-toggle-switch-style2 .eead-toggle-slider,
                                            {{WRAPPER}} .eead-toggle-switch-container.eead-toggle-switch-style3',
            ]
        );

        $this->add_control(
            'toggle_switch_primary_border_radius',
            [
                'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-container.eead-toggle-switch-style1,
                     {{WRAPPER}} .eead-toggle-switch-container.eead-toggle-switch-style3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switch_style!' => 'style2'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_switch_secondary',
            [
                'label'             => __( 'Secondary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'toggle_switch_secondary_background',
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .eead-toggle-switch-on .eead-toggle-slider, {{WRAPPER}} .eead-toggle-switch:checked + .eead-toggle-slider',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'toggle_switch_secondary_border',
                'label'                 => __( 'Border', 'easy-elementor-addons' ),
                'placeholder'           => '1px',
                'selector'              => '{{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container.eead-toggle-switch-style1,
                                            {{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container.eead-toggle-switch-style2 .eead-toggle-slider,
                                            {{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container.eead-toggle-switch-style3',
            ]
        );

        $this->add_control(
            'toggle_switch_secondary_border_radius',
            [
                'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container.eead-toggle-switch-style1,
                     {{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container.eead-toggle-switch-style3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'switch_style!' => 'style2'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'switch_controller_heading',
            [
                'label'                 => __( 'Controller', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->start_controls_tabs( 'tabs_switch_controller' );

            $this->start_controls_tab(
                'tab_controller_primary',
                [
                    'label'             => __( 'Primary', 'easy-elementor-addons' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'              => 'primary_toggle_controller_background',
                        'types'             => [ 'classic', 'gradient' ],
                        'selector'          => '{{WRAPPER}} .eead-toggle-switch-container .eead-toggle-slider::before',
                    ]
                );

                $this->add_control(
                    'primary_toggle_controller_border_radius',
                    [
                        'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                        'type'                  => Controls_Manager::DIMENSIONS,
                        'size_units'            => [ 'px', '%' ],
                        'selectors'             => [
                            '{{WRAPPER}} .eead-toggle-switch-container .eead-toggle-slider::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tab_controller_secondary',
                [
                    'label'             => __( 'Secondary', 'easy-elementor-addons' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'              => 'secondary_toggle_controller_background',
                        'types'             => [ 'classic', 'gradient' ],
                        'selector'          => '{{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container .eead-toggle-slider::before',
                    ]
                );

                $this->add_control(
                    'secondary_toggle_controller_border_radius',
                    [
                        'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                        'type'                  => Controls_Manager::DIMENSIONS,
                        'size_units'            => [ 'px', '%' ],
                        'selectors'             => [
                            '{{WRAPPER}} .eead-toggle-switch-on.eead-toggle-switch-container .eead-toggle-slider::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_label_style',
            [
                'label'             => __( 'Labels', 'easy-elementor-addons' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'label_typography',
                'label'             => __( 'Typography', 'easy-elementor-addons' ),
                'selector'          => '{{WRAPPER}} .eead-primary-toggle-label,
                                        {{WRAPPER}} .eead-secondary-toggle-label',
            ]
        );

        $this->add_control(
            'label_horizontal_position',
            [
                'label'                 => __( 'Position', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => false,
                'default'               => 'middle',
                'options'               => [
                    'top'          => [
                        'title'    => __( 'Top', 'easy-elementor-addons' ),
                        'icon'     => 'eicon-v-align-top',
                    ],
                    'middle'       => [
                        'title'    => __( 'Middle', 'easy-elementor-addons' ),
                        'icon'     => 'eicon-v-align-middle',
                    ],
                    'bottom'       => [
                        'title'    => __( 'Bottom', 'easy-elementor-addons' ),
                        'icon'     => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors_dictionary'  => [
                    'top'      => 'flex-start',
                    'middle'   => 'center',
                    'bottom'   => 'flex-end',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-switch-inner' => 'align-items: {{VALUE}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_label_style' );

        $this->start_controls_tab(
            'tab_label_primary',
            [
                'label'             => __( 'Primary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'label_text_color_primary',
            [
                'label'             => __( 'Text Color', 'easy-elementor-addons' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .eead-primary-toggle-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_active_text_color_primary',
            [
                'label'             => __( 'Active Text Color', 'easy-elementor-addons' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .eead-primary-toggle-label.eead-toggle-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_label_secondary',
            [
                'label'             => __( 'Secondary', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'label_text_color_secondary',
            [
                'label'             => __( 'Text Color', 'easy-elementor-addons' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .eead-secondary-toggle-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_active_text_color_secondary',
            [
                'label'             => __( 'Active Text Color', 'easy-elementor-addons' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .eead-secondary-toggle-label.eead-toggle-active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label'             => __( 'Content', 'easy-elementor-addons' ),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label'                 => __( 'Alignment', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
                'default'               => 'center',
                'options'               => [
                    'left'          => [
                        'title'     => __( 'Left', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-left',
                    ],
                    'center'        => [
                        'title'     => __( 'Center', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-center',
                    ],
                    'right'         => [
                        'title'     => __( 'Right', 'easy-elementor-addons' ),
                        'icon'      => 'eicon-h-align-right',
                    ],
                ],
                'selectors'         => [
                    '{{WRAPPER}} .eead-toggle-content-wrap' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'content_typography',
                'label'             => __( 'Typography', 'easy-elementor-addons' ),
                'selector'          => '{{WRAPPER}} .eead-toggle-content-wrap',
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label'             => __( 'Text Color', 'easy-elementor-addons' ),
                'type'              => Controls_Manager::COLOR,
                'default'           => '',
                'selectors'         => [
                    '{{WRAPPER}} .eead-toggle-content-wrap' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'              => 'content_background',
                'types'             => [ 'classic', 'gradient' ],
                'selector'          => '{{WRAPPER}} .eead-toggle-content-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'content_border',
                'label'                 => __( 'Border', 'easy-elementor-addons' ),
                'placeholder'           => '1px',
                'selector'              => '{{WRAPPER}} .eead-toggle-content-wrap',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'                 => __( 'Padding', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-toggle-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_toggle_content( $is_primary ) {
        $settings = $this->get_settings_for_display();
        $primary_secondary = $is_primary == 'yes' ? 'primary' : 'secondary'; 

        if ( $settings[$primary_secondary.'_content_type'] === 'content' ) {

            echo $this->parse_text_editor( $settings[$primary_secondary.'_content'] );

        } 
        else if ( $settings[$primary_secondary.'_content_type'] === 'image' ) {

            echo Group_Control_Image_Size::get_attachment_image_html( $settings, $primary_secondary.'_image', $primary_secondary.'_image' );

        } 
        else if ( $settings[$primary_secondary.'_content_type'] === 'template' ) {
            if ( !empty( $settings[$primary_secondary.'_templates'] ) ) {

                $template_id = $settings[$primary_secondary.'_templates'];
                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
            }

        }
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = esc_attr($this->get_id());
        $default_display = $settings['default_display'];
       
        ?>
        <div class='eead-toggle-container' id='eead-toggle-container-<?php echo $id ?>'>
            <?php
            if ( $settings['toggle_position'] === 'before' || $settings['toggle_position'] === 'before-after' ) {
                $this->before_after_toggle( 'before' );
            }
            ?>
            <div class='eead-toggle-content-wrap'>
                <div class="eead-toggle-section eead-toggle-section-primary" style="<?php echo $default_display == 'secondary' ? 'display: none;' : '';?>">
                    <?php echo $this->render_toggle_content('yes'); ?>
                </div>
                <div class="eead-toggle-section eead-toggle-section-secondary" style="<?php echo $default_display == 'primary' ? 'display: none;' : '';?>">
                    <?php echo $this->render_toggle_content('no'); ?>
                </div>
            </div>
            <?php
            if ( $settings['toggle_position'] === 'after' || $settings['toggle_position'] === 'before-after' ) {
                $this->before_after_toggle( 'after' );
            }
            ?>
        </div>
        <?php
    }

    protected function before_after_toggle( $toggle_position = 'before' ) {
        $settings = $this->get_settings();

        $primary_active = $settings['default_display'] === 'primary' ? 'eead-toggle-active' : null;
        $secondary_active = $settings['default_display'] === 'secondary' ? 'eead-toggle-active' : null;     
        $checked = 'secondary' === $settings['default_display'] ? 'checked' : '';
        ?>
        <div class="eead-toggle-switch-wrap eead-toggle-switch-<?php echo $toggle_position; ?>">
            <div class="eead-toggle-switch-inner">
                <?php if ( $settings['primary_label'] ) { ?>
                    <div class="eead-toggle-label eead-primary-toggle-label <?php echo $primary_active; ?>">
                        <?php echo esc_attr( $settings['primary_label'] ); ?>
                    </div>
                <?php } ?>
                <div class="eead-toggle-switch-container eead-toggle-switch-<?php echo $settings['switch_style']; ?> <?php echo $settings['default_display'] == 'secondary' ? 'eead-toggle-switch-on' : ''; ?>">
                    <label class="eead-toggle-switch-label">
                        <input class="eead-toggle-switch" type="checkbox" <?php echo $checked; ?>>
                        <span class="eead-toggle-slider"></span>
                    </label>
                </div>
                <?php if ( $settings['secondary_label'] ) { ?>
                    <div class="eead-toggle-label eead-secondary-toggle-label <?php echo $secondary_active; ?>">
                        <?php echo esc_attr( $settings['secondary_label'] ); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}
