(function ($) {

    var ajaxURL = admin_ajax_script.ajaxurl,
            adminNonce = admin_ajax_script.ajax_nonce;

    var saveFlag = '';
    $('#eead-general-settings-form').data('serialize', $('#eead-general-settings-form').serialize());

    $(document).on('click', '#eead-general-settings-save', function (e) {
        e.preventDefault();
        var data = $('body').find('#eead-general-settings-form').serializeArray();

        $.ajax({
            url: ajaxURL,
            type: 'post',
            data: {
                action: "admin_settings_save",
                data: data,
                wp_nonce: adminNonce
            },
            beforeSend: function () {
                if (saveFlag == 'yes') {
                    $('#eead-general-settings-form').data('serialize', $('#eead-general-settings-form').serialize());
                }
                if ($('#eead-general-settings-form').serialize() != $('#eead-general-settings-form').data('serialize')) {

                } else {
                    $('body').find('.eead-admin-notificn').html('This input is previously saved.');
                    $('body').find('.eead-admin-notificn').addClass('eead-previously-saved');
                    $('body').find('.eead-admin-notificn').css({'display': 'block', 'color': 'green'});

                    hideNotification();
                    return false;
                }
            },
            success: function (res) {

                if (res == 'yes') {
                    saveFlag = 'yes';
                    $('body').find('.eead-admin-notificn').html('Saved Successfully');
                    $('body').find('.eead-admin-notificn').addClass('eead-successfull-saved');
                    $('body').find('.eead-admin-notificn').css({'display': 'block', 'color': 'green'});
                } else {
                    $('body').find('.eead-admin-notificn').html('Save Failed');
                    $('body').find('.eead-admin-notificn').addClass('eead-failed-save');
                    $('body').find('.eead-admin-notificn').css({'display': 'block', 'color': 'red'});
                }

                hideNotification();
            }
        });
    });


    /* Save Widgets Button Action */
    $(document).on('click', '#eead-widget-selection-btn', function (e) {
        e.preventDefault();

        var widgets_arr = [];
        $.each($(".eead-widget-wrap input[name='widgets']:checked"), function () {
            widgets_arr.push($(this).val());
        });

        $.ajax({
            url: ajaxURL,
            type: 'post',
            data: {
                action: "eead_widgets_save",
                data: widgets_arr,
                wp_nonce: adminNonce
            },
            beforeSend: function () {
                // if( Array.isArray(widgets_arr) && widgets_arr.length == 0 ) { }
            },
            success: function (res) {
                console.log(res);

                if (res == 'yes') {
                    $('body').find('.eead-admin-notificn').html('Saved Successfully');
                    $('body').find('.eead-admin-notificn').addClass('eead-successfull-saved');
                    $('body').find('.eead-admin-notificn').css({'display': 'block', 'color': 'green'});
                } else {
                    $('body').find('.eead-admin-notificn').html('Save Failed');
                    $('body').find('.eead-admin-notificn').addClass('eead-failed-save');
                    $('body').find('.eead-admin-notificn').css({'display': 'block', 'color': 'red'});
                }

                hideNotification();
            }
        });
    });

    /* Hide Notification Div After Time Delay */
    var hideNotification = () => {
        setTimeout(function () {
            $('body').find('.eead-admin-notificn').removeClass('eead-failed-save eead-successfull-saved eead-previously-saved');
            $('body').find('.eead-admin-notificn').hide();
            $('body').find('.eead-admin-notificn').html('');
        }, 3000);
    };

    /* Enable / Disable All Widgets Button Actions */
    $('body').on('click', '.eead-widget-action-btn', function () {
        if ($(this).hasClass('eead-widget-enable-all')) {
            $('.eead-widget-wrap').find('.eead-widget-checkbox').prop('checked', true);
        } else if ($(this).hasClass('eead-widget-disable-all')) {
            $('.eead-widget-wrap').find('.eead-widget-checkbox').prop('checked', false);
        }
    });

    /* Tabs display on tab click for Plugin Menu Settings Page */
    $('body').on('click', '.eead-tab', function () {
        var selected_menu = $(this).data('tab');
        var hideDivs = $(this).data('tohide');

        // Display The Clicked Tab Content
        $('body').find('.' + hideDivs).hide();
        $('body').find('#' + selected_menu).show();

        // Add and remove the class for active tab
        $(this).parent().find('.eead-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        if ($(this).find('input'))
            $(this).find('input').prop('checked', true);
    });
}(jQuery));