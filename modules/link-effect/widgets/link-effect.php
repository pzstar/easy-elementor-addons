<?php

namespace EasyElementorAddons\Modules\LinkEffect\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class LinkEffect extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-link-effect';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Link Effect', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-editor-link';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_link_effects',
            [
                'label' => esc_html__('Link Effects', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('Click Here', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'secondary_text',
            [
                'label' => esc_html__('Secondary Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('Click Here', 'easy-elementor-addons'),
                'condition' => [
                    'effect' => 'effect-9',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => 'https://www.your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => esc_html__('Animation Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'effect-1' => esc_html__('Border Slide In', 'easy-elementor-addons'),
                    'effect-2' => esc_html__('Border Slide Out', 'easy-elementor-addons'),
                    'effect-3' => esc_html__('Brackets', 'easy-elementor-addons'),
                    'effect-4' => esc_html__('3D Cube', 'easy-elementor-addons'),
                    'effect-5' => esc_html__('Duplicate Text Slide In', 'easy-elementor-addons'),
                    'effect-6' => esc_html__('Right Angle Slides Down', 'easy-elementor-addons'),
                    'effect-7' => esc_html__('Second Border Slides Up', 'easy-elementor-addons'),
                    'effect-8' => esc_html__('Border Translate', 'easy-elementor-addons'),
                    'effect-9' => esc_html__('Second Text and Borders', 'easy-elementor-addons'),
                    'effect-10' => esc_html__('Duplicate Text Slide Right', 'easy-elementor-addons'),
                    'effect-11' => esc_html__('Text Fill', 'easy-elementor-addons'),
                    'effect-12' => esc_html__('Circle', 'easy-elementor-addons'),
                    'effect-13' => esc_html__('Three Dots', 'easy-elementor-addons'),
                    'effect-14' => esc_html__('Border Switch', 'easy-elementor-addons'),
                    'effect-15' => esc_html__('Scale Down', 'easy-elementor-addons'),
                    'effect-16' => esc_html__('Fall Down', 'easy-elementor-addons'),
                    'effect-17' => esc_html__('Move Up and Push Border', 'easy-elementor-addons'),
                    'effect-18' => esc_html__('Cross Text', 'easy-elementor-addons'),
                    'effect-19' => esc_html__('3D Cube Horizontal Side', 'easy-elementor-addons'),
                    'effect-20' => esc_html__('Flip Unfold', 'easy-elementor-addons'),
                    'effect-21' => esc_html__('Dual Borders Translate', 'easy-elementor-addons'),
                ],
                'default' => 'effect-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Link Effects', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} a.eead-link',
            ]
        );

        $this->add_responsive_control(
            'divider_title_width',
            [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 200,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-link-effect-19' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eead-link-effect-19 span' => 'transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2)',
                ],
                'condition' => [
                    'effect' => 'effect-19',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_link_style');

        $this->start_controls_tab(
            'tab_link_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'link_color_normal',
            [
                'label' => esc_html__('Link Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.eead-link, {{WRAPPER}} .eead-link-effect-10 span, {{WRAPPER}} .eead-link-effect-15:before, {{WRAPPER}} .eead-link-effect-16, {{WRAPPER}} .eead-link-effect-17:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_normal',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-link-effect-4 span, {{WRAPPER}} .eead-link-effect-10 span, {{WRAPPER}} .eead-link-effect-19 span, {{WRAPPER}} .eead-link-effect-20 span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-link-effect-8:before' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-11' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-1:after, {{WRAPPER}} .eead-link-effect-2:after, {{WRAPPER}} .eead-link-effect-6:before, {{WRAPPER}} .eead-link-effect-6:after, {{WRAPPER}} .eead-link-effect-7:before, {{WRAPPER}} .eead-link-effect-7:after, {{WRAPPER}} .eead-link-effect-14:before, {{WRAPPER}} .eead-link-effect-14:after, {{WRAPPER}} .eead-link-effect-18:before, {{WRAPPER}} .eead-link-effect-18:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-3:before, {{WRAPPER}} .eead-link-effect-3:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-20 span' => 'box-shadow: inset 0 3px {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_link_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label' => esc_html__('Link Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.eead-link:hover, {{WRAPPER}} .eead-link-effect-10:before, {{WRAPPER}} .eead-link-effect-11:before, {{WRAPPER}} .eead-link-effect-15, {{WRAPPER}} .eead-link-effect-16:before, {{WRAPPER}} .eead-link-effect-20 span:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-link-effect-4 span:before, {{WRAPPER}} .eead-link-effect-10:before, {{WRAPPER}} .eead-link-effect-19 span:before, {{WRAPPER}} .eead-link-effect-20 span:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-link-effect-8:after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-11:before' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-9:before, {{WRAPPER}} .eead-link-effect-9:after, {{WRAPPER}} .eead-link-effect-14:hover:before, {{WRAPPER}} .eead-link-effect-14:focus:before, {{WRAPPER}} .eead-link-effect-14:hover:after, {{WRAPPER}} .eead-link-effect-14:focus:after, {{WRAPPER}} .eead-link-effect-17:after, {{WRAPPER}} .eead-link-effect-18:hover:before, {{WRAPPER}} .eead-link-effect-18:focus:before, {{WRAPPER}} .eead-link-effect-18:hover:after, {{WRAPPER}} .eead-link-effect-18:focus:after, {{WRAPPER}} .eead-link-effect-21:before, {{WRAPPER}} .eead-link-effect-21:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-17' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-link-effect-13:hover:before, {{WRAPPER}} .eead-link-effect-13:focus:before' => 'color: {{VALUE}}; text-shadow: 10px 0 {{VALUE}}, -10px 0 {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $link = $settings['link']['url'] ? $settings['link']['url'] : '#';
        $link_text = !empty($settings['text']) ? $settings['text'] : '';
        $link_secondary_text = !empty($settings['secondary_text']) ? $settings['secondary_text'] : '';

        $effect_one = ['effect-4', 'effect-5', 'effect-19', 'effect-20'];
        $effect_two = ['effect-10', 'effect-11', 'effect-15', 'effect-16', 'effect-17', 'effect-18'];

        if (in_array($settings['effect'], $effect_one)) {
            $this->add_render_attribute('eead-link-text', 'data-hover', $link_text);
        } else if (in_array($settings['effect'], $effect_two)) {
            $this->add_render_attribute('eead-link-text-2', 'data-hover', $link_text);
        }
        ?>
        <a href="<?php echo esc_url($link); ?>" class="eead-link eead-link-<?php echo esc_attr($settings['effect']); ?>" <?php echo $this->get_render_attribute_string('eead-link-text-2'); ?>>
            <span <?php echo $this->get_render_attribute_string('eead-link-text'); ?>>
                <?php echo esc_html($link_text); ?>
            </span>

            <?php if ($settings['effect'] === 'effect-9') { ?>
                <span>
                    <?php echo esc_attr($link_secondary_text); ?>
                </span>
            <?php } ?>
        </a>
        <?php
    }
}