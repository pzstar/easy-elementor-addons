<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Preview Navigation: step through the pages of the previewed page's group.
 */
?>
<button type="button" class="eead-preview-step" data-step="-1" aria-label="<?php echo esc_attr__('Previous page', 'easy-elementor-addons'); ?>"<# if ( index === 0 ) { #> disabled<# } #>>
    <i class="eicon-chevron-left"></i>
</button>
<span class="eead-preview-position">
    <strong>{{ label }}</strong>
    <?php
    /* translators: 1: position of the page in its group, 2: number of pages in the group */
    printf(esc_html__('%1$s of %2$s', 'easy-elementor-addons'), '{{ index + 1 }}', '{{ total }}');
    ?>
</span>
<button type="button" class="eead-preview-step" data-step="1" aria-label="<?php echo esc_attr__('Next page', 'easy-elementor-addons'); ?>"<# if ( index === total - 1 ) { #> disabled<# } #>>
    <i class="eicon-chevron-right"></i>
</button>
