<?php

namespace EasyElementorAddons\Modules\Counter\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Counter Widget
 */
class Counter extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-counter';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Counter', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-counter';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['waypoint', 'odometer'];
    }

    public function get_style_depends() {
        return ['odometer-theme-default'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'counter',
            [
                'label' => esc_html__('Counter', 'easy-elementor-addons'),
            ]
        );


        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Title', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'count',
            [
                'label' => esc_html__('Count Value (Number Only)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'starting_value',
            [
                'label' => esc_html__('Starting Value (Number Only)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
            ]
        );

        $this->add_control(
            'pre_text',
            [
                'label' => esc_html__('Pre Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'post_text',
            [
                'label' => esc_html__('Post Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'additional_settings',
            [
                'label' => esc_html__('Additional Settings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'counter_style',
            [
                'label' => esc_html__('Counter Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style2',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons'),
                    'style4' => esc_html__('Style 4', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Box Styles', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-counter' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4ec5ef',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .style1 .eead-counter, 
                 {{WRAPPER}} .eead-counter-section .style3 .eead-counter:before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .eead-counter-section .style1 .eead-counter:after, 
                 {{WRAPPER}} .eead-counter-section .style1 .eead-counter:before,
                 {{WRAPPER}} .eead-counter-section .style2 .eead-counter:before, 
                 {{WRAPPER}} .eead-counter-section .style2 .eead-counter:after, 
                 {{WRAPPER}} .eead-counter-section .style2 .eead-counter>span:before, 
                 {{WRAPPER}} .eead-counter-section .style2 .eead-counter>span:after' => 'background: {{VALUE}}'
                ],
                'condition' => [
                    'counter_style!' => 'style4'
                ]
            ]
        );

        $this->add_control(
            'box_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );



        $this->add_control(
            'icon_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .style2 .eead-counter-icon:after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'counter_style' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style_4_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .style4 .eead-counter-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'counter_style' => 'style4'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pre_text_style',
            [
                'label' => esc_html__('Pre Text', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pre_text_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-pre-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pre_text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-pre-text',
            ]
        );

        $this->add_control(
            'pre_text_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-pre-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'counter_number_style',
            [
                'label' => esc_html__('Number Count', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .odometer' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-counter-section .eead-counter-count .odometer',
            ]
        );

        $this->add_control(
            'counter_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .odometer' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_text_style',
            [
                'label' => esc_html__('Post Text', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_text_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-post-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-post-text',
            ]
        );

        $this->add_control(
            'post_text_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-count .eead-post-text' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'counter_title_style',
            [
                'label' => esc_html__('Counter Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-counter-section .eead-counter-title',
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-counter-section .eead-counter-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $counter_style = $settings['counter_style'];
        $counter_class = array(
            $counter_style,
            'eead-counter-wrap'
        );
        ?>

        <section class="eead-section eead-counter-section">
            <div class="eead-section-wrap">
                <div class="eead-container eead-counter-container">
                    <div class="eead-counter-content eead-section-content">
                        <div class="<?php echo esc_attr(implode(' ', $counter_class)); ?>">
                            <?php
                            $counter_title = $settings['title'];
                            $counter_count = $settings['count'];

                            if ($counter_count) {
                                if ($counter_style == 'style1' || $counter_style == 'style2') {
                                    ?>
                                    <div class="eead-counter">
                                        <div class="eead-counter-icon">
                                            <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                        </div>

                                        <div class="eead-counter-count">
                                            <span class="eead-pre-text">
                                                <?php echo esc_html($settings['pre_text']); ?>
                                            </span>

                                            <span class="odometer" data-count="<?php echo absint($counter_count); ?>">
                                                <?php echo esc_html($settings['starting_value']); ?>
                                            </span>

                                            <span class="eead-post-text">
                                                <?php echo esc_html($settings['post_text']); ?>
                                            </span>
                                        </div>

                                        <h5 class="eead-counter-title">
                                            <?php echo esc_html($counter_title); ?>
                                        </h5>
                                    </div>
                                    <?php

                                } elseif ($counter_style == 'style3') {
                                    ?>
                                    <div class="eead-counter">
                                        <div class="eead-counter-icon">
                                            <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                        </div>

                                        <div class="eead-counter-count">
                                            <span class="eead-pre-text">
                                                <?php echo esc_html($settings['pre_text']); ?>
                                            </span>

                                            <span class="odometer" data-count="<?php echo absint($counter_count); ?>">
                                                <?php echo esc_html($settings['starting_value']); ?>
                                            </span>

                                            <span class="eead-post-text">
                                                <?php echo esc_html($settings['post_text']); ?>
                                            </span>
                                        </div>

                                        <h5 class="eead-counter-title">
                                            <?php echo esc_html($counter_title); ?>
                                        </h5>
                                    </div>
                                    <?php

                                } elseif ($counter_style == 'style4') {
                                    ?>
                                    <div class="eead-counter">
                                        <div class="eead-counter-icon">
                                            <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                        </div>

                                        <div class="eead-counter-right-block">
                                            <div class="eead-counter-count">
                                                <span class="eead-pre-text">
                                                    <?php echo esc_html($settings['pre_text']); ?>
                                                </span>

                                                <span class="odometer" data-count="<?php echo absint($counter_count); ?>">
                                                    <?php echo esc_html($settings['starting_value']); ?>
                                                </span>

                                                <span class="eead-post-text">
                                                    <?php echo esc_html($settings['post_text']); ?>
                                                </span>
                                            </div>

                                            <h5 class="eead-counter-title">
                                                <?php echo esc_html($counter_title); ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}