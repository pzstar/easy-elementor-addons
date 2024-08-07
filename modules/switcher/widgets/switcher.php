<?php

namespace EasyElementorAddons\Modules\Switcher\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Switcher extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-switcher';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Switcher', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-dual-button';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'switch_a',
            [
                'label' => esc_html__('Switch A', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'title_a',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Switch A', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'icon_a',
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
            'content_type_a',
            [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'wisiwyg',
                'options' => [
                    'elementor_template' => esc_html__('Elementor Template', 'easy-elementor-addons'),
                    'wisiwyg' => esc_html__('WISIWYG', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'elementor_template_a',
            [
                'label' => esc_html__('Select Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_elementor_templates(),
                'label_block' => 'true',
                'condition' => ['content_type_a' => 'elementor_template']
            ]
        );

        $this->add_control(
            'wisiwyg_content_a',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Type your description here', 'easy-elementor-addons'),
                'condition' => ['content_type_a' => 'wisiwyg']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'switch_b',
            [
                'label' => esc_html__('Switch B', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_b',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Switch B', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'icon_b',
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
            'content_type_b',
            [
                'label' => esc_html__('Content Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'wisiwyg',
                'options' => [
                    'elementor_template' => esc_html__('Elementor Template', 'easy-elementor-addons'),
                    'wisiwyg' => esc_html__('WISIWYG', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'elementor_template_b',
            [
                'label' => esc_html__('Select Template', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_elementor_templates(),
                'label_block' => 'true',
                'condition' => ['content_type_b' => 'elementor_template']
            ]
        );

        $this->add_control(
            'wisiwyg_content_b',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Type your description here', 'easy-elementor-addons'),
                'condition' => ['content_type_b' => 'wisiwyg']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons'),
                    'style4' => esc_html__('Style 4', 'easy-elementor-addons'),
                    'style5' => esc_html__('Style 5', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'active_switch',
            [
                'label' => esc_html__('Active Switch', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'switch_a',
                'options' => array(
                    'switch_a' => array(
                        'title' => esc_html__('Switch A', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'switch_b' => array(
                        'title' => esc_html__('Switch B', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ),
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'switch_custom_style',
            [
                'label' => esc_html__('Switch', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'switch_text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab h3',
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container.style1 .eead-switcher-tab-section' => 'border: 2px solid {{VALUE}}',
                    '{{WRAPPER}} .eead-switcher-container.style2 .eead-switch-tab,
                 {{WRAPPER}} .eead-switcher-container.style3 .eead-switch-tab' => 'border: 3px solid {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'switch_alignment',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'eead-align-center',
                'options' => array(
                    'eead-align-left' => array(
                        'title' => esc_html__('Switch A', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ),
                    'eead-align-center' => array(
                        'title' => esc_html__('Switch B', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ),
                    'eead-align-right' => array(
                        'title' => esc_html__('Switch B', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ),
                )
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
                    '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_margin_bottom',
            [
                'label' => esc_html__('Margin Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-tab-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'switch_tabs'
        );

        $this->start_controls_tab(
            'switch_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab:not(.active)' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_normal_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab:not(.active) h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_icon_normal_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab:not(.active) i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'switch_style_active_tab',
            [
                'label' => esc_html__('Active', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_active_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-tab-section .eead-switch-tab.active' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .eead-switcher-container.style3 .eead-switch-tab.active:before' => 'border-color: {{VALUE}} transparent transparent transparent'
                ],
            ]
        );

        $this->add_control(
            'switch_active_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switcher-tab-section .eead-switch-tab.active h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_icon_active_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switcher-tab-section .eead-switch-tab.active i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'switch_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'switch_hover_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container.style1 .eead-switcher-tab-section .eead-switch-tab:before,
                 {{WRAPPER}} .eead-switcher-container.style2 .eead-switch-tab:before,
                 {{WRAPPER}} .eead-switcher-container.style3 .eead-switch-tab:hover,
                 {{WRAPPER}} .eead-switcher-container.style4 .eead-switch-tab:hover,
                 {{WRAPPER}} .eead-switcher-container.style5 .eead-switch-tab:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_hover_normal_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switcher-tab-section .eead-switch-tab:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_icon_hover_normal_color',
            [
                'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switcher-tab-section .eead-switch-tab:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'switch_content_custom_style',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'switch_content_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-switcher-container .eead-switch-container',
            ]
        );

        $this->add_control(
            'switch_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switch-container' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_content_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switch-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'switch_content_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-switcher-container .eead-switch-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $active_switch = $settings['active_switch'];

        ?>
        <div class="eead-switcher-container <?php echo esc_attr($settings['switch_style']); ?>">
            <div class="eead-switcher-inner-wrap <?php echo esc_attr($settings['switch_alignment']); ?>">
                <div class="eead-switcher-tab-section">
                    <div class="eead-switch-a <?php echo $active_switch == 'switch_a' ? 'active' : '' ?> eead-switch-tab">
                        <?php if ($settings['icon_a']) {
                            \Elementor\Icons_Manager::render_icon($settings['icon_a'], ['aria-hidden' => 'true']);
                        } ?>
                        <h3><?php echo esc_html($settings['title_a']) ?></h3>
                    </div>

                    <div class="eead-switch-b <?php echo $active_switch == 'switch_b' ? 'active' : '' ?> eead-switch-tab">
                        <?php if ($settings['icon_b']) {
                            \Elementor\Icons_Manager::render_icon($settings['icon_b'], ['aria-hidden' => 'true']);
                        } ?>
                        <h3><?php echo esc_html($settings['title_b']) ?></h3>
                    </div>
                </div>

                <div class="eead-switch-container">
                    <div class="eead-switch-a-content eead-switch-content <?php echo $active_switch == 'switch_a' ? 'active' : '' ?>" style="<?php echo $active_switch == 'switch_a' ? 'display: block;' : 'display: none;'; ?>">
                        <?php
                        if ($settings['content_type_a'] == 'wisiwyg') {
                            echo $this->wisiwyg_text_parser($settings['wisiwyg_content_a']);
                        } else if ($settings['content_type_a'] == 'elementor_template') {
                            echo $this->elementor()->frontend->get_builder_content_for_display($settings['elementor_template_a']);
                        }
                        ?>
                    </div>

                    <div class="eead-switch-b-content eead-switch-content <?php echo $active_switch == 'switch_b' ? 'active' : '' ?>" style="<?php echo $active_switch == 'switch_b' ? 'display: block;' : 'display: none;'; ?>">
                        <?php
                        if ($settings['content_type_b'] == 'wisiwyg') {
                            echo $this->wisiwyg_text_parser($settings['wisiwyg_content_b']);
                        } else if ($settings['content_type_b'] == 'elementor_template') {
                            echo $this->elementor()->frontend->get_builder_content_for_display($settings['elementor_template_b']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // Elementor Saved Template 
    protected function get_elementor_templates() {

        $templates = $this->elementor()->templates_manager->get_source('local')->get_items();
        $types = [];

        if (empty($templates)) {
            $template_options = ['0' => esc_html__('Template Not Found!', 'easy-elementor-addons')];
        } else {
            $template_options = ['0' => esc_html__('Select Template', 'easy-elementor-addons')];
            foreach ($templates as $template) {
                $template_options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']] = $template['type'];
            }
        }

        return $template_options;
    }

    protected function elementor() {
        return Plugin::$instance;
    }

    protected function wisiwyg_text_parser($content) {
        $content = shortcode_unautop($content);
        $content = do_shortcode($content);
        $content = wptexturize($content);

        return $content;
    }

}