<?php

namespace EasyElementorAddons\Base;

// Elementor Classes
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

abstract class Condition {

	protected static $_instances = [];

	protected $element_id;

	public static function class_name() {
		return get_called_class();
	}

	public static function instance() {
		if (empty(static::$_instances[static::class_name()])) {
			static::$_instances[static::class_name()] = new static();
		}

		return static::$_instances[static::class_name()];
	}

	public static function is_supported() {
		return true;
	}

	public function get_name() {
	}

	public function get_title() {
	}

	public function get_name_control() {
		return false;
	}

	public function get_value_control() {
	}

	public function check($relation, $val) {
	}

	public function compare($left_val, $right_val, $relation) {
		switch ($relation) {
			case 'is':
				return $left_val == $right_val;

			case 'not':
				return $left_val != $right_val;

			default:
				return $left_val === $right_val;
		}
	}

	public function set_element_id($id) {
		$this->element_id = $id;
	}

	protected function get_element_id() {
		return $this->element_id;
	}
}