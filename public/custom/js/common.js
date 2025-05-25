/**
 * [Common] Module Class
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 23, 2025
 */
window.jQuery(document).ready(function () {

    /**
     * [Module] Home Instance
     */
    var oModuleCommon = {

        /**
         * Initialize module
         */
        init: function () {
            this.setMobileMenu();
            this.toggleUpdatesMobile();
        },

        setMobileMenu: function() {
            var DOMMenuMobileFullScreen = window.jQuery('.menu_mobile_fullscreen');
            window.jQuery(".trx_addons_icon-menu").click(function(event) {
                if (DOMMenuMobileFullScreen.hasClass("opened") !== true) {
                    DOMMenuMobileFullScreen.addClass("opened");
                }
            });

            window.jQuery(".menu_mobile_close").click(function(event) {
                if (DOMMenuMobileFullScreen.hasClass("opened")) {
                    DOMMenuMobileFullScreen.removeClass("opened");
                }
            });
        },

        toggleUpdatesMobile: function() {
            window.jQuery("#btn-step-to-thy-conquest").show();
            window.jQuery("header.top_panel_custom_header-home").css({
                "height": "100px"
            });
            window.jQuery("#frm-login").css({
                "width": "50%"
            });
            window.jQuery('<style>')
                .prop('type', 'text/css')
                .html(`
                    .welcome-title::after { top: initial !important; }
                `)
                .appendTo('head');

            if (/Android|webOS|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                window.jQuery("#btn-step-to-thy-conquest").hide();

                window.jQuery("header.top_panel_custom_header-home").css({
                    "height": "50px"
                });

                window.jQuery("#frm-login").css({
                    "width": "100%"
                });

                window.jQuery('<style>')
                    .prop('type', 'text/css')
                    .html(`
                        .welcome-title::after { top: 50% !important; }
                    `)
                    .appendTo('head');

                window.jQuery('<style>')
                    .prop('type', 'text/css')
                    .html(`
                    .common-paragraph { font-size: 14px !important; }
                `)
                    .appendTo('head');

                window.jQuery("#div-design-flag .wbp_reference_only").removeClass("flex-container");
            }
        },
    }

    oModuleCommon.init();
});
