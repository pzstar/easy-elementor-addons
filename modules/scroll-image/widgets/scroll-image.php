<?php
namespace EasyElementorAddons\Modules\ScrollImage\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class ScrollImage extends Widget_Base {

	public function get_name() {
		return 'eead-scroll-image';
	}

	public function get_title() {
		return esc_html__('Scroll Image', 'easy-elementor-addons');
	}

	public function get_icon() {
		return 'eead-scroll-image';
	}

	public function get_categories() {
		return ['easy-elementor-addons'];
	}

	public function get_style_depends() {
		return ['lightgallery'];
	}

	public function get_script_depends() {
		return ['lightgallery'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__('Image', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size',
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_framing',
			[
				'label' => esc_html__('Add Device Frame', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'frame',
			[
				'label' => esc_html__('Select Frame', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'imac-light',
				'options' => [
					'imac-dark' => esc_html__('Imac Dark', 'easy-elementor-addons'),
					'imac-light' => esc_html__('Imac Light', 'easy-elementor-addons'),
					'imac-red' => esc_html__('Imac Red', 'easy-elementor-addons'),
					'imac-blue' => esc_html__('Imac Blue', 'easy-elementor-addons'),
					'imac-green' => esc_html__('Imac Green', 'easy-elementor-addons'),
					'imac-yellow' => esc_html__('Imac Yellow', 'easy-elementor-addons'),
					'macbook-pro' => esc_html__('Macbook Pro', 'easy-elementor-addons'),
					'macbook-air' => esc_html__('Macbook Air', 'easy-elementor-addons'),
					'ipad-pro-v' => esc_html__('Ipad Pro (Vertical)', 'easy-elementor-addons'),
					'ipad-pro-h' => esc_html__('Ipad Pro (Horizontal)', 'easy-elementor-addons'),
					'iphone-gold' => esc_html__('Iphone Gold', 'easy-elementor-addons'),
					'iphone-black' => esc_html__('Iphone Black', 'easy-elementor-addons'),
					'iphonex' => esc_html__('Iphone X', 'easy-elementor-addons'),
					'safari' => esc_html__('Safari', 'easy-elementor-addons'),
					'chrome' => esc_html__('Chrome', 'easy-elementor-addons'),
					'chrome-dark' => esc_html__('Chrome Dark', 'easy-elementor-addons'),
					'firefox' => esc_html__('Firefox', 'easy-elementor-addons'),
					'edge' => esc_html__('Edge', 'easy-elementor-addons'),
					'edge-dark' => esc_html__('Edge Dark', 'easy-elementor-addons'),
				],
				'condition' => [
					'image_framing' => 'yes'
				]
			]
		);

		$this->add_control(
			'image_scroll_option',
			[
				'label' => esc_html__('Select Image Scroll', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'top-bottom',
				'options' => [
					'bottom-top' => esc_html__('Bottom To Top', 'easy-elementor-addons'),
					'top-bottom' => esc_html__('Top To Bottom', 'easy-elementor-addons'),
					'left-right' => esc_html__('Left To Right', 'easy-elementor-addons'),
					'right-left' => esc_html__('Right To Left', 'easy-elementor-addons'),
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => esc_html__('Caption', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Enter your image caption', 'easy-elementor-addons'),
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label' => esc_html__('Max Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-wrapper' => 'flex-basis: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label' => esc_html__('Height', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
				],
				'default' => [
					'size' => 320,
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-frame' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'horizontal_align',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .eead-scroll-image-container' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_image',
			[
				'label' => esc_html__('Link', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__('Link To', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'lightbox',
				'options' => [
					'' => esc_html__('None', 'easy-elementor-addons'),
					'lightbox' => esc_html__('Lightbox', 'easy-elementor-addons'),
					'modal' => esc_html__('Modal', 'easy-elementor-addons'),
					'external' => esc_html__('External', 'easy-elementor-addons'),
				],
			]
		);

		$this->add_control(
			'external_link',
			[
				'label' => esc_html__('External Link', 'easy-elementor-addons'),
				'type' => Controls_Manager::URL,
				'show_external' => false,
				'placeholder' => esc_html__('https://your-link.com', 'easy-elementor-addons'),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'link_to' => ['external', 'modal'],
				],
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label' => esc_html__('Link Icon', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'fas fa-link' => [
						'title' => esc_html__('Link', 'easy-elementor-addons'),
						'icon' => 'fas fa-link',
					],
					'fas fa-plus' => [
						'title' => esc_html__('Plus', 'easy-elementor-addons'),
						'icon' => 'fas fa-plus',
					],
					'fas fa-search' => [
						'title' => esc_html__('Zoom', 'easy-elementor-addons'),
						'icon' => 'fas fa-search',
					],
				],
				'default' => 'fa fa-search',
				'toggle' => false,
				'condition' => [
					'link_to!' => '',
				],
			]
		);

		$this->add_control(
			'link_hover_visibility',
			[
				'label' => esc_html__('Show On Hover Only', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'condition' => [
					'link_to!' => '',
				],
				'separator' => 'after'
			]
		);

		$this->add_responsive_control(
			'link_h_position',
			[
				'label' => esc_html__('Horizontal Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
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
				'default' => 'center',
				'toggle' => false,
				'selectors_dictionary' => [
					'center' => 'left:50%;',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => '{{VALUE}};--eead-scroll-image-link-h:-50%;'
				],
				'condition' => [
					'link_to!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'link_offset_left',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'left:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'link_h_position' => 'left',
					'link_to!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'link_offset_right',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'right:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'link_h_position' => 'right',
					'link_to!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'link_v_position',
			[
				'label' => esc_html__('Vertical Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'easy-elementor-addons'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__('Middle', 'easy-elementor-addons'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'easy-elementor-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'middle',
				'toggle' => false,
				'selectors_dictionary' => [
					'middle' => 'top:50%;',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => '{{VALUE}};--eead-scroll-image-link-v:-50%;',
				],
				'condition' => [
					'link_to!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'link_offset_top',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'top:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'link_v_position' => 'top',
					'link_to!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'link_offset_bottom',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'bottom:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'link_v_position' => 'bottom',
					'link_to!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_badge',
			[
				'label' => esc_html__('Badge', 'easy-elementor-addons'),
			]
		);

		$this->add_control(
			'badge',
			[
				'label' => esc_html__('Badge', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label' => esc_html__('Badge Text', 'easy-elementor-addons'),
				'type' => Controls_Manager::TEXT,
				'default' => 'POPULAR',
				'label_block' => true,
				'condition' => [
					'badge' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'badge_h_position',
			[
				'label' => esc_html__('Horizontal Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'position:absolute',
				],
				'condition' => [
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_offset_left',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'left:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'badge_h_position' => 'left',
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_offset_right',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'right:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'badge_h_position' => 'right',
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_v_position',
			[
				'label' => esc_html__('Vertical Position', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'easy-elementor-addons'),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'easy-elementor-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'position:absolute',
				],
				'condition' => [
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_offset_top',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'top:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'badge_v_position' => 'top',
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_offset_bottom',
			[
				'label' => esc_html__('Offset', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 0,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'bottom:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'badge_v_position' => 'bottom',
					'badge' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_rotate',
			[
				'label' => esc_html__('Rotate', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
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
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'transform:rotate({{SIZE}}deg)',
				],
				'condition' => [
					'badge' => 'yes'
				]
			]
		);

		$this->add_control(
			'badge_origin',
			[
				'label' => esc_html__('Rotate Origin', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => get_element_position(),
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'transform-origin:{{VALUE}}',
				],
				'condition' => [
					'badge' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_box_style',
			[
				'label' => esc_html__('Image Box', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_framing' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-frame',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_box_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-frame',
			]
		);

		$this->add_control(
			'image_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-frame' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'caption_style',
			[
				'label' => esc_html__('Caption', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_alignment',
			[
				'label' => esc_html__('Alignment', 'easy-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'left' => array(
						'title' => esc_html__('Left', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__('Center', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__('Right', 'easy-elementor-addons'),
						'icon' => 'eicon-text-align-right',
					),
				),
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-caption' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'label' => esc_html__('Typography', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-caption',
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-caption' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'caption_margin',
			[
				'label' => esc_html__('Margin', 'easy-elementor-addons'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'link_style',
			[
				'label' => esc_html__('Link', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'link_to!' => ''
				],
			]
		);

		$this->add_control(
			'link_size',
			[
				'label' => esc_html__('Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'size' => 40,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'height:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'link_icon_size',
			[
				'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'default' => [
					'size' => 14,
					'unit' => 'px'
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'font-size:{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'link_bg_color',
			[
				'label' => esc_html__('Background Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => esc_html__('Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'link_border',
				'label' => esc_html__('Border', 'easy-elementor-addons'),
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'link_shadow',
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link',
			]
		);

		$this->add_control(
			'link_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'badge_style',
			[
				'label' => esc_html__('Badge', 'easy-elementor-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'badge!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'badge_background',
				'fields_options' => [
					'background_type' => 'classic',
					'color' => [
						'default' => '#FF0000',
					],
				],
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge',
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => esc_html__('Text Color', 'easy-elementor-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge',
			]
		);

		$this->add_control(
			'badge_dimension',
			[
				'label' => esc_html__('Fixed Height & Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'badge_height',
			[
				'label' => esc_html__('Height', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'height:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'badge_dimension' => 'yes'
				]
			]
		);

		$this->add_control(
			'badge_width',
			[
				'label' => esc_html__('Width', 'easy-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'width:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'badge_dimension' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => esc_html__('Padding', 'easy-elementor-addons'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_image() {
		$settings = $this->get_settings_for_display();

		$image_url = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image_size', $settings);

		if (!$image_url) {
			$image_url = $settings['image']['url'];
		}

		$frame = $settings['frame'];

		$this->add_render_attribute('image', 'class', 'eead-scroll-image');

		$this->add_render_attribute('image', 'style', 'background-image: url(' . esc_url($image_url) . ');');

		$this->add_render_attribute('image-box', [
			'class' => [
				'eead-scroll-image-box',
				'eead-scroll-image-' . $settings['image_scroll_option']
			]
		]
		);

		if ($settings['image_framing']) {
			echo '<img class="eead-scroll-image-device" src="' . EEAD_ASSETS_URL . 'img/devices/' . esc_attr($frame) . '.svg">';

		}

		echo '<div ' . $this->get_render_attribute_string('image-box') . '>';
		?>
		<div <?php echo $this->get_render_attribute_string('image'); ?>></div>

		<?php if ($settings['badge'] && $settings['badge_text'] != '') { ?>
			<span class="eead-scroll-image-badge">
				<?php echo esc_html($settings['badge_text']); ?>
			</span>
		<?php }

		$this->render_link();

		echo '</div>';
	}

	protected function render_link() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('link', [
			'class' => [
				'eead-scroll-image-link',
			]
		]);

		if ($settings['link_to'] == 'lightbox') {
			$this->add_render_attribute('link', [
				'href' => esc_url($settings['image']['url']),
				'data-elementor-open-lightbox' => 'no',
				'class' => [
					'eead-scroll-image-lightbox',
				]
			]);
		} elseif ($settings['link_to'] === 'modal') {
			$this->add_render_attribute('link', [
				'href' => esc_url($settings['external_link']['url']),
				'class' => 'eead-scroll-image-modal',
				'data-iframe' => 'true',
				'data-src' => esc_url($settings['external_link']['url'])
			]);
		} else {
			if (!empty($settings['external_link']['url'])) {
				$this->add_link_attributes('link', $settings['external_link']);
			}
		}

		if (($settings['link_to'] !== '') && ($settings['link_icon'] !== '')) { ?>
			<a target="_blank" <?php echo $this->get_render_attribute_string('link'); ?>>
				<i class="<?php echo esc_attr($settings['link_icon']); ?>" aria-hidden="true"></i>
			</a>
		<?php }
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('wrapper', 'class', 'eead-scroll-image-frame');

		if ($settings['link_hover_visibility']) {
			$this->add_render_attribute('wrapper', 'class', 'eead-scroll-image-hide-link');
		}

		if ($settings['image_framing']) {
			$this->add_render_attribute('wrapper', 'class', 'eead-scroll-image-frame-on eead-scroll-image-frame-' . esc_attr($settings['frame']));
		}

		?>
		<div class="eead-scroll-image-container">
			<div class="eead-scroll-image-wrapper">
				<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
					<?php $this->render_image(); ?>
				</div>

				<?php if (!empty($settings['caption'])) { ?>
					<div class="eead-scroll-image-caption">
						<?php echo esc_attr($settings['caption']); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
