<?php

namespace EasyElementorAddons\Modules\ScrollNav;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-scroll-nav';
    }

    public function get_widgets() {
        $widgets = [
            'ScrollNav',
        ];
        return $widgets;
    }

}
