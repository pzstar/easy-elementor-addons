<?php

namespace EasyElementorAddons\Modules\AccordionBlock;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-accordion-block';
    }

    public function get_widgets() {
        $widgets = [
            'AccordionBlock',
        ];
        return $widgets;
    }

}
