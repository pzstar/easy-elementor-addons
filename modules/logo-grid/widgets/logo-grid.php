<?php

namespace EasyElementorAddons\Modules\LogoGrid\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class LogoGrid extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-logo-grid';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Logo Grid', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-apps';
    }

    public function get_keywords() {
        return [];
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_logo_grid',
            [
                'label' => esc_html__('Logo Grid', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('items_repeater');

        $repeater->start_controls_tab('tab_content', ['label' => esc_html__('Content', 'easy-elementor-addons')]);

        $repeater->add_control(
            'logo_image',
            [
                'label' => esc_html__('Upload Logo Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => 'https://www.your-link.com',
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_style', ['label' => esc_html__('Style', 'easy-elementor-addons')]);

        $repeater->add_control(
            'custom_style',
            [
                'label' => esc_html__('Custom Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Add custom styles which will affect only this item', 'easy-elementor-addons'),
                'default' => '',
                'label_on' => esc_html__('On', 'easy-elementor-addons'),
                'label_off' => esc_html__('Off', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'custom_logo_wrapper_bg',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.eead-logo-grid-item-custom' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'custom_logo_wrapper_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.eead-logo-grid-item-custom' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'custom_logo_border_width',
            [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.eead-logo-grid-item-custom' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'eead_logos',
            [
                'label' => esc_html__('Add Logos', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'logo_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'logo_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'logo_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Logo Image', 'easy-elementor-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'logo_grid_settings',
            [
                'label' => esc_html__('Settings', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__('H1', 'easy-elementor-addons'),
                    'h2' => esc_html__('H2', 'easy-elementor-addons'),
                    'h3' => esc_html__('H3', 'easy-elementor-addons'),
                    'h4' => esc_html__('H4', 'easy-elementor-addons'),
                    'h5' => esc_html__('H5', 'easy-elementor-addons'),
                    'h6' => esc_html__('H6', 'easy-elementor-addons'),
                    'div' => esc_html__('div', 'easy-elementor-addons'),
                    'span' => esc_html__('span', 'easy-elementor-addons'),
                    'p' => esc_html__('p', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'prefix_class' => 'elementor-grid%s-',
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'logos_spacing',
            [
                'label' => esc_html__('Logos Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => 10],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .eead-grid-item-wrap' => 'width: calc( ( 100% - (({{columns.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}} .eead-grid-item-wrap' => 'width: calc( ( 100% - (({{columns_tablet.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns_tablet.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .eead-grid-item-wrap' => 'width: calc( ( 100% - (({{columns_mobile.SIZE}} - 1) * {{SIZE}}{{UNIT}}) ) / {{columns_mobile.SIZE}} ); margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logos_vertical_align',
            [
                'label' => esc_html__('Vertical Align', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'top',
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'easy-elementor-addons'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-grid .eead-grid-item-wrap' => 'align-items: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
            ]
        );

        $this->add_control(
            'logos_horizontal_align',
            [
                'label' => esc_html__('Horizontal Align', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors_dictionary' => [
                    'left' => 'flex-start',
                    'center' => 'center',
                    'right' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-grid .eead-grid-item-wrap, {{WRAPPER}} .eead-logo-grid .eead-grid-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' => esc_html__('Image Size', 'easy-elementor-addons'),
                'default' => 'full',
            ]
        );

        $this->add_responsive_control(
            'logos_width',
            [
                'label' => esc_html__('Image Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Style */
        $this->start_controls_section(
            'section_logos_style',
            [
                'label' => esc_html__('Logos', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_logos_style');

        $this->start_controls_tab(
            'tab_logos_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'logo_bg',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'logo_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap',
            ]
        );

        $this->add_control(
            'logo_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item-wrap, {{WRAPPER}} .eead-grid-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'grayscale_normal',
            [
                'label' => esc_html__('Grayscale', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'opacity_normal',
            [
                'label' => esc_html__('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eead_logo_box_shadow_normal',
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_logos_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'logos_bg_hover',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['none', 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'logo_border_hover',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap:hover',
            ]
        );

        $this->add_responsive_control(
            'translate',
            [
                'label' => esc_html__('Slide', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -40,
                        'max' => 40,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item-wrap:hover' => 'transform:translateY({{SIZE}}{{UNIT}})',
                ],
            ]
        );

        $this->add_control(
            'grayscale_hover',
            [
                'label' => esc_html__('Grayscale', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => esc_html__('Yes', 'easy-elementor-addons'),
                'label_off' => esc_html__('No', 'easy-elementor-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label' => esc_html__('Opacity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-grid-item:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'eead_logo_box_shadow_hover',
                'selector' => '{{WRAPPER}} .eead-grid-item-wrap:hover',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_logo_title_style',
            [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-grid-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_spacing',
            [
                'label' => esc_html__('Margin Top', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-logo-grid-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-logo-grid-title',
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $count = 1;

        $this->add_render_attribute('logo-grid', 'class', 'eead-logo-grid eead-elementor-grid clearfix');

        if ($settings['grayscale_normal'] === 'yes') {
            $this->add_render_attribute('logo-grid', 'class', 'grayscale-normal');
        }

        if ($settings['grayscale_hover'] === 'yes') {
            $this->add_render_attribute('logo-grid', 'class', 'grayscale-hover');
        }
        ?>

        <div <?php echo $this->get_render_attribute_string('logo-grid'); ?>>
            <?php
            foreach ($settings['eead_logos'] as $item) {
                if (!empty($item['logo_image']['url'])) {

                    $this->add_render_attribute('logo-grid-item-wrap-' . $count, 'class', 'eead-grid-item-wrap');
                    $this->add_render_attribute('logo-grid-item-wrap-' . $count, 'class', 'elementor-repeater-item-' . esc_attr($item['_id']));

                    $this->add_render_attribute('logo-grid-item-' . $count, 'class', 'eead-grid-item');

                    if ($item['custom_style'] === 'yes') {
                        $this->add_render_attribute('logo-grid-item-wrap-' . $count, 'class', 'eead-logo-grid-item-custom');
                    }

                    $this->add_render_attribute('title' . $count, 'class', 'eead-logo-grid-title');
                    ?>
                    <div <?php echo $this->get_render_attribute_string('logo-grid-item-wrap-' . $count); ?>>
                        <div <?php echo $this->get_render_attribute_string('logo-grid-item-' . $count); ?>>
                            <?php
                            if (!empty($item['link']['url'])) {
                                $this->add_link_attributes('logo-link' . $count, $item['link']);
                                echo '<a ' . $this->get_render_attribute_string('logo-link' . $count) . '>';
                            }

                            $image_alt = esc_attr(Control_Media::get_image_alt($item['logo_image']));
                            $image_url = Group_Control_Image_Size::get_attachment_image_src($item['logo_image']['id'], 'image', $settings);

                            if (!$image_url) {
                                $image_url = $item['logo_image']['url'];
                            }

                            echo '<img src="' . $image_url . '" alt="' . esc_attr($image_alt) . '" />';

                            if (!empty($item['link']['url'])) {
                                echo '</a>';
                            }
                            ?>
                        </div>
                        <?php
                        if (!empty($item['title'])) {
                            printf('<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string('title' . $count));

                            if (!empty($item['link']['url'])) {
                                echo '<a ' . $this->get_render_attribute_string('logo-link' . $count) . '>';
                            }
                            echo $item['title'];

                            if (!empty($item['link']['url'])) {
                                echo '</a>';
                            }
                            printf('</%1$s>', $settings['title_html_tag']);
                        }
                        ?>
                    </div>
                    <?php
                }
                $count++;
            }
            ?>
        </div>
        <?php
    }

}
