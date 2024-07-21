<?php
namespace EasyElementorAddons\Modules\StepFlow\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class StepFlow extends Widget_Base {

	public function get_name() {
		return 'eead-step-flow';
	}

	public function get_title() {
		return esc_html__('Step Flow', 'easy-elementor-addons');
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return ['easy-elementor-addons'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'step_flow_settings_section',
			[
				'label' => esc_html__('Step Flow', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'easy-elementor-addons'),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fa fa-star',
					'library' => 'fa-solid',
				]
			]
		);

		$this->add_control(
			'badge',
			[
				'label' => esc_html__('Badge', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Badge', 'easy-elementor-addons'),
				'description' => esc_html__('Leave it blank to hide the Badge', 'easy-elementor-addons'),
				'default' => esc_html__('Step 1', 'easy-elementor-addons'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Title', 'easy-elementor-addons'),
				'default' => esc_html__('Title', 'easy-elementor-addons'),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Description', 'easy-elementor-addons'),
				'default' => 'Lorem ipsum dolor, sit amet, consectetur adipisicing elit. Description repellendus dignissimos dolorum sint temporibus corporis!',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'easy-elementor-addons'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'readmore_link_text',
			[
				'label' => esc_html__('Readmore Link Text', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => esc_html__('Leave empty to hide Readmore Link', 'easy-elementor-addons'),
				'placeholder' => esc_html__('Readmore', 'easy-elementor-addons'),
				'default' => esc_html__('Readmore', 'easy-elementor-addons'),
				'dynamic' => [
					'active' => true,
				]
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
			'title_tag',
			[
				'label' => esc_html__('Title Tag', 'easy-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__('H1', 'easy-elementor-addons'),
					'h2' => esc_html__('H2', 'easy-elementor-addons'),
					'h3' => esc_html__('H3', 'easy-elementor-addons'),
					'h4' => esc_html__('H4', 'easy-elementor-addons'),
					'h5' => esc_html__('H5', 'easy-elementor-addons'),
					'h6' => esc_html__('H6', 'easy-elementor-addons'),
				],
			]
		);

		$this->add_control(
			'content_alignment',
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
						'title' => esc_html__('Justify', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'show_indicator',
			[
				'label' => esc_html__('Show Direction', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
				'label_off' => esc_html__('No', 'easy-elementor-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_icon_style',
			[
				'label' => esc_html__('Icon', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
					'em' => [
						'min' => 6,
						'max' => 300,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--eead-stepflow-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--eead-stepflow-icon-padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-steps-icon',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .eead-steps-icon',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-steps-icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_badge_style',
			[
				'label' => esc_html__('Badge', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-steps-label',
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_background_color',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-label' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .eead-steps-label',
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_title_style',
			[
				'label' => esc_html__('Title', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-steps-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_link_color',
			[
				'label' => esc_html__('Link Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'link[url]!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Hover Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'link[url]!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .eead-steps-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .eead-steps-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .eead-steps-title',
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
					'{{WRAPPER}} .eead-steps-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__('Description', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .eead-step-description',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .eead-step-description',
			]
		);

		$this->add_control(
			'description_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => 'vertical',
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .eead-step-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_direction_style',
			[
				'label' => esc_html__('Direction', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'direction_style',
			[
				'label' => esc_html__('Style', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__('Solid', 'easy-elementor-addons'),
					'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
					'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .eead-step-arrow, {{WRAPPER}} .eead-step-arrow:after' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .eead-step-arrow:after' => 'border-right-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-step-arrow' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_angle',
			[
				'label' => esc_html__('Angle', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--eead-stepflow-direction-angle: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'direction_offset_toggle',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__('None', 'easy-elementor-addons'),
				'label_on' => esc_html__('Custom', 'easy-elementor-addons'),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'direction_offset_y',
			[
				'label' => esc_html__('Offset Top', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .eead-step-arrow' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_offset_x',
			[
				'label' => esc_html__('Offset Left', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .eead-step-arrow' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}}' => '--eead-stepflow-direction-offset-x: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'direction_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-arrow' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .eead-step-arrow:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_style',
			[
				'label' => esc_html__('Read More', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'readmore_tabs'
		);

		$this->start_controls_tab(
			'readmore_tab_normal',
			[
				'label' => esc_html__('Normal', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'readmore_color_normal',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg_color_normal',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border_color_normal',
			[
				'label' => esc_html__('Border Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'border: 1px solid {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_tab_hover',
			[
				'label' => esc_html__('Hover', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg_color_hover',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore:hover' => 'border: 1px solid {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__('Typography', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-step-flow-readmore',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'readmore_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'readmore_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'readmore_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'allowed_dimensions' => 'vertical',
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .eead-step-flow-readmore' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('title', 'class', 'eead-steps-title');

		$this->add_inline_editing_attributes('description', 'advanced');
		$this->add_render_attribute('description', 'class', 'eead-step-description');

		$this->add_render_attribute('badge', 'class', 'eead-steps-label');
		$this->add_inline_editing_attributes('badge', 'none');

		if (!empty($settings['link']['url'])) {
			$this->add_link_attributes('link', $settings['link']);
			$this->add_inline_editing_attributes('link', 'basic', 'title');

			$title = sprintf(
				'<a %s>%s</a>',
				$this->get_render_attribute_string('link'),
				esc_html($settings['title'])
			);
		} else {
			$this->add_inline_editing_attributes('title', 'basic');
			$title = esc_html($settings['title']);
		}
		?>
		<div class="eead-setp-flow-wrapper" style="height: auto;">

			<div class="eead-steps-icon">
				<?php if ($settings['show_indicator'] === 'yes') {
					echo '<span class="eead-step-arrow"></span>';
				} ?>

				<?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) {
					Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
				} ?>

				<?php if ($settings['badge']) { ?>
					<span <?php $this->print_render_attribute_string('badge'); ?>>
						<?php echo esc_html($settings['badge']); ?>
					</span>
				<?php } ?>
			</div>

			<?php printf('<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string('title'), $title); ?>

			<?php if ($settings['description']) { ?>
				<p <?php $this->print_render_attribute_string('description'); ?>><?php echo wp_kses_post($settings['description']); ?></p>
			<?php } ?>

			<?php if (!empty($settings['readmore']) && !empty($settings['link']['url'])) { ?>
				<a href="<?php echo esc_url($settings['link']['url']); ?>" class="eead-step-flow-readmore"><?php echo esc_html($settings['readmore']); ?></a>
			<?php } ?>

		</div>
		<?php
	}
}
