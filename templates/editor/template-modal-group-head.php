<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Page Group Header (Pages tab): back to all groups, then the open group's details.
 */
?>
<button type="button" class="eead-group-back">
    <i class="eicon-chevron-left"></i>
    <?php echo esc_html__('All groups', 'easy-elementor-addons'); ?>
</button>
<div class="eead-group-head-info">
    <span class="eead-template-widget">{{ category_name }}</span>
    <h3 class="eead-group-head-name">{{ name }}</h3>
    <# if ( tagline ) { #><p class="eead-group-tagline">{{ tagline }}</p><# } #>
</div>
<div class="eead-group-head-side">
    <# if ( colors && colors.length ) { #>
    <span class="eead-group-dots"><# _.each( colors, function( color ) { #><i style="background:{{ color }}"></i><# } ); #></span>
    <# } #>
    <# if ( fonts ) { #><span class="eead-group-fonts">{{ fonts }}</span><# } #>
    <button type="button" class="eead-group-import"><i class="eicon-download-bold"></i> <?php echo esc_html__('Import all pages', 'easy-elementor-addons'); ?></button>
</div>
