!function (e) {
    "use strict";
    var t, a, i = window.EEADData || {};
    a = {
        ModalLayoutView: null,
        ModalHeaderView: null,
        ModalHeaderInsertButton: null,
        ModalLoadingView: null,
        ModalBodyView: null,
        ModalErrorView: null,
        ModalConnectionErrorView: null,
        LibraryCollection: null,
        KeywordsModel: null,
        ModalCollectionView: null,
        ModalTabsCollection: null,
        ModalTabsCollectionView: null,
        FiltersCollectionView: null,
        FiltersItemView: null,
        ModalTabsItemView: null,
        ModalTemplateItemView: null,
        ModalInsertTemplateBehavior: null,
        ModalTemplateModel: null,
        CategoriesCollection: null,
        ModalPreviewView: null,
        ModalHeaderBack: null,
        ModalHeaderLogo: null,
        KeywordsView: null,
        TabModel: null,
        CategoryModel: null,
        init: function () {
            var a = this;
            a.ModalTemplateModel = Backbone.Model.extend({
                defaults: {
                    template_id: 0,
                    name: "",
                    title: "",
                    thumbnail: "",
                    preview: "",
                    source: "",
                    categories: [],
                    widgets: [],
                    liveUrl: "",
                    package: ""
                }
            }), a.ModalHeaderView = Marionette.LayoutView.extend({
                id: "eead-template-modal-header",
                template: "#views-eead-template-modal-header",
                ui: {
                    closeModal: "#eead-template-modal-header-close-modal"
                },
                events: {
                    "click @ui.closeModal": "onCloseModalClick"
                },
                regions: {
                    headerLogo: "#eead-template-modal-header-logo-area",
                    headerTabs: "#eead-template-modal-header-tabs",
                    headerActions: "#eead-template-modal-header-actions"
                },
                onCloseModalClick: function () {
                    t.closeModal()
                }
            }), a.TabModel = Backbone.Model.extend({
                defaults: {
                    slug: "",
                    title: ""
                }
            }), a.LibraryCollection = Backbone.Collection.extend({
                model: a.ModalTemplateModel
            }), a.ModalTabsCollection = Backbone.Collection.extend({
                model: a.TabModel
            }), a.CategoryModel = Backbone.Model.extend({
                defaults: {
                    slug: "",
                    title: ""
                }
            }), a.KeywordsModel = Backbone.Model.extend({
                defaults: {
                    widgets: {}
                }
            }), a.CategoriesCollection = Backbone.Collection.extend({
                model: a.CategoryModel
            }), a.GroupModel = Backbone.Model.extend({
                defaults: {
                    slug: "",
                    name: "",
                    category: "",
                    category_name: "",
                    tagline: "",
                    colors: [],
                    fonts: "",
                    count: 0,
                    thumbnail: ""
                }
            }), a.GroupsCollection = Backbone.Collection.extend({
                model: a.GroupModel
            }), a.GroupItemView = Marionette.ItemView.extend({
                // A page group (The Harbour): opens the group's pages.
                template: "#views-eead-template-modal-group",
                className: "eead-group-card",
                attributes: {
                    role: "button",
                    tabindex: 0
                },
                events: {
                    click: "onOpen",
                    keydown: "onKey"
                },
                onOpen: function () {
                    t.openGroup(this.model)
                },
                onKey: function (e) {
                    ("Enter" === e.key || " " === e.key) && (e.preventDefault(), this.onOpen())
                }
            }), a.GroupsCollectionView = Marionette.CompositeView.extend({
                template: "#views-eead-template-modal-templates",
                id: "eead-modal-template-library-groups",
                childViewContainer: "#eead-modal-templates-container",
                initialize: function () {
                    this.listenTo(t.channels.templates, "filter:change", this._renderChildren)
                },
                filter: function (e) {
                    var a = t.getFilter("category");
                    return !a || e.get("category") === a
                },
                getChildView: function () {
                    return a.GroupItemView
                }
            }), a.GroupHeadView = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-group-head",
                className: "eead-group-head-bar",
                events: {
                    "click .eead-group-back": "onBack",
                    "click .eead-group-import": "onImport"
                },
                onBack: function () {
                    t.showGroups()
                },
                onImport: function () {
                    t.showImport(this.model)
                }
            }), a.ImportView = Marionette.ItemView.extend({
                // Import all pages: creates each page of the group as a page on this site, one after another.
                template: "#views-eead-template-modal-import",
                className: "eead-import",
                events: {
                    "click .eead-import-start": "onStart",
                    "click .eead-import-cancel": "onCancel"
                },
                onCancel: function () {
                    t.openGroup(this.getOption("group"))
                },
                onStart: function () {
                    var v = this,
                        pages = t.groupPages(),
                        list = v.$(".eead-import-list"),
                        status = v.$("[name=eead-import-status]:checked").val(),
                        front = v.$("[name=eead-import-front]").is(":checked"),
                        menu = v.$("[name=eead-import-menu]").is(":checked"),
                        menuId = 0,
                        failed = 0;
                    // A retry imports only the pages that failed; the ones already created keep their links.
                    v.$("input, button").prop("disabled", !0), v.$(".eead-import-message").prop("hidden", !0), list.find("li.is-failed").removeClass("is-failed").find(".eead-import-links").empty();
                    menuId = v.menuId || 0;
                    var next = function (n) {
                        if (n >= pages.length) {
                            return v.menuId = menuId, v.$("input, button").prop("disabled", !1), v.$(".eead-import-start").prop("hidden", !failed), v.$(failed ? ".eead-import-failed" : ".eead-import-done").prop("hidden", !1), v.$(".eead-import-menu-note").prop("hidden", failed || !menuId)
                        }
                        var m = pages[n],
                            row = list.find("li[data-index='" + n + "']");
                        if (row.hasClass("is-done")) {
                            return next(n + 1)
                        }
                        row.addClass("is-busy");
                        t.copyDependencies(m).then(function (map) {
                            return e.ajax({
                                url: ajaxurl,
                                type: "post",
                                dataType: "json",
                                data: {
                                    action: "eead_import_page",
                                    nonce: i.nonce,
                                    source: m.get("source"),
                                    template_id: m.get("template_id"),
                                    title: t.pageLabel(m),
                                    order: m.get("order"),
                                    status: status,
                                    front: front && 0 === n ? 1 : 0,
                                    menu: menu ? 1 : 0,
                                    menu_id: menuId,
                                    group: v.model.get("name"),
                                    dependencies: JSON.stringify(map)
                                }
                            })
                        }).then(function (res) {
                            if (!res || !res.success) {
                                throw res && res.data ? res.data : ""
                            }
                            menuId = res.data.menu || menuId, row.addClass("is-done").find(".eead-import-links").append(e("<a target='_blank' rel='noopener'>").attr("href", res.data.edit).text(list.data("edit")), e("<a target='_blank' rel='noopener'>").attr("href", res.data.view).text(list.data("view")))
                        }).fail(function (err) {
                            failed++, row.addClass("is-failed").find(".eead-import-links").text("string" == typeof err ? err : "")
                        }).always(function () {
                            row.removeClass("is-busy"), next(n + 1)
                        })
                    };
                    next(0)
                }
            }), a.PreviewNavView = Marionette.ItemView.extend({
                // Previous and next page of the previewed page's group.
                template: "#views-eead-template-modal-preview-nav",
                id: "eead-template-modal-preview-nav",
                events: {
                    "click .eead-preview-step": "onStep"
                },
                onStep: function (e) {
                    t.stepPreview(+e.currentTarget.getAttribute("data-step"))
                }
            }), a.KeywordsView = Marionette.ItemView.extend({
                id: "elementor-template-library-filter-wrap",
                template: "#views-eead-template-modal-widgets",
                ui: {
                    widgets: ".eead-library-widgets"
                },
                events: {
                    "change @ui.widgets": "onSelectKeyword"
                },
                onSelectKeyword: function (e) {
                    var a = e.currentTarget.selectedOptions[0].value;
                    t.setFilter("keyword", a)
                },
                onRender: function () {
                    this.$(".eead-library-widgets").select2({
                        placeholder: "Choose Widget",
                        allowClear: !0,
                        width: 250,
                        dropdownParent: this.$el
                    })
                }
            }), a.ModalPreviewView = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-preview",
                id: "eead-item-preview-wrap",
                ui: {
                    iframe: "iframe",
                    notice: ".eead-item-notice"
                },
                onRender: function () {
                    if (null !== this.getOption("notice") && this.getOption("notice").length && -1 == this.getOption("notice").indexOf("")) {
                        var e = "";
                        -1 !== this.getOption("notice").indexOf("facebook") ? e += "<p>Please login with your Facebook account in order to get your Facebook Reviews.</p>" : -1 !== this.getOption("notice").indexOf("google") ? e += "<p>You need to add your Google API key from Dashboard -> Easy Elementor Addons for Elementor -> Google Maps</p>" : -1 !== this.getOption("notice").indexOf("form") && (e += "<p>You need to have <a href='https://wordpress.org/plugins/contact-form-7/' target='_blank'>Contact Form 7 plugin</a> installed and active.</p>"), this.ui.notice.html("<div><p><strong>Important!</strong></p>" + e + "</div>")
                    }
                    this.ui.iframe.attr("src", this.getOption("url"))
                }
            }), a.ModalHeaderBack = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-header-back",
                id: "eead-template-modal-header-back",
                ui: {
                    button: "button"
                },
                events: {
                    "click @ui.button": "onBackClick"
                },
                onBackClick: function () {
                    t.setPreview("back")
                }
            }), a.ModalHeaderLogo = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-header-logo",
                id: "eead-template-modal-header-logo"
            }), a.ModalBodyView = Marionette.LayoutView.extend({
                template: "#views-eead-template-modal-content",
                id: "eead-template-library-content",
                className: function () {
                    return "library-tab-" + t.getTab()
                },
                regions: {
                    contentGroupHead: ".eead-group-head",
                    contentTemplates: ".eead-templates-list",
                    contentFilters: ".eead-filters-list",
                    contentKeywords: ".eead-widgets-list"
                }
            }), a.LibraryLoadingView = Marionette.ItemView.extend({
                id: "eead-modal-template-library-loading",
                template: "#views-eead-template-modal-loading"
            }), a.LibraryErrorView = Marionette.ItemView.extend({
                id: "eead-modal-template-error",
                template: "#views-eead-template-modal-error"
            }), a.ModalInsertTemplateBehavior = Marionette.Behavior.extend({
                ui: {
                    insertButton: ".eead-template-insert"
                },
                events: {
                    "click @ui.insertButton": "onInsertButtonClick"
                },
                onInsertButtonClick: function () {
                    var a = this.view.model,
                        o = a.attributes.dependencies || {},
                        n = a.attributes.pro,
                        r = {},
                        idMap = {},
                        imports = [];
                    if (t.layout.showLoadingView(), "valid" !== i.license.status && n) {
                        return t.layout.showLicenseError();
                    }
                    for (var s in o) {
                        const dep = o[s];
                        if ("elementor_library" === dep.type && dep.template_id) {
                            // Copy the saved templates its tabs, switchers or toggles show, and point the widgets at the copies.
                            imports.push(e.ajax({
                                url: ajaxurl,
                                type: "post",
                                dataType: "json",
                                data: {
                                    action: "eead_import_dependency",
                                    nonce: i.nonce,
                                    source: dep.source,
                                    template_id: dep.template_id,
                                    title: dep.title,
                                    tab: t.getTab()
                                }
                            }).then(function (res) {
                                res && res.success && res.data && res.data.id ? idMap[dep.template_id] = res.data.id : console.warn("Easy Elementor Addons: a saved template could not be copied.", dep);
                            }, function (err) {
                                // The section still inserts; the widget that uses this template stays empty.
                                console.warn("Easy Elementor Addons: a saved template could not be copied.", dep, err);
                                return e.Deferred().resolve();
                            }));
                        } else {
                            e.ajax({
                                url: ajaxurl,
                                type: "post",
                                dataType: "json",
                                data: {
                                    action: "eead_inner_template",
                                    nonce: i.nonce,
                                    template: dep?.template_id ? dep : {...dep, template_id: a.attributes.template_id},
                                    tab: t.getTab()
                                },
                                error: function (e) {
                                    // The parent template still inserts, so do not interrupt it; just make the failure visible.
                                    console.warn("Easy Elementor Addons: a template dependency could not be created.", e);
                                }
                            });
                        }
                    }
                    // Point tab, switcher and toggle widgets at the local copies of their saved templates.
                    var remap = function (node) {
                        if (Array.isArray(node)) {
                            return node.forEach(remap);
                        }
                        if (!node || "object" != typeof node) {
                            return;
                        }
                        "elementor_template" === node.content_type && idMap[node.elementor_template] && (node.elementor_template = String(idMap[node.elementor_template]));
                        ["primary", "secondary"].forEach(function (side) {
                            "template" === node[side + "_content_type"] && idMap[node[side + "_templates"]] && (node[side + "_templates"] = String(idMap[node[side + "_templates"]]));
                        });
                        for (var k in node) {
                            "object" == typeof node[k] && remap(node[k]);
                        }
                    };
                    e.when.apply(e, imports).always(function () {
                        elementor.templates.requestTemplateContent(a.get("source"), a.get("template_id"), {
                            data: {
                                tab: t.getTab(),
                                page_settings: !1
                            },
                            success: function (e) {
                                e.license ? (remap(e.content), t.closeModal(), null !== t.atIndex && (r.at = t.atIndex), elementor.previewView.addChildModel(e.content, r), elementor.channels.data.trigger("template:after:insert", a), t.atIndex = null) : t.layout.showLicenseError()
                            },
                            error: function (e) {
                                t.layout.showConnectionError()
                            }
                        })
                    })
                }
            }), a.ModalHeaderInsertButton = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-insert-button",
                id: "eead-template-modal-insert-button",
                behaviors: {
                    insertTemplate: {
                        behaviorClass: a.ModalInsertTemplateBehavior
                    }
                }
            }), a.ModalTemplateItemView = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-item",
                className: function () {
                    var e = " eead-modal-template-has-url",
                        t = "";
                    return "" === this.model.get("preview") && (e = " eead-modal-template-no-url"), this.model.get("pro") && "valid" != i.license.status && (t = " eead-modal-template-pro"), "elementor-template-library-template elementor-template-library-template-remote" + e + t
                },
                ui: function () {
                    return {
                        previewButton: ".elementor-template-library-template-preview"
                    }
                },
                events: function () {
                    return {
                        "click @ui.previewButton": "onPreviewButtonClick"
                    }
                },
                onPreviewButtonClick: function () {
                    "" !== this.model.get("url") && t.setPreview(this.model)
                },
                behaviors: {
                    insertTemplate: {
                        behaviorClass: a.ModalInsertTemplateBehavior
                    }
                }
            }), a.FiltersItemView = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-filters-item",
                className: function () {
                    return "eead-modal-template-filter-item"
                },
                ui: function () {
                    return {
                        filterInputs: ".eead-modal-template-filter-label input"
                    }
                },
                events: function () {
                    return {
                        "change @ui.filterInputs": "onFilterClick"
                    }
                },
                onFilterClick: function (e) {
                    // Clear the widget filter too; select2 only redraws on change, so the old widget would stay shown.
                    t.getFilter("group") && t.showGroups(), jQuery(".eead-library-widgets").val("").trigger("change.select2"), t.setFilter("category", e.currentTarget.value), t.setFilter("keyword", "")
                }
            }), a.ModalTabsItemView = Marionette.ItemView.extend({
                template: "#views-eead-template-modal-tabs-item",
                className: function () {
                    return "elementor-template-library-menu-item"
                },
                ui: function () {
                    return {
                        tabsLabels: "label",
                        tabsInput: "input"
                    }
                },
                events: function () {
                    return {
                        "click @ui.tabsLabels": "onTabClick"
                    }
                },
                onRender: function () {
                    this.model.get("slug") === t.getTab() && this.ui.tabsInput.attr("checked", "checked")
                },
                onTabClick: function (e) {
                    // A label click arrives twice: on the label (no value) and on its radio input.
                    var a = jQuery(e.target).val();
                    a && (t.channels.templates.reply("filter:group", ""), t.setTab(a), t.setFilter("keyword", ""))
                }
            }), a.FiltersCollectionView = Marionette.CompositeView.extend({
                id: "eead-modal-template-library-filters",
                template: "#views-eead-template-modal-filters",
                childViewContainer: "#eead-modal-filters-container",
                getChildView: function (e) {
                    return a.FiltersItemView
                }
            }), a.ModalTabsCollectionView = Marionette.CompositeView.extend({
                template: "#views-eead-template-modal-tabs",
                childViewContainer: "#views-eead-template-modal-tabs-items",
                getChildView: function (e) {
                    return a.ModalTabsItemView
                }
            }), a.ModalCollectionView = Marionette.CompositeView.extend({
                template: "#views-eead-template-modal-templates",
                id: "eead-modal-template-library-templates",
                childViewContainer: "#eead-modal-templates-container",
                initialize: function () {
                    this.listenTo(t.channels.templates, "filter:change", this._renderChildren)
                },
                // Inside a page group, its pages in order (home page first).
                viewComparator: function (e) {
                    return t.getFilter("group") ? e.get("order") : 0
                },
                filter: function (e) {
                    var a = t.getFilter("category"),
                        o = t.getFilter("keyword"),
                        g = t.getFilter("group");
                    if (g) {
                        return e.get("group") === g
                    }
                    return !a && !o || (o && !a ? _.contains(e.get("widgets"), o) : a && !o ? _.contains(e.get("categories"), a) : _.contains(e.get("categories"), a) && _.contains(e.get("widgets"), o))
                },
                getChildView: function (e) {
                    return a.ModalTemplateItemView
                }
            }), a.ModalLoadingView = Marionette.ItemView.extend({
                id: "eead-modal-loading",
                template: "#views-eead-template-modal-loading"
            }), a.ModalErrorView = Marionette.ItemView.extend({
                id: "eead-modal-loading",
                template: "#views-eead-template-modal-error"
            }), a.ModalConnectionErrorView = Marionette.ItemView.extend({
                id: "eead-modal-connection-error",
                template: "#views-eead-template-modal-connection-error"
            }), a.ModalLayoutView = Marionette.LayoutView.extend({
                el: "#eead-modal-template",
                regions: i.modalRegions,
                initialize: function () {
                    this.getRegion("modalHeader").show(new a.ModalHeaderView), this.listenTo(t.channels.tabs, "filter:change", this.switchTabs), this.listenTo(t.channels.layout, "preview:change", this.switchPreview)
                },
                switchTabs: function () {
                    this.showLoadingView(), t.setFilter("keyword", ""), t.requestTemplates(t.getTab())
                },
                switchPreview: function () {
                    var e = this.getHeaderView(),
                        o = t.getPreview(),
                        n = t.getFilter("category"),
                        i = t.getFilter("keyword");
                    return "back" === o ? (e.headerLogo.show(new a.ModalHeaderLogo), e.headerTabs.show(new a.ModalTabsCollectionView({
                        collection: t.collections.tabs
                    })), e.headerActions.empty(), t.setTab(t.getTab()), "" != n && (t.setFilter("category", n), jQuery("#eead-modal-filters-container").find("input[value='" + n + "']").prop("checked", !0)), void ("" != i && t.setFilter("keyword", i))) : "initial" === o ? (e.headerActions.empty(), void e.headerLogo.show(new a.ModalHeaderLogo)) : (this.getRegion("modalContent").show(new a.ModalPreviewView({
                        preview: o.get("preview"),
                        url: o.get("url"),
                        notice: o.get("notice")
                    })), t.showPreviewNav(e, o), e.headerLogo.show(new a.ModalHeaderBack), void e.headerActions.show(new a.ModalHeaderInsertButton({
                        model: o
                    })))
                },
                getHeaderView: function () {
                    return this.getRegion("modalHeader").currentView
                },
                getContentView: function () {
                    return this.getRegion("modalContent").currentView
                },
                showLoadingView: function () {
                    this.modalContent.show(new a.ModalLoadingView)
                },
                showLicenseError: function () {
                    this.modalContent.show(new a.ModalErrorView)
                },
                showConnectionError: function () {
                    this.modalContent.show(new a.ModalConnectionErrorView)
                },
                showTemplatesView: function (e, o, n, g) {
                    window.EEADData.cat = o.length;
                    this.getRegion("modalContent").show(new a.ModalBodyView);
                    var i = this.getContentView(),
                        l = this.getHeaderView(),
                        r = new a.KeywordsModel({
                            widgets: n
                        });

                    t.collections.tabs = new a.ModalTabsCollection(t.getTabs()), l.headerTabs.show(new a.ModalTabsCollectionView({
                        collection: t.collections.tabs
                    })), i.contentTemplates.show(new a.ModalCollectionView({
                        collection: e
                    })), o.length > 0 ? i.contentFilters.show(new a.FiltersCollectionView({
                        collection: o
                    })) : '', i.contentKeywords.show(new a.KeywordsView({
                        model: r
                    }));
                    // Pages tab: group cards first; back from a preview reopens the group that was open.
                    t.collections.groups = g;
                    if ("eead_pages" === t.getTab() && g && g.length) {
                        var s = t.getFilter("group") && g.findWhere({
                            slug: t.getFilter("group")
                        });
                        s ? t.openGroup(s) : t.showGroups()
                    }
                }
            })
        }
    }, t = {
        modal: !1,
        layout: !1,
        collections: {},
        tabs: {},
        defaultTab: "",
        channels: {},
        atIndex: null,
        init: function () {
            window.elementor.on("preview:loaded", window._.bind(t.onPreviewLoaded, t)), a.init()
        },
        onPreviewLoaded: function () {
            let c = 0,
                e = setInterval(() => {
                    window.elementor.$previewContents.find(".elementor-add-new-section").length ? (this.initEEADTempsButton(), clearInterval(e)) : ++c >= 100 && clearInterval(e)
                }, 100);
            window.elementor.$previewContents.on("click.addEEADTemplate", ".eead-add-section-btn", _.bind(this.showTemplatesModal, this)), this.channels = {
                templates: Backbone.Radio.channel("EEAD_EDITOR:templates"),
                tabs: Backbone.Radio.channel("EEAD_EDITOR:tabs"),
                layout: Backbone.Radio.channel("EEAD_EDITOR:layout")
            }, this.tabs = i.tabs, this.defaultTab = i.defaultTab
        },
        initEEADTempsButton: function () {
            var a = window.elementor.$previewContents.find(".elementor-add-new-section"),
                o = '<div class="elementor-add-section-area-button eead-add-section-btn" title="Add Easy Elementor Addons Template"><div class="eead-editor-icon"></div></div>';
            a.length && i.EEADEditorBtn && e(o).prependTo(a), window.elementor.$previewContents.on("click.addEEADTemplate", ".elementor-editor-section-settings .elementor-editor-element-add, .elementor-editor-container-settings .elementor-editor-element-add", function () {
                var a = e(this).closest(".elementor-top-section, .e-con"),
                    n = a.data("model-cid");
                t.atIndex = null, elementor.previewView.collection.length && e.each(elementor.previewView.collection.models, function (e, a) {
                    n === a.cid && (t.atIndex = e)
                }), i.EEADEditorBtn && a.prev(".elementor-add-section").find(".elementor-add-new-section").prepend(o)
            })
        },
        getFilter: function (e) {
            return this.channels.templates.request("filter:" + e)
        },
        setFilter: function (e, t) {
            this.channels.templates.reply("filter:" + e, t), this.channels.templates.trigger("filter:change")
        },
        getTab: function () {
            return this.channels.tabs.request("filter:tabs")
        },
        setTab: function (e, t) {
            this.channels.tabs.reply("filter:tabs", e), t || this.channels.tabs.trigger("filter:change")
        },
        getTabs: function () {
            var e = [];
            return _.each(this.tabs, function (t, a) {
                e.push({
                    slug: a,
                    title: t.title
                })
            }), e
        },
        getPreview: function (e) {
            return this.channels.layout.request("preview")
        },
        setPreview: function (e, t) {
            this.channels.layout.reply("preview", e), t || this.channels.layout.trigger("preview:change")
        },
        showTemplatesModal: function () {
            this.getModal().show(), this.layout || (this.layout = new a.ModalLayoutView, this.layout.showLoadingView()), this.setTab(this.defaultTab, !0), this.requestTemplates(this.defaultTab), this.setPreview("initial")
        },
        requestTemplates: function (t) {
            var o = this,
                n = o.tabs[t];
            o.setFilter("category", !1), n.data.templates && n.data.categories ? o.layout.showTemplatesView(n.data.templates, n.data.categories, n.data.widgets, n.data.groups) : e.ajax({
                url: ajaxurl,
                type: "get",
                dataType: "json",
                data: {
                    action: "eead_get_templates",
                    nonce: i.nonce,
                    tab: t
                },
                success: function (e) {
                    if (!e || !e.success || !e.data) {
                        return o.layout.showConnectionError()
                    }
                    var n = new a.LibraryCollection(e.data.templates),
                        i = new a.CategoriesCollection(e.data.categories),
                        g = new a.GroupsCollection(e.data.groups || []);
                    o.tabs[t].data = {
                        templates: n,
                        categories: i,
                        widgets: e.data.widgets,
                        groups: g
                    }, o.layout.showTemplatesView(n, i, e.data.widgets, g)
                },
                error: function (e) {
                    o.layout.showConnectionError()
                }
            })
        },
        showGroups: function () {
            var b = this.layout.getContentView();
            this.channels.templates.reply("filter:group", ""), b.$el.removeClass("eead-in-group"), b.contentGroupHead.empty(), b.contentTemplates.show(new a.GroupsCollectionView({
                collection: this.collections.groups
            }))
        },
        openGroup: function (g) {
            var b = this.layout.getContentView();
            this.channels.templates.reply("filter:group", g.get("slug")), b.$el.addClass("eead-in-group"), b.contentGroupHead.show(new a.GroupHeadView({
                model: g
            })), b.contentTemplates.show(new a.ModalCollectionView({
                collection: this.tabs[this.getTab()].data.templates
            })), b.$(".eead-templates-list").scrollTop(0)
        },
        showImport: function (g) {
            var b = this.layout.getContentView();
            b.contentTemplates.show(new a.ImportView({
                group: g,
                model: new Backbone.Model({
                    name: g.get("name"),
                    pages: _.map(this.groupPages(), this.pageLabel)
                })
            }))
        },
        // "The Harbour – Rooms" is the page "Rooms".
        pageLabel: function (m) {
            var l = m.get("title").split(" – ");
            return l.length > 1 ? l.slice(1).join(" – ") : l[0]
        },
        // Copies the saved templates a page's tabs, switchers or toggles show.
        copyDependencies: function (m) {
            var map = {},
                deps = _.filter(_.values(m.get("dependencies") || {}), function (d) {
                    return "elementor_library" === d.type && d.template_id
                });
            return e.when.apply(e, _.map(deps, function (d) {
                return e.ajax({
                    url: ajaxurl,
                    type: "post",
                    dataType: "json",
                    data: {
                        action: "eead_import_dependency",
                        nonce: i.nonce,
                        source: d.source,
                        template_id: d.template_id,
                        title: d.title,
                        tab: t.getTab()
                    }
                }).then(function (res) {
                    res && res.success && res.data && res.data.id && (map[d.template_id] = res.data.id)
                }, function () {
                    return e.Deferred().resolve()
                })
            })).then(function () {
                return map
            })
        },
        // Pages of the open group, home page first.
        groupPages: function () {
            var g = this.getFilter("group"),
                d = this.tabs[this.getTab()] && this.tabs[this.getTab()].data;
            return g && d && d.templates ? _.sortBy(d.templates.where({
                group: g
            }), function (m) {
                return m.get("order")
            }) : []
        },
        showPreviewNav: function (h, m) {
            var p = this.groupPages(),
                i = p.indexOf(m);
            if (p.length < 2 || i < 0) {
                return h.headerTabs.empty()
            }
            h.headerTabs.show(new a.PreviewNavView({
                model: new Backbone.Model({
                    label: this.pageLabel(m),
                    index: i,
                    total: p.length
                })
            }))
        },
        stepPreview: function (n) {
            var p = this.groupPages(),
                m = p[p.indexOf(this.getPreview()) + n];
            m && this.setPreview(m)
        },
        closeModal: function () {
            this.getModal().hide()
        },
        getModal: function () {
            return this.modal || (this.modal = elementor.dialogsManager.createWidget("lightbox", {
                id: "eead-modal-template",
                className: "elementor-templates-modal",
                closeButton: !1
            })), this.modal
        }
    }, e(window).on("elementor:init", t.init)
}(jQuery);