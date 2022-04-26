<?php

namespace EasyElementorAddons;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

final class EEAD_Modules_Manager {

    private function is_module_active($module_id) {

        $options = get_option('eead_active_modules', []);
        return true;
    }

    public function __construct() {
        $this->require_files();
        $this->register_modules();
    }

    private function require_files() {
        require( EEAD_PATH . 'base/module-base.php' );
        require( EEAD_PATH . 'inc/extenders/extender.php' );
    }

    public function register_modules() {
        
        $modules = get_option( 'eead_widgets' ) ? get_option( 'eead_widgets' ) : array();
        
        if(isset($modules)) {
            if(empty($modules)) {
                return;
            }
        }

        foreach ($modules as $key => $module) {
            if (!$this->is_module_active($module)) {
                continue;
            }
            $class_name = str_replace('-', ' ', $module);
            $class_name = str_replace(' ', '', ucwords($class_name));
            $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

            $class_name::instance();
        }
    }

}

if (!function_exists('easy_elementor_addons_module_manager')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function easy_elementor_addons_module_manager() {
        return new EEAD_Modules_Manager();
    }

}
easy_elementor_addons_module_manager();
