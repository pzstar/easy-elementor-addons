jQuery(document).ready(function () {
    'use strict';
    jQuery('body').on('click', '.eead-element-link', function () {
        var $el = jQuery(this),
            settings = $el.data('eead-wrapper-link'),
            data = settings,
            id = 'eead-element-link-' + $el.data('id');

        if (jQuery('#' + id).length === 0) {
            jQuery('body').append(
                jQuery(document.createElement('a')).prop({
                    target: data.is_external ? '_blank' : '_self',
                    href: data.url,
                    class: 'eead-hidden',
                    id: id,
                    rel: data.nofollow ? 'nofollow noreferer' : ''
                })
            );
        }
        jQuery('#' + id)[0].click();
    });
});
