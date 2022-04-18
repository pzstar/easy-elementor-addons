<?php

namespace EasyElementorAddons\Modules\VerticalTabBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class VerticalTabBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-vertical-tab-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Vertical Tab', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-tabs eead-icon-rotate';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'icon', [
            'label' => __('Icon', 'easy-elementor-addons'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fa fa-star',
                'library' => 'solid',
            ],
                ]
        );

        $repeater->add_control(
                'title', [
            'label' => __('Tab Title', 'easy-elementor-addons'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => 'Tab Title'
                ]
        );

        $repeater->add_control(
                'content_type', [
            'label' => __('Content Type', 'easy-elementor-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'wisiwyg',
            'options' => [
                'wisiwyg' => __('WISIWYG', 'easy-elementor-addons'),
                'elementor_template' => __('Elementor Template', 'easy-elementor-addons'),
                'page' => __('Page', 'easy-elementor-addons'),
            ],
                ]
        );

        $repeater->add_control( 'page', [
                'label' => __('Select Page', 'hash-elementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'multiple' => false,
                'options' => $this->get_pages(), 
                'condition' => [ 'content_type' => 'page' ] 
            ]
        );

        $repeater->add_control(
            'wisiwyg_content',
            [
                'label' => __( 'Description', 'easy-elementor-addons' ),
                'type' => Controls_Manager::WYSIWYG,
                'placeholder' => __( 'Type your description here', 'easy-elementor-addons' ),
                'condition'   => [ 'content_type' => 'wisiwyg' ]
            ]
        );

        $repeater->add_control(
            'elementor_template',
            [
                'label'       => __( 'Select Template', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => $this->get_elementor_templates(),
                'label_block' => 'true',
                'condition'   => [ 'content_type' => 'elementor_template' ]
            ]
        );

        $repeater->add_control(
            'enable',
            [
                'label' => __( 'Enable', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'easy-elementor-addons' ),
                'label_off' => __( 'Hide', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        ); 

        $this->add_control(
                'tabs', [
            'label' => __('Plan Feature List', 'easy-elementor-addons'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'icon' => [
                        'value' => 'fa fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 1',
                    'wisiwyg_content' => 'Ut posuere bibendum pretium. Nulla sit amet felis sem. Donec eu elit efficitur, vehicula quam sit amet, sodales elit. Praesent ac velit arcu. Sed volutpat vitae nulla sed fermentum. Praesent at pulvinar diam, a iaculis justo. In ullamcorper nec risus sit amet malesuada. Sed tempor, risus sit amet vestibulum dignissim, purus magna venenatis velit, sed facilisis diam arcu at leo. Donec nec lacus in ligula pretium finibus a lobortis ipsum. Nullam eu sem quis magna aliquet cursus. Nam vitae faucibus lorem. Praesent maximus, magna et volutpat scelerisque, neque quam hendrerit ante, nec eleifend est nunc a orci.'
                ],
                [
                    'icon' => [
                        'value' => 'fa fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 2',
                    'wisiwyg_content' => 'Aenean facilisis accumsan nunc, vel maximus ipsum dictum ut. Sed in mauris commodo magna faucibus accumsan. Nunc non purus mi. Phasellus aliquet facilisis orci. Nullam vel tempor est. Aliquam eu elit sit amet nunc ullamcorper imperdiet. Phasellus porta egestas dolor sodales porttitor. Nunc mollis purus id nibh tempus pulvinar. In egestas et magna eu aliquam. Nunc dapibus massa metus, tempor lobortis risus cursus vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed dignissim rutrum tortor, vitae viverra augue tincidunt at. Sed leo nisl, congue ut justo in.'
                ],
                [
                    'icon' => [
                        'value' => 'fa fa-star',
                        'library' => 'solid',
                    ],
                    'title' => 'Tab Title 3',
                    'wisiwyg_content' => 'Donec justo eros, luctus quis scelerisque id, ultricies sit amet odio. Vestibulum aliquam efficitur eleifend. Praesent dignissim faucibus ex vel sodales. Morbi aliquet libero at augue pharetra vehicula. Cras dapibus lorem efficitur nunc euismod convallis. Nunc molestie risus id lacinia consequat. Integer iaculis orci in ipsum vestibulum, non mattis justo ornare. Cras et lorem tempor ligula suscipit mollis. Nulla vitae augue non leo tempus finibus.'
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
                'tab_position', [
            'label' => __('Tab Position', 'easy-elementor-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                'left' => __('Left', 'easy-elementor-addons'),
                'right' => __('Right', 'easy-elementor-addons')
            ],
                ]
        );

        $this->add_control(
            'tab_layout',
            [
                'label' => __( 'Style', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1'  => __( 'Style 1', 'easy-elementor-addons' ),
                    'style2' => __( 'Style 2', 'easy-elementor-addons' ),
                    'style3' => __( 'Style 3', 'easy-elementor-addons' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_style', [
            'label' => esc_html__('Tab', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_spacing', [
            'label' => __('Tab Spacing', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-tab-container.top .eead-tabs .eead-tab:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .eead-tab-container.left .eead-tabs .eead-tab:not(:last-child),
                 {{WRAPPER}} .eead-tab-container.right .eead-tabs .eead-tab:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ]
                ]
        );

        $this->add_control(
                'tab_width', [
            'label' => __('Tab Width', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section .eead-tab-container .eead-tabs' => 'width: {{SIZE}}%;',
                '{{WRAPPER}} .eead-vertical-tab-section .eead-tab-container .eead-tab-content' => 'width: calc(100% - {{SIZE}}%);'
            ]
                ]
        );

        $this->add_control(
                'each_tab_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'title_style', [
            'label' => esc_html__('Tab Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-tab-container .eead-tabs .eead-tab span',
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Tab Icon Size', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-tab-container .eead-tabs .eead-tab i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'icon_spacing', [
            'label' => __('Tab Icon Spacing', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 2,
                    'max' => 80,
                    'step' => 1,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-tab-container .eead-tabs .eead-tab i' => 'margin-right: {{SIZE}}{{UNIT}};',
            ]
                ]
        );

        $this->start_controls_tabs(
                'style_tabs'
        );

        $this->start_controls_tab(
                'style_normal_tab', [
            'label' => esc_html__('Normal', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'title_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab,
                {{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab,
                {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab' => 'background-color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab,
                 {{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab,
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab' => 'color: {{VALUE}}',
            ],
                ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
                'style_active_tab', [
            'label' => esc_html__('Active', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'title_bg_color_active', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab.active,
                 {{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab.active,
                 {{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab.active:before,
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab.active' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_color_active', [
            'label' => esc_html__('Title Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab.active,
                 {{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab.active,
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab.active' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_border_color_active', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-vertical-tab-section.style1 .eead-tabs .eead-tab.active:before,
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab.active:after, 
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab:hover:after' => 'background: {{VALUE}}',
                '{{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab.active:before, 
                 {{WRAPPER}} .eead-vertical-tab-section.style3 .eead-tabs .eead-tab:hover:before' => 'border-color: transparent transparent transparent {{VALUE}}',
                '{{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tabs .eead-tab' => 'border: 1px solid {{VALUE}}'
            ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
                'tab_content_style', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'tab_content_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-tab-container .eead-tab-content' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
            'content_border_color',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-vertical-tab-section.style2 .eead-tab-container .eead-tab-content' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [ 'tab_layout' => 'style2' ]
            ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'tab_content_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-tab-container .eead-tab-content',
                ]
        );

        $this->add_control(
                'tab_content_padding', [
            'label' => esc_html__('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .eead-tab-container .eead-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $tab_position = $settings['tab_position'];
        ?>
        <section class="eead-vertical-tab-section eead-tab-section <?php echo esc_attr($settings['tab_layout']); ?>">
            <div class="eead-tab-container <?php echo esc_attr($tab_position); ?>">
                <div class="eead-tabs">
                    <?php
                    if (!empty($settings['tabs'])) {
                        $i = 0;
                        foreach ($settings['tabs'] as $tab) {
                            if ($tab['enable'] == 'yes') {
                                $i++;
                                ?>
                                <div class="eead-tab <?php echo $i == 1 ? 'active' : null; ?>" data-tabid="<?php echo $i; ?>">
                                    <?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?>
                                    <span><?php echo esc_html($tab['title']); ?></span>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

                <div class="eead-tab-content">
                    <?php echo $this->get_tab_content(); ?>
                </div>
            </div>
        </section>
        <?php
    }

    private function get_tab_content() {
        $settings = $this->get_settings_for_display();
        $i = 0;
        
        foreach ( $settings['tabs'] as $tab ) {
            if ($tab['enable'] == 'yes') {
                $i++;
                ?>
                <div class="eead-each-content eead-content-<?php echo $i; ?>" style="<?php echo $i>1 ? 'display:none;' : null; ?>">
                <?php
                if( $tab['content_type'] == 'page' ) {
                    if ( $tab['enable'] == 'yes' && !empty($tab['page']) ) {
                        $args = array(
                            'page_id' => absint($tab['page'])
                        );
                        $query = new \WP_Query($args);
                        if ($query->have_posts()):
                            while ($query->have_posts()) : $query->the_post();
                                ?>
                                <h3><?php the_title(); ?></h3>
                                <div class="eead-clearfix">
                                    <?php the_content(); ?>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    }       
                }
                else if( $tab['content_type'] == 'elementor_template' ) {
                    echo $this->elementor()->frontend->get_builder_content_for_display( $tab['elementor_template'] );
                    echo $this->eead_template_edit_link($item['template_id']);
                }
                else if($tab['content_type'] == 'wisiwyg' and $tab[ 'wisiwyg_content' ] ) {
                    echo parse_wisiwyg_content( $tab[ 'wisiwyg_content' ] );
                }
                ?>
                </div>
                <?php
            }
        } 
    }

    // Elementor Saved Template 
    protected function get_elementor_templates() {

        $templates = $this->elementor()->templates_manager->get_source('local')->get_items();
        $types     = [];

        if ( empty($templates) ) {
            $template_options = ['0' => __('Template Not Found!', 'easy-elementor-addons')];
        } else {
            $template_options = ['0' => __('Select Template', 'easy-elementor-addons')];

            foreach ( $templates as $template ) {
                $template_options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']]            = $template['type'];
            }
        }

        return $template_options;
    }

    protected function elementor() {
        return Plugin::$instance;
    }

    protected function get_pages() {
        $pages = get_pages( array(
            'order'   => 'ASC'
        ) );

        $_pages = [];

        foreach( $pages as $key => $object ) {
            $_pages[$object->ID] = ucfirst($object->post_title); 
        }

        return $_pages;
    }

    private function eead_template_edit_link($template_id) {
        if ( $this->elementor()->editor->is_edit_mode() ) {

            $url = add_query_arg(['elementor' => ''], get_permalink($template_id));

            $output = '<a class="eead-template-edit-link" href="'.esc_url($url).'" title="'.esc_html__('Edit Template', 'easy-elementor-addons').'" target="_blank"><i class="eicon-edit"></i></a>';

            return $output;
        }
    }

}
