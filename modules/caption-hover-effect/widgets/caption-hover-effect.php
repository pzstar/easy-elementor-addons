<?php

namespace EasyElementorAddons\Modules\CaptionHoverEffect\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use DateTime;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Caption Hover Effect Widget
 */
class CaptionHoverEffect extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-caption-hover-effect';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Caption Hover Effect', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-click';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['modernizr-custom'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Caption Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Enter your title here', 'easy-elementor-addons'),
                'default' => esc_html__('Heading', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('Enter your content here', 'easy-elementor-addons'),
                'default' => esc_html__('Sub Heading', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'effect_style',
            [
                'label' => esc_html__('Hover Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cs-style-1',
                'options' => [
                    'cs-style-1' => esc_html__('Effect 1', 'easy-elementor-addons'),
                    'cs-style-2' => esc_html__('Effect 2', 'easy-elementor-addons'),
                    'cs-style-3' => esc_html__('Effect 3', 'easy-elementor-addons'),
                    'cs-style-4' => esc_html__('Effect 4', 'easy-elementor-addons'),
                    'cs-style-5' => esc_html__('Effect 5', 'easy-elementor-addons'),
                    'cs-style-6' => esc_html__('Effect 6', 'easy-elementor-addons'),
                    'cs-style-7' => esc_html__('Effect 7', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'margin_heading',
            [
                'label' => esc_html__('Margin Heading(%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cs-style-6 figcaption h3, {{WRAPPER}} .cs-style-7 figcaption h3' => 'margin-top : {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'effect_style' => array('cs-style-6', 'cs-style-7'),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Enter your button text here', 'easy-elementor-addons'),
                'default' => esc_html__('Click Here', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => 'https://your-link.com',
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'figcaption_color',
            [
                'label' => esc_html__('Figcaption Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ed4e6e',
                'selectors' => [
                    '{{WRAPPER}} .eead-caption-hover-effect figcaption' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'figcaption_bg_color',
            [
                'label' => esc_html__('Figcaption Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2c3f52',
                'selectors' => [
                    '{{WRAPPER}} .eead-caption-hover-effect figcaption' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'figcaption_heading_color',
            [
                'label' => esc_html__('Heading Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-caption-hover-effect figcaption h3' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'figcaption_button_text_color',
            [
                'label' => esc_html__('Button Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eead-caption-hover-effect figcaption a' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'figcaption_button_text_bg_color',
            [
                'label' => esc_html__('Button Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ed4e6e',
                'selectors' => [
                    '{{WRAPPER}} .eead-caption-hover-effect figcaption a' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_id = $settings['image']['id'];
        $title = $settings['title'];
        $content = $settings['content'];
        $button_text = $settings['button_text'];
        $button_link_url = $settings['button_link']['url'];
        $image_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
        if (!$image_url) {
            $image_url = Utils::get_placeholder_image_src();
        }
        $this->add_render_attribute('wrapper', 'class', $settings['effect_style']);
        $this->add_render_attribute('wrapper', 'class', 'eead-caption-hover-effect');
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <figure>
                <div>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                </div>

                <figcaption>
                    <h3><?php echo esc_html($title); ?></h3>

                    <span>
                        <?php echo esc_html($content); ?>
                    </span>

                    <a href="<?php echo esc_url($button_link_url); ?>">
                        <?php echo esc_html($button_text); ?>
                    </a>
                </figcaption>
            </figure>
        </div>
        <?php
    }
}
