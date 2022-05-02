<?php

namespace EasyElementorAddons\Modules\ThreedText;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-threed-text';
    }

    public function get_widgets() {
        $widgets = [
            'ThreedText',
        ];
        return $widgets;
    }

}
