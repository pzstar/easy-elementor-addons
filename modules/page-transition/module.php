<?php

namespace EasyElementorAddons\Modules\PageTransition;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-page-transition';
    }

    public function get_widgets() {
        $widgets = [
            'PageTransition',
        ];
        return $widgets;
    }
}