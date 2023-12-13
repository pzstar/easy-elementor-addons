<?php

namespace EasyElementorAddons\Modules\HorizontalTabBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Module extends Module_Base {

    public function get_name() {
        return 'eead-horizontal-tab';
    }

    public function get_widgets() {
        $widgets = [
            'HorizontalTabBlock',
        ];
        return $widgets;
    }

}
