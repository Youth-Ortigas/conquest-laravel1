$(document).ready(function () {

    var oModulePuzzles = {

        /**
         * Initializes the puzzle module.
         */
        init: function () {
            this.loadProperties();
            this.handleSubmission();
            this.setupTranslationListener();
        },

        /**
         * Loads selectors and configuration properties.
         */
        loadProperties: function () {
            this.classKeyButton = '#btn-key-send';
            this.classKeyInput = 'input[name="puzzle_code"]';
            this.DOMClassKeyButton = $(this.classKeyButton);
            this.csrfToken = $('meta[name="csrf-token"]').attr('content');
            this.puzzleNum = 2.3;
            this.classTranslateButton = '#btn-translate-scripture';
        },

        /**
         * Handles translation button click and renders cipher result and wheel.
         */
        setupTranslationListener: function () {
            $(this.classTranslateButton).on('click', (e) => {
                e.preventDefault();

                const inputText = $('#plain-text').val().trim();
                const shiftValue = parseInt($('#shift').val(), 10) || 0;

                if (!inputText) {
                    $('#caesar-cipher').text('⚠️ Please enter text to translate.');
                    return;
                }

                const encrypted = this.generateCaesarCipher(inputText, shiftValue);
                $('#caesar-cipher').text(`Translated Text: ${encrypted} (FOR TEST ONLY)`);
                this.drawCipherWheel(shiftValue);
            });
        },

        /**
         * Handles the submission of the puzzle key input.
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
                ].map(letter => letter.toLowerCase());

                this.validatePuzzleKey(enteredKeys);
            });
        },

        /**
         * Sends the guessed key to the server for validation.
         */
        validatePuzzleKey: function (enteredKeys) {
            $.post("/validate-puzzle-key", {
                _token: this.csrfToken,
                puzzle_key: enteredKeys,
                puzzle_num: this.puzzleNum
            }, function (data) {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Puzzle Unlocked!',
                        html: '<p>Thou hast completed the stage 3!</p><p>Clicketh <strong>"Go Forth!"</strong> to embark upon thy next quest.</p>',
                        icon: 'success',
                        confirmButtonText: 'Go Forth!'
                    }).then(() => {
                        window.location.href = data.next_puzzle;
                    });
                } else {
                    Swal.fire({
                        title: 'Incorrect Answer',
                        text: data.message || 'Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            }).fail(function (error) {
                console.error("Validation error:", error);
            });
        },

        /**
         * Performs Caesar cipher translation on given text.
         */
        generateCaesarCipher: function (text, shift) {
            return text.split('').map(char => {
                if (char.match(/[a-z]/i)) {
                    const isUpper = char === char.toUpperCase();
                    const base = isUpper ? 'A'.charCodeAt(0) : 'a'.charCodeAt(0);
                    const shifted = ((char.charCodeAt(0) - base + shift) % 26 + 26) % 26;
                    return String.fromCharCode(base + shifted);
                } else {
                    return char;
                }
            }).join('');
        },

        /**
         * Draws a Caesar cipher wheel to visually represent the shift.
         */
        drawCipherWheel: function (shift) {
            const canvas = document.getElementById('cipher-wheel');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            const center = canvas.width / 2;
            const outerRadius = 135;
            const innerRadius = 100;
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.font = 'bold 25px Garamond, serif';

            // Outer ring – Plain letters
            for (let i = 0; i < 26; i++) {
                const angle = (i / 26) * 2 * Math.PI - Math.PI / 2;
                const x = center + outerRadius * Math.cos(angle);
                const y = center + outerRadius * Math.sin(angle);
                ctx.fillStyle = '#000';
                ctx.fillText(alphabet[i], x, y);
            }

            // Inner ring – Shifted letters
            for (let i = 0; i < 26; i++) {
                const angle = (i / 26) * 2 * Math.PI - Math.PI / 2;
                const x = center + innerRadius * Math.cos(angle);
                const y = center + innerRadius * Math.sin(angle);
                const shiftedChar = alphabet[(i + shift) % 26];
                ctx.fillStyle = '#a52a2a';
                ctx.fillText(shiftedChar.toLowerCase(), x, y);
            }

            // Center label
            ctx.fillStyle = '#333';
            ctx.font = '15px Garamond, serif';
            ctx.fillText('PLAIN TEXT', center, center - 12);
            ctx.fillText('cipher text', center, center + 6);
        }

    };

    oModulePuzzles.init();

});
