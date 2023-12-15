<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

Class Notation {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/common/section_eead_notation_controls/before_section_end', [$this, 'register_controls'], 10, 2);

        // render scripts
        add_action('elementor/frontend/widget/before_render', [$this, 'should_script_enqueue']);
        add_action('elementor/preview/enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function register_controls($elems) {

        $elems->add_control(
            'eead_notation_active', [
                'label' => __('Notation Effects', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'eead_notation_select_type', [
                'label' => __('Element Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'widget',
                'options' => [
                    'widget' => __('Widget', 'easy-elementor-addons'),
                    'custom' => __('Widget > Custom Selector', 'easy-elementor-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'eead_notation_custom_selector', [
                'label' => __('Custom Selector', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Please use ID or Class to select your element/elements. ( Example - #select-id, .select-class)', 'easy-elementor-addons'),
                'condition' => [
                    'eead_notation_select_type' => 'custom',
                ],
            ]
        );

        $repeater->add_control(
            'eead_notation_type', [
                'label' => __('Select Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'underline',
                'options' => [
                    'underline' => __('Underline', 'easy-elementor-addons'),
                    'box' => __('Box', 'easy-elementor-addons'),
                    'circle' => __('Circle', 'easy-elementor-addons'),
                    'highlight' => __('Highlight', 'easy-elementor-addons'),
                    'strike-through' => __('Strike-through', 'easy-elementor-addons'),
                    'crossed-off' => __('Crossed-off', 'easy-elementor-addons'),
                    'bracket' => __('Bracket', 'easy-elementor-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'eead_notation_bracket_on', [
                'label' => __('Bracket On', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Value could be a string. Each string being one of these values: left, right, top, bottom. When drawing a bracket, this configures which side(s) of the element to bracket. Default value is left,right', 'easy-elementor-addons'),
                'default' => 'left,right',
                'condition' => [
                    'eead_notation_type' => 'bracket',
                ],
            ]
        );

        $repeater->add_control(
            'eead_notation_color', [
                'label' => __('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'eead_notation_anim_duration', [
                'label' => __('Animation Duration', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800,
                ],
            ]
        );

        $repeater->add_control(
            'eead_notation_stroke_width', [
                'label' => __('Stroke Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
            ]
        );

        $elems->add_control(
            'eead_notation_list', [
                'label' => __('Notation Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ eead_notation_select_type }}}',
                'frontend_available' => true,
                'default' => [
                    [
                        'eead_notation_select_type' => 'widget',
                    ],
                ],
                'condition' => [
                    'eead_notation_active' => 'yes',
                ],
                'render_type' => 'template',
            ]
        );
    }

    public function register_section($element) {
        $element->start_controls_section(
            'section_eead_notation_controls', [
                'tab' => Controls_Manager::TAB_CONTENT,
                'label' => __('Notation', 'easy-elementor-addons'),
            ]
        );
        $element->end_controls_section();
    }

    public function enqueue_scripts() {
        wp_enqueue_script('eead-notation');
    }

    public function should_script_enqueue($widget) {
        if ('yes' === $widget->get_settings_for_display('eead_notation_active')) {
            $this->enqueue_scripts();
        }
    }
}

Notation::instance();
