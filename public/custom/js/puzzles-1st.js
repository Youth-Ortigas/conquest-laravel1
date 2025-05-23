/**
 * [Puzzles] Module Class (e.g. puzzles/1st)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Apr 1, 2025
 */
$(document).ready(function () {
    let zoomLevel = 1;

    $(document).on('contextmenu', function (e) {
         e.preventDefault();
        showMessage();
    });

    $(document).on('keydown', function (e) {
        if (
            e.keyCode === 123 || // F12
            (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || // Ctrl+Shift+I/J
            (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83 || e.keyCode === 67 || e.keyCode === 86)) // Ctrl+U/S/C/V
        ) {
            e.preventDefault();
            showMessage();
        }
    });

    function showMessage() {
        const verses = [
            "Proverbs 11:1 — A false balance is an abomination to the Lord, but a just weight is his delight.",
            "Proverbs 5:21 — For a man's ways are before the eyes of the Lord, and he ponders all his paths.",
            "James 3:17 — But the wisdom from above is first pure, then peaceable, gentle, open to reason, full of mercy and good fruits, impartial and sincere.",
            "Proverbs 11:3 — The integrity of the upright guides them, but the crookedness of the treacherous destroys them."
        ];

        const titles = [
            "God is watching You",
            "He Sees All Things",
            "Walk in the Light",
            "Live with Integrity",
            "Every Action Matters",
            "Nothing Is Hidden",
            "Choose What Is Right",
            "Let Your Conscience Speak",
            "Guided by Truth"
        ];
        Swal.fire({
            icon: 'warning',
            title: titles[Math.floor(Math.random() * titles.length)],
            text: verses[Math.floor(Math.random() * verses.length)],
            confirmButtonText: 'Understood',
            confirmButtonColor: '#3085d6'
        });
    }

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
                            confirmButtonText: 'Go Forth!'
                        }).then(() => {
                            window.location.href = data.next_puzzle;
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
                        }).then(() => {
                            oThis.DOMClassKeyInput.prop('disabled', true);
                            oThis.DOMClassKeyButton.remove();
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
