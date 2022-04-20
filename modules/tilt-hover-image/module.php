<?php

namespace EasyElementorAddons\Modules\TiltHoverImage;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-tilt-hover-image';
    }

    public function get_widgets() {
        $widgets = [
            'TiltHoverImage',
        ];
        return $widgets;
    }

}
