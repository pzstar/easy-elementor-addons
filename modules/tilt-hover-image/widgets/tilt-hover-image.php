<?php

namespace EasyElementorAddons\Modules\TiltHoverImage\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TiltHoverImage extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-tilt-hover-image';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Tilt Hover Image', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-element-icon eicon-image-rollover';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['tilt-anime', 'tilt'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'tilt_hover_effect_section',
            [
                'label' => esc_html__('Tilt Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => esc_html__('Helen Portland', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => esc_html__('Seattle', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'hover_style',
            [
                'label' => esc_html__('Hover Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    '2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    '3' => esc_html__('Style 3', 'easy-elementor-addons'),
                    '4' => esc_html__('Style 4', 'easy-elementor-addons'),
                    '5' => esc_html__('Style 5', 'easy-elementor-addons'),
                    '6' => esc_html__('Style 6', 'easy-elementor-addons'),
                    '7' => esc_html__('Style 7', 'easy-elementor-addons'),
                    '8' => esc_html__('Style 8', 'easy-elementor-addons')
                ],
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['image']['url'])) {
            return;
        }

        $hover_style = $settings['hover_style'];
        $tilter_style = $hover_style - 1;
        ?>

        <section class="content">
            <a href="#" class="eead-tilter eead-tilter--<?php echo esc_attr($hover_style); ?>" data-hoverstyle="<?php echo esc_attr($tilter_style); ?>">
                <figure class="eead-tilter__figure">
                    <img class="eead-tilter__image" src="<?php echo esc_url($settings['image']['url']); ?>" alt="img03" />
                    <div class="eead-tilter__deco eead-tilter__deco--shine">
                        <div></div>
                    </div>
                    <div class="eead-tilter__deco eead-tilter__deco--overlay"></div>

                    <figcaption class="eead-tilter__caption">
                        <h3 class="eead-tilter__title"><?php echo esc_attr($settings['title']); ?></h3>
                        <p class="eead-tilter__description"><?php echo esc_attr($settings['description']); ?></p>
                    </figcaption>

                    <?php if ($hover_style != 3): ?>
                        <svg class="eead-tilter__deco eead-tilter__deco--lines" viewBox="0 0 300 415">
                            <path d="M20.5,20.5h260v375h-260V20.5z" />
                        </svg>
                    <?php endif; ?>
                </figure>
            </a>
        </section>
        <?php
    }
}