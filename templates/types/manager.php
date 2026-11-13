<?php

namespace EEADElements\Templates\Types;

if (!defined('ABSPATH'))
    exit; // No access of directly access

if (!class_exists(__NAMESPACE__ . '\EEAD_Templates_Types')) {

    /**
     * EEAD Templates Types.
     *
     * Templates types responsible for handling templates library tabs
     *
     */
    class EEAD_Templates_Types {
        /*
         * Templates Types
         */

        private $types = null;

        /**
         * EEAD_Templates_Types constructor.
         *
         * Get available types for the templates.
         *
         * @access public
         */
        public function __construct() {
            $this->register_types();
        }

        /**
         * Register default templates types
         *
         * @access public
         *
         * @return void
         */
        public function register_types() {
            $base_path = EEAD_PATH . 'templates/types/';
            require $base_path . 'base.php';

            $temp_types = array(
                __NAMESPACE__ . '\EEAD_Structure_Section' => $base_path . 'section.php',
            );
            array_walk($temp_types, function ($file, $class) {
                require $file;
                $this->register_type($class);
            });
            do_action('eead-elementor-templates/types/register', $this);
        }

        /**
         * Register templates type
         *
         * @access public
         *
         * @return void
         */
        public function register_type($class) {
            $instance = new $class;
            $this->types[$instance->get_id()] = $instance;
        }

        /**
         * Return types prepared for templates library tabs
         *
         * @access public
         */
        public function get_types_for_popup() {
            // The library only has section templates so far; a Pages tab would open empty.
            $result = array();

            foreach ($this->types as $id => $structure) {
                $result[$id] = array(
                    'title' => $structure->get_plural_label(),
                    'data' => array(),
                    'sources' => $structure->get_sources(),
                    'settings' => $structure->library_settings(),
                );
            }
            return $result;
        }

    }

}
