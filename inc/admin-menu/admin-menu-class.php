<?php
/**
 * *Admin Menu Class 
 * */

namespace EasyElementorAddons;

class AdminClass {

    public function __construct() {
        add_action('wp_ajax_admin_settings_save', [$this, 'eead_settings_save']);
        add_action('wp_ajax_eead_widgets_save', [$this, 'eead_widgets_save']);

        add_action('admin_menu', [$this, 'eead_register_admin_menu'], 20);
        add_action('admin_enqueue_scripts', [$this, 'eead_admin_enqueue_scripts'], 2000);
    }

    public function eead_admin_enqueue_scripts() {
        wp_enqueue_style('eead-admin-menu', EEAD_URL . 'assets/css/eead-admin-menu.css', false, EEAD_VERSION);
        wp_enqueue_style('materialdesignicons', EEAD_URL . 'assets/fonts/materialdesignicons/materialdesignicons.css', false, EEAD_VERSION);

        wp_enqueue_script('eead-admin', EEAD_URL . 'assets/js/admin.js', ['jquery'], EEAD_VERSION, true);
        wp_localize_script('eead-admin', 'admin_ajax_script', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('eead_ajax_nonce'),
        ]);
    }

    public function eead_register_admin_menu() {
        add_menu_page(
                __('Easy Elementor Addons', 'easy-elementor-addons'), __('Easy Elementor Addons', 'easy-elementor-addons'), 'manage_options', 'eead-settings', [$this, 'eead_settings_page_display'], '', 99
        );
    }

    public function eead_settings_save() {

        if (isset($_POST['wp_nonce']) && wp_verify_nonce($_POST['wp_nonce'], 'eead_ajax_nonce')) {

            $data_ar = $_POST['data'];
            $settings_ar = [];
            foreach ($data_ar as $key => $value) {
                $settings_ar[$value['name']] = $value['value'];
            }
            $update = update_option('eead_general_settings', $settings_ar);
            if ($update) {
                echo 'yes';
            } else {
                echo 'no';
            }
        }
        die();
    }

    public function eead_widgets_save() {
        if (isset($_POST['wp_nonce']) && wp_verify_nonce($_POST['wp_nonce'], 'eead_ajax_nonce')) {

            $data_ar = isset($_POST['data']) && !empty($_POST['data']) ? $_POST['data'] : array();
            $update_widgets = update_option('eead_widgets', $data_ar);
            if ($update_widgets) {
                echo 'yes';
            } else {
                echo 'no';
            }
        }
        die();
    }

    public function get_widget_field($label, $val) {
        $eead_widgets = get_option('eead_widgets') ? get_option('eead_widgets') : array();
        if (isset($eead_widgets) && in_array($val, $eead_widgets)) {
            $selected = 'checked';
        } else {
            $selected = '';
        }
        ?>
        <div class="eead-widget-wrap">
            <span><?php _e($label, 'easy-elementor-addons') ?></span>
            <div class="eead-checkbox">
                <input type="checkbox" class="eead-widget-checkbox" name="widgets" value="<?php echo $val ?>" <?php echo $selected; ?>>
                <label></label>
            </div>
        </div>
        <?php
    }

    public function eead_settings_page_display() {
        include EEAD_PATH . 'inc/admin-menu/admin-menu-page.php';
    }

}

new AdminClass();
