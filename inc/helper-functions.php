<?php

use Elementor\Plugin;

if (!function_exists('pr')) {

    function pr($ar) {
        echo '<pre>';
        print_r($ar);
        echo '</pre>';
    }

}

if (!function_exists('eead_html_tags')) {

    function eead_html_tags() {
        $html_tags = [
            'div' => esc_html__('div', 'easy-elementor-addons'),
            'span' => esc_html__('span', 'easy-elementor-addons'),
            'p' => esc_html__('p', 'easy-elementor-addons'),
            'h1' => esc_html__('H1', 'easy-elementor-addons'),
            'h2' => esc_html__('H2', 'easy-elementor-addons'),
            'h3' => esc_html__('H3', 'easy-elementor-addons'),
            'h4' => esc_html__('H4', 'easy-elementor-addons'),
            'h5' => esc_html__('H5', 'easy-elementor-addons'),
            'h6' => esc_html__('H6', 'easy-elementor-addons'),
        ];

        return $html_tags;
    }

}

if (!function_exists('parse_wisiwyg_content')) {

    function parse_wisiwyg_content($content) {
        $content = shortcode_unautop($content);
        $content = do_shortcode($content);
        $content = wptexturize($content);
        if ($GLOBALS['wp_embed'] instanceof \WP_Embed) {
            $content = $GLOBALS['wp_embed']->autoembed($content);
        }
        return $content;
    }

}

if (!function_exists('get_pages')) {

    function get_pages() {
        $pages = get_pages(array(
            'order' => 'ASC'
        ));

        $_pages = [];

        foreach ($pages as $key => $object) {
            $_pages[$object->ID] = ucfirst($object->post_title);
        }

        return $_pages;
    }

}

if (!function_exists('get_element_position')) {

    function get_element_position() {
        $position_options = [
            '' => esc_html__('Default', 'easy-elementor-addons'),
            'top-left' => esc_html__('Top Left', 'easy-elementor-addons'),
            'top-center' => esc_html__('Top Center', 'easy-elementor-addons'),
            'top-right' => esc_html__('Top Right', 'easy-elementor-addons'),
            'center' => esc_html__('Center', 'easy-elementor-addons'),
            'center-left' => esc_html__('Center Left', 'easy-elementor-addons'),
            'center-right' => esc_html__('Center Right', 'easy-elementor-addons'),
            'bottom-left' => esc_html__('Bottom Left', 'easy-elementor-addons'),
            'bottom-center' => esc_html__('Bottom Center', 'easy-elementor-addons'),
            'bottom-right' => esc_html__('Bottom Right', 'easy-elementor-addons'),
        ];

        return $position_options;
    }

}

if (!function_exists('eead_anime_animation_easing')) {

    function eead_anime_animation_easing(){
         return array(
            'linear'  => esc_html__( 'Linear', 'easy-elementor-addons' ),
            'easeOutQuad'  => esc_html__( 'Ease-Out Quad', 'easy-elementor-addons' ),
            'easeInQuad'  => esc_html__( 'Ease-In Quad', 'easy-elementor-addons' ),
            'easeInOutQuad'  => esc_html__( 'Ease-InOut Quad', 'easy-elementor-addons' ),

            'easeOutCubic'  => esc_html__( 'Ease-Out Cubic', 'easy-elementor-addons' ),                   
            'easeInCubic'  => esc_html__( 'Ease-In Cubic', 'easy-elementor-addons' ),
            'easeInOutCubic'  => esc_html__( 'Ease-InOut Cubic', 'easy-elementor-addons' ),

            'easeOutQuart'  => esc_html__( 'Ease-Out Quart', 'easy-elementor-addons' ),
            'easeInQuart'  => esc_html__( 'Ease-In Quart', 'easy-elementor-addons' ),
            'easeInOutQuart'  => esc_html__( 'Ease-InOut Quart', 'easy-elementor-addons' ),

            'easeOutQuint'  => esc_html__( 'ease-Out Quint', 'easy-elementor-addons' ),                   
            'easeInQuint'  => esc_html__( 'ease-In Quint', 'easy-elementor-addons' ),
            'easeInOutQuint'  => esc_html__( 'ease-InOut Quint', 'easy-elementor-addons' ),

            'easeOutSine'  => esc_html__( 'Ease-Out Sine', 'easy-elementor-addons' ),
            'easeInSine'  => esc_html__( 'Ease-In Sine', 'easy-elementor-addons' ),
            'easeInOutSine'  => esc_html__( 'Ease-InOut Sine', 'easy-elementor-addons' ),

            'easeOutExpo'  => esc_html__( 'Ease-Out Expo', 'easy-elementor-addons' ),
            'easeInExpo'  => esc_html__( 'Ease-In Expo', 'easy-elementor-addons' ),
            'easeInOutExpo'  => esc_html__( 'Ease-InOut Expo', 'easy-elementor-addons' ),

            'easeOutElastic'  => esc_html__( 'Ease-Out Elastic', 'easy-elementor-addons' ),
            'easeInElastic'  => esc_html__( 'Ease-In Elastic', 'easy-elementor-addons' ),
            'easeInOutElastic'  => esc_html__( 'Ease-InOut Elastic', 'easy-elementor-addons' ),

            'easeOutCirc'  => esc_html__( 'Ease-Out Circ', 'easy-elementor-addons' ),
            'easeInCirc'  => esc_html__( 'Ease-In Circ', 'easy-elementor-addons' ),
            'easeInOutCirc'  => esc_html__( 'Ease-InOut Circ', 'easy-elementor-addons' ),

            'easeOutBack'  => esc_html__( 'Ease-Out Back', 'easy-elementor-addons' ),
            'easeInBack'  => esc_html__( 'Ease-In Back', 'easy-elementor-addons' ),
            'easeInOutBack'  => esc_html__( 'Ease-InOut Back', 'easy-elementor-addons' ),

            'easeOutBounce'  => esc_html__( 'Ease-Out Bounce', 'easy-elementor-addons' ),
            'easeInBounce'  => esc_html__( 'Ease-In Bounce', 'easy-elementor-addons' ),
            'easeInOutBounce'  => esc_html__( 'Ease-InOut Bounce', 'easy-elementor-addons' ),
        );
    }
}

if (!function_exists('eead_svg_icon')) {

    function eead_svg_icon($icon) {

        $icon_path = EEAD_ASSETS_URL . "img/svg/{$icon}.svg";
        if (!file_exists($icon_path)) {
            return false;
        }

        ob_start();
        include $icon_path;
        $svg = ob_get_clean();

        return $svg;
    }

}

if (!function_exists('eead_allow_tags')) {

    function eead_allow_tags($tag = null) {
        $tag_allowed = wp_kses_allowed_html('post');

        $tag_allowed['input'] = [
            'class' => [],
            'id' => [],
            'name' => [],
            'value' => [],
            'checked' => [],
            'type' => [],
        ];
        $tag_allowed['select'] = [
            'class' => [],
            'id' => [],
            'name' => [],
            'value' => [],
            'multiple' => [],
            'type' => [],
        ];
        $tag_allowed['option'] = [
            'value' => [],
            'selected' => [],
        ];

        $tag_allowed['title'] = [
            'a' => [
                'href' => [],
                'title' => [],
                'class' => [],
            ],
            'br' => [],
            'em' => [],
            'strong' => [],
            'hr' => [],
        ];

        $tag_allowed['text'] = [
            'a' => [
                'href' => [],
                'title' => [],
                'class' => [],
            ],
            'br' => [],
            'em' => [],
            'strong' => [],
            'hr' => [],
            'i' => [
                'class' => [],
            ],
            'span' => [
                'class' => [],
            ],
        ];

        $tag_allowed['svg'] = [
            'svg' => [
                'version' => [],
                'xmlns' => [],
                'viewbox' => [],
                'xml:space' => [],
                'xmlns:xlink' => [],
                'x' => [],
                'y' => [],
                'style' => [],
            ],
            'g' => [],
            'path' => [
                'class' => [],
                'd' => [],
            ],
            'ellipse' => [
                'class' => [],
                'cx' => [],
                'cy' => [],
                'rx' => [],
                'ry' => [],
            ],
            'circle' => [
                'class' => [],
                'cx' => [],
                'cy' => [],
                'r' => [],
            ],
            'rect' => [
                'x' => [],
                'y' => [],
                'transform' => [],
                'height' => [],
                'width' => [],
                'class' => [],
            ],
            'line' => [
                'class' => [],
                'x1' => [],
                'x2' => [],
                'y1' => [],
                'y2' => [],
            ],
            'style' => [],
        ];

        if ($tag == null) {
            return $tag_allowed;

        } elseif (is_array($tag)) {
            $new_tag_allow = [];

            foreach ($tag as $_tag) {
                $new_tag_allow[$_tag] = $tag_allowed[$_tag];
            }
            return $new_tag_allow;

        } else {
            return isset($tag_allowed[$tag]) ? $tag_allowed[$tag] : [];
        }
    }

}

if (!function_exists('get_elementor_templates')) {

    function get_elementor_templates() {

        $templates = Plugin::$instance->templates_manager->get_source('local')->get_items();
        $types = [];

        if (empty($templates)) {
            $template_options = ['0' => __('Template Not Found!', 'easy-elementor-addons')];

        } else {
            $template_options = ['0' => __('Select Template', 'easy-elementor-addons')];
            foreach ($templates as $template) {
                $template_options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']] = $template['type'];
            }
        }

        return $template_options;
    }

}

if (!function_exists('eead_plugin_instance')) {

    function eead_plugin_instance() {
        return Plugin::$instance;
    }

}

if (!function_exists('eead_anywhere_templates')) {

    function eead_anywhere_templates() {

        if (post_type_exists('ae_global_templates')) {
            $anywhere = get_posts(array(
                'fields' => 'ids', // Only get post IDs
                'posts_per_page' => -1,
                'post_type' => 'ae_global_templates',
            ));

            $anywhere_options = ['0' => esc_html__('Select Template', 'easy-elementor-addons')];

            foreach ($anywhere as $key => $value) {
                $anywhere_options[$value] = get_the_title($value);
            }

        } else {
            $anywhere_options = ['0' => esc_html__('Please Install AE Plugin', 'easy-elementor-addons')];
        }
        return $anywhere_options;
    }

}

if (!function_exists('eead_button_sizes')) {

    function eead_button_sizes() {
        $btn_sizes = [
            'xs' => esc_html__('Extra Small', 'easy-elementor-addons'),
            'sm' => esc_html__('Small', 'easy-elementor-addons'),
            'md' => esc_html__('Medium', 'easy-elementor-addons'),
            'lg' => esc_html__('Large', 'easy-elementor-addons'),
            'xl' => esc_html__('Extra Large', 'easy-elementor-addons'),
        ];

        return $btn_sizes;
    }

}

if (!function_exists('eead_drop_position')) {

    function eead_drop_position() {
        $drop_positions = [
            'left-top' => esc_html__('Left Top', 'easy-elementor-addons'),
            'left-center' => esc_html__('Left Center', 'easy-elementor-addons'),
            'left-bottom' => esc_html__('Left Bottom', 'easy-elementor-addons'),
            'right-top' => esc_html__('Right Top', 'easy-elementor-addons'),
            'right-center' => esc_html__('Right Center', 'easy-elementor-addons'),
            'right-bottom' => esc_html__('Right Bottom', 'easy-elementor-addons'),
            'top-left' => esc_html__('Top Left', 'easy-elementor-addons'),
            'top-center' => esc_html__('Top Center', 'easy-elementor-addons'),
            'top-right' => esc_html__('Top Right', 'easy-elementor-addons'),
            'top-justify' => esc_html__('Top Justify', 'easy-elementor-addons'),
            'bottom-left' => esc_html__('Bottom Left', 'easy-elementor-addons'),
            'bottom-center' => esc_html__('Bottom Center', 'easy-elementor-addons'),
            'bottom-right' => esc_html__('Bottom Right', 'easy-elementor-addons'),
            'bottom-justify' => esc_html__('Bottom Justify', 'easy-elementor-addons'),
        ];

        return $drop_positions;
    }

}

