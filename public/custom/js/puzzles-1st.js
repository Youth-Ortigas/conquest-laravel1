/**
 * [Puzzles] Module Class (e.g. puzzles/1st)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Apr 1, 2025
 */
function downloadImage() {
    const imageUrl = "/images/conquestclue.jpg";
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = 'conquestclue.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

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
         * Initialize module
         */
        init: function () {
            this.showLoading();
            this.loadProperties();
            this.enterKey(this.DOMClassKeyButton, this.DOMClassKeyInput);
            this.generateVigenereTable();
            this.restoreGameState();
            this.saveGameState();
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
         * [1st Puzzle - General] Validate puzzle key
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
                    if(data.next_puzzle) {
                        Swal.fire({
                            title: 'Puzzle Unlocked!',
                            html: '<p>Thou hast conquered the Vigenère puzzle!</p><p>Click <strong>Go Forth!</strong> to journey to the second puzzle.</p>',
                            icon: 'success',
                            confirmButtonText: 'Go Forth!',
                            cancelButtonText: 'Submit Group Photo',
                            showCancelButton: true,
                        }).then((result) => {
                            if(result.isConfirmed) 
                                window.location.href = data.next_puzzle;
                            else
                                location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Alas, the Game is Over!',
                            text: `Thou hast conquered the Vigenère puzzle!`,
                            icon: 'info',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            confirmButtonText: 'View Results',
                            footer: '<strong>Pray, wait for the next puzzle to be unlocked.</strong>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
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
                    if(!$inputField.is(':disabled')) {
                        $td.on("click", function () {
                            $inputField.val($inputField.val() + $(this).text()); // Append clicked letter
                        });
                    }

                    $row.append($td);
                }

                $table.append($row);
            }
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
