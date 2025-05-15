@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Puzzles'])

        @include('includes.header')

        <div class="sc_content_container">
            <div class="vc_empty_space" style="height: 5.1rem">
                <span class="vc_empty_space_inner"></span>
            </div>
            <div id="sc_icons_1100097351" class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                @php
                    use \App\Lib\LibUtility;

                    $checkPuzzleState2nd = $assignPuzzlesRound[1] ?? [];
                    $checkPuzzleState3rd = $assignPuzzlesRound[2] ?? [];
                    $checkPuzzleState4th = $assignPuzzlesRound[3] ?? [];

                    $flagPuzzleDisableOpacity1st = Auth::check() !== true ? "opacity: 0.5" : "";
                    $flagPuzzleDisableOpacity2nd = LibUtility::isArray($checkPuzzleState2nd) !== true ? "opacity: 0.5" : "";
                    $flagPuzzleDisableOpacity3rd = LibUtility::isArray($checkPuzzleState3rd) !== true ? "opacity: 0.5" : "";
                    $flagPuzzleDisableOpacity4th = LibUtility::isArray($checkPuzzleState4th) !== true ? "opacity: 0.5" : "";

                    $flagPuzzleAllowLink1st = Auth::check();
                    $flagPuzzleAllowLink2nd = LibUtility::isArray($checkPuzzleState2nd);
                    $flagPuzzleAllowLink3rd = LibUtility::isArray($checkPuzzleState3rd);
                    $flagPuzzleAllowLink4th = LibUtility::isArray($checkPuzzleState4th);

                    $is1stPuzzleComplete = LibUtility::isArray($checkPuzzleState2nd);
                    $is2ndPuzzleComplete = LibUtility::isArray($checkPuzzleState3rd);
                    $is3rdPuzzleComplete = LibUtility::isArray($checkPuzzleState4th);
                @endphp

                <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                    <div class="trx_addons_column-1_4" style="{{ $flagPuzzleDisableOpacity1st }}">
                        @if($flagPuzzleAllowLink1st)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '1st']) }}">
                        @endif
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-11"
                                     class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                    <span class="sc_icon_type_ icon-icon-11"></span>
                                </div>
                                <h4 class="sc_icons_item_title">
                                    <span>Puzzle I {{ $is1stPuzzleComplete ? '✔️' : '' }}</span></h4>
                                <div class="sc_icons_item_description"><span>Hidden in Plain Sight</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4" style="{{ $flagPuzzleDisableOpacity2nd }}">
                        @if($flagPuzzleAllowLink2nd)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '2nd']) }}">
                        @endif
                        <div class="sc_icons_item sc_icons_item_linked">
                            <div id="sc_icons_1100097351_icon-icon-12"
                                 class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                <span class="sc_icon_type_ icon-icon-12"></span>
                            </div>
                            <h4 class="sc_icons_item_title">
                                <span>Puzzle II {{ $is2ndPuzzleComplete ? '✔️' : '' }}</span></h4>
                            <div class="sc_icons_item_description"><span>Words and Letters: Wordle</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4" style="{{ $flagPuzzleDisableOpacity3rd }}">
                        @if($flagPuzzleAllowLink3rd)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '3rd']) }}">
                        @endif
                        <div class="sc_icons_item sc_icons_item_linked">
                            <div id="sc_icons_1100097351_icon-icon-12"
                                 class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                <span class="sc_icon_type_ icon-icon-12"></span>
                            </div>
                            <h4 class="sc_icons_item_title">
                                <span>Puzzle III {{ $is3rdPuzzleComplete ? '✔️' : '' }}</span></h4>
                            <div class="sc_icons_item_description"><span>Words and Letters: Fill in the blanks</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_4" style="{{ $flagPuzzleDisableOpacity4th }}">
                        @if($flagPuzzleAllowLink4th)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '4th']) }}">
                        @endif
                        <div class="sc_icons_item sc_icons_item_linked">
                            <div id="sc_icons_1100097351_icon-icon-13"
                                 class="sc_icons_icon sc_icon_type_ icon-icon-13">
                                <span class="sc_icon_type_ icon-icon-13"></span>
                            </div>
                            <h4 class="sc_icons_item_title"><span>Puzzle IV</span>
                            </h4>
                            <div class="sc_icons_item_description"><span>Calling to the Mission Field</span>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div><!-- /.sc_icons -->
        </div>

        @include('includes.header')

        @include('includes.menu_mobile')
    </div><!-- /.page_wrap -->
@endsection
