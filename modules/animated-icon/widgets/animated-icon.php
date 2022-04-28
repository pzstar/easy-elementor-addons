<?php

namespace EasyElementorAddons\Modules\AnimatedIcon\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class AnimatedIcon extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-animated-heading-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Animated Icon', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'lordicon' ];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'eead_general', [
                'label' => esc_html__( 'General', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_type', [
                'label'         => esc_html__( 'Select JSON', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'url',
                'options'       => [
                    'file'  => [
                        'title' => esc_html__( 'JSON File', 'easy-elementor-addons' ),
                        'icon' => 'eicon-document-file',
                    ],
                    'url'   => [
                        'title' => esc_html__( 'JSON URL', 'easy-elementor-addons' ),
                        'icon' => 'eicon-link',
                    ],
                ]
            ]
        );

        $this->add_control(
            'eead_json', [
                'show_label'    => false,
                'type'          => Controls_Manager::MEDIA,
                'media_type'    => 'application/json',
                'description'   => sprintf(
                    __('Discover thousands of %sLordicon animations%s ready to use.', 'easy-elementor-addons'),
                    '<a href="https://lordicon.com/" target="_blank">',
                    '</a>'
                ),
                'condition'    => [
                    'eead_type'  => 'file',
                ],
            ]
        );

        $this->add_control(
            'eead_url', [
                'show_label'    => false,
                'label_block'   => true,
                'description'   => sprintf(
                    __('Discover thousands of %sLordicon animations%s ready to use.', 'easy-elementor-addons'),
                    '<a href="https://lordicon.com/" target="_blank">',
                    '</a>'
                ),
                'default' => 'https://cdn.lordicon.com/gmzxduhd.json',
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'https://example.com/file.json', 'easy-elementor-addons' ),
                'show_external' => false,
                'condition'     => [
                    'eead_type'  => 'url'
                ],
            ]
        );

        $this->add_control(
            'eead_animation_trigger', [
                'label' => esc_html__( 'Animation Trigger', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'description' => esc_html__('Method that makes the icon animate', 'easy-elementor-addons'),
                'options' => [
                    'loop' => esc_html__( 'Loop(always animate)', 'easy-elementor-addons' ),
                    'click' => esc_html__( 'Click', 'easy-elementor-addons' ),
                    'hover' => esc_html__( 'Hover', 'easy-elementor-addons' ),
                    'loop-on-hover'   => esc_html__( 'Loop on Hover', 'easy-elementor-addons' ),
                    'morph'   => esc_html__( 'Morph', 'easy-elementor-addons' ),
                    'morph-two-way'   => esc_html__( 'Morph Two Way', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'eead_animation_target', [
                'label' => esc_html__( 'Target', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('For loop on hover and click'),
                'default' => 'icon',
                'options' => [
                    'widget' => esc_html__( 'On Widget', 'easy-elementor-addons' ),
                    'icon' => esc_html__( 'On Icon', 'easy-elementor-addons' ),
                    'column' => esc_html__( 'On Column', 'easy-elementor-addons' ),
                    'section'   => esc_html__( 'On Section', 'easy-elementor-addons' ),
                    'custom'   => esc_html__( 'Custom', 'easy-elementor-addons' )
                ],
            ]
        );

        $this->add_control(
            'eead_custom_target',
            array(
                'label'       => __( 'Custom Target', 'easy-elementor-addons' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => array(
                    'active' => true,
                ),
                'default'     => __( '.example', 'easy-elementor-addons' ),
                'condition'     => [
                    'eead_animation_target'  => 'custom'
                ],
            )
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'eead_content', [
                'label' => esc_html__( 'Content', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_show_title', [
                'label'     => __( 'Show Title', 'easy-elementor-addons' ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'eead_title', [
                'label'       => __( 'Title', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'default'     => __( 'Lordicon', 'easy-elementor-addons' ),
                'condition'     => [
                    'eead_show_title'  => 'yes'
                ],
            ]
        );

        $this->add_control(
            'eead_show_text', [
                'label'     => __( 'Show Text', 'easy-elementor-addons' ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'eead_text', [
                'label'       => __( 'Title', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [ 'active' => true ],
                'condition'     => [
                    'eead_show_text'  => 'yes'
                ],
            ]
        );

        $this->add_control(
            'eead_show_button', [
                'label'     => __( 'Show Button', 'easy-elementor-addons' ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'eead_button_text', [
                'label'       => __( 'Button Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true ],
                'condition'     => [
                    'eead_show_button'  => 'yes'
                ],
            ]
        );

        $this->add_control(
            'eead_button_url', [
                'label'       => __( 'Button Link', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [ 'active' => true ],
                'condition'     => [
                    'eead_show_button'  => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_icon_styles', [
                'label' => esc_html__( 'Icon', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'eead_icon_size', [
                'label'   => __( 'Size', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 72,
                ],
                'tablet_default' => [
                    'size' => 72,
                ],
                'mobile_default' => [
                    'size' => 72,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} lord-icon' => 'height:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_control(
            'eead_color_one', [
                'label'     => __( 'Color One', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'eead_color_two', [
                'label'     => __( 'Color Two', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'eead_icon_stroke', [
                'label'   => __( 'Stroke', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SLIDER,
                'description' => 'Thickness of the illustrated line',
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ]
            ]
        );

        $this->add_control(
            'eead_icon_background', [
                'label'     => __( 'Icon Background', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'eead_icon_shape_type', [
                'label' => esc_html__( 'Shape Type', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'description' => esc_html__('Method that makes the icon animate', 'easy-elementor-addons'),
                'options' => [
                    'radius' => esc_html__( 'Radius', 'easy-elementor-addons' ),
                    'clip-path' => esc_html__( 'Clip Path', 'easy-elementor-addons' )
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_icon_radius', [
                'label'      => esc_html__('Icon Radius', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'condition'     => [
                    'eead_icon_shape_type'  => 'radius'
                ],
            ]
        );

        $this->add_control(
            'eead_icon_shape', [
                'label' => esc_html__( 'Shape Type', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'description' => esc_html__('Method that makes the icon animate', 'easy-elementor-addons'),
                'options' => [
                    '' => esc_html__( 'None', 'easy-elementor-addons' ),
                    'triangle' => esc_html__( 'Triangle', 'easy-elementor-addons' ),
                    'trapezoid' => esc_html__( 'Trapezoid', 'easy-elementor-addons' ),
                    'parallelogram' => esc_html__( 'Parallelogram', 'easy-elementor-addons' ),
                    'rhombus' => esc_html__( 'Rhombus', 'easy-elementor-addons' ),
                    'pentagon' => esc_html__( 'Pentagon', 'easy-elementor-addons' ),
                    'hexagon' => esc_html__( 'Hexagon', 'easy-elementor-addons' ),
                    'heptagon' => esc_html__( 'Heptagon', 'easy-elementor-addons' ),
                    'octagon' => esc_html__( 'Octagon', 'easy-elementor-addons' ),
                    'nonagon' => esc_html__( 'Nonagon', 'easy-elementor-addons' ),
                    'decagon' => esc_html__( 'Decagon', 'easy-elementor-addons' ),
                    'bevel' => esc_html__( 'Bevel', 'easy-elementor-addons' ),
                    'polygon' => esc_html__( 'Polygon', 'easy-elementor-addons' ),
                ],
                'condition'     => [
                    'eead_icon_shape_type'  => 'clip-path'
                ],
            ]
        );

        $this->add_responsive_control(
            'eead_icon_padding', [
                'label'      => esc_html__('Icon Padding', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'eead_icon_shadow',
                // 'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-main-heading > div'
            ]
        );

        $this->add_responsive_control(
            'eead_icon_margin', [
                'label'      => esc_html__('Icon Margin', 'easy-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'eead_box_styles', [
                'label' => esc_html__( 'Box', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="eead-lord-icon-wrapper " id="uc_lord_icon_elementor14674">
            <?php
            if ( $settings['eead_type'] == 'file' ) {
                $icon_url = !empty($settings['eead_json']['url']) ? $settings['eead_json']['url'] : '';
            } else if ( $settings['eead_type'] == 'url' ) {
                $icon_url = !empty($settings['eead_url']) ? $settings['eead_url'] : '';
            }
            ?>
            <a href="#">
                <div>
                    <lord-icon src="<?php echo esc_url($icon_url) ?>" trigger="<?php echo esc_attr($settings['eead_animation_trigger']) ?>" target="<?php echo esc_attr($settings['eead_animation_target']) ?>" stroke="<?php echo esc_attr($settings['eead_icon_stroke']['size']) ?>" colors="primary:<?php echo esc_attr($settings['eead_color_one']) ?>,secondary:<?php echo esc_attr($settings['eead_color_two']) ?>">
                    </lord-icon>
                </div>
            </a>
            <div class="eead-lord-icon-content">
                <?php if($settings['eead_show_title'] == 'yes') : ?>
                    <div class="eead-box-title"><?php echo esc_html($settings['eead_title']) ?></div>
                <?php endif;?>
                <?php if($settings['eead_show_text'] == 'yes') : ?>
                    <div class="eead-box-text"><?php echo esc_html($settings['eead_text']) ?></div>  
                <?php endif;?>
                <?php if($settings['eead_show_button'] == 'yes') : ?>
                    <div class="eead-box-button">
                        <a class="eead-btn " href="# "><?php echo esc_html($settings['eead_button_text']) ?></a>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <?php
    }
}