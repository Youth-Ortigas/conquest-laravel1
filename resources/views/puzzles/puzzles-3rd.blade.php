@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Third Puzzle'])

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

                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                        <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_content_element vc_align_left wpb_content_element">
                                                                        <h3 style="margin: 9.15rem 0 25px 0;"> TBA </h3>
                                                                        <h4> TBA </h4>
                                                                        <label style="display: block; margin-top: 25px;">
                                                                            <input type="text" name="puzzle_code_3rd" placeholder="ENTER KEY"/>
                                                                            <button type="submit" style="margin-left: 15px;" id="btn-puzzle-send"> TBA </button>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner" style="padding-right:0;">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                                        <div class="container" style="margin: 25px 0 0 0; padding-right:0;">
                                                                            <img src="{{ asset("images/conquestclue.jpg") }}" />
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
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div
                                    class="vc_row wpb_row vc_row-fluid vc_custom_1522153958676 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 3.45rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 9.6rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     data-vc-stretch-content="true"
                                     class="vc_row wpb_row vc_row-fluid vc_row-no-padding shape_divider_top-none shape_divider_bottom-none"
                                     style="width: 1481.75px; left: -86.875px; right: auto; padding-left: 0px; padding-right: 0px; position: relative; box-sizing: border-box; max-width: 1512px;">
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner vc_custom_1521627361881">
                                            <div class="wpb_wrapper">
                                                <div
                                                    class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">

                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img
                                                                loading="lazy" decoding="async" width="1871" height="95"
                                                                src="{{ asset("wp-content/uploads/2018/03/top_dark.png") }}"
                                                                class="vc_single_image-img attachment-full" alt=""
                                                                title="top_dark"
                                                                srcset="{{ asset("wp-content/uploads/2018/03/top_dark.png") }}"
                                                                sizes="auto, (max-width: 1871px) 100vw, 1871px"></div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1516978326411 vc_row-has-fill shape_divider_top-none shape_divider_bottom-none"
                                     style="width: 1481.75px; left: -86.875px; right: auto; padding-left: 86.875px; padding-right: 86.875px; position: relative; box-sizing: border-box; max-width: 1512px;">
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-offset-3 vc_col-md-6 sc_layouts_column_icons_position_left scheme_default">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 8.25rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_title_855607521"
                                                     class="sc_title color_style_default sc_title_default">
                                                    <h6 class="sc_item_subtitle sc_title_subtitle sc_align_center sc_item_title_style_default">Programs</h6>
                                                    <h2 class="sc_item_title sc_title_title sc_align_center sc_item_title_style_default">Flow</h2>
                                                    <div class="sc_item_descr sc_title_descr sc_align_center"><p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                        </p>
                                                    </div>
                                                </div><!-- /.sc_title --></div>
                                        </div>
                                    </div>
                                    <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left scheme_default">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 3.1rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_icons_1100097351"
                                                     class="sc_icons sc_icons_default sc_icons_size_medium sc_align_center">
                                                    <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                                                        <div class="trx_addons_column-1_3">
                                                            <div class="sc_icons_item sc_icons_item_linked">
                                                                <div id="sc_icons_1100097351_icon-icon-11"
                                                                     class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                                                    <span class="sc_icon_type_ icon-icon-11"></span>
                                                                </div>
                                                                <h4 class="sc_icons_item_title">
                                                                    <span>Day 1</span></h4>
                                                                <div class="sc_icons_item_description"><span>Calling as an Individual</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="trx_addons_column-1_3">
                                                            <div class="sc_icons_item sc_icons_item_linked">
                                                                <div id="sc_icons_1100097351_icon-icon-12"
                                                                     class="sc_icons_icon sc_icon_type_ icon-icon-12">
                                                                    <span class="sc_icon_type_ icon-icon-12"></span>
                                                                </div>
                                                                <h4 class="sc_icons_item_title">
                                                                    <span>Day 2</span></h4>
                                                                <div class="sc_icons_item_description"><span>Calling with the Church Community</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="trx_addons_column-1_3">
                                                            <div class="sc_icons_item sc_icons_item_linked">
                                                                <div id="sc_icons_1100097351_icon-icon-13"
                                                                     class="sc_icons_icon sc_icon_type_ icon-icon-13">
                                                                    <span class="sc_icon_type_ icon-icon-13"></span>
                                                                </div>
                                                                <h4 class="sc_icons_item_title"><span>Day 3</span>
                                                                </h4>
                                                                <div class="sc_icons_item_description"><span>Calling to the Mission Field</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.sc_icons -->
                                                <div class="vc_empty_space" style="height: 1.2em">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <div class="vc_empty_space" style="height: 7.8rem">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div class="vc_row-full-width vc_clearfix"></div>
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
    <script type="text/javascript" src="{{ asset("custom/js/puzzles-2nd.js") }}"></script>
@endsection
