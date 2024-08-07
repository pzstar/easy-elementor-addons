<?php
namespace EasyElementorAddons\Modules\PopupModal\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class PopupModal extends Widget_Base {

	public function get_name() {
		return 'eead-popup-modal';
	}

	public function get_title() {
		return esc_html__('Popup Modal', 'easy-elementor-addons');
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return ['easy-elementor-addons'];
	}

	public function get_style_depends() {
		return ['micromodal', 'mcscrollbar'];
	}

	public function get_script_depends() {
		return ['micromodal', 'mcscrollbar'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'popup_title',
			[
				'label' => esc_html__('Enable Title', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
				'label_off' => esc_html__('No', 'easy-elementor-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => esc_html__('Modal Title', 'easy-elementor-addons'),
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'popup_type',
			[
				'label' => esc_html__('Type', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'image' => esc_html__('Image', 'easy-elementor-addons'),
					'content' => esc_html__('Content', 'easy-elementor-addons'),
					'template' => esc_html__('Saved Templates', 'easy-elementor-addons'),
					'custom-html' => esc_html__('Custom HTML', 'easy-elementor-addons'),
				],
				'default' => 'image',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'popup_type' => 'image',
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__('Content', 'easy-elementor-addons'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 'easy-elementor-addons'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'popup_type' => 'content',
				],
			]
		);

		$this->add_control(
			'templates',
			[
				'label' => esc_html__('Select Template', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => get_elementor_templates(),
				'label_block' => false,
				'condition' => [
					'popup_type' => 'template',
				],
			]
		);

		$this->add_control(
			'custom_html',
			[
				'label' => esc_html__('Custom HTML', 'easy-elementor-addons'),
				'type' => Controls_Manager::CODE,
				'language' => 'html',
				'condition' => [
					'popup_type' => 'custom-html',
				],
			]
		);

		$this->add_control(
			'close_button',
			[
				'label' => esc_html__('Show Close Button', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
				'label_off' => esc_html__('No', 'easy-elementor-addons'),
				'return_value' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__('Layout', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__('Layout', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'standard' => esc_html__('Standard', 'easy-elementor-addons'),
					// 'fullscreen' => esc_html__('Fullscreen', 'easy-elementor-addons'),
				],
				'default' => 'standard',
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'popup_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '550',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'width: {{SIZE}}{{UNIT}}; max-width: unset;',
				],
				'condition' => [
					'layout_type' => 'standard',
				],
			]
		);

		$this->add_responsive_control(
			'popup_height',
			[
				'label' => esc_html__('Height', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '550',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'height: {{SIZE}}{{UNIT}}; max-height: unset;',
				],
				'condition' => [
					'layout_type' => 'standard',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_trigger',
			[
				'label' => esc_html__('Trigger', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'trigger_type',
			[
				'label' => esc_html__('Type', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'button' => esc_html__('Button', 'easy-elementor-addons'),
					'icon' => esc_html__('Icon', 'easy-elementor-addons'),
					'image' => esc_html__('Image', 'easy-elementor-addons'),
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Click Here', 'easy-elementor-addons'),
				'condition' => [
					'trigger_type' => 'button',
				],
			]
		);

		$this->add_control(
			'select_button_icon',
			[
				'label' => esc_html__('Button Icon', 'easy-elementor-addons'),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'trigger_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after' => esc_html__('After', 'easy-elementor-addons'),
					'before' => esc_html__('Before', 'easy-elementor-addons'),
				],
				'condition' => [
					'trigger_type' => 'button',
				],
			]
		);

		$this->add_control(
			'select_trigger_icon',
			[
				'label' => esc_html__('Icon', 'easy-elementor-addons'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'trigger_icon',
				'condition' => [
					'trigger_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'trigger_image',
			[
				'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'trigger_type' => 'image',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_window_style',
			[
				'label' => esc_html__('Popup', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'popup_bg',
				'label' => esc_html__('Background', 'easy-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'popup_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
			]
		);

		$this->add_control(
			'popup_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'popup_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'popup_box_shadow',
				'selector' => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_overlay_style',
			[
				'label' => esc_html__('Overlay', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_switch',
			[
				'label' => esc_html__('Overlay', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Show', 'easy-elementor-addons'),
				'label_off' => esc_html__('Hide', 'easy-elementor-addons'),
				'return_value' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'label' => esc_html__('Background', 'easy-elementor-addons'),
				'types' => array('classic', 'gradient'),
				'exclude' => array('image'),
				'selector' => '{{WRAPPER}} .eead-popup-modal-overlay.modal__overlay',
				'condition' => [
					'overlay_switch' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'title_align',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'display:flex; justify-content: {{VALUE}};',
				],
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_bg',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-title.modal__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-popup-modal-title.modal__title',
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .eead-popup-modal-header.modal__header',
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'popup_title' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_content_style',
			[
				'label' => esc_html__('Content', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_type' => 'content',
				],
			]
		);

		$this->add_responsive_control(
			'content_align',
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
					'{{WRAPPER}} .eead-popup-modal-content.modal__content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'popup_type' => 'content',
				],
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label' => esc_html__('Text Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-content.modal__content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'popup_type' => 'content',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__('Typography', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-popup-modal-content.modal__content',
				'condition' => [
					'popup_type' => 'content',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_bar_style',
			[
				'label' => esc_html__('Scroll Bar', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'dragger_bar_color',
			[
				'label' => esc_html__('Dragger Bar Normal Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#444',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger_bar' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'dragger_bar_hover_color',
			[
				'label' => esc_html__('Dragger Bar Hover Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#444',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger:hover .mCSB_dragger_bar,
					 {{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__('Trigger Icon/Image', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'trigger_type!' => 'button',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-wrap' => 'display: flex;justify-content: {{VALUE}};',
				],
				'condition' => [
					'trigger_type' => ['icon', 'image'],
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-trigger-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-trigger-icon svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '28',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'trigger_type' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'icon_image_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-trigger-image' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'trigger_type' => 'image',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_button_style',
			[
				'label' => esc_html__('Trigger Button', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-wrap.wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => esc_html__('Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => esc_html__('Extra Small', 'easy-elementor-addons'),
					'sm' => esc_html__('Small', 'easy-elementor-addons'),
					'md' => esc_html__('Medium', 'easy-elementor-addons'),
					'lg' => esc_html__('Large', 'easy-elementor-addons'),
					'xl' => esc_html__('Extra Large', 'easy-elementor-addons'),
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'easy-elementor-addons'),
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_bg_color_normal',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color_normal',
			[
				'label' => esc_html__('Text Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-modal-popup-btn svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_normal',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_heading',
			[
				'label' => esc_html__('Button Icon', 'easy-elementor-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'trigger_type' => 'button',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn .eead-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition' => [
					'trigger_type' => 'button',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'easy-elementor-addons'),
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_animation',
			[
				'label' => esc_html__('Animation', 'easy-elementor-addons'),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .eead-modal-popup-btn:hover',
				'condition' => [
					'trigger_type' => 'button',
					'button_text!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_close_button_style',
			[
				'label' => esc_html__('Close Button', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_align',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-close-btn-wrap' => 'display: flex; justify-content: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'close_button_weight',
			[
				'label' => esc_html__('Weight', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__('Normal', 'easy-elementor-addons'),
					'bold' => esc_html__('Bold', 'easy-elementor-addons'),
				],
				'condition' => [
					'close_button' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span' => 'font-weight: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_size',
			[
				'label' => esc_html__('Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '28',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span ' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_close_button_style');

		$this->start_controls_tab(
			'tab_close_button_normal',
			[
				'label' => esc_html__('Normal', 'easy-elementor-addons'),
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'close_button_color_normal',
			[
				'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'close_button_bg',
				'label' => esc_html__('Background', 'easy-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .eead-popup-modal-close.modal__close',
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'close_button_border_normal',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .eead-popup-modal-close.modal__close',
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'close_button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'close_button_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'placeholder' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_close_button_hover',
			[
				'label' => esc_html__('Hover', 'easy-elementor-addons'),
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'close_button_color_hover',
			[
				'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'close_button_bg_hover',
				'label' => esc_html__('Background', 'easy-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .eead-popup-modal-close.modal__close:hover',
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'close_button_border_hover',
			[
				'label' => esc_html__('Border Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'close_button_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'close_button' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = esc_attr($this->get_id());

		// Modal Popup Window
		if ($settings['trigger_type'] == 'button') {

			$this->add_render_attribute('button', 'class', [
				'eead-popup-modal-trigger',
				'eead-modal-popup-btn',
				'eead-modal-popup-btn-' . esc_attr($id),
				'elementor-button',
				'elementor-size-' . esc_attr($settings['button_size']),
			]);

			$this->add_render_attribute('button', 'data-id', esc_attr($id));

			if ($settings['button_animation']) {
				$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['button_animation']);
			}
		}
		?>
		<div class="eead-popup-modal-wrap wrapper">

			<?php
			if ($settings['trigger_type'] == 'button') {

				printf('<span %1$s>', $this->get_render_attribute_string('button'));
				if ($settings['button_icon_position'] == 'before') {
					if (!empty($settings['select_button_icon'])) {
						?>
						<span class="eead-button-icon eead-icon">
							<?php Icons_Manager::render_icon($settings['select_button_icon'], array('aria-hidden' => 'true')); ?>
						</span>
						<?php
					}
				}

				if (!empty($settings['button_text'])) { ?>
					<span <?php echo $this->get_render_attribute_string('button_text'); ?>>
						<?php echo esc_attr($settings['button_text']); ?>
					</span>
					<?php
				}

				if ($settings['button_icon_position'] == 'after') {
					if (!empty($settings['select_button_icon'])) {
						?>
						<span class="eead-button-icon eead-icon">
							<?php Icons_Manager::render_icon($settings['select_button_icon'], ['aria-hidden' => 'true']); ?>
						</span>
						<?php
					}
				}
				echo '</span>';
			} else if ($settings['trigger_type'] == 'icon') {
				if (!empty($settings['select_trigger_icon'])) {
					?>
						<span class="eead-popup-modal-trigger eead-trigger-icon eead-icon eead-modal-popup-btn eead-modal-popup-btn-<?php echo esc_attr($id); ?>" data-id="<?php echo esc_attr($id); ?>">
						<?php Icons_Manager::render_icon($settings['select_trigger_icon'], array('aria-hidden' => 'true')); ?>
						</span>
					<?php
				}
			} else if ($settings['trigger_type'] == 'image') {
				if (!empty($settings['trigger_image']['url'])) { ?>
							<img class="eead-popup-modal-trigger eead-trigger-image eead-modal-popup-btn eead-modal-popup-btn-<?php echo esc_attr($id); ?>" data-id="<?php echo esc_attr($id); ?>" src="<?php echo esc_url($settings['trigger_image']['url']); ?>">
					<?php
				}
			}
			?>
		</div>

		<div class="eead-popup-modal modal micromodal-slide" id="eead-popup-modal-<?php echo esc_attr($id); ?>" aria-hidden="true">
			<div class="eead-popup-modal-overlay modal__overlay" tabindex="-1" data-micromodal-close>
				<div class="eead-popup-modal-container modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
					<?php if ($settings['close_button'] == 'yes') { ?>
						<div class="eead-popup-close-btn-wrap">
							<button class="eead-popup-modal-close modal__close" aria-label="Close modal" data-micromodal-close>
								<span class="icofont-close-line" data-micromodal-close></span>
							</button>
						</div>
					<?php } ?>

					<header class="eead-popup-modal-header modal__header">
						<?php if ($settings['popup_title'] == 'yes' && !empty($settings['title'])) { ?>
							<h2 class="eead-popup-modal-title modal__title" id="modal-1-title"><?php echo $settings['title']; ?></h2>
						<?php } ?>
					</header>

					<main class="eead-popup-modal-content modal__content" id="modal-1-content">
						<?php
						switch ($settings['popup_type']) {
							case 'image':
								echo '<img src="' . esc_url($settings['image']['url']) . '">';
								break;

							case 'content':
								global $wp_embed;
								$content = wpautop($wp_embed->autoembed($settings['content']));
								echo do_shortcode($content);
								break;

							case 'template':
								$template_id = $settings['templates'];
								echo !empty($template_id) ? \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id) : '';
								break;

							case 'custom-html':
								echo wp_kses_post($settings['custom_html']);
								break;

							default:
								echo '';
						}
						?>
					</main>
				</div>
			</div>
		</div>
		<?php
	}
}