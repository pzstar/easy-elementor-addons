<?php

if(!function_exists( 'hfe_render_header' )){
    function hfe_render_header(){
        global $eead_template_ids;
        if($eead_template_ids[0] == null){
            return;
        }

        do_action('eead/template/before_header');
        echo '<div class="eead-template-content-markup eead-template-content-header">';
            echo \EEAD\Utils::render_elementor_content($eead_template_ids[0]);
        echo '</div>';
        do_action('eead/template/after_header');
    }
}

if(!function_exists( 'get_hfe_header_id' )){
    function get_hfe_header_id(){
        global $eead_template_ids;
        return $eead_template_ids[0];
    }
}

if(!function_exists( 'hfe_render_footer' )){
    function hfe_render_footer(){
        global $eead_template_ids;
        if($eead_template_ids[1] == null){
            return;
        }

        do_action('eead/template/before_header');
        echo '<div class="eead-template-content-markup eead-template-content-header">';
            echo \EEAD\Utils::render_elementor_content($eead_template_ids[1]);
        echo '</div>';
        do_action('eead/template/after_header');
    }
}

if(!function_exists( 'get_hfe_footer_id' )){
    function get_hfe_footer_id(){
        global $eead_template_ids;
        return $eead_template_ids[1];
    }
}
