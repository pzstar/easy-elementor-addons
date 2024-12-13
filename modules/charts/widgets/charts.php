<?php

namespace EasyElementorAddons\Modules\Charts\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Charts Widget
 */
class Charts extends Widget_Base {

    public function get_name() {
        return 'eead-charts';
    }

    public function get_title() {
        return esc_html__('Charts', 'easy-elementor-addons');
    }

    public function get_icon() {
        return 'eead-element-icon eead-icons-chart';
    }

    public function get_categories() {
        return ['easy-elementor-addons'];
    }

    public function get_script_depends() {
        return ['chart'];
    }

    protected function register_controls() {// phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
        $this->start_controls_section(
            'general_settings', [
                'label' => esc_html__('Charts', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'data_source', [
                'label' => esc_html__('Data Source', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => array(
                    'custom' => esc_html__('Custom', 'easy-elementor-addons'),
                    'csv' => esc_html__('CSV File', 'easy-elementor-addons'),
                )
            ]
        );

        $this->add_control(
            'type', [
                'label' => esc_html__('Layout', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'line' => esc_html__('Line', 'easy-elementor-addons'),
                    'bar' => esc_html__('Bar', 'easy-elementor-addons'),
                    'horizontalBar' => esc_html__('Horizontal Bar', 'easy-elementor-addons'),
                    'pie' => esc_html__('Pie', 'easy-elementor-addons'),
                    'radar' => esc_html__('Radar', 'easy-elementor-addons'),
                    'doughnut' => esc_html__('Doughnut', 'easy-elementor-addons'),
                    'polarArea' => esc_html__('Polar Area', 'easy-elementor-addons'),
                ),
                'default' => 'bar',
                'label_block' => true
            ]
        );

        $this->add_control(
            'csv_type', [
                'label' => esc_html__('File Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'file' => esc_html__('Upload FIle', 'easy-elementor-addons'),
                    'url' => esc_html__('Remote File', 'easy-elementor-addons'),
                ),
                'condition' => array(
                    'data_source' => 'csv',
                ),
                'default' => 'file'
            ]
        );

        $this->add_control(
            'chart_separator', [
                'label' => esc_html__('Data Separator', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Separator between cells data', 'easy-elementor-addons'),
                'label_block' => true,
                'default' => ',',
                'condition' => array(
                    'data_source' => 'csv',
                )
            ]
        );

        $this->add_control(
            'csv_file', [
                'label' => esc_html__('Upload CSV File', 'easy-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => array('active' => true),
                'media_type' => array(),
                'condition' => array(
                    'data_source' => 'csv',
                    'csv_type' => 'file',
                )
            ]
        );

        $this->add_control(
            'csv_url', [
                'label' => esc_html__('File URL', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'label_block' => true,
                'condition' => array(
                    'data_source' => 'csv',
                    'csv_type' => 'url',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'x_axis', [
                'label' => esc_html__('X-Axis', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'x_axis_label_switch', [
                'label' => esc_html__('Show Axis Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'description' => esc_html__('Show or Hide X-Axis Label', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'x_axis_label', [
                'label' => esc_html__('Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'default' => 'X-Axis',
                'label_block' => true,
                'condition' => array(
                    'x_axis_label_switch' => 'true',
                )
            ]
        );

        $this->add_control(
            'x_axis_labels', [
                'label' => esc_html__('Data Labels', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'default' => 'Jan,Feb,Mar,Apr,May',
                'description' => esc_html__('Enter labels for X-Axis separated with \' , \' ', 'easy-elementor-addons'),
                'label_block' => true,
                'condition' => array(
                    'data_source' => 'custom',
                )
            ]
        );

        $this->add_control(
            'x_axis_grid', [
                'label' => esc_html__('Show Grid Lines', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'default' => 'true',
                'description' => esc_html__('Show or Hide X-Axis Grid Lines', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'x_axis_begin', [
                'label' => esc_html__('Begin at Zero', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'description' => esc_html__('Start X-Axis Labels at zero', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'x_axis_label_rotation', [
                'label' => esc_html__('Labels\' Rotation ', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 360,
                'default' => 0
            ]
        );

        $this->add_control(
            'x_column_width', [
                'label' => esc_html__('Column Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ),
                ),
                'condition' => array(
                    'type' => 'bar',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'y_axis', [
                'label' => esc_html__('Y-Axis', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'y_axis_label_switch', [
                'label' => esc_html__('Show Axis Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'description' => esc_html__('Show or Hide Y-Axis Label', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'y_axis_label', [
                'label' => esc_html__('Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true),
                'default' => 'Y-Axis',
                'label_block' => true,
                'condition' => array(
                    'y_axis_label_switch' => 'true',
                )
            ]
        );

        $data_repeater = new REPEATER();

        $data_repeater->add_control(
            'y_axis_column_title', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true)
            ]
        );

        $data_repeater->add_control(
            'y_axis_column_data', [
                'label' => esc_html__('Data', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Enter Data Numbers for Y-Axis separated with \' , \' ', 'easy-elementor-addons'),
                'dynamic' => array('active' => true)
            ]
        );

        $data_repeater->add_control(
            'y_axis_urls', [
                'label' => esc_html__('URLs', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Enter URLs for each Dataset separated with \' , \' ', 'easy-elementor-addons'),
                'label_block' => true
            ]
        );

        $data_repeater->add_control(
            'fill_colors_notice', [
                'raw' => '<strong>' . esc_html__('Please note!', 'easy-elementor-addons') . '</strong> ' . esc_html__('First/Second Fill Color options used together to add a gradient for all charts except Pie, Dounut and Polar Area, Fill Colors option used to add multiple colors, but please make sure First/Second Color options are cleared.', 'easy-elementor-addons'),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning'
            ]
        );

        $data_repeater->add_control(
            'y_axis_column_color', [
                'label' => esc_html__('First Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $data_repeater->add_control(
            'y_axis_column_second_color', [
                'label' => esc_html__('Second Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $data_repeater->add_control(
            'y_axis_circle_color', [
                'label' => esc_html__('Fill Colors', 'easy-elementor-addons'),
                'description' => esc_html__('Enter Colors separated with \' , \', this will work only for pie, doughnut and polar area charts ', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '#ff6384,#4bc0c0,#ffcd56,#c9cbcf,#36a2eb',
                'dynamic' => array('active' => true),
                'label_block' => true
            ]
        );

        $data_repeater->add_control(
            'y_axis_column_border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'default' => 1,
                'type' => Controls_Manager::NUMBER
            ]
        );

        $data_repeater->add_control(
            'y_axis_column_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff'
            ]
        );

        $this->add_control(
            'y_axis_data', [
                'label' => esc_html__('Data', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'default' => array(
                    array(
                        'y_axis_column_title' => esc_html__('Dataset #1', 'easy-elementor-addons'),
                        'y_axis_column_data' => '1,5,2,3,7',
                        'y_axis_column_color' => '#6ec1e4',
                    ),
                    array(
                        'y_axis_column_title' => esc_html__('Dataset #2', 'easy-elementor-addons'),
                        'y_axis_column_data' => '2,10,1,5,4',
                        'y_axis_column_color' => '#54595F',
                    ),
                ),
                'fields' => $data_repeater->get_controls(),
                'condition' => array(
                    'data_source' => 'custom',
                )
            ]
        );

        $csv_repeater = new Repeater();

        $csv_repeater->add_control(
            'dataset_title', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => array('active' => true)
            ]
        );

        $csv_repeater->add_control(
            'dataset_color', [
                'label' => esc_html__('Fill Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $csv_repeater->add_control(
            'circle_color', [
                'label' => esc_html__('Fill Colors', 'easy-elementor-addons'),
                'description' => esc_html__('Enter Colors separated with \' , \', this will work only for pie, doughnut and polar area charts ', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => '#ff6384,#4bc0c0,#ffcd56,#c9cbcf,#36a2eb',
                'dynamic' => array('active' => true),
                'label_block' => true
            ]
        );

        $csv_repeater->add_control(
            'border_width', [
                'label' => esc_html__('Border Width', 'easy-elementor-addons'),
                'default' => 1,
                'type' => Controls_Manager::NUMBER
            ]
        );

        $csv_repeater->add_control(
            'dataset_border_color', [
                'label' => esc_html__('Border Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff'
            ]
        );

        $this->add_control(
            'dataset_repeater', [
                'label' => esc_html__('Data', 'easy-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'default' => array(
                    array(
                        'dataset_title' => esc_html__('Dataset #1', 'easy-elementor-addons'),
                        'dataset_color' => '#6ec1e4',
                    ),
                    array(
                        'dataset_title' => esc_html__('Dataset #2', 'easy-elementor-addons'),
                        'dataset_color' => '#54595F',
                    ),
                ),
                'fields' => $csv_repeater->get_controls(),
                'condition' => array(
                    'data_source' => 'csv',
                )
            ]
        );

        $this->add_control(
            'data_type', [
                'label' => esc_html__('Data Type', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'linear' => esc_html__('Linear', 'easy-elementor-addons'),
                    'logarithmic' => esc_html__('Logarithmic', 'easy-elementor-addons'),
                ),
                'default' => 'linear',
                'condition' => array(
                    'type!' => 'horizontalBar',
                )
            ]
        );

        $this->add_control(
            'y_axis_grid', [
                'label' => esc_html__('Show Grid Lines', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'default' => 'true',
                'description' => esc_html__('Show or Hide Y-Axis Grid Lines', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'y_axis_begin', [
                'label' => esc_html__('Begin at Zero', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
                'description' => esc_html__('Start Y-Axis Data at zero', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'y_axis_urls_target', [
                'label' => esc_html__('Open Links in new tab', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'default' => 'true',
                'condition' => array(
                    'data_source' => 'custom',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_content', [
                'label' => esc_html__('Title', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'title_switcher', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Enter a Title for the Chart', 'easy-elementor-addons'),
                'label_block' => true,
                'dynamic' => array('active' => true),
                'condition' => array(
                    'title_switcher' => 'true',
                )
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => esc_html__('HTML Tag', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => eead_html_tags(),
                'label_block' => true,
                'condition' => array(
                    'title_switcher' => 'true',
                )
            ]
        );

        $this->add_control(
            'title_position', [
                'label' => esc_html__('Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'top' => esc_html__('Top', 'easy-elementor-addons'),
                    'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
                ),
                'default' => 'top',
                'condition' => array(
                    'title_switcher' => 'true',
                )
            ]
        );

        $this->add_responsive_control(
            'title_align', [
                'label' => esc_html__('Alignment', 'easy-elementor-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => esc_html__('Left', 'easy-elementor-addons'),
                        'icon' => 'fas fa-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__('Center', 'easy-elementor-addons'),
                        'icon' => 'fas fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__('Right', 'easy-elementor-addons'),
                        'icon' => 'fas fa-align-right',
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-title' => 'text-align: {{VALUE}}',
                ),
                'default' => 'center',
                'condition' => array(
                    'title_switcher' => 'true',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'advanced', [
                'label' => esc_html__('Advanced Settings', 'easy-elementor-addons')
            ]
        );

        $this->add_control(
            'y_axis_min', [
                'label' => esc_html__('Minimum Value', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Set Y-axis minimum value, this will be overriden if data has a smaller value or Begin At Zero option is enabled', 'easy-elementor-addons'),
                'condition' => array(
                    'type!' => array('pie', 'doughnut', 'radar', 'polarArea'),
                )
            ]
        );

        $this->add_control(
            'y_axis_max', [
                'label' => esc_html__('Maximum Value', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Set Y-axis maximum value, this will be overriden if data has a larger value', 'easy-elementor-addons'),
                'min' => 0,
                'default' => 1,
                'condition' => array(
                    'type!' => array('pie', 'doughnut'),
                )
            ]
        );

        $this->add_control(
            'step_size', [
                'label' => esc_html__('Step Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'condition' => array(
                    'type!' => array('pie', 'doughnut'),
                )
            ]
        );

        $this->add_control(
            'legend_display', [
                'label' => esc_html__('Show Legend', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Show or Hide chart legend', 'easy-elementor-addons'),
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'legend_circle', [
                'label' => esc_html__('Change Legend to Circles', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'legend_display' => 'true',
                )
            ]
        );

        $this->add_control(
            'legend_hide', [
                'label' => esc_html__('Hide Legend on Tablet/Mobile Devices', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Show or Hide chart legend', 'easy-elementor-addons'),
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'condition' => array(
                    'legend_display' => 'true',
                )
            ]
        );

        $this->add_responsive_control(
            'legend_position', [
                'label' => esc_html__('Legend Position', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'top' => esc_html__('Top', 'easy-elementor-addons'),
                    'right' => esc_html__('Right', 'easy-elementor-addons'),
                    'bottom' => esc_html__('Bottom', 'easy-elementor-addons'),
                    'left' => esc_html__('Left', 'easy-elementor-addons'),
                ),
                'default' => 'top',
                'tablet_default' => 'top',
                'mobile_default' => 'top',
                'condition' => array(
                    'legend_display' => 'true',
                )
            ]
        );

        $this->add_control(
            'legend_reverse', [
                'label' => esc_html__('Reverse', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Enable or Disable legend data reverse', 'easy-elementor-addons'),
                'return_value' => 'true',
                'condition' => array(
                    'legend_display' => 'true',
                )
            ]
        );

        $this->add_control(
            'tool_tips', [
                'label' => esc_html__('Show Values on Hover', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'tool_tips_percent', [
                'label' => esc_html__('Convert Values to percent', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => array(
                    'tool_tips' => 'true',
                )
            ]
        );

        $this->add_control(
            'tool_tips_mode', [
                'label' => esc_html__('Mode', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'point' => esc_html__('Point', 'easy-elementor-addons'),
                    'nearest' => esc_html__('Nearest', 'easy-elementor-addons'),
                    'dataset' => esc_html__('Dataset', 'easy-elementor-addons'),
                    'x' => esc_html__('X', 'easy-elementor-addons'),
                    'y' => esc_html__('Y', 'easy-elementor-addons'),
                ),
                'default' => 'nearest',
                'condition' => array(
                    'tool_tips' => 'true',
                )
            ]
        );

        $this->add_control(
            'value_on_chart', [
                'label' => esc_html__('Show Values on Chart', 'easy-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('This option works only with Pie and Douhnut Charts', 'easy-elementor-addons'),
                'label_on' => 'Show',
                'label_off' => 'Hide',
                'return_value' => 'true',
                'condition' => array(
                    'type' => array('pie', 'doughnut'),
                    'tool_tips!' => 'true',
                )
            ]
        );

        $this->add_control(
            'duration', [
                'label' => esc_html__('Animation Duration (msec)', 'easy-elementor-addons'),
                'description' => esc_html__('Set the animation duration in milliseconds', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER
            ]
        );

        $this->add_control(
            'start_animation', [
                'label' => esc_html__('Animation', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'linear' => esc_html__('Linear', 'easy-elementor-addons'),
                    'easeInQuad' => esc_html__('Ease in Quad', 'easy-elementor-addons'),
                    'easeOutQuad' => esc_html__('Ease out Quad', 'easy-elementor-addons'),
                    'easeInOutQuad' => esc_html__('Ease in out Quad', 'easy-elementor-addons'),
                    'easeInCubic' => esc_html__('Ease in Cubic', 'easy-elementor-addons'),
                    'easeOutCubic' => esc_html__('Ease out Cubic', 'easy-elementor-addons'),
                    'easeInOutCubic' => esc_html__('Ease in out Cubic', 'easy-elementor-addons'),
                    'easeInQuart' => esc_html__('Ease in Quart', 'easy-elementor-addons'),
                    'easeOutQuart' => esc_html__('Ease out Quart', 'easy-elementor-addons'),
                    'easeInOutQuart' => esc_html__('Ease in out Quart', 'easy-elementor-addons'),
                    'easeInQuint' => esc_html__('Ease in Quint', 'easy-elementor-addons'),
                    'easeOutQuint' => esc_html__('Ease out Quint', 'easy-elementor-addons'),
                    'easeInOutQuint' => esc_html__('Ease in out Quint', 'easy-elementor-addons'),
                    'easeInSine' => esc_html__('Ease in Sine', 'easy-elementor-addons'),
                    'easeOutSine' => esc_html__('Ease out Sine', 'easy-elementor-addons'),
                    'easeInOutSine' => esc_html__('Ease in out Sine', 'easy-elementor-addons'),
                    'easeInExpo' => esc_html__('Ease in Expo', 'easy-elementor-addons'),
                    'easeOutExpo' => esc_html__('Ease out Expo', 'easy-elementor-addons'),
                    'easeInOutExpo' => esc_html__('Ease in out Cubic', 'easy-elementor-addons'),
                    'easeInCirc' => esc_html__('Ease in Circle', 'easy-elementor-addons'),
                    'easeOutCirc' => esc_html__('Ease out Circle', 'easy-elementor-addons'),
                    'easeInOutCirc' => esc_html__('Ease in out Circle', 'easy-elementor-addons'),
                    'easeInElastic' => esc_html__('Ease in Elastic', 'easy-elementor-addons'),
                    'easeOutElastic' => esc_html__('Ease out Elastic', 'easy-elementor-addons'),
                    'easeInOutElastic' => esc_html__('Ease in out Elastic', 'easy-elementor-addons'),
                    'easeInBack' => esc_html__('Ease in Back', 'easy-elementor-addons'),
                    'easeOutBack' => esc_html__('Ease out Back', 'easy-elementor-addons'),
                    'easeInOutBack' => esc_html__('Ease in Out Back', 'easy-elementor-addons'),
                    'easeInBounce' => esc_html__('Ease in Bounce', 'easy-elementor-addons'),
                    'easeOutBounce' => esc_html__('Ease out Bounce', 'easy-elementor-addons'),
                    'easeInOutBounce' => esc_html__('Ease in out Bounce', 'easy-elementor-addons'),
                ),
                'default' => 'easeInQuad'
            ]
        );

        $this->add_control(
            'render_event', [
                'label' => esc_html__('Load Chart On', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'scroll' => esc_html__('Scroll', 'easy-elementor-addons'),
                    'load' => esc_html__('Page Load', 'easy-elementor-addons'),
                ),
                'default' => 'scroll'
            ]
        );

        $this->add_control(
            'format_locale', [
                'label' => esc_html__('Data Format Locale', 'easy-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('Use this to format strings into specific locale format. For example, use de to format numbers according to German formatting.', 'easy-elementor-addons'),
                'options' => array(
                    '' => esc_html__('Default', 'easy-elementor-addons'),
                    'en' => esc_html__('English', 'easy-elementor-addons'),
                    'fr' => esc_html__('French', 'easy-elementor-addons'),
                    'da' => esc_html__('Danish', 'easy-elementor-addons'),
                    'de' => esc_html__('German', 'easy-elementor-addons'),
                    'ar' => esc_html__('Arabic', 'easy-elementor-addons'),
                ),
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'general_style', [
                'label' => esc_html__('General', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'height', [
                'label' => esc_html__('Height', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Set the height of the graph in pixels', 'easy-elementor-addons'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-canvas-container' => 'height: {{VALUE}}px',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'general_background',
                'types' => array('classic', 'gradient'),
                'selector' => '{{WRAPPER}} .eead-chart-container'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'general_border',
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
                'selector' => '{{WRAPPER}} .eead-chart-container'
            ]
        );

        $this->add_control(
            'general_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-container' => 'border-radius: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'general_box_shadow',
                'selector' => '{{WRAPPER}} .eead-chart-container'
            ]
        );

        $this->add_responsive_control(
            'general_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                )
            ]
        );

        $this->add_responsive_control(
            'general_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__('Title', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'title_switcher' => 'true',
                )
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-title' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .eead-chart-title'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => 'title_background',
                'types' => array('classic', 'gradient'),
                'selector' => '{{WRAPPER}} .eead-chart-title-container'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => 'title_border',
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
                'selector' => '{{WRAPPER}} .eead-chart-title-container'
            ]
        );

        $this->add_control(
            'title_border_radius', [
                'label' => esc_html__('Border Radius', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', '%', 'em'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-title-container' => 'border-radius: {{SIZE}}{{UNIT}};',
                )
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'title_box_shadow',
                'selector' => '{{WRAPPER}} .eead-chart-title'
            ]
        );

        $this->add_responsive_control(
            'title_margin', [
                'label' => esc_html__('Margin', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-title-container .eead-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                )
            ]
        );

        $this->add_responsive_control(
            'title_padding', [
                'label' => esc_html__('Padding', 'easy-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .eead-chart-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'x_axis_style', [
                'label' => esc_html__('X-Axis', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'x_axis_label_pop', [
                'label' => esc_html__('Axis Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => array(
                    'x_axis_label_switch' => 'true',
                )
            ]
        );

        $this->start_popover();

        $this->add_control(
            'x_axis_label_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'x_axis_label_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'default' => 12
            ]
        );

        $this->end_popover();

        $this->add_control(
            'x_axis_labels_pop', [
                'label' => esc_html__('Data Labels', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control(
            'x_axis_labels_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'x_axis_labels_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'default' => 12
            ]
        );

        $this->end_popover();

        $this->add_control(
            'x_axis_grid_pop', [
                'label' => esc_html__('Grid', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control(
            'x_axis_grid_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6ec1e4'
            ]
        );

        $this->add_control(
            'x_axis_grid_width', [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ),
                ),
                'default' => array(
                    'unit' => 'px',
                    'size' => 1,
                )
            ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section(
            'y_axis_style', [
                'label' => esc_html__('Y-Axis', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'y_axis_label_pop', [
                'label' => esc_html__('Axis Label', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => array(
                    'y_axis_label_switch' => 'true',
                )
            ]
        );

        $this->start_popover();

        $this->add_control(
            'y_axis_label_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'y_axis_label_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'default' => 12
            ]
        );

        $this->end_popover();

        $this->add_control(
            'y_axis_data_pop', [
                'label' => esc_html__('Data', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control(
            'y_axis_labels_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'y_axis_labels_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'default' => 12
            ]
        );

        $this->end_popover();

        $this->add_control(
            'y_axis_grid_pop', [
                'label' => esc_html__('Grid', 'easy-elementor-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE
            ]
        );

        $this->start_popover();

        $this->add_control(
            'y_axis_grid_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#54595f'
            ]
        );

        $this->add_control(
            'y_axis_grid_width', [
                'label' => esc_html__('Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ),
                ),
                'default' => array(
                    'unit' => 'px',
                    'size' => 1,
                )
            ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section(
            'legend_style', [
                'label' => esc_html__('Legend', 'easy-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'legend_display' => 'true',
                )
            ]
        );

        $this->add_control(
            'legend_text_color', [
                'label' => esc_html__('Color', 'easy-elementor-addons'),
                'type' => Controls_Manager::COLOR
            ]
        );

        $this->add_control(
            'legend_text_size', [
                'label' => esc_html__('Size', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'default' => 12
            ]
        );

        $this->add_control(
            'legend_item_width', [
                'label' => esc_html__('Item Width', 'easy-elementor-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 40
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $title_tag = Utils::validate_html_tag($settings['title_tag']);
        if (!empty($settings['title']) && $settings['title_switcher']) {
            $title = '<' . esc_attr($title_tag) . ' class="eead-chart-title">' . esc_html($settings['title']) . '</' . esc_attr($title_tag) . '>';
        }

        $xlabels = explode(',', $settings['x_axis_labels']);
        $data_source = $settings['data_source'];
        $columns_array = array();

        if ('csv' === $data_source) {
            $props = array();
            foreach ($settings['dataset_repeater'] as $repeater_ele) {
                if ('pie' === $settings['type'] || 'doughnut' === $settings['type'] || 'polarArea' === $settings['type']) {
                    $bg_color = explode(',', $repeater_ele['circle_color']);
                } else {
                    $bg_color = $repeater_ele['dataset_color'];
                }

                $prop = array(
                    'backgroundColor' => $bg_color,
                    'borderColor' => $repeater_ele['dataset_border_color'],
                    'borderWidth' => $repeater_ele['border_width'],
                    'title' => $repeater_ele['dataset_title'],
                );
                array_push($props, $prop);
            }

            $col_settings = array(
                'separator' => $settings['chart_separator'],
                'url' => ('file' === $settings['csv_type']) ? $settings['csv_file']['url'] : $settings['csv_url'],
                'props' => $props,
            );

            $columns_array = array_merge($columns_array, $col_settings);
        } else {
            foreach ($settings['y_axis_data'] as $column_data) {
                if ('pie' !== $settings['type'] && 'doughnut' !== $settings['type'] && 'polarArea' !== $settings['type']) {
                    if (empty($column_data['y_axis_column_color']) && empty($column_data['y_axis_column_second_color'])) {
                        $background = explode(',', $column_data['y_axis_circle_color']);
                        array_push($background, 'empty');
                    } elseif (!empty($column_data['y_axis_column_second_color'])) {
                        $background = array($column_data['y_axis_column_color'], $column_data['y_axis_column_second_color']);
                    } else {
                        $background = $column_data['y_axis_column_color'];
                    }
                } else {
                    $background = explode(',', $column_data['y_axis_circle_color']);
                }

                $col_settings = array(
                    'label' => $column_data['y_axis_column_title'],
                    'data' => explode(',', $column_data['y_axis_column_data']),
                    'links' => explode(',', $column_data['y_axis_urls']),
                    'backgroundColor' => $background,
                    'borderColor' => $column_data['y_axis_column_border_color'],
                    'borderWidth' => $column_data['y_axis_column_border_width'],
                );
                array_push($columns_array, $col_settings);
            }
        }

        $labels_rotation = !empty($settings['x_axis_label_rotation']) ? $settings['x_axis_label_rotation'] : 0;
        $x_label_size = !empty($settings['x_axis_labels_size']) ? $settings['x_axis_labels_size'] : 12;
        $y_label_size = !empty($settings['y_axis_labels_size']) ? $settings['y_axis_labels_size'] : 12;
        $ytype = ('horizontalBar' !== $settings['type']) ? $settings['data_type'] : 'category';
        $chart_id = 'eead-chart-canvas-' . $id;

        $chart_settings = array(
            'type' => $settings['type'],
            'xlabeldis' => $settings['x_axis_label_switch'],
            'xlabel' => $settings['x_axis_label'],
            'ylabeldis' => $settings['y_axis_label_switch'],
            'ylabel' => $settings['y_axis_label'],
            'xlabels' => $xlabels,
            'easing' => $settings['start_animation'],
            'duration' => !empty($settings['duration']) ? intval($settings['duration']) : 500,
            'xwidth' => !empty($settings['x_column_width']['size']) ? $settings['x_column_width']['size'] : 0.9,
            'enTooltips' => $settings['tool_tips'],
            'printVal' => $settings['value_on_chart'],
            'percentage' => $settings['tool_tips_percent'],
            'modTooltips' => $settings['tool_tips_mode'],
            'legDis' => $settings['legend_display'],
            'legRes' => $settings['legend_hide'],
            'legPos' => $settings['legend_position'],
            'legPos_tablet' => isset($settings['legend_position_tablet']) ? $settings['legend_position_tablet'] : 'top',
            'legPos_mobile' => isset($settings['legend_position_mobile']) ? $settings['legend_position_mobile'] : 'top',
            'legRev' => $settings['legend_reverse'],
            'legCircle' => $settings['legend_circle'],
            'legCol' => !empty($settings['legend_text_color']) ? ($settings['legend_text_color']) : '#54595f',
            'legSize' => $settings['legend_text_size'],
            'itemWid' => $settings['legend_item_width'],
            'xGrid' => $settings['x_axis_grid'],
            'xGridCol' => $settings['x_axis_grid_color'],
            'xGridWidth' => $settings['x_axis_grid_width']['size'],
            'xTicksSize' => $x_label_size,
            'xlabelcol' => $settings['x_axis_label_color'],
            'ylabelcol' => $settings['y_axis_label_color'],
            'xlabelsize' => $settings['x_axis_label_size'],
            'ylabelsize' => $settings['y_axis_label_size'],
            'xTicksCol' => !empty($settings['x_axis_labels_color']) ? $settings['x_axis_labels_color'] : '#54595f',
            'xTicksRot' => $labels_rotation,
            'xTicksBeg' => $settings['x_axis_begin'],
            'yAxis' => $ytype,
            'yGrid' => $settings['y_axis_grid'],
            'yGridCol' => $settings['y_axis_grid_color'],
            'yGridWidth' => $settings['y_axis_grid_width']['size'],
            'yTicksSize' => $y_label_size,
            'yTicksCol' => !empty($settings['y_axis_labels_color']) ? $settings['y_axis_labels_color'] : '#54595f',
            'yTicksBeg' => $settings['y_axis_begin'],
            'chartId' => $chart_id,
            'suggestedMin' => $settings['y_axis_min'],
            'suggestedMax' => $settings['y_axis_max'],
            'stepSize' => $settings['step_size'],
            'height' => !empty($settings['height']) ? $settings['height'] : 400,
            'target' => ($settings['y_axis_urls_target']) ? '_blank' : '_top',
            'event' => $settings['render_event'],
            'locale' => $settings['format_locale']
        );

        $this->add_render_attribute(
            'charts', [
                'id' => 'eead-chart-container-' . $id,
                'class' => 'eead-chart-container',
                'data-chart' => wp_json_encode($columns_array),
                'data-settings' => wp_json_encode($chart_settings),
                'data-source' => $data_source
            ]
        );

        $this->add_render_attribute(
            'canvas', [
                'id' => 'eead-chart-canvas-' . $id,
                'class' => 'eead-chart-canvas',
                'width' => 400,
                'height' => 400
            ]
        );
        ?>

        <div <?php echo wp_kses_post($this->get_render_attribute_string('charts')); ?>>
            <?php
            if (!empty($settings['title']) && $settings['title_switcher'] && 'top' === $settings['title_position']) {
                ?>
                <div class="eead-chart-title-container">
                    <?php echo wp_kses_post($title); ?>
                </div>
                <?php
            }
            ?>

            <div class="eead-chart-canvas-container">
                <canvas <?php echo wp_kses_post($this->get_render_attribute_string('canvas')); ?>></canvas>
            </div>

            <?php
            if (!empty($settings['title']) && $settings['title_switcher'] && 'bottom' === $settings['title_position']) {
                ?>
                <div class="eead-chart-title-container">
                    <?php echo wp_kses_post($title); ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
