<?php

namespace EasyElementorAddons\Modules\LogoCarousel\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class LogoCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-logo-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Carousel', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-carousel';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return ['owlcarousel'];
    }

    public function get_script_depends() {
        return ['owlcarousel'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'title', [
            'label' => __('Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Title'
                ]
        );

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'easy-elementor-addons'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'logo_link', [
            'label' => __('Logo Link', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $this->add_control(
                'slides', [
            'label' => __('Slides', 'easy-elementor-addons'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->add_control(
                'link_new_tab', [
            'label' => __('Open Link in New Tab', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'layout', [
                'label' => __('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1', 'easy-elementor-addons'),
                    'style2' => __('Style 2', 'easy-elementor-addons'),
                    'style3' => __('Style 3', 'easy-elementor-addons')
                ],
            ]
        );

        $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'carousel_settings', [
            'label' => esc_html__('Carousel Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_responsive_control(
                'slides_to_show', [
            'label' => esc_html__('Slides To Show', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 1,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_responsive_control(
                'slides_margin', [
            'label' => esc_html__('Spacing Between Slides', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 20,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'infinite', [
            'label' => __('Infinite Loop', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => __('Autoplay', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'pause_on_hover', [
            'label' => __('Pause on Hover', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed (in Seconds)', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['s'],
            'range' => [
                's' => [
                    'min' => 1,
                    'max' => 15,
                    'step' => 1
                ],
            ],
            'default' => [
                'size' => 5,
                'unit' => 's',
            ],
            'condition' => [
                'autoplay' => 'yes',
            ],
                ]
        );

        $this->add_control(
                'speed', [
            'label' => __('Animation Speed', 'easy-elementor-addons'),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
                ]
        );

        $this->add_control(
                'dots', [
            'label' => __('Navigation Dots', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'arrows', [
            'label' => __('Navigation Arrows', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'auto_height', [
            'label' => __('Auto Height', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => '',
                ]
        );

        $this->add_control(
                'center_image_bigger', [
            'label' => __('Center Image Bigger', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => ['layout' => 'style3']
                ]
        );

        $this->add_responsive_control(
                'slides_stagepadding', [
            'label' => esc_html__('Stage Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 0,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
                'grayscale_enable', [
            'label' => __('Enable Grayscale', 'easy-elementor-addons'),
            'description' => __('All logo beside middle logo image will turn black and white.'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => ['layout' => 'style3']
        ]);

        $this->add_responsive_control(
                'middle_logo_scale', [
            'label' => esc_html__('Scale Middle Logo', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1.9,
                    'step' => .1
                ],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'transform: scale({{SIZE}}); -webkit-transform: scale({{SIZE}});'
            ],
            'condition' => ['layout' => 'style3']
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'image_style', [
            'label' => esc_html__('Image', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'logo_bg_color', [
                'label' => __('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_padding', [
                'label' => __('Logo Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_image_radius', [
                'label' => __('Image Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide img,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide img,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'outer_box_padding', [
                'label' => __('Outer Box Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style3' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;'
                ],
                'condition' => ['layout' => 'style3']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'border_style', [
            'label' => esc_html__('Border', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'logo_border_color', [
                'label' => __('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'logo_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_border_radius', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel.style1 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style2 .eead-logo-slide,
                     {{WRAPPER}} .eead-logo-carousel.style3 .owl-item.center' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'dot_style', [
            'label' => esc_html__('Naviagation Dot Style', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'dots_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot span' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dots_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dots_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
                'dot_tabs'
        );

        $this->start_controls_tab(
                'dot_style_normal_tab', [
            'label' => esc_html__('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot span' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_normal', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot span' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_active_tab', [
            'label' => esc_html__('Active', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color_active', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_active', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'dot_style_hover_tab', [
            'label' => esc_html__('Hover', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'dot_color_hover', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'dot_border_color_hover', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-dots .owl-dot:hover span' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /*Arrow Style*/
        $this->start_controls_section(
                'arrow_style', [
            'label' => esc_html__('Naviagation Arrow Style', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'arrow_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-logo-carousel .owl-nav button',
            ]
        );

        $this->add_control(
            'arrow_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-carousel .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;display: flex; align-items: center; justify-content: center;',
                ],
            ]
        );

        $this->start_controls_tabs(
                'arrow_tabs'
        );

        $this->start_controls_tab(
                'arrow_style_normal_tab', [
            'label' => esc_html__('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'arrow_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_border_color_normal', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'arrow_style_hover_tab', [
            'label' => esc_html__('Hover', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'arrow_bg_color_hover', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button:hover' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_color_hover', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button:hover' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'arrow_border_color_hover', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-logo-carousel .owl-nav button:hover' => 'border-color: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $target = $settings['link_new_tab'] ? '_blank' : '_self';
        $params = array(
            'items' => (int) $settings['slides_to_show']['size'],
            'items_tablet' => (int) isset($settings['slides_to_show_tablet']['size']) ? $settings['slides_to_show_tablet']['size'] : 2,
            'items_mobile' => (int) isset($settings['slides_to_show_mobile']['size']) ? $settings['slides_to_show_mobile']['size'] : 1,
            'margin' => (int) $settings['slides_margin']['size'],
            'margin_tablet' => (int) isset($settings['slides_margin_tablet']['size']) ? $settings['slides_margin_tablet']['size'] : 20,
            'margin_mobile' => (int) isset($settings['slides_margin_mobile']['size']) ? $settings['slides_margin_mobile']['size'] : 20,
            'autoplay' => $settings['autoplay'] && $settings['autoplay'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] && $settings['infinite'] == 'yes' ? true : false,
            'pause' => isset($settings['autoplay_speed']['size']) ? (int) $settings['autoplay_speed']['size'] * 1000 : 500,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false,
            'arrows' => $settings['arrows'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'auto_height' => $settings['auto_height'] == 'yes' ? true : false,
            'stagepadding' => (int) $settings['slides_stagepadding']['size'],
            'stagepadding_tablet' => (int) isset($settings['slides_stagepadding_tablet']['size']) ? $settings['slides_stagepadding_tablet']['size'] : 0,
            'stagepadding_mobile' => (int) isset($settings['slides_stagepadding_mobile']['size']) ? $settings['slides_stagepadding_mobile']['size'] : 0,
            'center_image_bigger' => $settings['center_image_bigger'] == 'yes' ? true : false,
        );
        $params = json_encode($params);

        if ($settings['layout'] == 'style3') {
            $grayscale_class = $settings['grayscale_enable'] == 'yes' ? ' eead-grayscale' : '';
        }
        ?>
        <div class="eead-logo-carousel owl-carousel <?php echo esc_attr($settings['layout']); ?><?php echo esc_attr($grayscale_class); ?>" data-params='<?php echo esc_attr($params); ?>'>
            <?php
            if ($settings['slides']) {
                foreach ($settings['slides'] as $item) {
                    $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                    if (!$image_url) {
                        $image_url = \Elementor\Utils::get_placeholder_image_src();
                    }
                    $image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';
                    echo '<div class="eead-logo-slide">';
                    if (!empty($item['logo_link'])) {
                        ?>
                        <a href="<?php echo esc_url($item['logo_link']); ?>" target="<?php echo esc_attr($target); ?>">
                            <?php echo $image_html; ?>
                        </a>
                        <?php
                    } else {
                        echo $image_html;
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
    }
}