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
            <div id="sc_icons_1100097351"
                 class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                    <div class="trx_addons_column-1_3">
                        <a href="{{ route('puzzles.getDetails', ['reference' => '1st']) }}" target="_blank">
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
                    <div class="trx_addons_column-1_3">
                        <a href="{{ route('puzzles.getDetails', ['reference' => '2nd-stage-1']) }}" target="_blank">
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
                    <div class="trx_addons_column-1_3">
                        <a href="{{ route('puzzles.getDetails', ['reference' => '3rd']) }}" target="_blank">
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
