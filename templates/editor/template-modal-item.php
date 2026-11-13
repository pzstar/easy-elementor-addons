<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template Item
 */
?>
<#
// Titles are "Widget – Section name"; show the widget as a label above the name.
var eeadTitleParts = title.split( ' – ' );
var eeadWidget = eeadTitleParts.length > 1 ? eeadTitleParts.shift() : '';
var eeadName = eeadTitleParts.join( ' – ' );
#>
<div class="elementor-template-library-template-body">
    <div class="elementor-template-library-template-screenshot">
        <img src="{{ thumbnail }}" alt="{{ title }}" loading="lazy">
        <div class="elementor-template-library-template-preview">
            <span class="eead-template-preview-label"><i class="eicon-preview-medium"></i><?php echo esc_html__('Preview', 'easy-elementor-addons'); ?></span>
        </div>
    </div>
</div>
<div class="eead-template-footer">
    <div class="eead-template-meta" title="{{ title }}">
        <# if ( eeadWidget ) { #>
        <span class="eead-template-widget">{{ eeadWidget }}</span>
        <# } #>
        <span class="elementor-template-library-template-name">{{ eeadName }}</span>
    </div>
    <div class="elementor-template-library-template-controls">
        <# if ( 'valid' === window.EEADData.license.status || ! pro ) { #>
        <a href="#" class="elementor-template-library-template-action eead-template-insert">
            <i class="eicon-file-download"></i>
            <span class="elementor-button-title"><?php echo esc_html__('Insert', 'easy-elementor-addons'); ?></span>
        </a>
        <# } else if ( pro ) { #>
        <a href="{{{ window.EEADData.license.activateLink }}}" class="eead-template-go-pro" target="_blank">
            <i class="eicon-cart-medium"></i>
            <span class="elementor-button-title">{{{ window.EEADData.license.proMessage }}}</span>
        </a>
        <# } #>
    </div>
</div>
