<?php

namespace EasyElementorAddons\Modules\ToggleBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-toggle-block';
    }

    public function get_widgets() {
        $widgets = [
            'ToggleBlock',
        ];
        return $widgets;
    }

}
