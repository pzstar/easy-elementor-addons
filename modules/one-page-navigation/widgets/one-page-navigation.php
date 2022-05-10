<?php
namespace EasyElementorAddons\Modules\OnePageNavigation\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class OnePageNavigation extends Widget_Base {

	public function get_name() {
		return 'eead-one-page-nav';
	}

	public function get_title() {
		return esc_html__( 'One Page Navigation', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-navigation-vertical';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'section_nav_dots',
			[
				'label'                 => __( 'Navigation Dots', 'easy-elementor-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'select_dot_icon',
			[
				'label'                 => __( 'Navigation Dot', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'dot_icon',
				'default'               => [
					'value'     => 'fa fa-circle',
					'library'   => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'section_title',
			[
				'label'                 => __( 'Section Title', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __( 'Section Title', 'easy-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'section_id',
			[
				'label'                 => __( 'Section ID', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::TEXT,
				'default'               => '',
			]
		);

		$this->add_control(
			'nav_dots',
			[
				'label'                 => '',
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'section_title'   => __( 'Section 1', 'easy-elementor-addons' ),
						'section_id'      => 'section-1',
						'select_dot_icon' => 'fa fa-circle',
					],
					[
						'section_title'   => __( 'Section 2', 'easy-elementor-addons' ),
						'section_id'      => 'section-2',
						'select_dot_icon' => 'fa fa-circle',
					],
					[
						'section_title'   => __( 'Section 3', 'easy-elementor-addons' ),
						'section_id'      => 'section-3',
						'select_dot_icon' => 'fa fa-circle',
					],
				],
				'fields'                => $repeater->get_controls(),
				'title_field'           => '{{{ section_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_onepage_nav_tooltip_settings',
			[
				'label'                 => __( 'Tooltip', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'nav_tooltip',
			[
				'label'                 => __( 'Enable', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'easy-elementor-addons' ),
				'label_off'             => __( 'No', 'easy-elementor-addons' ),
				'return_value'          => 'yes',
			]
		);

		$this->add_control(
			'tooltip_arrow',
			[
				'label'                 => __( 'Tooltip Arrow', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Show', 'easy-elementor-addons' ),
				'label_off'             => __( 'Hide', 'easy-elementor-addons' ),
				'return_value'          => 'yes',
				'condition'             => [
					'nav_tooltip'   => 'yes',
				],
			]
		);

		$this->add_control(
			'distance',
			[
				'label'                 => __( 'Space Between Tooltip', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'  => '',
				],
				'range'                 => [
					'px'    => [
						'min'   => 0,
						'max'   => 150,
					],
				],
				'selectors'             => [
					'{{WRAPPER}}.eead-nav-align-top .eead-nav-dot-tooltip' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.eead-nav-align-bottom .eead-nav-dot-tooltip' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.eead-nav-align-left .eead-nav-dot-tooltip' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.eead-nav-align-right .eead-nav-dot-tooltip' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'nav_tooltip'   => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_onepage_nav_settings',
			[
				'label'                 => __( 'Additional Settings', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'scroll_wheel',
			[
				'label'                 => __( 'Scroll Wheel', 'easy-elementor-addons' ),
				'description'           => __( 'Scroll the mouse to navigate from one section to another', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'off',
				'label_on'              => __( 'On', 'easy-elementor-addons' ),
				'label_off'             => __( 'Off', 'easy-elementor-addons' ),
				'return_value'          => 'on',
			]
		);

		$this->add_control(
			'scroll_touch',
			[
				'label'                 => __( 'Touch Swipe', 'easy-elementor-addons' ),
				'description'           => __( 'Swipe to navigate from one section to another on touch devices', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'off',
				'label_on'              => __( 'On', 'easy-elementor-addons' ),
				'label_off'             => __( 'Off', 'easy-elementor-addons' ),
				'return_value'          => 'on',
				'condition'             => [
					'scroll_wheel'   => 'on',
				],
			]
		);

		$this->add_control(
			'scroll_keys',
			[
				'label'                 => __( 'Scroll Keys', 'easy-elementor-addons' ),
				'description'           => __( 'Press UP or DOWN keys to navigate from one section to another', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'off',
				'label_on'              => __( 'On', 'easy-elementor-addons' ),
				'label_off'             => __( 'Off', 'easy-elementor-addons' ),
				'return_value'          => 'on',
			]
		);

		$this->add_control(
			'top_offset',
			[
				'label'                 => __( 'Row Top Offset', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [ 'size' => '0' ],
				'range'                 => [
					'px' => [
						'min'   => 0,
						'max'   => 300,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
			]
		);

		$this->add_control(
			'scrolling_speed',
			[
				'label'                 => __( 'Scrolling Speed', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => '700',
			]
		);

		$this->end_controls_section();

		/*Style Controls*/
		$this->start_controls_section(
			'section_nav_box_style',
			[
				'label'                 => __( 'Navigation Box', 'easy-elementor-addons' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_alignment',
			[
				'label'                 => __( 'Alignment', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'easy-elementor-addons' ),
						'icon'     => 'eicon-v-align-top',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'easy-elementor-addons' ),
						'icon'     => 'eicon-v-align-bottom',
					],
					'left'         => [
						'title'    => __( 'Left', 'easy-elementor-addons' ),
						'icon'     => 'eicon-h-align-left',
					],
					'right'        => [
						'title'    => __( 'Right', 'easy-elementor-addons' ),
						'icon'     => 'eicon-h-align-right',
					],
				],
				'default'               => 'right',
				'prefix_class'          => 'eead-nav-align-',
				'frontend_available'    => true,
				'selectors'             => [
					'{{WRAPPER}} .eead-caldera-form-heading' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'              => 'nav_container_background',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .eead-one-page-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'nav_container_border',
				'label'                 => __( 'Border', 'easy-elementor-addons' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eead-one-page-nav',
			]
		);

		$this->add_control(
			'nav_container_border_radius',
			[
				'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_container_margin',
			[
				'label'                 => __( 'Margin', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_container_padding',
			[
				'label'                 => __( 'Padding', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'nav_container_box_shadow',
				'selector'              => '{{WRAPPER}} .eead-one-page-nav',
				'separator'             => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dots_style',
			[
				'label'                 => __( 'Navigation Dots', 'easy-elementor-addons' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dots_size',
			[
				'label'                 => __( 'Size', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [ 'size' => '18' ],
				'range'                 => [
					'px' => [
						'min'   => 5,
						'max'   => 60,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label'                 => __( 'Spacing', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [ 'size' => '15' ],
				'range'                 => [
					'px' => [
						'min'   => 2,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}}.eead-nav-align-right .eead-one-page-nav-item, {{WRAPPER}}.eead-nav-align-left .eead-one-page-nav-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.eead-nav-align-top .eead-one-page-nav-item, {{WRAPPER}}.eead-nav-align-bottom .eead-one-page-nav-item' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_padding',
			[
				'label'                 => __( 'Padding', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'dots_box_shadow',
				'selector'              => '{{WRAPPER}} .eead-nav-dot-wrap',
				'separator'             => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_dots_style' );

		$this->start_controls_tab(
			'tab_dots_normal',
			[
				'label'                 => __( 'Normal', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'dots_color_normal',
			[
				'label'                 => __( 'Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-nav-dot svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_bg_color_normal',
			[
				'label'                 => __( 'Background Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'dots_border',
				'label'                 => __( 'Border', 'easy-elementor-addons' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .eead-nav-dot-wrap',
			]
		);

		$this->add_control(
			'dots_border_radius',
			[
				'label'                 => __( 'Border Radius', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dots_hover',
			[
				'label'                 => __( 'Hover', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'dots_color_hover',
			[
				'label'                 => __( 'Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item .eead-nav-dot-wrap:hover .eead-nav-dot' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-one-page-nav-item .eead-nav-dot-wrap:hover .eead-nav-dot svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_bg_color_hover',
			[
				'label'                 => __( 'Background Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item .eead-nav-dot-wrap:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_border_color_hover',
			[
				'label'                 => __( 'Border Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item .eead-nav-dot-wrap:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dots_active',
			[
				'label'                 => __( 'Active', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'dots_color_active',
			[
				'label'                 => __( 'Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item.active .eead-nav-dot' => 'color: {{VALUE}}',
					'{{WRAPPER}} .eead-one-page-nav-item.active .eead-nav-dot svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_bg_color_active',
			[
				'label'                 => __( 'Background Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item.active .eead-nav-dot-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_border_color_active',
			[
				'label'                 => __( 'Border Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-one-page-nav-item.active .eead-nav-dot-wrap' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label'                 => __( 'Tooltip', 'easy-elementor-addons' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'nav_tooltip'  => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label'                 => __( 'Background Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-tooltip-content' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .eead-nav-dot-tooltip' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'nav_tooltip'  => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_color',
			[
				'label'                 => __( 'Text Color', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-tooltip-content' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'nav_tooltip'  => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'tooltip_typography',
				'label'                 => __( 'Typography', 'easy-elementor-addons' ),
				'selector'              => '{{WRAPPER}} .eead-nav-dot-tooltip',
				'condition'             => [
					'nav_tooltip'  => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tooltip_box_shadow',
				'label' => __( 'Box Shadow', 'easy-elementor-addons' ),
				'selector' => '{{WRAPPER}} .eead-nav-dot-tooltip-content',
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label'                 => __( 'Padding', 'easy-elementor-addons' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .eead-nav-dot-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];

		$this->add_render_attribute(
			'onepage-nav',
			[
				'class'             => 'eead-one-page-nav',
				'id'                => 'eead-one-page-nav-' . $this->get_id(),
				'data-section-id'   => 'eead-one-page-nav-' . $this->get_id(),
				'data-top-offset'   => $settings['top_offset']['size'],
				'data-scroll-speed' => $settings['scrolling_speed'],
				'data-scroll-wheel' => $settings['scroll_wheel'],
				'data-scroll-touch' => $settings['scroll_touch'],
				'data-scroll-keys'  => $settings['scroll_keys'],
			]
		);

		$migration_allowed = Icons_Manager::is_migration_allowed();
		?>
		<div class='eead-one-page-nav-container'>
			<ul <?php echo $this->get_render_attribute_string( 'onepage-nav' ); ?>>
				<?php
				$count = 1;
				foreach ( $settings['nav_dots'] as $index => $dot ) {

					// add old default
					if ( ! isset( $dot['dot_icon'] ) && ! $migration_allowed ) {
						$dot['dot_icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
					}

					$migrated = isset( $dot['__fa4_migrated']['select_dot_icon'] );
					$is_new = ! isset( $dot['dot_icon'] ) && $migration_allowed;

					//tooltip attributes
					$this->add_render_attribute( 'tooltip', 'class', 'eead-nav-dot-tooltip' );
					if ( $settings['tooltip_arrow'] == 'yes' ) {
						$this->add_render_attribute( 'tooltip', 'class', 'eead-tooltip-arrow' );
					}
					
					?>
					<li class="eead-one-page-nav-item">
						<?php
						if ( $settings['nav_tooltip'] == 'yes' ) {
							printf( '<span %1$s><span class="eead-nav-dot-tooltip-content">%2$s</span></span>', $this->get_render_attribute_string( 'tooltip' ), $dot['section_title'] );
						} else {
							echo '';
						}
						?>
						<a href="#" data-row-id="<?php echo $dot['section_id']; ?>">
							<span class="eead-nav-dot-wrap">
								<span class="eead-nav-dot eead-icon">
									<?php
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $dot['select_dot_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
											<i class="<?php echo esc_attr( $dot['dot_icon'] ); ?>" aria-hidden="true"></i>
									<?php } ?>
								</span>
							</span>
						</a>
					</li>
					<?php
					$count++;
				}
				?>
			</ul>
		</div>

		<?php
		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
		?>
		<div class="eead-editor-placeholder">
			<h4 class="eead-editor-placeholder-title">
				<?php _e( 'One Page Navigation', 'easy-elementor-addons' ); ?>
			</h4>

			<div class="eead-editor-placeholder-content">
				<p><?php _e( 'Click here to edit the Navigation settings.', 'easy-elementor-addons' ); ?></p>
				<p><?php _e( 'This text will not show in the frontend.', 'easy-elementor-addons' ); ?></p>
			</div>
		</div>
		<?php
		}
	}
}
