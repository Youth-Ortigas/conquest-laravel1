/**
 * [Puzzles] Module Class (e.g. puzzles/1st)
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
            this.classKeyInput = 'input[name="puzzle_1st_code"]';
            this.classKeyButton = '#btn-puzzle-send';

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

        /**
         * [1st Puzzle - General] Validate puzzle key
         * @param oElementButton
         * @param oElementInput
         */
        validatePuzzleKey: function(enteredKey) {
            fetch("../custom/js/assets/puzzlekey.json")
                .then(response => response.json())
                .then(data => {
                    var validKey = false;
                    if (Object.keys(data).length > 0) {
                        validKey = data.find(entry =>
                            entry.puzzle_key === enteredKey
                        );
                    }

                    if (validKey) {
                        Swal.fire({
                            title: 'Puzzle unlocked!',
                            text: 'Click Cool! to go to next puzzle',
                            icon: 'success',
                            confirmButtonText: 'Cool!'
                        }).then((result) => {
                            window.open(
                                "/puzzles/2nd",
                                '_blank'
                            );
                        });
                    } else {
                        Swal.fire({
                            title: 'You\'re almost there!',
                            text: 'You can do it! Try again',
                            icon: 'error',
                            confirmButtonText: 'G!'
                        });
                    }
                })
                .catch(error => console.error("Error loading puzzle keys:", error));
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
