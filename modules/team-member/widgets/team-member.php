<?php

namespace EasyElementorAddons\Modules\TeamMember\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TeamMember extends Widget_Base {

    public function get_name() {
        return 'eead-team-member';
    }

    public function get_title() {
        return esc_html__('Team Member', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-icons-team';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_image', [
                'label' => esc_html__('Image', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'image', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'image',
                'label' => esc_html__('Image Size', 'easy-elementor-addons'),
                'default' => 'medium_large'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_details', [
                'label' => esc_html__('Details', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'team_member_name', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('John Doe', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'team_member_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('WordPress Developer', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'team_member_description_switch', [
                'label' => esc_html__('Show Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'team_member_description', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::WYSIWYG,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('Type your member description here', 'easy-elementor-addons'),
                'condition' => [
                    'team_member_description_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'link_type', [
                'label' => esc_html__('Link Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'image' => esc_html__('Image', 'easy-elementor-addons'),
                    'title' => esc_html__('Title', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'link', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ]
                ],
                'placeholder' => 'https://www.your-link.com',
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'link_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons')
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_social_links', [
                'label' => esc_html__('Social Links', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'member_social_links', [
                'label' => esc_html__('Show Social Links', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon_label', array(
                'label' => esc_html__('Icon Label', 'easy-elementor-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                ),
            )
        );

        $repeater->add_control(
            'select_social_icon', [
                'label' => esc_html__('Social Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => array(
                    'value' => 'fas fa-hashtag',
                    'library' => 'fa-solid',
                )
            ]
        );

        $repeater->add_control(
            'social_link', [
                'label' => esc_html__('Social Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'placeholder' => esc_html__('Enter URL', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'team_member_social', [
                'label' => esc_html__('Add Social Links', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'social_icon_label' => 'Facebook',
                        'select_social_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon_label' => 'Twitter',
                        'select_social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'social_icon_label' => 'Youtube',
                        'select_social_icon' => [
                            'value' => 'fab fa-youtube',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => [
                            'url' => '#',
                        ],
                    ]
                ],
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'member_social_links' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        /* All Styles */
        $this->start_controls_section(
            'section_content_style', [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'member_box_alignment', [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
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
                    '{{WRAPPER}} .eead-team-member-wrapper' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'content_background',
                'types' => ['classic', 'gradient'],
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .eead-team-member-content-normal'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .eead-team-member-content'
            ]
        );

        $this->add_responsive_control(
            'member_box_content_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-content-normal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_box_content_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_image_style', [
                'label' => esc_html__('Image', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'member_image_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-image img, 
                     {{WRAPPER}} .eead-team-member-overlay-content-wrap:before,
                     {{WRAPPER}} .eead-team-member-wrapper.style1 .eead-team-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_name_style', [
                'label' => esc_html__('Name', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_name_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-name'
            ]
        );

        $this->add_control(
            'member_name_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-name' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_name_margin', [
                'label' => esc_html__('Margin Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                // 'default' => [
                //     'size' => 10,
                //     'unit' => 'px',
                // ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ]
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_position_style', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_position_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-position'
            ]
        );

        $this->add_control(
            'member_position_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-position' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_position_margin', [
                'label' => esc_html__('Margin Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                // 'default' => [
                //     'size' => 10,
                //     'unit' => 'px',
                // ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ]
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_description_style', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'team_member_description_switch' => 'yes',
                    'team_member_description!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'member_description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-team-member-description',
                'condition' => [
                    'team_member_description_switch' => 'yes',
                    'team_member_description!' => '',
                ]
            ]
        );

        $this->add_control(
            'member_description_text_color', [
                'label' => esc_html__('Text Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'team_member_description_switch' => 'yes',
                    'team_member_description!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_description_margin', [
                'label' => esc_html__('Margin Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                // 'default' => [
                //     'size' => 10,
                //     'unit' => 'px',
                // ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ]
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'team_member_description_switch' => 'yes',
                    'team_member_description!' => '',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_member_social_links_style', [
                'label' => esc_html__('Social Links', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'member_icons_gap', [
                'label' => esc_html__('Icons Gap', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    'px' => [
                        'max' => 60,
                    ]
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-social-links li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_icon_size', [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 30,
                    ]
                ],
                // 'default'    => [
                //     'size' => '14',
                //     'unit' => 'px',
                // ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-wrapper .eead-team-member-social-links li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('tabs_links_style');

        $this->start_controls_tab(
            'tab_links_normal', [
                'label' => esc_html__('Normal', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'member_links_icons_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-wrapper.style1 .eead-team-member-social-links li i,
                     {{WRAPPER}} .eead-team-member-wrapper.style2 ul.eead-team-member-social-links li a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap svg' => 'fill: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'member_links_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-wrapper.style2 ul.eead-team-member-social-links li a' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'member_links_border_normal',
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
                'selector' => '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_links_hover', [
                'label' => esc_html__('Hover', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'member_links_icons_color_hover', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-wrapper.style1 .eead-team-member-social-links li:hover i,
                     {{WRAPPER}} .eead-team-member-wrapper.style2 ul.eead-team-member-social-links li:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap:hover svg' => 'fill: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'member_links_bg_color_hover', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-wrapper.style2 ul.eead-team-member-social-links li:hover a' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'member_links_border_hover',
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
                'selector' => '{{WRAPPER}} .eead-team-member-social-links li:hover .eead-team-member-social-icon-wrap'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'member_links_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'member_links_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .eead-team-member-social-links .eead-team-member-social-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function get_image() {
        $settings = $this->get_settings();
        $image_html = Group_Control_Image_Size::get_attachment_image_html($settings);

        if (!empty($settings['image']['url'])) {
            if ($settings['link_type'] == 'image' && $settings['link']['url'] != '') {
                $image = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('link'), $image_html);
            } else {
                $image = $image_html;
            }
        }
        return $image;
    }

    protected function get_social_links() {
        $settings = $this->get_settings_for_display();
        $count = 1;
        ?>
        <div class="eead-team-member-social-links-wrap">
            <ul class="eead-team-member-social-links">
                <?php
                if (isset($settings['team_member_social']) && !empty($settings['team_member_social'])) {
                    foreach ($settings['team_member_social'] as $index => $item) {
                        ?>
                        <?php
                        if (!empty($item['social_link']['url']) && !empty($item['select_social_icon'])) {
                            $this->add_link_attributes('social-link' . $count, $item['social_link']);
                            ?>
                            <li>
                                <a <?php echo $this->get_render_attribute_string('social-link' . $count); ?>>
                                    <span class="eead-team-member-social-icon-wrap">
                                        <span class="elementor-screen-only"><?php echo ucwords($item['social_icon_label']); ?></span>
                                        <span class="eead-team-member-social-icon eead-icon">
                                            <?php Icons_Manager::render_icon($item['select_social_icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                        $count++;
                    }
                }
                ?>
            </ul>
        </div>
        <?php
    }

    protected function get_description() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('team_member_description', 'basic');
        $this->add_render_attribute('team_member_description', 'class', 'eead-team-member-description');

        if ($settings['team_member_description_switch'] == 'yes') {
            if (!empty($settings['team_member_description'])) {
                ?>
                <div <?php echo $this->get_render_attribute_string('team_member_description'); ?>>
                    <?php echo parse_wisiwyg_content($settings['team_member_description']); ?>
                </div>
                <?php
            }
        }
    }

    protected function get_member_name() {
        $settings = $this->get_settings_for_display();
        $member_name = '';
        $this->add_inline_editing_attributes('team_member_name', 'none');
        $this->add_render_attribute('team_member_name', 'class', 'eead-team-member-name');

        if ($settings['team_member_name'] != '') {
            if ($settings['link_type'] == 'title' && $settings['link']['url'] != '') {
                $member_name .= sprintf('<%1$s %2$s><a %3$s>%4$s</a></%1$s>', 'h1', $this->get_render_attribute_string('team_member_name'), $this->get_render_attribute_string('link'), $settings['team_member_name']);
            } else {
                $member_name .= sprintf('<%1$s %2$s>%3$s</%1$s>', 'h1', $this->get_render_attribute_string('team_member_name'), $settings['team_member_name']);
            }
        }
        return $member_name;
    }

    protected function get_member_position() {
        $settings = $this->get_settings_for_display();
        $position = '';
        $this->add_inline_editing_attributes('team_member_position', 'none');
        $this->add_render_attribute('team_member_position', 'class', 'eead-team-member-position');

        if ($settings['team_member_position'] != '') {
            $position .= sprintf('<%1$s %2$s>%3$s</%1$s>', 'h2', $this->get_render_attribute_string('team_member_position'), $settings['team_member_position']);
        }
        return $position;
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['link_type'] != 'none' && !empty($settings['link']['url'])) {
            $this->add_link_attributes('link', $settings['link']);
        }
        ?>
        <div class="eead-team-member-wrapper <?php echo $settings['layout']; ?>">
            <div class="eead-team-member">
                <?php
                if (!empty($settings['image']['url'])) {
                    printf('<div class="eead-team-member-image">%1$s</div>', $this->get_image());
                }
                ?>
                <div class="eead-team-member-content eead-team-member-content-normal">
                    <?php
                    echo $this->get_member_name();
                    echo $this->get_member_position();
                    echo $this->get_content();
                    $this->get_social_links();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function get_content() {
        $settings = $this->get_settings_for_display();
        $before_icon = '';
        $after_icon = '';
        $description = '';

        if ($this->get_description()) {
            $description = $this->get_description();
        }
        return $before_icon . $description . $after_icon;
    }

}
