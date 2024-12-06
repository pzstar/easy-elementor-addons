<?php

namespace EasyElementorAddons\Modules\Weather\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use DateTime;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Weather extends Widget_Base {

    /* Widget Name */

    public function get_name() {
        return 'eead-weather';
    }

    /* Widget Title */

    public function get_title() {
        return esc_html__('Weather', 'easy-elementor-addons');
    }

    public function get_style_depends() {
        return ['weather-icons'];
    }

    /* Icon */

    public function get_icon() {
        return 'eead-element-icon eead-icons-weather';
    }

    /* Category */

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /* Controls */

    protected function register_controls() {

        $this->start_controls_section(
            'layout_section', [
                'label' => esc_html__('Layout Section', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'api-notice', [
                'type' => Controls_Manager::NOTICE,
                'heading' => esc_html__('Notice', 'easy-elementor-addons'),
                'content' => esc_html__('API key is required. To add API key ', 'easy-elementor-addons') . '<a target="_blank" href="' . admin_url('admin.php?page=eead-settings') . '">' . esc_html__('Click Here', 'easy-elementor-addons') . '.</a>'
            ]
        );

        /* Country */
        $this->add_control(
            'country_location', [
                'label' => esc_html__('Country', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->get_country_options(),
                'default' => 'AU',
                'label_block' => true
            ]
        );

        /* City */
        $this->add_control(
            'city_location', [
                'label' => esc_html__('City', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Sydney', 'easy-elementor-addons'),
                'placeholder' => esc_html__('City', 'easy-elementor-addons'),
                'separator' => 'after'
            ]
        );

        /* Units */
        $this->add_control(
            'temperature_units', [
                'label' => esc_html__('Temperature Unit', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'standard' => esc_html__('Kelvin', 'easy-elementor-addons'),
                    'metric' => esc_html__('Celsius', 'easy-elementor-addons'),
                    'imperial' => esc_html__('Fahrenheit', 'easy-elementor-addons'),
                ],
                'default' => 'metric'
            ]
        );

        $this->add_control(
            'cache_expiration', [
                'label' => esc_html__('Cache Expiration(sec)', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Please set the expiration time in seconds.', 'easy-elementor-addons'),
                'step' => 1,
                'default' => 3600
            ]
        );

        /* Round */
        $this->add_control(
            'round_temp', [
                'label' => esc_html__('Round Temprature Value', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'hide_weather_description', [
                'label' => esc_html__('Hide Weather Condition', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'hide_weather_params', [
                'label' => esc_html__('Hide Weather Variables/Parameters', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_last_updated_time', [
                'label' => esc_html__('Hide Last Updated Time', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'layout', [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons'),
                    'style3' => esc_html__('Style 3', 'easy-elementor-addons')
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style', [
                'label' => esc_html__('Container', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'container_background',
                'selector' => '{{WRAPPER}} .eead-weather-container',
            ]
        );

        $this->add_control(
            'container_background_overlay', [
                'label' => esc_html__('Background Overlay', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container:before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'container_background_image[id]!' => '',
                ]
            ]
        );

        $this->add_responsive_control(
            'container_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'container_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'none',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => true,
                        ],
                    ],
                    'color' => [
                        'default' => '#444444',
                    ]
                ],
                'selector' => '{{WRAPPER}} .eead-weather-container',
            ]
        );

        $this->add_control(
            'container_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header_style', [
                'label' => esc_html__('Header', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'header_bg_color',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-weather-header'
            ]
        );

        $this->add_control(
            'header_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'location_style', [
                'label' => esc_html__('Location', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'location_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-location' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'location_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-location'
            ]
        );

        $this->add_control(
            'location_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'weather_icon_style', [
                'label' => esc_html__('Weather Icon', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'weather_icon_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-icon i' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'weather_icon_size', [
                'label' => esc_html__('Icon Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'weather_icon_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'temperature_style', [
                'label' => esc_html__('Temperature', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'temperature_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-temperature' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'temperature_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-temperature'
            ]
        );

        $this->add_control(
            'temperature_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-temperature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style', [
                'label' => esc_html__('Weather Condition', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_weather_description!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'description_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-description' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-description'
            ]
        );

        $this->add_control(
            'description_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'feels_like_style', [
                'label' => esc_html__('Feels Like', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_weather_description!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'feels_like_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-like' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'feels_like_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-like'
            ]
        );

        $this->add_control(
            'feels_like_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-like' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'date_style', [
                'label' => esc_html__('Date', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'date_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-time' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'date_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-time'
            ]
        );

        $this->add_control(
            'date_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'weather_param_style', [
                'label' => esc_html__('Weather Parameters', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_weather_params!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'weather_param_bg_color',
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .eead-weather-container.eead-style2 .eead-weather-parameters > div',
                'condition' => [
                    'layout' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'weather_param_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.eead-style2 .eead-weather-parameters > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'weather_param_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.eead-style2 .eead-weather-parameters > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout' => 'style2'
                ]
            ]
        );

        $this->add_control(
            'weather_param_spacing', [
                'label' => esc_html__('Spacing', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-parameters' => 'gap: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->start_controls_tabs(
            'param_tabs'
        );

        $this->start_controls_tab(
            'param_label_tab',
            [
                'label' => esc_html__('Label', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'label_color', [
                'label' => esc_html__('Label Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-label' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'label_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-label'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'param_value_tab',
            [
                'label' => esc_html__('Value', 'easy-elementor-addons'),
            ]
        );

        $this->add_control(
            'value_color', [
                'label' => esc_html__('Value Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-value' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'value_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-value'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'last_updated_style', [
                'label' => esc_html__('Last Updated', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_last_updated_time!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'last_updated_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-last-update' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'last_updated_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-last-update'
            ]
        );

        $this->add_control(
            'last_updated_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-last-update' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'last_updated_alignment', [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-last-update' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        //var_dump($settings);
        $eead_general_settings = get_option('eead_general_settings', true);
        $weatherstackApiKey = isset($eead_general_settings['weather_api_key']) ? $eead_general_settings['weather_api_key'] : NULL;

        if (empty($weatherstackApiKey)) {
            echo esc_html__('Please enter the API Key first!', 'easy-elementor-addons');
            return;
        }

        $data = $this->get_weather_data($weatherstackApiKey);
        //var_dump($data);
        if (!$data) {
            return;
        }

        $layout = esc_attr($settings['layout']);
        $temp = $data['current']['temperature'];

        $weather_icon = $data['current']['weather_icons'][0];
        $weather_description = $data['current']['weather_descriptions'][0];
        $localtime = $data['location']['localtime'];
        $observation_time = $data['current']['observation_time'];
        $feelslike = $data['current']['feelslike'];
        $weather_code = $data['current']['weather_code'];
        $is_day = $data['current']['is_day'] == 'yes' ? 'day' : 'night';

        $temp_param = [
            'wind' => [
                'label' => esc_html__('Wind', 'easy-elementor-addons'),
                'value' => $data['current']['wind_speed'] . 'Km/hr ' . $data['current']['wind_dir'],
                'icon' => 'wi-windy'
            ],
            'humidity' => [
                'label' => esc_html__('Humidity', 'easy-elementor-addons'),
                'value' => $data['current']['humidity'] . ' %',
                'icon' => 'wi-humidity'
            ],
            'pressure' => [
                'label' => esc_html__('Pressure', 'easy-elementor-addons'),
                'value' => $data['current']['pressure'] . ' hPa',
                'icon' => 'wi-barometer'
            ],
            'cloudcover' => [
                'label' => esc_html__('Clouds', 'easy-elementor-addons'),
                'value' => $data['current']['cloudcover'] . ' %',
                'icon' => 'wi-cloud'
            ],
            'visibility' => [
                'label' => esc_html__('Visibility', 'easy-elementor-addons'),
                'value' => $data['current']['visibility'] . ' km',
                'icon' => 'wi-day-haze'
            ],
            'precip' => [
                'label' => esc_html__('Precipitation', 'easy-elementor-addons'),
                'value' => $data['current']['precip'] . ' mm',
                'icon' => 'wi-rain-mix'
            ],
            'uv_index' => [
                'label' => esc_html__('UV Index', 'easy-elementor-addons'),
                'value' => $data['current']['uv_index'],
                'icon' => 'wi-day-sunny'
            ]
        ];
        ?>
        <div class="eead-weather-container eead-<?php echo $layout; ?>">
            <div class="eead-weather">
                <div class="eead-weather-header">
                    <!--<img src="<?php echo esc_url($weather_icon) ?>" alt="<?php echo esc_attr($weather_description); ?>">-->
                    <div class="eead-weather-info">
                        <div class="eead-weather-location">
                            <i class="icofont icofont-location-pin"></i>
                            <span class="eead-weather-city"><?php echo esc_html($data['location']['name']); ?>,</span>
                            <span class="eead-weather-country"><?php echo esc_html($data['location']['country']); ?></s>
                        </div>

                        <?php
                        if ($settings['layout'] == 'style1') {
                            $this->render_icon($weather_code, $is_day);
                        }

                        if ($settings['layout'] != 'style3') {
                            $this->render_temperature($temp);
                        } ?>

                        <div class="eead-weather-time">
                            <?php echo esc_html($this->get_time($localtime, 'l, d  M')); ?>
                        </div>
                    </div>

                    <?php
                    if ($settings['layout'] == 'style3') {
                        $this->render_icon($weather_code, $is_day);
                    } ?>


                    <div class="eead-weather-detail">
                        <?php
                        if ($settings['layout'] == 'style2') {
                            $this->render_icon($weather_code, $is_day);
                        }

                        if ($settings['layout'] == 'style3') {
                            $this->render_temperature($temp);
                        } ?>

                        <?php if ($settings['hide_weather_description'] != 'yes') { ?>

                            <div class="eead-weather-description">
                                <?php echo esc_html($weather_description); ?>
                            </div>

                            <div class="eead-weather-like">
                                <?php echo esc_html__('Feels Like ', 'easy-elementor-addons') . $this->get_temp($feelslike); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>


                <?php if ($settings['hide_weather_params'] != 'yes') { ?>
                    <div class="eead-weather-parameters">
                        <?php
                        $show_params = array('wind', 'humidity', 'pressure', 'cloudcover', 'visibility', 'precip', 'uv_index');
                        foreach ($show_params as $param) {
                            echo '<div class="eead-weather-' . $param . '">';
                            echo '<span class="eead-weather-label"><i class="wi ' . $temp_param[$param]['icon'] . '"></i><span>' . $temp_param[$param]['label'] . '</span></span>';
                            echo '<span class="eead-weather-value">' . $temp_param[$param]['value'] . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                <?php } ?>

                <?php if ($settings['hide_last_updated_time'] != 'yes') { ?>
                    <div class="eead-weather-last-update"><?php echo esc_html__('Last Updated: ', 'easy-elementor-addons') . esc_html($observation_time); ?></div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    protected function render_temperature($temp) {
        echo '<div class="eead-weather-temperature">';
        echo $this->get_temp($temp);
        echo '</div>';
    }

    protected function render_icon($weather_code, $is_day) {
        $icon_mapping = array(
            395 => 'wi-' . $is_day . '-storm-showers',
            392 => 'wi-' . $is_day . '-storm-showers',
            389 => 'wi-' . $is_day . '-thunderstorm',
            386 => 'wi-' . $is_day . '-storm-showers',
            377 => 'wi-' . $is_day . '-hail',
            374 => 'wi-' . $is_day . '-sleet',
            371 => 'wi-' . $is_day . '-snow',
            368 => 'wi-' . $is_day . '-snow',
            365 => 'wi-' . $is_day . '-sleet',
            362 => 'wi-' . $is_day . '-sleet',
            359 => 'wi-' . $is_day . '-rain',
            356 => 'wi-' . $is_day . '-rain',
            353 => 'wi-' . $is_day . '-sprinkle',
            350 => 'wi-' . $is_day . '-hail',
            338 => 'wi-' . $is_day . '-snow',
            335 => 'wi-' . $is_day . '-snow',
            332 => 'wi-' . $is_day . '-snow',
            329 => 'wi-' . $is_day . '-snow',
            326 => 'wi-' . $is_day . '-snow',
            323 => 'wi-' . $is_day . '-snow',
            320 => 'wi-' . $is_day . '-sleet',
            317 => 'wi-' . $is_day . '-sleet',
            314 => 'wi-' . $is_day . '-sleet',
            311 => 'wi-' . $is_day . '-sleet',
            308 => 'wi-' . $is_day . '-rain',
            305 => 'wi-' . $is_day . '-rain',
            302 => 'wi-' . $is_day . '-showers',
            299 => 'wi-' . $is_day . '-showers',
            296 => 'wi-' . $is_day . '-sprinkle',
            293 => 'wi-' . $is_day . '-sprinkle',
            284 => 'wi-' . $is_day . '-sleet',
            281 => 'wi-' . $is_day . '-sleet',
            266 => 'wi-' . $is_day . '-sprinkle',
            263 => 'wi-' . $is_day . '-sprinkle',
            260 => 'wi-' . $is_day . '-fog',
            248 => 'wi-' . $is_day . '-fog',
            230 => 'wi-' . $is_day . '-snow-wind',
            227 => 'wi-' . $is_day . '-snow',
            200 => 'wi-' . $is_day . '-storm-showers',
            185 => 'wi-' . $is_day . '-sleet',
            182 => 'wi-' . $is_day . '-sleet',
            179 => 'wi-' . $is_day . '-snow',
            176 => 'wi-' . $is_day . '-sprinkle',
            143 => 'wi-' . $is_day . '-sprinkle',
            122 => 'wi-' . $is_day . '-fog',
            119 => 'wi-' . $is_day . '-cloudy',
            116 => 'wi-' . $is_day . '-cloudy',
            113 => 'wi-day-sunny'
        );
        echo '<div class="eead-weather-icon">';
        echo '<i class="wi ' . $icon_mapping[$weather_code] . '"></i>';
        echo '</div>';
    }

    protected function get_time($datetime, $format) {
        $date = date_create_from_format('Y-m-d', $datetime);
        $date = new DateTime($date);
        return date_i18n($format, date_timestamp_get($date));
    }

    protected function get_temp($temp) {
        $units = $this->get_settings_for_display('temperature_units');
        $unit = ($units == 'metric') ? 'm' : (($units == 'standard') ? 's' : 'f');

        if ($unit == 'm') {
            $temp_unit = '&#176;C';
        } else if ($unit == 's') {
            $temp = ($temp + 273.15);
            $temp_unit = '&#176;K';
        } else if ($unit == 'f') {
            $temp = ($temp * 1.8) + 32;
            $temp_unit = '&#176;F';
        }

        $temp = $this->get_settings_for_display('round_temp') == 'yes' ? round($temp) : $temp;
        $temp_val = sprintf('%1$s%2$s', $temp, $temp_unit);
        return $temp_val;
    }

    protected function get_weather_data($weatherstackApiKey) {
        $settings = $this->get_settings_for_display();
        $widgetID = $this->get_id();

        $city = $settings['city_location'];
        $country = $settings['country_location'];
        if (empty($city) or empty($country)) {
            echo esc_html__('Oops! It seems that you have left either the city or the country field empty', 'easy-elementor-addons');
            return;
        }


        if (!empty($city)) {
            $location = $city;
            if (!empty($country)) {
                $location .= ',' . $country;
            }
        }
        $transientKey = sprintf('eead-weather-%s-%s', $city, md5($widgetID));
        $weatherTransientData = get_transient($transientKey);

        if (!isset($weatherTransientData) || empty($weatherTransientData)) {
            /* Weather Stack Api Args */
            $request_args = [
                'access_key' => $weatherstackApiKey,
                'query' => urlencode($location),
                'forecast_days' => 6,
                'hourly' => 1,
                'units' => 'm'
            ];

            $request_url = add_query_arg(
                $request_args, 'http://api.weatherstack.com/current'
            );

            $response = wp_remote_get($request_url, array('timeout' => 30));
            $remote_data = wp_remote_retrieve_body($response);
            $remote_data = json_decode($remote_data, true);

            /* Check if something went wrong while fetching from api */
            if (!$remote_data || is_wp_error($remote_data)) {
                echo esc_html__('Oops! Something went wrong while fetching the data', 'easy-elementor-addons');
                return;
            }

            if (isset($remote_data['error'])) {
                if (isset($remote_data['error']['info'])) {
                    echo $remote_data['error']['info'];
                } else {
                    echo esc_html__('Weather data of this location not found.', 'easy-elementor-addons');
                }
                return;
            }
            set_transient($transientKey, $remote_data, $settings['cache_expiration']);

            return $remote_data;
        } else {
            return $weatherTransientData;
        }
    }

    protected function get_country_options() {
        return [
            'IR' => __('Iran, Islamic Republic of', 'easy-elementor-addons'),
            'CY' => __('Cyprus', 'easy-elementor-addons'),
            'SO' => __('Somalia', 'easy-elementor-addons'),
            'YE' => __('Yemen', 'easy-elementor-addons'),
            'LY' => __('Libya', 'easy-elementor-addons'),
            'IQ' => __('Iraq', 'easy-elementor-addons'),
            'SA' => __('Saudi Arabia', 'easy-elementor-addons'),
            'AO' => __('Angola', 'easy-elementor-addons'),
            'AZ' => __('Azerbaijan', 'easy-elementor-addons'),
            'TZ' => __('Tanzania, United Republic of', 'easy-elementor-addons'),
            'TM' => __('Turkmenistan', 'easy-elementor-addons'),
            'SY' => __('Syrian Arab Republic', 'easy-elementor-addons'),
            'AM' => __('Armenia', 'easy-elementor-addons'),
            'ZM' => __('Zambia', 'easy-elementor-addons'),
            'KE' => __('Kenya', 'easy-elementor-addons'),
            'RW' => __('Rwanda', 'easy-elementor-addons'),
            'CD' => __('Congo, the Democratic Republic of the', 'easy-elementor-addons'),
            'DJ' => __('Djibouti', 'easy-elementor-addons'),
            'UG' => __('Uganda', 'easy-elementor-addons'),
            'MW' => __('Malawi', 'easy-elementor-addons'),
            'CF' => __('Central African Republic', 'easy-elementor-addons'),
            'SC' => __('Seychelles', 'easy-elementor-addons'),
            'TD' => __('Chad', 'easy-elementor-addons'),
            'JO' => __('Jordan', 'easy-elementor-addons'),
            'GR' => __('Greece', 'easy-elementor-addons'),
            'LB' => __('Lebanon', 'easy-elementor-addons'),
            'PS' => __('Palestine, State of', 'easy-elementor-addons'),
            'IL' => __('Israel', 'easy-elementor-addons'),
            'KW' => __('Kuwait', 'easy-elementor-addons'),
            'OM' => __('Oman', 'easy-elementor-addons'),
            'QA' => __('Qatar', 'easy-elementor-addons'),
            'BH' => __('Bahrain', 'easy-elementor-addons'),
            'AE' => __('United Arab Emirates', 'easy-elementor-addons'),
            'TR' => __('Turkey', 'easy-elementor-addons'),
            'ET' => __('Ethiopia', 'easy-elementor-addons'),
            'ER' => __('Eritrea', 'easy-elementor-addons'),
            'EG' => __('Egypt', 'easy-elementor-addons'),
            'AL' => __('Albania', 'easy-elementor-addons'),
            'SD' => __('Sudan', 'easy-elementor-addons'),
            'SS' => __('South Sudan', 'easy-elementor-addons'),
            'BI' => __('Burundi', 'easy-elementor-addons'),
            'RU' => __('Russian Federation', 'easy-elementor-addons'),
            'LV' => __('Latvia', 'easy-elementor-addons'),
            'EE' => __('Estonia', 'easy-elementor-addons'),
            'LT' => __('Lithuania', 'easy-elementor-addons'),
            'UZ' => __('Uzbekistan', 'easy-elementor-addons'),
            'SE' => __('Sweden', 'easy-elementor-addons'),
            'KZ' => __('Kazakhstan', 'easy-elementor-addons'),
            'GE' => __('Georgia', 'easy-elementor-addons'),
            'UA' => __('Ukraine', 'easy-elementor-addons'),
            'MD' => __('Moldova, Republic of', 'easy-elementor-addons'),
            'BY' => __('Belarus', 'easy-elementor-addons'),
            'FI' => __('Finland', 'easy-elementor-addons'),
            'RO' => __('Romania', 'easy-elementor-addons'),
            'HU' => __('Hungary', 'easy-elementor-addons'),
            'SK' => __('Slovakia', 'easy-elementor-addons'),
            'BG' => __('Bulgaria', 'easy-elementor-addons'),
            'PL' => __('Poland', 'easy-elementor-addons'),
            'RS' => __('Serbia', 'easy-elementor-addons'),
            'MK' => __('Macedonia, the Former Yugoslav Republic of', 'easy-elementor-addons'),
            'XK' => __('Kosovo', 'easy-elementor-addons'),
            'NA' => __('Namibia', 'easy-elementor-addons'),
            'ZW' => __('Zimbabwe', 'easy-elementor-addons'),
            'KM' => __('Comoros', 'easy-elementor-addons'),
            'YT' => __('Mayotte', 'easy-elementor-addons'),
            'LS' => __('Lesotho', 'easy-elementor-addons'),
            'BW' => __('Botswana', 'easy-elementor-addons'),
            'MU' => __('Mauritius', 'easy-elementor-addons'),
            'SZ' => __('Swaziland', 'easy-elementor-addons'),
            'RE' => __('Réunion', 'easy-elementor-addons'),
            'ZA' => __('South Africa', 'easy-elementor-addons'),
            'MZ' => __('Mozambique', 'easy-elementor-addons'),
            'MG' => __('Madagascar', 'easy-elementor-addons'),
            'PK' => __('Pakistan', 'easy-elementor-addons'),
            'TH' => __('Thailand', 'easy-elementor-addons'),
            'AF' => __('Afghanistan', 'easy-elementor-addons'),
            'IN' => __('India', 'easy-elementor-addons'),
            'BD' => __('Bangladesh', 'easy-elementor-addons'),
            'ID' => __('Indonesia', 'easy-elementor-addons'),
            'TJ' => __('Tajikistan', 'easy-elementor-addons'),
            'MY' => __('Malaysia', 'easy-elementor-addons'),
            'KG' => __('Kyrgyzstan', 'easy-elementor-addons'),
            'LK' => __('Sri Lanka', 'easy-elementor-addons'),
            'BT' => __('Bhutan', 'easy-elementor-addons'),
            'CN' => __('China', 'easy-elementor-addons'),
            'MV' => __('Maldives', 'easy-elementor-addons'),
            'NP' => __('Nepal', 'easy-elementor-addons'),
            'MM' => __('Myanmar', 'easy-elementor-addons'),
            'MN' => __('Mongolia', 'easy-elementor-addons'),
            'TF' => __('French Southern Territories', 'easy-elementor-addons'),
            'VN' => __('Viet Nam', 'easy-elementor-addons'),
            'TL' => __('Timor-Leste', 'easy-elementor-addons'),
            'LA' => __('Lao People\'s Democratic Republic', 'easy-elementor-addons'),
            'TW' => __('Taiwan, Province of China', 'easy-elementor-addons'),
            'PH' => __('Philippines', 'easy-elementor-addons'),
            'HK' => __('Hong Kong', 'easy-elementor-addons'),
            'BN' => __('Brunei Darussalam', 'easy-elementor-addons'),
            'MO' => __('Macao', 'easy-elementor-addons'),
            'KH' => __('Cambodia', 'easy-elementor-addons'),
            'KR' => __('Korea, Republic of', 'easy-elementor-addons'),
            'JP' => __('Japan', 'easy-elementor-addons'),
            'KP' => __('Korea, Democratic People\'s Republic of', 'easy-elementor-addons'),
            'SG' => __('Singapore', 'easy-elementor-addons'),
            'AU' => __('Australia', 'easy-elementor-addons'),
            'CX' => __('Christmas Island', 'easy-elementor-addons'),
            'FM' => __('Micronesia, Federated States of', 'easy-elementor-addons'),
            'PG' => __('Papua New Guinea', 'easy-elementor-addons'),
            'SB' => __('Solomon Islands', 'easy-elementor-addons'),
            'KI' => __('Kiribati', 'easy-elementor-addons'),
            'TV' => __('Tuvalu', 'easy-elementor-addons'),
            'MH' => __('Marshall Islands', 'easy-elementor-addons'),
            'VU' => __('Vanuatu', 'easy-elementor-addons'),
            'NC' => __('New Caledonia', 'easy-elementor-addons'),
            'NF' => __('Norfolk Island', 'easy-elementor-addons'),
            'NZ' => __('New Zealand', 'easy-elementor-addons'),
            'FJ' => __('Fiji', 'easy-elementor-addons'),
            'CM' => __('Cameroon', 'easy-elementor-addons'),
            'SN' => __('Senegal', 'easy-elementor-addons'),
            'CG' => __('Congo', 'easy-elementor-addons'),
            'PT' => __('Portugal', 'easy-elementor-addons'),
            'LR' => __('Liberia', 'easy-elementor-addons'),
            'CI' => __('Côte d\'Ivoire', 'easy-elementor-addons'),
            'GH' => __('Ghana', 'easy-elementor-addons'),
            'GQ' => __('Equatorial Guinea', 'easy-elementor-addons'),
            'NG' => __('Nigeria', 'easy-elementor-addons'),
            'BF' => __('Burkina Faso', 'easy-elementor-addons'),
            'TG' => __('Togo', 'easy-elementor-addons'),
            'GW' => __('Guinea-Bissau', 'easy-elementor-addons'),
            'MR' => __('Mauritania', 'easy-elementor-addons'),
            'BJ' => __('Benin', 'easy-elementor-addons'),
            'GA' => __('Gabon', 'easy-elementor-addons'),
            'SL' => __('Sierra Leone', 'easy-elementor-addons'),
            'ST' => __('Sao Tome and Principe', 'easy-elementor-addons'),
            'GI' => __('Gibraltar', 'easy-elementor-addons'),
            'GM' => __('Gambia', 'easy-elementor-addons'),
            'GN' => __('Guinea', 'easy-elementor-addons'),
            'NE' => __('Niger', 'easy-elementor-addons'),
            'ML' => __('Mali', 'easy-elementor-addons'),
            'EH' => __('Western Sahara', 'easy-elementor-addons'),
            'TN' => __('Tunisia', 'easy-elementor-addons'),
            'DZ' => __('Algeria', 'easy-elementor-addons'),
            'ES' => __('Spain', 'easy-elementor-addons'),
            'IT' => __('Italy', 'easy-elementor-addons'),
            'MA' => __('Morocco', 'easy-elementor-addons'),
            'MT' => __('Malta', 'easy-elementor-addons'),
            'DK' => __('Denmark', 'easy-elementor-addons'),
            'FO' => __('Faroe Islands', 'easy-elementor-addons'),
            'IS' => __('Iceland', 'easy-elementor-addons'),
            'GB' => __('United Kingdom', 'easy-elementor-addons'),
            'CH' => __('Switzerland', 'easy-elementor-addons'),
            'SJ' => __('Svalbard and Jan Mayen', 'easy-elementor-addons'),
            'NL' => __('Netherlands', 'easy-elementor-addons'),
            'AT' => __('Austria', 'easy-elementor-addons'),
            'BE' => __('Belgium', 'easy-elementor-addons'),
            'DE' => __('Germany', 'easy-elementor-addons'),
            'LU' => __('Luxembourg', 'easy-elementor-addons'),
            'IE' => __('Ireland', 'easy-elementor-addons'),
            'FR' => __('France', 'easy-elementor-addons'),
            'MC' => __('Monaco', 'easy-elementor-addons'),
            'AD' => __('Andorra', 'easy-elementor-addons'),
            'AX' => __('Åland Islands', 'easy-elementor-addons'),
            'LI' => __('Liechtenstein', 'easy-elementor-addons'),
            'JE' => __('Jersey', 'easy-elementor-addons'),
            'IM' => __('Isle of Man', 'easy-elementor-addons'),
            'GG' => __('Guernsey', 'easy-elementor-addons'),
            'CZ' => __('Czech Republic', 'easy-elementor-addons'),
            'NO' => __('Norway', 'easy-elementor-addons'),
            'SM' => __('San Marino', 'easy-elementor-addons'),
            'BA' => __('Bosnia and Herzegovina', 'easy-elementor-addons'),
            'HR' => __('Croatia', 'easy-elementor-addons'),
            'SI' => __('Slovenia', 'easy-elementor-addons'),
            'ME' => __('Montenegro', 'easy-elementor-addons'),
            'SH' => __('Saint Helena, Ascension and Tristan da Cunha', 'easy-elementor-addons'),
            'BB' => __('Barbados', 'easy-elementor-addons'),
            'CV' => __('Cape Verde', 'easy-elementor-addons'),
            'GY' => __('Guyana', 'easy-elementor-addons'),
            'GF' => __('French Guiana', 'easy-elementor-addons'),
            'SR' => __('Suriname', 'easy-elementor-addons'),
            'BR' => __('Brazil', 'easy-elementor-addons'),
            'GL' => __('Greenland', 'easy-elementor-addons'),
            'PM' => __('Saint Pierre and Miquelon', 'easy-elementor-addons'),
            'GS' => __('South Georgia and the South Sandwich Islands', 'easy-elementor-addons'),
            'FK' => __('Falkland Islands (Malvinas)', 'easy-elementor-addons'),
            'AR' => __('Argentina', 'easy-elementor-addons'),
            'PY' => __('Paraguay', 'easy-elementor-addons'),
            'UY' => __('Uruguay', 'easy-elementor-addons'),
            'VE' => __('Venezuela, Bolivarian Republic of', 'easy-elementor-addons'),
            'MX' => __('Mexico', 'easy-elementor-addons'),
            'JM' => __('Jamaica', 'easy-elementor-addons'),
            'DO' => __('Dominican Republic', 'easy-elementor-addons'),
            'CW' => __('Curaçao', 'easy-elementor-addons'),
            'SX' => __('Sint Maarten (Dutch part)', 'easy-elementor-addons'),
            'CU' => __('Cuba', 'easy-elementor-addons'),
            'MQ' => __('Martinique', 'easy-elementor-addons'),
            'BS' => __('Bahamas', 'easy-elementor-addons'),
            'BM' => __('Bermuda', 'easy-elementor-addons'),
            'AI' => __('Anguilla', 'easy-elementor-addons'),
            'TT' => __('Trinidad and Tobago', 'easy-elementor-addons'),
            'KN' => __('Saint Kitts and Nevis', 'easy-elementor-addons'),
            'DM' => __('Dominica', 'easy-elementor-addons'),
            'AG' => __('Antigua and Barbuda', 'easy-elementor-addons'),
            'LC' => __('Saint Lucia', 'easy-elementor-addons'),
            'TC' => __('Turks and Caicos Islands', 'easy-elementor-addons'),
            'AW' => __('Aruba', 'easy-elementor-addons'),
            'VG' => __('Virgin Islands, British', 'easy-elementor-addons'),
            'VC' => __('Saint Vincent and the Grenadines', 'easy-elementor-addons'),
            'MS' => __('Montserrat', 'easy-elementor-addons'),
            'GP' => __('Guadeloupe', 'easy-elementor-addons'),
            'MF' => __('Saint Martin (French part)', 'easy-elementor-addons'),
            'BL' => __('Saint Barthélemy', 'easy-elementor-addons'),
            'GD' => __('Grenada', 'easy-elementor-addons'),
            'KY' => __('Cayman Islands', 'easy-elementor-addons'),
            'BZ' => __('Belize', 'easy-elementor-addons'),
            'SV' => __('El Salvador', 'easy-elementor-addons'),
            'GT' => __('Guatemala', 'easy-elementor-addons'),
            'HN' => __('Honduras', 'easy-elementor-addons'),
            'NI' => __('Nicaragua', 'easy-elementor-addons'),
            'CR' => __('Costa Rica', 'easy-elementor-addons'),
            'EC' => __('Ecuador', 'easy-elementor-addons'),
            'CO' => __('Colombia', 'easy-elementor-addons'),
            'PE' => __('Peru', 'easy-elementor-addons'),
            'PA' => __('Panama', 'easy-elementor-addons'),
            'HT' => __('Haiti', 'easy-elementor-addons'),
            'CL' => __('Chile', 'easy-elementor-addons'),
            'BO' => __('Bolivia, Plurinational State of', 'easy-elementor-addons'),
            'PN' => __('Pitcairn', 'easy-elementor-addons'),
            'TO' => __('Tonga', 'easy-elementor-addons'),
            'PF' => __('French Polynesia', 'easy-elementor-addons'),
            'WF' => __('Wallis and Futuna', 'easy-elementor-addons'),
            'WS' => __('Samoa', 'easy-elementor-addons'),
            'CK' => __('Cook Islands', 'easy-elementor-addons'),
            'NU' => __('Niue', 'easy-elementor-addons'),
            'GU' => __('Guam', 'easy-elementor-addons'),
            'US' => __('United States', 'easy-elementor-addons'),
            'PR' => __('Puerto Rico', 'easy-elementor-addons'),
            'VI' => __('Virgin Islands, U.S.', 'easy-elementor-addons'),
            'AS' => __('American Samoa', 'easy-elementor-addons'),
            'CA' => __('Canada', 'easy-elementor-addons'),
            'VA' => __('Holy See (Vatican City State)', 'easy-elementor-addons'),
            'PW' => __('Palau', 'easy-elementor-addons'),
            'CC' => __('Cocos (Keeling) Islands', 'easy-elementor-addons'),
            'NR' => __('Nauru', 'easy-elementor-addons'),
            'MP' => __('Northern Mariana Islands', 'easy-elementor-addons'),
            'BQ' => __('Bonaire, Sint Eustatius and Saba', 'easy-elementor-addons'),
            'AQ' => __('Antarctica', 'easy-elementor-addons'),
            'BV' => __('Bouvet Island', 'easy-elementor-addons'),
            'IO' => __('British Indian Ocean Territory', 'easy-elementor-addons'),
            'HM' => __('Heard Island and McDonald Islands', 'easy-elementor-addons'),
            'TK' => __('Tokelau', 'easy-elementor-addons'),
            'UM' => __('United States Minor Outlying Islands', 'easy-elementor-addons'),
        ];
    }

    protected function get_language_options() {

        return [
            'ab' => __('Abkhaz', 'easy-elementor-addons'),
            'aa' => __('Afar', 'easy-elementor-addons'),
            'af' => __('Afrikaans', 'easy-elementor-addons'),
            'ak' => __('Akan', 'easy-elementor-addons'),
            'sq' => __('Albanian', 'easy-elementor-addons'),
            'am' => __('Amharic', 'easy-elementor-addons'),
            'ar' => __('Arabic', 'easy-elementor-addons'),
            'an' => __('Aragonese', 'easy-elementor-addons'),
            'hy' => __('Armenian', 'easy-elementor-addons'),
            'as' => __('Assamese', 'easy-elementor-addons'),
            'av' => __('Avaric', 'easy-elementor-addons'),
            'ae' => __('Avestan', 'easy-elementor-addons'),
            'ay' => __('Aymara', 'easy-elementor-addons'),
            'az' => __('Azerbaijani', 'easy-elementor-addons'),
            'bm' => __('Bambara', 'easy-elementor-addons'),
            'ba' => __('Bashkir', 'easy-elementor-addons'),
            'eu' => __('Basque', 'easy-elementor-addons'),
            'be' => __('Belarusian', 'easy-elementor-addons'),
            'bn' => __('Bengali; Bangla', 'easy-elementor-addons'),
            'bh' => __('Bihari', 'easy-elementor-addons'),
            'bi' => __('Bislama', 'easy-elementor-addons'),
            'bs' => __('Bosnian', 'easy-elementor-addons'),
            'br' => __('Breton', 'easy-elementor-addons'),
            'bg' => __('Bulgarian', 'easy-elementor-addons'),
            'my' => __('Burmese', 'easy-elementor-addons'),
            'ca' => __('Catalan; Valencian', 'easy-elementor-addons'),
            'ch' => __('Chamorro', 'easy-elementor-addons'),
            'ce' => __('Chechen', 'easy-elementor-addons'),
            'ny' => __('Chichewa; Chewa; Nyanja', 'easy-elementor-addons'),
            'zh' => __('Chinese', 'easy-elementor-addons'),
            'cv' => __('Chuvash', 'easy-elementor-addons'),
            'kw' => __('Cornish', 'easy-elementor-addons'),
            'co' => __('Corsican', 'easy-elementor-addons'),
            'cr' => __('Cree', 'easy-elementor-addons'),
            'hr' => __('Croatian', 'easy-elementor-addons'),
            'cs' => __('Czech', 'easy-elementor-addons'),
            'da' => __('Danish', 'easy-elementor-addons'),
            'dv' => __('Divehi; Dhivehi; Maldivian;', 'easy-elementor-addons'),
            'nl' => __('Dutch', 'easy-elementor-addons'),
            'dz' => __('Dzongkha', 'easy-elementor-addons'),
            'en' => __('English', 'easy-elementor-addons'),
            'eo' => __('Esperanto', 'easy-elementor-addons'),
            'et' => __('Estonian', 'easy-elementor-addons'),
            'ee' => __('Ewe', 'easy-elementor-addons'),
            'fo' => __('Faroese', 'easy-elementor-addons'),
            'fj' => __('Fijian', 'easy-elementor-addons'),
            'fi' => __('Finnish', 'easy-elementor-addons'),
            'fr' => __('French', 'easy-elementor-addons'),
            'ff' => __('Fula; Fulah; Pulaar; Pular', 'easy-elementor-addons'),
            'gl' => __('Galician', 'easy-elementor-addons'),
            'ka' => __('Georgian', 'easy-elementor-addons'),
            'de' => __('German', 'easy-elementor-addons'),
            'el' => __('Greek, Modern', 'easy-elementor-addons'),
            'gn' => __('GuaranÃ­', 'easy-elementor-addons'),
            'gu' => __('Gujarati', 'easy-elementor-addons'),
            'ht' => __('Haitian; Haitian Creole', 'easy-elementor-addons'),
            'ha' => __('Hausa', 'easy-elementor-addons'),
            'he' => __('Hebrew (modern)', 'easy-elementor-addons'),
            'hz' => __('Herero', 'easy-elementor-addons'),
            'hi' => __('Hindi', 'easy-elementor-addons'),
            'ho' => __('Hiri Motu', 'easy-elementor-addons'),
            'hu' => __('Hungarian', 'easy-elementor-addons'),
            'ia' => __('Interlingua', 'easy-elementor-addons'),
            'id' => __('Indonesian', 'easy-elementor-addons'),
            'ie' => __('Interlingue', 'easy-elementor-addons'),
            'ga' => __('Irish', 'easy-elementor-addons'),
            'ig' => __('Igbo', 'easy-elementor-addons'),
            'ik' => __('Inupiaq', 'easy-elementor-addons'),
            'io' => __('Ido', 'easy-elementor-addons'),
            'is' => __('Icelandic', 'easy-elementor-addons'),
            'it' => __('Italian', 'easy-elementor-addons'),
            'iu' => __('Inuktitut', 'easy-elementor-addons'),
            'ja' => __('Japanese', 'easy-elementor-addons'),
            'jv' => __('Javanese', 'easy-elementor-addons'),
            'kl' => __('Kalaallisut, Greenlandic', 'easy-elementor-addons'),
            'kn' => __('Kannada', 'easy-elementor-addons'),
            'kr' => __('Kanuri', 'easy-elementor-addons'),
            'ks' => __('Kashmiri', 'easy-elementor-addons'),
            'kk' => __('Kazakh', 'easy-elementor-addons'),
            'km' => __('Khmer', 'easy-elementor-addons'),
            'ki' => __('Kikuyu, Gikuyu', 'easy-elementor-addons'),
            'rw' => __('Kinyarwanda', 'easy-elementor-addons'),
            'ky' => __('Kyrgyz', 'easy-elementor-addons'),
            'kv' => __('Komi', 'easy-elementor-addons'),
            'kg' => __('Kongo', 'easy-elementor-addons'),
            'ko' => __('Korean', 'easy-elementor-addons'),
            'ku' => __('Kurdish', 'easy-elementor-addons'),
            'kj' => __('Kwanyama, Kuanyama', 'easy-elementor-addons'),
            'la' => __('Latin', 'easy-elementor-addons'),
            'lb' => __('Luxembourgish, Letzeburgesch', 'easy-elementor-addons'),
            'lg' => __('Ganda', 'easy-elementor-addons'),
            'li' => __('Limburgish, Limburgan, Limburger', 'easy-elementor-addons'),
            'ln' => __('Lingala', 'easy-elementor-addons'),
            'lo' => __('Lao', 'easy-elementor-addons'),
            'lt' => __('Lithuanian', 'easy-elementor-addons'),
            'lu' => __('Luba-Katanga', 'easy-elementor-addons'),
            'lv' => __('Latvian', 'easy-elementor-addons'),
            'gv' => __('Manx', 'easy-elementor-addons'),
            'mk' => __('Macedonian', 'easy-elementor-addons'),
            'mg' => __('Malagasy', 'easy-elementor-addons'),
            'ms' => __('Malay', 'easy-elementor-addons'),
            'ml' => __('Malayalam', 'easy-elementor-addons'),
            'mt' => __('Maltese', 'easy-elementor-addons'),
            'mi' => __('MÄori', 'easy-elementor-addons'),
            'mr' => __('Marathi (MarÄá¹­hÄ«)', 'easy-elementor-addons'),
            'mh' => __('Marshallese', 'easy-elementor-addons'),
            'mn' => __('Mongolian', 'easy-elementor-addons'),
            'na' => __('Nauru', 'easy-elementor-addons'),
            'nv' => __('Navajo, Navaho', 'easy-elementor-addons'),
            'nb' => __('Norwegian BokmÃ¥l', 'easy-elementor-addons'),
            'nd' => __('North Ndebele', 'easy-elementor-addons'),
            'ne' => __('Nepali', 'easy-elementor-addons'),
            'ng' => __('Ndonga', 'easy-elementor-addons'),
            'nn' => __('Norwegian Nynorsk', 'easy-elementor-addons'),
            'no' => __('Norwegian', 'easy-elementor-addons'),
            'ii' => __('Nuosu', 'easy-elementor-addons'),
            'nr' => __('South Ndebele', 'easy-elementor-addons'),
            'oc' => __('Occitan', 'easy-elementor-addons'),
            'oj' => __('Ojibwe, Ojibwa', 'easy-elementor-addons'),
            'cu' => __('Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic', 'easy-elementor-addons'),
            'om' => __('Oromo', 'easy-elementor-addons'),
            'or' => __('Oriya', 'easy-elementor-addons'),
            'os' => __('Ossetian, Ossetic', 'easy-elementor-addons'),
            'pa' => __('Panjabi, Punjabi', 'easy-elementor-addons'),
            'pi' => __('PÄli', 'easy-elementor-addons'),
            'fa' => __('Persian (Farsi)', 'easy-elementor-addons'),
            'pl' => __('Polish', 'easy-elementor-addons'),
            'ps' => __('Pashto, Pushto', 'easy-elementor-addons'),
            'pt' => __('Portuguese', 'easy-elementor-addons'),
            'qu' => __('Quechua', 'easy-elementor-addons'),
            'rm' => __('Romansh', 'easy-elementor-addons'),
            'rn' => __('Kirundi', 'easy-elementor-addons'),
            'ro' => __('Romanian, [])', 'easy-elementor-addons'),
            'ru' => __('Russian', 'easy-elementor-addons'),
            'sa' => __('Sanskrit (Saá¹ská¹›ta)', 'easy-elementor-addons'),
            'sc' => __('Sardinian', 'easy-elementor-addons'),
            'sd' => __('Sindhi', 'easy-elementor-addons'),
            'se' => __('Northern Sami', 'easy-elementor-addons'),
            'sm' => __('Samoan', 'easy-elementor-addons'),
            'sg' => __('Sango', 'easy-elementor-addons'),
            'sr' => __('Serbian', 'easy-elementor-addons'),
            'gd' => __('Scottish Gaelic; Gaelic', 'easy-elementor-addons'),
            'sn' => __('Shona', 'easy-elementor-addons'),
            'si' => __('Sinhala, Sinhalese', 'easy-elementor-addons'),
            'sk' => __('Slovak', 'easy-elementor-addons'),
            'sl' => __('Slovene', 'easy-elementor-addons'),
            'so' => __('Somali', 'easy-elementor-addons'),
            'st' => __('Southern Sotho', 'easy-elementor-addons'),
            'az' => __('South Azerbaijani', 'easy-elementor-addons'),
            'es' => __('Spanish; Castilian', 'easy-elementor-addons'),
            'su' => __('Sundanese', 'easy-elementor-addons'),
            'sw' => __('Swahili', 'easy-elementor-addons'),
            'ss' => __('Swati', 'easy-elementor-addons'),
            'sv' => __('Swedish', 'easy-elementor-addons'),
            'ta' => __('Tamil', 'easy-elementor-addons'),
            'te' => __('Telugu', 'easy-elementor-addons'),
            'tg' => __('Tajik', 'easy-elementor-addons'),
            'th' => __('Thai', 'easy-elementor-addons'),
            'ti' => __('Tigrinya', 'easy-elementor-addons'),
            'bo' => __('Tibetan Standard, Tibetan, Central', 'easy-elementor-addons'),
            'tk' => __('Turkmen', 'easy-elementor-addons'),
            'tl' => __('Tagalog', 'easy-elementor-addons'),
            'tn' => __('Tswana', 'easy-elementor-addons'),
            'to' => __('Tonga (Tonga Islands)', 'easy-elementor-addons'),
            'tr' => __('Turkish', 'easy-elementor-addons'),
            'ts' => __('Tsonga', 'easy-elementor-addons'),
            'tt' => __('Tatar', 'easy-elementor-addons'),
            'tw' => __('Twi', 'easy-elementor-addons'),
            'ty' => __('Tahitian', 'easy-elementor-addons'),
            'ug' => __('Uyghur, Uighur', 'easy-elementor-addons'),
            'uk' => __('Ukrainian', 'easy-elementor-addons'),
            'ur' => __('Urdu', 'easy-elementor-addons'),
            'uz' => __('Uzbek', 'easy-elementor-addons'),
            've' => __('Venda', 'easy-elementor-addons'),
            'vi' => __('Vietnamese', 'easy-elementor-addons'),
            'vo' => __('VolapÃ¼k', 'easy-elementor-addons'),
            'wa' => __('Walloon', 'easy-elementor-addons'),
            'cy' => __('Welsh', 'easy-elementor-addons'),
            'wo' => __('Wolof', 'easy-elementor-addons'),
            'fy' => __('Western Frisian', 'easy-elementor-addons'),
            'xh' => __('Xhosa', 'easy-elementor-addons'),
            'yi' => __('Yiddish', 'easy-elementor-addons'),
            'yo' => __('Yoruba', 'easy-elementor-addons'),
            'za' => __('Zhuang, Chuang', 'easy-elementor-addons'),
            'zu' => __('Zulu', 'easy-elementor-addons'),
        ];
    }

}
