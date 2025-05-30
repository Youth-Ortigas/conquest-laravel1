$(document).ready(function () {
    //$(document).on('contextmenu', function (e) {
      //  e.preventDefault();
    //});

    $(document).on('keydown', function (e) {
        if (e.keyCode === 123 || // F12
            (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || // Ctrl+Shift+I/J
            (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83))) { // Ctrl+U/S
            e.preventDefault();
        }
    });

    var oModulePuzzles = {

        /**
         * Initializes the game by loading properties, fetching words,
         * setting up input navigation, and handling submission.
         */
        init: function () {
            this.showLoading();
            this.loadProperties();

            this.loadGameState()
                .then(() => {
                    this.fetchWords();
                })
                .catch(error => {
                    console.error(error);
                    this.fetchWords();
                });

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
            this.DOMShowGuessLoading = $("#guess-loading");
            this.csrfToken = $('meta[name="csrf-token"]').attr('content');
            this.isCorrect = 0;
            this.puzzleNum = 2;
            this.isPuzzleComplete = false;
            this.isSubmitting = false;
        },

        /**
         * Loads the saved game state from localStorage.
         */
        loadGameState: function () {
            return new Promise((resolve, reject) => {
                $.get(`/puzzle-get-game-state/${this.puzzleNum}`, (data) => {
                    if (data && data.game_state) {
                        let savedState = data.game_state;
                        this.savedState = savedState;
                        this.attempts = savedState.attempts;
                        this.currentRow = savedState.currentRow;
                        this.WORD = savedState.word;
                        this.WORDS = savedState.words || [];
                        this.grid.html(savedState.gridHTML);

                        this.updateGridState(savedState.guesses || []);
                        this.applyInputEventListeners();

                        if (this.attempts <= 6) {
                            Swal.fire({
                                title: `Welcome Back, Conqueror!`,
                                text: `Thou hast made ${this.attempts} of 6 guesses. Continue thy noble quest!`,
                                icon: 'info',
                                confirmButtonText: 'Understood',
                            }).then(() => {
                                this.focusToNextInput();
                            });
                        }
                        resolve(); // Finish successfully
                    } else if (data && data.status === 'complete') {
                        Swal.close();
                        this.isPuzzleComplete = true;
                        resolve(); // Still resolve to continue flow
                    } else {
                        this.scrollToGrid();
                        resolve();
                    }
                }).fail(() => {
                    console.error('Failed to load game state.');
                    reject('Failed to load game state.');
                });
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
            if(!this.isPuzzleComplete) {
                $.post('/puzzle-wordle-get-word', {_token: this.csrfToken}, (data) => {
                    if (data.status === 'success') {
                        this.startNewRound();

                        if(this.attempts == 0 && data.showHowToPlayGameAlert)
                            this.showHowToPlay();
                    } else if(data.status === 'complete') {
                        this.grid.empty();
                        this.DOMClassKeyButton.addClass('d-none');

                        if(data.next_puzzle) {
                            Swal.fire({
                                title: 'Puzzle Unlocked!',
                                html: '<p>Thou hast triumphed over the second puzzle (Wordle)!</p><p>Clicketh <strong>Go Forth!</strong> to embark upon thy next quest in puzzle 3.</p>',
                                icon: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
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
                                text: 'Thou hast completed all rounds!',
                                icon: 'info',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                confirmButtonText: 'View Results',
                                footer: '<strong>Pray, wait for the next puzzle to be unlocked.</strong>'
                            }).then(() => {
                                $("#words-left-h5").addClass('d-none')
                            });
                        }
                    } else {
                        Swal.fire('Error', 'No puzzle words found!', 'error');
                    }
                }).fail(() => {
                    Swal.fire('Error', 'Failed to fetch puzzle words!', 'error');
                });
            }
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
                Swal.close();
            } else {
                // If there's a saved state, restore the saved grid state
                this.attempts = this.savedState.attempts;
                this.currentRow = this.savedState.currentRow;
                this.updateGridState(this.savedState.guesses);
            }

            this.focusToNextInput();
        },

        /**
         * Generates a grid of input fields where the player enters guesses.
         */
        generateGrid: function () {
            this.grid.empty();
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
            let enterPressed = false;

            $(document).on('keypress', '.letter-box', function (e) {
                if (e.which === 13 && !enterPressed) { // Enter key
                    e.preventDefault();
                    enterPressed = true;
                    oModulePuzzles.validatePuzzleGuess();

                    setTimeout(() => {
                        enterPressed = false;
                    }, 1000);
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
            if (this.isSubmitting) return;
            this.isSubmitting = true;
            this.DOMShowGuessLoading.removeClass('d-none')

            let currentInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
            let guess = currentInputs.map(function () { return $(this).val(); }).get().join('').toLowerCase();
            currentInputs.prop('readonly', true);

            if (guess.length !== 5) {
                this.DOMShowGuessLoading.addClass('d-none')

                Swal.fire({
                    title: 'Incomplete Guess!',
                    text: 'Thou must fill all five letters before submitting.',
                    icon: 'error',
                    confirmButtonText: 'Understood'
                }).then(() => {
                    currentInputs.prop('readonly', false);
                    this.isSubmitting = false;
                });
                return;
            }

            // Check word validity using Dictionary API
            fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${guess}`)
                .then(response => {
                    if (response.ok) {
                        // Word is valid, proceed with submission
                        return this.submitGuess(guess, currentInputs);
                    } else if (response.status === 404) {
                        // Word is not found in dictionary
                        this.DOMShowGuessLoading.addClass('d-none')

                        Swal.fire({
                            title: 'Invalid Word!',
                            text: 'Thy word is not known in the common tongue. Try another.',
                            icon: 'error',
                            confirmButtonText: 'Understood'
                        }).then(() => {
                            currentInputs.prop('readonly', false);
                            this.isSubmitting = false;
                        });
                    } else {
                        return this.submitGuess(guess, currentInputs);
                    }
                })
                .catch(() => {
                    return this.submitGuess(guess, currentInputs);
                });

        },

        submitGuess: function (guess, currentInputs) {
            $.post('/puzzle-wordle-check-guess', {
                _token: this.csrfToken,
                guess: guess
            }, (response) => {
                this.DOMShowGuessLoading.addClass('d-none')

                if (!response.feedback || response.feedback.length !== 5) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Thy feedback is naught valid. Try again.',
                        icon: 'error',
                        confirmButtonText: 'Understood'
                    }).then(() => {
                        this.isSubmitting = false;
                    });
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
                    this.savedState = null;

                    Swal.fire({
                        title: '🎉 Thou hast Triumphed!',
                        text: 'Verily, thou hast guessed the word correctly!',
                        icon: 'success',
                        confirmButtonText: 'Huzzah!'
                    }).then(() => {
                        $("#remaining-words-to-guess").text(
                            Math.max(0, parseInt($("#remaining-words-to-guess").text(), 10) - 1)
                        );
                        $("#guessed-words-header").removeClass('d-none')
                        $("#guessed-words").append(`<li><b>${guess.toUpperCase()} &#x1F5F8;</b></li>`)
                        this.showLoading();
                        this.fetchWords();
                        this.isSubmitting = false;
                    });
                } else {
                    this.isCorrect = 0;
                    this.attempts++;
                    this.currentRow++;

                    if (this.attempts >= this.MAX_ATTEMPTS) {
                        Swal.fire({
                            title: 'Alas, the Game is Over!',
                            text: 'Thou must try again, brave soul!',
                            icon: 'error',
                            confirmButtonText: 'Persevere!'
                        }).then(() => {
                            this.fetchWords();
                            this.savedState = null;
                            this.isSubmitting = false;
                        });
                    } else {
                        this.isSubmitting = false;
                        this.focusToNextInput();
                    }
                }

                this.saveGameState();
            }).fail(() => {
                Swal.fire({
                    title: 'Alas, a Server Error!',
                    text: 'Thy guess could not be validated. Pray, try again.',
                    icon: 'error',
                    confirmButtonText: 'Understood'
                }).then(() => {
                    this.isSubmitting = false;
                });
            });
        },

        showHowToPlay: function () {
            Swal.close();
            Swal.fire({
                title: 'How to Play',
                html: `
                    <div class="how-to-play">
                        <p>Thou must guess the Wordle in six tries.</p>
                        <ul>
                            <li>Each guess must be a valid five-letter word.</li>
                            <li>The color of the tiles shall change to show how near thy guess is to the word.</li>
                        </ul>
                        <p><b>Examples</b></p>
                        <div class="boxes d-flex">
                            <div class="box correct">M</div>
                            <div class="box">O</div>
                            <div class="box">S</div>
                            <div class="box">E</div>
                            <div class="box">S</div>
                        </div>
                        <p><b>M</b> is in the word and in the correct place.</p>
                        <div class="boxes d-flex">
                            <div class="box">D</div>
                            <div class="box present">A</div>
                            <div class="box">V</div>
                            <div class="box">I</div>
                            <div class="box">D</div>
                        </div>
                        <p><b>A</b> is in the word but is misplaced.</p>
                        <div class="boxes d-flex">
                            <div class="box">J</div>
                            <div class="box">O</div>
                            <div class="box">H</div>
                            <div class="box absent">N</div>
                            <div class="box">S</div>
                        </div>
                        <p><b>N</b> is not in the word in any place.</p>
                    </div>
                `,
                confirmButtonText: 'Understood, Brave Soul!',
                customClass: {
                    popup: 'how-to-popup',
                    title: 'how-to-title',
                    htmlContainer: 'how-to-html',
                }
            }).then(() => {
                this.scrollToGrid();
                this.focusToNextInput();
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
        },

        focusToNextInput: function () {
            let nextRowInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
            nextRowInputs.prop("disabled", false);
            nextRowInputs.first().focus();
        },

        scrollToGrid: function () {
            $('html, body').animate({
                scrollTop: $('#grid').offset().top
            }, 500);
        }
    };

    oModulePuzzles.init();
});
