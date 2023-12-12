<?php

namespace EasyElementorAddons\Modules\PricingList\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
} 

/**
 * Pricing List Widget
 */
class PricingList extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-pricing-list';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Pricing List', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-price-list';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
                'image', [
            'label' => __('Choose Image', 'easy-elementor-addons'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_group_control(
                Group_Control_Image_Size::get_type(), [
            'name' => 'thumb',
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'full',
                ]
        );

        $repeater->add_control(
                'title', [
            'label' => __('Pricing Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Pricing'
                ]
        );

        $repeater->add_control(
                'currency', [
            'label' => __('Currency Symbol', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '$'
                ]
        );

        $repeater->add_control(
                'price', [
            'label' => __('Price', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '500'
                ]
        );

        $repeater->add_control(
            'description', [
                'label' => __('Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => __('Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons'),
                'placeholder' => __('Type your item description here', 'easy-elementor-addons'),
            ]
        );

        $repeater->add_control(
                'link', [
            'label' => __('Link', 'easy-elementor-addons'),
            'type' => Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
                ]
        );

        $repeater->add_control(
                'is_featured', [
            'label' => __('Is Featured', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'pricing_lists', [
            'label' => __('Pricing Lists', 'easy-elementor-addons'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title' => 'Item 1',
                    'currency' => '$',
                    'price' => '10',
                    'description' => __( 'Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons' )
                ],
                [
                    'title' => 'Item 2',
                    'currency' => '$',
                    'price' => '20',
                    'description' => __( 'Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons' )
                ],
                [
                    'title' => 'Item 3',
                    'currency' => '$',
                    'price' => '30',
                    'description' => __( 'Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons' )
                ],
            ],
            'title_field' => '{{{ title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'section_settings', [
            'label' => esc_html__('Settings', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'layout', [
            'label' => __('Layout', 'easy-elementor-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
                'style1' => __('Style 1', 'easy-elementor-addons'),
                'style2' => __('Style 2', 'easy-elementor-addons'),
                'style3' => __('Style 3', 'easy-elementor-addons')
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
                ],
            ]
        );

        $this->add_control(
                'title_link_enable', [
            'label' => __('Link On Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'image_link_enable', [
            'label' => __('Link On Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        // Style Settings
        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-item-title-section h3' => 'color: {{VALUE}}',
            ],
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
            'selector' => '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-item-title-section h3',
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
            'tab' => Controls_Manager::TAB_STYLE,
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
            ],
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
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
                'price_list_spacing', [
            'label' => __('Price List Spacing', 'easy-elementor-addons'),
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
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'description_style', [
            'label' => esc_html__('Description', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'description_color', [
            'label' => esc_html__('Description Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-pricing-item-description' => 'color: {{VALUE}}',
            ],
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
            'selector' => '{{WRAPPER}} .eead-pricing-list-section .eead-item-details-box .eead-pricing-item-description',
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
            'tab' => Controls_Manager::TAB_STYLE,
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
            ],
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
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'price_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
             {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
             {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small',
                ]
        );

        $this->add_responsive_control(
            'price_padding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-pricing-list-section.style1 .eead-item-details-box .eead-item-price,
                     {{WRAPPER}} .eead-pricing-list-section.style2 .eead-each-pricing-item .eead-item-image small,
                     {{WRAPPER}} .eead-pricing-list-section.style3 .eead-each-pricing-item .eead-item-image small' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => __( 'Border Radius', 'easy-elementor-addons' ),
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
        if($settings['layout'] != 'style3') {
            $alignment_class = 'eead-align-' . $settings['alignment']; 
        }
        ?>
        <div class="eead-pricing-list-section <?php echo esc_attr($settings['layout']); ?>">
            <div class="eead-pricing-list-wrap <?php echo isset($alignment_class) ? esc_attr($alignment_class) : ''; ?>">

                <?php foreach ($settings['pricing_lists'] as $lists) { ?>
                    <div class="eead-each-pricing-item">
                        <?php if($lists['image']) { ?>
                            <div class="eead-item-image">
                                <?php 
                                $link = $lists['link']['url'] ? esc_url($lists['link']['url']) : '#';
                                if($settings['image_link_enable'] == 'yes') {
                                    $image = Group_Control_Image_Size::get_attachment_image_html($lists, 'thumb', 'image');
                                    printf( '<a href=%1$s>%2$s</a>', $link, $image );
                                } else {
                                    echo Group_Control_Image_Size::get_attachment_image_html($lists, 'thumb', 'image');
                                }

                                if($settings['layout'] == 'style2' || $settings['layout'] == 'style3') {
                                    if($lists['price']) {
                                        ?>
                                        <small class="eead-item-price">
                                            <?php echo esc_html($lists['currency']) . esc_html($lists['price']); ?>
                                        </small>
                                        <?php
                                    }
                                } 
                                ?>
                            </div>
                        <?php } ?>

                        <div class="eead-item-details-box">
                            <div class="eead-item-title-section">

                                <?php if($lists['title']) { ?>
                                    <h3>
                                        <?php 
                                        if($settings['title_link_enable'] == 'yes') {
                                            printf('<a href=%1$s>%2$s</a>', $link, $lists['title']);
                                        } else {
                                            echo esc_html( $lists['title'] ); 
                                        }
                                        ?>
                                    </h3>
                                <?php } ?>

                                <?php 
                                if($settings['layout'] == 'style1') {
                                    if($lists['price']) {
                                        ?>
                                        <small class="eead-item-price">
                                            <?php echo esc_html($lists['currency']) . esc_html($lists['price']); ?>
                                        </small>
                                        <?php
                                    } 
                                } 
                                ?>
                            </div>

                            <?php if($lists['description']) { ?>
                                <div class="eead-pricing-item-description">
                                    <?php echo esc_html($lists['description']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}