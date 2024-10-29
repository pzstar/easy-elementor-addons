<?php

namespace EasyElementorAddons\Modules\StickyVideo\Widgets;

// Elementor Classes
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Sticky Video Widget
 */
class StickyVideo extends Widget_Base {

    public function get_name() {
        return 'eead-sticky-video';
    }

    public function get_title() {
        return esc_html__('Sticky Video', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-sticky-video';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_style_depends() {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim',
            'plyr'
        ];
    }

    public function get_script_depends() {
        return [
            'font-awesome-4-shim',
            'plyr'
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'eead_section_video_settings', [
                'label' => esc_html__('Video', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'eead_is_sticky', [
                'label' => esc_html__('Sticky', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'label_on' => esc_html__('On', 'easy-elementor-addons'),
                'label_off' => esc_html__('Off', 'easy-elementor-addons'),
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} div.eead-sticky-player' => 'display: block',
                ]
            ]
        );

        $this->add_control(
            'eead_sticky_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top-left' => esc_html__('Top Left', 'easy-elementor-addons'),
                    'top-right' => esc_html__('Top Right', 'easy-elementor-addons'),
                    'bottom-left' => esc_html__('Bottom Left', 'easy-elementor-addons'),
                    'bottom-right' => esc_html__('Bottom Right', 'easy-elementor-addons'),
                ],
                'default' => 'bottom-right',
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_video_source', [
                'label' => esc_html__('Source', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube' => esc_html__('YouTube', 'easy-elementor-addons'),
                    'self_hosted' => esc_html__('Self Hosted', 'easy-elementor-addons'),
                    'vimeo' => esc_html__('Vimeo', 'easy-elementor-addons'),
                ]
            ]
        );

