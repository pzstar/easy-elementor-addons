<?php
namespace EasyElementorAddons\Modules\PopupModal\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PopupModal extends Widget_Base {

	public function get_name() {
		return 'eead-popup-modal-block';
	}

	public function get_title() {
		return esc_html__( 'Popup Modal', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

 	public function get_style_depends() {
		return [ 'micromodal','mcscrollbar' ];
	}

	public function get_script_depends() {
		return [ 'micromodal','mcscrollbar' ];
	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'easy-elementor-addons' ),
			)
		);

		$this->add_control(
			'popup_title',
			array(
				'label'        => __( 'Enable Title', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'easy-elementor-addons' ),
				'label_off'    => __( 'No', 'easy-elementor-addons' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => __( 'Title', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'Modal Title', 'easy-elementor-addons' ),
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_control(
			'popup_type',
			array(
				'label'   => __( 'Type', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'image'       => __( 'Image', 'easy-elementor-addons' ),
					'content'     => __( 'Content', 'easy-elementor-addons' ),
					'template'    => __( 'Saved Templates', 'easy-elementor-addons' ),
					'custom-html' => __( 'Custom HTML', 'easy-elementor-addons' ),
				),
				'default' => 'image',
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Choose Image', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'popup_type' => 'image',
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'     => __( 'Content', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 'easy-elementor-addons' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'popup_type' => 'content',
				),
			)
		);

		$this->add_control(
            'templates',
            [
                'label'       => __( 'Select Template', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => get_elementor_templates(),
                'label_block' => false,
                'condition'   => [
					'popup_type' => 'template',
				],
            ]
        );

		$this->add_control(
			'custom_html',
			array(
				'label'     => __( 'Custom HTML', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CODE,
				'language'  => 'html',
				'condition' => array(
					'popup_type' => 'custom-html',
				),
			)
		);

		$this->add_control(
			'close_button',
			array(
				'label'              => __( 'Show Close Button', 'easy-elementor-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'label_on'           => __( 'Yes', 'easy-elementor-addons' ),
				'label_off'          => __( 'No', 'easy-elementor-addons' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Layout', 'easy-elementor-addons' ),
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'              => __( 'Layout', 'easy-elementor-addons' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'standard'   => __( 'Standard', 'easy-elementor-addons' ),
					// 'fullscreen' => __( 'Fullscreen', 'easy-elementor-addons' ),
				),
				'default'            => 'standard',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'popup_width',
			array(
				'label'      => __( 'Width', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => '550',
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1920,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'width: {{SIZE}}{{UNIT}}; max-width: unset;',
				),
				'condition'  => array(
					'layout_type' => 'standard',
				),
			)
		);

		$this->add_responsive_control(
			'popup_height',
			array(
				'label'      => __( 'Height', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => '550',
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1920,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'height: {{SIZE}}{{UNIT}}; max-height: unset;',
				),
				'condition'  => array(
					'layout_type' => 'standard',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_trigger',
			array(
				'label' => __( 'Trigger', 'easy-elementor-addons' ),
			)
		);

		$this->add_control(
			'trigger_type',
			array(
				'label'     => __( 'Type', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'button' => __( 'Button', 'easy-elementor-addons' ),
					'icon'   => __( 'Icon', 'easy-elementor-addons' ),
					'image'  => __( 'Image', 'easy-elementor-addons' ),
				)
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Click Here', 'easy-elementor-addons' ),
				'condition' => array(
					'trigger_type' => 'button',
				),
			)
		);

		$this->add_control(
			'select_button_icon',
			array(
				'label'            => __( 'Button Icon', 'easy-elementor-addons' ),
				'type'             => Controls_Manager::ICONS,
				'condition'        => array(
					'trigger_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_icon_position',
			array(
				'label'     => __( 'Icon Position', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => __( 'After', 'easy-elementor-addons' ),
					'before' => __( 'Before', 'easy-elementor-addons' ),
				),
				'condition' => array(
					'trigger_type' => 'button',
				),
			)
		);

		$this->add_control(
			'select_trigger_icon',
			array(
				'label'            => __( 'Icon', 'easy-elementor-addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'trigger_icon',
				'condition'        => array(
					'trigger_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'trigger_image',
			array(
				'label'     => __( 'Choose Image', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'trigger_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_window_style',
			array(
				'label' => __( 'Popup', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'popup_bg',
				'label'    => __( 'Background', 'easy-elementor-addons' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'popup_border',
				'label'       => __( 'Border', 'easy-elementor-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
			)
		);

		$this->add_control(
			'popup_border_radius',
			array(
				'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'popup_padding',
			array(
				'label'      => __( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-container.modal__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'popup_box_shadow',
				'selector'  => '{{WRAPPER}} .eead-popup-modal-container.modal__container',
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_overlay_style',
			array(
				'label' => __( 'Overlay', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_switch',
			array(
				'label'              => __( 'Overlay', 'easy-elementor-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'label_on'           => __( 'Show', 'easy-elementor-addons' ),
				'label_off'          => __( 'Hide', 'easy-elementor-addons' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'overlay_bg',
				'label'     => __( 'Background', 'easy-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .eead-popup-modal-overlay.modal__overlay',
				'condition' => array(
					'overlay_switch' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label'     => __( 'Title', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'title_align',
			array(
				'label'     => __( 'Alignment', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start'   => array(
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'  => array(
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'display:flex; justify-content: {{VALUE}};',
				),
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_bg',
			array(
				'label'     => __( 'Background Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-title.modal__title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'easy-elementor-addons' ),
				'selector'  => '{{WRAPPER}} .eead-popup-modal-title.modal__title',
				'condition' => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'title_border',
				'label'       => __( 'Border', 'easy-elementor-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eead-popup-modal-header.modal__header',
				'condition'   => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-header.modal__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'popup_title' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_popup_content_style',
			array(
				'label'     => __( 'Content', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'popup_type' => 'content',
				),
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => __( 'Alignment', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-content.modal__content'   => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'popup_type' => 'content',
				),
			)
		);

		$this->add_control(
			'content_text_color',
			array(
				'label'     => __( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-content.modal__content' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'popup_type' => 'content',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_typography',
				'label'     => __( 'Typography', 'easy-elementor-addons' ),
				'selector'  => '{{WRAPPER}} .eead-popup-modal-content.modal__content',
				'condition' => array(
					'popup_type' => 'content',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_bar_style',
			array(
				'label'     => __( 'Scroll Bar', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE
			)
		);

		$this->add_control(
			'dragger_bar_color',
			array(
				'label'     => __( 'Dragger Bar Normal Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger_bar' => 'background-color: {{VALUE}}',
				)
			)
		);

		$this->add_control(
			'dragger_bar_hover_color',
			array(
				'label'     => __( 'Dragger Bar Hover Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#444',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger:hover .mCSB_dragger_bar,
					 {{WRAPPER}} .eead-popup-modal-container.mCustomScrollbar .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar' => 'background-color: {{VALUE}}',
				)
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Trigger Icon/Image', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'trigger_type!' => 'button',
				),
			)
		);

		$this->add_responsive_control(
			'icon_align',
			array(
				'label'     => __( 'Alignment', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
					'flex-start'   => array(
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'  => array(
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-wrap'   => 'display: flex;justify-content: {{VALUE}};',
				),
				'condition' => array(
					'trigger_type' => array( 'icon', 'image' ),
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-trigger-icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-trigger-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Size', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => '28',
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 80,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'trigger_type' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'icon_image_width',
			array(
				'label'      => __( 'Width', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 1200,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-trigger-image' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'trigger_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_modal_button_style',
			array(
				'label'     => __( 'Trigger Button', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_align',
			array(
				'label'     => __( 'Alignment', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-wrap.wrapper'   => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'     => __( 'Size', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => array(
					'xs' => __( 'Extra Small', 'easy-elementor-addons' ),
					'sm' => __( 'Small', 'easy-elementor-addons' ),
					'md' => __( 'Medium', 'easy-elementor-addons' ),
					'lg' => __( 'Large', 'easy-elementor-addons' ),
					'xl' => __( 'Extra Large', 'easy-elementor-addons' ),
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => __( 'Normal', 'easy-elementor-addons' ),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-modal-popup-btn' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-modal-popup-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-modal-popup-btn svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border_normal',
				'label'       => __( 'Border', 'easy-elementor-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition'   => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-modal-popup-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'easy-elementor-addons' ),
				'selector'  => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-modal-popup-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .eead-modal-popup-btn',
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_icon_heading',
			array(
				'label'     => __( 'Button Icon', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'trigger_type' => 'button',
				),
			)
		);

		$this->add_responsive_control(
			'button_icon_margin',
			array(
				'label'       => __( 'Margin', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .eead-modal-popup-btn .eead-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				),
				'condition'   => array(
					'trigger_type' => 'button',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'easy-elementor-addons' ),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-modal-popup-btn:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_animation',
			array(
				'label'     => __( 'Animation', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .eead-modal-popup-btn:hover',
				'condition' => array(
					'trigger_type' => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_close_button_style',
			array(
				'label'     => __( 'Close Button', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'close_button_align',
			array(
				'label'     => __( 'Alignment', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start'    => array(
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'flex-end',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-close-btn-wrap'   => 'display: flex; justify-content: {{VALUE}};',
				)
			)
		);

		$this->add_control(
			'close_button_weight',
			array(
				'label'     => __( 'Weight', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => array(
					'normal' => __( 'Normal', 'easy-elementor-addons' ),
					'bold'   => __( 'Bold', 'easy-elementor-addons' ),
				),
				'condition' => array(
					'close_button' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span' => 'font-weight: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'close_button_size',
			array(
				'label'      => __( 'Size', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => '28',
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 80,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span ' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_close_button_style' );

		$this->start_controls_tab(
			'tab_close_button_normal',
			array(
				'label'     => __( 'Normal', 'easy-elementor-addons' ),
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'close_button_color_normal',
			array(
				'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close span' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'close_button_bg',
				'label'     => __( 'Background', 'easy-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .eead-popup-modal-close.modal__close',
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'close_button_border_normal',
				'label'       => __( 'Border', 'easy-elementor-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eead-popup-modal-close.modal__close',
				'condition'   => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'close_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'close_button_margin',
			array(
				'label'       => __( 'Margin', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				),
				'condition'   => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'close_button_padding',
			array(
				'label'       => __( 'Padding', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				),
				'condition'   => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_close_button_hover',
			array(
				'label'     => __( 'Hover', 'easy-elementor-addons' ),
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'close_button_color_hover',
			array(
				'label'     => __( 'Icon Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover span' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'close_button_bg_hover',
				'label'     => __( 'Background', 'easy-elementor-addons' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .eead-popup-modal-close.modal__close:hover',
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'close_button_border_hover',
			array(
				'label'     => __( 'Border Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'close_button_border_radius_hover',
			array(
				'label'      => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-popup-modal-close.modal__close:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'close_button' => 'yes',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();	
		$id = esc_attr($this->get_id());
		
		// Modal Popup Window
		if ( $settings['trigger_type'] == 'button' ) {

			$this->add_render_attribute( 'button', 'class', [
					'eead-popup-modal-trigger',
					'eead-modal-popup-btn',
					'eead-modal-popup-btn-' . $id,
					'elementor-button',
					'elementor-size-' . $settings['button_size'],
			]);

			$this->add_render_attribute('button', 'data-id', $id);

			if ( $settings['button_animation'] ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_animation'] );
			}
		}
		?>
		<div class="eead-popup-modal-wrap wrapper">
			
			<?php  
			if ( $settings['trigger_type'] == 'button' ) {
				
				printf( '<span %1$s>', $this->get_render_attribute_string( 'button' ) );
				if ( $settings['button_icon_position'] == 'before' ) {
					if ( !empty($settings['select_button_icon']) ) {
						?>
						<span class="eead-button-icon eead-icon">
							<?php Icons_Manager::render_icon( $settings['select_button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
						<?php
					}
				}

				if ( !empty( $settings['button_text'] ) ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
						<?php echo esc_attr( $settings['button_text'] ); ?>
					</span>
					<?php
				}

				if ( $settings['button_icon_position'] == 'after' ) {
					if ( !empty($settings['select_button_icon']) ) {
						?>
						<span class="eead-button-icon eead-icon">
							<?php Icons_Manager::render_icon( $settings['select_button_icon'], ['aria-hidden' => 'true'] ); ?>
						</span>
						<?php
					}
				}
				echo '</span>';
			} 
			else if ( $settings['trigger_type'] == 'icon' ) {
				if ( !empty($settings['select_trigger_icon']) ) {
					?>
						<span class="eead-popup-modal-trigger eead-trigger-icon eead-icon eead-modal-popup-btn eead-modal-popup-btn-<?php echo $id; ?>" data-id="<?php echo esc_attr($id); ?>">
							<?php Icons_Manager::render_icon( $settings['select_trigger_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
					<?php
				}
			} 
			else if ( $settings['trigger_type'] == 'image' ) {
				if ( !empty( $settings[ 'trigger_image' ]['url'] ) ) { ?>
					<img class="eead-popup-modal-trigger eead-trigger-image eead-modal-popup-btn eead-modal-popup-btn-<?php echo $id; ?>" data-id="<?php echo esc_attr($id); ?>" src="<?php echo esc_url( $settings[ 'trigger_image' ]['url'] ); ?>">
				<?php
				}
			}
			?>
		</div>


	    <div class="eead-popup-modal modal micromodal-slide" id="eead-popup-modal-<?php echo esc_attr($id); ?>" aria-hidden="true">
	      <div class="eead-popup-modal-overlay modal__overlay" tabindex="-1" data-micromodal-close>
	        <div class="eead-popup-modal-container modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
	          
	          	<?php if($settings['close_button'] == 'yes') { ?>
	          		<div class="eead-popup-close-btn-wrap">
						<button class="eead-popup-modal-close modal__close" aria-label="Close modal" data-micromodal-close><span class="icofont-close-line" data-micromodal-close></span></button>
					</div>
				<?php } ?>

				<header class="eead-popup-modal-header modal__header">
					<?php if ( $settings['popup_title'] == 'yes' && !empty($settings['title']) ) { ?>
					    <h2 class="eead-popup-modal-title modal__title" id="modal-1-title"> <?php echo $settings['title']; ?></h2>
					<?php } ?>
					
				</header>

				<main class="eead-popup-modal-content modal__content" id="modal-1-content">
					<?php
					switch ( $settings['popup_type'] ) {
						case 'image':
							echo '<img src="' . esc_url($settings['image']['url']) . '">';
						break;

						case 'content':
							global $wp_embed;
							$content = wpautop( $wp_embed->autoembed( $settings['content'] ) ); 
							echo do_shortcode( $content ); 
						break;

						case 'template':
							$template_id = $settings['templates']; 
							echo !empty($template_id) ? \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id) : ''; 
						break;

						case 'custom-html':
							echo $settings['custom_html'];
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
