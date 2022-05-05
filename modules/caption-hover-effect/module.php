<?php

namespace EasyElementorAddons\Modules\CaptionHoverEffect;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-caption-hover-effect-block';
    }

    public function get_widgets() {
        $widgets = [
            'CaptionHoverEffect',
        ];
        return $widgets;
    }

}
