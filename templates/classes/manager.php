<?php

namespace EEADElements\Templates\Classes;

use EEADElements\Templates;

if (!defined('ABSPATH'))
    exit;

if (!class_exists(__NAMESPACE__ . '\EEAD_Templates_Manager')) {

    /**
     * EEAD Templates Manager.
     */
    class EEAD_Templates_Manager {

        private $sources = array();

        /**
         * Ht_Templates_Manager constructor.
         *
         * @access public
         */
        public function __construct() {
            //Register AJAX hooks
            add_action('wp_ajax_eead_get_templates', array($this, 'get_templates'));
            add_action('wp_ajax_eead_inner_template', array($this, 'insert_inner_template'));
            add_action('wp_ajax_eead_import_dependency', array($this, 'import_dependency'));
            add_action('wp_ajax_eead_import_page', array($this, 'import_page'));
            add_action('elementor/ajax/register_actions', array($this, 'register_ajax_actions'), 20);

            $this->register_sources();
            add_filter('eead-addons-core/assets/editor/localize', array($this, 'localize_tabs'));
        }

        /**
         * Localize tabs
         *
         * @access public
         * @return [type] [description]
         */
        public function localize_tabs($data) {
            $tabs = $this->get_template_tabs();
            $ids = array_keys($tabs);
            $default = $ids[0];
            $data['tabs'] = $this->get_template_tabs();
            $data['defaultTab'] = $default;
            return $data;
        }

        /**
         * Register sources
         *
         * @access public
         * @return void
         */
        public function register_sources() {
            require EEAD_PATH . 'templates/sources/base.php';
            $namespace = str_replace('Classes', 'Sources', __NAMESPACE__);
            $sources = array(
                'eead' => $namespace . '\EEAD_Templates_Source_Api',
            );

            foreach ($sources as $key => $class) {
                require EEAD_PATH . 'templates/sources/' . $key . '.php';
                $this->add_source($key, $class);
            }
        }

        /**
         * Get template tabs
         *
         * @access public
         */
        public function get_template_tabs() {
            $tabs = Templates\eead_elementor_templates()->types->get_types_for_popup();
            return $tabs;
        }

        /**
         * Get template tabs
         *
         * @access public
         * @param $key source key
         * @param $class source class
         */
        public function add_source($key, $class) {
            $this->sources[$key] = new $class();
        }

        /**
         * Get template
         *
         * @access public
         */
        public function get_templates() {
            check_ajax_referer('eead_editor_nonce', 'nonce');

            if (!current_user_can('edit_posts')) {
                wp_send_json_error();
            }

            $tab = eead_get_var('tab');
            $tabs = $this->get_template_tabs();

            if (!$tab || !isset($tabs[$tab])) {
                wp_send_json_error();
            }

            $sources = $tabs[$tab]['sources'];

            $result = array(
                'templates' => array(),
                'categories' => array(),
                'widgets' => array(),
                'groups' => array(),
            );

            foreach ($sources as $source_slug) {
                $source = isset($this->sources[$source_slug]) ? $this->sources[$source_slug] : false;
                if ($source) {
                    $result['templates'] = array_merge($result['templates'], $source->get_items($tab));
                    $result['categories'] = array_merge($result['categories'], $source->get_categories($tab));
                    $result['widgets'] = array_merge($result['widgets'], $source->get_widgets($tab));
                    if (method_exists($source, 'get_groups')) {
                        $result['groups'] = array_merge($result['groups'], $source->get_groups($tab));
                    }
                }
            }

            $all_cats = array(
                array(
                    'slug' => '',
                    'title' => 'eead_pages' === $tab ? esc_html__('All Categories', 'easy-elementor-addons') : esc_html__('All Sections', 'easy-elementor-addons'),
                ),
            );

            if (!empty($result['categories'])) {
                $result['categories'] = array_merge($all_cats, $result['categories']);
            }
            wp_send_json_success($result);
        }

        /**
         * Import a dependency
         *
         * @access public
         */
        public function import_dependency() {
            check_ajax_referer('eead_editor_nonce', 'nonce');

            $library_type = get_post_type_object('elementor_library');
            if (!current_user_can('edit_posts') || !$library_type || !current_user_can($library_type->cap->create_posts)) {
                wp_send_json_error();
            }

            $source_name = sanitize_key(eead_get_request('source'));
            $template_id = absint(eead_get_request('template_id'));
            $title = sanitize_text_field(eead_get_request('title'));
            $source = isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;
            if (!$source || !$template_id) {
                wp_send_json_error();
            }

            // Inserting the same section again reuses the copy made the first time.
            $key = $source_name . ':' . $template_id;
            $existing = get_posts(array('post_type' => 'elementor_library', 'post_status' => 'publish', 'numberposts' => 1, 'fields' => 'ids', 'meta_key' => '_eead_source_template', 'meta_value' => $key));
            if ($existing) {
                wp_send_json_success(array('id' => $existing[0]));
            }

            try {
                $item = $source->get_item($template_id);
            } catch (\Exception $e) {
                wp_send_json_error($e->getMessage());
            }
            if (empty($item['license']) || empty($item['content'])) {
                wp_send_json_error();
            }

            $type = is_array($item['type']) && $item['type'] ? sanitize_key(reset($item['type'])) : 'section';
            if (!\Elementor\Plugin::instance()->documents->get_document_type($type, false)) {
                $type = 'section';
            }
            $document = \Elementor\Plugin::instance()->documents->create($type, array(
                'post_title' => $title ? $title : sprintf(esc_html__('Template %d', 'easy-elementor-addons'), $template_id),
                'post_status' => 'publish',
            ));
            if (is_wp_error($document) || !$document) {
                wp_send_json_error();
            }
            $document->save(array('elements' => $item['content']));
            update_post_meta($document->get_main_id(), '_eead_source_template', $key);

            wp_send_json_success(array('id' => $document->get_main_id()));
        }

        /**
         * Import a page template as a new page
         *
         * @access public
         */
        public function import_page() {
            check_ajax_referer('eead_editor_nonce', 'nonce');

            $status = 'publish' === eead_get_request('status') ? 'publish' : 'draft';
            if (!current_user_can('edit_pages') || !current_user_can('upload_files') || ('publish' === $status && !current_user_can('publish_pages'))) {
                wp_send_json_error(esc_html__('You are not allowed to create pages.', 'easy-elementor-addons'));
            }

            $source_name = sanitize_key(eead_get_request('source'));
            $template_id = absint(eead_get_request('template_id'));
            $source = isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;
            $title = sanitize_text_field(eead_get_request('title'));
            if (!$source || !$template_id || !$title) {
                wp_send_json_error();
            }

            try {
                $item = $source->get_item($template_id, 'eead_pages');
            } catch (\Exception $e) {
                wp_send_json_error($e->getMessage());
            }
            if (empty($item['license'])) {
                wp_send_json_error(esc_html__('This page needs a valid Pro license.', 'easy-elementor-addons'));
            }
            if (empty($item['content']) || !is_array($item['content'])) {
                wp_send_json_error(esc_html__('The page could not be downloaded.', 'easy-elementor-addons'));
            }

            // Saved templates the page's tabs, switchers or toggles show were copied first (eead_import_dependency).
            $map = array();
            foreach ((array) json_decode(eead_get_request('dependencies', '', '{}'), true) as $from => $to) {
                if ('elementor_library' === get_post_type(absint($to))) {
                    $map[absint($from)] = absint($to);
                }
            }
            $content = $map ? $this->remap_dependencies($item['content'], $map) : $item['content'];

            $document = \Elementor\Plugin::instance()->documents->create('wp-page', array(
                'post_title' => $title,
                'post_status' => $status,
                'menu_order' => absint(eead_get_request('order')),
            ));
            if (is_wp_error($document) || !$document) {
                wp_send_json_error(esc_html__('The page could not be created.', 'easy-elementor-addons'));
            }
            $document->save(array(
                'elements' => $content,
                'settings' => array('template' => 'elementor_header_footer'),
            ));
            $page_id = $document->get_main_id();

            $result = array(
                'id' => $page_id,
                'title' => $title,
                'edit' => $document->get_edit_url(),
                'view' => get_permalink($page_id),
                'menu' => 0,
                'front' => false,
            );

            if ('1' === eead_get_request('front') && current_user_can('manage_options')) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);
                $result['front'] = true;
            }

            // One new menu for the group, created with its first page and reused for the rest.
            if ('1' === eead_get_request('menu') && current_user_can('edit_theme_options')) {
                $menu_id = absint(eead_get_request('menu_id'));
                if (!$menu_id || !is_nav_menu($menu_id)) {
                    $name = sanitize_text_field(eead_get_request('group'));
                    $name = $name ? $name : esc_html__('Imported pages', 'easy-elementor-addons');
                    $base = $name;
                    for ($n = 2; wp_get_nav_menu_object($name); $n++) {
                        $name = $base . ' ' . $n;
                    }
                    $menu_id = wp_create_nav_menu($name);
                }
                if (!is_wp_error($menu_id)) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' => $title,
                        'menu-item-object' => 'page',
                        'menu-item-object-id' => $page_id,
                        'menu-item-type' => 'post_type',
                        'menu-item-status' => 'publish',
                    ));
                    $result['menu'] = $menu_id;
                }
            }

            wp_send_json_success($result);
        }

        /**
         * Point tab, switcher and toggle widgets at this site's copies of their saved templates.
         *
         * @param array $node elements or settings.
         * @param array $map  library template id => local template id.
         *
         * @return array
         */
        private function remap_dependencies($node, $map) {
            if (!is_array($node)) {
                return $node;
            }
            if (isset($node['content_type'], $node['elementor_template']) && 'elementor_template' === $node['content_type'] && isset($map[(int) $node['elementor_template']])) {
                $node['elementor_template'] = (string) $map[(int) $node['elementor_template']];
            }
            foreach (array('primary', 'secondary') as $side) {
                if (isset($node[$side . '_content_type'], $node[$side . '_templates']) && 'template' === $node[$side . '_content_type'] && isset($map[(int) $node[$side . '_templates']])) {
                    $node[$side . '_templates'] = (string) $map[(int) $node[$side . '_templates']];
                }
            }
            foreach ($node as $key => $child) {
                if (is_array($child)) {
                    $node[$key] = $this->remap_dependencies($child, $map);
                }
            }
            return $node;
        }

        /**
         * Insert inner template
         *
         * @access public
         */
        public function insert_inner_template() {
            check_ajax_referer('eead_editor_nonce', 'nonce');

            // Content from the client is published, so only users with unfiltered_html may create it.
            if (!current_user_can('edit_posts') || !current_user_can('unfiltered_html')) {
                wp_send_json_error();
            }

            $template = eead_get_request('template', 'sanitize_text_field', false);
            if (!$template) {
                wp_send_json_error();
            }

            $template_id = isset($template['template_id']) ? esc_attr($template['template_id']) : false;
            $source_name = isset($template['source']) ? esc_attr($template['source']) : false;
            $content = isset($template['content']) ? $template['content'] : false;

            $source = isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;
            if (!$source || !$template_id) {
                wp_send_json_error();
            }

            if (!empty($content)) {
                $new_post = null;

                /* The post type comes from the request, so it must exist and the user must be able to publish it. */
                $post_type = isset($template['type']) ? sanitize_key($template['type']) : '';
                $post_type_object = $post_type ? get_post_type_object($post_type) : null;

                if (!$post_type_object) {
                    wp_send_json_error();
                }

                if (!current_user_can($post_type_object->cap->create_posts) || !current_user_can($post_type_object->cap->publish_posts)) {
                    wp_send_json_error();
                }

                $post_title = isset($template['title']) ? $template['title'] : '';

                if (!empty($template['elementor_page'])) {
                    $new_post = array(
                        'post_type' => $post_type,
                        'post_title' => $post_title,
                        'post_status' => 'publish',
                        'meta_input' => array(
                            '_elementor_data' => wp_slash(is_array($content) ? wp_json_encode($content) : $content),
                            '_elementor_edit_mode' => 'builder',
                            '_elementor_template_type' => 'section',
                            '_elementor_version' => defined('ELEMENTOR_VERSION') ? ELEMENTOR_VERSION : '3.12',
                        ),
                    );
                } else {
                    $new_post = array(
                        'post_type' => $post_type,
                        'post_title' => $post_title,
                        'post_status' => 'publish',
                        'post_content' => $content
                    );
                }

                if (isset($template['custom_taxonomy']) && !empty($template['custom_taxonomy'])) {
                    foreach ($template['custom_taxonomy'] as $tax) {
                        $taxonomy = isset($tax['taxonomy']) ? $tax['taxonomy'] : '';
                        $taxonomy_object = $taxonomy ? get_taxonomy($taxonomy) : false;

                        if ($taxonomy_object) {
                            // Reset per taxonomy, otherwise terms collected for an earlier taxonomy get assigned to this one as well.
                            $term_ids = array();
                            $term_slugs = isset($tax['term_slug']) ? (array) $tax['term_slug'] : array();

                            foreach ($term_slugs as $slug) {
                                $term_id = 0;

                                // Check if term exist for taxonomy
                                if (term_exists($slug, $taxonomy)) {
                                    $term_object = get_term_by('slug', $slug, $taxonomy);
                                    $term_id = $term_object ? $term_object->term_id : 0;
                                } elseif (current_user_can($taxonomy_object->cap->edit_terms)) {
                                    // Creating a term is its own capability, so never create one for a user who does not hold it.
                                    $insterm = wp_insert_term($slug, $taxonomy, array(
                                        'description' => '',
                                        'parent' => 0,
                                        'slug' => $slug,
                                    )
                                    );
                                    $term_id = is_wp_error($insterm) ? 0 : $insterm['term_id'];
                                }

                                if ($term_id)
                                    $term_ids[] = $term_id;
                            }

                            if ($term_ids) {
                                $new_post_extra[$taxonomy] = $term_ids;
                            }
                        }
                    }
                }
                if (isset($new_post_extra)) {
                    $new_post['tax_input'] = $new_post_extra;
                }
                $post_id = wp_insert_post($new_post);

                $image_url = isset($template['template_featured_image']) ? esc_url_raw($template['template_featured_image']) : '';

                if ($image_url && $post_id && !is_wp_error($post_id)) {
                    /* Sideloaded, so the file is fetched safely and checked as an image. */
                    // admin-ajax.php loads all three, but check each separately.
                    if (!function_exists('media_sideload_image')) {
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                    }
                    if (!function_exists('download_url')) {
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                    }
                    if (!function_exists('wp_generate_attachment_metadata')) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                    }

                    $attach_id = media_sideload_image($image_url, $post_id, null, 'id');

                    if (!is_wp_error($attach_id)) {
                        set_post_thumbnail($post_id, $attach_id);
                    }
                }
            }
            wp_send_json_success();
        }

        /**
         * Register AJAX actions
         *
         * @access public
         */
        public function register_ajax_actions($ajax_manager) {
            if (!eead_get_post('actions')) {
                return;
            }

            // Elementor sends `actions` as JSON keyed by request id, each entry holding `action` and `data`.
            $actions = json_decode(eead_get_request('actions', ''), true);
            if (!is_array($actions)) {
                return;
            }

            $data = false;

            foreach ($actions as $id => $action_data) {
                if (isset($action_data['action']) && 'get_template_data' === $action_data['action']) {
                    $data = $action_data;
                }
            }

            if (!$data) {
                return;
            }

            if (!isset($data['data'])) {
                return;
            }

            if (!isset($data['data']['source'])) {
                return;
            }

            $source = $data['data']['source'];

            if (empty($source) || !is_string($source) || !isset($this->sources[$source])) {
                return;
            }

            $ajax_manager->register_ajax_action('get_template_data', function ($data) {
                return $this->get_template_data_array($data);
            });
        }

        /**
         * Get template data array
         *
         * @access public
         */
        public function get_template_data_array($data) {
            if (!current_user_can('edit_posts')) {
                return false;
            }

            if (empty($data['template_id'])) {
                return false;
            }

            $source_name = isset($data['source']) ? esc_attr($data['source']) : '';
            if (!$source_name) {
                return false;
            }

            $source = isset($this->sources[$source_name]) ? $this->sources[$source_name] : false;
            if (!$source) {
                return false;
            }

            if (empty($data['tab'])) {
                return false;
            }

            $template = $source->get_item($data['template_id'], $data['tab']);
            return $template;
        }

    }

}
