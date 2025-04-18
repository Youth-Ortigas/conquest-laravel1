@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/puzzle-1st.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Hidden in Plain Sight']) <!-- changed to title of the puzzle based on the documentation-->

        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none"
                                     style="width: 1481.75px; left: -86.875px; right: auto; padding-left: 86.875px; padding-right: 86.875px; position: relative; box-sizing: border-box; max-width: 1512px;">
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 id="hint">
                                                        The key is hidden in the city. <br>Take charge young Conqueror!
                                                    </h3>
                                                    <div class="tutorial">
                                                        <p> If you feel stuck, download the image of the clue</p>
                                                        <p>
                                                            For Extra help, read this:<br>
                                                        <ul>
                                                            <li>After downloading the image, look for a word hidden in the picture</li>
                                                            <li>Once you have found the word, have a look again at the filename of the image you just downloaded.</li>
                                                            <li>Take a look at the Vigenere Table and try to put 2 and 2 together to solve the puzzle!</li>
                                                            <li>To "submit" your final answer, go to the address bar of your browser,
                                                            </li>
                                                        </ul>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                        <div class="zoom-container">
                                                            <img src="{{ asset("images/conquestclue.jpg") }}" alt="conquest clue" class="zoomable-image">
                                                            <div class="zoom-controls">
                                                                <button class="zoom-reset">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                                            <input type="text" name="puzzle_code_1st" id="puzzle-code-input" class="text-uppercase" placeholder="ENTER KEY"/>
                                                                            <button type="submit" style="margin-left: 15px;" id="btn-puzzle-send"> Deliver Thy Reply </button>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner" style="padding-right:0;">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                                        <div class="container" style="margin: 25px 0 0 0; padding-right:0;">
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
@endsection
