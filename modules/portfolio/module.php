<?php

namespace EasyElementorAddons\Modules\Portfolio;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-portfolio';
    }

    public function get_widgets() {
        $widgets = [
            'Portfolio',
        ];
        return $widgets;
    }

}
