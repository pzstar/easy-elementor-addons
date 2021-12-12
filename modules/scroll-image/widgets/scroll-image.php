<?php
namespace EasyElementorAddons\Modules\ScrollImage\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class ScrollImage extends Widget_Base {

	public function get_name() {
		return 'eead-scroll-image-block';
	}

	public function get_title() {
		return esc_html__( 'Scroll Image', 'easy-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-scroll';
	}

	public function get_categories() {
	 	return [ 'easy-elementor-addons' ];
 	}

 	public function get_style_depends() {
        return [ 'lightgallery' ];
    }

    public function get_script_depends() {
        return [ 'lightgallery' ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_size',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_framing',
			[
				'label' => esc_html__( 'Image Framing', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'frame',
			[
				'label'   => esc_html__( 'Select Frame', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desktop',
				'options' => [
					'desktop'    => esc_html__('Desktop', 'easy-elementor-addons') ,
					'safari'    => esc_html__('Safari', 'easy-elementor-addons') ,
					'chrome'     => esc_html__('Chrome', 'easy-elementor-addons') ,
					'chrome-dark'     => esc_html__('Chrome Dark', 'easy-elementor-addons') ,
					'firefox'     => esc_html__('Firefox', 'easy-elementor-addons') ,
					'edge'     	=> esc_html__('Edge', 'easy-elementor-addons') ,
					'edge-dark'     	=> esc_html__('Edge Dark', 'easy-elementor-addons') ,
					'macbookpro' => esc_html__('Macbook Pro', 'easy-elementor-addons') ,
					'macbookair' => esc_html__('Macbook Air', 'easy-elementor-addons') ,
					'tablet'     => esc_html__('Tablet', 'easy-elementor-addons') ,
				],
				'condition' => [
					'image_framing' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'     => __( 'Width', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range'     => [
					'px' => [
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label' => __( 'Min Height', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					],
				],
				'default' => [
					'size' => 320,
				],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_control(
			'caption',
			[
				'label'       => __( 'Caption', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your image caption', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link To', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'lightbox',
				'options' => [
					'lightbox' => __( 'Lightbox', 'easy-elementor-addons' ),
					'modal'    => __( 'Modal', 'easy-elementor-addons' ),
					'external' => __( 'External', 'easy-elementor-addons' ),
					''         => __( 'None', 'easy-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'external_link',
			[
				'label'         => __( 'External Link', 'easy-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => __( 'https://your-link.com', 'easy-elementor-addons' ),
				'default'       => [
					'url' => '#',
				],
				'condition' => [
					'link_to' => ['external', 'modal'],
				],
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label'   => __( 'Link Icon', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'fas fa-link' => [
						'title' => __( 'Link', 'easy-elementor-addons' ),
						'icon'  => 'fas fa-link',
					],
					'fas fa-plus' => [
						'title' => __( 'Plus', 'easy-elementor-addons' ),
						'icon'  => 'fas fa-plus',
					],
					'fas fa-search' => [
						'title' => __( 'Zoom', 'easy-elementor-addons' ),
						'icon'  => 'fas fa-search',
					],
				],
				'default' => 'fa fa-search',
				'condition' => [
					'link_to!' => '',
				],
			]
		);

		$this->add_control(
			'link_icon_position',
			[
				'label'     => __( 'Link Icon Position', 'easy-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
			        ''              => esc_html__('Default', 'easy-elementor-addons'),
			        'top-left'      => esc_html__('Top Left', 'easy-elementor-addons'),
			        'top-center'    => esc_html__('Top Center', 'easy-elementor-addons'),
			        'top-right'     => esc_html__('Top Right', 'easy-elementor-addons'),
			        'center'        => esc_html__('Center', 'easy-elementor-addons'),
			        'center-left'   => esc_html__('Center Left', 'easy-elementor-addons'),
			        'center-right'  => esc_html__('Center Right', 'easy-elementor-addons'),
			        'bottom-left'   => esc_html__('Bottom Left', 'easy-elementor-addons'),
			        'bottom-center' => esc_html__('Bottom Center', 'easy-elementor-addons'),
			        'bottom-right'  => esc_html__('Bottom Right', 'easy-elementor-addons'),
			    ],
				'default'   => 'center',
				'condition' => [
					'link_to!'       => '',
					'image_framing!' => 'yes',
				],
			]
		);

		$this->add_control(
			'image_scroll_option',
			[
				'label'   => esc_html__( 'Select Image Scroll', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-bottom',
				'options' => [
					'bottom-top'    => esc_html__('Bottom Top', 'easy-elementor-addons') ,
					'top-bottom'    => esc_html__('Top Bottom', 'easy-elementor-addons') ,
					'left-right'     => esc_html__('Left right', 'easy-elementor-addons') ,
					'right-left'     => esc_html__('Right Left', 'easy-elementor-addons') ,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_badge',
			[
				'label'     => __( 'Badge', 'easy-elementor-addons' ),
			]
		);

		$this->add_control(
			'badge',
			[
				'label' => __( 'Badge', 'easy-elementor-addons' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label'       => __( 'Badge Text', 'easy-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'POPULAR',
				'placeholder' => 'Type Badge Title',
				'label_block' => true
			]
		);		

		$this->add_control(
            'badge_horizontal_offset',
            [
                'label' => esc_html__( 'Horizontal Offset', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
            'badge_vertical_offset',
            [
                'label' => esc_html__( 'Vertical Offset', 'easy-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'badge_rotate',
			[
				'label'   => esc_html__( 'Rotate', 'easy-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset.SIZE}}px, {{badge_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset_tablet.SIZE}}px, {{badge_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset_mobile.SIZE}}px, {{badge_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
			]
		);

		$this->end_controls_section();

		/* Style Tab */
		$this->start_controls_section(
                'link_icon_style', [
            'label' => esc_html__('Link Icon', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

		$this->add_control(
                'link_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-link-wrapper a' => 'background: {{VALUE}}',
            ],
                ]
        );

		$this->add_control(
                'link_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-link-wrapper a' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'link_border_color', [
            'label' => esc_html__('Border Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-link-wrapper a' => 'border: 1px solid {{VALUE}}',
            ],
                ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
                'caption_style', [
            'label' => esc_html__('Caption', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );
		
        $this->add_control(
            'caption_alignment',
            array(
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
                'selectors' => [
                    '{{WRAPPER}} .eead-scroll-image-container .eead-image-caption .eead-caption-text' => 'text-align: {{VALUE}}',
                ],
            )
        );

        $this->add_control(
                'caption_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#333',
            'selectors' => [
                '{{WRAPPER}} .eead-scroll-image-container .eead-image-caption .eead-caption-text' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'caption_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .eead-scroll-image-container .eead-image-caption .eead-caption-text' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'caption_typography',
            'label' => esc_html__('Typography', 'easy-elementor-addons'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-image-caption .eead-caption-text',
                ]
        );

        $this->add_responsive_control(
			'caption_margin',
			[
				'label' => __( 'Padding', 'easy-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-image-caption .eead-caption-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
                'badge_style', [
            'label' => esc_html__('Badge', 'easy-elementor-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'badge_bg_color', [
            'label' => esc_html__('Background Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#f92b2b',
            'selectors' => [
                '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'background: {{VALUE}}',
            ],
                ]
        );

        $this->add_control(
                'badge_color', [
            'label' => esc_html__('Color', 'easy-elementor-addons'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Color::get_type(),
                'value' => Color::COLOR_1,
            ],
            'default' => '#fff',
            'selectors' => [
                '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge span' => 'color: {{VALUE}}',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(), [
            'name' => 'badge_typography',
            'label' => esc_html__('Badge', 'easy-elementor-addons'),
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge span',
                ]
        );

        $this->add_responsive_control(
			'badge_padding',
			[
				'label' => __( 'Padding', 'easy-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => __( 'Border Radius', 'easy-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eead-scroll-image-container .eead-scroll-image-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render_image($settings) {
		$image_url = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image_size', $settings);

		if ( ! $image_url ) {
			$image_url = $settings['image']['url'];
		}

		$frame      = $settings['frame'];
		$max_width  = '1280';
		$max_height = '720';
		
		if ('desktop' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('safari' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('chrome' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('chrome-dark' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('firefox' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('edge' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('edge-dark' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('macbookpro' === $frame) {
			$max_width  = '1280';
			$max_height = '815';
		} elseif ('macbookair' === $frame) {
			$max_width  = '1280';
			$max_height = '810';
		} elseif ('tablet' === $frame) {
			$max_width  = '768';
			$max_height = '1024';
		}
		
		$this->add_render_attribute( 'image-wrapper', [
			'class' => 'uk-responsive-width',
			'uk-responsive' => 'width: ' . $max_width . '; height: ' . $max_height
		]);


		if ( $settings['image_scroll_option'] == 'top-bottom' ) {
			$this->add_render_attribute( 'image', 'class', 'eead-scroll-image eead-scroll-image-top-bottom' );
		} elseif ( $settings['image_scroll_option'] == 'bottom-top' ) {
			$this->add_render_attribute( 'image', 'class', 'eead-scroll-image eead-scroll-image-bottom-top' );
		} elseif ( $settings['image_scroll_option'] == 'left-right' ) {
			$this->add_render_attribute( 'image', 'class', 'eead-scroll-image eead-scroll-image-left-right' );
		} elseif ( $settings['image_scroll_option'] == 'right-left' ) {
			$this->add_render_attribute( 'image', 'class', 'eead-scroll-image eead-scroll-image-right-left' );
		}

		$this->add_render_attribute( 'image', 'style', 'background-image: url(' . esc_url($image_url) . ');' );

		if ( $settings['image_framing'] ) { ?>
			<div class="eead-slider-device-frame">
				<img src="<?php echo EEAD_ASSETS_URL; ?>img/devices/<?php echo esc_attr( $frame ); ?>.svg" alt="">

				<div <?php echo $this->get_render_attribute_string( 'image-wrapper' ); ?>>
		<?php } ?>
					<div <?php echo $this->get_render_attribute_string( 'image' ); ?>></div>

		<?php if ( $settings['image_framing'] ) { ?>
				</div>
			</div>
		<?php 
		} 
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'eead-scroll-image-wrapper' );
		
		if ( $settings['image_framing'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'eead-device-slider eead-device-slider-' . esc_attr($settings['frame']) );
			$link_icon_position = 'center';
		} else {
			$link_icon_position = $settings['link_icon_position'];
		}

		if ( $settings['link_to'] !== '' ) {			
			if ( $settings['link_to'] == 'lightbox' ) {
				$link = $settings['image']['url'];
			} else {
				$link = $settings['external_link']['url'];
			}

			$this->add_render_attribute( 'link', [
				'href' => esc_url($link),
				'class'=> 'eead-position-'  .esc_attr( $link_icon_position )
			]);

			if ( $settings['link_icon'] ) {
				$this->add_render_attribute( 'link', [
					'class'    => 'eead-link-icon ',
				]);

				$this->add_render_attribute( 'link-wrapper', [
					'class'    => 'eead-link-wrapper ',
				]);
			}
		}

		if ( $settings['link_to'] === 'lightbox' ) {
			
			$this->add_render_attribute( 'link', [
				'class'	=> 'eead-scroll-image-lightbox-item'
			]);
		} 
		else if ( $settings['link_to'] === 'modal' ) {
			$this->add_render_attribute( 'link', [
				'class' => 'eead-scroll-image-iframe-modal',
				'data-iframe' => 'true',
				'data-src' => esc_url($link)
			]);
		}

		$this->add_render_attribute( 'container', 'class', 'eead-scroll-image-container' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
			<?php if (( $settings['link_to'] !== '' ) && ( $settings['link_icon'] == '' )) { ?>
				<a target="_blank" <?php echo $this->get_render_attribute_string( 'link' ); ?>>
			<?php } ?>

				<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
					<?php if ( !$settings['image_framing'] && !empty($settings['caption']) ) { ?>
						<figure class="eead-image-caption">
					<?php } ?>
						
						<?php $this->render_image($settings); ?>

						<?php if (($settings['link_to'] !== '') && ($settings['link_icon'] !== '')) { ?>
							<div <?php echo $this->get_render_attribute_string( 'link-wrapper' ); ?>>
								<a target="_blank" <?php echo $this->get_render_attribute_string( 'link' ); ?>>
									<i class="<?php echo esc_attr($settings['link_icon']); ?>" aria-hidden="true"></i>
								</a>
							</div>
						<?php } ?>

					<?php if ( !$settings['image_framing'] && !empty($settings['caption']) ) { ?>
							<figcaption class="eead-scroll-image-caption eead-caption-text">
								<?php echo esc_attr($settings['caption']); ?>
							</figcaption>
						</figure>
					<?php } ?>
				</div>

			<?php if (($settings['link_to']  !== '') && ($settings['link_icon'] == '')) { ?>
				</a>
			<?php } ?>

			<?php if ( $settings['badge'] && $settings['badge_text'] != '' ) : ?>
				<div class="eead-scroll-image-badge">
					<span class="eead-badge eead-padding-small"><?php echo esc_html($settings['badge_text']); ?></span>
				</div>
			<?php endif; ?>

		</div>
		<?php
	}
}
