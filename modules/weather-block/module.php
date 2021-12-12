<?php

namespace EasyElementorAddons\Modules\WeatherBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-weather-block';
    }

    public function get_widgets() {
        $widgets = [
            'WeatherBlock',
        ];
        return $widgets;
    }

}
