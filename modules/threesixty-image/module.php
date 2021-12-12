<?php

namespace EasyElementorAddons\Modules\ThreesixtyImage;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-threesixty-image';
    }

    public function get_widgets() {
        $widgets = [
            'ThreesixtyImage',
        ];
        return $widgets;
    }

}
