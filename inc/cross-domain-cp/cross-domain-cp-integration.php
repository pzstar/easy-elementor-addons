<?php
/**
 * Cross Domain Integration.
 */

namespace Easy_Elementor_Addons\Includes;

use Easy_Elementor_Addons\Includes\Helper_Functions;
use Easy_Elementor_Addons\Admin\Includes\Admin_Helper;
use Easy_Elementor_Addons\Includes\Assets_Manager;
use Easy_Elementor_Addons\Includes\Premium_Template_Tags;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Class CP_Integration.
 */
class CP_Integration {

	/**
	 * Class instance
	 *
	 * @var instance
	 */
	private static $instance = null;

	/**
	 * Initialize integration hooks
	 *
	 * @return void
	 */
	public function __construct() {

		// $cross_enabled = isset( self::$modules['eead-cross-domain'] ) ? self::$modules['eead-cross-domain'] : 1;
		$cross_enabled = 1;

		if ( $cross_enabled ) {
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_editor_cp_scripts' ), 99 );
            require EEAD_PATH . 'inc/cross-domain-cp/eead-cross-cp.php';
		}

	}

	/**
	 * Load Cross Domain Copy Paste JS Files.
	 *
	 * @since 3.21.1
	 */
	public function enqueue_editor_cp_scripts() {

		wp_enqueue_script(
			'eead-xdlocalstorage-js',
			EEAD_URL . 'assets/js/xd-local-storage.js',
			null,
			EEAD_VERSION,
			true
		);

		wp_enqueue_script(
			'eead-cross-cp',
			EEAD_URL . 'assets/js/eead-cross-cp.js',
			array( 'jquery', 'elementor-editor', 'eead-xdlocalstorage-js' ),
			EEAD_VERSION,
			true
		);

		// Check for required Compatible Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, '3.1.0', '>=' ) ) {
			$elementor_old = true;
		} else {
			$elementor_old = false;
		}

		wp_localize_script(
			'jquery',
			'eead_cross_cp',
			array(
				'ajax_url'            => admin_url( 'admin-ajax.php' ),
				'nonce'               => wp_create_nonce( 'eead_cross_cp_import' ),
				'elementorCompatible' => $elementor_old,
			)
		);
	}

	/**
	 *
	 * Creates and returns an instance of the class
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return object
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

new CP_Integration();