if (!function_exists('eead_transition_options')) {

    function eead_transition_options() {

        $transition_options = [
            '' => esc_html__('None', 'easy-elementor-addons'),
            'fade' => esc_html__('Fade', 'easy-elementor-addons'),
            'scale-up' => esc_html__('Scale Up', 'easy-elementor-addons'),
            'scale-down' => esc_html__('Scale Down', 'easy-elementor-addons'),
            'slide-top' => esc_html__('Slide Top', 'easy-elementor-addons'),
            'slide-bottom' => esc_html__('Slide Bottom', 'easy-elementor-addons'),
            'slide-left' => esc_html__('Slide Left', 'easy-elementor-addons'),
            'slide-right' => esc_html__('Slide Right', 'easy-elementor-addons'),
            'slide-top-small' => esc_html__('Slide Top Small', 'easy-elementor-addons'),
            'slide-bottom-small' => esc_html__('Slide Bottom Small', 'easy-elementor-addons'),
            'slide-left-small' => esc_html__('Slide Left Small', 'easy-elementor-addons'),
            'slide-right-small' => esc_html__('Slide Right Small', 'easy-elementor-addons'),
            'slide-top-medium' => esc_html__('Slide Top Medium', 'easy-elementor-addons'),
            'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'easy-elementor-addons'),
            'slide-left-medium' => esc_html__('Slide Left Medium', 'easy-elementor-addons'),
            'slide-right-medium' => esc_html__('Slide Right Medium', 'easy-elementor-addons'),
        ];

        return $transition_options;
    }

}

if (!function_exists('eead_get_elementor_page_list')) { 
    function eead_get_elementor_page_list() {

        $pagelist = get_posts(
            array(
                'post_type' => 'elementor_library',
                'showposts' => 999,
            )
        );

        if (!empty($pagelist) && ! is_wp_error($pagelist)) {

            foreach ($pagelist as $post) {
                $options[ $post->post_title ] = $post->post_title;
            }

            update_option('temp_count', $options);
            return $options;
        }
    }
}

if (!function_exists('eead_get_item_position')) { 
    function eead_get_item_position() {
        $position_options = [
            '' => esc_html__('Default', 'easy-elementor-addons'),
            'top-left' => esc_html__('Top Left', 'easy-elementor-addons'),
            'top-center' => esc_html__('Top Center', 'easy-elementor-addons'),
            'top-right' => esc_html__('Top Right', 'easy-elementor-addons'),
            'center' => esc_html__('Center', 'easy-elementor-addons'),
            'center-left' => esc_html__('Center Left', 'easy-elementor-addons'),
            'center-right' => esc_html__('Center Right', 'easy-elementor-addons'),
            'bottom-left' => esc_html__('Bottom Left', 'easy-elementor-addons'),
            'bottom-center' => esc_html__('Bottom Center', 'easy-elementor-addons'),
            'bottom-right' => esc_html__('Bottom Right', 'easy-elementor-addons'),
        ];
        return $position_options;
    }
}

if (!function_exists('eead_get_menu')) { 
    function eead_get_menu() {
        $menus = wp_get_nav_menus();
        $items = [0 => esc_html__('Select Menu', 'easy-elementor-addons')];
        foreach ($menus as $menu) {
            $items[$menu->slug] = $menu->name;
        }
        return $items;
    }
}

function eead_get_post_types($args = []) {

    $post_type_args = [
        'show_in_nav_menus' => true,
    ];

    if (!empty($args['post_type'])) {
        $post_type_args['name'] = $args['post_type'];
    }

    $_post_types = get_post_types($post_type_args, 'objects');
    $post_types = ['0' => esc_html__('Select Type', 'easy-elementor-addons')];

    foreach ($_post_types as $post_type => $object) {
        $post_types[$post_type] = $object->label;
    }

    return $post_types;
}


function eead_transition_options() {

    $transition_options = [
        '' => esc_html__('None', 'easy-elementor-addons'),
        'fade' => esc_html__('Fade', 'easy-elementor-addons'),
        'scale-up' => esc_html__('Scale Up', 'easy-elementor-addons'),
        'scale-down' => esc_html__('Scale Down', 'easy-elementor-addons'),
        'slide-top' => esc_html__('Slide Top', 'easy-elementor-addons'),
        'slide-bottom' => esc_html__('Slide Bottom', 'easy-elementor-addons'),
        'slide-left' => esc_html__('Slide Left', 'easy-elementor-addons'),
        'slide-right' => esc_html__('Slide Right', 'easy-elementor-addons'),
        'slide-top-small' => esc_html__('Slide Top Small', 'easy-elementor-addons'),
        'slide-bottom-small' => esc_html__('Slide Bottom Small', 'easy-elementor-addons'),
        'slide-left-small' => esc_html__('Slide Left Small', 'easy-elementor-addons'),
        'slide-right-small' => esc_html__('Slide Right Small', 'easy-elementor-addons'),
        'slide-top-medium' => esc_html__('Slide Top Medium', 'easy-elementor-addons'),
        'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'easy-elementor-addons'),
        'slide-left-medium' => esc_html__('Slide Left Medium', 'easy-elementor-addons'),
        'slide-right-medium' => esc_html__('Slide Right Medium', 'easy-elementor-addons'),
    ];

    return $transition_options;
}

function eead_get_image_sizes() {
    $output_sizes = array();
    $img_sizes = get_intermediate_image_sizes();
    $output_sizes['full'] = esc_html__('Full', 'easy-elementor-addons');

    foreach ($img_sizes as $size_name) {
        $output_sizes[$size_name] = $size_name;
    }

    return $output_sizes;
}


