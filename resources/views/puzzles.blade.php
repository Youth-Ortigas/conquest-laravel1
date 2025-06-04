@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/puzzles.css') }}">

    <div class="page_wrap">
        @include('includes.header')
        @include('includes.menu_mobile')
        @include('includes.puzzle_banner', ['title' => 'Puzzles'])
        <div class="sc_content_container">
            <div class="vc_empty_space" style="height: 4rem">
                <span class="vc_empty_space_inner"></span>
            </div>
            <div id="sc_icons_1100097351" class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom" style="margin: 0 5% 0;">
                    <div class="trx_addons_column-1_4">
                        <a id="link-puzzle-1" href="{{ route('puzzles.getDetails', ['reference' => '1st']) }}">
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-11"
                                        class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                    <span class="sc_icon_type_ icon-icon-11"></span>
                                </div>
                                <h4 class="sc_icons_item_title">
                                    <span>Puzzle I {{ $isPuzzleComplete['1st'] ? '✔️' : '' }}</span></h4>
                                <div class="sc_icons_item_description">
                                    <span>Hidden in Plain Sight</span>
                                    {!! $puzzleAvailableIn['1st'] ?
                                        '<div id="puzzle-1-available-in" data-seconds="'.$puzzleAvailableIn['1st'].'" class="puzzle-available-in">
                                            Available in <span class="puzzle-timer"></span>
                                        </div>'
                                        :''
                                    !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4">
                        <a id="link-puzzle-2" href="{{ route('puzzles.getDetails', ['reference' => '2nd']) }}">
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-12"
                                    class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                    <span class="sc_icon_type_ icon-icon-12"></span>
                                </div>
                                <h4 class="sc_icons_item_title">
                                    <span>Puzzle II {{ $isPuzzleComplete['2nd'] ? '✔️' : '' }}</span></h4>

                                <div class="sc_icons_item_description">
                                    <span>Words and Letters: Wordle</span>
                                    {!! $puzzleAvailableIn['2nd'] ?
                                        '<div id="puzzle-2-available-in" data-seconds="'.$puzzleAvailableIn['2nd'].'" class="puzzle-available-in">
                                            Available in <span class="puzzle-timer"></span>
                                        </div>'
                                        :''
                                    !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4">
                        <a id="link-puzzle-3" href="{{ route('puzzles.getDetails', ['reference' => '3rd']) }}">
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-12"
                                    class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                    <span class="sc_icon_type_ icon-icon-12"></span>
                                </div>
                                <h4 class="sc_icons_item_title">
                                    <span>Puzzle III {{ $isPuzzleComplete['3rd'] ? '✔️' : '' }}</span></h4>
                                <div class="sc_icons_item_description">
                                    <span>Words and Letters: Fill in the blanks</span>
                                    {!! $puzzleAvailableIn['3rd'] ?
                                        '<div id="puzzle-3-available-in" data-seconds="'.$puzzleAvailableIn['3rd'].'" class="puzzle-available-in">
                                            Available in <span class="puzzle-timer"></span>
                                        </div>'
                                        :''
                                    !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4">
                        <a id="link-puzzle-4" href="{{ route('puzzles.getDetails', ['reference' => '4th']) }}">
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-13"
                                    class="sc_icons_icon sc_icon_type_ icon-icon-13">
                                    <span class="sc_icon_type_ icon-icon-13"></span>
                                </div>
                                <h4 class="sc_icons_item_title"><span>Puzzle IV</span>
                                </h4>
                                <div class="sc_icons_item_description">
                                    <span>Calling to the Mission Field</span>
                                    {!! $puzzleAvailableIn['4th'] ?
                                        '<div id="puzzle-4-available-in" data-seconds="'.$puzzleAvailableIn['4th'].'" class="puzzle-available-in">
                                            Available in <span class="puzzle-timer"></span>
                                        </div>'
                                        :''
                                    !!}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="post_content entry-content">
                <div class="wpb-content-wrapper" style="text-align: center; margin: 0 5% 0;">
                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Puzzle Criteria</h3>
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

                                <a href="{{ route('team-leaderboard.index') }}" target="_blank" style="font-size: larger"><u>VIEW LEADERBOARDS</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vc_empty_space" style="height: 3rem">
                <span class="vc_empty_space_inner"></span>
            </div>

            <div class="post_content entry-content">
                <div class="wpb-content-wrapper" style="text-align: center; margin: 0 5% 0;">
                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Team Challenges</h3>
                                </div>
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h4 class="common-title-sub1 text-uppercase">Represent Your Team</h4>
                                </div>
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h5 class="common-title-sub2 text-uppercase"> Name Your House </h5>
                                    <div class="common-paragraph">
                                        <ol class="list-number">
                                            <li>Choose a warrior name from the list below.  Names are first come first serve basis.</li>
                                            <li>Then choose an animal.</li>
                                            <li>
                                                <p>Create your team name using this format:</p>
                                                <p>[Warrior Name from the list] of [assigned color] + [Chosen animal]</p>
                                                <p>Ex. Warriors of the Golden Fish or Hero of the Golden Fish</p>
                                            </li>
                                        </ol>

                                        <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                                            <div class="trx_addons_column-1_4">
                                                <ul>
                                                    <li>Warrior</li>
                                                    <li>Hero</li>
                                                    <li>Defender</li>
                                                    <li>Guardian</li>
                                                    <li>Knight</li>
                                                </ul>
                                            </div>
                                            <div class="trx_addons_column-1_4">
                                                <ul>
                                                    <li>Avenger</li>
                                                    <li>General</li>
                                                    <li>Patriot</li>
                                                    <li>Army</li>
                                                    <li>Fighter</li>
                                                </ul>
                                            </div>
                                            <div class="trx_addons_column-1_4">
                                                <ul>
                                                    <li>Soldier</li>
                                                    <li>Peacemaker</li>
                                                    <li>Veteran</li>
                                                    <li>Cavalier</li>
                                                    <li>Protector</li>
                                                </ul>
                                            </div>
                                            <div class="trx_addons_column-1_4">
                                                <ul>
                                                    <li>Champion</li>
                                                    <li>Gladiator</li>
                                                    <li>Swordsman</li>
                                                    <li>Crusader</li>
                                                    <li>Trooper</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h5 class="common-title-sub2"> Compose Your Battle Cry </h5>
                                    <div class="common-paragraph">
                                        <ol class="list-number">
                                            <li>Create a short chant (maximum of 1 min.) that embodies your house’s battle cry.</li>
                                            <li>Be ready to present it on our camp.  </li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left" id="div-design-flag">
                                        <div class="vc_column-inner" style="padding-left:0;">
                                            <div class="wpb_wrapper flex-container">
                                                <div class="vc_col-md-6 vc_col-sm-12 wpb_content_element common-paragraph flex-center" style="height: 300px; padding:0;">
                                                    <ol>
                                                        <li class="common-title-sub2 block-title">Design Your Flag</li>
                                                        <li>Using the materials provided, design a flag that represents your house. The flag must be PORTRAIT.</li>
                                                        <li>Your house’s animal should be your emblem.</li>
                                                    </ol>
                                                </div>
                                                <div class="vc_col-md-6 vc_col-sm-12 wpb_single_image wpb_content_element">
                                                    <img src="{{ asset('images/puzzles/flags.png') }}" alt="Flag List">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(now()->greaterThanOrEqualTo('2025-06-03 08:00:00'))
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h4 class="common-title-sub1 text-uppercase">House Performance</h4>
                                    <div class="common-paragraph">
                                        <ol class="list-number">
                                            <li>Each house will perform during our social night. The performance should be Conquest themed.</li>
                                            <li>You may perform in whatever style. It can be through a chorale, interpretative dance, contemporary dance, musical, skit etc. It can also be a combination of multiple styles.</li>
                                            <li>Each house will be given 2 to 4 minutes to perform.</li>
                                            <li>Criteria for judging:
                                                <ol>
                                                    <li>Creativity</li>
                                                    <li>Relevance to the Conquest theme</li>
                                                    <li>Originality</li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('includes.header')

        @include('includes.menu_mobile')
    </div><!-- /.page_wrap -->
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset("custom/js/puzzles.js") }}"></script>
    @if (session('error'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: @json(session('error')),
                    confirmButtonText: 'Okay'
                });
            });
        </script>
    @endif
@endsection
