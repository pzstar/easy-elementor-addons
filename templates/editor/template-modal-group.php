<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Page Group Card (Pages tab): the group's home page, category, name, tagline and colors.
 */
?>
<div class="eead-group-shot">
    <img src="{{ thumbnail }}" alt="{{ name }}" loading="lazy">
    <span class="eead-group-open">
        <span class="eead-template-preview-label"><i class="eicon-folder-o"></i>
            <?php
            /* translators: %s: number of pages in the group */
            printf(esc_html__('View %s pages', 'easy-elementor-addons'), '{{ count }}');
            ?>
        </span>
    </span>
</div>
<div class="eead-group-meta">
    <span class="eead-template-widget">{{ category_name }}</span>
    <span class="eead-group-name">{{ name }}</span>
    <# if ( tagline ) { #><span class="eead-group-tagline">{{ tagline }}</span><# } #>
    <# if ( colors && colors.length ) { #>
    <span class="eead-group-dots"><# _.each( colors, function( color ) { #><i style="background:{{ color }}"></i><# } ); #></span>
    <# } #>
</div>
