<?php

namespace EasyElementorAddons\Modules\PricingList\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Pricing List Widget
 */
class PricingList extends Widget_Base {

    public function get_name() {
        return 'eead-pricing-list';
    }

    public function get_title() {
        return esc_html__('Pricing List', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-pricing-list';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content', [
                'label' => esc_html__('Content', 'easy-elementor-addons')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image', [
                'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full'
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => esc_html__('Pricing Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Pricing'
            ]
        );

        $repeater->add_control(
            'price', [
                'label' => esc_html__('Price', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '500'
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons'),
                'placeholder' => esc_html__('Type your item description here', 'easy-elementor-addons')
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ]
            ]
        );

        $this->add_control(
            'pricing_lists', [
                'label' => esc_html__('Lists', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Item 1',
                        'price' => '$10',
                        'description' => esc_html__('Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons')
                    ],
                    [
                        'title' => 'Item 2',
                        'price' => '$20',
                        'description' => esc_html__('Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons')
                    ],
                    [
                        'title' => 'Item 3',
                        'price' => '$30',
                        'description' => esc_html__('Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons')
                    ]
                ],
                'title_field' => '{{{ title }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings', [
                'label' => esc_html__('Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons')
                ]
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => esc_html__('Title HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h4',
            ]
        );

        $this->add_responsive_control(
            'pricing_column', [
                'label' => esc_html__('Grid Columns', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1', 'easy-elementor-addons'),
                    '2' => esc_html__('2', 'easy-elementor-addons'),
                    '3' => esc_html__('3', 'easy-elementor-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-icon-list-items' => 'grid-template-columns: repeat({{SIZE}}, 1fr);'
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment', [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'alternate' => [
                        'title' => esc_html__('Alternate', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        // Style Settings
        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-item-title-section h3' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'title_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item h3' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-item-title-section h3'
            ]
        );

        $this->add_control(
            'title_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-item-title-section h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style', [
                'label' => esc_html__('Content', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'content_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-each-pricing-item,
                 {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item,
                 {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'item_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->add_responsive_control(
            'content_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'price_list_spacing', [
                'label' => esc_html__('Price List Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-each-pricing-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style', [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'description_color', [
                'label' => esc_html__('Description Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-pricing-item-description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'description_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-each-pricing-item .eead-pricing-item-description' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['layout' => 'style1']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-pricing-item-description'
            ]
        );

        $this->add_control(
            'description_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-pricing-item-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'price_style', [
                'label' => esc_html__('Price', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'price_bg_color', [
                'label' => esc_html__('Background Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                 {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                 {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'price_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                 {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                 {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'price_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
             {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
             {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small'
            ]
        );

        $this->add_responsive_control(
            'price_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                     {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                     {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'price_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                 {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                 {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'price_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                     {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                     {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('pricing-list',
            'class', [
                'eead-pricing-list-container',
                'eead-pl-' . $settings['layout']
            ]
        );

        if ($settings['layout'] != 'style3') {
            $this->add_render_attribute('pricing-list', 'class', 'eead-pl-align-' . $settings['alignment']);
        }
        ?>
        <div <?php $this->print_render_attribute_string('pricing-list'); ?>>
            <div class="eead-pricing-list">
                <?php
                if ($settings['pricing_lists']) {
                    foreach ($settings['pricing_lists'] as $lists) { ?>
                        <div class="eead-pl-item">
                            <?php
                            $has_link = false;
                            if (isset($lists['link']['url']) && !empty($lists['link']['url'])) {
                                $has_link = true;
                                $link = $lists['link']['url'];
                            }
                            ?>
                            <?php if ($lists['image']) { ?>
                                <div class="eead-pl-item-image">
                                    <?php
                                    if ($has_link) {
                                        $image = Group_Control_Image_Size::get_attachment_image_html($lists, 'thumb', 'image');
                                        printf('<a href=%1$s>%2$s</a>', $link, $image);
                                    } else {
                                        echo Group_Control_Image_Size::get_attachment_image_html($lists, 'thumb', 'image');
                                    }

                                    if (($settings['layout'] == 'style2' || $settings['layout'] == 'style3') && $lists['price']) {
                                        ?>
                                        <div class="eead-pl-item-price">
                                            <?php echo esc_html($lists['price']); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php } ?>

                            <div class="eead-pl-item-content">
                                <div class="eead-pl-item-header">

                                    <?php if ($lists['title']) { ?>
                                        <<?php echo $settings['title_tag']; ?> class="eead-pl-item-title">
                                            <?php
                                            if ($has_link) {
                                                printf('<a href=%1$s>%2$s</a>', $link, $lists['title']);
                                            } else {
                                                echo esc_html($lists['title']);
                                            }
                                            ?>
                                        </<?php echo $settings['title_tag']; ?>>
                                    <?php } ?>

                                    <?php
                                    if ($settings['layout'] == 'style1' && $lists['price']) {
                                        ?>
                                        <div class="eead-pl-item-price">
                                            <?php echo esc_html($lists['price']); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <?php if ($lists['description']) { ?>
                                    <div class="eead-pl-item-description">
                                        <?php echo esc_html($lists['description']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <?php
    }

}
