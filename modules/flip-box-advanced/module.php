<?php

namespace EasyElementorAddons\Modules\FlipBoxAdvanced;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Module extends Module_Base {

    public function get_name() {
        return 'eead-flip-box-advanced';
    }

    public function get_widgets() {
        $widgets = [
            'FlipBoxAdvanced',
        ];
        return $widgets;
    }

}
