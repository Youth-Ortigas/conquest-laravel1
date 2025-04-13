@extends('layouts.app-guest')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/puzzle-1st.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/auth/login.css') }}">
    {{ csrf_field() }}
    <div class="page_wrap">
        @include('includes.banner_common', ['title' => 'Login'])
        @include('includes.header')
        @include('includes.menu_mobile')

        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper" style="display: flex;justify-content: center;align-items: center;">
                                                <form id="frm-login" role="form" action="{{ url('/login') }}" method="post">
                                                    {!! csrf_field() !!}
                                                    @if (!empty($status))
                                                        <div class="form-group">
                                                            <div class="error-msg">{{ $status }} </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group" style="margin-bottom: 15px;">
                                                        <div class="label mb-2 text-bold">Sacred Registration Code <span class="required-indicator">*</span></div>
                                                        <input type="text" class="form-control required mb-1" id="sacred_code" name="sacred_code" style="width:100%; border-color: #bd8d4c; text-align:center;" autofocus/>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-common"> Login </button>
                                                    </div>
                                                </form>
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
