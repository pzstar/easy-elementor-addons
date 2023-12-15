<?php

namespace Easy_Elementor_Addons\Includes;

use Easy_Elementor_Addons\Includes\Helper_Functions;
use Easy_Elementor_Addons\Admin\Includes\Admin_Helper;
use Easy_Elementor_Addons\Includes\Assets_Manager;
use Easy_Elementor_Addons\Includes\Premium_Template_Tags;

if (!defined('ABSPATH')) {
	exit();
}

class CP_Integration {
	private $cross_enabled = true;

	private static $instance = null;

	public function __construct() {

		if ($this->cross_enabled) {
			add_action('elementor/editor/before_enqueue_scripts', array($this, 'enqueue_editor_cp_scripts'), 99);
            require EEAD_PATH . 'inc/cross-domain-cp/eead-cross-cp.php';
		}

	}

	public function enqueue_editor_cp_scripts() {

		wp_enqueue_script('eead-xdlocalstorage-js', EEAD_URL . 'assets/js/xd-local-storage.js', null, EEAD_VERSION, true);
		wp_enqueue_script('eead-cross-cp', EEAD_URL . 'assets/js/eead-cross-cp.js', array('jquery', 'elementor-editor', 'eead-xdlocalstorage-js'), EEAD_VERSION, true);

		// Check for required Compatible Elementor version.
		$elementor_old = (!version_compare(ELEMENTOR_VERSION, '3.1.0', '>=')) ? true : false;

		wp_localize_script('jquery', 'eead_cross_cp', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('eead_cross_cp_import'),
			'elementorCompatible' => $elementor_old,
		]);
	}

	public static function get_instance() {

		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

new CP_Integration();