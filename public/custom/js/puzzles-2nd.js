$(document).ready(function () {
    var oModulePuzzles = {
        /**
         * Initializes the game by loading properties, fetching words,
         * setting up input navigation, and handling submission.
         */
        init: function () {
            this.loadProperties();
            this.fetchWords();
            this.loadGameState();
            this.handleInputNavigation();
            this.handleSubmission();
        },

        /**
         * Initializes the game properties and settings.
         */
        loadProperties: function () {
            this.classKeyButton = '#btn-key-send';
            this.WORDS = [];
            this.WORD = "";
            this.MAX_ATTEMPTS = 6;
            this.attempts = 0;
            this.currentRow = 0;
            this.grid = $('#grid');
            this.DOMClassKeyButton = $(this.classKeyButton);
            this.csrfToken = $('meta[name="csrf-token"]').attr('content');
            this.isCorrect = 0;
            this.userId = 1;
            this.puzzleNum = 2.1;
        },

        /**
         * Loads the saved game state from localStorage.
         */
        loadGameState: function () {
            $.get(`/puzzle-get-game-state/${this.userId}/${this.puzzleNum}`, (data) => {
                if (data && data.game_state) {
                    let savedState = data.game_state;

                    this.attempts = savedState.attempts;
                    this.currentRow = savedState.currentRow;
                    this.WORD = savedState.word;
                    this.WORDS = savedState.words || [];
                    this.grid.html(savedState.gridHTML);

                    this.updateGridState(savedState.guesses || []);
                    this.applyInputEventListeners();

                    if (this.attempts <= 6) {
                        Swal.fire({
                            title: `Welcome Back`,
                            text: `You’ve made ${this.attempts} of 6 guesses. Keep it up!`,
                            icon: 'info',
                            confirmButtonText: 'OK'
                        })
                    }
                } else {
                    this.showHowToPlay();
                }

                $('html, body').animate({
                    scrollTop: $('#page_content_wrap').offset().top
                }, 500);
            }).fail(() => {
                console.error('Failed to load game state.');
            });
        },

        /**
         * Saves the current game state to localStorage.
         */
        saveGameState: function () {
            let gameState = {
                attempts: this.attempts,
                currentRow: this.currentRow,
                word: this.WORD,
                words: this.WORDS,
                gridHTML: this.grid.html(),
                guesses: this.getGuesses(),
                isCorrect: this.isCorrect
            };

            $.post('/puzzle-save-game-state', {
                _token: this.csrfToken,
                user_id: this.userId,
                puzzle_num: this.puzzleNum,
                game_state: JSON.stringify(gameState)
            }, function (response) {
                console.log('Game state saved successfully.');
            }).fail(function () {
                console.error('Error saving game state.');
            });
        },

        /**
         * Updates the grid based on the guesses stored in the game state.
         * @param {Array} guesses - List of guesses.
         */
        updateGridState: function (guesses) {
            for (let rowIdx = 0; rowIdx < guesses.length; rowIdx++) {
                let guess = guesses[rowIdx];
                let currentInputs = this.grid.find('.row').eq(rowIdx).find('.letter-box');

                // Convert the string guess to an array to use forEach
                Array.from(guess).forEach((letter, idx) => {
                    currentInputs.eq(idx).val(letter).prop('disabled', true);
                });
            }
        },

        /**
         * Retrieves the guesses made so far.
         * @returns {Array} - List of guesses.
         */
        getGuesses: function () {
            let guesses = [];
            for (let i = 0; i < this.MAX_ATTEMPTS; i++) {
                let currentInputs = this.grid.find('.row').eq(i).find('.letter-box');
                let guess = currentInputs.map(function () { return $(this).val(); }).get().join('');
                if (guess) guesses.push(guess);
            }
            return guesses;
        },

        /**
         * Fetch words from the backend and start the first round.
         */
        fetchWords: function () {
            $.post('/puzzle-wordle-get-word', {_token: this.csrfToken}, (data) => {
                if (data.status === 'success') {
                    this.startNewRound();
                } else if(data.status === 'complete') {
                    Swal.fire('Game Over!', 'You have completed all rounds!', 'info');
                    this.grid.empty();
                    this.DOMClassKeyButton.addClass('d-none');
                } else {
                    Swal.fire('Error', 'No puzzle words found!', 'error');
                }
            }).fail(() => {
                Swal.fire('Error', 'Failed to fetch puzzle words!', 'error');
            });
        },

        /**
         * Starts a new round by selecting the next word and resetting the grid.
         */
        startNewRound: function() {
            this.DOMClassKeyButton.removeClass('d-none');
            if (!this.savedState) {  // Only generate grid if there's no saved state
                this.attempts = 0;
                this.currentRow = 0;
                this.generateGrid();
            } else {
                // If there's a saved state, restore the saved grid state
                this.attempts = this.savedState.attempts;
                this.currentRow = this.savedState.currentRow;
                this.updateGridState(this.savedState.guesses);  // Restore the guesses on the grid

                // Enable input for the current row
                let nextRowInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
                nextRowInputs.prop("disabled", false);
                nextRowInputs.first().focus();
            }
        },

        /**
         * Generates a grid of input fields where the player enters guesses.
         */
        generateGrid: function () {
            this.grid.empty(); // Clear any existing grid
            for (let i = 0; i < this.MAX_ATTEMPTS; i++) {
                let row = $('<div>', { class: 'row' });
                for (let j = 0; j < 5; j++) {
                    let input = $('<input>', {
                        type: 'text',
                        maxlength: 1,
                        class: 'letter-box',
                        disabled: i !== 0
                    });
                    row.append(input);
                }
                this.grid.append(row);
            }

            this.applyInputEventListeners();
        },

        /**
         * Attaches input and keydown event listeners to letter-box inputs.
         */
        applyInputEventListeners: function () {
            this.grid.find('.letter-box').each(function () {
                $(this).off('input keydown');
                $(this).on('input', function () {
                    $(this).val($(this).val().toUpperCase());
                    if ($(this).val() && $(this).next('.letter-box').length) {
                        $(this).next().focus();
                    }
                }).on('keydown', function (e) {
                    if (e.key === "Backspace" && !$(this).val() && $(this).prev('.letter-box').length) {
                        $(this).prev().focus();
                    }
                });
            });
        },

        /**
         * Handles input navigation and submission using the Enter key.
         */
        handleInputNavigation: function () {
            $(document).on('keypress', '.letter-box', function (e) {
                if (e.which === 13) { // Enter key
                    e.preventDefault();
                    oModulePuzzles.validatePuzzleGuess();
                }
            });
        },

        /**
         * Handles submission of the word guess using the button click.
         */
        handleSubmission: function () {
            this.DOMClassKeyButton.click((e) => {
                e.preventDefault();
                this.validatePuzzleGuess();
            });
        },

        /**
         * Validates the user's guess by checking against the backend.
         */
        validatePuzzleGuess: function () {
            let currentInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
            let guess = currentInputs.map(function () { return $(this).val(); }).get().join('');

            if (guess.length !== 5) {
                Swal.fire('Incomplete Guess!', 'You must fill all 5 letters before submitting.', 'error');
                return;
            }

            $.post('/puzzle-wordle-check-guess', {
                _token: this.csrfToken,
                guess: guess
            }, (response) => {
                if (!response.feedback || response.feedback.length !== 5) {
                    Swal.fire('Error!', 'Invalid feedback received. Please try again.', 'error');
                    return;
                }

                let correctCount = 0;

                for (let i = 0; i < 5; i++) {
                    if (response.feedback[i] === 'correct') {
                        $(currentInputs[i]).addClass("correct");
                        correctCount++;
                    } else if (response.feedback[i] === 'present') {
                        $(currentInputs[i]).addClass("present");
                    } else {
                        $(currentInputs[i]).addClass("absent");
                    }
                }

                if (correctCount === 5) {
                    this.isCorrect = 1;

                    Swal.fire('🎉 Congratulations!', 'You guessed the word correctly!', 'success').then(() => {
                        this.fetchWords();
                    });
                } else {
                    this.isCorrect = 0;
                    this.attempts++;
                    this.currentRow++;
                    if (this.attempts >= this.MAX_ATTEMPTS) {
                        Swal.fire('Game Over!', 'Try again!', 'error').then(() => {
                            this.fetchWords();
                        });
                    } else {
                        let nextRowInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
                        nextRowInputs.prop("disabled", false);
                        nextRowInputs.first().focus();
                    }
                }

                this.saveGameState();
            }).fail(() => {
                Swal.fire('Server Error', 'Could not validate your guess. Please try again.', 'error');
            });
        },

        showHowToPlay: function () {
            Swal.fire({
                title: 'How to Play',
                html: `
                    <div class="how-to-play">
                        <p>Guess the Wordle in 6 tries.</p>
                        <ul>
                            <li>Each guess must be a valid 5-letter word.</li>
                            <li>The color of the tiles will change to show how close your guess was to the word.</li>
                        </ul>
                        <p><b>Examples</b></p>
                        <div class="boxes d-flex">
                            <div class="box correct">M</div>
                            <div class="box">O</div>
                            <div class="box">S</div>
                            <div class="box">E</div>
                            <div class="box">S</div>
                        </div>
                        <p><b>M</b> is in the word and in the correct spot.</p>
                        <div class="boxes d-flex">
                            <div class="box">D</div>
                            <div class="box present">A</div>
                            <div class="box">V</div>
                            <div class="box">I</div>
                            <div class="box">D</div>
                        </div>
                        <p><b>A</b> is in the word but in the wrong spot.</p>
                        <div class="boxes d-flex">
                            <div class="box">J</div>
                            <div class="box">O</div>
                            <div class="box">H</div>
                            <div class="box absent">N</div>
                            <div class="box">S</div>
                        </div>
                        <p><b>N</b> is not in the word in any spot.</p>
                    </div>
                `,
                confirmButtonText: 'Got it!',
                customClass: {
                    popup: 'how-to-popup',
                    title: 'how-to-title',
                    htmlContainer: 'how-to-html',
                }
            })
        }
    };

    oModulePuzzles.init();
});
