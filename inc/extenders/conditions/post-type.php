<?php

namespace EasyElementorAddons\Conditions;

use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Post_Type extends Condition {

	public function get_name() {
		return 'post_type';
	}

	public function get_title() {
		return esc_html__('Post Type', 'easy-elementor-addons');
	}

	public function get_control_value() {
		return [
			'type' => Controls_Manager::SELECT2,
			'default' => '',
			'placeholder' => esc_html__('Any', 'easy-elementor-addons'),
			'description' => esc_html__('Leave blank or select all for any post type.', 'easy-elementor-addons'),
			'label_block' => true,
			'multiple' => true,
			'options' => eead_get_post_types(),
		];
	}

	public function check($relation, $val) {
		$show = false;

		if (is_array($val) && !empty($val)) {
			foreach ($val as $_key => $_value) {
				if (is_singular($_value)) {
					$show = true;
					break;
				}
			}

		} else {
			$show = is_singular($val);
		}

		return $this->compare($show, true, $relation);
	}
}
