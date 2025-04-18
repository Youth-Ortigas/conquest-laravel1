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
                    $checkPuzzleState2nd = $assignPuzzlesRound[2] ?? [];
                    $checkPuzzleState3rd = $assignPuzzlesRound[3] ?? [];

                    $flagPuzzleDisableOpacity1st = Auth::check() !== true ? "opacity: 0.5" : "";
                    $flagPuzzleDisableOpacity2nd = \App\Lib\LibUtility::isArray($checkPuzzleState2nd) !== true ? "opacity: 0.5" : "";
                    $flagPuzzleDisableOpacity3rd = \App\Lib\LibUtility::isArray($checkPuzzleState3rd) !== true ? "opacity: 0.5" : "";

                    $flagPuzzleAllowLink1st = Auth::check();
                    $flagPuzzleAllowLink2nd = \App\Lib\LibUtility::isArray($checkPuzzleState2nd);
                    $flagPuzzleAllowLink3rd = \App\Lib\LibUtility::isArray($checkPuzzleState3rd);
                @endphp

                <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                    <div class="trx_addons_column-1_3" style="{{ $flagPuzzleDisableOpacity1st }}">
                        @if($flagPuzzleAllowLink1st)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '1st']) }}">
                        @endif
                            <div class="sc_icons_item sc_icons_item_linked">
                                <div id="sc_icons_1100097351_icon-icon-11"
                                     class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                    <span class="sc_icon_type_ icon-icon-11"></span>
                                </div>
                                <h4 class="sc_icons_item_title">
                                    <span>Puzzle 1</span></h4>
                                <div class="sc_icons_item_description"><span>Calling as an Individual</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_3" style="{{ $flagPuzzleDisableOpacity2nd }}">
                        @if($flagPuzzleAllowLink2nd)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '2nd-stage-1']) }}">
                        @endif
                        <div class="sc_icons_item sc_icons_item_linked">
                            <div id="sc_icons_1100097351_icon-icon-12"
                                 class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                <span class="sc_icon_type_ icon-icon-12"></span>
                            </div>
                            <h4 class="sc_icons_item_title">
                                <span>Puzzle 2</span></h4>
                            <div class="sc_icons_item_description"><span>Calling with the Church Community</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="trx_addons_column-1_3" style="{{ $flagPuzzleDisableOpacity3rd }}">
                        @if($flagPuzzleAllowLink3rd)
                            <a href="{{ route('puzzles.getDetails', ['reference' => '3rd']) }}">
                        @endif
                        <div class="sc_icons_item sc_icons_item_linked">
                            <div id="sc_icons_1100097351_icon-icon-13"
                                 class="sc_icons_icon sc_icon_type_ icon-icon-13">
                                <span class="sc_icon_type_ icon-icon-13"></span>
                            </div>
                            <h4 class="sc_icons_item_title"><span>Puzzle 3</span>
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
