<?php

namespace EasyElementorAddons\Modules\ThreesixtyImage\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class ThreesixtyImage extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-threesixty-image-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('360 Image', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-carousel';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'circlr', 'simple-magnify' ];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'threesixty_rotation_section', [
                'label' => __('Threesixty Rotation', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'images', [
                'label' => __('Gallery', 'easy-elementor-addons'),
                'type' => Controls_Manager::GALLERY,
                'default' => [
                    [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'auto_play', [
                'label' => __( 'Autoplay', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'autoplay'  => __( 'Autoplay', 'easy-elementor-addons' ),
                    'button'  => __( 'Button Play', 'easy-elementor-addons' ),
                    'none' => __( 'None', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'button_align', [
                'label' => __( 'Button Alignment', 'easy-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}}  .eead-threesixty-rotation-wrapper .eead-threesixty-rotation-autoplay-button' => 'text-align: {{VALUE}};',
                ],
                'style_transfer' => true,
                'condition' => [
                    'auto_play' => 'button'
                ]
            ]
        );

        $this->add_control(
            'magnify', [
                'label' => __('Magnify', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'easy-elementor-addons'),
                'label_off' => __('Off', 'easy-elementor-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'zoom', [
                'label' => __('Magnify Zoom', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'magnify' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'wrapper_align', [
                'label' => __( 'Alignment', 'easy-elementor-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'easy-elementor-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-threesixty-rotation .elementor-widget-container' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper' => 'display:inline-block;',
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'threesixty_rotation_wrapper_style', [
                'label' => __('Wrapper', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_width', [
                'label' => __( 'Width', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'wrapper_background',
                'label' => __('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'wrapper_border',
                'label' => __('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper',
            ]
        );

        $this->add_control(
            'wrapper_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'wrapper_box_shadow',
                'label' => __('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sticky_title_position_left', [
                'label' => __('Sticky Title Position Left', 'easy-elementor-addons'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'left',
                'selectors' => [
                    '(desktop){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'left: {{wrapper_padding.LEFT || 0}}{{wrapper_padding.UNIT}}; right:auto;',
                    '(tablet){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'left: {{wrapper_padding_tablet.LEFT}}{{wrapper_padding_tablet.UNIT}}; right:auto;',
                    '(mobile){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'left: {{wrapper_padding_mobile.LEFT}}{{wrapper_padding_mobile.UNIT}}; right:auto;',
                ],
                'condition' => [
                    'sticky_title!' => '',
                    'sticky_title_position' => 'left',
                ]
            ]
        );

        $this->add_control(
            'sticky_title_position_right', [
                'label' => __('Sticky Title Position Right', 'easy-elementor-addons'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'right',
                'selectors' => [
                    '(desktop){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'right: {{wrapper_padding.RIGHT || 0}}{{wrapper_padding.UNIT}}; left:auto;',
                    '(tablet){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'right: {{wrapper_padding_tablet.RIGHT}}{{wrapper_padding_tablet.UNIT}}; left:auto;',
                    '(mobile){{WRAPPER}}  .eead-threesixty-rotation-wrapper  span.eead-threesixty-rotation-sticky-title' => 'right: {{wrapper_padding_mobile.RIGHT}}{{wrapper_padding_mobile.UNIT}}; left:auto;',
                ],
                'condition' => [
                    'sticky_title!' => '',
                    'sticky_title_position' => 'right',
                ]
            ]
        );

        $this->end_controls_section();

        //Magnify Glass
        $this->start_controls_section(
            'threesixty_rotation_magnify_style', [
                'label' => __('Magnify', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'magnify' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'glass_icon_size', [
                'label' => __('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper  .eead-threesixty-rotation-magnify i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'glass_icon_color', [
                'label' => __('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper  .eead-threesixty-rotation-magnify i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'glass_width', [
                'label' => __( 'Width', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px',  ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper .eead-img-magnifier-glass' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'glass_border',
                'label' => __('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper .eead-img-magnifier-glass',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'glass_box_shadow',
                'label' => __('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper .eead-img-magnifier-glass',
            ]
        );

        $this->end_controls_section();

        //AutoPlay Button
        $this->start_controls_section(
            'threesixty_rotation_button_style', [
                'label' => __('AutoPlay Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'auto_play' => 'button',
                ]
            ]
        );

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            'button_normal_tab', [
                'label' => __('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'button_color', [
                'label' => __('Title Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper  button.eead-threesixty-rotation-play' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'button_background',
                'label' => __('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab', [
                'label' => __('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'button_hover_color', [
                'label' => __('Title Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper  button.eead-threesixty-rotation-play:hover, {{WRAPPER}} .eead-threesixty-rotation-wrapper  button.eead-threesixty-rotation-play:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'button_hover_background',
                'label' => __('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'button_border',
                'label' => __('Border', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play',
            ]
        );

        $this->add_control(
            'button_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'button_box_shadow',
                'label' => __('Box Shadow', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play',
            ]
        );

        $this->add_responsive_control(
            'button_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'button_space_top', [
                'label' => __( 'Space Top', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-threesixty-rotation-wrapper button.eead-threesixty-rotation-play' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['images'] ) ) { return; }

        $this->add_render_attribute('wrapper', 'class', 'eead-threesixty-rotation-wrapper');

        $this->add_render_attribute( 'rotation', [
                'class' => 'eead-threesixty-rotation-inner',
                'id' => 'eead-threesixty-rotation' . $this->get_id(),
                'data-selector' => 'eead-threesixty-rotation' . $this->get_id()
        ]);

        if( 'autoplay' === $settings['auto_play'] ){
            $this->add_render_attribute('rotation', 'data-autoplay', 'on');
        }

        if ( $settings['magnify'] === 'yes' ) {
            $this->add_render_attribute( 'magnify_glass', [
                'class' => 'eead-threesixty-rotation-magnify',
                'data-zoom' => esc_html($settings['zoom'])
            ]);
        }
        ?>

        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('rotation'); ?>>
                <?php if ($settings['magnify'] === 'yes') { ?>
                    <span <?php $this->print_render_attribute_string('magnify_glass'); ?>>
                        <i class="fa fa-search"></i>
                    </span>
                <?php } ?>

                <?php foreach ($settings['images'] as $item) { ?>
                    <img data-src="<?php echo esc_url($item['url']); ?>">
                <?php } ?>

                <div class="eead-threesixty-rotation-img" style='background-image:url("<?php echo EEAD_URL . 'assets/img/360_view.svg';?>")'></div>
            </div>

            <?php if ($settings['auto_play'] === 'autoplay') { ?>
                <button class="eead-threesixty-rotation-autoplay"></button>
            <?php } ?>

            <?php if ($settings['auto_play'] === 'button') { ?>
                <div class="eead-threesixty-rotation-autoplay-button">
                    <button class="eead-threesixty-rotation-play">
                        <i aria-hidden="true" class="fa fa-play"></i>
                    </button>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}
