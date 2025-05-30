$(document).ready(() => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.reactions').each(function () {
        const proofId = $(this).data('proof-id');
        loadReactions(proofId, $(this));
    });

    $('.reactions').on('click', '.reaction', function () {
        const $this = $(this);
        const emoji = $this.data('emoji');
        const container = $this.closest('.reactions');
        const proofId = container.data('proof-id');

        $.ajax({
            url: `/puzzle-proof/${proofId}/reaction`,
            method: 'POST',
            data: {
                emoji,
                _token: csrfToken,
            },
            success: () => {
                loadReactions(proofId, container);
            },
            error: (xhr) => {
                alert(xhr.responseJSON?.message || 'Error updating reaction');
            },
        });
    });

    $('.reactions').on('click', '.view-reactions-btn', function () {
        const container = $(this).closest('.reactions');
        const proofId = container.data('proof-id');

        $.ajax({
            url: `/puzzle-proof/${proofId}/reactions/users`,
            method: 'GET',
            dataType: 'json',
            success: (data) => {
            const reactions = data.reactions;
            let html = '';

            if (reactions && Object.keys(reactions).length > 0) {
                for (const [emoji, users] of Object.entries(reactions)) {
                    const userList = users.length
                        ? `<div style="color: #333; font-size: 14px;">
                            ${users.map(user => `<div style="margin-bottom: 4px;">${emoji} ${user}</div>`).join('')}
                        </div>`
                        : `<div style="color: #777; font-style: italic;">No users</div>`;

                    html += `
                        <div style="margin-bottom: 2px; text-align: left">
                            ${userList}
                        </div>`;
                }
            } else {
                html = '<p>No reactions yet.</p>';
            }

                $('#reaction-popup-content').html(html);
                $('#reaction-popup, #reaction-popup-overlay').fadeIn();
            },

            error: () => {
                alert('Failed to load reactions');
            },
        });
    });

    $('#close-reaction-popup, #reaction-popup-overlay').on('click', () => {
        $('#reaction-popup, #reaction-popup-overlay').fadeOut();
    });

    $("#btn-submit-group-photo").on('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure you want to submit this photo?',
            text: "You won't be able to change this later!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if(result.isConfirmed) {
                $("#puzzle-proof-form").submit();
            }
        })
    })

    function loadReactions(proofId, container) {
        $.ajax({
            url: `/puzzle-proof/${proofId}/reactions`,
            method: 'GET',
            dataType: 'json',
            success: (data) => {
                let userReaction = null;
                for (const [emoji, details] of Object.entries(data)) {
                    if (details.auth_user_reaction === emoji) {
                        userReaction = emoji;
                        break;
                    }
                }

                container.find('.reaction').each(function () {
                    const $reaction = $(this);
                    const emoji = $reaction.data('emoji');
                    const count = data[emoji]?.count || 0;
                    $reaction.find('.count').text(count);

                    if (emoji === userReaction) {
                        $reaction.addClass('reacted');
                    } else {
                        $reaction.removeClass('reacted');
                    }
                });
            },
            error: () => {
                console.warn(`Failed to load reactions for proof ${proofId}`);
            },
        });
    }
});

function previewImage(event) {
    const file = event.target.files[0];
    const $preview = $('#photo-preview');

    if (file) {
        const imageUrl = URL.createObjectURL(file);
        $preview.attr('src', imageUrl).removeClass('d-none');
    } else {
        $preview.attr('src', '').addClass('d-none');
    }
}
