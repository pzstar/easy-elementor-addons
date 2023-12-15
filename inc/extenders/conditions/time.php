<?php

namespace EasyElementorAddons\Conditions;

use DateTime;
use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Time extends Condition {

	public function get_name() {
		return 'time';
	}

	public function get_title() {
		return esc_html__('Till Time of Day (Server Time)', 'easy-elementor-addons');
	}

	public function get_control_value() {
		return [
			'label' => esc_html__('Before', 'easy-elementor-addons'),
			'type' => Controls_Manager::DATE_TIME,
			'picker_options' => [
				'dateFormat' => 'H:i',
				'enableTime' => true,
				'noCalendar' => true,
			],
			'label_block' => true,
			'default' => '',
		];
	}

	public function check( $relation, $val ) {
		// Split control valur into two dates
		$time = date('H:i', strtotime( preg_replace('/\s+/', '', $val)));
		$now = date('H:i', strtotime('now') + (get_option('gmt_offset') * HOUR_IN_SECONDS));

		// Check vars
		if (DateTime::createFromFormat('H:i', $time) === false) {
			return;
		}

		// Convert time to timestamp
		$time_ts = strtotime($time);
		$now_ts  = strtotime($now);

		// is date between start & end ?
		$show = ($now_ts <= $time_ts);

		return $this->compare($show, true, $relation);
	}
}