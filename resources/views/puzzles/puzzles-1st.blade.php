@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/puzzle-1st.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Hidden in Plain Sight'])

        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper" style="text-align: center">
                                <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <h4 class="sc_layouts_title_caption">
                                        @if(isset($dateTimeCompleted) && $dateTimeCompleted)
                                            Completed on {{ $dateTimeCompleted }} ({{ $numberOfAttempt }} {{ Str::plural('attempt', $numberOfAttempt) }})
                                        @endif
                                    </h4>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">

                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 id="hint" class="common-title">The key is hidden in the city. <br>Take charge young Conqueror!</h3>
                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                        <div class="zoom-container">
                                                            <img src="{{ asset("images/conquestclue.jpg") }}" alt="conquest clue" class="zoomable-image">
                                                            <div class="zoom-controls">
                                                                <button class="zoom-reset" onclick="downloadImage()">Download Image</button>
                                                                <button class="zoom-reset">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 id="hint" class="common-title">Instructions</h3>
                                                    <div class="container" style="margin: 25px 0 0 0; padding:0;">
                                                        <div class="common-paragraph">
                                                            <ul>
                                                                <li>
                                                                    <span class="common-span">Step 1: </span>Download the image on the left and get its file name. This will be your plain text.
                                                                    <p> </p>
                                                                </li>
                                                                <li>
                                                                    <span class="common-span">Step 2:</span> Find the hidden word in the image provided. The word you’ll find would be your key to unlock the puzzle.
                                                                </li>
                                                                <li>
                                                                    <span class="common-span">Step 3:</span> Using the Vigenere Table below, decipher the answer to the puzzle below.
                                                                </li>
                                                                <li>
                                                                    <span class="common-span">Tip: You may watch thy tutorial video on how to decipher using a Vigenere table.</span>
                                                                </li>
                                                            </ul>

                                                            <div class="container">
                                                                <iframe height="350px" width="100%" src="https://www.youtube.com/embed/rccRQcyKB5g"></iframe>
                                                            </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                    <div class="vc_column-inner">
                                        <div class="wpb_wrapper">
                                            <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                                                <div class="container" style="margin: 25px 0 0 0;">
                                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                        <div class="vc_column-inner">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                                                    <h3 style="margin: 9.15rem 0 25px 0;"> Vigenere Table </h3>
                                                                    <h4> What Be Thy Answer? </h4>
                                                                    <label style="display: block; margin-top: 25px;">
                                                                        <input
                                                                            type="text"
                                                                            name="puzzle_code_1st"
                                                                            id="puzzle-code-input"
                                                                            class="text-uppercase"
                                                                            placeholder="ENTER KEY"
                                                                            value="{{ $correctAttempt[0] ?? '' }}"
                                                                            {{ isset($correctAttempt[0]) ? 'disabled' : '' }}
                                                                        />

                                                                        @unless(isset($correctAttempt[0]))
                                                                            <br>
                                                                            <button type="submit" style="margin-top: 15px;" id="btn-puzzle-send"> Deliver Thy Reply </button>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                        <div class="vc_column-inner" style="padding-right:0;">
                                                            <div class="wpb_wrapper">
                                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                                        <div class="table-wrapper">
                                                                            <table id="vigenereTable"></table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset("custom/js/puzzles-1st.js") }}"></script>
    <script type="text/javascript" src="{{ asset("custom/js/disable-buttons.js") }}"></script>

@endsection
