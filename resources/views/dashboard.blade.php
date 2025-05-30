@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/dashboard.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.header')
        @include('includes.banner_common', ['title' => 'Dashboard'])
        @include('includes.menu_mobile')
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none" style="margin: 0 0 30px 0 !important;">
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left" style="margin-top: 30px; overflow-x: auto">
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

                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left" style="margin-top: 30px; overflow-x: auto">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 style="margin:0 0 15px 0;"> Thy Team & Cabin </h3>
                                                    <?php
                                                        $loggedUser = \App\Models\User::find(Auth::user()->id);
                                                        if(isset($loggedUser->team)) {

                                                            $loggedUserLeaderMain = \App\Models\User::find($loggedUser->team->team_leader_user_id_primary) ?? 'N/A';
                                                            $loggedUserLeaderSecondary = \App\Models\User::find($loggedUser->team->team_leader_user_id_secondary) ?? 'N/A';
                                                        }
                                                    ?>
                                                    <table class="tbl-info-user">
                                                        <tr>
                                                            <th class="th-label">Team Name</th>
                                                            <td class="td-value"> {{ $loggedUser->team?->team_name ?? "N/A" }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th-label">Cabin Name</th>
                                                            <td class="td-value"> {{ $loggedUser->teamMember?->cabin_name ?? "N/A" }} </td>
                                                        </tr>
                                                        @if($loggedUser->team?->id != 11 && isset($loggedUser->team))
                                                        <tr>
                                                            <th class="th-label">Team Leader/s & Email/s </th>
                                                            <td class="td-value">
                                                                <p> <b>Main:</b> {{ $loggedUserLeaderMain->first_name ?? "N/A" }} {{ $loggedUserLeaderMain->last_name ?? "N/A" }} ({{ $loggedUserLeaderMain->email ?? "N/A" }}) </p>
                                                                <p style="margin: 0;"> <b>Assistant:</b> {{ $loggedUserLeaderSecondary->first_name ?? "N/A" }} {{ $loggedUserLeaderSecondary->last_name ?? "N/A" }} ({{ $loggedUserLeaderSecondary->email ?? "N/A" }}) </p>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-md-6 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left" style="margin-top: 30px; overflow-x: auto">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper" style="margin-left: 15px;">
                                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 style="margin:0 0 15px 0;"> Thy Decrees </h3>
                                                    <table class="tbl-info-user">
                                                        <tr>
                                                            <th class="th-label">Waiver Form</th>
                                                            <td class="td-value"><a href="/document-sign/waiver-form"> Click here </a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vc_empty_space" style="height: 7rem">
                                    <span class="vc_empty_space_inner"></span>
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
@endsection
