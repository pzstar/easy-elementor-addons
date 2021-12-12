<?php

namespace EasyElementorAddons\Modules\ImageAccordion\Widgets;

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use Elementor\Utils;

class ImageAccordion extends Widget_Base {
    public function get_name() {
        return 'eead-image-accordion';
    }

    public function get_title() {
        return esc_html__( 'Image Accordion', 'easy-elementor-addons' );
    }

    public function get_icon() {
        return 'eaicon-image-accrodion';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_keywords() {
        return [
            'image',
            'image accordion',
            'image effect',
            'hover effect',
            'creative image',
            'gallery',
        ];
    }

    protected function _register_controls() {
        /**
         * Image accordion Adder
         */        
        $this->start_controls_section(
            'eead_img_accordion_section',
            [
                'label' => esc_html__( 'Accordion', 'easy-elementor-addons' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'eead_accordion_bg',
            [
                'label'       => esc_html__( 'Background Image', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'eead_accordion_tittle',
            [
                'label'       => esc_html__( 'Title', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Accordion item title', 'easy-elementor-addons' ),
                'dynamic'     => [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'eead_accordion_content',
            [
                'label'       => esc_html__( 'Content', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => esc_html__( 'Accordion content goes here!', 'easy-elementor-addons' ),
            ]
        );

        $repeater->add_control(
            'eead_accordion_is_active',
            [
                'label'        => __( 'Active?', 'easy-elementor-addons' ),
                'description'  => __( 'Enabling it will open this block on page load.', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'easy-elementor-addons' ),
                'label_off'    => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'eead_accordion_enable_title_link',
            [
                'label'        => esc_html__( 'Enable Title Link', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'easy-elementor-addons' ),
                'label_off'    => __( 'Hide', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'eead_accordion_title_link',
            [
                'name'          => 'eead_accordion_title_link',
                'label'         => esc_html__( 'Title Link', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition'     => [
                    'eead_accordion_enable_title_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'eead_img_accordions',
            [
                'type'        => Controls_Manager::REPEATER,
                'seperator'   => 'before',
                'default'     => [
                    [
                        'eead_accordion_tittle'  => esc_html__( 'Image Accordion #1', 'easy-elementor-addons' ),
                        'eead_accordion_content' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ratione, dolore expedita repudiandae unde nihil, accusantium!', 'easy-elementor-addons' ),
                        'eead_accordion_bg'      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'eead_accordion_tittle'  => esc_html__( 'Image Accordion #2', 'easy-elementor-addons' ),
                        'eead_accordion_content' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ratione, dolore expedita repudiandae unde nihil, accusantium!', 'easy-elementor-addons' ),
                        'eead_accordion_bg'      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'eead_accordion_tittle'  => esc_html__( 'Image Accordion #3', 'easy-elementor-addons' ),
                        'eead_accordion_content' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ratione, dolore expedita repudiandae unde nihil, accusantium!', 'easy-elementor-addons' ),
                        'eead_accordion_bg'      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ]
                    ],
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{eead_accordion_tittle}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Image accordion General Settings
         */
        $this->start_controls_section(
            'eead_section_img_accordion_settings',
            [
                'label' => esc_html__( 'Settings', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_img_accordion_action_type',
            [
                'label'       => esc_html__( 'Accordion Action', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'on_hover',
                'label_block' => false,
                'options'     => [
                    'on_hover' => esc_html__( 'On Hover', 'easy-elementor-addons' ),
                    'on_click' => esc_html__( 'On Click', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'eead_img_accordion_layout_type',
            [
                'label'       => esc_html__( 'Layout Type', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'accordion-direction-horizontal' => esc_html__( 'Horizontal', 'easy-elementor-addons' ),
                    'accordion-direction-vertical'   => esc_html__( 'Vertical', 'easy-elementor-addons' ),
                ],
                'default'     => 'accordion-direction-vertical',
            ]
        );

        $this->add_control(
            'eead_img_accordion_content_horizontal_align',
            [
                'label'       => esc_html__( 'Horizontal Align', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'left' => esc_html__( 'Left', 'easy-elementor-addons' ),
                    'center'   => esc_html__( 'Center', 'easy-elementor-addons' ),
                    'right'   => esc_html__( 'Right', 'easy-elementor-addons' ),
                ],
                'default'     => 'center',
            ]
        );

        $this->add_control(
            'eead_img_accordion_content_vertical_align',
            [
                'label'       => esc_html__( 'Vertical Align', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'top' => esc_html__( 'Top', 'easy-elementor-addons' ),
                    'center'   => esc_html__( 'Center', 'easy-elementor-addons' ),
                    'bottom'   => esc_html__( 'Bottom', 'easy-elementor-addons' ),
                ],
                'default'     => 'center',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => __( 'Select Tag', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1'   => __( 'H1', 'easy-elementor-addons' ),
                    'h2'   => __( 'H2', 'easy-elementor-addons' ),
                    'h3'   => __( 'H3', 'easy-elementor-addons' ),
                    'h4'   => __( 'H4', 'easy-elementor-addons' ),
                    'h5'   => __( 'H5', 'easy-elementor-addons' ),
                    'h6'   => __( 'H6', 'easy-elementor-addons' ),
                    'span' => __( 'Span', 'easy-elementor-addons' ),
                    'p'    => __( 'P', 'easy-elementor-addons' ),
                    'div'  => __( 'Div', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Image Accordion General Style
         */
        $this->start_controls_section(
            'eead_section_img_accordion_style_settings',
            [
                'label' => esc_html__( 'General', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'eead_accordion_shadow',
                'selector' => '{{WRAPPER}} .eead-img-accordion',
            ]
        );

        $this->add_control(
            'eead_accordion_img_overlay_color',
            [
                'label'     => esc_html__( 'Normal Overlay Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, .2)',
                'selectors' => [
                    '{{WRAPPER}} .eead-img-accordion .eead-image-accordion-hover::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_accordion_img_hover_color',
            [
                'label'     => esc_html__( 'Hover Overlay Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, .5)',
                'selectors' => [
                    '{{WRAPPER}} .eead-img-accordion .eead-image-accordion-hover:hover::before'         => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-img-accordion .eead-image-accordion-hover.overlay-active::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'eead_accordion_height',
            [
                'label'       => esc_html__( 'Height (px)', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '500',
                'selectors'   => [
                    '{{WRAPPER}} .eead-img-accordion ' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'eead_accordion_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-img-accordion' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_accordion_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_accordion_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        /* Thumbnail Tab Style */
        $this->start_controls_section(
            'eead_section_img_accordion_image_style',
            [
                'label' => esc_html__( 'Image', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_image_accordion_image_margin',
            [
                'label'      => __( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_image_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_image_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'eead_image_accordion_image_border',
                'label'    => __( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-img-accordion a',
            ]
        );

        $this->end_controls_section();

        /**
         * Accordion Title Style
         */
        $this->start_controls_section(
            'eead__img_accordion_title_style',
            [
                'label' => esc_html__( 'Title', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_accordion_title_color',
            [
                'label'     => esc_html__( 'Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-img-accordion .overlay .img-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eead_accordion_title_typography',
                'selector' => '{{WRAPPER}} .eead-img-accordion .overlay h2',
            ]
        );

        $this->add_control(
            'eead_image_accordion_title_margin',
            [
                'label'      => __( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_title_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_title_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay h2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'eead_image_accordion_title_border',
                'label'    => __( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-img-accordion .overlay h2',
            ]
        );

        $this->end_controls_section();

        /**
         * Accordion Content Style
         */
        $this->start_controls_section(
            'eead_image_accordion_content_style',
            [
                'label' => esc_html__( 'Content', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'eead_image_accordion_content_color',
            [
                'label'     => esc_html__( 'Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-img-accordion .overlay p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'eead_image_accordion_content_typography',
                'selector' => '{{WRAPPER}} .eead-img-accordion .overlay p',
            ]
        );

        $this->add_control(
            'eead_image_accordion_content_margin',
            [
                'label'      => __( 'Margin', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_content_padding',
            [
                'label'      => __( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'eead_image_accordion_content_radius',
            [
                'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-img-accordion .overlay p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'eead_image_accordion_title_border',
                'label'    => __( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-img-accordion .overlay p',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings         = $this->get_settings_for_display();
        $vertical_align   = 'eead-img-accordion-vertical-align-' . $settings[ 'eead_img_accordion_content_vertical_align' ];
        $horizontal_align = 'eead-img-accordion-horizontal-align-' . $settings[ 'eead_img_accordion_content_horizontal_align' ];

        $this->add_render_attribute(
            'eead-image-accordion',
            [
                'class' => [
                    'eead-img-accordion',
                    $settings[ 'eead_img_accordion_layout_type' ],
                    $horizontal_align,
                    $vertical_align,
                ],
                'id'    => 'eead-img-accordion-' . $this->get_id(),
                'data-img-accordion-id' => esc_attr( $this->get_id() ),
                'data-img-accordion-type' => $settings[ 'eead_img_accordion_action_type' ]
            ]
        );

        if ( empty( $settings[ 'eead_img_accordions' ] ) ) {
            return;
        }
        ?>

        <div <?php $this->print_render_attribute_string( 'eead-image-accordion' ); ?>>
            <?php foreach ( $settings[ 'eead_img_accordions' ] as $key => $img_accordion ) { ?>
                <?php
                $active = '';
                $tag = $img_accordion[ 'eead_accordion_enable_title_link' ] == 'yes' ? 'a' : 'div';
                
                if ( $img_accordion[ 'eead_accordion_enable_title_link' ] == 'yes' ) {
                
                    $this->add_render_attribute(
                        'eead-image-accordion-link-' . $key,
                        [
                            'href' => esc_url( $img_accordion[ 'eead_accordion_title_link' ][ 'url' ] ),
                            'target' => $img_accordion[ 'eead_accordion_title_link' ][ 'is_external' ] ? '_blank' : '_self',
                            'rel' => $img_accordion[ 'eead_accordion_title_link' ][ 'nofollow' ] ? 'nofollow' : '',
                        ]
                    );
                    $active = $img_accordion[ 'eead_accordion_is_active' ];
                }

                
                $this->add_render_attribute(
                    'eead-image-accordion-link-' . $key,
                    [
                        'class' => 'eead-image-accordion-hover',
                        'style' => "background-image: url(" . esc_url( $img_accordion[ 'eead_accordion_bg' ][ 'url' ] ) . ");" . ($active === 'yes' ? ' flex: 3 1 0%;' : ''),
                    ]
                );

                if ( $active === 'yes' ) {
                    $this->add_render_attribute( 'eead-image-accordion-link-' . $key, 'class', 'overlay-active' );
                }
                ?>

                <<?php echo $tag.' '; ?><?php $this->print_render_attribute_string( 'eead-image-accordion-link-' . $key ); ?>  tabindex="<?php echo $key; ?>">
                    <div class="overlay">
                        <div class="overlay-inner">
                            <div class="overlay-inner <?php echo( $active === 'yes' ? ' overlay-inner-show' : '' ); ?>">
                                <?php printf( '<%1$s>%2$s</%1$s>', $settings[ 'title_tag' ], esc_html($img_accordion[ 'eead_accordion_tittle' ]) ); ?>
                                <p><?php echo parse_wisiwyg_content($img_accordion[ 'eead_accordion_content' ]); ?></p>
                            </div>
                        </div>
                    </div>
                </<?php echo $tag; ?>>
            <?php } ?>
        </div>

        <?php if ( !empty( $settings[ 'eead_img_accordions' ] ) && $settings[ 'eead_img_accordion_action_type' ] === 'on_hover' ) {
            ?>
            <style>
                #eead-img-accordion-<?php echo $this->get_id(); ?> .eead-image-accordion-hover:hover {
                    flex: 3 1 0% !important;
                }
                #eead-img-accordion-<?php echo $this->get_id(); ?> .eead-image-accordion-hover:hover .overlay-inner * {
                    opacity: 1;
                    transform: none;
                    visibility: visible;
                    transition: all .3s .3s;
                }
            </style>
        <?php     
        }  
    }
}
