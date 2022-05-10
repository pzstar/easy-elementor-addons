<?php 
namespace EEAD_Lite\Modules\HeaderFooterBuilder;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        $this->post_type(); 

        add_action('admin_menu', [$this, 'cpt_menu']);
        add_filter( 'single_template', [ $this, 'load_canvas_template' ] );
    }

    public function post_type() {

		$labels = array(
			'name'               => esc_html__( 'Templates', 'easy-elementor-addons' ),
			'singular_name'      => esc_html__( 'Template', 'easy-elementor-addons' ),
			'menu_name'          => esc_html__( 'Header Footer', 'easy-elementor-addons' ),
			'name_admin_bar'     => esc_html__( 'Header Footer', 'easy-elementor-addons' ),
			'add_new'            => esc_html__( 'Add New', 'easy-elementor-addons' ),
			'add_new_item'       => esc_html__( 'Add New Template', 'easy-elementor-addons' ),
			'new_item'           => esc_html__( 'New Template', 'easy-elementor-addons' ),
			'edit_item'          => esc_html__( 'Edit Template', 'easy-elementor-addons' ),
			'view_item'          => esc_html__( 'View Template', 'easy-elementor-addons' ),
			'all_items'          => esc_html__( 'All Templates', 'easy-elementor-addons' ),
			'search_items'       => esc_html__( 'Search Templates', 'easy-elementor-addons' ),
			'parent_item_colon'  => esc_html__( 'Parent Templates:', 'easy-elementor-addons' ),
			'not_found'          => esc_html__( 'No Templates found.', 'easy-elementor-addons' ),
			'not_found_in_trash' => esc_html__( 'No Templates found in Trash.', 'easy-elementor-addons' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'page',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'eead_template', $args );
    }

    public function cpt_menu(){
        $link_our_new_cpt = 'edit.php?post_type=eead_template';
        add_submenu_page('easy-elementor-addons', esc_html__('Header Footer', 'easy-elementor-addons'), esc_html__('Header Footer', 'easy-elementor-addons'), 'manage_options', $link_our_new_cpt);
    }

    function load_canvas_template( $single_template ) {

		global $post;

		if ( 'eead_template' == $post->post_type ) {

			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}
}

new Cpt();