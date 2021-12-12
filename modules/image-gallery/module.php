<?php

namespace EasyElementorAddons\Modules\ImageGallery;

use EasyElementorAddons\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'eead-image-gallery-block';
    }

    public function get_widgets() {
        $widgets = [
            'ImageGallery',
        ];
        return $widgets;
    }

}
