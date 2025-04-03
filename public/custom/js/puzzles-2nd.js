$(document).ready(function () {
    var oModulePuzzles = {
        /**
         * Initializes the game by loading properties, fetching words,
         * setting up input navigation, and handling submission.
         */
        init: function () {
            this.loadProperties();
            this.fetchWords();
            this.handleInputNavigation();
            this.handleSubmission();
        },

        /**
         * Initializes the game properties and settings.
         */
        loadProperties: function () {
            this.classKeyButton = '#btn-key-send'; // Submit button
            this.WORDS = []; // List of words fetched from backend
            this.WORD = ""; // Current word
            this.MAX_ATTEMPTS = 6; // Maximum attempts allowed per word
            this.attempts = 0; // Track the number of attempts
            this.currentRow = 0; // Track the current row being filled
            this.grid = $('#grid'); // Game grid container
            this.DOMClassKeyButton = $(this.classKeyButton); // Button DOM reference
            this.csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token
        },

        /**
         * Fetch words from the backend and start the first round.
         */
        fetchWords: function () {
            $.post('/puzzle-wordle-get-word', {_token: this.csrfToken}, (data) => {
                if (data.status === 'success') {
                    this.startNewRound();
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
            this.attempts = 0;
            this.currentRow = 0;
            // Enable the next row's input boxes
            let nextRowInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
            nextRowInputs.prop("disabled", false);
            nextRowInputs.first().focus();
            this.generateGrid()
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
                        disabled: i !== 0 // Enable only the first row at start
                    }).on('input', function () {
                        $(this).val($(this).val().toUpperCase()); // Convert input to uppercase
                        if ($(this).val() && j < 4) {
                            $(this).next().focus(); // Move to the next input
                        }
                    });
                    row.append(input);
                }
                this.grid.append(row);
            }
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
                let feedback = response.feedback;
                let correctCount = 0;

                // Process feedback and add appropriate classes
                for (let i = 0; i < 5; i++) {
                    if (feedback[i] === 'correct') {
                        $(currentInputs[i]).addClass("correct");
                        correctCount++;
                    } else if (feedback[i] === 'present') {
                        $(currentInputs[i]).addClass("present");
                    } else {
                        $(currentInputs[i]).addClass("absent");
                    }
                }

                // If the word was guessed correctly
                if (correctCount === 5) {
                    Swal.fire('🎉 Congratulations!', 'You guessed the word correctly!', 'success').then(() => {
                        // Log the correct guess and fetch new word
                        this.logPuzzleAttempt(guess, true);
                        this.fetchWords(); // Fetch a new word and start a new round
                    });
                } else {
                    this.attempts++;
                    this.currentRow++;
                    if (this.attempts >= this.MAX_ATTEMPTS) {
                        Swal.fire('Game Over!', `The correct word was: ${guess}`, 'error').then(() => {
                            // Log the failed guess and fetch new word
                            this.logPuzzleAttempt(guess, false);
                            this.fetchWords(); // Fetch a new word and start a new round
                        });
                    } else {
                        let nextRowInputs = this.grid.find('.row').eq(this.currentRow).find('.letter-box');
                        nextRowInputs.prop("disabled", false);
                        nextRowInputs.first().focus();
                    }
                }
            });
        },

        // Function to log puzzle attempt
        logPuzzleAttempt: function(guess, isCorrect) {
            $.post('/log-puzzle-attempt', {
                _token: this.csrfToken,
                guess: guess,
                is_correct: isCorrect
            });
        }
    };

    // Initialize the game
    oModulePuzzles.init();
});
