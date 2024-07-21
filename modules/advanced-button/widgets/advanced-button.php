<?php

namespace EasyElementorAddons\Modules\AdvancedButton\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Advanced Button Widget
 */
class AdvancedButton extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-advanced-button';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Advanced Button', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-button';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('Click me', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Click me', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('https://your-link.com', 'easy-elementor-addons'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => esc_html__('Button Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => esc_html__('Extra Small', 'easy-elementor-addons'),
                    'sm' => esc_html__('Small', 'easy-elementor-addons'),
                    'md' => esc_html__('Medium', 'easy-elementor-addons'),
                    'lg' => esc_html__('Large', 'easy-elementor-addons'),
                    'xl' => esc_html__('Extra Large', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'add_custom_attributes',
            [
                'label' => esc_html__('Add Custom Attributes', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'custom_attributes',
            [
                'label' => esc_html__('Custom Attributes', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('key|value', 'easy-elementor-addons'),
                'description' => sprintf(esc_html__('Set custom attributes for the button tag. Separate each attribute in a separate line. Separate attribute key from the value using %s character. eg. style|color:red', 'easy-elementor-addons'), '<code>|</code>'),
                'classes' => 'elementor-control-direction-ltr',
                'condition' => ['add_custom_attributes' => 'yes']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                    'top' => esc_html__('Top', 'easy-elementor-addons'),
                    'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_indent',
            [
                'label' => esc_html__('Icon Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button .eead-flex-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ep-button .eead-flex-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ep-button .eead-flex-align-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-ep-button .eead-flex-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_animation',
            [
                'label' => esc_html__('Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'b',
                'options' => [
                    'a' => esc_html__('Animation A', 'easy-elementor-addons'),
                    'b' => esc_html__('Animation B', 'easy-elementor-addons'),
                    'c' => esc_html__('Animation C', 'easy-elementor-addons'),
                    'd' => esc_html__('Animation D', 'easy-elementor-addons'),
                    'e' => esc_html__('Animation E', 'easy-elementor-addons'),
                    'f' => esc_html__('Animation F', 'easy-elementor-addons'),
                    'g' => esc_html__('Animation G', 'easy-elementor-addons'),
                    'h' => esc_html__('Animation H', 'easy-elementor-addons'),
                    'i' => esc_html__('Animation I', 'easy-elementor-addons'),
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
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
                ],
            ]
        );

        $this->start_controls_tabs('tabs_advanced_button_style');

        $this->start_controls_tab(
            'tab_advanced_button_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'advanced_button_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-ep-button,
                    {{WRAPPER}} .eead-ep-button.eead-ep-button-effect-i .eead-ep-button-content-wrapper:after,
                    {{WRAPPER}} .eead-ep-button.eead-ep-button-effect-i .eead-ep-button-content-wrapper:before,
                    {{WRAPPER}} .eead-ep-button.eead-ep-button-effect-h:hover',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'button_border_style',
            [
                'label' => esc_html__('Border Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'solid' => esc_html__('Solid', 'easy-elementor-addons'),
                    'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
                    'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
                    'groove' => esc_html__('Groove', 'easy-elementor-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_width',
            [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 3,
                    'right' => 3,
                    'bottom' => 3,
                    'left' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_border_style!' => 'none'
                ]
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_border_style!' => 'none'
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'advanced_button_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'advanced_button_shadow',
                'selector' => '{{WRAPPER}} .eead-ep-button',
            ]
        );

        $this->add_responsive_control(
            'advanced_button_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'advanced_button_typography',
                'selector' => '{{WRAPPER}} .eead-ep-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_advanced_button_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'advanced_button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-ep-button:after, 
                    {{WRAPPER}} .eead-ep-button:hover,
                    {{WRAPPER}} .eead-ep-button.eead-ep-button-effect-i,
                    {{WRAPPER}} .eead-ep-button.eead-ep-button-effect-h:after',
            ]
        );

        $this->add_control(
            'button_hover_border_style',
            [
                'label' => esc_html__('Border Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'solid' => esc_html__('Solid', 'easy-elementor-addons'),
                    'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
                    'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
                    'groove' => esc_html__('Groove', 'easy-elementor-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover' => 'border-style: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_hover_border_width',
            [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 3,
                    'right' => 3,
                    'bottom' => 3,
                    'left' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_hover_border_style!' => 'none'
                ]
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_border_style!' => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'advanced_button_hover_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'advanced_button_hover_shadow',
                'selector' => '{{WRAPPER}} .eead-ep-button:hover',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_advanced_button_icon_style');

        $this->start_controls_tab(
            'tab_advanced_button_icon_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'advanced_button_icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'advanced_button_icon_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'advanced_button_icon_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner',
            ]
        );

        $this->add_control(
            'advanced_button_icon_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'advanced_button_icon_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'advanced_button_icon_shadow',
                'selector' => '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner',
            ]
        );

        $this->add_responsive_control(
            'advanced_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button .eead-ep-button-icon .eead-ep-button-icon-inner' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_advanced_button_icon_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'advanced_button_hover_icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover .eead-ep-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-ep-button:hover .eead-ep-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'advanced_button_icon_hover_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-ep-button:hover .eead-ep-button-icon .eead-ep-button-icon-inner',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_style!' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-ep-button:hover .eead-ep-button-icon .eead-ep-button-icon-inner' => 'border-color: {{VALUE}};',
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
        $this->add_render_attribute('wrapper', 'class', 'eead-ep-button-wrapper');

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('advanced_button', 'href', $settings['link']['url']);

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('advanced_button', 'target', '_blank');
            }

            if ($settings['link']['nofollow']) {
                $this->add_render_attribute('advanced_button', 'rel', 'nofollow');
            }
        }

        if ($settings['link']['nofollow']) {
            $this->add_render_attribute('advanced_button', 'rel', 'nofollow');
        }

        if ($settings['add_custom_attributes'] and !empty($settings['custom_attributes'])) {
            $attributes = explode("\n", $settings['custom_attributes']);
            $reserved_attr = ['href', 'target'];

            foreach ($attributes as $attribute) {
                if (!empty($attribute)) {
                    $attr = explode('|', $attribute, 2);
                    if (!isset($attr[1])) {
                        $attr[1] = '';
                    }

                    if (!in_array(strtolower($attr[0]), $reserved_attr)) {
                        $this->add_render_attribute('advanced_button', trim($attr[0]), trim($attr[1]));
                    }
                }
            }
        }

        $this->add_render_attribute('advanced_button', 'class', 'eead-ep-button');
        $this->add_render_attribute('advanced_button', 'class', 'eead-ep-button-effect-' . esc_attr($settings['button_animation']));
        $this->add_render_attribute('advanced_button', 'class', 'eead-ep-button-size-' . esc_attr($settings['button_size']));

        if ($settings['hover_animation']) {
            $this->add_render_attribute('advanced_button', 'class', 'elementor-animation-' . $settings['hover_animation']);
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <a <?php echo $this->get_render_attribute_string('advanced_button'); ?>>
                <?php $this->render_text(); ?>
            </a>
        </div>
        <?php
    }

    public function render_text() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('content-wrapper', 'class', 'eead-ep-button-content-wrapper');

        if ('left' == $settings['icon_align'] or 'right' == $settings['icon_align']) {
            $this->add_render_attribute('content-wrapper', 'class', 'eead-flex eead-flex-middle');
        }

        $this->add_render_attribute('content-wrapper', 'class', ('top' == $settings['icon_align']) ? 'eead-flex eead-flex-column' : '');
        $this->add_render_attribute('content-wrapper', 'class', ('bottom' == $settings['icon_align']) ? 'eead-flex eead-flex-column-reverse' : '');
        $this->add_render_attribute('content-wrapper', 'data-text', esc_attr($settings['text']));
        $this->add_render_attribute('icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align']);
        $this->add_render_attribute('icon-align', 'class', 'eead-ep-button-icon');
        $this->add_render_attribute('text', 'class', 'eead-ep-button-text');
        $this->add_inline_editing_attributes('text', 'none');

        $migrated = isset($settings['__fa4_migrated']['button_icon']);
        $is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        ?>
        <div <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
            <?php
            if (!empty($settings['button_icon']['value'])) {
                ?>
                <div class="eead-ep-button-icon eead-flex-center eead-flex-align-<?php echo esc_attr($settings['icon_align']); ?>">
                    <div class="eead-ep-button-icon-inner">
                        <?php
                        if ($is_new || $migrated) {
                            Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']);
                        } else {
                            ?>
                            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <div <?php $this->print_render_attribute_string('text'); ?>>
                <span class="avdbtn-text">
                    <?php echo esc_html($settings['text']); ?>
                </span>

                <?php
                if ('g' == $settings['button_animation']) {
                    ?>
                    <span class="avdbtn-alt-text">
                        <?php echo esc_html($settings['text']); ?>
                    </span>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}