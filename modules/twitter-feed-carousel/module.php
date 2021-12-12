<?php

namespace EasyElementorAddons\Modules\TwitterFeedCarousel;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-twitter-feed-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TwitterFeedCarousel',
        ];
        return $widgets;
    }

}