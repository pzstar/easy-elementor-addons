<?php

namespace EasyElementorAddons\Modules\VerticalTabBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-vertical-tab-block';
    }

    public function get_widgets() {
        $widgets = [
            'VerticalTabBlock',
        ];
        return $widgets;
    }

}
