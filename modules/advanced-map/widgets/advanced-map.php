<?php

namespace EasyElementorAddons\Modules\AdvancedMap\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class AdvancedMap extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-advanced-map';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Advanced Map', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-flip-box';
    }

    public function get_keywords() {
		return [ 'map', 'google map', 'google'  ];
	}

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'gmap-api' ];
    }

    /** Controls */
    protected function _register_controls() {

    	$this->start_controls_section(
			'marker_controls_section',
			[
				'label' => __( 'Markers', 'easy-elementor-addons' ),
			]
		);

		$map_key = 'AIzaSyBWbk2I3GRGYSSOU1tld0TIpfa_rSBbd6M';
		if ( ! isset( $map_key ) || $map_key === '' ) {
			$this->add_control(
				'notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => '<div class="eead-notice">
                                To add google map api key <a target="_blank" href="' . admin_url( 'admin.php?page=eead' ) . '">Click Here.</a>
                            </div>',
				]
			);
		}

		$repeater = new Repeater();

		$repeater->add_control(
			'lat',
			[
				'label'       => __( 'Latitude', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter latitude here', 'easy-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'long',
			[
				'label'       => __( 'Longitude', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter latitude here', 'easy-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'address',
			[
				'label'       => __( 'Address', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter address here..', 'easy-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'icon_size',
			[
				'label'   => __( 'Icon Size', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 50,
					'unit' => 'px',
				],
			]
		);

		$repeater->add_control(
			'info_window_onload',
			[
				'label'        => __( 'Info Window On Load', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Open', 'easy-elementor-addons' ),
				'label_off'    => __( 'Close', 'easy-elementor-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'markers',
			[
				'label'   => __( 'Markers', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'lat'     => '-25.363',
						'long'    => '131.044',
						'address' => __( 'Enter Address Here', 'easy-elementor-addons' ),
					],
				],
			]
		);

		$this->end_controls_section();

    	$this->start_controls_section(
			'general',
			[
				'label' => __( 'General Settings', 'easy-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'     => __( 'Height', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 300,
				'selectors' => [
					'{{WRAPPER}} .eead-markers' => 'height:{{VALUE}}px',
				],
			]
		);
		$this->add_control(
			'zoom',
			[
				'label'   => __( 'Zoom', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'min' => 6,
						'max' => 20,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
			]
		);

		$this->add_control(
			'animate',
			[
				'label'        => __( 'Animate Marker', 'easy-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'easy-elementor-addons' ),
				'label_off'    => __( 'No', 'easy-elementor-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
            'scrollwheel',
            array(
                'label'   => esc_html__( 'Scrollwheel Zoom', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'false',
                'options' => array(
                    'true'  => esc_html__( 'Enabled', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'Disabled', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
            'zoom_controls',
            array(
                'label'   => esc_html__( 'Zoom Controls', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => array(
                    'true'  => esc_html__( 'Show', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'Hide', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
            'fullscreen_control',
            array(
                'label'   => esc_html__( 'Fullscreen Control', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => array(
                    'true'  => esc_html__( 'Show', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'Hide', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
            'street_view',
            array(
                'label'   => esc_html__( 'Street View Controls', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => array(
                    'true'  => esc_html__( 'Show', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'Hide', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
            'map_type',
            array(
                'label'   => esc_html__( 'Map Type Controls (Map/Satellite)', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => array(
                    'true'  => esc_html__( 'Show', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'Hide', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
            'drggable',
            array(
                'label'   => esc_html__( 'Is Map Draggable?', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => array(
                    'true'  => esc_html__( 'Yes', 'easy-elementor-addons' ),
                    'false' => esc_html__( 'No', 'easy-elementor-addons' ),
                ),
            )
        );

        $this->add_control(
			'snazzy_style',
			[
				'label'       => __( 'Snazzy Style', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'separator'   => 'before',
				'description' => __( 'Choose any map styles by visiting <a href="https://snazzymaps.com/explore" target="_blank">Snazzy Maps</a>. Copy any Javascript Style Array and paste here.', 'easy-elementor-addons' ),
			]
		);

		$this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
		$settings = $this->get_settings_for_display();

		$markers = $settings['markers'];

		if ( $settings['drggable'] === 'false' ) {

            $this->add_render_attribute( 'wrapper', [
	        	'data-gestureHandling'	 => 'none'
			]);
        }

		$this->add_render_attribute( 'wrapper', [
			'data-zoom' => $settings['zoom']['size'],
			'data-scrollwheel'       => $settings['scrollwheel'] == 'true' ? true : null,
            'data-zoomControl'       => $settings['zoom_controls'] == 'true' ? true : null,
            'data-fullscreenControl' => $settings['fullscreen_control'] == 'true' ? true : null,
            'data-streetViewControl' => $settings['street_view'] == 'true' ? true : null,
            'data-mapTypeControl'    => $settings['map_type'] == 'true' ? true : null,
			'data-style' => $settings['snazzy_style'],
			'data-animate' => 'animate-' . $settings['animate']
		]);

		if ( count( $markers ) >= 1 ) {
			?>
			<div class="eead-gmap-wrapper">
				<div class="eead-markers" <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<?php
				foreach ( $markers as $marker ) {
					?>
					<div class="marker" data-lat="<?php echo $marker['lat']; ?>" data-lng="<?php echo $marker['long']; ?>" data-icon-size="<?php echo $marker['icon_size']['size']; ?>" data-icon="<?php echo $marker['icon']['url']; ?>" data-info-window="<?php echo $marker['info_window_onload']; ?>">
						<?php echo $marker['address']; ?>
					</div>
					<?php
				}
				?>
				</div>
			</div>
			<?php
		}
    }
   
}
