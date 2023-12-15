<?php

namespace EasyElementorAddons\Conditions;

use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Ex_Url extends Condition {

	public function get_name() {
		return 'ex_url';
	}

	public function get_title() {
		return esc_html__('From External URL', 'easy-elementor-addons');
	}

	public function get_control_value() {
		return [
			'type' => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => 'www.elementpack.pro',
			'description' => esc_html__('Leave blank for any external link', 'easy-elementor-addons'),
		];
	}

	public function check( $relation, $val ) {
		$res = false;
		$site_url = str_ireplace('www.', '', parse_url(home_url(), PHP_URL_HOST));

		if(isset($_SERVER['HTTP_REFERER'])) {
			$url = (!empty($val)) ? $val : $_SERVER['HTTP_REFERER'];
			$components = parse_url($url);
			if (empty($components['host'])) return false;  // we will treat url like '/relative.php' as relative
			if (strcasecmp($components['host'], $site_url) === 0) return false; // url host looks exactly like the local host
			$res = strrpos(strtolower($components['host']), '.'.$site_url) !== strlen($components['host']) - strlen('.'.$site_url); // check if the url host is a subdomain
		}

		return $this->compare($res, true, $relation);
	}
}
