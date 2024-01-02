<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Controls_Manager;

Class VisibilityControls {

    private static $_instance = null;

    protected $conditions = [];
	protected $_conditions = [];
	protected $_conditional_repeater;
	protected $conditions_options = [];

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
    	$this->register_conditions();

		add_action('elementor/element/common/_section_border/after_section_end', [$this, 'register_controls'], 10, 2);
		add_action('elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'], 10, 2);

		add_action('elementor/frontend/section/should_render', [$this, 'schedule_before_render'], 10, 2);
		add_filter('elementor/frontend/widget/should_render', [$this, 'schedule_before_render'], 10, 2);
    }

    public function register_controls($elems) {
    	$elems->start_controls_section(
			'section_visibility_control_controls', [
				'tab' => Controls_Manager::TAB_ADVANCED,
				'label' => esc_html__('Visibility Controls', 'easy-elementor-addons'),
			]
		);
		$elems->add_control(
			'eead_display_conditions_enable', [
				'label' => esc_html__('Display Conditions', 'easy-elementor-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
				'label_off' => esc_html__('No', 'easy-elementor-addons'),
				'return_value' => 'yes',
				'frontend_available' => true,
			]
		);

		$elems->add_control(
			'eead_display_conditions_to', [
				'label' => esc_html__('To', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => esc_html__('Show', 'easy-elementor-addons'),
					'hide' => esc_html__('Hide', 'easy-elementor-addons'),
				],
				'condition' => [
					'eead_display_conditions_enable' => 'yes',
				],
			]
		);

		$elems->add_control(
			'eead_display_conditions_relation', [
				'label' => esc_html__('When', 'easy-elementor-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__('All conditions met', 'easy-elementor-addons'),
					'any' => esc_html__('Any condition met', 'easy-elementor-addons'),
				],
				'condition' => [
					'eead_display_conditions_enable' => 'yes',
				],
			]
		);

		$this->_conditional_repeater = new Repeater();

		$this->_conditional_repeater->add_control(
			'eead_condition_key', [
				'type' => Controls_Manager::SELECT,
				'default' => 'authentication',
				'label_block' => true,
				'groups' => $this->get_conditions_options(),
			]
		);

		$this->add_name_controls();

		$this->_conditional_repeater->add_control(
			'eead_condition_operator', [
				'type' => Controls_Manager::SELECT,
				'default' => 'is',
				'label_block' => true,
				'options' => [
					'is' => esc_html__('Is', 'easy-elementor-addons'),
					'not' => esc_html__('Is not', 'easy-elementor-addons'),
				],
			]
		);

		$this->add_value_controls();

		$elems->add_control(
			'eead_display_conditions', [
				'label' => esc_html__('Conditions', 'easy-elementor-addons'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'eead_condition_key' => 'authentication',
						'eead_condition_operator' => 'is',
						'eead_condition_authentication_value' => 'authenticated',
					],
				],
				'condition' => [
					'eead_display_conditions_enable' => 'yes',
				],
				'fields' => $this->_conditional_repeater->get_controls(),
				'title_field' => 'Condition - <# print(eead_condition_key.replace(/_/i, " ").split(" ").map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(" ")) #>',
			]
		);

		$elems->end_controls_section();
    }

    public function schedule_before_render($should_render, $widget) {
		$settings = $widget->get_settings();

		if (!empty($settings['eead_display_conditions_enable']) && 'yes' === $settings['eead_display_conditions_enable']) {
			$this->set_conditions( $widget->get_id(), $settings['eead_display_conditions'] );
			$check_conditions = $this->is_visible( $widget->get_id(), $settings['eead_display_conditions_relation'] ); // check condition
			$to = $settings['eead_display_conditions_to'];

			if (('show' === $to && true === $check_conditions) || ('hide' === $to && false === $check_conditions)) {
				$should_render = true;

			} else if (('show' === $to && false === $check_conditions) || ('hide' === $to && true === $check_conditions)) {
				$should_render = false;
			}
		}

		return $should_render;
	}

	protected function set_conditions($id, $conditions = []) {
		if (!$conditions) {
			return;
		}

		foreach ($conditions as $index => $condition) {
			$key = $condition['eead_condition_key'];
			$relation = $condition['eead_condition_operator'];
			$val = $condition['eead_condition_' . $key . '_value'];
			$_condition = $this->get_conditions( $key );

			if (!$_condition) {
				continue;
			}

			$_condition->set_element_id( $id );
			$check = $_condition->check( $relation, $val );
			$this->conditions[ $id ][ $key . '_' . $condition['_id'] ] = $check;
		}
	}

	public function get_conditions($condition_name = null) {
		if ($condition_name) {
			if (isset( $this->_conditions[$condition_name])) {
				return $this->_conditions[$condition_name];
			}

			return null;
		}

		return $this->_conditions;
	}

	public function register_conditions() {
		$included_conditions = [
			'authentication',
			'role',
			'post_type',
			'static_page',
			'date',
			'date_time_before',
			'time',
			'day',
			'os',
			'browser',
			'ex_url',
			'search_engine_url',
		];

		foreach ( $included_conditions as $condition_name ) {
			$class_name = str_replace( '-', ' ', $condition_name );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Conditions\\' . $class_name;

			if (class_exists($class_name)) {
				if ($class_name::is_supported()) {
					$this->_conditions[$condition_name] = $class_name::instance();
				}
			}
		}
	}

	protected function is_visible($id, $relation) {
		if (!array_key_exists($id, $this->conditions)) {
			return false;
		}

		if (!Plugin::$instance->editor->is_edit_mode()) {
			if ('any' === $relation) {
				if (!in_array(true, $this->conditions[$id])) {
					return false;
				}

			} else {
				if (in_array(false, $this->conditions[$id])) {
					return false;
				}
			}
		}

		return true;
	}

	private function get_conditions_options() {
		$groups = [];

		foreach ($this->_conditions as $_condition) {
			$groups[ $_condition->get_name() ] = $_condition->get_title();
		}

		return $groups;
	}

	private function add_name_controls() {
		if (!$this->_conditions) {
			return;
		}

		foreach ($this->_conditions as $_condition) {
			if (false === $_condition->get_name_control()) {
				continue;
			}

			$condition_name = $_condition->get_name();
			$ctrl_key = 'eead_condition_' . $condition_name . '_name';
			$ctrl_settings = $_condition->get_name_control();

			// Show this only if the user select this specific condition
			$ctrl_settings['condition'] = [
				'eead_condition_key' => $condition_name,
			];

			$this->_conditional_repeater->add_control( $ctrl_key, $ctrl_settings );
		}
	}

	private function add_value_controls() {
		if (!$this->_conditions) {
			return;
		}

		foreach ($this->_conditions as $_condition) {
			$condition_name = $_condition->get_name();
			$ctrl_key = 'eead_condition_' . $condition_name . '_value';
			$ctrl_settings = $_condition->get_control_value();

			// Show this only if the user select this specific condition
			$ctrl_settings['condition'] = [
				'eead_condition_key' => $condition_name,
			];
			$this->_conditional_repeater->add_control($ctrl_key, $ctrl_settings);
		}
	}
}

VisibilityControls::instance();