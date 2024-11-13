<?php

namespace EasyElementorAddons\Modules\SlinkyVerticalMenu\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use EasyElementorAddons\Modules\SlinkyVerticalMenu\EEAD_Slinky_Vertical_Menu_Walker;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SlinkyVerticalMenu extends Widget_Base {

    public function get_name() {
        return 'eead-slinky-vertical-menu';
    }

    public function get_title() {
        return esc_html__('Slinky Vertical Menu', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eicon-nav-menu';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return [];
    }

    public function get_script_depends() {
        return ['slinky'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_static_menu', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'dynamic_menu', [
                'label' => esc_html__('Dynamic Menu', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER
            ]
        );

        $this->add_control(
            'navbar', [
                'label' => esc_html__('Select Menu', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => eead_get_menu(),
                'default' => 0,
                'condition' => ['dynamic_menu' => 'yes']
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_title', [
                'label' => esc_html__('Menu Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'menu_type!' => 'child_end'
                ]
            ]
        );

        $repeater->add_control(
            'menu_type', [
                'label' => esc_html__('Select Item Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'item' => 'Item',
                    'child_start' => 'Child Start',
                    'child_end' => 'Child End',
                ],
                'default' => 'item'
            ]
        );

        $repeater->add_control(
            'menu_link', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
                'condition' => [
                    'menu_type!' => 'child_end'
                ]
            ]
        );

        $repeater->add_control(
            'menu_icon', [
                'label' => esc_html__('Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'condition' => [
                    'menu_type!' => 'child_end'
                ]
            ]
        );

        $this->add_control(
            'menus', [
                'label' => esc_html__('Menu Items', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => ['dynamic_menu' => ''],
                'separator' => 'before',
                'default' => [
                    [
                        'menu_title' => esc_html__('About', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_title' => esc_html__('Gallery', 'easy-elementor-addons'),
                        'menu_link' => '#',
                        'menu_type' => 'child_start'
                    ],
                    [
                        'menu_title' => esc_html__('Gallery 01', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_title' => esc_html__('Gallery 02', 'easy-elementor-addons'),
                        'menu_link' => '#',
                        'menu_type' => 'child_start'
                    ],
                    [
                        'menu_title' => esc_html__('Sub Gallery 01', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_title' => esc_html__('Sub Gallery 02', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_title' => esc_html__('Sub Gallery 03', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_type' => 'child_end'
                    ],
                    [
                        'menu_title' => esc_html__('Gallery 03', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ],
                    [
                        'menu_type' => 'child_end'
                    ],
                    [
                        'menu_title' => esc_html__('Contacts', 'easy-elementor-addons'),
                        'menu_link' => '#',
                    ]
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, menu_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} <# print((menu_type == "child_start") ? "<b>[ Child Start:</b> " + menu_title : menu_title ) #><# print( (menu_type == "child_end" ) ? "<b>Child End ]</b>" : "" ) #>'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slinky_vertical_menu_additional', [
                'label' => esc_html__('Additional Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'show_sticky', [
                'label' => esc_html__('Show Sticky', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER
            ]
        );

        $this->add_responsive_control(
            'menu_width', [
                'label' => esc_html__('Menu Max Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu' => 'max-width: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_text_alignment', [
                'label' => esc_html__('Text Alignemnt', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'slinky_vertical_menu_item', [
                'label' => esc_html__('Menu Items', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs('menu_link_styles');

        $this->start_controls_tab(
            'menu_link_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'menu_link_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu li.eead-menu-item > a span ' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'menu_link_background',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu li > a',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#e3e8eb',
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'menu_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'none',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#444444',
                    ]
                ],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu li > a',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu  li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'main_menu_bg_link_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'menu_spacing', [
                'label' => esc_html__('Space Between', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'tablet_default' => [
                    'size' => 1,
                ],
                'mobile_default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu li > a',
                'render_type' => 'template'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menu_link_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'menu_link_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu li.eead-menu-item:hover > a span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'link_background_hover',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu li:hover > a',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#d7dee3',
                    ],
                ]
            ]
        );

        $this->add_control(
            'menu_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu li:hover > a' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'menu_border_border!' => '',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'slinky_vertical_menu_indicator', [
                'label' => esc_html__('Indicator', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'slinky_indicator_tabs'
        );

        $this->start_controls_tab(
            'slinky_indicator_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'indicator_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'indicator_background',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'indicator_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'none',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#444444',
                    ]
                ],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'indicator_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'indicator_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'indicator_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'indicator_typography',
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu .header a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next::after',
                'render_type' => 'template'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'slinky_indicator_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'indicator_hover_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header:hover a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next:hover:after' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'indicator_hover_background',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-slinky-vertical-menu .header:hover a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next:hover:after'
            ]
        );

        $this->add_control(
            'indicator_border_color_hover', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-slinky-vertical-menu .header:hover a.back:before, {{WRAPPER}} .eead-slinky-vertical-menu .next:hover:after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'indicator_border_border!' => '',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('slinky_vertical_menu', 'class', ['eead-slinky-vertical-menu', 'slinky-menu', 'slinky-theme-default']);
        $this->add_render_attribute('slinky_vertical_menu', 'id', 'eead-slinky-vertical-menu-' . $this->get_id());

        if ('yes' == $settings['show_sticky']) {
            $this->add_render_attribute('slinky_vertical_menu', 'data-eead-sticky', "bottom: #offset;");
        }
        ?>
        <div <?php $this->print_render_attribute_string('slinky_vertical_menu'); ?>>
            <?php if ('yes' == $settings['dynamic_menu']): ?>
                <?php $this->dynamic_menu(); ?>
            <?php else: ?>
                <?php $this->static_menu(); ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function static_menu() {
        $settings = $this->get_settings_for_display();
        ?>
        <ul>
            <?php
            foreach ($settings['menus'] as $item):
                $target = (!empty($item['menu_link']['is_external'])) ? 'target="_blank"' : '';
                $nofollow = (!empty($item['menu_link']['nofollow'])) ? ' rel="nofollow"' : '';

                if ($item['menu_type'] == 'child_start') {
                    $item_class = 'has-arrow';
                } else {
                    $item_class = '';
                }
                if ($item['menu_type'] !== 'child_end'):
                    ?>
                    <li class="eead-menu-item">
                        <a class="<?php echo $item_class; ?>" href="<?php echo esc_url($item['menu_link']['url']); ?>" <?php
                              echo wp_kses_post($target);
                              echo wp_kses_post($nofollow);
                              ?>>
                            <?php if (!empty($item['menu_icon']['value'])): ?>
                                <span class="eead-menu-icon">
                                    <?php Icons_Manager::render_icon($item['menu_icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                            <?php endif; ?>
                            <?php echo wp_kses($item['menu_title'], eead_allow_tags('title')); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($item['menu_type'] == 'child_start'): ?>
                        <ul>
                        <?php endif; ?>

                        <?php if ($item['menu_type'] == 'child_end'): ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($item['menu_type'] == 'item'): ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php
    }

    protected function dynamic_menu() {
        $settings = $this->get_settings_for_display();
        $id = 'eead-slinky-vertical-menu-' . $this->get_id();

        if (!$settings['navbar']) {
            element_pack_alert(__('Please select a Menu From Setting!', 'easy-elementor-addons'));
        }

        $nav_menu = !empty($settings['navbar']) ? wp_get_nav_menu_object($settings['navbar']) : false;
        if (!$nav_menu) {
            return;
        }
        $nav_menu_args = array(
            'fallback_cb' => false,
            'container' => false,
            'menu_id' => $id,
            'menu_class' => 'slinky-vertical-menu',
            'theme_location' => 'default_navmenu', // creating a fake location for better functional control
            'menu' => $nav_menu,
            'echo' => true,
            'depth' => 0,
            'walker' => new EEAD_Slinky_Vertical_Menu_Walker
        );

        wp_nav_menu(apply_filters('widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings));
    }

}
