<?php

namespace EasyElementorAddons\Modules\SwitcherBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-switcher-block';
    }

    public function get_widgets() {
        $widgets = [
            'SwitcherBlock',
        ];
        return $widgets;
    }

}
