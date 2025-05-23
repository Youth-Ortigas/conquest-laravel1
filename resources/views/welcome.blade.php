@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('library/ResponsiveSlides.js/responsiveslides.css') }}"
          xmlns="http://www.w3.org/1999/html">
    <link rel="stylesheet" href="{{ asset('custom/css/home.css') }}">
    <div class="page_wrap">
        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap">
            <div class="wpb_revslider_element wpb_content_element">
                <ul class="rslides" id="slider">
                    <li><img src="{{ asset("images/conquest2025-moodboard1.png") }}" alt="Conquest Image"></li>
                    <video id="slide-video" width="640" height="360" autoplay loop muted>
                        <source src="{{ asset("videos/conquest2025-moodboard2.mp4") }}" type="video/mp4">
                        Your browser does not support the video tag. Use thy Chrome/Firefox/Safari for a better user experience
                    </video>
                </ul>
            </div>
            <div class="content_wrap" style="margin-bottom: 50px;">
                <div class="content">
                    <article id="post-367"
                             class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div class="vc_row wpb_row vc_row-fluid shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="welcome-section">
                                                        <h1 class="welcome-title" style="text-transform: uppercase"><br/><br/>Welcome Conquerors!</h1>
                                                        <p class="welcome-paragraph welcome-paragraph-initial">
                                                            <span class="dropcap">F</span>or the past years, Youth Camps have created an opportunity for us to raise students who follow God comprehensively, fish lost people
                                                            consistently, and fellowship cross-generationally. With the recent expansion of our horizon in reaching out to the campuses, this will provide an
                                                            avenue for us to evangelize, disciple, and raise leaders in our campuses in Ortigas and Cubao.
                                                        </p>
                                                        <p class="welcome-paragraph">
                                                            Our goal is to equip the students to become strong and mighty leaders in their fields by being armed with biblical truths in proclaiming and demonstrating the gospel through intentional discipleship and servant leadership.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vc_row-full-width vc_clearfix"></div>

                                <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-4 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner vc_custom_1521556308493">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper vc_box_border_grey">
                                                            <img loading="lazy" decoding="async" src="{{ asset("images/home/welcome-armor-of-god1.png") }}"
                                                                class="vc_single_image-img attachment-full" alt="The Whole Armor of God"
                                                                title="img-4-copyright"
                                                                srcset="{{ asset("images/home/welcome-armor-of-god1.png") }}">
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-8 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="container">
                                                    <div class="welcome-section">
                                                        <h1 class="welcome-title-sub" style="text-transform: uppercase"><br/>Ephesians 6:10-13 ESV</h1>
                                                        <p class="welcome-paragraph welcome-paragraph-initial">
                                                            10 Finally, be strong in the Lord and in the strength of his might.
                                                            <br/> 11 Put on the whole armor of God, that you may be able to stand against the schemes of the devil.
                                                            <br/> 12 For we do not wrestle against flesh and blood, but against the rulers, against the authorities, against the cosmic powers over this present darkness, against the spiritual forces of evil in the heavenly places.
                                                            <br/> 13 Therefore take up the whole armor of God, that you may be able to withstand in the evil day, and having done all, to stand firm.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vc_row-full-width vc_clearfix"></div>

                                <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none" style="margin-bottom: 25px;">
                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-6 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner vc_custom_1521556308493">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 class="common-title-sub"> The Hall Of Memories </h3>
                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper vc_box_border_grey">
                                                            <img loading="lazy" decoding="async" src="{{ asset("images/home/welcome-armor-of-god1.png") }}"
                                                                 class="vc_single_image-img attachment-full" alt="Hall Of Memories"
                                                                 title="img-4-copyright"
                                                                 srcset="{{ asset("images/home/hall-of-memories.png") }}">
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-6 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner vc_custom_1521556308493">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_left wpb_content_element">
                                                    <h3 class="common-title-sub"> Rizal Recreation Center Map </h3>
                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper vc_box_border_grey">
                                                            <img loading="lazy" decoding="async" src="{{ asset("images/home/welcome-armor-of-god1.png") }}"
                                                                 class="vc_single_image-img attachment-full" alt="Rizal Recreation Center Map"
                                                                 title="img-4-copyright"
                                                                 srcset="{{ asset("images/home/rizal-recreation-center-map.png") }}">
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vc_row-full-width vc_clearfix"></div>

                            </div>
                        </div>
                    </article>
                </div><!-- </.content> -->
            </div><!-- </.content_wrap> -->
        </div><!-- </.page_content_wrap> -->
    </div><!-- /.page_wrap -->
</div><!-- /.body_wrap -->


<a href="#" class="trx_addons_scroll_to_top trx_addons_icon-up inited" title="Scroll to top"></a>
@endsection
@section('footer-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset("library/ResponsiveSlides.js/responsiveslides.js") }}"></script>
    <script type="text/javascript" src="{{ asset("custom/js/home.js") }}"></script>
@endsection
