<?php
namespace EasyElementorAddons\Modules\PageTransition\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PageTransition extends Widget_Base {

	public function get_name() {
		return 'eead-page-transition';
	}

	public function get_title() {
		return esc_html__( 'Page Transition', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-navigation-vertical';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'section_nav_dots', [
				'label' => __( 'Content', 'easy-elementor-addons' ),
			]
		);
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		?>
		<div id="pt-main" class="pt-perspective">
			<div class="pt-page pt-page-1"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
			<div class="pt-page pt-page-2"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
			<div class="pt-page pt-page-3"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
			<div class="pt-page pt-page-4"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
			<div class="pt-page pt-page-5"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
			<div class="pt-page pt-page-6"><h1><span>A collection of</span><strong>Page</strong> Transitions</h1></div>
		</div>
		<?php
		}
	}
}
