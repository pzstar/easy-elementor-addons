<?php
namespace EasyElementorAddons\Modules\PopupVideo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class PopupVideo extends Widget_Base {

    public function get_name() {
        return 'eead-popup-video';
    }

    public function get_title() {
        return esc_html__('Popup Video', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-video-popup';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['lightgallery1'];
    }

    public function get_style_depends() {
        return ['lightgallery1'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Video', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_type',
            [
                'label' => esc_html__('Video Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube' => esc_html__('YouTube', 'easy-elementor-addons'),
                    'vimeo' => esc_html__('Vimeo', 'easy-elementor-addons'),
                    'custom' => esc_html__('Custom', 'easy-elementor-addons')
                ]
            ]
        );

        $this->add_control(
            'youtube_url',
            [
                'label' => esc_html__('Youtube Video URL', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'input_type' => 'url',
                'placeholder' => esc_html('https://www.youtube.com/watch?v=MLpWrANjFbI'),
                'default' => esc_html('https://www.youtube.com/watch?v=MLpWrANjFbI'),
                'condition' => [
                    'video_type' => 'youtube'
                ]
            ]
        );

        $this->add_control(
            'vimeo_url',
            [
                'label' => esc_html__('Vimeo Video URL', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'input_type' => 'url',
                'placeholder' => esc_html('https://vimeo.com/1009918448'),
                'default' => esc_html('https://vimeo.com/1009918448'),
                'condition' => [
                    'video_type' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'custom_video',
            [
                'label' => esc_html__('Upload Video', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['video'],
                'condition' => [
                    'video_type' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'trigger_type',
            [
                'label' => esc_html__('Trigger Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'ripple_button' => esc_html__('Ripple Round Button', 'easy-elementor-addons'),
                    'button' => esc_html__('Simple Button', 'easy-elementor-addons'),
                    'image' => esc_html__('Image', 'easy-elementor-addons'),
                    'icon' => esc_html__('Icon', 'easy-elementor-addons'),
                    'text' => esc_html__('Text', 'easy-elementor-addons'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'play_text',
            [
                'label' => esc_html__('Play Text', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Play Video', 'easy-elementor-addons'),
                'default' => esc_html__('Play', 'easy-elementor-addons'),
                'condition' => [
                    'trigger_type' => ['button', 'text']
                ],
            ]
        );

        $this->add_control(
            'play_icon',
            [
                'label' => esc_html__('Play Icon', 'easy-elementor-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-play',
                    'library' => 'fa-solid',
                ],
                'label_block' => true,
                'condition' => [
                    'trigger_type!' => ['text'],
                ]
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__('Icon Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__('Before', 'easy-elementor-addons'),
                    'after' => esc_html__('After', 'easy-elementor-addons'),
                ],
                'condition' => [
                    'trigger_type' => ['button']
                ]
            ]
        );

        $this->add_control(
            'video_width',
            [
                'label' => esc_html__('Video Max Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 400,
                        'max' => 1200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'controls_section',
            [
                'label' => esc_html__('Play Settings', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Auto Play', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Enable MUTE below for Auto Play to work.', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'mute',
            [
                'label' => esc_html__('Mute', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => esc_html__('Player Control', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'youtube'
                ]
            ]
        );

        $this->add_control(
            'start',
            [
                'label' => esc_html__('Start Time (in sec)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'input_type' => 'number',
                'condition' => [
                    'video_type' => 'youtube'
                ]
            ]
        );

        $this->add_control(
            'end',
            [
                'label' => esc_html__('End Time (in sec)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'input_type' => 'number',
                'condition' => [
                    'video_type' => 'youtube'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Show Video Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'byline',
            [
                'label' => esc_html__('Show Video Uploader Name', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'portrait',
            [
                'label' => esc_html__('Show User Portrait (Avatar)', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo'
                ]
            ]
        );

        $this->add_control(
            'enable_video_poster',
            [
                'label' => esc_html__('Enable Video Poster', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'video_poster',
            [
                'label' => esc_html__('Upload Poster Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'enable_video_poster' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Wrapper', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );





        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Button', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('popup-video', [
            'id' => 'eead-video-popup-' . $this->get_id(),
            'class' => "eead-video-popup-button",
            'data-elementor-open-lightbox' => 'no',
            'data-video-type' => $settings['video_type'],
            'data-video-width' => isset($settings['video_width']['size']) ? $settings['video_width']['size'] . $settings['video_width']['unit'] : '800px'
        ]);

        if ($settings['enable_video_poster'] && isset($settings['video_poster']['url'])) {
            $this->add_render_attribute('popup-video', [
                'data-poster' => $settings['video_poster']['url']
            ]);
        }

        if ($settings['video_type'] == 'youtube') {
            $video_settings = [
                'autoplay' => $settings['autoplay'] ? 1 : 0,
                'controls' => $settings['controls'] ? 1 : 0,
                'mute' => $settings['mute'] ? true : false,
                'loop' => $settings['loop'] ? 1 : 0,
                'start' => $settings['start'] ? $settings['start'] : false,
                'end' => $settings['end'] ? $settings['end'] : false
            ];

            $this->add_render_attribute('popup-video', [
                'href' => $settings['youtube_url'],
                'data-settings' => wp_json_encode($video_settings),
            ]);
        } elseif ($settings['video_type'] == 'vimeo') {
            $video_settings = [
                'autoplay' => $settings['autoplay'] ? 1 : 0,
                'loop' => $settings['loop'] ? 1 : 0,
                'mute' => $settings['mute'] ? 1 : 0,
                'title' => $settings['title'] ? 1 : 0,
                'byline' => $settings['byline'] ? 1 : 0,
                'portrait' => $settings['portrait'] ? 1 : 0,
            ];

            $this->add_render_attribute('popup-video', [
                'href' => $settings['vimeo_url'],
                'data-settings' => wp_json_encode($video_settings),
            ]);
        } elseif ($settings['video_type'] == 'custom') {
            $this->add_render_attribute('popup-video', [
                'data-html' => '#eead-custom-video-' . $this->get_id(),
            ]);
        }
        ?>

        <div id="eead-custom-video-<?php echo $this->get_id(); ?>" style="display: none;">
            <video class="lg-video-object lg-html5" controls preload="none">
                <source src="<?php echo $settings['custom_video']['url']; ?>" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>

        <div class="eead-popup-video">
            <a <?php echo $this->get_render_attribute_string('popup-video'); ?>>
                <?php if ($settings['trigger_type'] == 'text') { ?>
                    <span><?php echo esc_html($settings['play_text']); ?></span>
                <?php } ?>
            </a>
        </div>


        <?php
    }
}