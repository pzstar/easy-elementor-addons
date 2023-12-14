<?php

namespace EasyElementorAddons\Modules\AnimatedIcon\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Animated Icon Widget
 */
class AnimatedIcon extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-animated-icon';
    }

    /** Widget Title */
    public function get_title() {
        return __('Animated Icon', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['lordicon'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'eead_general', [
                'label' => __('General', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eead_type', [
                'label' => __('Select JSON', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'url',
                'options' => [
                    'file' => [
                        'title' => __('JSON File', 'easy-elementor-addons'),
                        'icon' => 'eicon-document-file',
                    ],
                    'url' => [
                        'title' => __('JSON URL', 'easy-elementor-addons'),
                        'icon' => 'eicon-link',
                    ],
                ]
            ]
        );

        $this->add_control(
            'eead_json', [
                'show_label' => false,
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'application/json',
                'description' => sprintf(
                    __('Discover thousands of %sLordicon animations%s ready to use.', 'easy-elementor-addons'),
                    '<a href="https://lordicon.com/" target="_blank">',
                    '</a>'
                ),
                'condition' => [
                    'eead_type' => 'file',
                ],
            ]
        );

        $this->add_control(
            'eead_url', [
                'show_label' => false,
                'label_block' => true,
                'description' => sprintf(__('Discover thousands of %sLordicon animations%s ready to use.', 'easy-elementor-addons'), '<a href="https://lordicon.com/" target="_blank">', '</a>'),
                'default' => 'https://cdn.lordicon.com/gmzxduhd.json',
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('https://example.com/file.json', 'easy-elementor-addons'),
                'show_external' => false,
                'condition' => [
                    'eead_type' => 'url'
                ],
            ]
        );

        $this->add_control(
            'eead_animation_trigger', [
                'label' => __('Animation Trigger', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'loop',
                'description' => __('Method that makes the icon animate', 'easy-elementor-addons'),
                'options' => [
                    'loop' => __('Loop(always animate)', 'easy-elementor-addons'),
                    'click' => __('Click', 'easy-elementor-addons'),
                    'hover' => __('Hover', 'easy-elementor-addons'),
                    'loop-on-hover' => __('Loop on Hover', 'easy-elementor-addons'),
                    'morph' => __('Morph', 'easy-elementor-addons'),
                    'morph-two-way' => __('Morph Two Way', 'easy-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'eead_animation_target', [
                'label' => __('Target', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('For loop on hover and click'),
                'default' => 'icon',
                'options' => [
                    'widget' => __('On Widget', 'easy-elementor-addons'),
                    'icon' => __('On Icon', 'easy-elementor-addons'),
                    'column' => __('On Column', 'easy-elementor-addons'),
                    'section' => __('On Section', 'easy-elementor-addons'),
                    'custom' => __('Custom', 'easy-elementor-addons')
                ],
            ]
        );

        $this->add_control(
            'eead_custom_target', [
                'label' => __('Custom Target', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => __('.example', 'easy-elementor-addons'),
                'condition' => [
                    'eead_animation_target' => 'custom'
                ],
            ]
        );

        $this->add_control(
            'eead_icon_link', [
                'label' => __('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'easy-elementor-addons'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_icon_styles', [
                'label' => __('Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'eead_icon_size', [
                'label' => __('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 72,
                ],
                'tablet_default' => [
                    'size' => 72,
                ],
                'mobile_default' => [
                    'size' => 72,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} lord-icon' => 'height:{{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_control(
            'eead_color_one', [
                'label' => __('Color One', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'eead_color_two', [
                'label' => __('Color Two', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'eead_icon_stroke', [
                'label' => __('Stroke', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'description' => 'Thickness of the illustrated line',
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="eead-lord-icon-wrapper " id="uc_lord_icon_elementor14674">
            <?php
            if ($settings['eead_type'] == 'file') {
                $icon_url = !empty($settings['eead_json']['url']) ? $settings['eead_json']['url'] : '';

            } else if ($settings['eead_type'] == 'url') {
                $icon_url = !empty($settings['eead_url']) ? $settings['eead_url'] : '';
            }

            ?>
            <a href="<?php echo esc_url($settings['eead_icon_link']['url']) ?>">
                <div>
                    <lord-icon src="<?php echo esc_url($icon_url) ?>" trigger="<?php echo esc_attr($settings['eead_animation_trigger']) ?>" target="<?php echo esc_attr($settings['eead_animation_target']) ?>" stroke="<?php echo esc_attr($settings['eead_icon_stroke']['size']) ?>" colors="primary:<?php echo esc_attr($settings['eead_color_one']) ?>,secondary:<?php echo esc_attr($settings['eead_color_two']) ?>">
                    </lord-icon>
                </div>
            </a>
        </div>
        <?php
    }
}