<?php

namespace EasyElementorAddons\Modules\TestimonialSlider;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-testimonial-slider-block';
    }

    public function get_widgets() {
        $widgets = [
            'TestimonialSlider',
        ];
        return $widgets;
    }

}
