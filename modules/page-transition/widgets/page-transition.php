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

		$this->add_control(
            'page_transition', [
                'label'   => esc_html__( 'Page Transition', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '',
                'options' => [
                    '1' => esc_html__( 'Move to left/ from right', 'easy-elementor-addons' ),
                    '2' => esc_html__( 'Move to right/ from left', 'easy-elementor-addons' ),
                    '3' => esc_html__( 'Move to top/ from bottom', 'easy-elementor-addons' ),
                    '4' => esc_html__( 'Move to bottom/ from top', 'easy-elementor-addons' ),
                    '5' => esc_html__( 'Fade / from right', 'easy-elementor-addons' ),
                    '6' => esc_html__( 'Fade / from left', 'easy-elementor-addons' ),
                    '7' => esc_html__( 'Fade / from bottom', 'easy-elementor-addons' ),
                    '8' => esc_html__( 'Fade / from top', 'easy-elementor-addons' ),
                    '9' => esc_html__( 'Fade left / Fade right', 'easy-elementor-addons' ),
                    '10' => esc_html__( 'Fade right / Fade left', 'easy-elementor-addons' ),
                    '11' => esc_html__( 'Fade top / Fade bottom', 'easy-elementor-addons' ),
                    '12' => esc_html__( 'Fade bottom / Fade top', 'easy-elementor-addons' ),
                    '13' => esc_html__( 'Different easing / from right', 'easy-elementor-addons' ),
                    '14' => esc_html__( 'Different easing / from left', 'easy-elementor-addons' ),
                    '15' => esc_html__( 'Different easing / from bottom', 'easy-elementor-addons' ),
                    '16' => esc_html__( 'Different easing / from top', 'easy-elementor-addons' ),
                    '17' => esc_html__( 'Scale down / from right', 'easy-elementor-addons' ),
                    '18' => esc_html__( 'Scale down / from left', 'easy-elementor-addons' ),
                    '19' => esc_html__( 'Scale down / from bottom', 'easy-elementor-addons' ),
                    '20' => esc_html__( 'Scale down / from top', 'easy-elementor-addons' ),
                    '21' => esc_html__( 'Scale down / scale down', 'easy-elementor-addons' ),
                    '22' => esc_html__( 'Scale up / scale up', 'easy-elementor-addons' ),
                    '23' => esc_html__( 'Move to left / scale up', 'easy-elementor-addons' ),
                    '24' => esc_html__( 'Move to right / scale up', 'easy-elementor-addons' ),
                    '25' => esc_html__( 'Move to top / scale up', 'easy-elementor-addons' ),
                    '26' => esc_html__( 'Move to bottom / scale up', 'easy-elementor-addons' ),
                    '27' => esc_html__( 'Scale down / scale up', 'easy-elementor-addons' ),
                    '28' => esc_html__( 'Glue left / from right', 'easy-elementor-addons' ),
                    '29' => esc_html__( 'Glue right / from left', 'easy-elementor-addons' ),
                    '30' => esc_html__( 'Glue bottom / from top', 'easy-elementor-addons' ),
                    '31' => esc_html__( 'Glue top / from bottom', 'easy-elementor-addons' ),
                    '32' => esc_html__( 'Flip right', 'easy-elementor-addons' ),
                    '33' => esc_html__( 'Flip left', 'easy-elementor-addons' ),
                    '34' => esc_html__( 'Flip top', 'easy-elementor-addons' ),
                    '35' => esc_html__( 'Flip bottom', 'easy-elementor-addons' ),
                    '36' => esc_html__( 'Fall', 'easy-elementor-addons' ),
                    '37' => esc_html__( 'Newspaper', 'easy-elementor-addons' ),
                    '38' => esc_html__( 'Push left / from right', 'easy-elementor-addons' ),
                    '39' => esc_html__( 'Push right / from left', 'easy-elementor-addons' ),
                    '40' => esc_html__( 'Push top / from bottom', 'easy-elementor-addons' ),
                    '41' => esc_html__( 'Push bottom / from top', 'easy-elementor-addons' ),
                    '42' => esc_html__( 'Push left / pull right', 'easy-elementor-addons' ),
                    '43' => esc_html__( 'Push right / pull left', 'easy-elementor-addons' ),
                    '44' => esc_html__( 'Push top / pull bottom', 'easy-elementor-addons' ),
                    '45' => esc_html__( 'Push bottom / pull top', 'easy-elementor-addons' ),
                    '46' => esc_html__( 'Fold left / from right', 'easy-elementor-addons' ),
                    '47' => esc_html__( 'Fold right / from left', 'easy-elementor-addons' ),
                    '48' => esc_html__( 'Fold top / from bottom', 'easy-elementor-addons' ),
                    '49' => esc_html__( 'Fold bottom / from top', 'easy-elementor-addons' ),
                    '50' => esc_html__( 'Move to right / unfold left', 'easy-elementor-addons' ),
                    '51' => esc_html__( 'Move to left / unfold right', 'easy-elementor-addons' ),
                    '52' => esc_html__( 'Move to bottom / unfold top', 'easy-elementor-addons' ),
                    '53' => esc_html__( 'Move to top / unfold bottom', 'easy-elementor-addons' ),
                    '54' => esc_html__( 'Room to left', 'easy-elementor-addons' ),
                    '55' => esc_html__( 'Room to right', 'easy-elementor-addons' ),
                    '56' => esc_html__( 'Room to top', 'easy-elementor-addons' ),
                    '57' => esc_html__( 'Room to bottom', 'easy-elementor-addons' ),
                    '58' => esc_html__( 'Cube to left', 'easy-elementor-addons' ),
                    '59' => esc_html__( 'Cube to right', 'easy-elementor-addons' ),
                    '60' => esc_html__( 'Cube to top', 'easy-elementor-addons' ),
                    '61' => esc_html__( 'Cube to bottom', 'easy-elementor-addons' ),
                    '62' => esc_html__( 'Carousel to left', 'easy-elementor-addons' ),
                    '63' => esc_html__( 'Carousel to right', 'easy-elementor-addons' ),
                    '64' => esc_html__( 'Carousel to top', 'easy-elementor-addons' ),
                    '65' => esc_html__( 'Carousel to bottom', 'easy-elementor-addons' ),
                ]
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
