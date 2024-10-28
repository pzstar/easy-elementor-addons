<?php

namespace EasyElementorAddons\Modules\Progressbar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Progressbar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-progressbar';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Progress Bar', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-progressbar';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['waypoint'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'progressbar',
            [
                'label' => esc_html__('Progress Bar', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'progressbar_title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'progressbar_percentage',
            [
                'label' => esc_html__('Percentage', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'size' => '90',
                    'unit' => 'px'
                ],
            ]
        );

        $this->add_control(
            'progressbar_block',
            [
                'label' => esc_html__('Add Progress Bars', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'progressbar_title' => esc_html__('Progress Bar #1', 'easy-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{ progressbar_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'progressbar_settings',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'progressbar_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons'),
                    'style4' => esc_html__('Style 4', 'easy-elementor-addons')
                ],
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label' => esc_html__('Title Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'left' => array(
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .eead-progress h4' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'progressbar_style' => ['style2', 'style3']
                ]
            ]
        );

        $this->add_control(
            'percentage_alignment',
            [
                'label' => esc_html__('Percentage Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'left' => array(
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .eead-progress .eead-progressbar-percentage' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'progressbar_style' => ['style2', 'style3']
                ]
            ]
        );

        $this->add_control(
            'label_position',
            [
                'label' => esc_html__('Label Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'above',
                'options' => [
                    'above' => esc_html__('Above Bar', 'easy-elementor-addons'),
                    'below' => esc_html__('Below Bar', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'progressbar_style' => ['style1', 'style3']
                ],
                'prefix_class' => 'eead-progressbar-label-'
            ]
        );

        $this->add_control(
            'reverse_position',
            [
                'label' => esc_html__('Reverse Title & Precentage Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'progressbar_style' => ['style2']
                ],
                'prefix_class' => 'eead-progressbar-alter-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-progress h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-progress h2',
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
                    '{{WRAPPER}} .eead-progress h2' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'percent_style',
            [
                'label' => esc_html__('Percent', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'percent_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-progressbar-length span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'percent_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-progressbar-length span',
            ]
        );

        $this->add_control(
            'percent_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'allowed_dimensions' => 'vertical',
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-progressbar-length span' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'progressbar_style_section',
            [
                'label' => esc_html__('Progress Bar', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'progressbar_bg_color',
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-progressbar',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'progress_indication_color',
                'label' => esc_html__('Progress Indication Color', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-progressbar-length',
            ]
        );

        $this->add_control(
            'progressbar_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
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
                    '{{WRAPPER}} .eead-progressbar-length,
                 {{WRAPPER}} .eead-progressbar' => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'progressbar_border_height',
            [
                'label' => esc_html__('Progress Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 20,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-progressbar' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $progressbars = $settings['progressbar_block'];
        ?>
        <div class="eead-progressbar-container eead-progressbar-<?php echo esc_attr($settings['progressbar_style']); ?>">
            <?php
            foreach ($progressbars as $progressbar) {
                $percentage = $progressbar['progressbar_percentage']['size'];
                ?>
                <div class="eead-progress">
                    <?php switch ($settings['progressbar_style']) {
                        case 'style1':
                            ?>
                            <div class="eead-progressbar-header">
                                <h4><?php echo esc_html($progressbar['progressbar_title']); ?></h4>
                                <div class="eead-progressbar-percentage"><?php echo absint($percentage) . "%"; ?></div>
                            </div>
                            <div class="eead-progressbar" data-width="<?php echo absint($percentage); ?>">
                                <div class="eead-progressbar-length"></div>
                            </div>
                            <?php
                            break;

                        case 'style2':
                            ?>
                            <h4><?php echo esc_html($progressbar['progressbar_title']); ?></h4>
                            <div class="eead-progressbar" data-width="<?php echo absint($percentage); ?>">
                                <div class="eead-progressbar-length"></div>
                            </div>
                            <div class="eead-progressbar-percentage"><?php echo absint($percentage) . "%"; ?></div>
                            <?php
                            break;

                        case 'style3':
                            ?>
                            <h4><?php echo esc_html($progressbar['progressbar_title']); ?></h4>
                            <div class="eead-progressbar" data-width="<?php echo absint($percentage); ?>">
                                <div class="eead-progressbar-length">
                                    <div class="eead-progressbar-percentage"><?php echo absint($percentage) . "%"; ?></div>
                                </div>
                            </div>
                            <?php
                            break;

                        case 'style4':
                            ?>
                            <h4><?php echo esc_html($progressbar['progressbar_title']); ?></h4>
                            <div class="eead-progressbar" data-width="<?php echo absint($percentage); ?>">
                                <div class="eead-progressbar-length">
                                    <div class="eead-progressbar-percentage"><?php echo absint($percentage) . "%"; ?></div>
                                </div>
                            </div>
                            <?php
                            break;
                    } ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}
