<?php

namespace EasyElementorAddons\Modules\IconList\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class IconList extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-icon-list';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Icon List', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eead-listing';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('List', 'easy-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => esc_html__('List Item #1', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => array(
                    'none' => array(
                        'title' => esc_html__('None', 'easy-elementor-addons'),
                        'icon' => 'fa fa-ban',
                    ),
                    'icon' => array(
                        'title' => esc_html__('Icon', 'easy-elementor-addons'),
                        'icon' => 'eicon-star',
                    ),
                    'image' => array(
                        'title' => esc_html__('Image', 'easy-elementor-addons'),
                        'icon' => 'eicon-image',
                    ),
                    'number' => array(
                        'title' => esc_html__('Number', 'easy-elementor-addons'),
                        'icon' => 'fa fa-hashtag',
                    ),
                ),
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => array(
                    'value' => 'fa fa-check',
                    'library' => 'fa-solid',
                ),
                'condition' => array(
                    'icon_type' => 'icon',
                ),
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::MEDIA,
                'dynamic' => array(
                    'active' => true,
                ),
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
                'condition' => array(
                    'icon_type' => 'image',
                ),
            ]
        );

        $repeater->add_control(
            'icon_text',
            [
                'label' => esc_html__('Number/Text', 'easy-elementor-addons'),
                'label_block' => false,
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => array(
                    'icon_type' => 'number',
                ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => array(
                    'active' => true,
                ),
                'placeholder' => esc_html__('http://your-link.com', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => array(
                    array(
                        'text' => esc_html__('List Item #1', 'easy-elementor-addons'),
                        'icon' => esc_html__('fa fa-check', 'easy-elementor-addons'),
                    ),
                    array(
                        'text' => esc_html__('List Item #2', 'easy-elementor-addons'),
                        'icon' => esc_html__('fa fa-check', 'easy-elementor-addons'),
                    ),
                    array(
                        'text' => esc_html__('List Item #3', 'easy-elementor-addons'),
                        'icon' => esc_html__('fa fa-check', 'easy-elementor-addons'),
                    ),
                ),
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{icon}}" aria-hidden="true"></i> {{{text}}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'label' => esc_html__('Image Size', 'easy-elementor-addons'),
                'default' => 'full',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_list_style',
            [
                'label' => esc_html__('List', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'traditional',
                'options' => [
                    'traditional' => [
                        'title' => esc_html__('Default', 'easy-elementor-addons'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__('Inline', 'easy-elementor-addons'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'render_type' => 'template',
                'prefix_class' => 'eead-icon-list-',
                'label_block' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'items_background',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-list-items li',
            ]
        );

        $this->add_responsive_control(
            'items_spacing',
            [
                'label' => esc_html__('List Items Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items:not(.eead-inline-items) li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-list-items.eead-inline-items li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_items_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_items_alignment',
            [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}.eead-icon-list-traditional .eead-list-items li, {{WRAPPER}}.eead-icon-list-inline .eead-list-items' => 'justify-content: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left' => 'flex-start',
                    'right' => 'flex-end',
                ],
            ]
        );

        $this->add_control(
            'divider',
            [
                'label' => esc_html__('Divider', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'easy-elementor-addons'),
                'label_on' => esc_html__('On', 'easy-elementor-addons'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => esc_html__('Solid', 'easy-elementor-addons'),
                    'double' => esc_html__('Double', 'easy-elementor-addons'),
                    'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
                    'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
                    'groove' => esc_html__('Groove', 'easy-elementor-addons'),
                    'ridge' => esc_html__('Ridge', 'easy-elementor-addons'),
                ],
                'default' => 'solid',
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items:not(.eead-inline-items) li:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
                    '{{WRAPPER}} .eead-list-items.eead-inline-items li:not(:last-child)' => 'border-right-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_weight',
            [
                'label' => esc_html__('Weight', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items:not(.eead-inline-items) li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-list-items.eead-inline-items li:not(:last-child)' => 'border-right-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items:not(.eead-inline-items) li:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .eead-list-items.eead-inline-items li:not(:last-child)' => 'border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle' => false,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'eead-icon-',
            ]
        );

        $this->add_control(
            'icon_vertical_align',
            [
                'label' => esc_html__('Vertical Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'middle',
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
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-container .eead-list-items li' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#00B12A',
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items .eead-icon-list-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-list-items .eead-icon-list-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items .eead-icon-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 14,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items .eead-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eead-list-items .eead-icon-list-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.eead-icon-left .eead-list-items .eead-icon-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.eead-icon-right .eead-list-items .eead-icon-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => esc_html__('Border', 'easy-elementor-addons'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .eead-list-items .eead-icon-wrapper',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items .eead-icon-wrapper, {{WRAPPER}} .eead-list-items .eead-icon-list-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-list-items .eead-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-wrapper .eead-icon-list-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-wrapper .eead-icon-list-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_animation',
            [
                'label' => esc_html__('Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__('Text', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_text_style');

        $this->start_controls_tab(
            'tab_text_normal',
            [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-text' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-icon-list-text',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-item:hover .eead-icon-list-text' => 'background: {{VALUE}};',
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

        $this->add_render_attribute('icon-list', 'class', 'eead-list-items');
        if ($settings['view'] === 'inline') {
            $this->add_render_attribute('icon-list', 'class', 'eead-inline-items');
        }
        ?>
        <div class="eead-list-container">
            <ul <?php echo $this->get_render_attribute_string('icon-list'); ?>>
                <?php
                $this->add_render_attribute([
                    'text_key' => [
                        'class' => 'eead-icon-list-text',
                    ],
                ]);
                foreach ($settings['list_items'] as $index => $list) {
                    if ($list['text']) {
                        ?>
                        <li class='eead-icon-list-item'>
                            <?php
                            if (!empty($list['link']['url'])) {
                                $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                                printf('<a href="%1$s" %2$s %3$s>', esc_url($list['link']), $target, $nofollow);
                            }
                            $count = $index + 1;
                            $this->render_list_icon($list, $count);

                            printf('<span %1$s>%2$s</span>', $this->get_render_attribute_string('text_key'), wp_kses_post($list['text']));

                            if (!empty($list['link']['url'])) {
                                echo '</a>';
                            }
                            ?>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php
    }

    protected function render_list_icon($list, $count) {
        $settings = $this->get_settings_for_display();
        $icon_animation = '';

        if ($settings['icon_hover_animation']) {
            $icon_animation = 'elementor-animation-' . $settings['icon_hover_animation'];
        }
        ?>
        <span class='eead-icon-wrapper'>
            <?php
            switch ($list['icon_type']) {
                case 'icon':
                    if (!empty($list['icon'])) {
                        echo '<span class="eead-icon-list-icon eead-icon ' . esc_attr($icon_animation) . '">';
                        Icons_Manager::render_icon($list['icon'], ['aria-hidden' => 'true']);
                        echo '</span>';
                    }
                    break;

                case 'image':
                    $image_url = Group_Control_Image_Size::get_attachment_image_src($list['list_image']['id'], 'image', $settings);

                    if ($image_url) {
                        $image_alt_txt = Control_Media::get_image_alt($list['list_image']);
                        $image_html = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt_txt) . '">';
                    } else {
                        $image_html = '<img src="' . esc_url($list['list_image']['url']) . '">';
                    }

                    printf('<span class="eead-icon-list-image %1$s">%2$s</span>', $icon_animation, $image_html);
                    break;

                case 'number':
                    $number = $list['icon_text'] ? $list['icon_text'] : $count;
                    printf('<span class="eead-icon-list-icon %1$s">%2$s</span>', $icon_animation, $number);
                    break;

            }
            ?>
        </span>
        <?php
    }

}
