<?php

namespace EasyElementorAddons\Modules\PortfolioGrid;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-portfolio-grid';
    }

    public function get_widgets() {
        $widgets = [
            'PortfolioGrid',
        ];
        return $widgets;
    }

}