        $this->add_control(
            'eead_link_youtube', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your URL (YouTube)', 'easy-elementor-addons'),
                'label_block' => false,
                'default' => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
                'condition' => [
                    'eead_video_source' => 'youtube',
                ]
            ]
        );

        $this->add_control(
            'eead_link_vimeo', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your URL (Vimeo)', 'easy-elementor-addons'),
                'label_block' => false,
                'default' => 'https://vimeo.com/76979871',
                'condition' => [
                    'eead_video_source' => 'vimeo',
                ]
            ]
        );

        $this->add_control(
            'eead_link_dailymotion', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your URL (Dailymotion)', 'easy-elementor-addons'),
                'label_block' => true,
                'condition' => [
                    'eead_video_source' => 'dailymotion',
                ]
            ]
        );

        $this->add_control(
            'eead_link_external', [
                'label' => esc_html__('External URL', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                ]
            ]
        );

        $this->add_control(
            'eead_hosted_url', [
                'label' => esc_html__('Choose File', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ]
                ],
                'media_type' => 'video',
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                    'eead_link_external' => '',
                ]
            ]
        );

        $this->add_control(
            'eead_external_url', [
                'label' => esc_html__('Link', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your URL', 'easy-elementor-addons'),
                'label_block' => false,
                'show_label' => false,
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                    'eead_link_external' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_video_self_hosted_link', [
                'label' => esc_html__('Choose File', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                    'eead_video_source_external' => '',
                ]
            ]
        );

        $this->add_control(
            'eead_start_time', [
                'label' => esc_html__('Start Time', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 1,
                'description' => 'Specify a start time (in seconds)',
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                ]
            ]
        );

        $this->add_control(
            'eead_end_time', [
                'label' => esc_html__('End Time', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 1,
                'description' => 'Specify an end time (in seconds)',
                'condition' => [
                    'eead_video_source' => 'self_hosted',
                ]
            ]
        );

        $this->add_control(
            'eead_autoplay', [
                'label' => esc_html__('Autoplay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'eead_mute', [
                'label' => esc_html__('Mute', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false
            ]
        );

        $this->add_control(
            'eead_loop', [
                'label' => esc_html__('Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false
            ]
        );

        $this->add_control(
            'eead_show_bar', [
                'label' => esc_html__('Show Bar', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .plyr__controls' => 'display: flex!important;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_video_image_overlay_section', [
                'label' => esc_html__('Image Overlay', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'eead_overlay_options', [
                'label' => esc_html__('Image Overlay', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'label_on' => esc_html__('Show', 'easy-elementor-addons'),
                'label_off' => esc_html__('Hide', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'eead_overlay_image', [
                'label' => esc_html__('Choose Image', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'eead_overlay_options' => 'yes',
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'default' => 'full',
                'name' => 'eead_overlay_image_size',
                'condition' => [
                    'eead_overlay_options' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_overlay_play_icon', [
                'label' => esc_html__('Play Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_block' => false,
                'default' => 'yes',
                'condition' => [
                    'eead_overlay_options' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_icon_new', [
                'label' => esc_html__('Choose Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-play-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'eead_overlay_options' => 'yes',
                    'eead_overlay_play_icon' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_sticky_video_interface', [
                'label' => esc_html__('Sticky Video Interface', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_sticky_width', [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 500,
                'step' => 1,
                'default' => 300,
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-player2.out' => 'width: {{VALUE}}px!important;',
                ]
            ]
        );

        $this->add_control(
            'eead_sticky_height', [
                'label' => esc_html__('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 55,
                'max' => 280,
                'step' => 1,
                'default' => 169,
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-player2.out' => 'height: {{VALUE}}px!important;',
                ]
            ]
        );

        $this->add_control(
            'eead_scroll_height_display_sticky', [
                'label' => esc_html__('Show Sticky Video On Scroll Height (%)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'eead_sticky_close_button_color', [
                'label' => esc_html__('Close Button Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'eead_is_sticky' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-player-close' => 'color: {{VALUE}}!important',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_sh_player_section', [
                'label' => esc_html__('Player', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'eead_sh_video_width', [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'eead_sh_video_border_type', [
                'label' => esc_html__('Border Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'easy-elementor-addons'),
                    'solid' => esc_html__('Solid', 'easy-elementor-addons'),
                    'double' => esc_html__('Double', 'easy-elementor-addons'),
                    'dotted' => esc_html__('Dotted', 'easy-elementor-addons'),
                    'dashed' => esc_html__('Dashed', 'easy-elementor-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-wrapper' => 'border-style: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_sh_video_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'eead_sh_video_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-wrapper' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_sh_video_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-sticky-video-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eead-sticky-video-player2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_sh_player_interface_section', [
                'label' => esc_html__('Interface', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'eead_sh_video_interface_color', [
                'label' => esc_html__('Interface Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7b6ccc',
                'selectors' => [
                    '{{WRAPPER}} .plyr__control.plyr__tab-focus' => 'box-shadow: 0 0 0 5px {{VALUE}}!important',
                    '{{WRAPPER}} .plyr__control--overlaid' => 'background: {{VALUE}}!important',
                    '{{WRAPPER}} .plyr--video .plyr__control.plyr__tab-focus' => 'background: {{VALUE}}!important',
                    '{{WRAPPER}} .plyr__control--overlaid' => 'background: {{VALUE}}!important',
                    '{{WRAPPER}} .plyr--video .plyr__control:hover' => 'background: {{VALUE}}!important',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_sh_play_button_size', [
                'label' => esc_html__('Play Button Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 15,
                        'max' => 55,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .plyr__control--overlaid' => 'padding: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'eead_sh_player_bar_section', [
                'label' => esc_html__('Bar', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'eead_sh_player_bar_padding', [
                'label' => esc_html__('Bar Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .plyr--video .plyr__controls' => 'padding: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'eead_sh_bar_margin', [
                'label' => esc_html__('Bar Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .plyr--video .plyr__controls' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $iconNew = $settings['eead_icon_new'];
        $sticky = $settings['eead_is_sticky'];
        $autoplay = ($settings['eead_autoplay'] == 'yes') ? $settings['eead_autoplay'] : 'no';
        ?>
        <div class="eead-sticky-video-wrapper">
            <?php
            if ('yes' === $settings['eead_overlay_options']) {
                $icon = '';
                if ('yes' === $settings['eead_overlay_play_icon']) {
                    if ($iconNew['value'] != '') {
                        if (is_array($iconNew['value'])) {
                            $icon = '<img src="' . $iconNew['value']['url'] . '" width="100">';
                        } else {
                            echo $icon = '<i class="' . $iconNew['value'] . '"></i>';
                        }
                    } else {
                        $icon = '<i class="eicon-play"></i>';
                    }
                }

                $this->add_render_attribute(
                    'esvp_overlay_wrapper', [
                        'class' => 'eead-overlay',
                        'style' => "background-image:url('" . $settings['eead_overlay_image']['url'] . "');",
                    ]
                );
                ?>

                <div <?php $this->print_render_attribute_string('esvp_overlay_wrapper'); ?>>
                    <div class="eead-overlay-icon"><?php echo $icon; ?></div>
                </div>
                <?php
            }

            $this->add_render_attribute(
                'esvp_overlay_wrapper2', [
                    'class' => 'eead-sticky-video-player2',
                    'data-sticky' => $sticky,
                    'data-position' => $settings['eead_sticky_position'],
                    'data-sheight' => $settings['eead_sticky_height'],
                    'data-swidth' => $settings['eead_sticky_width'],
                    'data-scroll_height' => $settings['eead_scroll_height_display_sticky']['size'],
                    'data-autoplay' => $autoplay,
                    'data-overlay' => ($settings['eead_overlay_options'] == 'yes') ? $settings['eead_overlay_options'] : 'no',
                ]
            );
            ?>
            <div <?php $this->print_render_attribute_string('esvp_overlay_wrapper2'); ?>>
                <?php
                if ('youtube' == $settings['eead_video_source']) {
                    echo wp_kses_post($this->eead_get_youtube_player());
                }

                if ('vimeo' == $settings['eead_video_source']) {
                    echo wp_kses_post($this->eead_get_vimeo_player());
                }

                if ('self_hosted' == $settings['eead_video_source']) {
                    echo wp_kses_post($this->eead_get_self_hosted_player());
                }
                ?>
                <span class="eead-sticky-player-close"><i class="fa fa-times-circle"></i></span>
            </div>
        </div>
        <?php
    }

    protected function eead_get_youtube_player() {
        $settings = $this->get_settings_for_display();
        $id = $this->eead_get_url_id();
        $autoplay = $settings['eead_autoplay'];
        $mute = $settings['eead_mute'];
        $loop = $settings['eead_loop'];

        $am = '';
        $am .= ($autoplay == 'yes' ? '"autoplay":1' : '"autoplay":0')

        ;
        $am .= ($mute == 'yes' ? ', "muted":1' : ', "muted":0');

        if ('yes' == $loop) {
            $lp = '"loop": {"active": true}';
        } else {
            $lp = '"loop": {"active": false}';
        }

        return '<div id="eead-player-' . $this->get_id() . '"
            data-plyr-provider="youtube"
            data-plyr-embed-id="' . esc_attr($id) . '"
            data-plyr-config="{' . esc_attr($am) . ', ' . esc_attr($lp) . '}">
            </div>';
    }

    protected function eead_get_vimeo_player() {
        $settings = $this->get_settings_for_display();
        $id = $this->eead_get_url_id();
        $autoplay = $settings['eead_autoplay'];
        $mute = $settings['eead_mute'];
        $loop = $settings['eead_loop'];

        $am .= $autoplay == 'yes' ? '"autoplay":1' : '"autoplay":0';
        $am .= $mute == 'yes' ? ', "muted":1' : ', "muted":0';



        if ('yes' == $loop) {
            $lp = '"loop": {"active": true}';
        } else {
            $lp = '"loop": {"active": false}';
        }

        ob_start();
        ?>
        <div id="eead-player-<?php echo $this->get_id(); ?>" data-plyr-provider="vimeo" data-plyr-embed-id="<?php echo esc_attr($id); ?>" data-plyr-config="{<?php echo esc_attr($am); ?>, <?php echo esc_attr($lp); ?>}">
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    protected function eead_get_self_hosted_player() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $video = ($settings['eead_external_url'] != '') ? $settings['eead_external_url'] : $settings['eead_hosted_url']['url'];
        $controlBars = $settings['eead_show_bar'];
        $autoplay = $settings['eead_autoplay'];
        $mute = $settings['eead_mute'];
        $loop = $settings['eead_loop'];
        $interfaceColor = $settings['eead_sh_video_interface_color'];
        $startTime = $settings['eead_start_time'];
        $endTime = $settings['eead_end_time'];

        $am = '';
        $am .= $autoplay == 'yes' ? '"autoplay":1' : '"autoplay":0';
        $am .= $mute == 'yes' ? ', "muted":1' : ', "muted":0';

        if ('yes' == $loop) {
            $lp = '"loop": {"active": true}';
        } else {
            $lp = '"loop": {"active": false}';
        }

        ob_start();
        ?>
        <video class="eead-player" id="eead-player-<?php echo $id; ?>" playsinline controls data-plyr-config="{<?php echo esc_attr($am); ?>, <?php echo esc_attr($lp); ?>}">
            <source src="<?php echo esc_attr($video); ?>#t=<?php echo esc_attr($startTime); ?>,<?php echo esc_attr($endTime); ?>" type="video/mp4" />
        </video>
        <?php
        return ob_get_clean();
    }

    protected function eead_get_url_id() {
        $settings = $this->get_settings_for_display();

        if ($settings['eead_video_source'] === 'youtube') {
            $url = $settings['eead_link_youtube'];
            $link = explode('=', parse_url($url, PHP_URL_QUERY));
            $id = $link[1];
        } else if ($settings['eead_video_source'] === 'vimeo') {
            $url = $settings['eead_link_vimeo'];
            $link = explode('/', $url);
            $id = $link[3];
        } else if ($settings['eead_video_source'] === 'self_hosted') {
            $external_url = $settings['eead_link_external'];
            $id = ($external_url == 'yes') ? $settings['eead_external_url'] : $settings['eead_hosted_url']['url'];
        }

        return $id;
    }

}
