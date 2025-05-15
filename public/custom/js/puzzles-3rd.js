$(document).ready(function () {
    //$(document).on('contextmenu', function (e) {
      //  e.preventDefault();
    //});

    $(document).on('keydown', function (e) {
        if (e.keyCode === 123 ||
            (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) ||
            (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83))) {
            e.preventDefault();
        }
    });

    var oScrollModule = {
        /**
         * Initialize the scroll and fill-in-the-blank validation
         */
        init: function () {
            this.loadElements();
            this.bindEvents();
            this.restoreGameState();
            this.saveGameState();
        },

        loadElements: function () {
            this.$scrollPaper = $('#scrollPaper');
            this.$scrollLabel = $('#scrollLabel');
            this.$submitBtn = $('#btn-submit-answers');
            this.csrfToken = $('meta[name="csrf-token"]').attr('content');
            this.isOpen = false;
            this.puzzleNum = 3;
            this.isPuzzleComplete = false;
        },

        bindEvents: function () {
            $(document).on('click', '#scrollLabel, #scrollPaper', () => {
                if (!oScrollModule.isOpen) {
                    this.openScroll()
                }
            });

            this.$submitBtn.on('click', (e) => {
                e.preventDefault();
                this.submitAnswers();
            });
        },

        restoreGameState: function () {
            $.get(`/puzzle-get-game-state/${this.puzzleNum}`, function (response) {
                if (response && response.game_state) {
                    const savedAnswers = response.game_state;

                    if (Array.isArray(savedAnswers)) {
                        $('.fill-blank').each(function (index) {
                            if (savedAnswers[index] !== undefined && savedAnswers[index] !== '') {
                                $(this).val(savedAnswers[index]);
                                $('.fill-blank').trigger('keyup')
                            }
                        });

                        if (this.$scrollPaper && this.$scrollPaper[0] && !this.isOpen) {
                            this.openScroll()
                        }
                    } else {
                        console.error('Invalid game state format: expected an array.');
                    }
                } else if(response && response.status === 'complete') {
                    this.isPuzzleComplete = true
                    const entered_key = response.entered_key.trim().split(',')

                    $('.fill-blank').each(function (index) {
                        $(this).val(entered_key[index]).attr('readonly', true)
                    })

                    this.openScroll()
                    this.$submitBtn.addClass('d-none')
                } else {
                    console.warn('No saved game state found.');
                }
            }.bind(this));
        },

        saveGameState: function () {
            $('.fill-blank').on('blur', () => {
                if(!this.isPuzzleComplete) {
                    const inputs = $('.fill-blank').map(function () {
                        return $(this).val().trim().toLowerCase();
                    }).get();

                    $.post('/puzzle-save-game-state', {
                        _token: this.csrfToken,
                        puzzle_num: this.puzzleNum,
                        game_state: JSON.stringify(inputs)
                    }).done(function (response) {
                        if (response.status !== 'success') {
                            console.error('Failed to save game state');
                        }
                    });

                    const allFilled = inputs.every(val => val !== '');
                    if (allFilled) {
                        this.$submitBtn.attr('disabled', false);
                    }
                }
            });
        },

        submitAnswers: function () {
            if(!this.isPuzzleComplete) {
                const answers = [];

                $('.fill-blank').each(function () {
                    answers.push($(this).val().trim());
                });

                $.post('/validate-puzzle-key', {
                    _token: this.csrfToken,
                    puzzle_key: answers,
                    puzzle_num: this.puzzleNum
                })
                .done(function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                        title: 'Alas, the Game is Over!',
                        text: `Thou hast completed puzzle ${this.puzzleNum}!`,
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        showConfirmButton: false,
                        footer: '<strong>Pray, wait for the next puzzle to be unlocked.</strong>'
                    });

                    if(data.next_puzzle) {
                        Swal.fire({
                            title: 'Puzzle Unlocked!',
                            html: '<p>Thou hast conquered the Fill in the blanks puzzle!</p><p>Click <strong>Go Forth!</strong> to journey to the last puzzle.</p>',
                            icon: 'success',
                            confirmButtonText: 'Go Forth!'
                        }).then(() => {
                            window.location.href = data.next_puzzle;
                        });
                    }
                    } else {
                        Swal.fire({
                            title: 'Try Again',
                            text: response.message || 'Some answers are incorrect.',
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                    }
                })
                .fail(function (error) {
                    console.error('Error submitting puzzle answers:', error);
                    Swal.fire('Oops!', 'Something went wrong. Please try again.', 'error');
                });
            }
        },

        openScroll: function () {
            gsap.to(this.$scrollPaper[0], { height: 580, duration: 1 });
            this.$scrollPaper.addClass('scroll-open');
            gsap.to(this.$scrollLabel[0], { opacity: 0, duration: 0.5 });
            this.isOpen = true;

            $('html, body').animate({
                scrollTop: oScrollModule.$scrollLabel.offset().top
            }, 2000);
        },
    };

    oScrollModule.init();
});
