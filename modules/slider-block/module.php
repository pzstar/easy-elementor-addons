<?php

namespace EasyElementorAddons\Modules\SliderBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-slider-block';
    }

    public function get_widgets() {
        $widgets = [
            'SliderBlock',
        ];
        return $widgets;
    }

}
