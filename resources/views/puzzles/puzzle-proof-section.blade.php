<link rel="stylesheet" href="{{ asset('custom/css/puzzle-proof.css') }}">

@if (!$hasGroupPhoto)
    <form action="{{ route('puzzles.upload') }}" method="POST" enctype="multipart/form-data" id="puzzle-proof-form">
        @csrf
        <input type="hidden" name="puzzle_id" value="{{ $puzzleNum }}">

        <h5 style="margin: 50px 0 0 0">Upload your photo proof of completing the puzzle below</h5><br>

        <input type="file" name="photo" accept="image/*" onchange="previewImage(event)" required><br><br>

        <div class="wpb_wrapper">
            <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                <figure class="wpb_wrapper vc_figure vc_align_center">
                    <div class="vc_single_image-wrapper vc_box_border_grey" style="max-width: 100%; text-align: center;">
                        <img
                            id="photo-preview"
                            class="vc_single_image-img attachment-full d-none"
                            src=""
                            alt="Image Preview"
                        ><br>
                    </div>
                </figure>
            </div>
        </div>

        <textarea name="photo_proof" placeholder="Proclaim thy triumph, brave conquerors! Tell the tale of how thy fellowship vanquished the puzzle through cunning strategy and steadfast teamwork." style="font-size: 20px; width: 80%;" required></textarea><br>

        <button type="button" style="margin-top: 20px; margin-bottom: 20px" id="btn-submit-group-photo">Submit</button>
    </form>
@endif

<h4 style="margin: 30px 0 25px 0">Team's Glorious Submissions</h4>
<div class="wpb_wrapper">
        <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
            <figure class="wpb_wrapper vc_figure vc_align_center">
                <div class="vc_single_image-wrapper vc_box_border_grey" style="max-width: 100%; text-align: center;">
                    @foreach($teamProofs as $proof)
                        <h6 style="margin: 0">{{ $proof->team_name }}</h6>
                        <div class="submission-card" style="flex: 1 1 300px; max-width: 400px; border-radius: 12px; padding: 5px;">
                            <img
                                src="{{ Storage::url($proof->photo_path) }}"
                                alt="Team Submission"
                                style="width: 100%; height: auto; border-radius: 8px;"
                            >

                            <div class="reactions" data-proof-id="{{ $proof->id }}">
                                <span class="reaction" data-emoji="⚔️" aria-label="Sword">⚔️ <span class="count">0</span></span>
                                <span class="reaction" data-emoji="🛡️" aria-label="Shield">🛡️ <span class="count">0</span></span>
                                <span class="reaction" data-emoji="🔥" aria-label="Fire">🔥 <span class="count">0</span></span>
                                <span class="reaction" data-emoji="👑" aria-label="Crown">👑 <span class="count">0</span></span>

                                <img src="{{ asset('images/puzzles/view.png') }}" alt="" class="view-reactions-btn" style="width: 30px;">
                            </div>
                            <p style="text-align: justify;font-weight: bold">"{{ $proof->description }}"</p>
                        </div>
                    @endforeach

                    <div id="reaction-popup">
                        <button id="close-reaction-popup">✖</button>
                        <div id="reaction-popup-content"></div>
                    </div>

                    <div id="reaction-popup-overlay"></div>
                </div>
            </figure>
        </div>
    </div>
</div>


