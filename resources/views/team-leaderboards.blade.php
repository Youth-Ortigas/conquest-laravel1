@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/dashboard.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.banner_common', ['title' => 'Leaderboard'])
        @include('includes.header')
        @include('includes.menu_mobile')
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none" style="margin: 0 0 30px 0 !important;">
                                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                                                    <h3 style="margin: 0 0 15px 0;"> Team Leaderboards (Pre-camp)</h3>
                                                    <div style="text-align: center; margin: 10px 0;">
                                                        <button  style="padding: 5px 10px;" class="btn-filter-puzzle active" data-puzzle="">Overall</button>
                                                        <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="1">Puzzle 1</button>
                                                        <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="2">Puzzle 2</button>
                                                        <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="3">Puzzle 3</button>

                                                        <button  style="padding: 5px 10px;margin-left: 15px; font-weight: bold;" id="refresh-leaderboard">Refresh</button>
                                                    </div>

                                                    <table class="tbl-team-leaderboard" style="margin: 0 auto">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Team</th>
                                                                <th># Puzzles<br>Completed</th>
                                                                <th>Time Completion</th>
                                                                <th># Attempts</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-tbl-team-leaderboard">
                                                            <!-- Will be filled via AJAX -->
                                                        </tbody>
                                                    </table>
                                                    <h3 style="text-align: center; margin-top: 2em;">Team Leaderboard Ranking Criteria</h3>
                                                    <p style="max-width: 600px; margin: 0.5em auto; font-style: italic; font-size: 0.9em; color: #555;">
                                                        Teams are ranked based on the following criteria, applied in order:
                                                    </p>
                                                    <ol style="max-width: 600px; margin: 0 auto 2em auto; font-style: italic; font-size: 0.9em; color: #555; text-align: left">
                                                        <li><strong>Number of Puzzles Completed</strong> — Higher is better.</li>
                                                        <li><strong>Completion Time</strong> — Lower total time is better.
                                                            (<em>Measured from when each puzzle was made available, not when the team started their attempt.</em>)
                                                        </li>
                                                        <li><strong>Number of Attempts</strong> — Lower is better.</li>
                                                        <li><em>Lastly, please report any errors or discrepancies you notice in the leaderboard.</em></li>
                                                    </ol>
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
    {!! asset_versioned('/custom/js/team-leaderboards.js', 'js', 'type="text/javascript"') !!}
@endsection
