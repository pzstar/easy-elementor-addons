<?php
namespace EasyElementorAddons\Modules\PieChart\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PieChart extends Widget_Base {

	public function get_name() {
		return 'eead-pie-chart-block';
	}

	public function get_title() {
		return esc_html__( 'Pie Chart', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-circle';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

 	public function get_script_depends() {
		return [ 'chart' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_chart_data', [
				'label' => esc_html__( 'Chart Data', 'easy-elementor-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'label', [
				'label'   => esc_html__( 'Label', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
			]
		);

		$repeater->add_control(
			'value', [
				'label'   => esc_html__( 'Value', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'dynamic' => version_compare( ELEMENTOR_VERSION, '2.7.0', '>=' ) ?
					array(
						'active'     => true,
						'categories' => array(
							TagsModule::POST_META_CATEGORY,
							TagsModule::NUMBER_CATEGORY,
						),
					) : array(),
			]
		);

		$repeater->add_control(
			'color', [
				'label' => esc_html__( 'Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'chart_data', [
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'label' => esc_html__( 'Google', 'easy-elementor-addons' ),
						'value' => 50,
						'color' => '#646dd5',
					),
					array(
						'label' => esc_html__( 'Facebook', 'easy-elementor-addons' ),
						'value' => 50,
						'color' => '#d564c8',
					),
					array(
						'label' => esc_html__( 'Twitter', 'easy-elementor-addons' ),
						'value' => 50,
						'color' => '#64b1d5',
					),
				),
				'title_field' => '{{{ label }}}',
			]
		);

		$this->add_control(
			'chart_title', [
				'label'     => esc_html__( 'Chart Title', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Pie Chart', 'easy-elementor-addons' ),
				'dynamic'   => array( 'active' => true ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'chart_title_size', [
				'label'   => esc_html__( 'Title HTML Tag', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => eead_html_tags(),
				'default' => 'h5',
			]
		);

		$this->add_control(
			'chart_title_position', [
				'label'   => esc_html__( 'Title Position', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'before' => esc_html__( 'Before Chart', 'easy-elementor-addons' ),
					'after'  => esc_html__( 'After Chart', 'easy-elementor-addons' ),
				),
				'default' => 'after',
			]
		);

		$this->end_controls_section();

		/* Legend Options */
		$this->start_controls_section(
			'legend_settings', [
				'label' => esc_html__( 'Legend', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'chart_legend_display', [
				'label'        => esc_html__( 'Enable', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			]
		);

		$this->add_control(
			'chart_legend_position', [
				'label'   => esc_html__( 'Position', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => array(
					'top'    => esc_html__( 'Top', 'easy-elementor-addons' ),
					'left'   => esc_html__( 'Left', 'easy-elementor-addons' ),
					'bottom' => esc_html__( 'Bottom', 'easy-elementor-addons' ),
					'right'  => esc_html__( 'Right', 'easy-elementor-addons' ),
				),
			]
		);

		$this->add_control(
			'chart_legend_reverse', [
				'label'        => esc_html__( 'Reverse', 'easy-elementor-addons' ),
				'description'  => esc_html__( 'Show datasets in reverse order.', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'true',
			]
		);

		$this->end_controls_section();

		/* Animation */
		$this->start_controls_section(
			'animation_settings', [
				'label' => esc_html__( 'Animation', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'chart_animation_duration', [
				'label'       => esc_html__( 'Duration', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'ms' ),
				'range' => array(
					'ms' => array(
						'min' => 100,
						'max' => 3000,
					),
				),
				'default' => array(
					'unit' => 'ms',
				),
			]
		);

		$animation_easing = array(
			'linear',
			'easeInQuad',
			'easeOutQuad',
			'easeInOutQuad',
			'easeInCubic',
			'easeOutCubic',
			'easeInOutCubic',
			'easeInQuart',
			'easeOutQuart',
			'easeInOutQuart',
			'easeInQuint',
			'easeOutQuint',
			'easeInOutQuint',
			'easeInSine',
			'easeOutSine',
			'easeInOutSine',
			'easeInExpo',
			'easeOutExpo',
			'easeInOutExpo',
			'easeInCirc',
			'easeOutCirc',
			'easeInOutCirc',
			'easeInElastic',
			'easeOutElastic',
			'easeInOutElastic',
			'easeInBack',
			'easeOutBack',
			'easeInOutBack',
			'easeInBounce',
			'easeOutBounce',
			'easeInOutBounce',
		);

		$this->add_control(
			'chart_animation_easing', [
				'label'   => esc_html__( 'Easing', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'easeOutQuart',
				'options' => array_combine( $animation_easing, $animation_easing )
			]
		);

		$this->add_control(
			'chart_animate_scale', [
				'label'        => esc_html__( 'Scale From Center', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'true',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings', [
				'label' => esc_html__( 'Additional Settings', 'easy-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'chart_height', [
				'label' => esc_html__( 'Chart Height', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 100,
						'max' => 1200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .eead-pie-chart-container' => 'height: {{SIZE}}{{UNIT}};',
				),
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'chart_cutout_percentage', [
				'label'       => esc_html__( 'Cutout Percentage', 'easy-elementor-addons' ),
				'description' => esc_html__( 'The middle portion of chart to be cut out. ', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( '%' ),
				'range' => array(
					'%' => array(
						'min' => 0,
						'max' => 99,
					),
				),
				'default' => array(
					'unit' => '%',
				),
			]
		);

		$this->add_control(
			'chart_tooltip_enabled', [
				'label'        => esc_html__( 'Enable Tooltip', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_chart_style', [
				'label' => esc_html__( 'Chart', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'chart_border_width', [
				'label' => esc_html__( 'Border Width', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
			]
		);

		$this->add_control(
			'chart_border_color', [
				'label' => esc_html__( 'Border Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_chart_title_style', [
				'label' => esc_html__( 'Title', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'chart_title_typography',
				'selector' => '{{WRAPPER}} .eead-pie-chart-title',
			]
		);

		$this->add_control(
			'chart_title_color', [
				'label' => esc_html__( 'Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .eead-pie-chart-title' => 'color: {{VALUE}};',
				),
			]
		);

		$this->add_control(
			'chart_title_margin', [
				'label'      => esc_html__( 'Margin', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-pie-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			]
		);

		$this->add_control(
			'chart_title_padding', [
				'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .eead-pie-chart-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(), [
				'name'     => 'chart_title_text_shadow',
				'selector' => '{{WRAPPER}} .eead-pie-chart-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_chart_legend_style', [
				'label' => esc_html__( 'Legend', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'chart_legend_display' => 'true',
				),
			]
		);

		$this->add_control(
			'chart_legend_box_width', [
				'label' => esc_html__( 'Box Width', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
			]
		);

		$this->add_control(
			'chart_legend_font_family', [
				'label'   => esc_html__( 'Font Family', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::FONT,
				'default' => '',
			]
		);

		$this->add_control(
			'chart_legend_font_size', [
				'label' => esc_html__( 'Font Size', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
			]
		);

		$this->add_control(
			'chart_legend_font_weight', [
				'label'   => esc_html__( 'Font Weight', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->typo_weight_options(),
			]
		);

		$this->add_control(
			'chart_legend_font_style', [
				'label' => esc_html__( 'Font Style', 'easy-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => esc_html__( 'Default', 'easy-elementor-addons' ),
					'normal'  => esc_attr_x( 'Normal', 'Typography Control', 'easy-elementor-addons' ),
					'italic'  => esc_attr_x( 'Italic', 'Typography Control', 'easy-elementor-addons' ),
					'oblique' => esc_attr_x( 'Oblique', 'Typography Control', 'easy-elementor-addons' ),
				),
			]
		);

		$this->add_control(
			'chart_legend_font_color', [
				'label' => esc_html__( 'Font Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_chart_tooltips_style', [
				'label' => esc_html__( 'Tooltips', 'easy-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'chart_tooltip_enabled' => 'true',
				),
			]
		);

		$this->add_control(
			'chart_tooltip_bg_color', [
				'label' => esc_html__( 'Background Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'chart_tooltip_font_family', [
				'label'   => esc_html__( 'Font Family', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::FONT,
				'default' => '',
			]
		);

		$this->add_control(
			'chart_tooltip_font_size', [
				'label' => esc_html__( 'Font Size', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 50,
					),
				),
			]
		);

		$this->add_control(
			'chart_tooltip_font_weight', [
				'label'   => esc_html__( 'Font Weight', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->typo_weight_options(),
			]
		);

		$this->add_control(
			'chart_tooltip_font_style', [
				'label' => esc_html__( 'Font Style', 'easy-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => esc_html__( 'Default', 'easy-elementor-addons' ),
					'normal'  => esc_attr_x( 'Normal', 'Typography Control', 'easy-elementor-addons' ),
					'italic'  => esc_attr_x( 'Italic', 'Typography Control', 'easy-elementor-addons' ),
					'oblique' => esc_attr_x( 'Oblique', 'Typography Control', 'easy-elementor-addons' ),
				),
			]
		);

		$this->add_control(
			'chart_tooltip_font_color', [
				'label' => esc_html__( 'Font Color', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();
	}

	protected function render_chart_title($position) {
		$settings = $this->get_settings_for_display();

		if ( $settings['chart_title_position'] == $position ) 
		{
			$title_tag = $settings['chart_title_size']; 
			?>

		<div class="eead-pie-chart-title-container">
			<<?php echo $title_tag; ?> class="eead-pie-chart-title">
				<?php echo esc_html($settings['chart_title']); ?>
			</<?php echo $title_tag; ?>>
		</div>

			<?php
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$data_chart   = $this->get_chart_data();
		$data_options = $this->get_chart_options();

		$this->add_render_attribute( 'canvas', [
			'class' => 'eead-pie-chart',
			'role' => 'img',
			'aria-label' => !empty($settings['chart_title']) ? esc_attr($settings['chart_title']) : null
		]);		
		?>

		<div class="elementor-eead-pie-chart eead-elements">
		<?php $this->render_chart_title('before'); ?>
			<div class='eead-pie-chart-container'
				 data-chart='<?php echo esc_attr( json_encode($data_chart) ); ?>'
			     data-options='<?php echo esc_attr( json_encode( $data_options ) ) ?>' >

				<canvas class = 'eead-pie-chart'
					 role = 'img'
					 aria-label = <?php echo !empty($settings['chart_title']) ? esc_attr($settings['chart_title']) : null ?> >
				</canvas>
			</div>
		<?php $this->render_chart_title('after'); ?>
		</div>

		<?php
	}

	public function get_chart_data() {
		$settings = $this->get_settings_for_display();

		$data = [
			'datasets' => [
				[
					'data'             => array(),
					'backgroundColor'  => array(),
				],
			],
			'labels' => array()
		];

		$chart_data = $settings['chart_data'];

		foreach ( $chart_data as $item_data ) {
			$data['datasets'][0]['data'][]            = !empty( $item_data['value'] ) ? $item_data['value'] : '';
			$data['datasets'][0]['backgroundColor'][] = !empty( $item_data['color'] ) ? $item_data['color'] : '';
			$data['labels'][]                         = !empty( $item_data['label'] ) ? $item_data['label'] : '';
		}

		$data['datasets'][0]['borderWidth']      = isset( $settings['chart_border_width']['size'] ) && !empty($settings['chart_border_width']['size']) ? $settings['chart_border_width']['size'] : 1;
		$data['datasets'][0]['borderColor']      = !empty( $settings['chart_border_color'] ) ? $settings['chart_border_color'] : '#ffffff';
		$data['datasets'][0]['hoverBorderColor'] = !empty( $settings['chart_border_color'] ) ? $settings['chart_border_color'] : '#ffffff';

		return $data;
	}


	public function get_chart_options() {
		$settings = $this->get_settings_for_display();

		$legend_display   = filter_var( $settings['chart_legend_display'], FILTER_VALIDATE_BOOLEAN );
		$tooltips_enabled = filter_var( $settings['chart_tooltip_enabled'], FILTER_VALIDATE_BOOLEAN );

		$options = [
			'animation' => [
				'duration'     => !empty( $settings['chart_animation_duration']['size'] ) ? $settings['chart_animation_duration']['size'] : 1000,
				'easing'       => !empty( $settings['chart_animation_easing'] ) ? $settings['chart_animation_easing'] : 'easeOutQuart',
				'animateScale' => filter_var( $settings['chart_animate_scale'], FILTER_VALIDATE_BOOLEAN ),
			],
			'legend' => [
				'display'  => $legend_display,
				'position' => !empty( $settings['chart_legend_position'] ) ? $settings['chart_legend_position'] : 'top',
				'reverse'  => filter_var( $settings['chart_legend_reverse'], FILTER_VALIDATE_BOOLEAN ),
			],
			'tooltips' => [
				'enabled' => $tooltips_enabled,
			],
		];

		if ( !empty( $settings['chart_cutout_percentage']['size'] ) ) {
			$options['cutoutPercentage'] = $settings['chart_cutout_percentage']['size'];
		}

		$legend_style = [];

		$legend_style_dictionary = [
			'boxWidth'   => 'chart_legend_box_width',
			'fontFamily' => 'chart_legend_font_family',
			'fontSize'   => 'chart_legend_font_size',
			'fontStyle'  => [ 'chart_legend_font_style', 'chart_legend_font_weight' ],
			'fontColor'  => 'chart_legend_font_color',
		];

		if ( $legend_display ) {

			foreach ( $legend_style_dictionary as $style_property => $setting_name ) {

				if ( is_array( $setting_name ) ) {
					$style_value = $this->get_chart_font_style_string( $setting_name );

					if ( ! empty( $style_value ) ) {
						$legend_style[ $style_property ] = $style_value;
					}
				} else {
					if ( ! empty( $settings[ $setting_name ] ) ) {
						if ( is_array( $settings[ $setting_name ] ) ) {
							if ( ! empty( $settings[ $setting_name ]['size'] ) ) {
								$legend_style[ $style_property ] = $settings[ $setting_name ]['size'];
							}
						} else {
							$legend_style[ $style_property ] = $settings[ $setting_name ];
						}
					}
				}
			}

			if ( ! empty( $legend_style ) ) {
				$options['legend']['labels'] = $legend_style;
			}
		}

		$tooltip_style_dictionary = [
			'backgroundColor' => 'chart_tooltip_bg_color',
			'bodyFontFamily'  => 'chart_tooltip_font_family',
			'bodyFontSize'    => 'chart_tooltip_font_size',
			'bodyFontStyle'   => [ 'chart_tooltip_font_style', 'chart_tooltip_font_weight' ],
			'bodyFontColor'   => 'chart_tooltip_font_color',
		];

		if ( $tooltips_enabled ) {

			foreach ( $tooltip_style_dictionary as $style_property => $setting_name ) {

				if ( is_array( $setting_name ) ) {
					$style_value = $this->get_chart_font_style_string( $setting_name );

					if ( ! empty( $style_value ) ) {
						$options['tooltips'][ $style_property ] = $style_value;
					}
				} else {
					if ( ! empty( $settings[ $setting_name ] ) ) {
						if ( is_array( $settings[ $setting_name ] ) ) {
							if ( ! empty( $settings[ $setting_name ]['size'] ) ) {
								$options['tooltips'][ $style_property ] = $settings[ $setting_name ]['size'];
							}
						} else {
							$options['tooltips'][ $style_property ] = $settings[ $setting_name ];
						}
					}
				}
			}
		}

		return $options;
	}

	public function get_chart_font_style_string( $settings_names = array() ) {
		if ( ! is_array( $settings_names ) ) {
			return '';
		}

		$settings = $this->get_settings_for_display();

		$font_styles = array();

		foreach ( $settings_names as $setting_name ) {
			if ( ! empty( $settings[ $setting_name ] ) ) {
				$font_styles[] = $settings[ $setting_name ];
			}
		}

		if ( empty( $font_styles ) ) {
			return '';
		}

		$font_styles = array_unique( $font_styles );

		return join( ' ', $font_styles );
	}


	protected function typo_weight_options() {
		$typo_weight_options = array(
			'' => esc_html__( 'Default', 'easy-elementor-addons' ),
		);
		$weight_options = array_merge( [ 'normal', 'bold' ], range( 100, 900, 100 ) );

		foreach ( $weight_options as $weight ) {
			$typo_weight_options[ $weight ] = ucfirst( $weight );
		}

		return $typo_weight_options;
	}
}
