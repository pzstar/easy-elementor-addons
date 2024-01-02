<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;

Class Tooltip {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/common/section_eead_tooltip_controls/before_section_end', [$this, 'register_controls'], 10, 2);

        // render scripts
        add_action('elementor/frontend/widget/before_render', [$this, 'should_script_enqueue']);
        add_action('elementor/preview/enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function register_controls($elems) {

        $elems->add_control(
            'eead_tltp_active', [
                'label' => esc_html__('Tooltip Effects', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'eead_tltp_select_type', [
                'label' => esc_html__('Element Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'widget',
                'options' => [
                    'widget' => esc_html__('Widget', 'easy-elementor-addons'),
                    'custom' => esc_html__('Widget > Custom Selector', 'easy-elementor-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'eead_tltp_custom_selector', [
                'label' => esc_html__('Custom Selector', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Please use ID or Class to select your element/elements. ( Example - #select-id, .select-class)', 'easy-elementor-addons'),
                'condition' => [
                    'eead_tltp_select_type' => 'custom',
                ],
            ]
        );

        $repeater->add_control(
            'eead_tltp_tooltip_text', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'This is Tooltip'
            ]
        );

        $repeater->add_control(
            'eead_tltp_type', [
                'label' => esc_html__('Select Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cora',
                'options' => [
                    'cora' => esc_html__('Cora', 'easy-elementor-addons'),
                    'smaug' => esc_html__('Smaug', 'easy-elementor-addons'),
                    'uldor' => esc_html__('uldor', 'easy-elementor-addons'),
                    'dori' => esc_html__('dori', 'easy-elementor-addons'),
                    'gram' => esc_html__('gram', 'easy-elementor-addons'),
                    'indis' => esc_html__('indis', 'easy-elementor-addons'),
                    'walda' => esc_html__('walda', 'easy-elementor-addons'),
                    'narvi' => esc_html__('narvi', 'easy-elementor-addons'),
                    'amras' => esc_html__('amras', 'easy-elementor-addons'),
                    'hador' => esc_html__('hador', 'easy-elementor-addons'),
                    'malva' => esc_html__('malva', 'easy-elementor-addons'),
                    'sadoc' => esc_html__('sadoc', 'easy-elementor-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'eead_tltp_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $elems->add_control(
            'eead_tltp_list', [
                'label' => esc_html__('Tooltip Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ eead_tltp_select_type }}}',
                'frontend_available' => true,
                'default' => [
                    [
                        'eead_tltp_select_type' => 'widget',
                    ],
                ],
                'condition' => [
                    'eead_tltp_active' => 'yes',
                ],
                'render_type' => 'template',
            ]
        );
    }

    public function register_section($element) {

        $element->start_controls_section(
            'section_eead_tooltip_controls', [
                'tab' => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__('Tooltip', 'easy-elementor-addons'),
            ]
        );

        $element->end_controls_section();
    }

    public function enqueue_scripts() {
        wp_enqueue_script('tltp-anime');
        wp_enqueue_script('charming');
        wp_enqueue_script('eead-tooltip');
    }

    public function should_script_enqueue($widget) {

        if ('yes' === $widget->get_settings_for_display('eead_tltp_active')) {
            $this->enqueue_scripts();
        }
    }
}

Tooltip::instance();
