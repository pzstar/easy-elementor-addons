<?php

namespace EasyElementorAddons\Modules\MorphingLayouts;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-morphing-layouts';
    }

    public function get_widgets() {
        $widgets = [
            'MorphingLayouts',
        ];
        return $widgets;
    }

}
