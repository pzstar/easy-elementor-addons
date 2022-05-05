<?php

namespace EasyElementorAddons\Modules\DropBar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Drop Bar Widget
 */
class DropBar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-drop-bar-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Drop Bar', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_keywords() {
		return [ 'dropbar', 'dropdown', 'popup' ];
	}

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'uikit' ];
    }

    /** Controls */
    protected function register_controls() {

    	$this->start_controls_section(
			'section_content_dropbar', [
				'label' => esc_html__( 'Content', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'source', [
				'label'   => esc_html__( 'Select Source', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'    => esc_html__( 'Custom Content', 'easy-elementor-addons' ),
					"elementor" => esc_html__( 'Elementor Template', 'easy-elementor-addons' ),
					'anywhere'  => esc_html__( 'AE Template', 'easy-elementor-addons' ),
				],				
			]
		);

		$this->add_control(
			'content', [
				'label'       => esc_html__( 'Content', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Dropbar content goes here', 'easy-elementor-addons' ),
				'show_label'  => false,
				'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam', 'easy-elementor-addons' ),
				'condition'   => ['source' => 'custom'],
			]
		);

		$this->add_control(
			'template_id', [
				'label'       => __( 'Select Template', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => get_elementor_templates(),	
				'label_block' => 'true',
				'condition'   => ['source' => "elementor"],
			]
		);

		$this->add_control(
			'anywhere_id', [
				'label'       => esc_html__( 'Select Template', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => eead_anywhere_templates(),
				'label_block' => 'true',
				'condition'   => ['source' => 'anywhere'],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_button', [
				'label' => esc_html__( 'Button', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text', [
				'label'   => esc_html__( 'Text', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Open Dropbar', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_icon', [
				'label'       => esc_html__( 'Icon', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'button_icon_align', [
				'label'   => esc_html__( 'Icon Position', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => esc_html__( 'Before', 'easy-elementor-addons' ),
					'right' => esc_html__( 'After', 'easy-elementor-addons' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_indent', [
				'label'   => esc_html__( 'Icon Spacing', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-wrapper .eead-dropbar-button-icon.eead-flex-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eead-dropbar-wrapper .eead-dropbar-button-icon.eead-flex-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_position', [
				'label'   => esc_html__( 'Fixed Position', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => get_element_position(),
			]
		);

		$this->add_responsive_control(
			'btn_horizontal_offset', [
				'label' => __( 'Horizontal Offset', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -500,
						'step' => 1,
						'max'  => 1000,
					],
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'btn_vertical_offset', [
				'label' => __( 'Vertical Offset', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -500,
						'step' => 1,
						'max'  => 500,
					],
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_rotate', [
				'label'   => esc_html__( 'Rotate', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .eead-dropbar-button' => 'transform: translate({{btn_horizontal_offset.SIZE}}px, {{btn_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .eead-dropbar-button' => 'transform: translate({{btn_horizontal_offset_tablet.SIZE}}px, {{btn_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .eead-dropbar-button' => 'transform: translate({{btn_horizontal_offset_mobile.SIZE}}px, {{btn_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_option', [
				'label'     => esc_html__( 'Dropbar', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'drop_position', [
				'label'   => esc_html__( 'Position', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-left',
				'options' => eead_drop_position(),
			]
		);

		$this->add_control(
			'drop_mode', [
				'label'   => esc_html__( 'Mode', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [
					'click'    => esc_html__('Click', 'easy-elementor-addons'),
					'hover'  => esc_html__('Hover', 'easy-elementor-addons'),
				],
			]
		);

		$this->add_responsive_control(
			'drop_width', [
				'label' => esc_html__( 'Width', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-drop' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_offset', [
				'label'   => esc_html__( 'Dropbar Offset', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 5,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'animation_option', [
				'label'     => esc_html__( 'Animation', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'drop_animation', [
				'label'     => esc_html__( 'Animation', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => eead_transition_options()
			]
		);

		$this->add_control(
			'drop_duration', [
				'label'   => esc_html__( 'Animation Duration', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200,
				],
				'range' => [
					'px' => [
						'max' => 4000,
						'step' => 50,
					],
				],
				'condition' => [
					'drop_animation!' => '',
				],
			]
		);

		$this->add_control(
			'drop_show_delay', [
				'label'   => esc_html__( 'Show Delay', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 100,
					],
				],
			]
		);

		$this->add_control(
			'drop_hide_delay', [
				'label'   => esc_html__( 'Hide Delay', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'max' => 10000,
						'step' => 100,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button', [
				'label'     => esc_html__( 'Button', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'button_align', [
				'label'   => __( 'Alignment', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '',
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'easy-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'easy-elementor-addons' ),
						'icon' => ' eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'easy-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'easy-elementor-addons' ),
						'icon' => ' eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'condition'    => [
					'button_position' => '',
				],
			]
		);

		$this->add_control(
			'size', [
				'label'   => __( 'Size', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => eead_button_sizes(),
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal', [
				'label' => esc_html__( 'Normal', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_text_color', [
				'label'     => esc_html__( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color', [
				'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'        => 'button_border',
				'label'       => esc_html__( 'Border', 'easy-elementor-addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .eead-dropbar-button',
			]
		);

		$this->add_control(
			'button_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eead-dropbar-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding', [
				'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eead-dropbar-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .eead-dropbar-button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Typography', 'easy-elementor-addons' ),
				'selector' => '{{WRAPPER}} .eead-dropbar-button',
			]
		);

		$this->add_control(
			'dropbar_button_icon_color', [
				'label'     => esc_html__( 'Icon Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button .eead-dropbar-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eead-dropbar-button .eead-dropbar-button-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover', [
				'label' => esc_html__( 'Hover', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_hover_color', [
				'label'     => esc_html__( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color', [
				'label'     => esc_html__( 'Background Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color', [
				'label'     => esc_html__( 'Border Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation', [
				'label' => __( 'Hover Animation', 'easy-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'dropbar_button_hover_icon_color', [
				'label'     => esc_html__( 'Icon Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eead-dropbar-button:hover .eead-dropbar-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eead-dropbar-button:hover .eead-dropbar-button-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content', [
				'label'     => esc_html__( 'Content', 'easy-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_text_color', [
				'label'     => esc_html__( 'Text Color', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#eead-drop-{{ID}}.eead-drop .eead-drop-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_background', [
				'label'     => esc_html__( 'Background', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'#eead-drop-{{ID}}.eead-drop .eead-drop-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding', [
				'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#eead-drop-{{ID}}.eead-drop .eead-drop-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'#eead-drop-{{ID}}.eead-drop .eead-drop-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'content_box_shadow',
				'selector' => '#eead-drop-{{ID}}.eead-drop .eead-drop-content',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'content_box_text_typography',
				'label'    => esc_html__( 'Typography', 'easy-elementor-addons' ),
				'selector' => '{{WRAPPER}} #eead-drop-{{ID}}.eead-drop .eead-drop-content',
			]
		);

		$this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'eead-drop-' . $this->get_id();
		$btn_settings = wp_json_encode([
			"mode"       => $settings["drop_mode"],
			"pos"        => $settings["drop_position"],
			"delay-hide" => $settings["drop_hide_delay"]["size"],
			"delay-show" => $settings["drop_show_delay"]["size"],
			"offset"     => $settings["drop_offset"]["size"],
			"animation"  => $settings["drop_animation"] ? "uk-animation-" . $settings["drop_animation"] : false,
			"duration"   => ($settings["drop_duration"]["size"] && $settings["drop_animation"]) ? $settings["drop_duration"]["size"] : "0"
		]);

		$this->add_render_attribute([
				'drop-settings' => [
					'id'       => $id,
					'class'    => 'eead-drop uk-drop',
					'uk-drop' => [ $btn_settings ],
				],
			]
		);

		$this->add_render_attribute( 'dropbar-wrapper', 'class', 'eead-dropbar-wrapper' );

		if ($settings['button_position']) {
			$this->add_render_attribute( 'dropbar-wrapper', 'class', ['eead-position-fixed', 'eead-position-' . $settings['button_position']] );
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'dropbar-wrapper' ); ?>>
			<?php echo $this->get_text(); ?>

	        <div <?php echo $this->get_render_attribute_string( 'drop-settings' ); ?>>
	            <div class="eead-drop-content uk-card uk-card-body uk-card-default uk-text-left">
	                <?php 
	            	if ( $settings['source'] == "custom"  && !empty( $settings['content'] ) ) {
	            		echo wp_kses_post( $settings['content'] );
	            	} 
	            	else if ( $settings['source'] == "elementor"  && !empty( $settings['template_id'] )) {
	            		echo Plugin::$instance->frontend->get_builder_content_for_display( $settings['template_id'] );
	            		echo eead_template_edit_link( $settings['template_id'] );
	            	} 
	            	else if ( $settings['source'] == "anywhere"  && !empty( $settings['anywhere_id'] )) {
	            		echo Plugin::$instance->frontend->get_builder_content_for_display( $settings['anywhere_id'] );
	            		echo eead_template_edit_link( $settings['anywhere_id'] );
	            	}
		            ?>
	            </div>
	        </div>
        </div>
		<?php
    }

    protected function get_text() {
    	$settings = $this->get_settings_for_display();

		if ( $settings['button_icon_align'] == 'left' ||  $settings['button_icon_align'] == 'right' ) {
			$this->add_render_attribute( 'dropbar-button', 'class', 'eead-flex eead-flex-middle' );
		}

		$this->add_render_attribute([
			'icon-align' => [
				'class'    => [ 'eead-flex-align-' . $settings['button_icon_align'], 'eead-dropbar-button-icon', 'elementor-button-icon'  ]
			],
		]);

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			$settings['icon'] = 'fas fa-arrow-right';
		}

		$this->add_render_attribute( 'button', [
			'class' => 'eead-dropbar-button elementor-button',
			'href'  => 'javascript:void(0)'
		]);

		if ( !empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}
		?>
		<a <?php echo $this->get_render_attribute_string( 'button' ); ?> >
			<span class="elementor-button-content-wrapper">
				<span <?php echo $this->get_render_attribute_string( 'dropbar-button' ); ?>>

					<span class="elementor-button-text">
						<?php echo wp_kses( $settings['button_text'], eead_allow_tags('title') ); ?>
					</span>

					<?php if ( !empty( $settings['button_icon']['value'] ) ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>

						<?php 
						if ( isset( $settings['__fa4_migrated']['button_icon'] ) || (empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed()) ) {
							Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] );
						}
						else { ?>
							<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
						<?php } ?>

					</span>
					<?php } ?>

				</span>
			</span>
		</a>
		<?php
	}
}
