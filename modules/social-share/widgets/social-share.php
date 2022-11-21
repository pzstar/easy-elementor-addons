<?php

namespace EasyElementorAddons\Modules\SocialShare\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class SocialShare extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-social-share';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Social Share', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-social-icons';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
                'section_content', [
            'label' => esc_html__('Social Share', 'easy-elementor-addons'),
                ]
        );

        $this->add_control(
                'facebook', [
            'label' => esc_html__('Facebook', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'twitter', [
            'label' => esc_html__('Twitter', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'pintrest', [
            'label' => esc_html__('Pintrest', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'linkedin', [
            'label' => esc_html__('Linkedin', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'vkontakte', [
            'label' => esc_html__('VKontakte', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'tumblr', [
            'label' => esc_html__('Tumblr', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'blogger', [
            'label' => esc_html__('Blogger', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'digg', [
            'label' => esc_html__('Digg', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'reddit', [
            'label' => esc_html__('Reddit', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'delicious', [
            'label' => esc_html__('Delicious', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'wordpress', [
            'label' => esc_html__('WordPress', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'skype', [
            'label' => esc_html__('Skype', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'telegram', [
            'label' => esc_html__('Telegram', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'whatsapp', [
            'label' => esc_html__('Whatsapp', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'wechat', [
            'label' => esc_html__('WeChat', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'line', [
            'label' => esc_html__('Line', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'email', [
            'label' => esc_html__('Email', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_responsive_control(
                'column_numbers', [
            'label' => __('Columns Numbers', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 18,
                    'step' => 1,
                ]
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 4,
            ],
            'tablet_default' => [
                'size' => 2,
            ],
            'mobile_default' => [
                'size' => 1,
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-social-share-container' => 'display:grid; grid-template-columns: repeat({{column_numbers.SIZE}}, 1fr);',
                '(tablet){{WRAPPER}} .eead-social-share-container' => 'display:grid; grid-template-columns: repeat({{column_numbers_tablet.SIZE}}, 1fr);',
                '(mobile){{WRAPPER}} .eead-social-share-container' => 'display:grid; grid-template-columns: repeat({{column_numbers_mobile.SIZE}}, 1fr);',
            ],
                ]
        );

        $this->add_responsive_control(
                'button_column_gap', [
            'label' => __('Columns Space', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-social-share-container' => 'grid-column-gap: {{button_column_gap.SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-social-share-container' => 'grid-column-gap: {{button_column_gap_tablet.SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-social-share-container' => 'grid-column-gap: {{button_column_gap_mobile.SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'button_row_gap', [
            'label' => __('Row Space', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 15,
                'unit' => 'px',
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-social-share-container' => 'grid-row-gap: {{button_row_gap.SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-social-share-container' => 'grid-row-gap: {{button_row_gap_tablet.SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-social-share-container' => 'grid-row-gap: {{button_row_gap_mobile.SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_control(
                'button_border_radius', [
            'label' => __('Border Radius', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'size' => 0,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-social-share-container a' => 'border-radius: {{SIZE}}{{UNIT}};'
            ],
                ]
        );

        $this->add_responsive_control(
                'icon_horizontal_spacing', [
            'label' => __('Icon Horizontal Space', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 40,
                    'step' => 1,
                ]
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-social-share-container a i' => 'margin-right: {{icon_horizontal_spacing.SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-social-share-container a i' => 'margin-right: {{icon_horizontal_spacing_tablet.SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-social-share-container a i' => 'margin-right: {{icon_horizontal_spacing_mobile.SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'hide_icon!' => 'yes',
                'icon_alignment' => 'row'
            ]
                ]
        );

        $this->add_responsive_control(
                'icon_vertical_spacing', [
            'label' => __('Icon Vertical Space', 'easy-elementor-addons'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ]
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'desktop_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'tablet_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 5,
                'unit' => 'px',
            ],
            'selectors' => [
                '(desktop){{WRAPPER}} .eead-social-share-container a i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                '(tablet){{WRAPPER}} .eead-social-share-container a i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                '(mobile){{WRAPPER}} .eead-social-share-container a i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'hide_icon!' => 'yes',
                'icon_alignment' => 'column'
            ]
                ]
        );

        $this->add_control(
                'icon_alignment', [
            'label' => __('Icon Alignment', 'easy-elementor-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                    'title' => __('Normal', 'easy-elementor-addons'),
                    'icon' => 'fa fa-arrows-h',
                ],
                'column' => [
                    'title' => __('Row', 'easy-elementor-addons'),
                    'icon' => 'fa fa-arrows-v',
                ]
            ],
            'default' => 'row',
            'toggle' => false
                ]
        );

        $this->add_control(
                'hide_icon', [
            'label' => esc_html__('Hide Icon', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->add_control(
                'hide_text', [
            'label' => esc_html__('Hide Text', 'easy-elementor-addons'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('On', 'easy-elementor-addons'),
            'label_off' => esc_html__('Off', 'easy-elementor-addons'),
            'return_value' => 'yes',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'genral_section_style', [
            'label' => esc_html__('General', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-social-share-container a' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'text_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .eead-social-share-container a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'text_typography',
            'label' => esc_html__('Typography', 'total-plus'),
            'selector' => '{{WRAPPER}} .eead-social-share-container a',
                ]
        );

        $this->add_responsive_control(
                'button_padding', [
            'label' => __('Padding', 'easy-elementor-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .eead-social-share-container a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $facebook = esc_html($settings['facebook']);
        $twitter = esc_html($settings['twitter']);
        $pintrest = esc_html($settings['pintrest']);
        $linkedin = esc_html($settings['linkedin']);
        $vkontakte = esc_html($settings['vkontakte']);
        $tumblr = esc_html($settings['tumblr']);
        $blogger = esc_html($settings['blogger']);
        $digg = esc_html($settings['digg']);
        $reddit = esc_html($settings['reddit']);
        $delicious = esc_html($settings['delicious']);
        $wordpress = esc_html($settings['wordpress']);
        $skype = esc_html($settings['skype']);
        $telegram = esc_html($settings['telegram']);
        $whatsapp = esc_html($settings['whatsapp']);
        $wechat = esc_html($settings['wechat']);
        $line = esc_html($settings['line']);
        $email = esc_html($settings['email']);
        $hide_text = $settings['hide_text'];
        $hide_icon = $settings['hide_icon'];

        $title = get_the_title();
        $url = get_the_permalink();
        $icon_alignment_class = 'eead-ssc-align-' . $settings['icon_alignment'];

        echo '<div class="eead-social-share-container ' . $icon_alignment_class . '">';

        if ($facebook == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-facebook" href="http://www.facebook.com/sharer/sharer.php?u=' . esc_url($url) . '&amp;t=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-facebook"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Facebook', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($twitter == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-twitter" href="https://twitter.com/intent/tweet?text=' . esc_html($title) . '&url=' . $url . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-twitter"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Twitter', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($pintrest == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-pinterest" href="http://pinterest.com/pin/create/button/?url=' . esc_url($url) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-pinterest"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Pintrest', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($linkedin == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . esc_url($url) . '&title=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-linkedin"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Linkedin', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($vkontakte == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-vkontakte" href="http://vk.com/share.php?url=' . esc_url($url) . '&title=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-vk"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Vkontakte', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($tumblr == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-tumblr" href="https://www.tumblr.com/share/link?url=' . esc_url($url) . '&name=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-tumblr"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Tumblr', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($blogger == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-blogger" href="https://www.blogger.com/blog-this.g?u=' . esc_url($url) . '&n=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-blogger"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Blogger', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($digg == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-digg" href="http://digg.com/submit?url=' . esc_url($url) . '&title=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-digg"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Digg', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($reddit == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-reddit" href="https://reddit.com/submit?url=' . esc_url($url) . '&title=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-reddit"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Reddit', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($delicious == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-evernote" href="https://www.evernote.com/clip.action?url=' . esc_url($url) . '&title=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-evernote"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Evernote', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($wordpress == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-wordpress" href="https://wordpress.com/press-this.php?u=' . esc_url($url) . '&t=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-brand-wordpress"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('WordPress', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($skype == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-skype" href="https://web.skype.com/share?url=' . esc_url($url) . '&text=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-skype"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Skype', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($telegram == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-telegram" href="https://t.me/share/url?url=' . esc_url($url) . '&text=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-telegram"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Telegram', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($whatsapp == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-whatsapp" href="https://api.whatsapp.com/send?phone=&text=' . esc_html($title) . " " . esc_url($url) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-whatsapp"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Whatsapp', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($wechat == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-wechat" href="https://chart.googleapis.com/chart?cht=qr&chs=196x196&chd=t:60,40&chl=' . esc_url($url) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-wechat"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Wechat', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($line == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-line" href="ttps://lineit.line.me/share/ui?url=' . esc_url($url) . '&text=' . esc_html($title) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-line"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Line', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        if ($email == 'yes') {
            echo '<a target="_blank" class="eead-social-share-link eead-email" href="mailto:?Subject=' . esc_html($title) . '&Body=' . esc_url($url) . '">';
            echo $hide_icon != 'yes' ? '<i class="eead-icon icofont-envelope"></i>' : null;
            echo $hide_text != 'yes' ? '<span class="eead-social-share-text">' . esc_html__('Email', 'easy-elementor-addons') . '</span>' : null;
            echo '</a>';
        }
        echo '</div>';
    }

}
