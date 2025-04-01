/**
 * [Puzzles] Module Class (e.g. puzzles/2nd)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Apr 1, 2025
 */
$(document).ready(function () {

    /**
     * [Module] Puzzles Instance
     */
    var oModulePuzzles = {

        /**
         * Load properties
         */
        loadProperties: function () {
            this.classKeyInput = 'input[name="puzzle_code_2nd"]';
            this.classKeyButton = '#btn-key-send';

            this.WORD = "QUEST";
            this.MAX_ATTEMPTS = 6;
            this.attempts = 0;

            this.DOMClassKeyInput = $(`${this.classKeyInput}`);
            this.DOMClassKeyButton = $(`${this.classKeyButton}`);
            this.mToken = $("input[name='_token']").val();
        },

        /**
         * Initialize module
         */
        init: function () {
            this.loadProperties();
            this.enterKey(this.DOMClassKeyButton, this.DOMClassKeyInput);
        },

        /**
         * [1st Puzzle - DOM Method] Enter key
         * @param oElementButton
         * @param oElementInput
         */
        enterKey: function (oElementButton, oElementInput) {
            var oThis = this;
            oElementButton.click(function (oEvent) {
                oEvent.preventDefault();
                var guess = oThis.DOMClassKeyInput.val();
                oThis.validatePuzzleGuess(guess);
            });

            oElementInput.keypress(function(oEvent) {
                var codeEnter = 13;
                if (oEvent.which === codeEnter) {
                    oEvent.preventDefault();
                    var guess = oThis.DOMClassKeyInput.val();
                    oThis.validatePuzzleGuess(guess);
                }
            });
        },

        /**
         * [1st Puzzle - General] Validate puzzle key
         * @param guess
         */
        validatePuzzleGuess: function(guess) {
            var guessFormat = guess.toUpperCase();
            if (guessFormat.length !== this.WORD.length) {
                Swal.fire({
                    title: 'You\'re almost there!',
                    text: "Guess must be exactly " + this.WORD.length + " letters long.",
                    icon: 'error',
                    confirmButtonText: 'Alright'
                });

                return;
            }

            let result = [];
            for (let counterIndex = 0; counterIndex < this.WORD.length; counterIndex++) {
                if (guessFormat[counterIndex] === this.WORD[counterIndex]) {
                    result.push("🟩"); // Correct letter and position
                } else if (this.WORD.includes(guessFormat[counterIndex])) {
                    result.push("🟨"); // Correct letter, wrong position
                } else {
                    result.push("⬜"); // Incorrect letter
                }
            }

            if (guessFormat === this.WORD) {
                Swal.fire({
                    title: "🎉 Congratulations! You guessed the word correctly! Click Awesome! to go to next puzzle",
                    confirmButtonText: "Awesome",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.open(
                            "/puzzles/3rd",
                            '_blank'
                        );
                    }
                });

                return;
            }

            this.attempts++;
            if (this.attempts >= this.MAX_ATTEMPTS) {
                localStorage.setItem("ELIMINATED", "true");
                Swal.fire({
                    title: 'You\'re almost there!',
                    text: "❌ Game Over! The correct word was: " + this.WORD,
                    icon: 'error',
                    confirmButtonText: 'Alright'
                });

                return;
            }

            var countAttempts = this.attempts;
            Swal.fire({
                title: 'You\'re almost there!',
                text: `❌ Incorrect guess! Number of attempts: ${countAttempts}`,
                icon: 'error',
                confirmButtonText: 'Alright'
            });

            return;
        },

        callResourceViaAjax: function(sAjaxUrl, oAssignData, sMethod) {
            var oThis = this;
            return new Promise(function(oResolve, oReject) {
                $.ajaxSetup({
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': oThis.mToken
                    }
                });

                $.ajax({
                    url: sAjaxUrl,
                    type: sMethod,
                    data: oAssignData,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        oResolve(data);
                    },
                    error: function (oError) {
                        oReject(oError);
                    }
                });
            });
        },

        checkIfHasValue: function(mValue) {
            switch (typeof mValue) {
                case "string":
                    return mValue.trim().length > 0

                case "object":
                    return Object.keys(mValue).length > 0

                case "undefined" :
                    return false;

                case 'boolean':
                case 'bigint':
                case 'number':
                    return mValue < 0

                default:
                    return mValue.trim().length > 0
            }
        }

    }

    oModulePuzzles.init();
});
