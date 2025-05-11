@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/dashboard.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.banner_common', ['title' => 'Dashboard'])
        @include('includes.header')
        @include('includes.menu_mobile')
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 style="margin:0 0 15px 0;"> Thy Persona </h3>
                                                    <table class="tbl-info-user">
                                                        <tr>
                                                            <th class="th-label">Registration Code</th>
                                                            <td class="td-value"> {{ Auth::user()->reg_code ?? "N/A" }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th-label">First Name</th>
                                                            <td class="td-value"> {{ Auth::user()->first_name ?? "N/A" }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th-label">Last Name</th>
                                                            <td class="td-value"> {{ Auth::user()->last_name ?? "N/A" }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th-label">Email</th>
                                                            <td class="td-value"> {{ Auth::user()->email ?? "N/A" }} </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wpb_column vc_column_container vc_col-md-6  vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                                                    <div class="container" style="margin: 25px 0 0 0;">
                                                        <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_content_element vc_align_left wpb_content_element">
                                                                        <h3 style="margin: 9.15rem 0 25px 0;"> TBA </h3>
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
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset("custom/js/puzzles-1st.js") }}"></script>
@endsection
