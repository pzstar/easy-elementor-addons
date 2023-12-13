<?php

namespace EasyElementorAddons\Modules\AnimatedIcon;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Module extends Module_Base {

    public function get_name() {
        return 'eead-animated-icon';
    }

    public function get_widgets() {
        $widgets = [
            'AnimatedIcon',
        ];
        return $widgets;
    }

}
