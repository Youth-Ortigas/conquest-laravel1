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
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367"
                             class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div class="vc_row wpb_row vc_row-fluid shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner vc_custom_1523868071853">
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
                                <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none">
                                    <div class="wpb_column vc_column_container vc_col-sm-2 vc_col-has-fill sc_layouts_column_icons_position_left">
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
                                                <div class="vc_empty_space  hide_on_mobile" style="height: 8rem"><span class="vc_empty_space_inner"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-6 vc_col-md-offset-1 vc_col-md-5 sc_layouts_column_icons_position_left scheme_default">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 3.3rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_title_176277804"
                                                     class="sc_title color_style_default scheme_default sc_title_default  vc_custom_1732093109752">
                                                    <h6 class="sc_item_subtitle sc_title_subtitle sc_align_left sc_item_title_style_default">
                                                        Welcome Youths!</h6>
                                                    <h2 class="sc_item_title sc_title_title sc_align_left sc_item_title_style_default">
                                                        Conquest Youth Camp 2025</h2>
                                                    <div class="sc_item_descr sc_title_descr sc_align_left">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
                                                        </p>
                                                    </div>
                                                </div><!-- /.sc_title --></div>
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
                                        class="wpb_column vc_column_container vc_col-sm-6 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 2.5rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_title_412861930"
                                                     class="sc_title color_style_default sc_title_default  vc_custom_1521626058719">
                                                    <h3 class="sc_item_title sc_title_title sc_align_left sc_item_title_style_default sc_item_title_tag">
                                                        More than just a youth camp</h3>
                                                </div><!-- /.sc_title -->
                                                <div id="sc_title_2131711708"
                                                     class="sc_title color_style_default sc_title_default  vc_custom_1523444662354">
                                                    <div class="sc_item_descr sc_title_descr sc_align_left">
                                                        <p>
                                                            A Christian Youth and Sports Center-calm and peaceful place
                                                            with the awesome beauty of God's wonderful creation.
                                                        </p>
                                                    </div>
                                                </div><!-- /.sc_title -->
                                                <div class="vc_empty_space" style="height: 2.1rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_title_129112229"
                                                     class="sc_title color_style_default sc_title_default italic"><h3
                                                        class="sc_item_title sc_title_title sc_align_left sc_item_title_style_default sc_item_title_tag">
                                                        “Finally, be strong in the Lord and in the strength of his might."
                                                        <br/>"Put on the whole armor of God, that you may be able to stand against the schemes of the devil..”
                                                        <br/>[Ephesians 6:10-11]
                                                    </h3>
                                                </div>
                                                <!-- /.sc_title -->
                                                <div
                                                    class="vc_empty_space  hide_on_desktop hide_on_notebook hide_on_tablet sc_height_medium"
                                                    style="height: 32px"><span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-6 sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div
                                                    class="wpb_single_image wpb_content_element vc_align_right wpb_content_element  image_shadow">

                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img
                                                                decoding="async" class="vc_single_image-img "
                                                                src="{{ asset("images/home/index-armor-of-god2.png") }}"
                                                                width="547" height="429" alt="img-15-copyright"
                                                                title="img-15-copyright" loading="lazy"></div>
                                                    </figure>
                                                </div>
                                                <div class="vc_empty_space" style="height: 1rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div class="sc_item_button sc_button_wrap sc_align_right">
                                                    <a href="/gallery/" target="_blank" id="sc_button_1186694204" class="sc_button color_style_default sc_button_simple sc_button_size_normal sc_button_icon_left">
                                                        <span class="sc_button_text">
                                                            <span class="sc_button_title">Go to Gallery</span>
                                                        </span>
                                                        <!-- /.sc_button_text --></a><!-- /.sc_button -->
                                                </div>
                                                <!-- /.sc_item_button --></div>
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
                                >
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
                                                                sizes="auto, (max-width: 1871px) 100vw, 1871px">
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1516978326411 vc_row-has-fill shape_divider_top-none shape_divider_bottom-none"
                                >
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 vc_col-md-offset-3 vc_col-md-6 sc_layouts_column_icons_position_left scheme_default">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space" style="height: 8.25rem"><span
                                                        class="vc_empty_space_inner"></span></div>
                                                <div id="sc_title_855607521"
                                                     class="sc_title color_style_default sc_title_default">
                                                    <h6 class="sc_item_subtitle sc_title_subtitle sc_align_center sc_item_title_style_default">Day-to-Day</h6>
                                                    <h2 class="sc_item_title sc_title_title sc_align_center sc_item_title_style_default">Schedule</h2> <!--Added these changes based on the meeting-->
                                                    <div class="sc_item_descr sc_title_descr sc_align_center"><p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                        </p>
                                                    </div>
                                                </div><!-- /.sc_title --></div>
                                        </div>
                                    </div>
                                    <div
                                        class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left scheme_default">
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
                        </div><!-- .entry-content -->


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
