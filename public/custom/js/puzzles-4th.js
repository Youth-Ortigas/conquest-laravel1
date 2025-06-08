$(document).ready(function () {
    const $puzzles = $('.puzzle-available-in');

    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        return (
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(secs).padStart(2, '0')
        );
    }

    $puzzles.each(function () {
        const $countdown = $(this);
        let totalSeconds = parseInt($countdown.data('seconds'));
        const $timerDisplay = $countdown.find('.puzzle-timer');

        const puzzleId = $countdown.attr('id')
            .replace('puzzle-', '')
            .replace('-available-in', '');
        const $button = $('#btn-puzzle-send');

        if (!isNaN(totalSeconds) && totalSeconds > 0) {
            $button.prop('disabled', true);
            $("#puzzle-code-input").prop('disabled', true);
            $timerDisplay.text(formatTime(totalSeconds));

            const interval = setInterval(() => {
                totalSeconds--;

                if (totalSeconds <= 0) {
                    clearInterval(interval);
                    $button.prop('disabled', false);
                    $("#puzzle-code-input").prop('disabled', false);
                    $("#puzzle-4-available-in").hide();
                } else {
                    $timerDisplay.text(formatTime(totalSeconds));
                }
            }, 1000);
        } else {
            $("#puzzle-4-available-in").hide();
            $("#puzzle-code-input").prop('disabled', false);
        }
    });

        /**
     * [Module] Puzzles Instance
     */
    var oModulePuzzles = {
        /**
         * Initialize module
         */
        init: function () {
            this.showLoading();
            this.loadProperties();
            this.enterKey(this.DOMClassKeyButton, this.DOMClassKeyInput);
            this.restoreGameState();
            this.saveGameState();
        },

        /**
         * Load properties
         */
        loadProperties: function () {
            this.classKeyInput = 'input[name="puzzle_code_4th"]';
            this.classKeyButton = '#btn-puzzle-send';

            this.DOMClassKeyInput = $(`${this.classKeyInput}`);
            this.DOMClassKeyButton = $(`${this.classKeyButton}`);
            this.mToken = $("input[name='_token']").val();
            this.isPuzzleComplete = false;
            this.puzzleNum = 4;
        },

        /**
         * [4th Puzzle - DOM Method] Enter key
         * @param oElementButton
         * @param oElementInput
         */
        enterKey: function (oElementButton, oElementInput) {
            var oThis = this;
            oElementButton.click(function (oEvent) {
                oEvent.preventDefault();
                var enteredKey = oThis.DOMClassKeyInput.val();
                oThis.validatePuzzleKey(enteredKey);
            });

            oElementInput.keypress(function(oEvent) {
                var codeEnter = 13;
                if (oEvent.which === codeEnter) {
                    oEvent.preventDefault();
                    var enteredKey = oThis.DOMClassKeyInput.val();
                    oThis.validatePuzzleKey(enteredKey);
                }
            });
        },

        restoreGameState: function () {
            $.get(`/puzzle-get-game-state/${this.puzzleNum}`, function (response) {
                if (response && response.game_state) {
                    const savedAnswer = response.game_state;

                    this.DOMClassKeyInput.val(savedAnswer)
                    Swal.close();
                } else if(response && response.status === 'complete') {
                    this.isPuzzleComplete = true
                    Swal.close();
                } else {
                    Swal.close();
                    console.warn('No saved game state found.');
                }
            }.bind(this));
        },

        saveGameState: function () {
            var oThis = this

            oThis.DOMClassKeyInput.on('blur', function () {
                if (!oThis.isPuzzleComplete) {
                    const input = $(this).val().trim().toLowerCase();

                    $.post('/puzzle-save-game-state', {
                        _token: oThis.mToken,
                        puzzle_num: oThis.puzzleNum,
                        game_state: JSON.stringify(input)
                    }).done(function (response) {
                        console.log(response)
                        if (response.status !== 'success') {
                            console.error('Failed to save game state');
                        }
                    });
                }
            });
        },

        /**
         * [4th Puzzle - General] Validate puzzle key
         * @param enteredKey
         */
        validatePuzzleKey: function (enteredKey) {
            let oThis = this
            $.post("/validate-puzzle-key", {
                _token: $('meta[name="csrf-token"]').attr('content'),
                puzzle_key: enteredKey,
                puzzle_num: oThis.puzzleNum
            }, function(data) {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Alas, the Game is Over!',
                        text: `Thou hast conquered the final puzzle!`,
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        confirmButtonText: 'View Results',
                        footer: '<strong>Pray and be ready for the main quests. <br> ENJOY THE CONQUEST YOUTH CAMP!!</strong>'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Thou art near!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Persevere!'
                    });
                }
            }).fail(function(error) {
                console.error("Error validating puzzle key:", error);
            });
        },

        showLoading: function () {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we prepare your puzzle.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

    }

    oModulePuzzles.init();
});
