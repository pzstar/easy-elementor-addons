<?php

namespace EasyElementorAddons\Conditions;

use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Static_Page extends Condition {

	public function get_name() {
		return 'static_page';
	}

	public function get_title() {
		return esc_html__('Page', 'easy-elementor-addons');
	}

	public function get_control_value() {
		return [
			'type' => Controls_Manager::SELECT,
			'default' => 'home',
			'label_block' => true,
			'options' => [
				'home' => esc_html__('Homepage', 'easy-elementor-addons'),
				'static' => esc_html__('Front Page', 'easy-elementor-addons'),
				'blog' => esc_html__('Blog', 'easy-elementor-addons'),
				'404' => esc_html__('404 Page', 'easy-elementor-addons'),
			],
		];
	}

	public function check($relation, $val) {
		if ('home' === $val) {
			return $this->compare((is_front_page() && is_home()), true, $relation);

		} elseif ('static' === $val) {
			return $this->compare((is_front_page() && ! is_home()), true, $relation);

		} elseif ('blog' === $val) {
			return $this->compare((!is_front_page() && is_home()), true, $relation);

		} elseif ('404' === $val) {
			return $this->compare(is_404(), true, $relation);
		}
	}
}