@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/materials.css') }}">
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Materials'])
        @include('includes.header')
        @include('includes.menu_mobile')
        <div class="sc_content_container">
            <div class="vc_empty_space" style="height: 5.1rem">
                <span class="vc_empty_space_inner"></span>
            </div>
            <div class="post_content entry-content">
                <div class="wpb-content-wrapper" style="text-align: center; margin: 0 5% 0;">
                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element daily-devotion">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Daily Devotion</h3>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="dd-item text-uppercase"> Day 1: Truth </div>
                                        <div class="dd-item text-uppercase"> Day 2: Righteousness </div>
                                        <div class="dd-item text-uppercase"> Day 3: Peace </div>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="dd-item text-uppercase"> Day 4: Faith </div>
                                        <div class="dd-item text-uppercase"> Day 5: Salvation </div>
                                        <div class="dd-item text-uppercase"> Day 6: The Word Of God </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Schedule</h3>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="dd-item text-uppercase">
                                            <h5 class="schedule"> May 31, 2025 <span class="schedule-sub"> Orientation </span> </h5>
                                        </div>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="dd-item text-uppercase">
                                            <h5 class="schedule"> June 7, 2025 <span class="schedule-sub"> Worship Time </span> </h5>
                                        </div>
                                    </div>
                                    </div>

                                <div class="vc_empty_space" style="height: 8rem">
                                    <span class="vc_empty_space_inner"></span>
                                </div>

                                <div class="wpb_content_element vc_align_left wpb_content_element schedule-list">
                                    <div id="sc_icons_1100097351" class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                                        <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1100097351_icon-icon-11" class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                                        <span class="sc_icon_type_ icon-icon-11"></span>
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        <span>DAY 1: Calling and Purpose</span>
                                                    </h4>
                                                    <div class="sc_icons_item_description"><span></span></div>
                                                </div>
                                            </div>
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1100097351_icon-icon-12" class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                                        <span class="sc_icon_type_ icon-icon-12"></span>
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        <span>DAY 2: Community and Equipping</span></h4>
                                                    <div class="sc_icons_item_description"><span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1464548671_icon-icon-13" class="sc_icons_icon sc_icon_type_ icon-icon-13">
                                                        <span class="sc_icon_type_ icon-icon-13"></span>
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        <span>DAY 3: Church and Evangelism</span></h4>
                                                    <div class="sc_icons_item_description"><span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>

                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element speakers">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Others</h3>
                                </div>

                                <div class="wpb_content_element vc_align_left wpb_content_element speakers" style="margin-top: 100px;">
                                    <h4 class="common-title-sub1" style="margin: 30px auto 30px; text-align: center !important;"> Spotify Playlist </h4>
                                    <iframe
                                        style="border-radius:12px; margin-bottom: 50px;"
                                            src="https://open.spotify.com/embed/playlist/37PX2Nc9EFriigs9FY0lhx?utm_source=generator&theme=0"
                                        width="100%"
                                        height="352"
                                        frameBorder="0"
                                        allowfullscreen=""
                                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <div class="vc_col-md-12 vc_col-sm-12 wpb_single_image wpb_content_element" style="margin-bottom: 100px; !important;">
                                    <img src="{{ asset('images/materials/fb-group-qrcode1.png') }}" alt="QR Code - Conquest 2025">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
