let currentPuzzleNum = '';

function loadLeaderboard(puzzleNum = '') {
    let tbody = $('#tbody-tbl-team-leaderboard');

    // Fade out the current content before loading
    tbody.fadeOut(200, function () {
        $.ajax({
            url: `/team-leaderboards-table/${puzzleNum}`,
            method: 'GET',
            success: function (response) {
                tbody.empty(); // Clear previous content

                response.forEach((team) => {
                    tbody.append(`
                        <tr>
                            <td><b>${team.rankOrdinal}</b></td>
                            <td>${team.team_name}</td>
                            <td style="text-align: center">${team.isComplete}</td>
                            <td style="text-align: center">${team.timeDiffFormatted}</td>
                            <td style="text-align: center">${team.attempts}</td>
                        </tr>
                    `);
                });

                // Fade in the new content
                tbody.fadeIn(200);
            },
            error: function () {
                alert('Failed to load leaderboard.');
                tbody.fadeIn(200); // Ensure UI is visible again
            }
        });
    });
}

$(document).ready(function () {
    loadLeaderboard(); // Initial load

    $('.btn-filter-puzzle').on('click', function () {
        currentPuzzleNum = $(this).data('puzzle');
        $('.btn-filter-puzzle').removeClass('active'); // Remove from all
        $(this).addClass('active'); // Add to clicked one
        loadLeaderboard(currentPuzzleNum);
    });

    $('#refresh-leaderboard').on('click', function () {
        loadLeaderboard(currentPuzzleNum);
    });
});
