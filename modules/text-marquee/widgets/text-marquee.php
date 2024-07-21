<?php
namespace EasyElementorAddons\Modules\TextMarquee\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TextMarquee extends Widget_Base {

    public function get_name() {
        return 'eead-text-marquee';
    }

    public function get_title() {
        return esc_html__('Text Marquee', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['text-marquee'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Marquee Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Marquee'
            ]
        );

        $this->add_control(
            'text_speed',
            [
                'label' => esc_html__('Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'text_direction',
            [
                'label' => esc_html__('Direction', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'text_gap',
            [
                'label' => esc_html__('Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'text_before_start',
            [
                'label' => esc_html__('Before Start', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'text_duplicated',
            [
                'label' => esc_html__('Text Duplicated', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'text_pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'marquee_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'marquee_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-text-marquee' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'marquee_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-text-marquee',
            ]
        );

        $this->add_control(
            'text_stroke_effect',
            [
                'label' => esc_html__('Text Stroke Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'text_stroke_width',
            [
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

        $this->add_render_attribute('wrapper', [
            'class' => 'eead-text-marquee',
            'data-speed' => $settings['text_speed']['size'],
            'data-direction' => $settings['text_direction'],
            'data-gap' => $settings['text_gap']['size'],
            'data-delayBeforeStart' => $settings['text_before_start']['size'],
            'data-duplicated' => $settings['text_duplicated'] == 'yes' ? 'true' : 'false',
            'data-pauseOnHover' => $settings['text_pause_on_hover'] == 'yes' ? 'true' : 'false'
        ]);

        if ($settings['text_stroke_effect'] == 'yes') {
            $this->add_render_attribute('wrapper', 'class', 'eead-text-stroke-effect');
        }
        ?>

        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <?php echo esc_html($settings['text']); ?>
        </div>
        <?php
    }

}
