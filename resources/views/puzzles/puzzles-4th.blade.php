@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Fourth Puzzle'])

        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper" style="text-align: center">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none"
                                >
                                    @if(isset($dateTimeCompleted) && $dateTimeCompleted)
                                        <h4 class="sc_layouts_title_caption">
                                                Completed on {{ $dateTimeCompleted }} ({{ $numberOfAttempt }} {{ Str::plural('attempt', $numberOfAttempt) }})
                                        </h4>

                                        @include('puzzles.puzzle-proof-section')
                                    @endif

                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <div class="container" style="margin: 25px 0 0 0; text-align: center">
                                                        <h1>ON-SITE PUZZLE</h1>
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
    </div>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset("custom/js/puzzles-4th.js") }}"></script>
    @if(!$dateTimeCompleted)
        {!! asset_versioned('/custom/js/disable-buttons.js', 'js', 'type="text/javascript"') !!}
    @else
        {!! asset_versioned('/custom/js/puzzle-proof.js', 'js', 'type="text/javascript"') !!}
    @endif
@endsection
