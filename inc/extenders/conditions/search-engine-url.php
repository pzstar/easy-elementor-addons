<?php

namespace EasyElementorAddons\Conditions;

use EasyElementorAddons\Base\Condition;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
class Search_Engine_Url extends Condition {

	public function get_name() {
		return 'search_engine_url';
	}

	public function get_title() {
		return esc_html__('From Search Engine URL', 'easy-elementor-addons');
	}

	public function get_control_value() {
		return [
			'type' => Controls_Manager::SELECT2,
			'label' => esc_html__('Choose from dropdown', 'easy-elementor-addons'),
			'label_block' => true,
			'multiple' => true,
			'default' => 'google.com',
			'description' => esc_html__('Don\'t leave it blank', 'easy-elementor-addons'),
			'options' => [
				'google.com' => esc_html__('Google', 'easy-elementor-addons'),
				'yahoo.com' => esc_html__('Yahoo', 'easy-elementor-addons'),
				'bing.com' => esc_html__('Bing', 'easy-elementor-addons'),
				'yandex.com' => esc_html__('Yandex', 'easy-elementor-addons'),
				'baidu.com' => esc_html__('Baidu', 'easy-elementor-addons'),
			],
		];
	}

	public function check($relation, $val) {
		$res = false;
		$sename = false;
		if(isset($_SERVER['HTTP_REFERER'])) {
			$url = $_SERVER['HTTP_REFERER'];

			if(!empty($val)) {
				foreach ($val as $value) {
				  if (in_array($value, ['google.com','yahoo.com','bing.com','yandex.com','baidu.com'])) {
				    $sename = $value;
				    break;
				  }
				}
			}

			if (strpos($url, $sename) !== false) {
				$res = true;
			}
		}

		return $this->compare( $res, true, $relation );
	}
}
