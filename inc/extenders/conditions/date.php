<?php

namespace EasyElementorAddons\Conditions;

use DateTime;
use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Date extends Condition {

	public function get_name() {
		return 'date';
	}

	public function get_title() {
		return esc_html__('Date Range', 'easy-elementor-addons');
	}

	public function get_control_value() {
		$default_date_start = date('Y-m-d', strtotime('-3 day') + (get_option('gmt_offset') * HOUR_IN_SECONDS));
		$default_date_end = date('Y-m-d', strtotime('+3 day') + (get_option('gmt_offset') * HOUR_IN_SECONDS));
		$default_interval = $default_date_start . ' to ' . $default_date_end;

		return [
			'label' => esc_html__('In interval', 'easy-elementor-addons'),
			'type' => Controls_Manager::DATE_TIME,
			'picker_options' => [
				'enableTime' => false,
				'mode' => 'range',
			],
			'label_block' => true,
			'default' => $default_interval,
		];
	}

	public function check($relation, $val) {
		// Split control value into two dates
		$intervals = explode('to', preg_replace('/\s+/', '', $val));

		// Make sure the explode return an array with exactly 2 indexes
		if (!is_array($intervals) || 2 !== count($intervals)) {
			return false;
		}

		// Set start and end dates
		$start = strtotime($intervals[0]);
		$end = strtotime($intervals[1]);

		// Check vars
		if (!$start || !$end) { // Make sure it's a date
			return false;
		}

		// get current time for test
		$today = current_time('timestamp');

		// Check that user date is between start & end
		$show = (($today >= $start) && ($today <= $end));

		return $this->compare($show, true, $relation);
	}
}