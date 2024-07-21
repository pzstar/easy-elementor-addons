<?php

namespace EasyElementorAddons\Modules\WeatherBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use EasyElementorAddons\Group_Control_Query;
use EasyElementorAddons\Group_Control_Header;
use Elementor\Group_Control_Background;
use JsonMachine\JsonMachine;
use DateTime;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class WeatherBlock extends Widget_Base {

    public $weather_data = [];

    /* Widget Name */
    public function get_name() {
        return 'eead-weather-block';
    }

    /* Widget Title */
    public function get_title() {
        return esc_html__('Weather Block', 'easy-elementor-addons');
    }

    /* Icon */
    public function get_icon() {
        return 'eicon-flash';
    }

    /* Category */
    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    /* Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout Section', 'easy-elementor-addons')
            ]
        );

        /* API */
        $this->add_control(
            'api_key',
            [
                'label' => esc_html__('API Key', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Please Enter your API Key here', 'easy-elementor-addons'),
                'description' => esc_html__('To get the api key click ', 'easy-elementor-addons') . '<a target="_blank" href="https://weatherstack.com/quickstart">here</a>',
                'separator' => 'after'
            ]
        );

        /* Country */
        $this->add_control(
            'country_location',
            [
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
            'city_location',
            [
                'label' => esc_html__('City', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Sydney', 'easy-elementor-addons'),
                'placeholder' => esc_html__('City', 'easy-elementor-addons'),
                'separator' => 'after'
            ]
        );

        /* Language */
        $this->add_control(
            'country_language',
            [
                'label' => esc_html__('Language', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->get_language_options(),
                'default' => 'en',
                'label_block' => true
            ]
        );

        /* Units */
        $this->add_control(
            'temperature_units',
            [
                'label' => esc_html__('Units', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'standard' => esc_html__('Kelvin', 'easy-elementor-addons'),
                    'metric' => esc_html__('Celsius', 'easy-elementor-addons'),
                    'imperial' => esc_html__('Fahrenheit', 'easy-elementor-addons'),
                ],
                'default' => 'metric',
            ]
        );

        $this->add_control(
            'cache_expiration',
            [
                'label' => esc_html__('Cache Expiration(sec)', 'easy-elementor-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'description' => esc_html__('Please set the expiration time in seconds.', 'easy-elementor-addons'),
                'min' => 10,
                'max' => 86400,
                'step' => 1,
                'default' => 3600,
            ]
        );

        /* Round */
        $this->add_control(
            'round',
            [
                'label' => esc_html__('Round', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'hide_humidity',
            [
                'label' => esc_html__('Hide Humidity', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_preassure',
            [
                'label' => esc_html__('Hide Preassure', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_wind_speed',
            [
                'label' => esc_html__('Hide Wind Speed', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_day',
            [
                'label' => esc_html__('Hide Day', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_weather_description',
            [
                'label' => esc_html__('Hide Description', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'hide_bottom_box',
            [
                'label' => esc_html__('Hide Bottom', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => ''
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Style', 'easy-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'easy-elementor-addons'),
                    'style2' => esc_html__('Style 2', 'easy-elementor-addons')
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'temperature_style',
            [
                'label' => esc_html__('Temperature', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'temp_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-temperature' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'temp_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-temperature',
            ]
        );

        $this->add_control(
            'vertical_height',
            [
                'label' => esc_html__('Vertical Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2.4,
                        'step' => .1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-temperature' => 'transform: scale(1, {{SIZE}});',
                ],
                'condition' => ['layout' => 'style1']
            ]
        );

        $this->add_control(
            'temp_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-temperature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['layout' => 'style1']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-description',
            ]
        );

        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-desc-section span.eead-weather-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'day_style',
            [
                'label' => esc_html__('Day', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'day_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-current-day' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'day_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-current-day',
            ]
        );

        $this->add_control(
            'day_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-current-day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'city_style',
            [
                'label' => esc_html__('City', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'city_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-city span,
                 {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-city span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'city_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-city span,
                           {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-city span',
            ]
        );

        $this->add_control(
            'city_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-city span,
                 {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-city span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'country_style',
            [
                'label' => esc_html__('Country', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'country_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-country h4,
                 {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-country h4' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'country_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-country h4,
                           {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-country h4',
            ]
        );

        $this->add_control(
            'country_margin',
            [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-location-info .eead-weather-country h4,
                 {{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section .eead-location-info .eead-weather-country h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'top_box_style',
            [
                'label' => esc_html__('Top Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'top_box_bg_color',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-weather-container.style1,
                               {{WRAPPER}} .eead-weather-container.style2 .eead-weather-temperature',
            ]
        );

        $this->add_control(
            'top_box_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style1 .eead-weather-top-section,
                 {{WRAPPER}} .eead-weather-container.style2 .eead-weather-top-section .eead-weather-temperature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'middle_box_style',
            [
                'label' => esc_html__('Middle Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'middle_box_bg_color',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-weather-container.style2',
            ]
        );

        $this->add_control(
            'middle_box_separator_color',
            [
                'label' => esc_html__('Separator Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-container.style2 .eead-weather-bottom-section' => 'border-top-color: {{VALUE}}',
                ],
                'condition' => ['layout' => 'style2']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'bottom_box_style',
            [
                'label' => esc_html__('Bottom Box', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_box_bg_color',
                'label' => esc_html__('Background', 'easy-elementor-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .eead-weather-bottom-section',
            ]
        );

        $this->add_control(
            'bottom_box_color',
            [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-bottom-section' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bottom_box_text_typography',
                'label' => esc_html__('Typography', 'easy-elementor-addons'),
                'selector' => '{{WRAPPER}} .eead-weather-bottom-section',
            ]
        );

        $this->add_control(
            'bottom_box_text_padding',
            [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .eead-weather-bottom-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['api_key'])) {
            echo esc_html__('Please enter the API Key first!', 'easy-elementor-addons');
            return false;
        }

        $this->weather_data = $this->get_weather_data();
        $data = $this->weather_data;
        $layout = esc_attr($settings['layout']);

        $code = $data['current']['weather_code'];
        $temp = $data['current']['temperature'];
        $wind_speed = $data['current']['wind_speed'];
        $wind_degree = $data['current']['wind_degree'];
        $wind_dir = $data['current']['wind_dir'];
        $humidity = $data['current']['humidity'];
        $pressure = $data['current']['pressure'];
        $weather_icon = $data['current']['weather_icons'][0];
        $weather_description = $data['current']['weather_descriptions'][0];
        $localtime = $data['location']['localtime'];

        ?>
        <div class="eead-weather-container <?php echo $layout; ?>">

            <div class="eead-weather-top-section">
                <div class="eead-weather-info">
                    <?php if ($layout == 'style2') { ?>
                        <div class="eead-weather-temperature">
                            <?php echo $this->get_temp($temp); ?>
                        </div>
                    <?php } ?>

                    <div class="eead-weather-desc-section">
                        <?php if ($settings['hide_weather_description'] != 'yes') { ?>
                            <img src="<?php echo esc_url($weather_icon) ?>" alt="<?php echo esc_attr($weather_description); ?>">
                            <span class="eead-weather-description"><?php echo esc_html($weather_description); ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="eead-location-info">
                    <?php if ($layout == 'style1') { ?>
                        <div class="eead-weather-temperature">
                            <?php echo $this->get_temp($temp); ?>
                        </div>
                    <?php } ?>

                    <?php if ($settings['hide_day'] != 'yes') { ?>
                        <div class="eead-weather-current-day">
                            <?php echo esc_html($this->get_current_day($localtime)); ?>
                        </div>
                    <?php } ?>

                    <div class="eead-weather-location">
                        <div class="eead-weather-city">
                            <span><?php echo esc_html($data['location']['name']); ?></span>
                        </div>

                        <div class="eead-weather-country">
                            <h4><?php echo esc_html($data['location']['country']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($settings['hide_bottom_box'] != 'yes') { ?>
                <div class="eead-weather-bottom-section">
                    <?php if ($settings['hide_humidity'] != 'yes') { ?>
                        <div class="eead-weather-humidity">
                            <?php echo 'Humidity: ' . esc_html($humidity) . '%'; ?>
                        </div>
                    <?php } ?>
                    <?php if ($settings['hide_preassure'] != 'yes') { ?>
                        <div class="eead-weather-pressure">
                            <?php echo 'Pressure: ' . esc_html($pressure) . ' Pa'; ?>
                        </div>
                    <?php } ?>
                    <?php if ($settings['hide_wind_speed'] != 'yes') { ?>
                        <div class="eead-weather-wind">
                            <?php echo 'Wind Speed: ' . esc_html($wind_speed) . ' km/hr'; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }

    protected function get_current_day($datetime) {
        $date = date_create_from_format('Y-m-d', $datetime);
        $date = new DateTime($date);
        return date_i18n('l', date_timestamp_get($date));
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

        $temp = $this->get_settings_for_display('round') == 'yes' ? round($temp) : $temp;
        $temp_val = sprintf('%1$s%2$s', $temp, $temp_unit);
        return $temp_val;
    }

    protected function get_weather_data() {
        $settings = $this->get_settings_for_display();
        $weatherstackApiKey = $settings['api_key'];
        $widgetID = $this->get_id();

        // if the API key is empty
        if (empty($weatherstackApiKey)) {
            echo esc_html__('Please enter the API Key first!', 'easy-elementor-addons');
            return false;
        }

        $city = $settings['city_location'];
        $country = $settings['country_location'];
        if (empty($city) or empty($country)) {
            echo esc_html__('Oops! It seems that you have left either the city or the country field empty', 'easy-elementor-addons');
            return false;
        }

        $unit = ($settings['temperature_units'] == 'metric') ? 'm' : (($settings['temperature_units'] == 'standard') ? 's' : 'f');
        $language = $settings['country_language'];

        if (!empty($city)) {
            $location = $city;
            if (!empty($country)) {
                $location .= ',' . $country;
            }
        }
        $transientKey = sprintf('eead-weather-%s-%s', $city, md5($widgetID));
        $weatherTransientData = get_transient($transientKey);

        if (!isset($weatherTransientData) or empty($weatherTransientData)) {

            /* Weather Stack Api Args */
            $request_args = [
                'access_key' => $weatherstackApiKey,
                'query' => urlencode($location),
                'forecast_days' => 6,
                'hourly' => 1,
                'units' => 'm',
            ];

            $request_url = add_query_arg(
                $request_args,
                'http://api.weatherstack.com/current'
            );

            $response = wp_remote_get($request_url, array('timeout' => 30));
            $remote_data = wp_remote_retrieve_body($response);
            $remote_data = json_decode($remote_data, true);

            /* Check if something went wrong while fetching from api */
            if (!$remote_data or is_wp_error($remote_data)) {
                echo esc_html__('Oops! Something went wrong while fetching the data', 'easy-elementor-addons');
                return false;
            }
            if (isset($remote_data['error'])) {

                if (isset($remote_data['error']['message'])) {
                    echo $remote_data['error']['message'];
                } else {
                    echo esc_html__('Weather data of this location not found.', 'easy-elementor-addons');
                }
                return false;
            }
            set_transient($transientKey, $remote_data, $settings['cache_expiration']);

            return $remote_data;
        } else {
            return $weatherTransientData;
        }
    }

    protected function get_country_options() {

        /* Get the list of countries */
        $CodeCountry = JsonMachine::fromFile(EEAD_PATH . 'json/city.list.json');

        /* Variable for storing countries array */
        $country_code = NULL;

        /* Store an array of countries in country_code */
        foreach ($CodeCountry as $key => $value) {
            $country_code[$value['city']['country']] = $value['city']['country'];
        }

        unset($json, $CodeCountry);

        /* Full name of the countries in JSON */
        $fullCountryNameJson = file_get_contents(EEAD_PATH . 'json/country.list.json');
        $fullCountryName = json_decode($fullCountryNameJson, true, 10);

        /* Will save an array of countries with full name */
        $country_name = NULL;

        /* Create an array of countries */
        foreach ($fullCountryName as $key => $name) {
            $country_name[$name['Code']] = $name['Name'];
        }

        unset($fullCountryNameJson, $fullCountryName);

        /* Combine the arrays by country code into one array */
        $result = array_merge($country_code, $country_name);

        return $result;

    }

    protected function get_language_options() {

        /* Get list of countries */
        $languageJson = file_get_contents(EEAD_PATH . 'json/language.list.json');
        $CodeLanguage = json_decode($languageJson, true);
        $result = NULL;

        /* Store array of countries into $result */
        foreach ($CodeLanguage as $i => $value) {
            $result[$value['code']] = $CodeLanguage[$i]['name'];
        }
        return $result;
    }

}
