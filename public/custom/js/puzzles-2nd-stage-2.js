$(document).ready(function () {

    var oModulePuzzles = {

        /**
         * Initializes the game by loading properties, fetching words,
         * setting up input navigation, and handling submission.
         */
        init: function () {
            this.loadProperties();
            this.handleSubmission();
        },

        /**
         * Initializes the game properties and settings.
         */
        loadProperties: function () {
            this.classKeyButton = '#btn-key-send';
            this.DOMClassKeyButton = $(this.classKeyButton);
            this.csrfToken = $('meta[name="csrf-token"]').attr('content');
            this.puzzleNum = 2.2;
        },

        /**
         * Handles submission of the word guess using the button click.
         */
        handleSubmission: function () {
            this.DOMClassKeyButton.click((e) => {
                e.preventDefault();

                const enteredKeys = [
                    $('#puzzle-code-input-1').val().trim(),
                    $('#puzzle-code-input-2').val().trim(),
                    $('#puzzle-code-input-3').val().trim(),
                    $('#puzzle-code-input-4').val().trim(),
                    $('#puzzle-code-input-5').val().trim()
                ];

                this.validatePuzzleKey(enteredKeys);
            });
        },

        validatePuzzleKey: function (enteredKeys) {
            $.post("/validate-puzzle-key", {
                _token: this.csrfToken,
                puzzle_key: enteredKeys,
                puzzle_num: this.puzzleNum
            }, function(data) {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Puzzle Unlocked!',
                        html: '<p>Thou hast completed the stage 2!</p><p>Clicketh <strong>"Go Forth!"</strong> to embark upon thy next quest.</p>',
                        icon: 'success',
                        confirmButtonText: 'Go Forth!'
                    }).then(() => {
                        window.location.href = data.next_puzzle;
                    });
                } else {
                    Swal.fire({
                        title: 'You\'re almost there!',
                        text: data.message || 'Try again',
                        icon: 'error',
                        confirmButtonText: 'G!'
                    });
                }
            }).fail(function(error) {
                console.error("Error validating puzzle key:", error);
            });
        },
    };

    oModulePuzzles.init();
});
