<?php
namespace EasyElementorAddons\Modules\TextMarquee\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TextMarquee extends Widget_Base {

	public function get_name() {
		return 'eead-text-marquee';
	}

	public function get_title() {
		return esc_html__( 'Text Marquee', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

    public function get_script_depends() {
        return [ 'text-marquee' ];
    }

	protected function register_controls() {
        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'text', [
            'label' => __('Marquee Text', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Marquee'
                ]
        );

        $this->add_control(
            'text_speed', [
                'label' => __( 'Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
            ]
        );

        $this->add_control(
            'text_direction', [
                'label' => __( 'Direction', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __( 'Left', 'easy-elementor-addons' ),
                    'right'  => __( 'Right', 'easy-elementor-addons' ),
                    'up' => __( 'Up', 'easy-elementor-addons' ),
                    'down' => __( 'Down', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->add_control(
            'text_gap', [
                'label' => __( 'Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $this->add_control(
            'text_before_start', [
                'label' => __( 'Before Start', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $this->add_control(
                'text_duplicated', [
            'label' => __('Text Duplicated', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'text_pause_on_hover', [
            'label' => __('Pause on Hover', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'marquee_style', [
            'label' => esc_html__('Style', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'marquee_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-text-marquee' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'marquee_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-text-marquee',
                ]
        );

        $this->add_control(
                'text_stroke_effect', [
            'label' => __('Text Stroke Effect', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'text_stroke_width', [
            'label' => esc_html__('Text Stroke Width', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'default' => [
                'size' => 1,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-text-marquee.eead-text-stroke-effect' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}',
            ],
                ]
        );

        $this->end_controls_section();
	}

	/** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'eead-text-marquee');

        $this->add_render_attribute('wrapper', [
                'data-speed' => $settings['text_speed']['size'],
                'data-direction' => $settings['text_direction'],
                'data-gap' => $settings['text_gap']['size'],
                'data-delayBeforeStart' => $settings['text_before_start']['size'],
                'data-duplicated' => $settings['text_duplicated'] == 'yes' ? 'true' : 'false',
                'data-pauseOnHover' => $settings['text_pause_on_hover'] == 'yes' ? 'true' : 'false'
        ]);

        if($settings['text_stroke_effect'] == 'yes'){
            $this->add_render_attribute('wrapper', 'class', 'eead-text-stroke-effect');
        }
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>><?php echo esc_html($settings['text']); ?></div>
        <?php
    }

}
