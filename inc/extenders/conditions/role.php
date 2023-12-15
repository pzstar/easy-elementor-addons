<?php

namespace EasyElementorAddons\Conditions;

use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Role extends Condition {

	public function get_name() {
		return 'role';
	}

	public function get_title() {
		return esc_html__('User Role', 'easy-elementor-addons');
	}

	public function get_control_value() {
		global $wp_roles;

		return [
			'type' => Controls_Manager::SELECT,
			'description' => esc_html__('Warning: This condition applies only to logged in visitors.', 'easy-elementor-addons'),
			'default' => 'subscriber',
			'label_block' => true,
			'options' => $wp_roles->get_names(),
		];
	}

	public function check( $relation, $val ) {
		$user = wp_get_current_user();
		return $this->compare(is_user_logged_in() && in_array($val, $user->roles), true, $relation);
	}
}