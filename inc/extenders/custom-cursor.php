<?php

namespace EasyElementorAddons;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

Class CustomCursor {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct() {
        // Enqueue the required CSS/JS file.
        add_action('elementor/preview/enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('elementor/frontend/section/before_render', array($this, 'enqueue_scripts'), 10, 1);

        // Creates EEAD Global Cursor tab at the end of Advanced tab.
        add_action('elementor/element/section/section_advanced/after_section_end', array($this, 'register_controls'), 10);
        add_action('elementor/element/column/section_advanced/after_section_end', array($this, 'register_controls'), 10);
        add_action('elementor/element/common/_section_style/after_section_end', array($this, 'register_controls'), 10);

        // Editor Hooks.
        add_action('elementor/section/print_template', array($this, 'print_template'), 10, 2);
        add_action('elementor/column/print_template', array($this, 'print_template'), 10, 2);
        add_action('elementor/widget/print_template', array($this, 'print_template'), 10, 2);

        // Frontend Hooks.
        add_action('elementor/frontend/section/before_render', array($this, 'before_render'));
        add_action('elementor/frontend/column/before_render', array($this, 'before_render'));
        add_action('elementor/widget/before_render_content', array($this, 'before_render'), 10, 1);
    }

    public static function enqueue_scripts() {

        if (!wp_script_is('tweenmax', 'enqueued')) {
            wp_enqueue_script('tweenmax');
        }

        if (!wp_script_is('custom-cursor', 'enqueued')) {
            wp_enqueue_script('custom-cursor');
        }

        if (!wp_script_is('lottie', 'enqueued') ) {
            wp_enqueue_script('lottie');
        }
    }

    public function register_controls($elems) {

        $elems->start_controls_section(
            'section_eead_cursor', [
                'label' => sprintf('<i class="eead-extension-icon eead-dash-icon"></i> %s', __('Custom Mouse Cursor', 'easy-elementor-addons')),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $elems->add_control(
            'eead_global_cursor_switcher', [
                'label' => __('Enable Custom Mouse Cursor', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'eead-gCursor-',
                'render_type' => 'template',
            ]
        );

        $elems->add_control(
            'eead_cursor_type', [
                'label' => __('Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'render_type' => 'template',
                'prefix_class' => 'eead-cursor-',
                'options' => array(
                    'icon' => __('Icon', 'easy-elementor-addons'),
                    'image' => __('Image', 'easy-elementor-addons'),
                    'lottie' => __('Lottie', 'easy-elementor-addons'),
                    'fimage' => __('Follow Image', 'easy-elementor-addons'),
                    'ftext' => __('Follow Text', 'easy-elementor-addons'),
                ),
                'default' => 'icon',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_pulse', [
                'label' => __('Pulse Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('icon', 'image'),
                    'eead_cursor_buzz!' => 'yes',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_buzz', [
                'label' => __('Buzz Effect', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('icon', 'image'),
                    'eead_cursor_pulse!' => 'yes',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_icon', [
                'label' => __('Choose Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => array(
                    'value' => 'fas fa-mouse-pointer',
                    'library' => 'solid',
                ),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'icon',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_img', [
                'label' => __('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('image', 'fimage'),
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_ftext', [
                'label' => __('Follow Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('EEAD Follow Text', 'easy-elementor-addons'),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array( 'ftext' ),
                ),
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_xpos', [
                'label' => __('X Position (%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'range' => array(
                    'px' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('fimage', 'ftext'),
                ),
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_ypos', [
                'label' => __('Y Position (%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'range' => array(
                    'px' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('fimage', 'ftext'),
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_trans', [
                'label' => __('Follow Delay (s)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range' => array(
                    'px' => array(
                        'min' => 0.3,
                        'max' => 10,
                        'step' => 0.1,
                    ),
                ),
                'default'     => array(
                    'unit' => 'px',
                    'size' => 0.3,
                ),
                'description' => __('Default is 0.3s', 'easy-elementor-addons'),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array('fimage', 'ftext'),
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_lottie_url', [
                'label' => __('Animation JSON URL', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
                'description' => 'Get JSON code URL from <a href="https://lottiefiles.com/" target="_blank">here</a>',
                'label_block' => true,
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'lottie',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_loop', [
                'label' => __('Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'true',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'lottie',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_reverse', [
                'label' => __('Reverse', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'lottie',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_div', [
                'type' => Controls_Manager::DIVIDER,
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_size', [
                'label' => __('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'default' => array(
                    'size' => 20,
                ),
                'range' => array(
                    'px' => array(
                        'max' => 500,
                        'min' => 0,
                    ),
                ),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type!' => 'ftext',
                ),
                'selectors'  => array(
                    '{{WRAPPER}}.eead-cursor-icon .eead-global-cursor-{{ID}} i' => 'font-size: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.eead-cursor-icon .eead-global-cursor-{{ID}} i,
                    {{WRAPPER}}.eead-cursor-image .eead-global-cursor-{{ID}},
                    {{WRAPPER}}.eead-cursor-fimage .eead-global-cursor-{{ID}},
                    {{WRAPPER}}.eead-cursor-lottie .eead-global-cursor-{{ID}} .eead-cursor-lottie-icon,
                    {{WRAPPER}}.eead-cursor-icon .eead-global-cursor-{{ID}} .eead-cursor-icon-svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',

                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_color', [
                'label' => __( 'Color', 'easy-elementor-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => array( 'icon', 'ftext' ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-global-cursor-{{ID}}' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ),
            ]
        );

        $elems->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'eead_cursor_bgColor',
                'types' => array('classic', 'gradient'),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
                'selector'  => '{{WRAPPER}} .eead-global-cursor-{{ID}}',
            ]
        );

        $elems->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'eead_cursor_shadow',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'ftext',
                ),
                'selector'  => '{{WRAPPER}} .eead-global-cursor-{{ID}}',
            ]
        );

        $elems->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'eead_cursor_typo',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_type' => 'ftext',
                ),
                'selector'  => '{{WRAPPER}}.eead-cursor-ftext .eead-global-cursor-{{ID}} .eead-cursor-follow-text',
            ]
        );

        $elems->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'eead_cursor_border',
                'selector'  => '{{WRAPPER}} .eead-global-cursor-{{ID}}',
                'seeeadrator' => 'before',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_border_rad', [
                'label' => __( 'Border Radius', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                    'eead_cursor_adv_radius!' => 'yes',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-global-cursor-{{ID}}, {{WRAPPER}} .eead-global-cursor-{{ID}} img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_adv_radius', [
                'label' => __('Advanced Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => __('Apply custom radius values. Get the radius value from ', 'easy-elementor-addons') . '<a href="https://9elements.github.io/fancy-border-radius/" target="_blank">here</a>',
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
            ]
        );

        $elems->add_control(
            'eead_cursor_adv_radius_value', [
                'label' => __('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'selectors' => array(
                    '{{WRAPPER}} .eead-global-cursor-{{ID}}, {{WRAPPER}} .eead-global-cursor-{{ID}} img' => 'border-radius: {{VALUE}};',
                ),
                'condition' => array(
                    'eead_cursor_adv_radius' => 'yes',
                ),
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_rotate', [
                'label' => __('Rotate (Degrees)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('deg'),
                'default' => array(
                    'unit' => 'deg',
                    'size' => 0,
                ),
                'seeeadrator' => 'before',
                'selectors' => array(
                    '{{WRAPPER}} .eead-global-cursor-{{ID}}' => 'transform: rotate({{SIZE}}deg)',
                ),
                'condition'  => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
            ]
        );

        $elems->add_responsive_control(
            'eead_cursor_eeaddding', [
                'label' => __('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'condition' => array(
                    'eead_global_cursor_switcher' => 'yes',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .eead-global-cursor-{{ID}}' => 'eeaddding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            ]
        );

        $elems->end_controls_section();
    }

    public function print_template( $template, $elems ) {

        if (!$template && 'widget' === $elems->get_type()) {
            return;
        }

        $old_template = $template;
        ob_start();
        ?>

        <#
        var isEnabled = 'yes' === settings.eead_global_cursor_switcher ? true : false;
        if (isEnabled) {
            var cursorType = settings.eead_cursor_type,
                pulse = ['icon', 'image'].includes(cursorType) && 'yes' === settings.eead_cursor_pulse ? ' eead-pulse-yes ' : '',
                buzz = ['icon', 'image'].includes(cursorType) && 'yes' === settings.eead_cursor_buzz ? ' eead-buzz-yes ' : '',
                delay = ['ftext', 'fimage'].includes(cursorType) && '' !== settings.eead_cursor_trans.size ? settings.eead_cursor_trans.size : 0.01,
                elementSettings = {},
                cursorSettings = {
                    cursorType : cursorType,
                    delay: delay,
                    pulse: pulse,
                    buzz: buzz
                };

            if ( 'icon' === cursorType ) {
                elementSettings = settings.eead_cursor_icon;

            } else if ( 'image' === cursorType || 'fimage' === cursorType ) {
                elementSettings.url = settings.eead_cursor_img.url;

                if ( 'fimage' === cursorType ) {
                    elementSettings.xpos = settings.eead_cursor_xpos.size;
                    elementSettings.ypos = settings.eead_cursor_ypos.size;
                }

            } else if ( 'ftext' === cursorType ) {
                elementSettings.text = settings.eead_cursor_ftext;
                elementSettings.xpos = settings.eead_cursor_xpos.size;
                elementSettings.ypos = settings.eead_cursor_ypos.size;

            } else if ( 'lottie' === cursorType ) {
                elementSettings.url     = settings.eead_cursor_lottie_url;
                elementSettings.loop    = settings.eead_cursor_loop;
                elementSettings.reverse = settings.eead_cursor_reverse;
            }

            cursorSettings.elementSettings = elementSettings;

            view.addRenderAttribute( 'cursor_data', {
                'id': 'eead-global-cursor-' + view.getID(),
                'class': 'eead-global-cursor-wrapper',
                'data-gcursor': JSON.stringify( cursorSettings )
            });
            #>
            <div {{{view.getRenderAttributeString('cursor_data')}}}></div>
            <#
        }
        #>

        <?php
        $slider_content = ob_get_contents();
        ob_end_clean();
        $template = $slider_content . $old_template;
        return $template;
    }


    /**
     * Render Global Cursor output on the frontend.
     *
     * Written in PHP and used to collect cursor settings and add it as an element attribute.
     *
     * @access public
     * @eeadram object $elems for current element.
     */
    public function before_render( $elems ) {

        $type = $elems->get_type();
        $id = $elems->get_id();
        $settings = $elems->get_settings_for_display();
        $cursor_switcher = $settings['eead_global_cursor_switcher'];

        if ('yes' === $cursor_switcher) {

            $cursor_type = $settings['eead_cursor_type'];
            $pulse = 'yes' === $settings['eead_cursor_pulse'] ? ' eead-pulse-yes ' : '';
            $buzz = 'yes' === $settings['eead_cursor_buzz'] ? ' eead-buzz-yes ' : '';
            $elems_settings = array();
            $cursor_settings = array(
                'cursorType' => $cursor_type,
                'delay' => isset( $settings['eead_cursor_trans']['size'] ) && in_array( $cursor_type, array( 'fimage', 'ftext' ), true ) ? $settings['eead_cursor_trans']['size'] : 0.01,
                'pulse' => $pulse,
                'buzz' => $buzz,
            );

            if ('icon' === $cursor_type) {
                $elems_settings = $settings['eead_cursor_icon'];

            } elseif ('image' === $cursor_type || 'fimage' === $cursor_type) {
                $elems_settings['url'] = $settings['eead_cursor_img']['url'];
                $elems_settings['alt'] = Control_Media::get_image_alt($settings['eead_cursor_img']);

                if ('fimage' === $cursor_type) {
                    $elems_settings['xpos'] = $settings['eead_cursor_xpos']['size'];
                    $elems_settings['ypos'] = $settings['eead_cursor_ypos']['size'];
                }

            } elseif ('ftext' === $cursor_type) {
                $elems_settings['text'] = $settings['eead_cursor_ftext'];
                $elems_settings['xpos'] = $settings['eead_cursor_xpos']['size'];
                $elems_settings['ypos'] = $settings['eead_cursor_ypos']['size'];

            } elseif ('lottie' === $cursor_type) {
                $elems_settings['url'] = esc_url($settings['eead_cursor_lottie_url']);
                $elems_settings['loop'] = $settings['eead_cursor_loop'];
                $elems_settings['reverse'] = $settings['eead_cursor_reverse'];

            }

            $cursor_settings['elementSettings'] = $elems_settings;
            $elems->add_render_attribute('_wrapper', 'data-gcursor', wp_json_encode($cursor_settings));

            if ('widget' === $type && \Elementor\Plugin::instance()->editor->is_edit_mode()) {
                ?>
                <div id='eead-global-cursor-temp-<?php echo esc_html($id); ?>' data-gcursor='<?php echo wp_json_encode($cursor_settings); ?>'></div>
                <?php
            }
        }
    }
}

CustomCursor::instance();
