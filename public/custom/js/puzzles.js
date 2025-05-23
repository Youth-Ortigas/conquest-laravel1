$(document).ready(function () {
    const $puzzles = $('.puzzle-available-in');

    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        return (
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(secs).padStart(2, '0')
        );
    }

    $puzzles.each(function () {
        const $countdown = $(this);
        let totalSeconds = parseInt($countdown.data('seconds'));
        const $timerDisplay = $countdown.find('.puzzle-timer');

        const puzzleId = $countdown.attr('id')
            .replace('puzzle-', '')
            .replace('-available-in', '');
        const $link = $('#link-puzzle-' + puzzleId);

        if (!isNaN(totalSeconds) && totalSeconds > 0) {
            $link.addClass('disabled-link');
            $timerDisplay.text(formatTime(totalSeconds));

            const interval = setInterval(() => {
                totalSeconds--;

                if (totalSeconds <= 0) {
                    clearInterval(interval);
                    $link.removeClass('disabled-link');
                    $countdown.replaceWith('');
                } else {
                    $timerDisplay.text(formatTime(totalSeconds));
                }
            }, 1000);
        }
    });
});
