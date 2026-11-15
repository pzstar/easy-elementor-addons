<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Import All Pages (Pages tab): creates every page of the open group as a page on this site.
 */
?>
<div class="eead-import-intro">
    <h4>
        <?php
        /* translators: 1: number of pages, 2: group name, e.g. The Harbour */
        printf(esc_html__('Import all %1$s pages of %2$s', 'easy-elementor-addons'), '{{ pages.length }}', '{{ name }}');
        ?>
    </h4>
    <p><?php esc_html_e('Each page is created as a new page on your site, with its images copied to your media library. The page you are editing is not changed.', 'easy-elementor-addons'); ?></p>
</div>
<div class="eead-import-options">
    <div class="eead-import-option-row">
        <span class="eead-import-option-label"><?php esc_html_e('Create pages as', 'easy-elementor-addons'); ?></span>
        <label><input type="radio" name="eead-import-status" value="draft" checked> <?php esc_html_e('Drafts', 'easy-elementor-addons'); ?></label>
        <label><input type="radio" name="eead-import-status" value="publish"> <?php esc_html_e('Published pages', 'easy-elementor-addons'); ?></label>
    </div>
    <label class="eead-import-option-row"><input type="checkbox" name="eead-import-front">
        <?php
        /* translators: %s: page name, e.g. Home */
        printf(esc_html__('Use %s as the front page of the site', 'easy-elementor-addons'), '{{ pages[0] }}');
        ?>
    </label>
    <label class="eead-import-option-row"><input type="checkbox" name="eead-import-menu" checked>
        <?php
        /* translators: %s: group name, e.g. The Harbour */
        printf(esc_html__('Add the pages to a new menu called "%s"', 'easy-elementor-addons'), '{{ name }}');
        ?>
    </label>
</div>
<ol class="eead-import-list" data-edit="<?php esc_attr_e('Edit with Elementor', 'easy-elementor-addons'); ?>" data-view="<?php esc_attr_e('View', 'easy-elementor-addons'); ?>">
    <# _.each( pages, function( page, index ) { #>
    <li data-index="{{ index }}"><span class="eead-import-state"></span><span class="eead-import-name">{{ page }}</span><span class="eead-import-links"></span></li>
    <# } ); #>
</ol>
<p class="eead-import-message eead-import-done" hidden>
    <?php esc_html_e('Done. Your pages are ready; open one to edit it with Elementor.', 'easy-elementor-addons'); ?>
    <span class="eead-import-menu-note" hidden><?php esc_html_e('To show the new menu, assign it to a location in Appearance › Menus.', 'easy-elementor-addons'); ?></span>
</p>
<p class="eead-import-message eead-import-failed" hidden><?php esc_html_e('Some pages could not be imported. You can try again, or insert those pages one at a time.', 'easy-elementor-addons'); ?></p>
<div class="eead-import-actions">
    <button type="button" class="eead-import-start"><i class="eicon-download-bold"></i> <?php esc_html_e('Import pages', 'easy-elementor-addons'); ?></button>
    <button type="button" class="eead-import-cancel"><?php esc_html_e('Back to pages', 'easy-elementor-addons'); ?></button>
</div>
