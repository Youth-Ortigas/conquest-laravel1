@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    {{ csrf_field() }}
    <link rel="stylesheet" href="{{ asset('custom/css/puzzle-2nd.css') }}">
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Words and Letters (Stage 1): Wordle']) <!--added puzzle title based on documentation-->

        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap" id="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none"
                                     style="width: 1481.75px; left: -86.875px; right: auto; padding-left: 86.875px; padding-right: 86.875px; position: relative; box-sizing: border-box; max-width: 1512px;"
                                >
                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_content_element vc_align_center wpb_content_element">
                                                                        <h5 style="margin: 0">Words left: <span id="remaining-words-to-guess">{{ $remainingWordsToGuess }}</span></h5>
                                                                        <div class="word-grid" id="grid"></div>
                                                                        <br>
                                                                        <button id="btn-key-send" class="d-none">Submit</button>
                                                                        <a id="btn-key-send" href="/puzzle-wordle-reset">Reset</a>
                                                                        <p id="message"></p>
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
    {!! asset_versioned('/custom/js/puzzles-2nd-stage-1.js', 'js', 'type="text/javascript"') !!}
@endsection
