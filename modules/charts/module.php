<?php

namespace EasyElementorAddons\Modules\Charts;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-charts-block';
    }

    public function get_widgets() {
        $widgets = [
            'Charts',
        ];
        return $widgets;
    }

}
