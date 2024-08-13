<?php

namespace EasyElementorAddons\Modules\AdvancedHeading\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Advanced Heading Widget
 */
class AdvancedHeading extends Widget_Base {

	/** Widget Name */
	public function get_name() {
		return 'eead-advanced-heading';
	}

	/** Widget Title */
	public function get_title() {
		return esc_html__('Advanced Heading', 'easy-elementor-addons');
	}

	/** Icon */
	public function get_icon() {
		return 'eead-heading-text';
	}

	public function get_keywords() {
		return ['heading', 'title'];
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
			'section_content_heading',
			[
				'label' => esc_html__('Heading', 'easy-elementor-addons'),
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label' => esc_html__('Sub Heading', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__('Enter your prefix title', 'easy-elementor-addons'),
				'default' => esc_html__('SUB HEADING', 'easy-elementor-addons'),
				'label_block' => true
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label' => esc_html__('Main Heading', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__('Enter your main heading here', 'easy-elementor-addons'),
				'default' => esc_html__('Main Heading Text', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'split_main_heading',
			[
				'label' => esc_html__('Split Main Heading', 'easy-elementor-addons'),
				'separator' => 'before',
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'split_text',
			[
				'label' => esc_html__('Split Text', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'label_block' => true,
				'placeholder' => esc_html__('Enter your split text', 'easy-elementor-addons'),
				'default' => esc_html__('Split Text', 'easy-elementor-addons'),
				'condition' => [
					'split_main_heading' => 'yes'
				],

			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link', 'easy-elementor-addons'),
				'type' => Controls_Manager::URL,
				'dynamic' => ['active' => true],
				'placeholder' => 'http://your-link.com',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => esc_html__('HTML Tag', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => eead_html_tags(),
				'default' => 'h2',
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_advanced_heading',
			[
				'label' => esc_html__('Advanced Heading', 'easy-elementor-addons')
			]
		);

		$this->add_control(
			'advanced_heading_visibility',
			[
				'label' => esc_html__('Enable', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'advanced_heading',
			[
				'label' => esc_html__('Advanced Heading', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__('Enter your advanced heading', 'easy-elementor-addons'),
				'description' => esc_html__('This heading will show in the background.', 'easy-elementor-addons'),
				'default' => esc_html__('Background Text', 'easy-elementor-addons'),
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'advanced_heading_align',
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
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'advanced_heading_x_position',
			[
				'label' => esc_html__('X Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'advanced_heading_y_position',
			[
				'label' => esc_html__('Y Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'advanced_heading_enable_rotate',
			[
				'label' => esc_html__('Rotate', 'easy-elementor-addons'),
				'separator' => 'before',
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'advanced_heading_rotate',
			[
				'label' => esc_html__('Rotate', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position.SIZE}}px, {{advanced_heading_y_position.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position_tablet.SIZE}}px, {{advanced_heading_y_position_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div' => 'transform: translate({{advanced_heading_x_position_mobile.SIZE}}px, {{advanced_heading_y_position_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
				'condition' => [
					'advanced_heading_visibility' => 'yes',
					'advanced_heading_enable_rotate' => 'yes'
				]
			]
		);

		$this->add_control(
			'advanced_heading_origin',
			[
				'label' => esc_html__('Rotate Origin', 'easy-elementor-addons'),
				'description' => esc_html__('Please set the rotate value to make it work.', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => get_element_position(),
				'label_block' => true,
				'condition' => [
					'advanced_heading_visibility' => 'yes',
					'advanced_heading_enable_rotate' => 'yes'
				]
			]
		);

		$this->add_control(
			'advanced_heading_hide',
			[
				'label' => esc_html__('Hide On Devices', 'easy-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'tablet' => esc_html__('Tablet', 'easy-elementor-addons'),
					'mobile' => esc_html__('Mobile', 'easy-elementor-addons'),
				],
				'separator' => 'before',
				'condition' => [
					'advanced_heading_visibility' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_heading',
			[
				'label' => esc_html__('Sub Heading', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'sub_heading!' => '',
				]
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-sub-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-sub-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sub_heading_text_shadow',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-sub-heading',
			]
		);

		$this->add_control(
			'sub_heading_style',
			[
				'label' => esc_html__('Style', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('None', 'easy-elementor-addons'),
					'line' => esc_html__('Line', 'easy-elementor-addons'),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_heading_style_color',
			[
				'label' => esc_html__('Style Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-sub-heading .line:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'sub_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_style_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-sub-heading .line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'sub_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_style_height',
			[
				'label' => esc_html__('Height', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 48,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-sub-heading .line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'sub_heading_style' => 'line',
				],
			]
		);

		$this->add_control(
			'sub_heading_style_align',
			[
				'label' => esc_html__('Style Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right' => esc_html__('After', 'easy-elementor-addons'),
					'left' => esc_html__('Before', 'easy-elementor-addons'),
					'left-right' => esc_html__('After and Before', 'easy-elementor-addons'),
					'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
				],
				'condition' => [
					'sub_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'sub_heading_style_indent',
			[
				'label' => esc_html__('Style Spacing', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'sub_heading_style' => 'line',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eead-advanced-heading .eead-button-icon-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eead-advanced-heading .eead-button-icon-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main_heading',
			[
				'label' => esc_html__('Main Heading', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'main_heading!' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_style_main_heading');

		$this->start_controls_tab(
			'tab_main_text',
			[
				'label' => esc_html__('Heading', 'easy-elementor-addons')
			]
		);

		$this->add_control(
			'main_heading_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading > div' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'main_heading_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'main_heading_text_shadow',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-main-heading > div'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'main_heading_typography',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-main-heading > div',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_split_text',
			[
				'label' => esc_html__('Split Heading', 'easy-elementor-addons')
			]
		);

		$this->add_control(
			'heading_mainh_split_text',
			[
				'label' => esc_html__('Split Text', 'easy-elementor-addons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'split_main_heading' => 'yes',
					'split_text!' => ''
				]
			]
		);

		$this->add_control(
			'mainh_split_text_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .eead-mainh-split-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'split_main_heading' => 'yes',
					'split_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'split_text_space',
			[
				'label' => esc_html__('Split Space', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .eead-main-heading .eead-main-heading-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'split_main_heading' => 'yes'
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mainh_split_text_typography',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-main-heading .eead-mainh-split-text',
				'condition' => [
					'split_main_heading' => 'yes',
					'split_text!' => ''
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'main_heading_style',
			[
				'label' => esc_html__('Style', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('None', 'easy-elementor-addons'),
					'line' => esc_html__('Line', 'easy-elementor-addons'),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'main_heading_style_color',
			[
				'label' => esc_html__('Style Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .line:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'main_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_style_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .line:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'main_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_style_height',
			[
				'label' => esc_html__('Height', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 48,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .line:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'main_heading_style' => 'line',
				],
			]
		);

		$this->add_control(
			'main_heading_style_align',
			[
				'label' => esc_html__('Style Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'right' => esc_html__('After', 'easy-elementor-addons'),
					'left' => esc_html__('Before', 'easy-elementor-addons'),
					'left-right' => esc_html__('After and Before', 'easy-elementor-addons'),
					'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
				],
				'condition' => [
					'main_heading_style' => 'line',
				],
			]
		);

		$this->add_responsive_control(
			'main_heading_style_indent',
			[
				'label' => esc_html__('Style Spacing', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'main_heading_style' => 'line',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .eead-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .eead-button-icon-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eead-advanced-heading .eead-main-heading .eead-button-icon-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_advanced_heading',
			[
				'label' => esc_html__('Advanced Heading', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'advanced_heading!' => '',
					'advanced_heading_visibility' => 'yes',

				],
			]
		);

		$this->add_control(
			'advanced_heading_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div' => 'color: {{VALUE}};',
				],
				'condition' => [
					'advanced_heading_advanced_color!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'advanced_heading_typography',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'advanced_heading_shadow',
				'selector' => '{{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div',
			]
		);

		$this->add_control(
			'advanced_heading_opacity',
			[
				'label' => esc_html__('Opacity', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.05,
						'max' => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-advanced-heading .eead-advanced-heading-content > div' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/** Render Layout */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = $this->get_id();
		$main_heading = '';

		if (empty($settings['sub_heading']) && empty($settings['advanced_heading']) && empty($settings['main_heading'])) {
			return;
		}

		$this->add_render_attribute('heading', 'class', 'eead-heading-title');
		$this->add_render_attribute('main_heading', 'class', 'eead-main-heading-inner');
		$this->add_inline_editing_attributes('main_heading');
		$this->add_render_attribute('split_heading', 'class', 'eead-mainh-split-text');

		if ($settings['main_heading']) {
			$mainh_style = '';

			if ('line' === $settings['main_heading_style']) {
				if ('left-right' === $settings['main_heading_style_align']) {
					$mainh_style = '<div class="line eead-button-icon-align-left"></div><div class="line eead-button-icon-align-right"></div>';
				} elseif ('bottom' === $settings['main_heading_style_align']) {
					$mainh_style = '<div class="line eead-button-icon-align-' . esc_attr($settings['main_heading_style_align']) . '"></div>';
				} else {
					$mainh_style = '<div class="line eead-button-icon-align-' . esc_attr($settings['main_heading_style_align']) . '"></div>';
				}
			}

			$split_heading = '';
			if ($settings['split_main_heading'] == 'yes' && !empty($settings['split_text'])) {
				$split_heading = '<div ' . $this->get_render_attribute_string('split_heading') . '>' . $settings['split_text'] . '</div>';
			}

			$main_heading = '<div ' . $this->get_render_attribute_string('main_heading') . '>' . $settings['main_heading'] . '</div>';
			$main_heading = '<div class="eead-main-heading">' . $main_heading . $split_heading . $mainh_style . '</div>';
		}

		if (!empty($settings['link']['url'])) {
			$this->add_render_attribute('url', 'href', $settings['link']['url']);

			if ($settings['link']['is_external']) {
				$this->add_render_attribute('url', 'target', '_blank');
			}

			if (!empty($settings['link']['nofollow'])) {
				$this->add_render_attribute('url', 'rel', 'nofollow');
			}
		}
		?>
		<div id="<?php echo esc_attr($id); ?>" class="eead-advanced-heading">
			<?php
			echo $this->get_subheading();
			echo $this->get_advanced_heading();
			?>
			<<?php echo esc_attr($settings['header_size']); ?> 		<?php $this->print_render_attribute_string('heading') ?>>
				<?php
				if (!empty($settings['link']['url'])) {
					$main_heading = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $main_heading);
					echo wp_kses_post($main_heading);
				} else {
					echo wp_kses_post($main_heading);
				}
				?>
			</<?php echo esc_attr($settings['header_size']) ?>>
		</div>
		<?php
	}

	protected function get_subheading() {
		$settings = $this->get_settings_for_display();
		$sub_heading = '';
		if ($settings['sub_heading']) {
			$subh_style = '';
			if ('line' === $settings['sub_heading_style']) {
				if ('left-right' === $settings['sub_heading_style_align']) {
					$subh_style = '<div class="line eead-button-icon-align-left"></div><div class="line eead-button-icon-align-right"></div>';
				} else if ('bottom' === $settings['sub_heading_style_align']) {
					$subh_style = '<div class="line eead-button-icon-align-' . esc_attr($settings['sub_heading_style_align']) . '"></div>';
				} else {
					$subh_style = '<div class="line eead-button-icon-align-' . esc_attr($settings['sub_heading_style_align']) . '"></div>';
				}
			}

			$sub_heading = '<div class="eead-sub-heading"><div class="eead-sub-heading-content">' . esc_html($settings['sub_heading']) . '</div>' . $subh_style . '</div> ';
		}
		return $sub_heading;
	}

	protected function get_advanced_heading() {
		$settings = $this->get_settings_for_display();
		$advanced_heading = '';

		if ($settings['advanced_heading'] && $settings['advanced_heading_visibility'] == 'yes') {

			$this->add_render_attribute(
				[
					'adv-hclass' => [
						'class' => [
							'eead-advanced-heading-content',
							$settings['advanced_heading_hide'] ? 'eead-visible@' . $settings['advanced_heading_hide'] : '',
						],
					],
				]
			);

			$this->add_render_attribute(
				[
					'adv-hcclass' => [
						'class' => [
							$settings['advanced_heading_origin'] ? 'uk-transform-origin-' . $settings['advanced_heading_origin'] : '',
						],
					],
				]
			);

			$advanced_heading = '<div ' . $this->get_render_attribute_string('adv-hclass') . '><div ' . $this->get_render_attribute_string('adv-hcclass') . '>' . $settings['advanced_heading'] . '</div></div>';
		}
		return $advanced_heading;
	}
}
