<?php

namespace EasyElementorAddons\Modules\ThreedText\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ThreedText extends Widget_Base {

    /* Widget Name */
    public function get_name() {
        return 'eead-threed-text';
    }

    /* Widget Title */
    public function get_title() {
        return esc_html__('3D Text', 'easy-elementor-addons');
    }

    /* Icon */
    public function get_icon() {
        return 'eicon-animation-text';
    }

    /* Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return [ 'z-text' ];
    }

    /* Controls */
    protected function register_controls() {
        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Content', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
            'text', [
                'label'       => esc_html__( '3D Text Content', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [ 'active' => true ],
                'default'     => esc_html__( '3D Text', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'seperate_letter', [
                'label' => __( 'Seperate Each Letter', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'easy-elementor-addons' ),
                'label_off' => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
                'depth', [
            'label' => esc_html__('Depth', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', 'rem', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 10,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 10,
                'unit' => 'px',
            ]
                ]
        );

        $this->add_control(
            'alignment', [
                'label'   => esc_html__( 'Alignment', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'left'   => array(
                        'title' => esc_html__( 'Left', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-center',
                    ),
                    'right'  => array(
                        'title' => esc_html__( 'Right', 'easy-elementor-addons' ),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
            ]
        );

        $this->add_control(
            'html_tag', [
                'label'   => esc_html__( 'HTML Tag', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => eead_html_tags(),
                'default' => 'h1',
            ]
        );

        $this->add_control(
                'layers', [
            'label' => esc_html__('Layers', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 3,
                'unit' => 'px',
            ]
                ]
        );

        $this->add_control(
            'direction', [
                'label'   => esc_html__( 'Direction', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both'   => esc_html__( 'Both', 'easy-elementor-addons' ),
                    'backwards'   => esc_html__( 'Backwards', 'easy-elementor-addons' ),
                    'forwards'   => esc_html__( 'Forwards', 'easy-elementor-addons' )
                ]
            ]
        );

        $this->add_control(
                'perspective', [
            'label' => esc_html__('Perspective', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'default' => [
                'size' => 500,
                'unit' => 'px',
            ]
                ]
        );

        $this->add_control(
            'event', [
                'label'   => esc_html__( 'Event', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'pointer',
                'options' => [
                    'none'   => esc_html__( 'None', 'easy-elementor-addons' ),
                    'pointer'   => esc_html__( 'Pointer', 'easy-elementor-addons' ),
                    'scroll'   => esc_html__( 'Scroll', 'easy-elementor-addons' ),
                    'scrollX'   => esc_html__( 'Scroll X', 'easy-elementor-addons' ),
                    'scrollY'   => esc_html__( 'Scroll Y', 'easy-elementor-addons' ),
                ]
            ]
        );

        $this->add_control(
            'event_direction', [
                'label'   => esc_html__( 'Event Direction', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'   => esc_html__( 'Default', 'easy-elementor-addons' ),
                    'reverse'   => esc_html__( 'Reverse', 'easy-elementor-addons' )
                ]
            ]
        );

        $this->add_control(
                'event_rotation', [
            'label' => esc_html__('Event Rotation', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'deg' => [
                    'min' => -360,
                    'max' => 360,
                ],
            ],
            'default' => [
                'size' => 10,
                'unit' => 'deg',
            ]
                ]
        );

        $this->add_control(
            'fade', [
                'label' => __( 'Fade', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'easy-elementor-addons' ),
                'label_off' => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style', [
                'label'     => esc_html__( 'Style', 'easy-elementor-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'depth_color', [
                'label'     => esc_html__('Depth Color', 'easy-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
                'background_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .eead-z-text' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'text_color', [
            'label' => esc_html__('Text Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-z-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'text_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'selector' => '{{WRAPPER}} .eead-z-text',
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $fade = $settings['fade'] == 'yes' ? 'true' : 'false';
        $html_tag = $settings['html_tag'];;

        $this->add_render_attribute( 'ztext', 'class', 'eead-z-text' );
        $this->add_render_attribute( 'ztext', 'class', 'eead-align-'.$settings['alignment'] );
        $this->add_render_attribute( 'ztext', 'data-z-depth', $settings['depth']['size'].'px' );
        $this->add_render_attribute( 'ztext', 'data-z-layers', $settings['layers']['size'] );
        $this->add_render_attribute( 'ztext', 'data-z-perspective', $settings['perspective']['size'].'px' );
        $this->add_render_attribute( 'ztext', 'data-z-fade', $fade );
        $this->add_render_attribute( 'ztext', 'data-z-direction', $settings['direction'] );
        $this->add_render_attribute( 'ztext', 'data-z-event', $settings['event'] );
        $this->add_render_attribute( 'ztext', 'data-z-eventDirection', $settings['event_direction'] );
        $this->add_render_attribute( 'ztext', 'data-z-eventRotation', $settings['event_rotation']['size'].'deg' );
        ?>
        <div class="container">
            <?php
            if($settings['seperate_letter'] == 'yes'){
                $texts = str_split($settings['text']);
                foreach($texts as $text) :
                ?>
                    <<?php echo esc_attr($html_tag); ?> <?php echo $this->get_render_attribute_string( 'ztext' ); ?>>
                    <?php echo esc_html($text) ?>
                    </<?php echo esc_attr($html_tag); ?>>
                <?php
                endforeach;
            } else{
            ?>
                <<?php echo esc_attr($html_tag); ?> <?php echo $this->get_render_attribute_string( 'ztext' ); ?>>
                <?php echo esc_html($settings['text']) ?>
                </<?php echo esc_attr($html_tag); ?>>
            <?php } ?>
        </div>
       <?php
    }

    protected function content_template() {
        ?>

        <#
        var fade = settings.fade == 'yes' ? 'true' : 'false';
        var html_tag = settings.html_tag;
        view.addRenderAttribute( 'ztext', {
        'class': 'eead-z-text',
        'class': 'eead-align-' + settings.alignment,
        'data-z': 'true',
        'data-z-depth': settings.depth.size + 'px',
        'data-z-layers': settings.layers.size,
        'data-z-perspective': settings.perspective.size + 'px',
        'data-z-fade': fade,
        'data-z-direction': settings.direction,
        'data-z-event': settings.event,
        'data-z-eventDirection': settings.event_direction,
        'data-z-eventRotation': settings.event_rotation.size + 'deg',
        });
        #>
        <div class="container">
            <#
            if(settings.seperate_letter == 'yes'){
                texts = settings.text.split("");
                _.each( texts, function( text, index ) {
                #>
                    <{{{html_tag}}} {{{ view.getRenderAttributeString('ztext') }}}>
                    {{{text}}}
                    </{{{html_tag}}}>
                <#
                })
            } else{
            #>
                <{{{html_tag}}} {{{ view.getRenderAttributeString('ztext') }}}>
                {{{settings.text}}}
                </{{{html_tag}}}>
            <# } #>
        </div>
        <?php
    }

}
