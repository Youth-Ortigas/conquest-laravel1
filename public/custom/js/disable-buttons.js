$(document).ready(function() {
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
})
