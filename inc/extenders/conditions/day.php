<?php

namespace EasyElementorAddons\Conditions;

use DateTime;
use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Day extends Condition {

	/**
	 * Get the name of condition
	 * @return string as per our condition control name
	 * @since  5.3.0
	 */
	public function get_name() {
		return 'day';
	}

	/**
	 * Get the title of condition
	 * @return string as per condition control title
	 * @since  5.3.0
	 */
	public function get_title() {
		return esc_html__( 'Day of Week', 'easy-elementor-addons' );
	}

	/**
	 * Get the browser
	 * @return array of different days of week
	 * @since  5.3.0
	 */
	public function get_control_value() {
		return [
			'label'       => esc_html__( 'Day(s)', 'easy-elementor-addons' ),
			'type'        => Controls_Manager::SELECT2,
			'options'     => [
				'0' => esc_html__( 'Sunday', 'easy-elementor-addons' ),
				'1' => esc_html__( 'Monday', 'easy-elementor-addons' ),
				'2' => esc_html__( 'Tuesday', 'easy-elementor-addons' ),
				'3' => esc_html__( 'Wednesday', 'easy-elementor-addons' ),
				'4' => esc_html__( 'Thursday', 'easy-elementor-addons' ),
				'5' => esc_html__( 'Friday', 'easy-elementor-addons' ),
				'6' => esc_html__( 'Saturday', 'easy-elementor-addons' ),
			],
			'multiple'    => true,
			'label_block' => true,
			'default'     => '1',
		];
	}

	/**
	 * Check the condition
	 *
	 * @param string $relation Comparison operator for compare function
	 * @param mixed $val will check the control value as per condition needs
	 *
	 * @since 5.3.0
	 */
	public function check( $relation, $val ) {

		$day = date('w', current_time( 'timestamp'));
		$show = is_array( $val ) && ! empty( $val ) ? in_array( $day, $val ) : $val === $day;

		return self::compare( $show, true, $relation );
	}
}