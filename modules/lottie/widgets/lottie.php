<?php

namespace EasyElementorAddons\Modules\Lottie\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class Lottie extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
        wp_register_script( 'lottie', EEAD_URL . 'assets/lib/lottie/lottie.min.js', null, EEAD_VERSION, true );
        wp_register_script( 'lottie-init', EEAD_URL . 'assets/lib/lottie/lottie.init.js', ['lottie', 'elementor-frontend'], EEAD_VERSION, true );
    }

    public function get_script_depends() {
        return ['lottie', 'lottie-init'];
    }

    /** Widget Name */
    public function get_name() {
        return 'eead-lottie-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Lottie', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-skill-bar';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'eead_lottie', [
                'label' => esc_html__( 'Lottie', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_lottie_type', [
                'label'         => esc_html__( 'Select JSON', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'url',
                'options'       => [
                    'file'  => [
                        'title' => esc_html__( 'JSON File', 'easy-elementor-addons' ),
                        'icon' => 'eicon-document-file',
                    ],
                    'url'   => [
                        'title' => esc_html__( 'JSON URL', 'easy-elementor-addons' ),
                        'icon' => 'eicon-link',
                    ],
                ]
            ]
        );

        $this->add_control(
            'eead_lottie_json', [
                'show_label'    => false,
                'description'   => sprintf(
                    __('Discover thousands of %sLottie animations%s ready to use.', 'easy-elementor-addons'),
                    '<a href="https://lottiefiles.com/featured" target="_blank">',
                    '</a>'
                ),
                'type'          => Controls_Manager::MEDIA,
                'media_type'    => 'application/json',
                'condition'    => [
                    'eead_lottie_type'  => 'file',
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_url', [
                'show_label'    => false,
                'label_block'   => true,
                'description'   => sprintf(
                    __('Discover thousands of %sLottie animations%s ready to use.', 'easy-elementor-addons'),
                    '<a href="https://lottiefiles.com/featured" target="_blank">',
                    '</a>'
                ),
                'default' => 'https://assets6.lottiefiles.com/packages/lf20_sgnacf85.json',
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'https://example.com/file.json', 'easy-elementor-addons' ),
                'show_external' => false,
                'condition'     => [
                    'eead_lottie_type'  => 'url'
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_link_check', [
                'label'         => esc_html__( 'Link', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'eead_lottie_link', [
                'show_label'    => false,
                'type'          => Controls_Manager::URL,
                'condition'     => [
                    'eead_lottie_link_check'    => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        /* Animation Options */
        $this->start_controls_section(
            'eead_lottie_animation_options', [
                'label' => esc_html__( 'Animations', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );  

        $this->add_control(
            'eead_lottie_reverse', [
                'label'         => esc_html__( 'Reverse', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'eead_lottie_autoplay', [
                'label'         => esc_html__( 'Autoplay', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'eead_lottie_on_scroll', [
                'label'         => esc_html__( 'Start when visible', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'eead_lottie_autoplay'  => ''
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_loop', [
                'label'         => esc_html__( 'Loop', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'eead_lottie_loop_count', [
                'label'         => esc_html__( 'Loop Count', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'max'   => 10,
                    ]
                ],
                'condition'     => [
                    'eead_lottie_loop'  => 'true'
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_speed', [
                'label'         => esc_html__( 'Speed', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'max'   => 10,
                        'step'  => 0.2,
                    ]
                ],
                'default'       => [
                    'size'  => 1,
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_renderer', [
                'label'         => esc_html__( 'Render Type', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'svg',
                'options'       => [
                    'svg'           => [
                        'title' => esc_html__( 'SVG', 'easy-elementor-addons' ),
                        'icon'  => 'fa fa-magic',
                    ],
                    'canvas'        => [
                        'title' => esc_html__( 'Canvas', 'easy-elementor-addons' ),
                        'icon'  => 'fa fa-chalkboard',
                    ],
                ],
            ]
        );

        $this->add_control(
            'eead_lottie_action', [
                'label'         => esc_html__( 'On Hover', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    ''          => esc_html__( 'None', 'easy-elementor-addons' ),
                    'play'      => esc_html__( 'Play', 'easy-elementor-addons' ),
                    'pause'     => esc_html__( 'Pause', 'easy-elementor-addons' ),
                    'reverse'   => esc_html__( 'Reverse', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Lottie Style Settings
        $this->start_controls_section(
            'eead_lottie_styles', [
                'label' => esc_html__( 'Lottie', 'easy-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'eead_lottie_state'
        );

        $this->start_controls_tab(
            'eead_lottie_normal', [
                'label' => esc_html__( 'Normal', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_lottie_opacity', [
                'label'         => esc_html__( 'Opacity', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}}'   => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name'      => 'eead_lottie_filter',
                'selector'  => '{{WRAPPER}}',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'eead_lottie_hover', [
                'label' => esc_html__( 'Hover', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'eead_lottie_opacity_hover', [
                'label'         => esc_html__( 'Opacity', 'easy-elementor-addons' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}}:hover'   => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(), [
                'name'      => 'eead_lottie_filter_hover',
                'selector'  => '{{WRAPPER}}',
            ]
        );

        $this->add_control(
            'eead_lottie_transition', [
                'label' => esc_html__( 'Transition', 'easy-elementor-addons' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px'    => [
                        'max'   => 10,
                        'step'  => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}'   => 'transition: all {{SIZE}}s ease;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="eead-wid-con" >
            <?php
            $this->add_render_attribute( 'wrapper', [
                'id'                    => 'eead_lottie_' . $this->get_id(),
                'class'                 => 'eead_lottie',
                'data-autoplay'         => $settings['eead_lottie_autoplay'],
                'data-on-scroll'        => $settings['eead_lottie_on_scroll'],
                'data-speed'            => $settings['eead_lottie_speed']['size'],
                'data-direction'        => $settings['eead_lottie_reverse'],
                'data-action'           => $settings['eead_lottie_action'],
                'data-renderer'         => $settings['eead_lottie_renderer'],
            ]);

            if ( !empty($settings['eead_lottie_json']['url']) ){
                $this->add_render_attribute( 'wrapper', 'data-path', $settings['eead_lottie_json']['url'] );
            } else {
                $this->add_render_attribute( 'wrapper', 'data-path', $settings['eead_lottie_url'] );
            }

            if ( $settings['eead_lottie_loop_count']['size'] ) {
                $this->add_render_attribute( 'wrapper', 'data-loop', ($settings['eead_lottie_loop_count']['size'] - 1) );
            } else {
                $this->add_render_attribute( 'wrapper', 'data-loop', $settings['eead_lottie_loop'] );
            }

            if ( !empty($settings['eead_lottie_link']['url']) && $settings['eead_lottie_link']['url'] ) {
                $this->add_render_attribute( 'wrapper', 'class', 'met_d--block' );
                $this->add_link_attributes( 'link', $settings['eead_lottie_link'] );
                ?>
                <a <?php $this->print_render_attribute_string( 'link' ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                    &nbsp;
                </a>
                <?php
            } else { ?>
                <div <?php $this->print_render_attribute_string( 'wrapper' ) ?>>
                    &nbsp;
                </div>
            <?php } ?>
        </div>
        <?php
    }
}
