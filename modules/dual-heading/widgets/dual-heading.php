<?php

namespace EasyElementorAddons\Modules\DualHeading\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Dual Heading Widget
 */
class DualHeading extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-dual-heading-block-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Dual Heading', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-editor-h1';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [  ];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_dual_heading', [
                'label'                 => __( 'Dual Heading', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'first_heading', [
                'label'                 => __( 'First Heading Text', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::TEXTAREA,
                'dynamic'               => [
                    'active'   => true,
                ],
                'label_block'           => true,
                'rows'                  => 3,
                'default'               => __( 'Dual', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'second_heading', [
                'label'                 => __( 'Second Heading Text', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::TEXTAREA,
                'dynamic'               => [
                    'active'   => true,
                ],
                'label_block'           => true,
                'rows'                  => 3,
                'default'               => __( 'Heading', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'link', [
                'label'                 => __( 'Link', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::URL,
                'dynamic'               => [
                    'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'label_block'           => true,
                'placeholder'           => 'https://www.your-link.com',
            ]
        );

        $this->add_control(
            'heading_html_tag', [
                'label'                 => __( 'HTML Tag', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => 'h2',
                'options'               => eead_html_tags(),
            ]
        );

        $this->add_control(
            'second_part_display', [
                'label'                 => __( 'Second Heading Display', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => 'inline-block',
                'options'               => [
                    'inline-block'  => __( 'Inline', 'easy-elementor-addons' ),
                    'block'         => __( 'Block', 'easy-elementor-addons' ),
                ],
                'prefix_class'          => 'eead-dual-heading-',
                'selectors'             => [
                    '{{WRAPPER}} .eead-second-text' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align', [
                'label'                 => __( 'Alignment', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => false,
                'options'               => [
                    'left'      => [
                        'title' => __( 'Left', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}}'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* First Heading Styles */
        $this->start_controls_section(
            'first_section_style', [
                'label'                 => __( 'First Part', 'easy-elementor-addons' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('dual_header_first_back_clip', [
                'label'         => __('Background Style', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'color',
                'options'       => [
                    'color'         => __('Normal', 'easy-elementor-addons'),
                    'clipped'       => __('Clipped', 'easy-elementor-addons'),
                ],
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'dual_header_first_color', [
                'label'                 => __( 'Text Color', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_first_back_clip' => 'color'
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-first-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'              => 'dual_header_first_background',
                'types'             => [ 'classic' , 'gradient' ],
                'condition'         => [
                    'dual_header_first_back_clip'  => 'color'
                ],
                'selector'          => '{{WRAPPER}} .eead-first-text'
            ]
        );

        $this->add_control('dual_header_first_stroke', [
                'label'         => __('Stroke', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'         => [
                    'dual_header_first_back_clip'  => 'clipped'
                ],
            ]
        );

        $this->add_control('dual_header_first_stroke_text_color', [
                'label'         => __('Stroke Text Color', 'easy-elementor-addons'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_first_back_clip'   => 'clipped',
                    'dual_header_first_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-first-text'   => '-webkit-text-stroke-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('dual_header_first_stroke_color', [
                'label'         => __('Stroke Fill Color', 'easy-elementor-addons'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_first_back_clip'   => 'clipped',
                    'dual_header_first_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-first-text'   => '-webkit-text-fill-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('dual_header_first_stroke_width', [
                'label'         => __('Stroke Fill Width', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [
                    'dual_header_first_back_clip'   => 'clipped',
                    'dual_header_first_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-first-text'   => '-webkit-text-stroke-width: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'              => 'dual_header_first_clipped_background',
                'types'             => [ 'classic' , 'gradient' ],
                'condition'         => [
                    'dual_header_first_back_clip'  => 'clipped',
                    'dual_header_first_stroke!'      => 'yes'
                ],
                'selector'          => '{{WRAPPER}} .eead-first-text'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'                  => 'first_typography',
                'label'                 => __( 'Typography', 'easy-elementor-addons' ),
                'selector'              => '{{WRAPPER}} .eead-first-text',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'                  => 'first_border',
                'label'                 => __( 'Border', 'easy-elementor-addons' ),
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .eead-first-text',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'first_border_radius', [
                'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-first-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'first_text_padding', [
                'label'                 => __( 'Padding', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-first-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'                  => 'first_text_shadow',
                'selector'              => '{{WRAPPER}} .eead-first-text',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'                  => 'first_box_shadow',
                'selector'              => '{{WRAPPER}} .eead-first-text',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_section();

        /*Second Heading Styles*/
        $this->start_controls_section(
            'second_section_style', [
                'label'                 => __( 'Second Part', 'easy-elementor-addons' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('dual_header_second_back_clip', [
                'label'         => __('Background Style', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'color',
                'options'       => [
                    'color'         => __('Normal', 'easy-elementor-addons'),
                    'clipped'       => __('Clipped', 'easy-elementor-addons'),
                ],
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'dual_header_second_color', [
                'label'                 => __( 'Text Color', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_second_back_clip' => 'color'
                ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-second-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'              => 'dual_header_second_background',
                'types'             => [ 'classic' , 'gradient' ],
                'condition'         => [
                    'dual_header_second_back_clip'  => 'color'
                ],
                'selector'          => '{{WRAPPER}} .eead-second-text'
            ]
        );

        $this->add_control('dual_header_second_stroke', [
                'label'         => __('Stroke', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'         => [
                    'dual_header_second_back_clip'  => 'clipped'
                ],
            ]
        );

        $this->add_control('dual_header_second_stroke_text_color', [
                'label'         => __('Stroke Text Color', 'easy-elementor-addons'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_second_back_clip'   => 'clipped',
                    'dual_header_second_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-second-text'   => '-webkit-text-stroke-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('dual_header_second_stroke_color', [
                'label'         => __('Stroke Fill Color', 'easy-elementor-addons'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'dual_header_second_back_clip'   => 'clipped',
                    'dual_header_second_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-second-text'   => '-webkit-text-fill-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('dual_header_second_stroke_width', [
                'label'         => __('Stroke Fill Width', 'easy-elementor-addons'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [
                    'dual_header_second_back_clip'   => 'clipped',
                    'dual_header_second_stroke'      => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eead-second-text'   => '-webkit-text-stroke-width: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'              => 'dual_header_second_clipped_background',
                'types'             => [ 'classic' , 'gradient' ],
                'condition'         => [
                    'dual_header_second_back_clip'  => 'clipped',
                    'dual_header_second_stroke!'      => 'yes'
                ],
                'selector'          => '{{WRAPPER}} .eead-second-text'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'                  => 'second_typography',
                'label'                 => __( 'Typography', 'easy-elementor-addons' ),
                'selector'              => '{{WRAPPER}} .eead-second-text',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'                  => 'second_border',
                'label'                 => __( 'Border', 'easy-elementor-addons' ),
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .eead-second-text',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'second_border_radius', [
                'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-second-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'second_text_margin', [
                'label'                 => __( 'Spacing', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ '%', 'px' ],
                'default'               => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'range'                 => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}}.eead-dual-heading-inline-block .eead-second-text' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.eead-dual-heading-block .eead-second-text' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'second_text_padding', [
                'label'                 => __( 'Padding', 'easy-elementor-addons' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .eead-second-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name'                  => 'second_text_shadow',
                'selector'              => '{{WRAPPER}} .eead-second-text',
                'separator'             => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'                  => 'second_box_shadow',
                'selector'              => '{{WRAPPER}} .eead-second-text',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'first_heading', 'basic' );
        $this->add_render_attribute( 'first_heading', 'class', 'eead-first-text' );

        $this->add_inline_editing_attributes( 'second_heading', 'basic' );
        $this->add_render_attribute( 'second_heading', 'class', 'eead-second-text' );

        if(!$settings['dual_header_first_stroke'] && $settings['dual_header_first_back_clip'] == 'clipped') {
            $this->add_render_attribute( 'first_heading', 'class', 'eead-clipped' );
        }

        if(!$settings['dual_header_second_stroke'] && $settings['dual_header_second_back_clip'] == 'clipped') {
            $this->add_render_attribute( 'second_heading', 'class', 'eead-clipped' );
        }

        $heading_text = '';

        if ( $settings['first_heading'] ) {
            $heading_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'first_heading' ), esc_html($settings['first_heading']) );
        }
        if ( $settings['second_heading'] ) {
            $heading_text .= sprintf( ' <span %1$s>%2$s</span>', $this->get_render_attribute_string( 'second_heading' ), esc_html($settings['second_heading']) );
        }

        if ( !empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'heading-link', [
                'class' => 'eead-heading-link',
                'href'  => $settings['link']['url']
            ]);
            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'heading-link', 'target', '_blank' );
            }
        }

        if ( $settings['first_heading'] || $settings['second_heading'] ) {
        ?>
            <<?php echo $settings['heading_html_tag'] ?> class="eead-dual-heading">

                <?php
                if ( !empty( $settings['link']['url'] ) ) {
                    printf( '<a %1$s>', $this->get_render_attribute_string( 'heading-link' ) ); 
                } 

                echo $heading_text;

                if ( !empty( $settings['link']['url'] ) ) {
                    printf( '</a>' ); 
                } 
                ?>

            </<?php echo $settings['heading_html_tag'] ?>> 
        <?php 
        }
    }
}