if (!function_exists('eead_materialdesignicons_array')) {

    function eead_materialdesignicons_array() {
        return array("access-point", "access-point-network", "account", "account-alert", "account-box", "account-box-outline", "account-card-details", "account-check", "account-circle", "account-convert", "account-edit", "account-key", "account-location", "account-minus", "account-multiple", "account-multiple-minus", "account-multiple-outline", "account-multiple-plus", "account-network", "account-off", "account-outline", "account-plus", "account-remove", "account-search", "account-settings", "account-settings-variant", "account-star", "account-switch", "adjust", "air-conditioner", "airballoon", "airplane", "airplane-landing", "airplane-off", "airplane-takeoff", "airplay", "alarm", "alarm-check", "alarm-multiple", "alarm-off", "alarm-plus", "alarm-snooze", "album", "alert", "alert-box", "alert-circle", "alert-circle-outline", "alert-decagram", "alert-octagon", "alert-octagram", "alert-outline", "all-inclusive", "alpha", "alphabetical", "altimeter", "amazon", "amazon-clouddrive", "ambulance", "amplifier", "anchor", "android", "android-debug-bridge", "android-studio", "angular", "angularjs", "animation", "apple", "apple-finder", "apple-ios", "apple-keyboard-caps", "apple-keyboard-command", "apple-keyboard-control", "apple-keyboard-option", "apple-keyboard-shift", "apple-mobileme", "apple-safari", "application", "apps", "archive", "arrange-bring-forward", "arrange-bring-to-front", "arrange-send-backward", "arrange-send-to-back", "arrow-all", "arrow-bottom-left", "arrow-bottom-right", "arrow-compress", "arrow-compress-all", "arrow-down", "arrow-down-bold", "arrow-down-bold-box", "arrow-down-bold-box-outline", "arrow-down-bold-circle", "arrow-down-bold-circle-outline", "arrow-down-bold-hexagon-outline", "arrow-down-box", "arrow-down-drop-circle", "arrow-down-drop-circle-outline", "arrow-down-thick", "arrow-expand", "arrow-expand-all", "arrow-left", "arrow-left-bold", "arrow-left-bold-box", "arrow-left-bold-box-outline", "arrow-left-bold-circle", "arrow-left-bold-circle-outline", "arrow-left-bold-hexagon-outline", "arrow-left-box", "arrow-left-drop-circle", "arrow-left-drop-circle-outline", "arrow-left-thick", "arrow-right", "arrow-right-bold", "arrow-right-bold-box", "arrow-right-bold-box-outline", "arrow-right-bold-circle", "arrow-right-bold-circle-outline", "arrow-right-bold-hexagon-outline", "arrow-right-box", "arrow-right-drop-circle", "arrow-right-drop-circle-outline", "arrow-right-thick", "arrow-top-left", "arrow-top-right", "arrow-up", "arrow-up-bold", "arrow-up-bold-box", "arrow-up-bold-box-outline", "arrow-up-bold-circle", "arrow-up-bold-circle-outline", "arrow-up-bold-hexagon-outline", "arrow-up-box", "arrow-up-drop-circle", "arrow-up-drop-circle-outline", "arrow-up-thick", "assistant", "asterisk", "at", "atom", "attachment", "audiobook", "auto-fix", "auto-upload", "autorenew", "av-timer", "baby", "baby-buggy", "backburger", "backspace", "backup-restore", "bandcamp", "bank", "barcode", "barcode-scan", "barley", "barrel", "basecamp", "basket", "basket-fill", "basket-unfill", "battery", "battery-10", "battery-20", "battery-30", "battery-40", "battery-50", "battery-60", "battery-70", "battery-80", "battery-90", "battery-alert", "battery-charging", "battery-charging-100", "battery-charging-20", "battery-charging-30", "battery-charging-40", "battery-charging-60", "battery-charging-80", "battery-charging-90", "battery-minus", "battery-negative", "battery-outline", "battery-plus", "battery-positive", "battery-unknown", "beach", "beaker", "beats", "beer", "behance", "bell", "bell-off", "bell-outline", "bell-plus", "bell-ring", "bell-ring-outline", "bell-sleep", "beta", "bible", "bike", "bing", "binoculars", "bio", "biohazard", "bitbucket", "black-mesa", "blackberry", "blender", "blinds", "block-helper", "blogger", "bluetooth", "bluetooth-audio", "bluetooth-connect", "bluetooth-off", "bluetooth-settings", "bluetooth-transfer", "blur", "blur-linear", "blur-off", "blur-radial", "bomb", "bomb-off", "bone", "book", "book-minus", "book-multiple", "book-multiple-variant", "book-open", "book-open-page-variant", "book-open-variant", "book-plus", "book-variant", "bookmark", "bookmark-check", "bookmark-music", "bookmark-outline", "bookmark-plus", "bookmark-plus-outline", "bookmark-remove", "boombox", "bootstrap", "border-all", "border-bottom", "border-color", "border-horizontal", "border-inside", "border-left", "border-none", "border-outside", "border-right", "border-style", "border-top", "border-vertical", "bow-tie", "bowl", "bowling", "box", "box-cutter", "box-shadow", "bridge", "briefcase", "briefcase-check", "briefcase-download", "briefcase-upload", "brightness-1", "brightness-2", "brightness-3", "brightness-4", "brightness-5", "brightness-6", "brightness-7", "brightness-auto", "broom", "brush", "buffer", "bug", "bulletin-board", "bullhorn", "bullseye", "burst-mode", "bus", "cached", "cake", "cake-layered", "cake-variant", "calculator", "calendar", "calendar-blank", "calendar-check", "calendar-clock", "calendar-multiple", "calendar-multiple-check", "calendar-plus", "calendar-question", "calendar-range", "calendar-remove", "calendar-text", "calendar-today", "call-made", "call-merge", "call-missed", "call-received", "call-split", "camcorder", "camcorder-box", "camcorder-box-off", "camcorder-off", "camera", "camera-burst", "camera-enhance", "camera-front", "camera-front-variant", "camera-iris", "camera-off", "camera-party-mode", "camera-rear", "camera-rear-variant", "camera-switch", "camera-timer", "cancel", "candle", "candycane", "car", "car-battery", "car-connected", "car-wash", "cards", "cards-outline", "cards-playing-outline", "cards-variant", "carrot", "cart", "cart-off", "cart-outline", "cart-plus", "case-sensitive-alt", "cash", "cash-100", "cash-multiple", "cash-usd", "cast", "cast-connected", "cast-off", "castle", "cat", "ceiling-light", "cellphone", "cellphone-android", "cellphone-basic", "cellphone-dock", "cellphone-iphone", "cellphone-link", "cellphone-link-off", "cellphone-settings", "certificate", "chair-school", "chart-arc", "chart-areaspline", "chart-bar", "chart-bar-stacked", "chart-bubble", "chart-gantt", "chart-histogram", "chart-line", "chart-line-stacked", "chart-pie", "chart-scatterplot-hexbin", "chart-timeline", "check", "check-all", "check-circle", "check-circle-outline", "checkbox-blank", "checkbox-blank-circle", "checkbox-blank-circle-outline", "checkbox-blank-outline", "checkbox-marked", "checkbox-marked-circle", "checkbox-marked-circle-outline", "checkbox-marked-outline", "checkbox-multiple-blank", "checkbox-multiple-blank-circle", "checkbox-multiple-blank-circle-outline", "checkbox-multiple-blank-outline", "checkbox-multiple-marked", "checkbox-multiple-marked-circle", "checkbox-multiple-marked-circle-outline", "checkbox-multiple-marked-outline", "checkerboard", "chemical-weapon", "chevron-double-down", "chevron-double-left", "chevron-double-right", "chevron-double-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "chip", "church", "circle", "circle-outline", "cisco-webex", "city", "clipboard", "clipboard-account", "clipboard-alert", "clipboard-arrow-down", "clipboard-arrow-left", "clipboard-check", "clipboard-flow", "clipboard-outline", "clipboard-plus", "clipboard-text", "clippy", "clock", "clock-alert", "clock-end", "clock-fast", "clock-in", "clock-out", "clock-start", "close", "close-box", "close-box-outline", "close-circle", "close-circle-outline", "close-network", "close-octagon", "close-octagon-outline", "close-outline", "closed-caption", "cloud", "cloud-check", "cloud-circle", "cloud-download", "cloud-off-outline", "cloud-outline", "cloud-print", "cloud-print-outline", "cloud-sync", "cloud-upload", "code-array", "code-braces", "code-brackets", "code-equal", "code-greater-than", "code-greater-than-or-equal", "code-less-than", "code-less-than-or-equal", "code-not-equal", "code-not-equal-variant", "code-parentheses", "code-string", "code-tags", "code-tags-check", "codepen", "coffee", "coffee-outline", "coffee-to-go", "coin", "coins", "collage", "color-helper", "comment", "comment-account", "comment-account-outline", "comment-alert", "comment-alert-outline", "comment-check", "comment-check-outline", "comment-multiple-outline", "comment-outline", "comment-plus-outline", "comment-processing", "comment-processing-outline", "comment-question-outline", "comment-remove-outline", "comment-text", "comment-text-outline", "compare", "compass", "compass-outline", "console", "contact-mail", "contacts", "content-copy", "content-cut", "content-duplicate", "content-paste", "content-save", "content-save-all", "content-save-settings", "contrast", "contrast-box", "contrast-circle", "cookie", "copyright", "counter", "cow", "creation", "credit-card", "credit-card-multiple", "credit-card-off", "credit-card-plus", "credit-card-scan", "crop", "crop-free", "crop-landscape", "crop-portrait", "crop-rotate", "crop-square", "crosshairs", "crosshairs-gps", "crown", "cube", "cube-outline", "cube-send", "cube-unfolded", "cup", "cup-off", "cup-water", "currency-btc", "currency-eur", "currency-gbp", "currency-inr", "currency-ngn", "currency-rub", "currency-try", "currency-usd", "currency-usd-off", "cursor-default", "cursor-default-outline", "cursor-move", "cursor-pointer", "cursor-text", "database", "database-minus", "database-plus", "debug-step-into", "debug-step-out", "debug-step-over", "decagram", "decagram-outline", "decimal-decrease", "decimal-increase", "delete", "delete-circle", "delete-empty", "delete-forever", "delete-sweep", "delete-variant", "delta", "deskphone", "desktop-mac", "desktop-tower", "details", "developer-board", "deviantart", "dialpad", "diamond", "dice-1", "dice-2", "dice-3", "dice-4", "dice-5", "dice-6", "dice-d10", "dice-d20", "dice-d4", "dice-d6", "dice-d8", "dice-multiple", "dictionary", "directions", "directions-fork", "discord", "disk", "disk-alert", "disqus", "disqus-outline", "division", "division-box", "dna", "dns", "do-not-disturb", "do-not-disturb-off", "dolby", "domain", "dots-horizontal", "dots-vertical", "douban", "download", "download-network", "drag", "drag-horizontal", "drag-vertical", "drawing", "drawing-box", "dribbble", "dribbble-box", "drone", "dropbox", "drupal", "duck", "dumbbell", "earth", "earth-box", "earth-box-off", "earth-off", "edge", "eject", "elevation-decline", "elevation-rise", "elevator", "email", "email-alert", "email-open", "email-open-outline", "email-outline", "email-secure", "email-variant", "emby", "emoticon", "emoticon-cool", "emoticon-dead", "emoticon-devil", "emoticon-excited", "emoticon-happy", "emoticon-neutral", "emoticon-poop", "emoticon-sad", "emoticon-tongue", "engine", "engine-outline", "equal", "equal-box", "eraser", "eraser-variant", "escalator", "ethernet", "ethernet-cable", "ethernet-cable-off", "etsy", "ev-station", "evernote", "exclamation", "exit-to-app", "export", "eye", "eye-off", "eye-off-outline", "eye-outline", "eyedropper", "eyedropper-variant", "face", "face-profile", "facebook", "facebook-box", "facebook-messenger", "factory", "fan", "fast-forward", "fast-forward-outline", "fax", "feather", "ferry", "file", "file-account", "file-chart", "file-check", "file-cloud", "file-delimited", "file-document", "file-document-box", "file-excel", "file-excel-box", "file-export", "file-find", "file-hidden", "file-image", "file-import", "file-lock", "file-multiple", "file-music", "file-outline", "file-pdf", "file-pdf-box", "file-plus", "file-powerpoint", "file-powerpoint-box", "file-presentation-box", "file-restore", "file-send", "file-tree", "file-video", "file-word", "file-word-box", "file-xml", "film", "filmstrip", "filmstrip-off", "filter", "filter-outline", "filter-remove", "filter-remove-outline", "filter-variant", "find-replace", "fingerprint", "fire", "firefox", "fish", "flag", "flag-checkered", "flag-outline", "flag-outline-variant", "flag-triangle", "flag-variant", "flash", "flash-auto", "flash-off", "flash-outline", "flash-red-eye", "flashlight", "flashlight-off", "flask", "flask-empty", "flask-empty-outline", "flask-outline", "flattr", "flip-to-back", "flip-to-front", "floppy", "flower", "folder", "folder-account", "folder-download", "folder-google-drive", "folder-image", "folder-lock", "folder-lock-open", "folder-move", "folder-multiple", "folder-multiple-image", "folder-multiple-outline", "folder-open", "folder-outline", "folder-plus", "folder-remove", "folder-star", "folder-upload", "font-awesome", "food", "food-apple", "food-fork-drink", "food-off", "food-variant", "football", "football-australian", "football-helmet", "format-align-bottom", "format-align-center", "format-align-justify", "format-align-left", "format-align-middle", "format-align-right", "format-align-top", "format-annotation-plus", "format-bold", "format-clear", "format-color-fill", "format-color-text", "format-float-center", "format-float-left", "format-float-none", "format-float-right", "format-font", "format-header-1", "format-header-2", "format-header-3", "format-header-4", "format-header-5", "format-header-6", "format-header-decrease", "format-header-equal", "format-header-increase", "format-header-pound", "format-horizontal-align-center", "format-horizontal-align-left", "format-horizontal-align-right", "format-indent-decrease", "format-indent-increase", "format-italic", "format-line-spacing", "format-line-style", "format-line-weight", "format-list-bulleted", "format-list-bulleted-type", "format-list-checks", "format-list-numbers", "format-page-break", "format-paint", "format-paragraph", "format-pilcrow", "format-quote-close", "format-quote-open", "format-rotate-90", "format-section", "format-size", "format-strikethrough", "format-strikethrough-variant", "format-subscript", "format-superscript", "format-text", "format-textdirection-l-to-r", "format-textdirection-r-to-l", "format-title", "format-underline", "format-vertical-align-bottom", "format-vertical-align-center", "format-vertical-align-top", "format-wrap-inline", "format-wrap-square", "format-wrap-tight", "format-wrap-top-bottom", "forum", "forward", "foursquare", "fridge", "fridge-filled", "fridge-filled-bottom", "fridge-filled-top", "fullscreen", "fullscreen-exit", "function", "gamepad", "gamepad-variant", "garage", "garage-open", "gas-cylinder", "gas-station", "gate", "gauge", "gavel", "gender-female", "gender-male", "gender-male-female", "gender-transgender", "gesture-double-tap", "gesture-swipe-down", "gesture-swipe-left", "gesture-swipe-right", "gesture-swipe-up", "gesture-tap", "gesture-two-double-tap", "gesture-two-tap", "ghost", "gift", "git", "github-box", "github-circle", "github-face", "glass-flute", "glass-mug", "glass-stange", "glass-tulip", "glassdoor", "glasses", "gmail", "gnome", "gondola", "google", "google-cardboard", "google-chrome", "google-circles", "google-circles-communities", "google-circles-extended", "google-circles-group", "google-controller", "google-controller-off", "google-drive", "google-earth", "google-glass", "google-keep", "google-maps", "google-nearby", "google-pages", "google-photos", "google-physical-web", "google-play", "google-plus", "google-plus-box", "google-translate", "google-wallet", "gradient", "grease-pencil", "grid", "grid-large", "grid-off", "group", "guitar-acoustic", "guitar-electric", "guitar-pick", "guitar-pick-outline", "hackernews", "hamburger", "hand-pointing-right", "hanger", "hangouts", "harddisk", "headphones", "headphones-box", "headphones-settings", "headset", "headset-dock", "headset-off", "heart", "heart-box", "heart-box-outline", "heart-broken", "heart-half", "heart-half-full", "heart-half-outline", "heart-off", "heart-outline", "heart-pulse", "help", "help-box", "help-circle", "help-circle-outline", "help-network", "hexagon", "hexagon-multiple", "hexagon-outline", "highway", "history", "hololens", "home", "home-map-marker", "home-modern", "home-outline", "home-variant", "hook", "hook-off", "hops", "hospital", "hospital-building", "hospital-marker", "hotel", "houzz", "houzz-box", "human", "human-child", "human-female", "human-greeting", "human-handsdown", "human-handsup", "human-male", "human-male-female", "human-pregnant", "humble-bundle", "image", "image-album", "image-area", "image-area-close", "image-broken", "image-broken-variant", "image-filter", "image-filter-black-white", "image-filter-center-focus", "image-filter-center-focus-weak", "image-filter-drama", "image-filter-frames", "image-filter-hdr", "image-filter-none", "image-filter-tilt-shift", "image-filter-vintage", "image-multiple", "import", "inbox", "inbox-arrow-down", "inbox-arrow-up", "incognito", "infinity", "information", "information-outline", "information-variant", "instagram", "instapaper", "internet-explorer", "invert-colors", "itunes", "jeepney", "jira", "jsfiddle", "json", "keg", "kettle", "key", "key-change", "key-minus", "key-plus", "key-remove", "key-variant", "keyboard", "keyboard-backspace", "keyboard-caps", "keyboard-close", "keyboard-off", "keyboard-return", "keyboard-tab", "keyboard-variant", "kickstarter", "kodi", "label", "label-outline", "lambda", "lamp", "lan", "lan-connect", "lan-disconnect", "lan-pending", "language-c", "language-cpp", "language-csharp", "language-css3", "language-html5", "language-javascript", "language-php", "language-python", "language-python-text", "language-swift", "language-typescript", "laptop", "laptop-chromebook", "laptop-mac", "laptop-off", "laptop-windows", "lastfm", "launch", "layers", "layers-off", "lead-pencil", "leaf", "led-off", "led-on", "led-outline", "led-variant-off", "led-variant-on", "led-variant-outline", "library", "library-books", "library-music", "library-plus", "lightbulb", "lightbulb-on", "lightbulb-on-outline", "lightbulb-outline", "link", "link-off", "link-variant", "link-variant-off", "linkedin", "linkedin-box", "linux", "loading", "lock", "lock-open", "lock-open-outline", "lock-outline", "lock-pattern", "lock-plus", "lock-reset", "login", "login-variant", "logout", "logout-variant", "looks", "loop", "loupe", "lumx", "magnet", "magnet-on", "magnify", "magnify-minus", "magnify-minus-outline", "magnify-plus", "magnify-plus-outline", "mail-ru", "mailbox", "map", "map-marker", "map-marker-circle", "map-marker-minus", "map-marker-multiple", "map-marker-off", "map-marker-plus", "map-marker-radius", "margin", "markdown", "marker", "marker-check", "martini", "material-ui", "math-compass", "matrix", "maxcdn", "medical-bag", "medium", "memory", "menu", "menu-down", "menu-down-outline", "menu-left", "menu-right", "menu-up", "menu-up-outline", "message", "message-alert", "message-bulleted", "message-bulleted-off", "message-draw", "message-image", "message-outline", "message-plus", "message-processing", "message-reply", "message-reply-text", "message-settings", "message-settings-variant", "message-text", "message-text-outline", "message-video", "meteor", "microphone", "microphone-off", "microphone-outline", "microphone-settings", "microphone-variant", "microphone-variant-off", "microscope", "microsoft", "minecraft", "minus", "minus-box", "minus-box-outline", "minus-circle", "minus-circle-outline", "minus-network", "mixcloud", "monitor", "monitor-multiple", "more", "motorbike", "mouse", "mouse-off", "mouse-variant", "mouse-variant-off", "move-resize", "move-resize-variant", "movie", "multiplication", "multiplication-box", "music", "music-box", "music-box-outline", "music-circle", "music-note", "music-note-bluetooth", "music-note-bluetooth-off", "music-note-eighth", "music-note-half", "music-note-off", "music-note-quarter", "music-note-sixteenth", "music-note-whole", "music-off", "nature", "nature-people", "navigation", "near-me", "needle", "nest-protect", "nest-thermostat", "netflix", "network", "new-box", "newspaper", "nfc", "nfc-tap", "nfc-variant", "ninja", "nodejs", "note", "note-multiple", "note-multiple-outline", "note-outline", "note-plus", "note-plus-outline", "note-text", "notification-clear-all", "npm", "nuke", "numeric", "numeric-0-box", "numeric-0-box-multiple-outline", "numeric-0-box-outline", "numeric-1-box", "numeric-1-box-multiple-outline", "numeric-1-box-outline", "numeric-2-box", "numeric-2-box-multiple-outline", "numeric-2-box-outline", "numeric-3-box", "numeric-3-box-multiple-outline", "numeric-3-box-outline", "numeric-4-box", "numeric-4-box-multiple-outline", "numeric-4-box-outline", "numeric-5-box", "numeric-5-box-multiple-outline", "numeric-5-box-outline", "numeric-6-box", "numeric-6-box-multiple-outline", "numeric-6-box-outline", "numeric-7-box", "numeric-7-box-multiple-outline", "numeric-7-box-outline", "numeric-8-box", "numeric-8-box-multiple-outline", "numeric-8-box-outline", "numeric-9-box", "numeric-9-box-multiple-outline", "numeric-9-box-outline", "numeric-9-plus-box", "numeric-9-plus-box-multiple-outline", "numeric-9-plus-box-outline", "nut", "nutrition", "oar", "octagon", "octagon-outline", "octagram", "octagram-outline", "odnoklassniki", "office", "oil", "oil-temperature", "omega", "onedrive", "onenote", "opacity", "open-in-app", "open-in-new", "openid", "opera", "orbit", "ornament", "ornament-variant", "owl", "package", "package-down", "package-up", "package-variant", "package-variant-closed", "page-first", "page-last", "page-layout-body", "page-layout-footer", "page-layout-header", "page-layout-sidebar-left", "page-layout-sidebar-right", "palette", "palette-advanced", "panda", "pandora", "panorama", "panorama-fisheye", "panorama-horizontal", "panorama-vertical", "panorama-wide-angle", "paper-cut-vertical", "paperclip", "parking", "pause", "pause-circle", "pause-circle-outline", "pause-octagon", "pause-octagon-outline", "paw", "paw-off", "pen", "pencil", "pencil-box", "pencil-box-outline", "pencil-circle", "pencil-circle-outline", "pencil-lock", "pencil-off", "pentagon", "pentagon-outline", "percent", "periscope", "pharmacy", "phone", "phone-bluetooth", "phone-classic", "phone-forward", "phone-hangup", "phone-in-talk", "phone-incoming", "phone-locked", "phone-log", "phone-minus", "phone-missed", "phone-outgoing", "phone-paused", "phone-plus", "phone-settings", "phone-voip", "pi", "pi-box", "piano", "pig", "pill", "pillar", "pin", "pin-off", "pine-tree", "pine-tree-box", "pinterest", "pinterest-box", "pistol", "pizza", "plane-shield", "play", "play-box-outline", "play-circle", "play-circle-outline", "play-pause", "play-protected-content", "playlist-check", "playlist-minus", "playlist-play", "playlist-plus", "playlist-remove", "playstation", "plex", "plus", "plus-box", "plus-box-outline", "plus-circle", "plus-circle-multiple-outline", "plus-circle-outline", "plus-network", "plus-one", "plus-outline", "pocket", "pokeball", "polaroid", "poll", "poll-box", "polymer", "pool", "popcorn", "pot", "pot-mix", "pound", "pound-box", "power", "power-plug", "power-plug-off", "power-settings", "power-socket", "prescription", "presentation", "presentation-play", "printer", "printer-3d", "printer-alert", "printer-settings", "priority-high", "priority-low", "professional-hexagon", "projector", "projector-screen", "publish", "pulse", "puzzle", "qqchat", "qrcode", "qrcode-scan", "quadcopter", "quality-high", "quicktime", "radar", "radiator", "radio", "radio-handheld", "radio-tower", "radioactive", "radiobox-blank", "radiobox-marked", "raspberrypi", "ray-end", "ray-end-arrow", "ray-start", "ray-start-arrow", "ray-start-end", "ray-vertex", "rdio", "react", "read", "readability", "receipt", "record", "record-rec", "recycle", "reddit", "redo", "redo-variant", "refresh", "regex", "relative-scale", "reload", "remote", "rename-box", "reorder-horizontal", "reorder-vertical", "repeat", "repeat-off", "repeat-once", "replay", "reply", "reply-all", "reproduction", "resize-bottom-right", "responsive", "restart", "restore", "rewind", "rewind-outline", "rhombus", "rhombus-outline", "ribbon", "road", "road-variant", "robot", "rocket", "roomba", "rotate-3d", "rotate-left", "rotate-left-variant", "rotate-right", "rotate-right-variant", "rounded-corner", "router-wireless", "routes", "rowing", "rss", "rss-box", "ruler", "run", "run-fast", "sale", "satellite", "satellite-variant", "saxophone", "scale", "scale-balance", "scale-bathroom", "scanner", "school", "screen-rotation", "screen-rotation-lock", "screwdriver", "script", "sd", "seal", "search-web", "seat-flat", "seat-flat-angled", "seat-individual-suite", "seat-legroom-extra", "seat-legroom-normal", "seat-legroom-reduced", "seat-recline-extra", "seat-recline-normal", "security", "security-home", "security-network", "select", "select-all", "select-inverse", "select-off", "selection", "selection-off", "send", "serial-port", "server", "server-minus", "server-network", "server-network-off", "server-off", "server-plus", "server-remove", "server-security", "set-all", "set-center", "set-center-right", "set-left", "set-left-center", "set-left-right", "set-none", "set-right", "settings", "settings-box", "shape-circle-plus", "shape-plus", "shape-polygon-plus", "shape-rectangle-plus", "shape-square-plus", "share", "share-variant", "shield", "shield-half-full", "shield-outline", "shopping", "shopping-music", "shovel", "shovel-off", "shredder", "shuffle", "shuffle-disabled", "shuffle-variant", "sigma", "sigma-lower", "sign-caution", "sign-direction", "sign-text", "signal", "signal-2g", "signal-3g", "signal-4g", "signal-hspa", "signal-hspa-plus", "signal-off", "signal-variant", "silverware", "silverware-fork", "silverware-spoon", "silverware-variant", "sim", "sim-alert", "sim-off", "sitemap", "skip-backward", "skip-forward", "skip-next", "skip-next-circle", "skip-next-circle-outline", "skip-previous", "skip-previous-circle", "skip-previous-circle-outline", "skull", "skype", "skype-business", "slack", "sleep", "sleep-off", "smoking", "smoking-off", "snapchat", "snowflake", "snowman", "soccer", "sofa", "solid", "sort", "sort-alphabetical", "sort-ascending", "sort-descending", "sort-numeric", "sort-variant", "soundcloud", "source-branch", "source-commit", "source-commit-end", "source-commit-end-local", "source-commit-local", "source-commit-next-local", "source-commit-start", "source-commit-start-next-local", "source-fork", "source-merge", "source-pull", "speaker", "speaker-off", "speaker-wireless", "speedometer", "spellcheck", "spotify", "spotlight", "spotlight-beam", "spray", "square", "square-inc", "square-inc-cash", "square-outline", "square-root", "stackexchange", "stackoverflow", "stadium", "stairs", "star", "star-circle", "star-half", "star-off", "star-outline", "steam", "steering", "step-backward", "step-backward-2", "step-forward", "step-forward-2", "stethoscope", "sticker", "sticker-emoji", "stocking", "stop", "stop-circle", "stop-circle-outline", "store", "store-24-hour", "stove", "subdirectory-arrow-left", "subdirectory-arrow-right", "subway", "subway-variant", "summit", "sunglasses", "surround-sound", "svg", "swap-horizontal", "swap-vertical", "swim", "switch", "sword", "sword-cross", "sync", "sync-alert", "sync-off", "tab", "tab-plus", "tab-unselected", "table", "table-column-plus-after", "table-column-plus-before", "table-column-remove", "table-column-width", "table-edit", "table-large", "table-row-height", "table-row-plus-after", "table-row-plus-before", "table-row-remove", "tablet", "tablet-android", "tablet-ipad", "taco", "tag", "tag-faces", "tag-heart", "tag-multiple", "tag-outline", "tag-plus", "tag-remove", "tag-text-outline", "target", "taxi", "teamviewer", "telegram", "television", "television-guide", "temperature-celsius", "temperature-fahrenheit", "temperature-kelvin", "tennis", "tent", "terrain", "test-tube", "text-shadow", "text-to-speech", "text-to-speech-off", "textbox", "texture", "theater", "theme-light-dark", "thermometer", "thermometer-lines", "thumb-down", "thumb-down-outline", "thumb-up", "thumb-up-outline", "thumbs-up-down", "ticket", "ticket-account", "ticket-confirmation", "ticket-percent", "tie", "tilde", "timelapse", "timer", "timer-10", "timer-3", "timer-off", "timer-sand", "timer-sand-empty", "timer-sand-full", "timetable", "toggle-switch", "toggle-switch-off", "tooltip", "tooltip-edit", "tooltip-image", "tooltip-outline", "tooltip-outline-plus", "tooltip-text", "tooth", "tor", "tower-beach", "tower-fire", "traffic-light", "train", "tram", "transcribe", "transcribe-close", "transfer", "transit-transfer", "translate", "treasure-chest", "tree", "trello", "trending-down", "trending-neutral", "trending-up", "triangle", "triangle-outline", "trophy", "trophy-award", "trophy-outline", "trophy-variant", "trophy-variant-outline", "truck", "truck-delivery", "truck-fast", "truck-trailer", "tshirt-crew", "tshirt-v", "tumblr", "tumblr-reblog", "tune", "tune-vertical", "twitch", "twitter", "twitter-box", "twitter-circle", "twitter-retweet", "uber", "ubuntu", "umbraco", "umbrella", "umbrella-outline", "undo", "undo-variant", "unfold-less-horizontal", "unfold-less-vertical", "unfold-more-horizontal", "unfold-more-vertical", "ungroup", "unity", "untappd", "update", "upload", "upload-network", "usb", "vector-arrange-above", "vector-arrange-below", "vector-circle", "vector-circle-variant", "vector-combine", "vector-curve", "vector-difference", "vector-difference-ab", "vector-difference-ba", "vector-intersection", "vector-line", "vector-point", "vector-polygon", "vector-polyline", "vector-radius", "vector-rectangle", "vector-selection", "vector-square", "vector-triangle", "vector-union", "verified", "vibrate", "video", "video-off", "video-switch", "view-agenda", "view-array", "view-carousel", "view-column", "view-dashboard", "view-day", "view-grid", "view-headline", "view-list", "view-module", "view-parallel", "view-quilt", "view-sequential", "view-stream", "view-week", "vimeo", "vine", "violin", "visualstudio", "vk", "vk-box", "vk-circle", "vlc", "voice", "voicemail", "volume-high", "volume-low", "volume-medium", "volume-minus", "volume-mute", "volume-off", "volume-plus", "vpn", "walk", "wallet", "wallet-giftcard", "wallet-membership", "wallet-travel", "wan", "washing-machine", "watch", "watch-export", "watch-import", "watch-vibrate", "water", "water-off", "water-percent", "water-pump", "watermark", "waves", "weather-cloudy", "weather-fog", "weather-hail", "weather-lightning", "weather-lightning-rainy", "weather-night", "weather-partlycloudy", "weather-pouring", "weather-rainy", "weather-snowy", "weather-snowy-rainy", "weather-sunny", "weather-sunset", "weather-sunset-down", "weather-sunset-up", "weather-windy", "weather-windy-variant", "web", "webcam", "webhook", "webpack", "wechat", "weight", "weight-kilogram", "whatsapp", "wheelchair-accessibility", "white-balance-auto", "white-balance-incandescent", "white-balance-iridescent", "white-balance-sunny", "widgets", "wifi", "wifi-off", "wii", "wiiu", "wikipedia", "window-close", "window-closed", "window-maximize", "window-minimize", "window-open", "window-restore", "windows", "wordpress", "worker", "wrap", "wrench", "wunderlist", "xaml", "xbox", "xbox-controller", "xbox-controller-battery-alert", "xbox-controller-battery-empty", "xbox-controller-battery-full", "xbox-controller-battery-low", "xbox-controller-battery-medium", "xbox-controller-battery-unknown", "xbox-controller-off", "xda", "xing", "xing-box", "xing-circle", "xml", "yammer", "yeast", "yelp", "yin-yang", "youtube-play", "zip-box");
    }

}

if (!function_exists('eead_icofont_icon_array')) {

    function eead_icofont_icon_array() {
        return array("angry-monster", "bathtub", "bird-wings", "bow", "castle", "circuit", "crown-king", "crown-queen", "dart", "disability-race", "diving-goggle", "eye-open", "flora-flower", "flora", "gift-box", "halloween-pumpkin", "hand-power", "hand-thunder", "king-monster", "love", "magician-hat", "native-american", "owl-look", "phoenix", "robot-face", "sand-clock", "shield-alt", "ship-wheel", "skull-danger", "skull-face", "snowmobile", "space-shuttle", "star-shape", "swirl", "tattoo-wing", "throne", "tree-alt", "triangle", "unity-hand", "weed", "woman-bird", "bat", "bear-face", "bear-tracks", "bear", "bird-alt", "bird-flying", "bird", "birds", "bone", "bull", "butterfly-alt", "butterfly", "camel-alt", "camel-head", "camel", "cat-alt-1", "cat-alt-2", "cat-alt-3", "cat-dog", "cat-face", "cat", "cow-head", "cow", "crab", "crocodile", "deer-head", "dog-alt", "dog-barking", "dog", "dolphin", "duck-tracks", "eagle-head", "eaten-fish", "elephant-alt", "elephant-head-alt", "elephant-head", "elephant", "elk", "fish-1", "fish-2", "fish-3", "fish-4", "fish-5", "fish", "fox-alt", "fox", "frog-tracks", "frog", "froggy", "giraffe-head-1", "giraffe-head-2", "giraffe-head", "giraffe", "goat-head", "gorilla", "hen-tracks", "horse-head-1", "horse-head-2", "horse-head", "horse-tracks", "jellyfish", "kangaroo", "lemur", "lion-head-1", "lion-head-2", "lion-head", "lion", "monkey-2", "monkey-3", "monkey-face", "monkey", "octopus-alt", "octopus", "owl", "panda-face", "panda", "panther", "parrot-lip", "parrot", "paw", "pelican", "penguin", "pig-face", "pig", "pigeon-1", "pigeon-2", "pigeon", "rabbit", "rat", "rhino-head", "rhino", "rooster", "seahorse", "seal", "shrimp-alt", "shrimp", "snail-1", "snail-2", "snail-3", "snail", "snake", "squid", "squirrel", "tiger-face", "tiger", "turtle", "whale", "woodpecker", "zebra", "brand-acer", "brand-adidas", "brand-adobe", "brand-air-new-zealand", "brand-airbnb", "brand-aircell", "brand-airtel", "brand-alcatel", "brand-alibaba", "brand-aliexpress", "brand-alipay", "brand-amazon", "brand-amd", "brand-american-airlines", "brand-android-robot", "brand-android", "brand-aol", "brand-apple", "brand-appstore", "brand-asus", "brand-ati", "brand-att", "brand-audi", "brand-axiata", "brand-bada", "brand-bbc", "brand-bing", "brand-blackberry", "brand-bmw", "brand-box", "brand-burger-king", "brand-business-insider", "brand-buzzfeed", "brand-cannon", "brand-casio", "brand-china-mobile", "brand-china-telecom", "brand-china-unicom", "brand-cisco", "brand-citibank", "brand-cnet", "brand-cnn", "brand-cocal-cola", "brand-compaq", "brand-debian", "brand-delicious", "brand-dell", "brand-designbump", "brand-designfloat", "brand-disney", "brand-dodge", "brand-dove", "brand-drupal", "brand-ebay", "brand-eleven", "brand-emirates", "brand-espn", "brand-etihad-airways", "brand-etisalat", "brand-etsy", "brand-fastrack", "brand-fedex", "brand-ferrari", "brand-fitbit", "brand-flikr", "brand-forbes", "brand-foursquare", "brand-foxconn", "brand-fujitsu", "brand-general-electric", "brand-gillette", "brand-gizmodo", "brand-gnome", "brand-google", "brand-gopro", "brand-gucci", "brand-hallmark", "brand-hi5", "brand-honda", "brand-hp", "brand-hsbc", "brand-htc", "brand-huawei", "brand-hulu", "brand-hyundai", "brand-ibm", "brand-icofont", "brand-icq", "brand-ikea", "brand-imdb", "brand-indiegogo", "brand-intel", "brand-ipair", "brand-jaguar", "brand-java", "brand-joomla", "brand-kickstarter", "brand-kik", "brand-lastfm", "brand-lego", "brand-lenovo", "brand-levis", "brand-lexus", "brand-lg", "brand-life-hacker", "brand-linux-mint", "brand-linux", "brand-lionix", "brand-loreal", "brand-louis-vuitton", "brand-mac-os", "brand-marvel-app", "brand-mashable", "brand-mazda", "brand-mcdonals", "brand-mercedes", "brand-micromax", "brand-microsoft", "brand-mobileme", "brand-mobily", "brand-motorola", "brand-msi", "brand-mts", "brand-myspace", "brand-mytv", "brand-nasa", "brand-natgeo", "brand-nbc", "brand-nescafe", "brand-nestle", "brand-netflix", "brand-nexus", "brand-nike", "brand-nokia", "brand-nvidia", "brand-omega", "brand-opensuse", "brand-oracle", "brand-panasonic", "brand-paypal", "brand-pepsi", "brand-philips", "brand-pizza-hut", "brand-playstation", "brand-puma", "brand-qatar-air", "brand-qvc", "brand-readernaut", "brand-redbull", "brand-reebok", "brand-reuters", "brand-samsung", "brand-sap", "brand-saudia-airlines", "brand-scribd", "brand-shell", "brand-siemens", "brand-sk-telecom", "brand-slideshare", "brand-smashing-magazine", "brand-snapchat", "brand-sony-ericsson", "brand-sony", "brand-soundcloud", "brand-sprint", "brand-squidoo", "brand-starbucks", "brand-stc", "brand-steam", "brand-suzuki", "brand-symbian", "brand-t-mobile", "brand-tango", "brand-target", "brand-tata-indicom", "brand-techcrunch", "brand-telenor", "brand-teliasonera", "brand-tesla", "brand-the-verge", "brand-thenextweb", "brand-toshiba", "brand-toyota", "brand-tribenet", "brand-ubuntu", "brand-unilever", "brand-vaio", "brand-verizon", "brand-viber", "brand-vodafone", "brand-volkswagen", "brand-walmart", "brand-warnerbros", "brand-whatsapp", "brand-wikipedia", "brand-windows", "brand-wire", "brand-wordpress", "brand-xiaomi", "brand-yahoobuzz", "brand-yamaha", "brand-youtube", "brand-zain", "bank-alt", "bank", "barcode", "bill-alt", "billboard", "briefcase-1", "briefcase-2", "businessman", "businesswoman", "chair", "coins", "company", "contact-add", "files-stack", "handshake-deal", "id-card", "meeting-add", "money-bag", "pie-chart", "presentation-alt", "presentation", "stamp", "stock-mobile", "chart-arrows-axis", "chart-bar-graph", "chart-flow-1", "chart-flow-2", "chart-flow", "chart-growth", "chart-histogram-alt", "chart-histogram", "chart-line-alt", "chart-line", "chart-pie-alt", "chart-pie", "chart-radar-graph", "architecture-alt", "architecture", "barricade", "bolt", "bricks", "building-alt", "bull-dozer", "calculations", "cement-mix", "cement-mixer", "concrete-mixer", "danger-zone", "drill", "eco-energy", "eco-environmen", "energy-air", "energy-oil", "energy-savings", "energy-solar", "energy-water", "engineer", "fire-extinguisher-alt", "fire-extinguisher", "fix-tools", "fork-lift", "glue-oil", "hammer-alt", "hammer", "help-robot", "industries-1", "industries-2", "industries-3", "industries-4", "industries-5", "industries", "labour", "mining", "paint-brush", "pollution", "power-zone", "radio-active", "recycle-alt", "recycling-man", "safety-hat-light", "safety-hat", "saw", "screw-driver", "tools-1", "tools-bag", "tow-truck", "trolley", "trowel", "under-construction-alt", "under-construction", "vehicle-cement", "vehicle-crane", "vehicle-delivery-van", "vehicle-dozer", "vehicle-excavator", "vehicle-trucktor", "vehicle-wrecking", "worker", "workers-group", "wrench", "afghani-false", "afghani-minus", "afghani-plus", "afghani-true", "afghani", "baht-false", "baht-minus", "baht-plus", "baht-true", "baht", "bitcoin-false", "bitcoin-minus", "bitcoin-plus", "bitcoin-true", "bitcoin", "dollar-flase", "dollar-minus", "dollar-plus", "dollar-true", "dollar", "dong-false", "dong-minus", "dong-plus", "dong-true", "dong", "euro-false", "euro-minus", "euro-plus", "euro-true", "euro", "frank-false", "frank-minus", "frank-plus", "frank-true", "frank", "hryvnia-false", "hryvnia-minus", "hryvnia-plus", "hryvnia-true", "hryvnia", "lira-false", "lira-minus", "lira-plus", "lira-true", "lira", "peseta-false", "peseta-minus", "peseta-plus", "peseta-true", "peseta", "peso-false", "peso-minus", "peso-plus", "peso-true", "peso", "pound-false", "pound-minus", "pound-plus", "pound-true", "pound", "renminbi-false", "renminbi-minus", "renminbi-plus", "renminbi-true", "renminbi", "riyal-false", "riyal-minus", "riyal-plus", "riyal-true", "riyal", "rouble-false", "rouble-minus", "rouble-plus", "rouble-true", "rouble", "rupee-false", "rupee-minus", "rupee-plus", "rupee-true", "rupee", "taka-false", "taka-minus", "taka-plus", "taka-true", "taka", "turkish-lira-false", "turkish-lira-minus", "turkish-lira-plus", "turkish-lira-true", "turkish-lira", "won-false", "won-minus", "won-plus", "won-true", "won", "yen-false", "yen-minus", "yen-plus", "yen-true", "yen", "android-nexus", "android-tablet", "apple-watch", "drawing-tablet", "earphone", "flash-drive", "game-console", "game-controller", "game-pad", "game", "headphone-alt-1", "headphone-alt-2", "headphone-alt-3", "headphone-alt", "headphone", "htc-one", "imac", "ipad", "iphone", "ipod-nano", "ipod-touch", "keyboard-alt", "keyboard-wireless", "keyboard", "laptop-alt", "laptop", "macbook", "magic-mouse", "micro-chip", "microphone-alt", "microphone", "monitor", "mouse", "mp3-player", "nintendo", "playstation-alt", "psvita", "radio-mic", "radio", "refrigerator", "samsung-galaxy", "surface-tablet", "ui-head-phone", "ui-keyboard", "washing-machine", "wifi-router", "wii-u", "windows-lumia", "wireless-mouse", "xbox-360", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "block-down", "block-left", "block-right", "block-up", "bubble-down", "bubble-left", "bubble-right", "bubble-up", "caret-down", "caret-left", "caret-right", "caret-up", "circled-down", "circled-left", "circled-right", "circled-up", "collapse", "cursor-drag", "curved-double-left", "curved-double-right", "curved-down", "curved-left", "curved-right", "curved-up", "dotted-down", "dotted-left", "dotted-right", "dotted-up", "double-left", "double-right", "expand-alt", "hand-down", "hand-drag", "hand-drag1", "hand-drag2", "hand-drawn-alt-down", "hand-drawn-alt-left", "hand-drawn-alt-right", "hand-drawn-alt-up", "hand-drawn-down", "hand-drawn-left", "hand-drawn-right", "hand-drawn-up", "hand-grippers", "hand-left", "hand-right", "hand-up", "line-block-down", "line-block-left", "line-block-right", "line-block-up", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "rounded-collapse", "rounded-double-left", "rounded-double-right", "rounded-down", "rounded-expand", "rounded-left-down", "rounded-left-up", "rounded-left", "rounded-right-down", "rounded-right-up", "rounded-right", "rounded-up", "scroll-bubble-down", "scroll-bubble-left", "scroll-bubble-right", "scroll-bubble-up", "scroll-double-down", "scroll-double-left", "scroll-double-right", "scroll-double-up", "scroll-down", "scroll-left", "scroll-long-down", "scroll-long-left", "scroll-long-right", "scroll-long-up", "scroll-right", "scroll-up", "simple-down", "simple-left-down", "simple-left-up", "simple-left", "simple-right-down", "simple-right-up", "simple-right", "simple-up", "square-down", "square-left", "square-right", "square-up", "stylish-down", "stylish-left", "stylish-right", "stylish-up", "swoosh-down", "swoosh-left", "swoosh-right", "swoosh-up", "thin-double-left", "thin-double-right", "thin-down", "thin-left", "thin-right", "thin-up", "abc", "atom", "award", "bell-alt", "black-board", "book-alt", "book", "brainstorming", "certificate-alt-1", "certificate-alt-2", "certificate", "education", "electron", "fountain-pen", "globe-alt", "graduate-alt", "graduate", "group-students", "hat-alt", "hat", "instrument", "lamp-light", "medal", "microscope-alt", "microscope", "paper", "pen-alt-4", "pen-nib", "pencil-alt-5", "quill-pen", "read-book-alt", "read-book", "school-bag", "school-bus", "student-alt", "student", "teacher", "test-bulb", "test-tube-alt", "university", "angry", "astonished", "confounded", "confused", "crying", "dizzy", "expressionless", "heart-eyes", "laughing", "nerd-smile", "open-mouth", "rage", "rolling-eyes", "sad", "simple-smile", "slightly-smile", "smirk", "stuck-out-tongue", "wink-smile", "worried", "file-alt", "file-audio", "file-avi-mp4", "file-bmp", "file-code", "file-css", "file-document", "file-eps", "file-excel", "file-exe", "file-file", "file-flv", "file-gif", "file-html5", "file-image", "file-iso", "file-java", "file-javascript", "file-jpg", "file-midi", "file-mov", "file-mp3", "file-pdf", "file-php", "file-png", "file-powerpoint", "file-presentation", "file-psb", "file-psd", "file-python", "file-ruby", "file-spreadsheet", "file-sql", "file-svg", "file-text", "file-tiff", "file-video", "file-wave", "file-wmv", "file-word", "file-zip", "cycling-alt", "cycling", "dumbbell", "dumbbells", "gym-alt-1", "gym-alt-2", "gym-alt-3", "gym", "muscle-weight", "muscle", "apple", "arabian-coffee", "artichoke", "asparagus", "avocado", "baby-food", "banana", "bbq", "beans", "beer", "bell-pepper-capsicum", "birthday-cake", "bread", "broccoli", "burger", "cabbage", "carrot", "cauli-flower", "cheese", "chef", "cherry", "chicken-fry", "chicken", "cocktail", "coconut-water", "coconut", "coffee-alt", "coffee-cup", "coffee-mug", "coffee-pot", "cola", "corn", "croissant", "crop-plant", "cucumber", "culinary", "cup-cake", "dining-table", "donut", "egg-plant", "egg-poached", "farmer-alt", "farmer", "fast-food", "food-basket", "food-cart", "fork-and-knife", "french-fries", "fruits", "grapes", "honey", "hot-dog", "ice-cream-alt", "ice-cream", "juice", "ketchup", "kiwi", "layered-cake", "lemon-alt", "lemon", "lobster", "mango", "milk", "mushroom", "noodles", "onion", "orange", "pear", "peas", "pepper", "pie-alt", "pie", "pineapple", "pizza-slice", "pizza", "plant", "popcorn", "potato", "pumpkin", "raddish", "restaurant-menu", "restaurant", "salt-and-pepper", "sandwich", "sausage", "soft-drinks", "soup-bowl", "spoon-and-fork", "steak", "strawberry", "sub-sandwich", "sushi", "taco", "tea-pot", "tea", "tomato", "watermelon", "wheat", "baby-backpack", "baby-cloth", "baby-milk-bottle", "baby-trolley", "baby", "candy", "holding-hands", "infant-nipple", "kids-scooter", "safety-pin", "teddy-bear", "toy-ball", "toy-cat", "toy-duck", "toy-elephant", "toy-hand", "toy-horse", "toy-lattu", "toy-train", "burglar", "cannon-firing", "cc-camera", "cop-badge", "cop", "court-hammer", "court", "finger-print", "gavel", "handcuff-alt", "handcuff", "investigation", "investigator", "jail", "judge", "law-alt-1", "law-alt-2", "law-alt-3", "law-book", "law-document", "law-order", "law-protect", "law-scales", "law", "lawyer-alt-1", "lawyer-alt-2", "lawyer", "legal", "pistol", "police-badge", "police-cap", "police-car-alt-1", "police-car-alt-2", "police-car", "police-hat", "police-van", "police", "thief-alt", "thief", "abacus-alt", "abacus", "angle-180", "angle-45", "angle-90", "angle", "calculator-alt-1", "calculator-alt-2", "calculator", "circle-ruler-alt", "circle-ruler", "compass-alt-1", "compass-alt-2", "compass-alt-3", "compass-alt-4", "golden-ratio", "marker-alt-1", "marker-alt-2", "marker-alt-3", "marker", "math", "mathematical-alt-1", "mathematical-alt-2", "mathematical", "pen-alt-1", "pen-alt-2", "pen-alt-3", "pen-holder-alt-1", "pen-holder", "pen", "pencil-alt-1", "pencil-alt-2", "pencil-alt-3", "pencil-alt-4", "pencil", "ruler-alt-1", "ruler-alt-2", "ruler-compass-alt", "ruler-compass", "ruler-pencil-alt-1", "ruler-pencil-alt-2", "ruler-pencil", "ruler", "rulers-alt", "rulers", "square-root", "ui-calculator", "aids", "ambulance-crescent", "ambulance-cross", "ambulance", "autism", "bandage", "blind", "blood-drop", "blood-test", "blood", "brain-alt", "brain", "capsule", "crutch", "disabled", "dna-alt-1", "dna-alt-2", "dna", "doctor-alt", "doctor", "drug-pack", "drug", "first-aid-alt", "first-aid", "heart-beat-alt", "heart-beat", "heartbeat", "herbal", "hospital", "icu", "injection-syringe", "laboratory", "medical-sign-alt", "medical-sign", "nurse-alt", "nurse", "nursing-home", "operation-theater", "paralysis-disability", "patient-bed", "patient-file", "pills", "prescription", "pulse", "stethoscope-alt", "stethoscope", "stretcher", "surgeon-alt", "surgeon", "tablets", "test-bottle", "test-tube", "thermometer-alt", "thermometer", "tooth", "xray", "ui-add", "ui-alarm", "ui-battery", "ui-block", "ui-bluetooth", "ui-brightness", "ui-browser", "ui-calendar", "ui-call", "ui-camera", "ui-cart", "ui-cell-phone", "ui-chat", "ui-check", "ui-clip-board", "ui-clip", "ui-clock", "ui-close", "ui-contact-list", "ui-copy", "ui-cut", "ui-delete", "ui-dial-phone", "ui-edit", "ui-email", "ui-file", "ui-fire-wall", "ui-flash-light", "ui-flight", "ui-folder", "ui-game", "ui-handicapped", "ui-home", "ui-image", "ui-laoding", "ui-lock", "ui-love-add", "ui-love-broken", "ui-love-remove", "ui-love", "ui-map", "ui-message", "ui-messaging", "ui-movie", "ui-music-player", "ui-music", "ui-mute", "ui-network", "ui-next", "ui-note", "ui-office", "ui-password", "ui-pause", "ui-play-stop", "ui-play", "ui-pointer", "ui-power", "ui-press", "ui-previous", "ui-rate-add", "ui-rate-blank", "ui-rate-remove", "ui-rating", "ui-record", "ui-remove", "ui-reply", "ui-rotation", "ui-rss", "ui-search", "ui-settings", "ui-social-link", "ui-tag", "ui-text-chat", "ui-text-loading", "ui-theme", "ui-timer", "ui-touch-phone", "ui-travel", "ui-unlock", "ui-user-group", "ui-user", "ui-v-card", "ui-video-chat", "ui-video-message", "ui-video-play", "ui-video", "ui-volume", "ui-weather", "ui-wifi", "ui-zoom-in", "ui-zoom-out", "cassette-player", "cassette", "forward", "guiter", "movie", "multimedia", "music-alt", "music-disk", "music-note", "music-notes", "music", "mute-volume", "pause", "play-alt-1", "play-alt-2", "play-alt-3", "play-pause", "play", "record", "retro-music-disk", "rewind", "song-notes", "sound-wave-alt", "sound-wave", "stop", "video-alt", "video-cam", "video-clapper", "video", "volume-bar", "volume-down", "volume-mute", "volume-off", "volume-up", "youtube-play", "2checkout-alt", "2checkout", "amazon-alt", "amazon", "american-express-alt", "american-express", "apple-pay-alt", "apple-pay", "bank-transfer-alt", "bank-transfer", "braintree-alt", "braintree", "cash-on-delivery-alt", "cash-on-delivery", "diners-club-alt-1", "diners-club-alt-2", "diners-club-alt-3", "diners-club", "discover-alt", "discover", "eway-alt", "eway", "google-wallet-alt-1", "google-wallet-alt-2", "google-wallet-alt-3", "google-wallet", "jcb-alt", "jcb", "maestro-alt", "maestro", "mastercard-alt", "mastercard", "payoneer-alt", "payoneer", "paypal-alt", "paypal", "sage-alt", "sage", "skrill-alt", "skrill", "stripe-alt", "stripe", "visa-alt", "visa-electron", "visa", "western-union-alt", "western-union", "boy", "business-man-alt-1", "business-man-alt-2", "business-man-alt-3", "business-man", "female", "funky-man", "girl-alt", "girl", "group", "hotel-boy-alt", "hotel-boy", "kid", "man-in-glasses", "people", "support", "user-alt-1", "user-alt-2", "user-alt-3", "user-alt-4", "user-alt-5", "user-alt-6", "user-alt-7", "user-female", "user-male", "user-suited", "user", "users-alt-1", "users-alt-2", "users-alt-3", "users-alt-4", "users-alt-5", "users-alt-6", "users-social", "users", "waiter-alt", "waiter", "woman-in-glasses", "search-1", "search-2", "search-document", "search-folder", "search-job", "search-map", "search-property", "search-restaurant", "search-stock", "search-user", "search", "500px", "aim", "badoo", "baidu-tieba", "bbm-messenger", "bebo", "behance", "blogger", "bootstrap", "brightkite", "cloudapp", "concrete5", "delicious", "designbump", "designfloat", "deviantart", "digg", "dotcms", "dribbble", "dribble", "dropbox", "ebuddy", "ello", "ember", "envato", "evernote", "facebook-messenger", "facebook", "feedburner", "flikr", "folkd", "foursquare", "friendfeed", "ghost", "github", "gnome", "google-buzz", "google-hangouts", "google-map", "google-plus", "google-talk", "hype-machine", "instagram", "kakaotalk", "kickstarter", "kik", "kiwibox", "line-messenger", "line", "linkedin", "linux-mint", "live-messenger", "livejournal", "magento", "meetme", "meetup", "mixx", "newsvine", "nimbuss", "odnoklassniki", "opencart", "oscommerce", "pandora", "photobucket", "picasa", "pinterest", "prestashop", "qik", "qq", "readernaut", "reddit", "renren", "rss", "shopify", "silverstripe", "skype", "slack", "slashdot", "slidshare", "smugmug", "snapchat", "soundcloud", "spotify", "stack-exchange", "stack-overflow", "steam", "stumbleupon", "tagged", "technorati", "telegram", "tinder", "trello", "tumblr", "twitch", "twitter", "typo3", "ubercart", "viber", "viddler", "vimeo", "vine", "virb", "virtuemart", "vk", "wechat", "weibo", "whatsapp", "xing", "yahoo", "yelp", "youku", "youtube", "zencart", "badminton-birdie", "baseball", "baseballer", "basketball-hoop", "basketball", "billiard-ball", "boot-alt-1", "boot-alt-2", "boot", "bowling-alt", "bowling", "canoe", "cheer-leader", "climbing", "corner", "field-alt", "field", "football-alt", "football-american", "football", "foul", "goal-keeper", "goal", "golf-alt", "golf-bag", "golf-cart", "golf-field", "golf", "golfer", "helmet", "hockey-alt", "hockey", "ice-skate", "jersey-alt", "jersey", "jumping", "kick", "leg", "match-review", "medal-sport", "offside", "olympic-logo", "olympic", "padding", "penalty-card", "racer", "racing-car", "racing-flag-alt", "racing-flag", "racings-wheel", "referee", "refree-jersey", "result-sport", "rugby-ball", "rugby-player", "rugby", "runner-alt-1", "runner-alt-2", "runner", "score-board", "skiing-man", "skydiving-goggles", "snow-mobile", "steering", "stopwatch", "substitute", "swimmer", "table-tennis", "team-alt", "team", "tennis-player", "tennis", "tracking", "trophy-alt", "trophy", "volleyball-alt", "volleyball-fire", "volleyball", "water-bottle", "whistle-alt", "whistle", "win-trophy", "align-center", "align-left", "align-right", "all-caps", "bold", "brush", "clip-board", "code-alt", "color-bucket", "color-picker", "copy-invert", "copy", "cut", "delete-alt", "edit-alt", "eraser-alt", "font", "heading", "indent", "italic-alt", "italic", "justify-all", "justify-center", "justify-left", "justify-right", "link-broken", "outdent", "paper-clip", "paragraph", "pin", "printer", "redo", "rotation", "save", "small-cap", "strike-through", "sub-listing", "subscript", "superscript", "table", "text-height", "text-width", "trash", "underline", "undo", "air-balloon", "airplane-alt", "airplane", "articulated-truck", "auto-mobile", "auto-rickshaw", "bicycle-alt-1", "bicycle-alt-2", "bicycle", "bus-alt-1", "bus-alt-2", "bus-alt-3", "bus", "cab", "cable-car", "car-alt-1", "car-alt-2", "car-alt-3", "car-alt-4", "car", "delivery-time", "fast-delivery", "fire-truck-alt", "fire-truck", "free-delivery", "helicopter", "motor-bike-alt", "motor-bike", "motor-biker", "oil-truck", "rickshaw", "rocket-alt-1", "rocket-alt-2", "rocket", "sail-boat-alt-1", "sail-boat-alt-2", "sail-boat", "scooter", "sea-plane", "ship-alt", "ship", "speed-boat", "taxi", "tractor", "train-line", "train-steam", "tram", "truck-alt", "truck-loaded", "truck", "van-alt", "van", "yacht", "5-star-hotel", "air-ticket", "beach-bed", "beach", "camping-vest", "direction-sign", "hill-side", "hill", "hotel", "island-alt", "island", "sandals-female", "sandals-male", "travelling", "breakdown", "celsius", "clouds", "cloudy", "dust", "eclipse", "fahrenheit", "forest-fire", "full-night", "full-sunny", "hail-night", "hail-rainy-night", "hail-rainy-sunny", "hail-rainy", "hail-sunny", "hail-thunder-night", "hail-thunder-sunny", "hail-thunder", "hail", "hill-night", "hill-sunny", "hurricane", "meteor", "night", "rainy-night", "rainy-sunny", "rainy-thunder", "rainy", "snow-alt", "snow-flake", "snow-temp", "snow", "snowy-hail", "snowy-night-hail", "snowy-night-rainy", "snowy-night", "snowy-rainy", "snowy-sunny-hail", "snowy-sunny-rainy", "snowy-sunny", "snowy-thunder-night", "snowy-thunder-sunny", "snowy-thunder", "snowy-windy-night", "snowy-windy-sunny", "snowy-windy", "snowy", "sun-alt", "sun-rise", "sun-set", "sun", "sunny-day-temp", "sunny", "thunder-light", "tornado", "umbrella-alt", "umbrella", "volcano", "wave", "wind-scale-0", "wind-scale-1", "wind-scale-10", "wind-scale-11", "wind-scale-12", "wind-scale-2", "wind-scale-3", "wind-scale-4", "wind-scale-5", "wind-scale-6", "wind-scale-7", "wind-scale-8", "wind-scale-9", "wind-waves", "wind", "windy-hail", "windy-night", "windy-raining", "windy-sunny", "windy-thunder-raining", "windy-thunder", "windy", "addons", "address-book", "adjust", "alarm", "anchor", "archive", "at", "attachment", "audio", "automation", "badge", "bag-alt", "bag", "ban", "bar-code", "bars", "basket", "battery-empty", "battery-full", "battery-half", "battery-low", "beaker", "beard", "bed", "bell", "beverage", "bill", "bin", "binary", "binoculars", "bluetooth", "bomb", "book-mark", "box", "briefcase", "broken", "bucket", "bucket1", "bucket2", "bug", "building", "bulb-alt", "bullet", "bullhorn", "bullseye", "calendar", "camera-alt", "camera", "card", "cart-alt", "cart", "cc", "charging", "chat", "check-alt", "check-circled", "check", "checked", "children-care", "clip", "clock-time", "close-circled", "close-line-circled", "close-line-squared-alt", "close-line-squared", "close-line", "close-squared-alt", "close-squared", "close", "cloud-download", "cloud-refresh", "cloud-upload", "cloud", "code-not-allowed", "code", "comment", "compass-alt", "compass", "computer", "connection", "console", "contacts", "contrast", "copyright", "credit-card", "crop", "crown", "cube", "cubes", "dashboard-web", "dashboard", "data", "database-add", "database-locked", "database-remove", "database", "delete", "diamond", "dice-multiple", "dice", "disc", "diskette", "document-folder", "download-alt", "download", "downloaded", "drag", "drag1", "drag2", "drag3", "earth", "ebook", "edit", "eject", "email", "envelope-open", "envelope", "eraser", "error", "excavator", "exchange", "exclamation-circle", "exclamation-square", "exclamation-tringle", "exclamation", "exit", "expand", "external-link", "external", "eye-alt", "eye-blocked", "eye-dropper", "eye", "favourite", "fax", "file-fill", "film", "filter", "fire-alt", "fire-burn", "fire", "flag-alt-1", "flag-alt-2", "flag", "flame-torch", "flash-light", "flash", "flask", "focus", "folder-open", "folder", "foot-print", "garbage", "gear-alt", "gear", "gears", "gift", "glass", "globe", "graffiti", "grocery", "hand", "hanger", "hard-disk", "heart-alt", "heart", "history", "home", "horn", "hour-glass", "id", "image", "inbox", "infinite", "info-circle", "info-square", "info", "institution", "interface", "invisible", "jacket", "jar", "jewlery", "karate", "key-hole", "key", "label", "lamp", "layers", "layout", "leaf", "leaflet", "learn", "lego", "lens", "letter", "letterbox", "library", "license", "life-bouy", "life-buoy", "life-jacket", "life-ring", "light-bulb", "lighter", "lightning-ray", "like", "line-height", "link-alt", "link", "list", "listening", "listine-dots", "listing-box", "listing-number", "live-support", "location-arrow", "location-pin", "lock", "login", "logout", "lollipop", "long-drive", "look", "loop", "luggage", "lunch", "lungs", "magic-alt", "magic", "magnet", "mail-box", "mail", "male", "map-pins", "map", "maximize", "measure", "medicine", "mega-phone", "megaphone-alt", "megaphone", "memorial", "memory-card", "mic-mute", "mic", "military", "mill", "minus-circle", "minus-square", "minus", "mobile-phone", "molecule", "money", "moon", "mop", "muffin", "mustache", "navigation-menu", "navigation", "network-tower", "network", "news", "newspaper", "no-smoking", "not-allowed", "notebook", "notepad", "notification", "numbered", "opposite", "optic", "options", "package", "page", "paint", "paper-plane", "paperclip", "papers", "pay", "penguin-linux", "pestle", "phone-circle", "phone", "picture", "pine", "pixels", "plugin", "plus-circle", "plus-square", "plus", "polygonal", "power", "price", "print", "puzzle", "qr-code", "queen", "question-circle", "question-square", "question", "quote-left", "quote-right", "random", "recycle", "refresh", "repair", "reply-all", "reply", "resize", "responsive", "retweet", "road", "robot", "royal", "rss-feed", "safety", "sale-discount", "satellite", "send-mail", "server", "settings-alt", "settings", "share-alt", "share-boxed", "share", "shield", "shopping-cart", "sign-in", "sign-out", "signal", "site-map", "smart-phone", "soccer", "sort-alt", "sort", "space", "spanner", "speech-comments", "speed-meter", "spinner-alt-1", "spinner-alt-2", "spinner-alt-3", "spinner-alt-4", "spinner-alt-5", "spinner-alt-6", "spinner", "spreadsheet", "square", "ssl-security", "star-alt-1", "star-alt-2", "star", "street-view", "support-faq", "tack-pin", "tag", "tags", "tasks-alt", "tasks", "telephone", "telescope", "terminal", "thumbs-down", "thumbs-up", "tick-boxed", "tick-mark", "ticket", "tie", "toggle-off", "toggle-on", "tools-alt-2", "tools", "touch", "traffic-light", "transparent", "tree", "unique-idea", "unlock", "unlocked", "upload-alt", "upload", "usb-drive", "usb", "vector-path", "verification-check", "wall-clock", "wall", "wallet", "warning-alt", "warning", "water-drop", "web", "wheelchair", "wifi-alt", "wifi", "world", "zigzag", "zipped");
    }

}

if (!function_exists('eead_eleganticons_array')) {

    function eead_eleganticons_array() {
        return array("arrow_up", "arrow_down", "arrow_left", "arrow_right", "arrow_left-up", "arrow_right-up", "arrow_right-down", "arrow_left-down", "arrow-up-down", "arrow_up-down_alt", "arrow_left-right_alt", "arrow_left-right", "arrow_expand_alt2", "arrow_expand_alt", "arrow_condense", "arrow_expand", "arrow_move", "arrow_carrot-up", "arrow_carrot-down", "arrow_carrot-left", "arrow_carrot-right", "arrow_carrot-2up", "arrow_carrot-2down", "arrow_carrot-2left", "arrow_carrot-2right", "arrow_carrot-up_alt2", "arrow_carrot-down_alt2", "arrow_carrot-left_alt2", "arrow_carrot-right_alt2", "arrow_carrot-2up_alt2", "arrow_carrot-2down_alt2", "arrow_carrot-2left_alt2", "arrow_carrot-2right_alt2", "arrow_triangle-up", "arrow_triangle-down", "arrow_triangle-left", "arrow_triangle-right", "arrow_triangle-up_alt2", "arrow_triangle-down_alt2", "arrow_triangle-left_alt2", "arrow_triangle-right_alt2", "arrow_back", "icon_minus-06", "icon_plus", "icon_close", "icon_check", "icon_minus_alt2", "icon_plus_alt2", "icon_close_alt2", "icon_check_alt2", "icon_zoom-out_alt", "icon_zoom-in_alt", "icon_search", "icon_box-empty", "icon_box-selected", "icon_minus-box", "icon_plus-box", "icon_box-checked", "icon_circle-empty", "icon_circle-slelected", "icon_stop_alt2", "icon_stop", "icon_pause_alt2", "icon_pause", "icon_menu", "icon_menu-square_alt2", "icon_menu-circle_alt2", "icon_ul", "icon_ol", "icon_adjust-horiz", "icon_adjust-vert", "icon_document_alt", "icon_documents_alt", "icon_pencil", "icon_pencil-edit_alt", "icon_pencil-edit", "icon_folder-alt", "icon_folder-open_alt", "icon_folder-add_alt", "icon_info_alt", "icon_error-oct_alt", "icon_error-circle_alt", "icon_error-triangle_alt", "icon_question_alt2", "icon_question", "icon_comment_alt", "icon_chat_alt", "icon_vol-mute_alt", "icon_volume-low_alt", "icon_volume-high_alt", "icon_quotations", "icon_quotations_alt2", "icon_clock_alt", "icon_lock_alt", "icon_lock-open_alt", "icon_key_alt", "icon_cloud_alt", "icon_cloud-upload_alt", "icon_cloud-download_alt", "icon_image", "icon_images", "icon_lightbulb_alt", "icon_gift_alt", "icon_house_alt", "icon_genius", "icon_mobile", "icon_tablet", "icon_laptop", "icon_desktop", "icon_camera_alt", "icon_mail_alt", "icon_cone_alt", "icon_ribbon_alt", "icon_bag_alt", "icon_creditcard", "icon_cart_alt", "icon_paperclip", "icon_tag_alt", "icon_tags_alt", "icon_trash_alt", "icon_cursor_alt", "icon_mic_alt", "icon_compass_alt", "icon_pin_alt", "icon_pushpin_alt", "icon_map_alt", "icon_drawer_alt", "icon_toolbox_alt", "icon_book_alt", "icon_calendar", "icon_film", "icon_table", "icon_contacts_alt", "icon_headphones", "icon_lifesaver", "icon_piechart", "icon_refresh", "icon_link_alt", "icon_link", "icon_loading", "icon_blocked", "icon_archive_alt", "icon_heart_alt", "icon_star_alt", "icon_star-half_alt", "icon_star", "icon_star-half", "icon_tools", "icon_tool", "icon_cog", "icon_cogs", "arrow_up_alt", "arrow_down_alt", "arrow_left_alt", "arrow_right_alt", "arrow_left-up_alt", "arrow_right-up_alt", "arrow_right-down_alt", "arrow_left-down_alt", "arrow_condense_alt", "arrow_expand_alt3", "arrow_carrot_up_alt", "arrow_carrot-down_alt", "arrow_carrot-left_alt", "arrow_carrot-right_alt", "arrow_carrot-2up_alt", "arrow_carrot-2dwnn_alt", "arrow_carrot-2left_alt", "arrow_carrot-2right_alt", "arrow_triangle-up_alt", "arrow_triangle-down_alt", "arrow_triangle-left_alt", "arrow_triangle-right_alt", "icon_minus_alt", "icon_plus_alt", "icon_close_alt", "icon_check_alt", "icon_zoom-out", "icon_zoom-in", "icon_stop_alt", "icon_menu-square_alt", "icon_menu-circle_alt", "icon_document", "icon_documents", "icon_pencil_alt", "icon_folder", "icon_folder-open", "icon_folder-add", "icon_folder_upload", "icon_folder_download", "icon_info", "icon_error-circle", "icon_error-oct", "icon_error-triangle", "icon_question_alt", "icon_comment", "icon_chat", "icon_vol-mute", "icon_volume-low", "icon_volume-high", "icon_quotations_alt", "icon_clock", "icon_lock", "icon_lock-open", "icon_key", "icon_cloud", "icon_cloud-upload", "icon_cloud-download", "icon_lightbulb", "icon_gift", "icon_house", "icon_camera", "icon_mail", "icon_cone", "icon_ribbon", "icon_bag", "icon_cart", "icon_tag", "icon_tags", "icon_trash", "icon_cursor", "icon_mic", "icon_compass", "icon_pin", "icon_pushpin", "icon_map", "icon_drawer", "icon_toolbox", "icon_book", "icon_contacts", "icon_archive", "icon_heart", "icon_profile", "icon_group", "icon_grid-2x2", "icon_grid-3x3", "icon_music", "icon_pause_alt", "icon_phone", "icon_upload", "icon_download", "icon_printer", "icon_calulator", "icon_building", "icon_floppy", "icon_drive", "icon_search-2", "icon_id", "icon_id-2", "icon_puzzle", "icon_like", "icon_dislike", "icon_mug", "icon_currency", "icon_wallet", "icon_pens", "icon_easel", "icon_flowchart", "icon_datareport", "icon_briefcase", "icon_shield", "icon_percent", "icon_globe", "icon_globe-2", "icon_target", "icon_hourglass", "icon_balance", "icon_rook", "icon_printer-alt", "icon_calculator_alt", "icon_building_alt", "icon_floppy_alt", "icon_drive_alt", "icon_search_alt", "icon_id_alt", "icon_id-2_alt", "icon_puzzle_alt", "icon_like_alt", "icon_dislike_alt", "icon_mug_alt", "icon_currency_alt", "icon_wallet_alt", "icon_pens_alt", "icon_easel_alt", "icon_flowchart_alt", "icon_datareport_alt", "icon_briefcase_alt", "icon_shield_alt", "icon_percent_alt", "icon_globe_alt", "icon_clipboard", "social_facebook", "social_twitter", "social_pinterest", "social_googleplus", "social_tumblr", "social_tumbleupon", "social_wordpress", "social_instagram", "social_dribbble", "social_vimeo", "social_linkedin", "social_rss", "social_deviantart", "social_share", "social_myspace", "social_skype", "social_youtube", "social_picassa", "social_googledrive", "social_flickr", "social_blogger", "social_spotify", "social_delicious", "social_facebook_circle", "social_twitter_circle", "social_pinterest_circle", "social_googleplus_circle", "social_tumblr_circle", "social_stumbleupon_circle", "social_wordpress_circle", "social_instagram_circle", "social_dribbble_circle", "social_vimeo_circle", "social_linkedin_circle", "social_rss_circle", "social_deviantart_circle", "social_share_circle", "social_myspace_circle", "social_skype_circle", "social_youtube_circle", "social_picassa_circle", "social_googledrive_alt2", "social_flickr_circle", "social_blogger_circle", "social_spotify_circle", "social_delicious_circle", "social_facebook_square", "social_twitter_square", "social_pinterest_square", "social_googleplus_square", "social_tumblr_square", "social_stumbleupon_square", "social_wordpress_square", "social_instagram_square", "social_dribbble_square", "social_vimeo_square", "social_linkedin_square", "social_rss_square", "social_deviantart_square", "social_share_square", "social_myspace_square", "social_skype_square", "social_youtube_square", "social_picassa_square", "social_googledrive_square", "social_flickr_square", "social_blogger_square", "social_spotify_square", "social_delicious_square");
    }

}
