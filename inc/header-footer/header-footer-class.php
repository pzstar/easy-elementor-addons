<?php
namespace EasyElementorAddons;

defined( 'ABSPATH' ) || exit;

class HeaderFooter {

	public $dir;
	public $url;

    public function __construct(){

        // get current directory path
        $this->dir = dirname(__FILE__) . '/';

        // get current module's url
		$this->url = \EEAD::plugin_url() . 'modules/header-footer/';
		
		// enqueue scripts
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_styles'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

		// include all necessary files
		$this->include_files();
		add_action('admin_footer', [$this, 'modal_view']);

		Cpt_Hooks::instance();
		Activator::instance();
	}
	
	public function include_files(){
		include_once $this->dir . 'cpt.php';
		include_once $this->dir . 'cpt-api.php';
	}

	public function modal_view(){
		$screen = get_current_screen();
		if($screen->id == 'edit-eead_template'){
			include_once $this->dir . 'views/modal-editor.php';
		}
	}

	public function enqueue_styles() {
		$screen = get_current_screen();
		if($screen->id == 'edit-eead_template'){
			wp_enqueue_style( 'select2', $this->url . 'assets/css/select2.min.css', false, \EEAD::version() );
			wp_enqueue_style( 'eead-menu-admin-style', $this->url . 'assets/css/admin-style.css', false, \EEAD::version() );
		}
	}

	public function enqueue_scripts(){
		$screen = get_current_screen();
		if($screen->id == 'edit-eead_template'){
			wp_enqueue_script( 'eead-menu-admin-script-defer', $this->url . 'assets/js/eead-menu-admin.js', array( 'jquery'), true, \EEAD::version() );
		}
	}
}