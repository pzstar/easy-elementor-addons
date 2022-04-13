<?php

namespace EasyElementorAddons\Modules\AccordionBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Plugin;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class AccordionBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-accordion-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Accordion Block', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-accordion';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'accordion_settings', [
            'label' => esc_html__('Accordion', 'easy-elementor-addons')
                ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'keep_open',
            [
                'label' => __( 'Show Content', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'easy-elementor-addons' ),
                'label_off' => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Accordion', 'easy-elementor-addons' )
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label' => __( 'Content Type', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'wisiwyg',
                'options' => [
                    'elementor_template'  => __( 'Elementor Template', 'easy-elementor-addons' ),
                    'wisiwyg' => __( 'WISIWYG', 'easy-elementor-addons' ),
                ],
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
            'wisiwyg_content',
            [
                'label' => __( 'Description', 'easy-elementor-addons' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Cu utamur torquatos his. Qui dicta propriae signiferumque ex, esse eligendi adipisci te mel. At ius dolores offendit, vis case zril causae an. Vel integre euripidis expetendis eu. Omnis eleifend intellegebat vel cu, pri dicant admodum at. Ei eum eleifend laboramus, nonumy legere quaerendum vis cu. Ut facete quodsi eloquentiam mel. Pri purto sale option at.', 'easy-elementor-addons' ),
                'placeholder' => __( 'Type your description here', 'easy-elementor-addons' ),
                'condition'   => [ 'content_type' => 'wisiwyg' ]
            ]
        );

        $repeater->add_responsive_control(
                'content_height', [
            'label' => __('Content Height', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 30,
                    'max' => 2000,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 100,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 200,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 100,
                'unit' => 'px',
            ],
                ]
        );

        $this->add_control(
            'items',
            [
                'label' => __( 'Items', 'easy-elementor-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Accordion #1', 'easy-elementor-addons' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'accordion_open_icon',
            [
                'label'       => __( 'Open Icon', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $this->add_control(
            'accordion_close_icon',
            [
                'label'       => __( 'Close Icon', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
                'condition'   => [
                    'accordion_open_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'layout',
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
                'title_section_style', [
            'label' => esc_html__('Title', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        
        $this->add_control(
                'title_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-accordion-container .eead-each-accordion .eead-accordion-title-section' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'title_color', [
            'label' => esc_html__('Title Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-accordion-title-section h3' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-accordion-title-section h3',
                ]
        );

        $this->add_control(
                'icon_color', [
            'label' => esc_html__('Icon Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-accordion-title-section .eead-accordion-icon i' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'icon_size', [
            'label' => __('Icon Size', 'easy-elementor-addons'),
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
                '{{WRAPPER}} .eead-accordion-title-section .eead-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
            'title_padding',
            [
                'label'      => esc_html__( 'Padding', 'easy-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eead-accordion-title-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
                'content_section_style', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
        
        $this->add_control(
                'content_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-each-accordion .eead-accordion-content' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'content_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-each-accordion .eead-accordion-content' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'content_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-each-accordion .eead-accordion-content',
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $accordions = $settings['items'];
        ?>
        <div class="eead-accordion-container <?php echo esc_attr($settings['layout']); ?>">
            <?php foreach ( $accordions as $key => $accordion ) { ?>
                <?php  
                    $content_height = array(
                                        'content_height' => $accordion[ 'content_height' ]['size'],
                                        'content_height_tablet' => $accordion[ 'content_height_tablet' ]['size'],
                                        'content_height_mobile' => $accordion[ 'content_height_mobile' ]['size'],
                                        );
                    $params = json_encode($content_height);
                ?>
                <div class="eead-each-accordion">
                    <div class="eead-accordion-title-section <?php echo $accordion['keep_open'] == 'yes' ? 'active' : null; ?>" data-height='<?php echo $params;?>'>
                        <h3><?php echo esc_html( $accordion[ 'title' ] ); ?></h3>
                        <div class="eead-accordion-icon">
                            <div class="eead-accordion-open-icon">    
                                <?php Icons_Manager::render_icon($settings['accordion_open_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                            <div class="eead-accordion-close-icon">
                                <?php Icons_Manager::render_icon($settings['accordion_close_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="eead-accordion-content">
                        <p>
                        <?php  
                        if( $accordion['content_type'] == 'wisiwyg' ) {
                            echo $this->wisiwyg_text_parser( $accordion[ 'wisiwyg_content' ] );
                        } else if( $accordion[ 'content_type' ] == 'elementor_template' ) {
                            echo $this->elementor()->frontend->get_builder_content_for_display( $accordion['elementor_template'] );
                        }
                        ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
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

    protected function wisiwyg_text_parser( $content ) {
        $content = shortcode_unautop( $content );
        $content = do_shortcode( $content );
        $content = wptexturize( $content );

        return $content;
    }

}
