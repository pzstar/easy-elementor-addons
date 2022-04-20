<?php

namespace EasyElementorAddons\Modules\HorizontalScroll;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'total-plus-horizontal-scroll';
    }

    public function get_widgets() {
        $widgets = [
            'HorizontalScroll',
        ];
        return $widgets;
    }

}
