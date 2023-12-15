<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;

Class BackdropEffect {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/element/column/section_style/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/element/common/_section_background/before_section_end', [$this, 'register_controls'], 10, 2);
    }

    public function register_controls($elems) {
        $elems->add_control(
            'eead_backdrop_filter', [
                'label' => __('Backdrop Filter', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'separator' => 'before',
                'prefix_class' => 'eead-backdrop-filter-',
            ]
        );

        $elems->start_popover();

        $elems->add_control(
            'eead_bf_blur', [
                'label' => _x('Blur', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 25,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-blur: {{SIZE}}px;'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_brightness', [
                'label' => _x('Brightness', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'ui',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 10,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-brightness: {{SIZE}}%;'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_contrast', [
                'label' => _x('Contrast', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-contrast: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_grayscale', [
                'label' => _x('Grayscale', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-grayscale: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_invert', [
                'label' => _x('Invert', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-invert: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_opacity', [
                'label' => _x('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-opacity: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_sepia', [
                'label' => _x('Sepia', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-sepia: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_saturate', [
                'label' => _x('Saturate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-saturate: {{SIZE}};'
                ],
            ]
        );

        $elems->add_control(
            'eead_bf_hue_rotate', [
                'label' => _x('Hue Rotate', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'eead_backdrop_filter' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--eead-backdrop-filter-hue-rotate: {{SIZE}}deg;'
                ],
            ]
        );

        $elems->end_popover();

        $elems->add_control(
            'ep_backdrop_filter_notice', [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => sprintf(__( 'This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'easy-elementor-addons' ), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
            ]
        );
    }
}

BackdropEffect::instance();