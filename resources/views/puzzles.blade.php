@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/puzzles.css') }}">

    <div class="page_wrap">

        @include('includes.header')

        <div class="sc_content_container">
            <div class="vc_empty_space" style="height: 4rem">
                <span class="vc_empty_space_inner"></span>
            </div>
            <div id="sc_icons_1100097351" class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
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
                        <a class="disabled-link" id="link-puzzle-4" href="{{ route('puzzles.getDetails', ['reference' => '4th']) }}">
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
                <h3 style="text-align: center; margin: 0 auto;">Criteria</h3><br>
                <p style="max-width: 600px; margin: 0.2em auto; font-style: italic; font-size: 0.9em; color: #555;">
                    Teams are ranked based on the following criteria, applied in order:
                </p>
                <ol style="max-width: 600px; margin: 0 auto 2em auto; font-style: italic; font-size: 0.9em; color: #555; text-align: left">
                    <li><strong>Number of Puzzles Completed</strong> — Higher is better.</li>
                    <li><strong>Completion Time</strong> — Lower total time is better.
                        (<em>Measured from when each puzzle was made available, not when the team started their attempt.</em>)
                    </li>
                    <li><strong>Number of Attempts</strong> — Lower is better.</li>
                </ol>
            </div><!-- /.sc_icons -->
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
