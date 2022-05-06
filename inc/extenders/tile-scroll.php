<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

Class TileScroll {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        // Add section for settings
        add_action('elementor/element/section/section_effects/after_section_end', [$this, 'register_controls']);
        add_action('elementor/frontend/section/after_render', [$this, 'render_content']);
        add_action('elementor/section/print_template', [$this, 'print_template'], 10, 2);
        
        //add_action('elementor/element/section/eead_tile_scroll_section/before_section_end', [$this, 'register_controls'], 10, 2);
        //add_action('elementor/frontend/section/before_render', [$this, 'section_tile_scroll_before_render'], 10, 1);
    }

    public function section_tile_scroll_before_render($section) {
        $settings = $section->get_settings_for_display();
        if ('yes' === $settings['eead_tile_scroll_show']) {
            wp_enqueue_script('eead-tile-scroll');
        }
    }

    public function register_controls($elems) {
        $transform_prefix_class = 'eead-';
	$transform_return_value = 'transform';
                
        $elems->start_controls_section(
            'eead_tile_scroll_section', [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => esc_html__('Tile Scroll', 'easy-elementor-addons'),
            ]
        );

        $elems->add_control(
            'eead_tile_scroll_show', [
                'label'              => esc_html__('Use Tile Scroll?', 'easy-elementor-addons'),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => '',
                'return_value'       => 'yes',
                'prefix_class'       => 'eead-tile-scroll-',
                'render_type'        => 'template',
            ]
        );
        $elems->start_controls_tabs(
            'tabs_eead_tile_scroll'
        );
        $elems->start_controls_tab(
            'tabs_eead_tile_content', [
                'label'     => esc_html__('Content', 'easy-elementor-addons'),
                'condition' => [
                    'eead_tile_scroll_show' => 'yes'
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'eead_tile_scroll_title', [
                'label'       => __('Title', 'easy-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Item #1', 'easy-elementor-addons'),
                'label_block' => true,
                'render_type' => 'ui',
            ]
        );
        $repeater->add_control(
            'eead_tile_scroll_images', [
                'label' => esc_html__('Images', 'easy-elementor-addons'),
                'type'  => Controls_Manager::GALLERY,
            ]
        );


        $repeater->add_control(
            'eead_tile_scroll_x_start', [
                'label'   => esc_html__('Start', 'easy-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 550,
                ],
            ]
        );

        $repeater->add_control(
            'eead_tile_scroll_x_end', [
                'label' => esc_html__('End', 'easy-elementor-addons'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $elems->add_control(
            'eead_tile_scroll_elements', [
                'label'              => __('Tile Scroll Items', 'easy-elementor-addons'),
                'type'               => Controls_Manager::REPEATER,
                'fields'             => $repeater->get_controls(),
                'prevent_empty'      => false,
                'title_field'        => '{{{ eead_tile_scroll_title }}}',
                'render_type'        => 'none',
                'condition'          => [
                    'eead_tile_scroll_show' => 'yes'
                ],
                'default'            => [
                    [

                        'eead_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_tile_scroll_x_end'   => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                    ],
                    [

                        'eead_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'eead_tile_scroll_x_end'   => [
                            'unit' => 'px',
                            'size' => -150,
                        ]
                    ],
                    [

                        'eead_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_tile_scroll_x_end'   => [
                            'unit' => 'px',
                            'size' => 150,
                        ]
                    ],
                    [

                        'eead_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'eead_tile_scroll_x_end'   => [
                            'unit' => 'px',
                            'size' => -150,
                        ]
                    ],
                    [

                        'eead_tile_scroll_x_start' => [
                            'unit' => 'px',
                            'size' => -150,
                        ],
                        'eead_tile_scroll_x_end'   => [
                            'unit' => 'px',
                            'size' => 150,
                        ]
                    ]
                ],
            ]
        );
        $elems->end_controls_tab();
        $elems->start_controls_tab(
            'tabs_eead_tile_style', [
                'label'     => esc_html__('Style', 'easy-elementor-addons'),
                'condition' => [
                    'eead_tile_scroll_show' => 'yes'
                ]
            ]
        );
        
        $elems->add_responsive_control(
            'eead_tile_scroll_item_width', [
                'label'      => esc_html__('Width', 'easy-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 600,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}}' => '--eead-tile-width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_tile_scroll_show'    => 'yes',
                ]
            ]
        );
        $elems->add_responsive_control(
            'eead_tile_scroll_item_height', [
                'label'      => esc_html__('Height', 'easy-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 600,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}}' => '--eead-tile-height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_tile_scroll_show'    => 'yes',
                ]
            ]
        );
        $elems->add_responsive_control(
            'eead_tile_scroll_gap', [
                'label'      => esc_html__('Grid Gap', 'easy-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}}'     => '--eead-tile-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'eead_tile_scroll_show' => 'yes'
                ]
            ]
        );
        $elems->add_control(
                "eead_tile_rotate_popover",
                [
                        'label' => esc_html__( 'Rotate', 'elementor' ),
                        'type' => Controls_Manager::POPOVER_TOGGLE,
                        'prefix_class' => $transform_prefix_class,
                        'return_value' => $transform_return_value,
                ]
        );

        $elems->start_popover();

        $elems->add_responsive_control(
                "eead_tile_rotateZ_effect",
                [
                        'label' => esc_html__( 'Rotate', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => -360,
                                        'max' => 360,
                                ],
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-rotateZ: {{SIZE}}deg',
                        ],
                        'condition' => [
                                "eead_tile_rotate_popover!" => '',
                        ],
                ]
        );

        $elems->add_control(
                "eead_tile_rotate_3d",
                [
                        'label' => esc_html__( '3D Rotate', 'elementor' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'On', 'elementor' ),
                        'label_off' => esc_html__( 'Off', 'elementor' ),
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-rotateX: 1deg;  --eead-transform-perspective: 20px;',
                        ],
                        'condition' => [
                                "eead_tile_rotate_popover!" => '',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_rotateX_effect",
                [
                        'label' => esc_html__( 'Rotate X', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => -360,
                                        'max' => 360,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_rotate_3d!" => '',
                                "eead_tile_rotate_popover!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-rotateX: {{SIZE}}deg;',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_rotateY_effect",
                [
                        'label' => esc_html__( 'Rotate Y', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => -360,
                                        'max' => 360,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_rotate_3d!" => '',
                                "eead_tile_rotate_popover!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-rotateY: {{SIZE}}deg;',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_perspective_effect",
                [
                        'label' => esc_html__( 'Perspective', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 1000,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_rotate_popover!" => '',
                                "eead_tile_rotate_3d!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-perspective: {{SIZE}}px',
                        ],
                ]
        );

        $elems->end_popover();

        $elems->add_control(
                "eead_tile_translate_popover",
                [
                        'label' => esc_html__( 'Offset', 'elementor' ),
                        'type' => Controls_Manager::POPOVER_TOGGLE,
                        'prefix_class' => $transform_prefix_class,
                        'return_value' => $transform_return_value,
                ]
        );

        $elems->start_popover();

        $elems->add_responsive_control(
                "eead_tile_translateX_effect",
                [
                        'label' => esc_html__( 'Offset X', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'range' => [
                                '%' => [
                                        'min' => -100,
                                        'max' => 100,
                                ],
                                'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_translate_popover!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-translateX: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_translateY_effect",
                [
                        'label' => esc_html__( 'Offset Y', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'range' => [
                                '%' => [
                                        'min' => -100,
                                        'max' => 100,
                                ],
                                'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_translate_popover!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-translateY: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $elems->end_popover();

        $elems->add_control(
                "eead_tile_scale_popover",
                [
                        'label' => esc_html__( 'Scale', 'elementor' ),
                        'type' => Controls_Manager::POPOVER_TOGGLE,
                        'prefix_class' => $transform_prefix_class,
                        'return_value' => $transform_return_value,
                ]
        );

        $elems->start_popover();

        $elems->add_control(
                "eead_tile_keep_proportions",
                [
                        'label' => esc_html__( 'Keep Proportions', 'elementor' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'On', 'elementor' ),
                        'label_off' => esc_html__( 'Off', 'elementor' ),
                        'default' => 'yes',
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_scale_effect",
                [
                        'label' => esc_html__( 'Scale', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 2,
                                        'step' => 0.1,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_scale_popover!" => '',
                                "eead_tile_keep_proportions!" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-scale: {{SIZE}};',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_scaleX_effect",
                [
                        'label' => esc_html__( 'Scale X', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 2,
                                        'step' => 0.1,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_scale_popover!" => '',
                                "eead_tile_keep_proportions" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-scaleX: {{SIZE}};',
                        ],
                ]
        );

        $elems->add_responsive_control(
                "eead_tile_scaleY_effect",
                [
                        'label' => esc_html__( 'Scale Y', 'elementor' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 2,
                                        'step' => 0.1,
                                ],
                        ],
                        'condition' => [
                                "eead_tile_scale_popover!" => '',
                                "eead_tile_keep_proportions" => '',
                        ],
                        'selectors' => [
                                "{{WRAPPER}} .eead-tiles" => '--eead-transform-scaleY: {{SIZE}};',
                        ],
                ]
        );

        $elems->end_popover();

  

    $transform_origin_conditions = '';

    // Will override motion effect transform-origin
    $elems->add_responsive_control(
        'motion_fxeead_tile_x_anchor_point',
        [
                'label' => esc_html__( 'X Anchor Point', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                        'left' => [
                                'title' => esc_html__( 'Left', 'elementor' ),
                                'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                                'title' => esc_html__( 'Center', 'elementor' ),
                                'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                                'title' => esc_html__( 'Right', 'elementor' ),
                                'icon' => 'eicon-h-align-right',
                        ],
                ],
                'conditions' => $transform_origin_conditions,
                'separator' => 'before',
                'selectors' => [
                        '{{WRAPPER}}' => '--eead-transform-origin-x: {{VALUE}}',
                ],
        ]
    );

    // Will override motion effect transform-origin
    $elems->add_responsive_control(
        'motion_fxeead_tile_y_anchor_point',
        [
                'label' => esc_html__( 'Y Anchor Point', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                        'top' => [
                                'title' => esc_html__( 'Top', 'elementor' ),
                                'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                                'title' => esc_html__( 'Center', 'elementor' ),
                                'icon' => 'eicon-v-align-middle',
                        ],
                        'bottom' => [
                                'title' => esc_html__( 'Bottom', 'elementor' ),
                                'icon' => 'eicon-v-align-bottom',
                        ],
                ],
                'conditions' => $transform_origin_conditions,
                'selectors' => [
                        '{{WRAPPER}}' => '--eead-transform-origin-y: {{VALUE}}',
                ],
        ]
    );
        $elems->add_group_control(
            Group_Control_Border::get_type(), [
                'name'      => 'eead_tile_scroll_gap',
                'label'     => esc_html__('Border', 'easy-elementor-addons'),
                'selector'  => '{{WRAPPER}} .eead-tiles-row-img',
                'separator' => 'before'
            ]
        );
        $elems->add_responsive_control(
            'eead_title_radius', [
                'label'      => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} .eead-tiles-row-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $elems->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'eead_tile_scroll_shadow',
                'label'    => esc_html__('Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-tiles-row-img',
            ]
        );
        $elems->end_controls_tab();
        $elems->end_controls_tabs();
        
        $elems->end_controls_section();
    }
    
    public function render_content($elems) {
        $settings = $elems->get_settings_for_display();
        if ('yes' == $settings['eead_tile_scroll_show']):
            ?>
            <div class="eead-tiles eead-tile-section-<?php echo esc_attr($elems->get_id()); ?>">
                <div class="eead-tiles-wrap">
                    <?php 
                    foreach ($settings['eead_tile_scroll_elements'] as $index => $elements) :
                        ?>
                    <div class="eead-tiles-row">
                            <?php 
                            foreach ($elements['eead_tile_scroll_images'] as $image) :
                                ?>
                        <div class="eead-tiles-row-img" style="background-image:url(<?php echo $image['url']; ?>)"></div>
                        <?php
                            endforeach;
                            ?>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endif;
    }
    
    public function print_template($template, $elems) {
        $old_template = $template;

        ob_start();
        ?>
        <# if ('yes' == settings.eead_tile_scroll_show) {  #>
            <div class="eead-tiles eead-tile-section-{{{view.getID()}}}">
                <div class="eead-tiles-wrap">
                    <# _.each( settings.eead_tile_scroll_elements, function( elements, index ) { #>
                    <div data-scroll class="eead-tiles-row" data-scroll-speed="2" data-scroll-direction="horizontal">
                        <# _.each( elements.eead_tile_scroll_images, function( image, index ) { #>
                        <div class="eead-tiles-row-img" style="background-image:url({{image.url}})"></div>
                         <# }) #>
                        </div>
                    <# }) #>
                </div>
            </div>
        <# } #>
        <?php
        $content = ob_get_contents();
        ob_end_clean();

        return $content . $old_template;
    }


}

TileScroll::instance();
