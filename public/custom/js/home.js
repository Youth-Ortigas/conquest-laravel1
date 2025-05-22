/**
 * [Home] Module Class (e.g. home)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Apr 1, 2025
 */
$(document).ready(function () {

    /**
     * [Module] Home Instance
     */
    var oModuleHome = {
        /**
         * Initialize module
         */
        init: function () {
            this.runSlider();
        },

        runSlider: function() {
            let hasReachedVideo = false;
            $("#slider").responsiveSlides({
                auto: true,
                pager: false,
                nav: false,
                speed: 400,
                timeout: 2000, // 2 seconds on image
                namespace: "rslides",
                before: function () {},
                after: function (index) {
                    if (index === 1 && !hasReachedVideo) {
                        hasReachedVideo = true;
                        const intervalId = window.setInterval(function () {}, 9999);
                        for (let counterIndex = 0; counterIndex < intervalId; counterIndex++) {
                            clearInterval(counterIndex);
                        }
                        $('.rslides').off('mouseenter mouseleave');
                    }
                }
            });
        },
    }

    oModuleHome.init();
});
