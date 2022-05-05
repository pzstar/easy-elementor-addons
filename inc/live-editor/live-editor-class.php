<?php
/**
 * Addons Integration.
 */
namespace EasyElementorAddons\Includes;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Class EEAD_Live_Editor.
 */
class EEAD_Live_Editor {

	private static $instance = null;
	private static $modules = null;
	protected $template_instance;
	public $cdn_url;

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'load_live_editor_modal' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'live_editor_enqueue' ) );
		add_action( 'wp_ajax_handle_live_editor', array( $this, 'handle_live_editor' ) );
		add_action( 'wp_ajax_check_temp_validity', array( $this, 'check_temp_validity' ) );
		add_action( 'wp_ajax_update_template_title', array( $this, 'update_template_title' ) );
		add_action( 'wp_ajax_get_elementor_template_content', array( $this, 'get_template_content' ) );
	}

	/**
	 * Live Editor Enqueue.
	 *
	 * @access public
	 * @since 4.8.10
	 */
	public function live_editor_enqueue() {
		wp_enqueue_script('live-editor-js', EEAD_URL . 'assets/js/live-editor.js', ['jquery'], EEAD_VERSION, true);
		$live_editor_data = array(
			'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			'nonce'   => wp_create_nonce( 'eead-live-editor' ),
		);
		wp_localize_script( 'live-editor-js', 'liveEditor', $live_editor_data );
	}

	/**
	 * Update Template Title.
	 *
	 * @access public
	 * @since 4.8.10
	 */
	public function update_template_title() {
		check_ajax_referer( 'eead-live-editor', 'security' );
		if ( ! isset( $_POST['title'] ) || ! isset( $_POST['id'] ) ) {
			wp_send_json_error();
		}
		$res = wp_update_post(
			array(
				'ID'         => sanitize_text_field( wp_unslash( $_POST['id'] ) ),
				'post_title' => sanitize_text_field( wp_unslash( $_POST['title'] ) ),
			)
		);
		wp_send_json_success( $res );
	}

	/**
	 * Check Temp Validity.
	 * Checks if the template is valid ( has content) or not,
	 * And DELETE the post if it's invalid.
	 *
	 * @access public
	 * @since 4.9.1
	 */
	public function check_temp_validity() {
		check_ajax_referer( 'eead-live-editor', 'security' );
		if ( ! isset( $_POST['templateID'] ) ) {
			wp_send_json_error( 'template ID is not set' );
		}

		$temp_id = sanitize_text_field( wp_unslash( $_POST['templateID'] ) );
		$template_content = get_el_template_content( $temp_id, true );

		if ( empty( $template_content ) || ! isset( $template_content ) ) {
			$res = wp_delete_post( $temp_id, true );
			if ( ! is_wp_error( $res ) ) {
				$res = 'Template Deleted.';
			}
		} else {
			$res = 'Template Has Content.';
		}
		wp_send_json_success( $res );
	}

	/**
	 * Handle Live Editor Modal.
	 *
	 * @access public
	 * @since 4.8.10
	 */
	public function handle_live_editor() {
		check_ajax_referer( 'eead-live-editor', 'security' );

		if ( ! isset( $_POST['key'] ) ) {
			wp_send_json_error();
		}

		$post_name  = 'eead-dynamic-temp-' . sanitize_text_field( wp_unslash( $_POST['key'] ) );
		$post_title = '';
		$args       = array(
			'post_type'              => 'elementor_library',
			'name'                   => $post_name,
			'post_status'            => 'publish',
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'posts_per_page'         => 1,
		);

		$post = get_posts( $args );
		if ( empty( $post ) ) { // create a new one.
			$key        = sanitize_text_field( wp_unslash( $_POST['key'] ) );
			$post_title = 'EEAD Template | #' . substr( md5( $key ), 0, 4 );
			$params = array(
				'post_content' => '',
				'post_type'    => 'elementor_library',
				'post_title'   => $post_title,
				'post_name'    => $post_name,
				'post_status'  => 'publish',
				'meta_input'   => array(
					'_elementor_edit_mode'     => 'builder',
					'_elementor_template_type' => 'page',
					'_wp_page_template'        => 'elementor_canvas',
				),
			);
			$post_id = wp_insert_post( $params );
		} else { // edit post.
			$post_id    = $post[0]->ID;
			$post_title = $post[0]->post_title;
		}
		$edit_url = get_admin_url() . '/post.php?post=' . $post_id . '&action=elementor';
		$result = array(
			'url'   => $edit_url,
			'id'    => $post_id,
			'title' => $post_title,
		);
		wp_send_json_success( $result );
	}

	/**
	 * Load Live Editor Modal.
	 * Puts live editor popup html into the editor.
	 *
	 * @access public
	 * @since 4.8.10
	 */
	public function load_live_editor_modal() {
		ob_start();
		include_once EEAD_PATH . 'inc/live-editor/live-editor-modal.php';
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}

	/**
	 * Get Template Content
	 *
	 * Get Elementor template HTML content.
	 *
	 * @since 3.2.6
	 * @access public
	 */
	public function get_template_content() {
		$template = isset( $_GET['templateID'] ) ? sanitize_text_field( wp_unslash( $_GET['templateID'] ) ) : '';
		if ( empty( $template ) ) {
			wp_send_json_error( '' );
		}
		$template_content = get_el_template_content( $template );
		if ( empty( $template_content ) || ! isset( $template_content ) ) {
			wp_send_json_error( '' );
		}
		$data = array(
			'template_content' => $template_content,
		);
		wp_send_json_success( $data );
	}

	/**
	 * Get Elementor Template HTML Content
	 *
	 * @since 3.6.0
	 * @access public
	 *
	 * @param string|int $title   Template Title||id.
	 * @param bool   $id          indicates if $title is the template title or id.
	 *
	 * @return $template_content string HTML Markup of the selected template.
	 */
	public function get_el_template_content( $title, $id = false ) {
		$frontend = Plugin::$instance->frontend;
		if ( ! $id ) {
			$id = $this->get_id_by_title( $title );

			$id = apply_filters( 'wpml_object_id', $id, 'elementor_library', true );
		} else {
			$id = $title;
		}
		$template_content = $frontend->get_builder_content_for_display( $id, true );
		return $template_content;
	}
}

new EEAD_Live_Editor();