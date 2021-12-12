<?php

namespace EasyElementorAddons\Modules\HotspotBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;
use Elementor\Utils;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class HotspotBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-hotspot-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Hotspot Block', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function _register_controls() {

        $this->start_controls_section(
                'items', [
            'label' => esc_html__('Items', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'image',
            array(
                'label'     => esc_html__( 'Image', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'      => 'image_resolution',
                'default'   => 'full',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable',
            [
                'label'        => esc_html__( 'Enable', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off'    => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_type',
            [
                'label' => __( 'Hotspot Type', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon'  => __( 'Icon', 'easy-elementor-addons' ),
                    'image' => __( 'Image', 'easy-elementor-addons' ),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_icon',
            [
                'label' => __( 'Hotspot Icon', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'icon_target',
                    'library' => 'solid',
                ],
                'condition' => [ 'hotspot_type' => 'icon' ]
            ]  
        );

        $repeater->add_control(
            'hotspot_image',
            [
                'label' => __( 'Hotspot Image', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [ 'hotspot_type' => 'image' ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'      => 'hotspot_img_resolution',
                'default'   => 'thumb',
                'condition' => [ 'hotspot_type' => 'image' ]
            )
        );

        $repeater->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'left'      => esc_html__( 'Left', 'easy-elementor-addons' ),
                    'center'    => esc_html__( 'Center', 'easy-elementor-addons' ),
                    'right'     => esc_html__( 'Right', 'easy-elementor-addons' ),
                ],
                'default' => 'left'
            ]
        );

        $repeater->add_control(
            'x_position',
            [
                'label' => esc_html__( 'X Postion', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon{{CURRENT_ITEM}},
                     {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'y_position',
            [
                'label' => esc_html__( 'Y Postion', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon{{CURRENT_ITEM}},
                     {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'each_content_width',
            [
                'label' => esc_html__( 'Each Content Width', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 1000,
                        'step'=> 1
                    ],
                ]
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label' => __( 'Content Type', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text_title_desc',
                'options' => [
                    'text_title_desc'  => __( 'Title & Description', 'easy-elementor-addons' ),
                    'wisiwyg' => __( 'WISIWYG', 'easy-elementor-addons' ),
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'hotspot_title', [
                'label' => __( 'Hotspot Title', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Title', 'easy-elementor-addons' ),
                'condition' => [ 'content_type' => 'text_title_desc' ]
            ]
        );

        $repeater->add_control(
            'hotspot_description',
            [
                'label' => __( 'Description', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'easy-elementor-addons' ),
                'placeholder' => __( 'Type your description here', 'easy-elementor-addons' ),
                'condition' => [ 'content_type' => 'text_title_desc' ]
            ]
        );

        $repeater->add_control(
            'wisiwyg_content',
            [
                'label' => __( 'WISIWYG', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Add your content here', 'easy-elementor-addons' ),
                'condition' => [ 'content_type' => 'wisiwyg' ]
            ]
        );

        $this->add_control(
            'hotspot_items',
            [
                'label' => __( 'Items', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Item #1', 'easy-elementor-addons' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'general_settings', [
            'label' => esc_html__('General Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'content_open_type',
            [
                'label' => __( 'Content Open Type', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'eead-open-onhover',
                'options' => [
                    'eead-open-onclick'  => __( 'On Click', 'easy-elementor-addons' ),
                    'eead-open-onhover' => __( 'On Hover', 'easy-elementor-addons' ),
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'enable_pulse_animation',
            [
                'label' => esc_html__( 'Pulse Animation', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-elementor-addons' ),
                'label_off' => esc_html__( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
                'pulse_color', [
            'label' => esc_html__('Pulse Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a .pulse,
                 {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a .pulse' => 'border: 5px solid {{VALUE}}',
            ],
            'condition' => [ 'enable_pulse_animation' => 'yes' ]
                ]
        );

        $this->add_control(
            'pulse_duration',
            [
                'label' => esc_html__( 'Pulse Duration(in ms)', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 600,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a .pulse,
                     {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a .pulse' => 'animation: pulsate {{SIZE}}ms infinite;',
                ],
                'condition' => [ 'enable_pulse_animation' => 'yes' ]
            ]
        );

        $this->add_control(
            'pulse_size',
            [
                'label' => esc_html__( 'Pulse Size', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 80,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a .pulse,
                     {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a .pulse' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [ 'enable_pulse_animation' => 'yes' ]
            ]
        );

        $this->add_control(
            'tooltip_position',
            [
                'label' => __( 'Tooltip Position', 'easy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'bottom-middle',
                'options' => [
                    'left-middle' => __( 'Left Middle', 'easy-elementor-addons' ),
                    'right-middle' => __( 'Right Middle', 'easy-elementor-addons' ),
                    'top-left' => __( 'Top Left', 'easy-elementor-addons' ),
                    'top-middle' => __( 'Top Middle', 'easy-elementor-addons' ),
                    'top-right' => __( 'Top Right', 'easy-elementor-addons' ),
                    'bottom-left' => __( 'Bottom Left', 'easy-elementor-addons' ),
                    'bottom-middle' => __( 'Bottom Middle', 'easy-elementor-addons' ),
                    'bottom-right' => __( 'Bottom Right', 'easy-elementor-addons' ),
                    'center' =>  __( 'Center', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'icon_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a,
                {{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_responsive_control(
                'icon_size', [
            'label' => __('Icon Size', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 12,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'icon_box_size', [
            'label' => __('Container Size', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-icon a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'image_icon_style', [
            'label' => esc_html__('Image', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'image_icon_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => 'transparent',
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_icon_border',
                'label' => __( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a img',
            ]
        );

        $this->add_responsive_control(
                'image_icon_size', [
            'label' => __('Image Icon Size', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 25,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                '(tablet){{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
                '(mobile){{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}}',
            ],
                ]
        );

        $this->add_control(
                'image_box_size', [
            'label' => __('Container Size', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 8,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-hotspot-section .eead-hotspot-image a' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'tooltip_style', [
            'label' => esc_html__('Tooltip', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tooltip_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#f1f0e4',
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tooltip_border',
                'label' => __( 'Border', 'easy-elementor-addons' ),
                'selector' => '{{WRAPPER}} .eead-each-spot-content',
            ]
        );

        $this->add_control(
                'tooltip_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->add_control(
                'tooltip_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content h2' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .eead-each-spot-content h2',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#909090',
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content p.eead-spot-description' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .eead-each-spot-content p.eead-spot-description',
                ]
        );

        $this->add_control(
                'description_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-each-spot-content p.eead-spot-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // pr($settings);die();
        ?>
        <div class="eead-hotspot-main-wrapper">
            <div class="eead-hotspot-inner-wrap">
                <?php if( isset($settings['hotspot_items']) && !empty($settings['hotspot_items']) ) { ?>
                    <div class="eead-hotspot-section <?php echo esc_attr($settings['content_open_type']); ?>">

                        <?php  
                        if(!$settings['image']['id']) {
                            $image_url = \Elementor\Utils::get_placeholder_image_src();
                            echo "<img src='". esc_url($image_url) ."' width='800'>";
                        } else {
                            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image_resolution', 'image');
                        }
                        ?>

                        <?php foreach ( $settings['hotspot_items'] as $key => $item ) { ?>

                            <?php if($item['enable'] != 'yes') { continue; } ?>

                            <?php 
                            if( $item['hotspot_type'] == 'icon' ) { 
                                ?>
                                <div class="eead-hotspot-item eead-hotspot-icon elementor-repeater-item-<?php echo esc_attr( $item['_id'] );?> drag_element" id=<?php echo 'hotspot_id_'.$key; ?>>
                                    <a href="javascript:void(0);">
                                        <?php 
                                        $this->pulsate_animation(); 
                                        \Elementor\Icons_Manager::render_icon($item['hotspot_icon'], ['aria-hidden' => 'true']); 
                                        $this->get_content( $key ); ?>
                                    </a>
                                </div>
                            <?php 
                            } else if( $item['hotspot_type'] == 'image' ) { 
                                if( !$item['hotspot_image']['id'] ) {
                                    $hotspot_image_url = \Elementor\Utils::get_placeholder_image_src();
                                    echo "<div class='eead-hotspot-item eead-hotspot-image elementor-repeater-item-" .esc_attr( $item['_id'] ). "'>";
                                    echo '<a href="javascript:void(0);">';
                                    $this->pulsate_animation();
                                    echo "<img src='" .esc_url($hotspot_image_url). "'>";
                                    $this->get_content( $key );
                                    echo "</a>";
                                    echo "</div>";
                                } else {
                                    $hotspot_image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src($item['hotspot_image']['id'], 'hotspot_img_resolution', $item);
                                    echo "<div class='eead-hotspot-item eead-hotspot-image elementor-repeater-item-" .esc_attr( $item['_id'] ). "'>";
                                    echo '<a href="javascript:void(0);">';
                                    $this->pulsate_animation();
                                    echo "<img src='" .esc_url($hotspot_image_url). "'>";
                                    $this->get_content( $key );
                                    echo "</a>";
                                    echo "</div>";
                                } 
                            } 
                            ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function pulsate_animation() {
        $settings = $this->get_settings_for_display();
        if($settings['enable_pulse_animation'] == 'yes') {
            echo '<div class="pulse"></div>';
        }
    }

    protected function get_content( $key ) {
        $settings = $this->get_settings_for_display();
        $item = $settings['hotspot_items'][$key];
        $align = $settings['hotspot_items'][$key]['text_align'];
        ?>
        <div class="eead-each-spot-content <?php echo 'eead-align-'.$align; ?> <?php echo $settings['tooltip_position']; ?>" style="width: <?php echo $item['each_content_width']['size'].'px'; ?>">

            <?php if( $item['content_type'] == 'text_title_desc' ) { ?>

                <?php if( !empty( $item['hotspot_title']) ) { ?>
                    <h2><?php echo esc_html( $item['hotspot_title'] ); ?></h2>
                <?php } ?>

                <?php if( !empty($item['hotspot_subtitle']) ) { ?>
                    <p class="eead-spot-subtitle"><?php echo esc_html($item['hotspot_subtitle']); ?></p>
                <?php } ?>

                <?php if( !empty( $item['hotspot_description'] ) ) { ?>
                    <p class="eead-spot-description"><?php echo esc_html($item['hotspot_description']); ?></p>
                <?php } ?>

            <?php } else if( $item['content_type'] == 'wisiwyg' ) { 
                echo do_shortcode($item['wisiwyg_content']);
            } ?>
        </div>
        <?php
    }


}
