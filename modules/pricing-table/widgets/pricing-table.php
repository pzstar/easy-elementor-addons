<?php

namespace EasyElementorAddons\Modules\PricingTable\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class PricingTable extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-pricing-table-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Pricing Table', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-price-table';
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

        $this->add_control(
                'title', [
            'label' => __('Pricing Title', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Pricing'
                ]
        );

        $this->add_control(
                'currency', [
            'label' => __('Currency Symbol', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '$'
                ]
        );

        $this->add_control(
                'price', [
            'label' => __('Price', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '500'
                ]
        );

        $this->add_control(
                'price_per', [
            'label' => __('Price Per(/month, /year)', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => '/year'
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'list', [
            'label' => __('Features', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
                ]
        );

        $repeater->add_control(
                'feature_icon', [
            'label' => __('Button Icon', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fa fa-check',
                'library' => 'solid',
            ],
                ]
        );

        $this->add_control(
                'feature_list', [
            'label' => __('Plan Feature List', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'list' => 'Enter Features List'
                ],
                [
                    'list' => 'Enter Features List'
                ],
                [
                    'list' => 'Enter Features List'
                ],
            ],
            'title_field' => '{{{ list }}}',
                ]
        );

        $this->add_control(
                'link_text', [
            'label' => __('Button Text', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Buy Now'
                ]
        );

        $this->add_control(
                'link', [
            'label' => __('Button Link', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::URL,
            'show_external' => true,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
                ]
        );

        $this->add_control(
                'link_icon', [
            'label' => __('Button Icon', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-long-arrow-alt-right',
                'library' => 'solid',
            ],
                ]
        );

        $this->add_control(
                'header_icon', [
            'label' => __('Header Icon', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-home',
                'library' => 'solid',
            ],
            'condition' => ['layout' => 'style2']
                ]
        );

        $this->add_control(
                'is_featured', [
            'label' => __('Is Featured', 'easy-elementor-addons'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'easy-elementor-addons'),
            'label_off' => __('No', 'easy-elementor-addons'),
            'return_value' => 'yes',
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
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'style1',
            'options' => [
                'style1' => __('Style 1', 'easy-elementor-addons'),
                'style2' => __('Style 2', 'easy-elementor-addons'),
                'style3' => __('Style 3', 'easy-elementor-addons'),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'container_style', [
            'label' => esc_html__('Container', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'main_container_background_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .eead-pricing-main'
            ]
        );

        $this->add_control(
                'box_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

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
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-header .eead-pricing-title' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'title_background_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .eead-pricing-table.style2 .eead-pricing-title,
                                {{WRAPPER}} .eead-pricing-table.style1 .eead-pricing-header,
                                {{WRAPPER}} .eead-pricing-table.style3 .eead-pricing-header'
            ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-table .eead-pricing-header .eead-pricing-title',
                ]
        );

        $this->add_control(
                'title_margin', [
            'label' => esc_html__('Margin', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table.style1 .eead-pricing-header .eead-pricing-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [ 'layout' => 'style1' ] 
        ]);

        $this->add_control(
                'title_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table.style3 .eead-pricing-header .eead-pricing-title' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
            'condition' => [ 'layout' => 'style3' ] 
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
                'icon_style', [
            'label' => esc_html__('Icon', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => ['layout' => 'style2']
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-header-icon i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .eead-header-icon'
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
                'price_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-price .eead-price' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'price_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .eead-pricing-table.style3 .eead-pricing-price,
                                {{WRAPPER}} .eead-pricing-table.style2 .eead-pricing-header'
            ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'price_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-price .eead-price',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'price_per_style', [
            'label' => esc_html__('Price Per', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'price_per_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-price .eead-currency,
                 {{WRAPPER}} .eead-pricing-price .eead-price-per' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'price_per_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-price .eead-currency,
                           {{WRAPPER}} .eead-pricing-price .eead-price-per',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'feature_list_style', [
            'label' => esc_html__('Features List', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'feature_list_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-main ul li' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'feature_list_separator_color', [
            'label' => esc_html__('Separator Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-main ul li:not(:first-child)' => 'border-top: 1px dashed {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'feature_list_icon_color', [
            'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-main ul li i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'feature_list_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-table .eead-pricing-main ul li',
                ]
        );

        $this->add_control(
                'feature_list_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'allowed_dimensions' => 'vertical',
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-main ul li' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'button_style', [
            'label' => esc_html__('Button', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a',
                ]
        );

        $this->add_control(
                'button_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->start_controls_tabs(
                'button_tabs'
        );

            $this->start_controls_tab(
                    'button_style_normal_tab', [
                'label' => esc_html__('Normal', 'easy-elementor-addons'),
                    ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'button_bg_color',
                        'types'     => [ 'classic', 'gradient' ],
                        'selector'  => '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a, 
                                        {{WRAPPER}} .eead-pricing.eead-style4 .eead-pricing-button',
                    ]
                );

                $this->add_control(
                        'button_color', [
                    'label' => esc_html__('Color', 'easy-elementor-addons'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a' => 'color: {{VALUE}}',
                    ],
                        ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                    'button_style_active_tab', [
                'label' => esc_html__('Hover', 'easy-elementor-addons'),
                    ]
            );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'button_bg_active_color',
                        'types'     => [ 'classic', 'gradient' ],
                        'selector'  => '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a:hover, 
                                        {{WRAPPER}} .eead-pricing.eead-style4 .eead-pricing-button:hover',
                    ]
                );

                $this->add_control(
                        'button_active_color', [
                    'label' => esc_html__('Color', 'easy-elementor-addons'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eead-pricing-table .eead-pricing-main .eead-pricing-button a:hover' => 'color: {{VALUE}}',
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
        $featured_class = $settings['is_featured'] == 'yes' ? 'eead-featured' : '';

        $pricing_class = array(
            'eead-pricing-table',
            $featured_class,
            $settings['layout']
        );
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        ?>

        <div class="<?php echo esc_attr(implode(' ', array_filter($pricing_class))); ?>">

            <div class="eead-pricing-header">
                
                <?php if($settings['layout'] == 'style2') { ?>
                    <span class="eead-header-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['header_icon'], ['aria-hidden' => 'true']); ?>
                    </span>
                <?php } ?>

                <?php if( $settings['layout'] == 'style1' || $settings['layout'] == 'style3' ) { ?>
                    <h2 class="eead-pricing-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php } ?>

                <?php if($settings['layout'] == 'style2' || $settings['layout'] == 'style3') { ?>
                    <div class="eead-pricing-price">
                        <span class="eead-currency"><?php echo esc_html($settings['currency']); ?></span>
                        <span class="eead-price"><?php echo esc_html($settings['price']); ?></span>
                        <span class="eead-price-per"><?php echo esc_html($settings['price_per']); ?></span>
                    </div>
                <?php } ?>

                <?php if( $settings['layout'] == 'style2' ) { ?>
                    <h2 class="eead-pricing-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php } ?>
            </div>

            <div class="eead-pricing-main">

                <?php if($settings['layout'] == 'style1') { ?>
                    <div class="eead-pricing-price">
                        <span class="eead-currency"><?php echo esc_html($settings['currency']); ?></span>
                        <span class="eead-price"><?php echo esc_html($settings['price']); ?></span>
                        <span class="eead-price-per"><?php echo esc_html($settings['price_per']); ?></span>
                    </div>
                <?php } ?>

                <?php $this->get_pricing_list(); ?>

                <?php if (!empty($settings['link']['url'])) { ?>
                    <div class="eead-pricing-button">
                        <a href="<?php echo esc_url($settings['link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                            <?php echo wp_kses_post($settings['link_text']); ?> 
                            <span class="eead-pricing-link-icon"><?php \Elementor\Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?></span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function get_pricing_list() {
        $settings = $this->get_settings_for_display();
        if ($settings['feature_list']) {
            echo '<ul class="eead-pricing-list">';
            foreach ($settings['feature_list'] as $item) {
                echo '<li>';
                \Elementor\Icons_Manager::render_icon($item['feature_icon'], ['aria-hidden' => 'true']);
                echo wp_kses_post($item['list']);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

}
