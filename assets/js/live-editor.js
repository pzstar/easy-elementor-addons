(function () {
    var $ = jQuery;

    function handleLiveEditor() {

        $('.eicon-close').on('click', closeModal);

        $('#eead-insert-live-temp').on('click', function () {
            $('body').attr('data-eead-liveeditor-load', 'true');
            closeModal(true);
        });

        $('.eead-live-editor-iframe-modal .eead-expand').on('click', function () {

            if ($(this).find(' > i').hasClass('eicon-frame-expand')) {
                $(this).find('i.eicon-frame-expand').removeClass('eicon-frame-expand').addClass('eicon-frame-minimize').attr('title', 'Minimize');
                $('.eead-live-editor-iframe-modal').addClass('eead-modal-expanded');

            } else {
                minimizeModal(this);
            }
        });

        $(document).on('click', '.eead-live-editor-iframe-modal', function (e) {
            if ($(e.target).closest(".dialog-lightbox-widget-content").length < 1) {
                closeModal();
            }
        });

        elementor.channels.editor.on('createLiveTemp', function (e) {

            var widgetId = getTemplateKey(e),
                $modalContainer = $('.eead-live-editor-iframe-modal'),
                paIframe = $modalContainer.find("#eead-live-editor-control-iframe"),
                $lightboxLoading = $modalContainer.find(".dialog-lightbox-loading"),
                lightboxType = $modalContainer.find(".dialog-type-lightbox"),
                tempSelectorId = e.model.attributes.name.split('_live')[0],
                liveTempId = ['eead_content_toggle_second_content_templates', 'fixed_template', 'right_side_template'].includes(tempSelectorId) ? 'live_temp_content_extra' : 'live_temp_content',
                settingsToChange = {};

            // multiscroll has two temps in each repeater item => both temps will have the same id so we need to distinguish one of them.
            if ('right_side_template' === tempSelectorId) {
                widgetId += '2';
            }

            // show modal.
            lightboxType.show();
            $modalContainer.show();
            $lightboxLoading.show();
            paIframe.contents().find("#elementor-loading").show();
            paIframe.css("z-index", "-1");

            $.ajax({
                type: 'POST',
                url: liveEditor.ajaxurl,
                dataType: 'JSON',
                data: {
                    action: 'handle_live_editor',
                    security: liveEditor.nonce,
                    key: widgetId,
                },
                success: function (res) {

                    paIframe.attr("src", res.data.url);
                    paIframe.attr("data-eead-temp-id", res.data.id);
                    $('#eead-live-temp-title').val(res.data.title);

                    paIframe.on("load", function () {
                        $lightboxLoading.hide();
                        paIframe.show();
                        $modalContainer.find('.eead-live-editor-title').css('display', 'flex');
                        paIframe.contents().find("#elementor-loading").hide();
                        paIframe.css("z-index", "1");
                    });

                    clearInterval(window.paLiveEditorInterval);

                    window.paLiveEditorInterval = setInterval(function () {

                        var loadTemplate = $('body').attr('data-eead-liveeditor-load');

                        if ('true' === loadTemplate) {
                            $('body').attr('data-eead-liveeditor-load', 'false');

                            settingsToChange[tempSelectorId] = '';
                            settingsToChange[liveTempId] = $('#eead-live-temp-title').val();

                            $(".eead-live-temp-title").removeClass("control-hidden");
                            $e.run('document/elements/settings', {container: e.container, settings: settingsToChange, options: {external: !0}});

                            var tempTitle = $('#eead-live-temp-title').val();

                            if (tempTitle && tempTitle !== res.data.title) {
                                updateTemplateTitle(tempTitle, res.data.id);
                            }
                        }
                    }, 1000);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    }

    function checkTempValidity(tempID) {

        if ('' !== tempID) {
            $.ajax({
                type: 'POST',
                url: liveEditor.ajaxurl,
                dataType: 'JSON',
                data: {
                    action: 'check_temp_validity',
                    security: liveEditor.nonce,
                    templateID: tempID,
                },
                success: function (res) {
                    console.log(res.data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    }

    /**
     * Generate the temp key
     * @param {Object} e click event
     * @return {string}
     */
    function getTemplateKey(e) {
        var widget = e.options.container.view.$el,
            // control_id = e._parent.model.attributes._id ? e._parent.model.attributes._id : e.model.cid;
            control_id = e._parent.model.attributes._id ? e._parent.model.attributes._id : '';

        return widget.data('id') + control_id;
    }

    function minimizeModal(_this) {

        $(_this).find('i.eicon-frame-minimize').removeClass('eicon-frame-minimize').addClass('eicon-frame-expand').attr('title', 'Expand');
        $('.eead-live-editor-iframe-modal').removeClass('eead-modal-expanded');
    }

    function updateTemplateTitle(title, id) {

        $.ajax({
            type: 'POST',
            url: liveEditor.ajaxurl,
            dataType: 'JSON',
            data: {
                action: 'update_template_title',
                security: liveEditor.nonce,
                title: title,
                id: id
            },
            success: function (res) {
                console.log('Template Title Updated.');
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function closeModal(inserted = false) {

        $('.eead-live-editor-iframe-modal').css('display', 'none');

        $(".eead-live-temp-title input").attr('disabled', 'true');

        minimizeModal($('.eead-live-editor-iframe-modal .eead-expand'));

        if (!inserted) {
            var tempId = $(".eead-live-editor-iframe-modal #eead-live-editor-control-iframe").attr('data-eead-temp-id');

            if (undefined !== tempId && '' !== tempId) {
                checkTempValidity(tempId);
            }
        }

        // reset temp id/src attribute.
        $(".eead-live-editor-iframe-modal #eead-live-editor-control-iframe").attr({
            'data-eead-temp-id': '',
            'src': ''
        });
    }

    function checkLiveTemplateControl(sectionName, elementorEditor) {

        setTimeout(function () {

            $(".eead-live-temp-title input").each(function (index, input) {
                $(input).attr('disabled', 'true');
                if ('' != $(input).val()) {
                    $(input).closest(".eead-live-temp-title").removeClass("control-hidden");
                }
            });

        }, 1000);
    }

    elementor.channels.editor.on('section:activated', checkLiveTemplateControl);

    $(window).on('elementor:init', handleLiveEditor);

})(jQuery);