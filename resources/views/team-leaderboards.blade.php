@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/updates.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.header')
        @include('includes.menu_mobile')
        <div class="sc_content_container">
            <div class="vc_empty_space" style="height: 5.1rem">
                <span class="vc_empty_space_inner"></span>
            </div>
            <div class="post_content entry-content">
                <div class="wpb-content-wrapper" style="text-align: center; margin: 40px 0 5% 0;">
                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <h3 style="margin: 0 0 15px 0;"> Team Leaderboards (Pre-camp)</h3>
                                <div style="text-align: center; margin: 10px 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 2px">
                                    <button  style="padding: 5px 10px;" class="btn-filter-puzzle active" data-puzzle="">Overall</button>
                                    <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="1">Puzzle 1</button>
                                    <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="2">Puzzle 2</button>
                                    <button  style="padding: 5px 10px;" class="btn-filter-puzzle" data-puzzle="3">Puzzle 3</button>

                                    <button  style="padding: 5px 10px; font-weight: bold;" id="refresh-leaderboard">Refresh</button>
                                </div>

                                <div style="overflow-x: auto">
                                    <table class="tbl-team-leaderboard" style="margin: 0 auto; overflow-x: auto">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Team Name</th>
                                                <th># Puzzles<br>Completed</th>
                                                <th>Time Completion</th>
                                                <th># Attempts</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-tbl-team-leaderboard">
                                            <!-- Will be filled via AJAX -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="post_content entry-content">
                                    <div class="wpb-content-wrapper" style="text-align: center; margin: 0 5% 0;">
                                        <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                            <div class="vc_column-inner">
                                                <div class="wpb_wrapper">
                                                    <div class="wpb_content_element vc_align_left wpb_content_element">
                                                        <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Team Leaderboard Ranking Criteria</h3>
                                                    </div>
                                                    <div class="common-paragraph">
                                                        <ol class="list-number">
                                                            <li><strong>Number of Puzzles Completed</strong> — Higher is better.</li>
                                                            <li>
                                                                <strong>Completion Time</strong> — Lower total time is better.
                                                                (<em>Measured from when each puzzle was made available, not when the team started their attempt.</em>)
                                                            </li>
                                                            <li><strong>Number of Attempts</strong> — Lower is better.</li>
                                                        </ol>
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
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {!! asset_versioned('/custom/js/team-leaderboards.js', 'js', 'type="text/javascript"') !!}
@endsection
