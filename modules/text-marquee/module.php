<?php

namespace EasyElementorAddons\Modules\TextMarquee;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-text-marquee';
    }

    public function get_widgets() {
        $widgets = [
            'TextMarquee',
        ];
        return $widgets;
    }

}
