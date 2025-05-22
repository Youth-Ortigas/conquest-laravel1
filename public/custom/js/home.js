/**
 * [Home] Module Class (e.g. home)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Apr 1, 2025
 */
$(document).ready(function () {
    let zoomLevel = 1;

    // $(document).on('contextmenu', function (e) {
    //     e.preventDefault();
    // });

    $(document).on('keydown', function (e) {
        if (e.keyCode === 123 || // F12
            (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || // Ctrl+Shift+I/J
            (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83))) { // Ctrl+U/S
            e.preventDefault();
        }
    });

    $(".zoomable-image").click(function (event) {
        if (zoomLevel === 1) {
            zoomLevel = 2;
        } else if (zoomLevel === 2) {
            zoomLevel = 4;
        } else if (zoomLevel === 4) {
            zoomLevel = 6;
        } else if (zoomLevel === 6) {
            zoomLevel = 8;
        } else {
            zoomLevel = 1;
        }

        let rect = this.getBoundingClientRect();
        let offsetX = event.clientX - rect.left;
        let offsetY = event.clientY - rect.top;

        let percentX = (offsetX / rect.width) * 100;
        let percentY = (offsetY / rect.height) * 100;

        $(this).css({
            "transform": `scale(${zoomLevel})`,
            "transform-origin": `${percentX}% ${percentY}%`
        });
    });

    $(".zoom-reset").click(function () {
        zoomLevel = 1;
        $(".zoomable-image").css({
            "transform": "scale(1)",
            "transform-origin": "center center"
        });
    });

    /**
     * [Module] Puzzles Instance
     */
    var oModuleHome = {
        /**
         * Initialize module
         */
        init: function () {
            this.loadProperties();
            this.runSlider();
        },

        /**
         * Load properties
         */
        loadProperties: function () {
            this.classKeyInput = 'input[name="puzzle_code_1st"]';
            this.classKeyButton = '#btn-puzzle-send';

            this.DOMClassKeyInput = $(`${this.classKeyInput}`);
            this.DOMClassKeyButton = $(`${this.classKeyButton}`);
            this.mToken = $("input[name='_token']").val();
            this.isPuzzleComplete = false;
            this.puzzleNum = 1;
        },

        runSlider: function() {
            $(".rslides").responsiveSlides({
                auto: true,             // Boolean: Animate automatically, true or false
                speed: 500,            // Integer: Speed of the transition, in milliseconds
                timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
                pager: false,           // Boolean: Show pager, true or false
                nav: false,             // Boolean: Show navigation, true or false
                random: false,          // Boolean: Randomize the order of the slides, true or false
                pause: false,           // Boolean: Pause on hover, true or false
                pauseControls: true,    // Boolean: Pause when hovering controls, true or false
                prevText: "Previous",   // String: Text for the "previous" button
                nextText: "Next",       // String: Text for the "next" button
                maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
                navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
                manualControls: "",     // Selector: Declare custom pager navigation
                namespace: "rslides",   // String: Change the default namespace used
                before: function(){},   // Function: Before callback
                after: function(){}     // Function: After callback
            });
        },
    }

    oModuleHome.init();
});
