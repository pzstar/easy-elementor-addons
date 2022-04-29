<?php

namespace EasyElementorAddons\Modules\TwitterFeed\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Tiled Posts Widget
 */
class TwitterFeed extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'eead-twitter-feed';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Twitter Feed', 'easy-elementor-addons');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-editor-h1';
    }

    /** Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /** Controls */
    protected function register_controls() {
        $this->start_controls_section(
            'section_main', [
                'label' => __( 'Main Settings', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'embed_type', [
                'label'   => __( 'Type', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'handle',
                'options' => [
                    'handle'  => __( 'Handle', 'easy-elementor-addons' ),
                    'hashtag' => __( 'Hashtag', 'easy-elementor-addons' ),
                    'collection' => __( 'Collection', 'easy-elementor-addons' ),
                    'profile' => __( 'Profile', 'easy-elementor-addons' ),
                    'list' => __( 'List', 'easy-elementor-addons' ),
                    'moments' => __( 'Moments', 'easy-elementor-addons' ),
                    'likes' => __( 'Likes', 'easy-elementor-addons' )
                ],
            ]
        );

        $this->add_control(
            'url_collection', [
                'label'       => __( 'Enter URL', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', 'easy-elementor-addons' ),
                'default'     => 'https://twitter.com/TwitterDev/timelines/539487832448843776',
                'condition'   => [
                    'embed_type' => 'collection',
                ],

            ]
        );

        $this->add_control(
            'url_profile', [
                'label'       => __( 'Enter URL', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/TwitterDev', 'easy-elementor-addons' ),
                'default'     => 'https://twitter.com/TwitterDev',
                'condition'   => [
                    'embed_type' => 'profile',
                ],

            ]
        );

        $this->add_control(
            'url_list', [
                'label'       => __( 'Enter URL', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', 'easy-elementor-addons' ),
                'default'     => 'https://twitter.com/TwitterDev/lists/national-parks',
                'condition'   => [
                    'embed_type' => 'list',
                ],

            ]
        );

        $this->add_control(
            'url_moments', [
                'label'       => __( 'Enter URL', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', 'easy-elementor-addons' ),
                'default'     => 'https://twitter.com/i/moments/625792726546558977',
                'condition'   => [
                    'embed_type' => 'moments',
                ],

            ]
        );

        $this->add_control(
            'url_likes', [
                'label'       => __( 'Enter URL', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'https://twitter.com/webtechhardik', 'easy-elementor-addons' ),
                'default'     => 'https://twitter.com/TwitterDev/likes',
                'condition'   => [
                    'embed_type' => 'likes',
                ],

            ]
        );

        $this->add_control(
            'username', [
                'label'       => __( 'Enter UserName', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( '@username', 'easy-elementor-addons' ),
                'default'     => '@TwitterDev',
                'condition'   => [
                    'embed_type' => 'handle',
                ],
            ]
        );

        $this->add_control(
            'hashtag', [
                'label'       => __( 'Enter Hashtag', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( '#hashtag', 'easy-elementor-addons' ),
                'condition'   => [
                    'embed_type' => 'hashtag',
                ],
            ]
        );

        $this->add_control(
            'display_mode_collection', [
                'label'     => __( 'Display Mode', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'timeline',
                'options'   => [
                    'timeline' => __( 'Timeline', 'easy-elementor-addons' ),
                    'grid'     => __( 'Grid', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'embed_type' => 'collection',
                ],

            ]
        );

        $this->add_control(
            'no_of_tweets', [
                'label'     => __( 'Display No of Tweets', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
                'min'       => '2',
                'max'       => '50',
                'step'      => '1',
                'condition' => [

                    'display_mode_collection' => 'grid',
                    'embed_type'              => 'collection',
                ],
            ]
        );

        $this->add_control(
            'height_collection_timeline', [
                'label'     => __( 'Height', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,
                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10,
                    ],
                ],
                'condition' => [

                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',
                ],
            ]
        );

        $this->add_control(
            'theme_collection_timeline', [
                'label'     => __( 'Theme', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', 'easy-elementor-addons' ),
                    'dark'  => __( 'Dark', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',
                ],
            ]
        );

        $this->add_control(
            'link_color_collection', [
                'label'     => __( 'Display Link Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'display_mode_collection' => 'timeline',
                    'embed_type'              => 'collection',
                ],
            ]
        );

        $this->add_control(
            'display_mode_profile', [
                'label'     => __( 'Display Mode', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'timeline',
                'options'   => [
                    'timeline' => __( 'Timeline', 'easy-elementor-addons' ),
                    'button'   => __( 'Button', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'embed_type' => [ 'profile', 'handle' ],
                ],

            ]
        );

        $this->add_control(
            'height_profile_timeline', [
                'label'     => __( 'Height', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,

                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10,
                    ],
                ],
                'condition' => [

                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ],
                ],
            ]
        );

        $this->add_control(
            'theme_profile_timeline', [
                'label'     => __( 'Theme', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', 'easy-elementor-addons' ),
                    'dark'  => __( 'Dark', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ],
                ],
            ]
        );

        $this->add_control(
            'link_color_profile', [
                'label'     => __( 'Display Link Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [

                    'display_mode_profile' => 'timeline',
                    'embed_type'           => [ 'profile', 'handle' ],
                ],
            ]
        );

        $this->add_control(
            'button_type', [
                'label'     => __( 'Button Type', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'follow-button',
                'options'   => [
                    'follow-button'  => __( 'Follow', 'easy-elementor-addons' ),
                    'mention-button' => __( 'Mention', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'display_mode_profile' => 'button',
                    'embed_type'           => [ 'profile', 'handle' ],
                ],
            ]
        );

        $this->add_control(
            'hide_name', [
                'label'        => __( 'Hide Name', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Show', 'easy-elementor-addons' ),
                'label_off'    => __( 'Hide', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'condition'    => [

                    'display_mode_profile' => 'button',
                    'button_type'          => 'follow-button',
                    'embed_type'           => [ 'profile', 'handle' ],

                ],
            ]
        );

        $this->add_control(
            'show_count', [
                'label'        => __( 'Show Count', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __( 'Show', 'easy-elementor-addons' ),
                'label_off'    => __( 'Hide', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'follow-button',

                ],
            ]
        );

        $this->add_control(
            'prefill_text', [
                'label'       => __( 'Tweet Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'description' => __( 'Do you want to prefill the Tweet text?', 'easy-elementor-addons' ),
                'condition'   => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'mention-button',
                ],

            ]
        );

        $this->add_control(
            'screen_name', [
                'label'     => __( 'Screen Name', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',
                    'button_type'          => 'mention-button',
                ],
            ]
        );

        $this->add_control(
            'large_button', [
                'label'        => __( 'Large Button', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Yes', 'easy-elementor-addons' ),
                'label_off'    => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type'           => [ 'profile', 'handle' ],
                    'display_mode_profile' => 'button',

                ],
            ]
        );

        $this->add_control(
            'height_list', [
                'label'     => __( 'Height', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 500,

                ],
                'range'     => [
                    'px' => [
                        'min'  => 250,
                        'max'  => 1300,
                        'step' => 10,
                    ],
                ],
                'condition' => [
                    'embed_type' => [ 'list', 'likes' ],
                ],
            ]
        );

        $this->add_control(
            'theme_list', [
                'label'     => __( 'Theme', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'light',
                'options'   => [
                    'light' => __( 'Light', 'easy-elementor-addons' ),
                    'dark'  => __( 'Dark', 'easy-elementor-addons' ),
                ],
                'condition' => [
                    'embed_type' => [ 'list', 'likes' ],
                ],
            ]
        );

        $this->add_control(
            'link_color_list', [
                'label'     => __( 'Display Link Color', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'embed_type' => [ 'list', 'likes' ],
                ],
            ]
        );

        $prefill_options = [];
        if ( is_single() ) {
            $prefill_options = [
                'post_title' => __( 'Post Title', 'easy-elementor-addons' ),
                'excerpt'    => __( 'Post Excerpt', 'easy-elementor-addons' ),
            ];
        }

        $prefill_options['custom'] = 'Custom';
        $this->add_control(
            'prefill_text_hashtag', [
                'label'       => __( 'Pre Fill Text', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'post_title',
                'options'     => $prefill_options,
                'condition'   => [
                    'embed_type' => 'hashtag',
                ],
                'description' => __( 'Do you want to prefill the Tweet text?', 'easy-elementor-addons' ),
            ]
        );

        $this->add_control(
            'prefill_custom', [
                'label'     => __( 'Custom Prefill Text', 'easy-elementor-addons' ),
                'type'      => Controls_Manager::TEXTAREA,
                'condition' => [
                    'prefill_text_hashtag' => 'custom',
                    'embed_type'           => 'hashtag',
                ],

            ]
        );

        $this->add_control(
            'hashtag_url', [
                'label'       => __( 'Fix Url in Tweet', 'easy-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'description' => __( 'Do you want to set a specific URL in the Tweet?', 'easy-elementor-addons' ),
                'condition'   => [
                    'embed_type' => 'hashtag',
                ],
            ]
        );

        $this->add_control(
            'language', [
                'label'   => __( 'Language', 'easy-elementor-addons' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->languages(),
                'default' => '',
            ]
        );

        $this->add_control(
            'hashtag_large_button', [
                'label'        => __( 'Large Button', 'easy-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __( 'Yes', 'easy-elementor-addons' ),
                'label_off'    => __( 'No', 'easy-elementor-addons' ),
                'return_value' => 'yes',
                'condition'    => [
                    'embed_type' => 'hashtag',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function languages() {
        $languages = [
            ''      => __( 'Automatic', 'easy-elementor-addons' ),
            'en'    => __( 'English', 'easy-elementor-addons' ),
            'ar'    => __( 'Arabic', 'easy-elementor-addons' ),
            'bn'    => __( 'Bengali', 'easy-elementor-addons' ),
            'cs'    => __( 'Czech', 'easy-elementor-addons' ),
            'da'    => __( 'Danish', 'easy-elementor-addons' ),
            'de'    => __( 'German', 'easy-elementor-addons' ),
            'el'    => __( 'Greek', 'easy-elementor-addons' ),
            'es'    => __( 'Spanish', 'easy-elementor-addons' ),
            'fa'    => __( 'Persian', 'easy-elementor-addons' ),
            'fi'    => __( 'Finnish', 'easy-elementor-addons' ),
            'fil'   => __( 'Filipino', 'easy-elementor-addons' ),
            'fr'    => __( 'French', 'easy-elementor-addons' ),
            'he'    => __( 'Hebrew', 'easy-elementor-addons' ),
            'hi'    => __( 'Hindi', 'easy-elementor-addons' ),
            'hu'    => __( 'Hungarian', 'easy-elementor-addons' ),
            'id'    => __( 'Indonesian', 'easy-elementor-addons' ),
            'it'    => __( 'Italian', 'easy-elementor-addons' ),
            'ja'    => __( 'Japanese', 'easy-elementor-addons' ),
            'ko'    => __( 'Korean', 'easy-elementor-addons' ),
            'msa'   => __( 'Malay', 'easy-elementor-addons' ),
            'nl'    => __( 'Dutch', 'easy-elementor-addons' ),
            'no'    => __( 'Norwegian', 'easy-elementor-addons' ),
            'pl'    => __( 'Polish', 'easy-elementor-addons' ),
            'pt'    => __( 'Portuguese', 'easy-elementor-addons' ),
            'ro'    => __( 'Romania', 'easy-elementor-addons' ),
            'ru'    => __( 'Rus', 'easy-elementor-addons' ),
            'sv'    => __( 'Swedish', 'easy-elementor-addons' ),
            'th'    => __( 'Thai', 'easy-elementor-addons' ),
            'tr'    => __( 'Turkish', 'easy-elementor-addons' ),
            'uk'    => __( 'Ukrainian', 'easy-elementor-addons' ),
            'ur'    => __( 'Urdu', 'easy-elementor-addons' ),
            'vi'    => __( 'Vietnamese', 'easy-elementor-addons' ),
            'zh-cn' => __( 'Chinese (Simplified)', 'easy-elementor-addons' ),
            'zh-tw' => __( 'Chinese (Traditional)', 'easy-elementor-addons' ),
        ];

        return $languages;
    }

    public function render() {
        $settings = $this->get_settings_for_display();

        if( $settings['embed_type'] == 'handle' ) {
            $this->get_handle_html( $settings );
        } else if( $settings['embed_type'] == 'hashtag' ) {
            $this->get_hashtag_html( $settings );
        } else if( $settings['embed_type'] == 'collection' ) {
            $this->get_collection_html( $settings );
        } else if( $settings['embed_type'] == 'profile' ) {
            $this->get_profile_html( $settings );
        } else if( $settings['embed_type'] == 'list' ) {
            $this->get_list_html( $settings );
        } else if( $settings['embed_type'] == 'moments' ) {
            $this->get_moments_html( $settings );
        } else if( $settings['embed_type'] == 'likes' ) {
            $this->get_likes_html( $settings );
        }
        ?>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        <?php
    }

    public function get_collection_html( $settings ) {
        $this->add_render_attribute( 'collection', [
            'class' => 'twitter-' . $settings['display_mode_collection'],
            'href' => $settings['url_collection'],
            'data-lang' => $settings['language'],
            'data-partner' => 'twitter-deck',
        ]);

        if ( $settings['display_mode_collection'] === 'grid' ) {
            $this->add_render_attribute( 'collection', 'data-limit', $settings['no_of_tweets'] );
        }
        else if ( $settings['display_mode_collection'] === 'timeline' ) {
            $this->add_render_attribute( 'collection', [
                'data-height' => $settings['height_collection_timeline']['size'],
                'data-theme' => $settings['theme_collection_timeline'],
                'data-link-color' => $settings['link_color_collection']
            ]);
        }

        ?>
        <a <?php $this->print_render_attribute_string( 'collection' ); ?>></a>
        <?php
    }

    public function get_profile_html( $settings ) {
        $this->add_render_attribute( 'profile', [
            'href' => $settings['url_profile'],
            'data-lang' => $settings['language'] 
        ]);

        if ( $settings['large_button'] === 'yes' ) {
            $this->add_render_attribute( 'profile', 'data-size', 'large' );
        }

        if ( $settings['display_mode_profile'] === 'timeline' ) {
            $this->add_render_attribute( 'profile', [
                'class' => 'twitter-' . $settings['display_mode_profile'],
                'data-partner' => 'twitter-deck', 
                'data-height' => $settings['height_profile_timeline']['size'],
                'data-theme' => $settings['theme_profile_timeline'],
                'data-link-color' => $settings['link_color_profile']
            ]);
        }

        if ( $settings['display_mode_profile'] === 'button' && $settings['button_type'] === 'follow-button' ) {
            $this->add_render_attribute( 'profile', 'class', 'twitter-' . $settings['button_type'] );
            if ( $settings['hide_name'] === 'yes' ) {
                $this->add_render_attribute( 'profile', 'data-show-screen-name', 'false' );
            }
            if ( $settings['show_count'] === '' ) {
                $this->add_render_attribute( 'profile', 'data-show-count', 'false' );
            }
        }

        if ( $settings['display_mode_profile'] === 'button' && $settings['button_type'] === 'mention-button' ) {
            $this->add_render_attribute( 'profile', [
                'class' => 'twitter-' . $settings['button_type'],
                'data-text' => $settings['prefill_text'],
                'href' => $settings['url_profile'] . '?screen_name=' . $settings['screen_name']
            ]);
        }
        ?>
        <a <?php $this->print_render_attribute_string( 'profile' ); ?> ></a>
        <?php
    }

    public function get_list_html( $settings ) {
        if ( $settings['embed_type'] === 'list' ) {
            $this->add_render_attribute( 'list', 'class', 'twitter-timeline' );
        }
        $this->add_render_attribute( 'list', [
            'href' => $settings['url_list'],
            'data-height' => $settings['height_list']['size'],
            'data-theme' => $settings['theme_list'],
            'data-link-color' => $settings['link_color_list'],
            'data-lang' => $settings['language'],
            'data-partner' => 'twitter-deck' 
        ]);
        ?>
        <a <?php $this->print_render_attribute_string( 'list' ); ?>> </a>
        <?php
    }

    public function get_moments_html( $settings ) {
        if ( $settings['embed_type'] === 'moments' ) {
            $this->add_render_attribute( 'moments', 'class', 'twitter-moment' );
        }
        $this->add_render_attribute( 'moments', [
            'href' => $settings['url_moments'],
            'data-lang' => $settings['language'],
            'data-partner' => 'twitter-deck'
        ]);
        ?>
        <a <?php $this->print_render_attribute_string( 'moments' ); ?> > </a>
        <?php
    }

    public function get_likes_html( $settings ) {

        $this->add_render_attribute( 'likes', [
            'href' => $settings['url_likes'],
            'class' => 'twitter-timeline',
            'data-height' => $settings['height_list']['size'],
            'data-theme' => $settings['theme_list'],
            'data-link-color' => $settings['link_color_list'],
            'data-lang' => $settings['language'],
            'data-partner' => 'twitter-deck'
        ]);
        ?>
        <a <?php $this->print_render_attribute_string( 'likes' ); ?> >Likes</php> </a>
        <?php
    }

    public function get_handle_html( $settings ) {

        $this->add_render_attribute( 'handle', 'data-lang', $settings['language'] );

        if ( $settings['large_button'] === 'yes' ) {
            $this->add_render_attribute( 'handle', 'data-size', 'large' );
        }

        if ( $settings['display_mode_profile'] === 'timeline' ) {
            $this->add_render_attribute( 'handle',  [
                'href' => 'https://www.twitter.com/' . $settings['username'],
                'class' => 'twitter-' . $settings['display_mode_profile'],
                'data-partner' => 'twitter-deck',
                'data-height' => $settings['height_profile_timeline']['size'],
                'data-theme' => $settings['theme_profile_timeline'],
                'data-link-color' => $settings['link_color_profile']
            ]);
        }

        if ( $settings['display_mode_profile'] === 'button' && $settings['button_type'] === 'follow-button' ) {
            $this->add_render_attribute( 'handle',  [
                'class' => 'twitter-' . $settings['button_type'],
                'href' => 'https://www.twitter.com/' . $settings['username']
            ]);
            if ( $settings['hide_name'] === 'yes' ) {
                $this->add_render_attribute( 'handle', 'data-show-screen-name', 'false' );
            }
            if ( $settings['show_count'] === '' ) {
                $this->add_render_attribute( 'handle', 'data-show-count', 'false' );
            }
        }

        if ( $settings['display_mode_profile'] === 'button' && $settings['button_type'] === 'mention-button' ) {
            $this->add_render_attribute( 'handle', [
                'class' => 'twitter-' . $settings['button_type'],
                'data-text' => $settings['prefill_text'],
                'href' => 'https://www.twitter.com/intent/tweet ?screen_name=' . $settings['screen_name']
            ]);
        }

        ?>
        <a <?php $this->print_render_attribute_string( 'handle' ); ?> > Handle <?php echo $settings['username']; ?></a>
        <?php
    }

    public function get_hashtag_html( $settings ) {

        $this->add_render_attribute( 'hashtag', [
            'class' => 'twitter-hashtag-button',
            'href'  => 'https://twitter.com/intent/tweet?button_hashtag=' . $settings['hashtag'],
            'data-lang' => $settings['language']
        ]);

        if ( $settings['prefill_text_hashtag'] === 'post_title' ) {
            $this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_title() );
        }
        if ( $settings['prefill_text_hashtag'] === 'excerpt' ) {
            $this->add_render_attribute( 'hashtag', 'data-text', $this->current_post_excerpt() );
        }
        if ( $settings['prefill_text_hashtag'] === 'custom' ) {
            $this->add_render_attribute( 'hashtag', 'data-text', $settings['prefill_custom'] );
        }
        if ( $settings['hashtag_large_button'] === 'yes' ) {
            $this->add_render_attribute( 'hashtag', 'data-size', 'large' );
        }
        $this->add_render_attribute( 'hashtag', 'data-url', $settings['hashtag_url'] );

        ?>
        <a <?php $this->print_render_attribute_string( 'hashtag' ); ?> >Tweet<?php echo $settings['hashtag']; ?> </a>
        <?php
    }

    public function current_post_title() {
        global $post;
        $title = $post->post_title;
        return $title;
    }

    public function current_post_excerpt() {
        global $post;
        if ( has_excerpt( $post->ID ) ) {
            return get_the_excerpt( $post->ID );
        }
    }
}
