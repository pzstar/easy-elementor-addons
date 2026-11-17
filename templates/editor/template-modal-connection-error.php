<?php

/**
 * Templates Loader Connection Error
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="elementor-library-error">
    <div class="elementor-library-error-message">
        <?php echo esc_html__('The template library could not be loaded.', 'easy-elementor-addons'); ?>
    </div>
    <div class="elementor-library-error-link">
        <?php echo esc_html__('Your editor session may have expired. Please reload the page and try again.', 'easy-elementor-addons'); ?>
    </div>
</div>
