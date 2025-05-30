@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    <link rel="stylesheet" href="{{ asset('custom/css/updates.css') }}">
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Updates'])
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
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Reminders</h3>
                                    @if(now()->greaterThanOrEqualTo('2025-05-31 17:00:00'))
                                    <div class="common-paragraph">
                                        <ol class="list-number" style="color: #000000;">
                                            <li>Pack your essentials.</li>
                                            <li>Don’t forget to submit/send your signed waivers in the website</li>
                                            <li>Bringing of gadgets and valuables is not discouraged, however, whatever you bring is your responsibility.</li>
                                            <li> Expect moderate to extreme physical activities. If you have medical conditions, please advise your team leader.</li>
                                            <li>Food will be provided throughout the 3-day camp, but feel free to bring a pocket money because the snack bar will be available.</li>
                                            <li>Make sure to eat heavy breakfast for more energy.</li>
                                            <li>Our daily devotionals are posted on the “materials” page and on our Facebook Group Page.</li>
                                            <li>Set you alarm! The bus will leave at 8AM sharp.</li>
                                            <li>During your free time, you may enjoy the pool amenities of the venue, but make sure to have an appropriate swimwear.</li>
                                            <li>Don’t forget your personal medication (if there’s any).</li>
                                            <li>Be ready for a rainy weather. Bring your jacket and umbrella.</li>
                                            <li>Be sure to check our Facebook group for announcements.</li>
                                            <li>Enjoy the camp and meet new friends!</li>
                                        </ol>
                                    </div>
                                    @else
                                        <h4>Details to Be Announced</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>What to bring</h3>
                                        @if(now()->greaterThanOrEqualTo('2025-06-06 08:00:00'))
                                        <div class="wpb_column vc_column_container vc_col-md-7 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left common-paragraph">
                                            <ul class="what-to-bring">
                                                <li>Camp Kit</li>
                                                <li>Clothes (such as pajamas, sportswear, and daily wear)</li>
                                                <li>Slippers and shoes</li>
                                                <li>Toiletries (such as shampoo, soap, toothbrush, toothpaste, etc.)</li>
                                                <li>Personal hygiene (such as deodorant, sanitary pads, etc.)</li>
                                                <li>Bath and face towels</li>
                                            </ul>
                                        </div>
                                        <div class="wpb_column vc_column_container vc_col-md-5 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left common-paragraph">
                                            <ul class="what-to-bring">
                                                <li>Tumbler or Water bottle</li>
                                                <li>Personal Medication</li>
                                                <li>Colored Team Shirt and Bandanas</li>
                                                <li>Bible</li>
                                                <li>Notebook and pen</li>
                                                <li>Jacket</li>
                                                <li>Umbrella</li>
                                                <li>Pocket Money</li>
                                                <li>Plastic bag for wet clothes</li>
                                            </ul>
                                        </div>
                                        @else
                                            <h4>Details to Be Announced</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="wpb_column vc_column_container vc_col-md-12 vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_content_element vc_align_left wpb_content_element speakers">
                                    <h3 class="welcome-title" style="margin: 0 0 50px 0; !important;"><br/><br/>Speakers</h3>
                                        @if(now()->greaterThanOrEqualTo('2025-06-08 08:00:00'))
                                        <div class="sc_icons_columns_wrap sc_item_columns trx_addons_columns_wrap columns_padding_bottom" style="margin-bottom: 50px">
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1100097351_icon-icon-11" class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                                        <img src="{{ asset('images/updates/ptr-rommel-tatoy1.png') }}" alt="Ptr. Rommel Tatoy">
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        Session 1
                                                    </h4>
                                                    <div class="sc_icons_item_description">
                                                        <h6 class="text-uppercase">Ptr. Rommel Tatoy</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1100097351_icon-icon-11" class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                                        <img src="{{ asset('images/updates/bishop-juray-mora1.png') }}" alt="Bishop Juray Mora">
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        Session 2
                                                    </h4>
                                                    <div class="sc_icons_item_description">
                                                        <h6 class="text-uppercase">Bishop Juray Mora</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trx_addons_column-1_3">
                                                <div class="sc_icons_item sc_icons_item_linked">
                                                    <div id="sc_icons_1100097351_icon-icon-11" class="sc_icons_icon sc_icon_type_ icon-icon-11">
                                                        <img src="{{ asset('images/updates/ptr-noel-landicho1.png') }}" alt="Ptr. Noel Landicho">
                                                    </div>
                                                    <h4 class="sc_icons_item_title">
                                                        Session 3
                                                    </h4>
                                                    <div class="sc_icons_item_description">
                                                        <h6 class="text-uppercase">Ptr. Noel Landicho</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <h4 style="margin-bottom: 90px">Details to Be Announced</h4>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
