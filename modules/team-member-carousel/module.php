<?php

namespace EasyElementorAddons\Modules\TeamMemberCarousel;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-team-member-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TeamMemberCarousel',
        ];
        return $widgets;
    }

}
