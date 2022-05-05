<?php

namespace EasyElementorAddons\Modules\CircularProgressbar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class CircularProgressbar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-circular-progressbar-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Circular Progressbar', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-counter-circle';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'waypoint' ];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Circular Progressbar', 'easy-elementor-addons' ),
            ]
        );

       $this->add_control(
            'progressbar_title', [
                'label' => __( 'Title', 'easy-elementor-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Progress', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'progressbar_percentage',
            [
                'label' => __( 'Percentage', 'easy-elementor-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 90,
            ]
        );

        $this->add_responsive_control(
                'box_height', [
            'label' => __('Box Height', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 200,
                    'max' => 700,
                    'step' => 1,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
                'unit' => 'px',
                'size' => 350,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 350,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 350,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-circular-progressbar-box' => 'height: {{SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-circular-progressbar-box' => 'height: {{SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-circular-progressbar-box' => 'height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
                'box_style', [
            'label' => esc_html__('Box', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'box_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box' => 'background: {{VALUE}}',
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
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box h2.text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-circular-progressbar-box h2.text',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box h2.text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
                'percent_style', [
            'label' => esc_html__('Percent', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'percent_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box .percent .number h2' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'percent_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-circular-progressbar-box .percent .number h2',
                ]
        );

        $this->end_controls_section();   

        $this->start_controls_section(
                'progressbar_style', [
            'label' => esc_html__('Progress Bar', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'progressbar_text_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box .percent svg circle:nth-child(1)' => 'stroke: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'progress_indication_color', [
            'label' => esc_html__('Progress Indication Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-circular-progressbar-box .percent svg circle:nth-child(2)' => 'stroke: {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section(); 
        
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="eead-circular-progressbar" data-number='<?php echo esc_attr($settings['progressbar_percentage']); ?>'>
                <div class="eead-circular-progressbar-box">
                    <div class="percent">
                        <svg>
                            <circle cx="70" cy="70" r="70"></circle>
                            <circle cx="70" cy="70" r="70"></circle>
                        </svg>
                        <div class="number">
                            <h2>
                                <?php echo esc_html($settings['progressbar_percentage']); ?>
                                <span>%</span>
                            </h2>
                        </div>
                    </div>
                    <h2 class="text">
                        <?php echo esc_html($settings['progressbar_title']) ?>
                    </h2>
                </div>  
        </div>
        <?php
    }

}
