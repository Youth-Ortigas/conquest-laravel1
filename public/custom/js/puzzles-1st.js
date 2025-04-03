/**
 * [Puzzles] Module Class (e.g. puzzles/1st)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Apr 1, 2025
 */
$(document).ready(function () {
    let zoomLevel = 1;

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
    var oModulePuzzles = {

        /**
         * Load properties
         */
        loadProperties: function () {
            this.classKeyInput = 'input[name="puzzle_code_1st"]';
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
            this.generateVigenereTable();
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
         * @param enteredKey
         */
        validatePuzzleKey: function (enteredKey) {
            fetch("/validate-puzzle-key", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ puzzle_key: enteredKey, puzzle_num: 1 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Puzzle unlocked!',
                        text: 'Click Cool! to go to next puzzle',
                        icon: 'success',
                        confirmButtonText: 'Cool!'
                    }).then(() => {
                        window.open(data.next_puzzle, '_blank');
                    });
                } else {
                    Swal.fire({
                        title: 'You\'re almost there!',
                        text: data.message || 'Try again',
                        icon: 'error',
                        confirmButtonText: 'G!'
                    });
                }
            })
            .catch(error => console.error("Error validating puzzle key:", error));
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
        },

        generateVigenereTable: function () {
            const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const $table = $("#vigenereTable");
            const $inputField = $("#puzzle-code-input"); // Medieval input field

            // Create header row
            let $headerRow = $("<tr>").append("<th class='key-header'></th>"); // Empty top-left corner cell
            for (let i = 0; i < 26; i++) {
                $headerRow.append($("<th>").text(alphabet[i]));
            }
            $table.append($headerRow);

            // Create table rows
            for (let i = 0; i < 26; i++) {
                let $row = $("<tr>");

                // Row header (Key letters)
                let $th = $("<th>").addClass("key-header").text(alphabet[i]);
                $row.append($th);

                // Row content
                let shiftedAlphabet = alphabet.slice(i) + alphabet.slice(0, i);
                for (let j = 0; j < 26; j++) {
                    let $td = $("<td>").text(shiftedAlphabet[j]);

                    // Add Click Event to Insert Letter into Input
                    $td.on("click", function () {
                        $inputField.val($inputField.val() + $(this).text()); // Append clicked letter
                    });

                    $row.append($td);
                }

                $table.append($row);
            }
        }

    }

    oModulePuzzles.init();
});
