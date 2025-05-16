@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    {{ csrf_field() }}
    <link rel="stylesheet" href="{{ asset('custom/css/puzzle-3rd.css') }}">
    <div class="page_wrap">
        @include('includes.puzzle_banner', ['title' => 'Words and Letters: Fill in the Blanks']) <!--Added puzzle title based on documentation-->

        @include('includes.header')

        @include('includes.menu_mobile')

        <div class="page_content_wrap" id="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                    <article id="post-367" class="post_item_single post_type_page post-367 page type-page status-publish hentry">
                        <div class="post_content entry-content">
                            <div class="wpb-content-wrapper">
                                <div data-vc-full-width="true" data-vc-full-width-init="true"
                                     class="vc_row wpb_row vc_row-fluid vc_custom_1522153891227 vc_row-has-fill hide_bg_image_on_tablet hide_bg_image_on_mobile shape_divider_top-none shape_divider_bottom-none"
                                     style="width: 1481.75px; left: -86.875px; right: auto; padding-left: 86.875px; padding-right: 86.875px; position: relative; box-sizing: border-box; max-width: 1512px;"
                                >
                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                        <div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div class="wpb_single_image wpb_content_element vc_align_center wpb_content_element">
                                                    <div class="container">
                                                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill sc_layouts_column_icons_position_left">
                                                            <div class="vc_column-inner">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_content_element vc_align_center wpb_content_element">
                                                                        <div class="custom-puzzle-container">
                                                                            <div class="scroll-container">
                                                                                <div class="scroll-label" id="scrollLabel">📜 Unfurl the Sacred Scroll</div>

                                                                                <div class="scroll-paper" id="scrollPaper">
                                                                                    <div class="scroll-content-wrapper">
                                                                                        <div class="scroll-content" id="scrollContent">
                                                                                            <h1 style="margin: 0">Ephesians 6:10-20: The Armor of God</h1>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">10</span>
                                                                                                Finally, be strong in the Lord and in the
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                of his might.
                                                                                            </div>

                                                                                            <div class="verse">
                                                                                                <span class="verse-number">11</span>
                                                                                                Put on the whole
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                of God, that you may be able to stand against the schemes of the devil.
                                                                                            </div>

                                                                                            <div class="verse">
                                                                                                <span class="verse-number">12</span>
                                                                                                For we do not wrestle against flesh and blood, but against the rulers, against the
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                , against the cosmic
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                over this present darkness, against the spiritual forces of evil in the heavenly places.
                                                                                            </div>

                                                                                            <div class="verse">
                                                                                                <span class="verse-number">13</span>
                                                                                                Therefore take up the whole armor of God, that you may be able to
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                in the evil day, and having done all, to stand firm.
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">14</span>
                                                                                                Stand therefore, having
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                on the belt of truth, and having put on the breastplate of
                                                                                                <input type="text" class="fill-blank longer" placeholder="_____________">
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">15</span>
                                                                                                and, as shoes for your feet, having put on the
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                given by the gospel of peace.
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">16</span>
                                                                                                In all circumstances take up the shield of faith, with which you can
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                all the flaming darts of the evil one;
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">17</span>
                                                                                                and take the helmet of
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                , and the sword of the Spirit, which is the word of God,
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">18</span>
                                                                                                praying at all times in the Spirit, with all prayer and supplication. To that end, keep alert with all
                                                                                                <input type="text" class="fill-blank longer" placeholder="________">,
                                                                                                making supplication for all the saints,
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">19</span>
                                                                                                and also for me, that words may be given to me in opening my
                                                                                                <input type="text" class="fill-blank" placeholder="________">
                                                                                                boldly to proclaim the mystery of the gospel,
                                                                                            </div>
                                                                                            <div class="verse">
                                                                                                <span class="verse-number">20</span>
                                                                                                for which I am an
                                                                                                <input type="text" class="fill-blank longer" placeholder="________">
                                                                                                in chains, that I may declare it boldly, as I ought to speak.
                                                                                            </div>

                                                                                            <button id="btn-submit-answers" type="button" disabled>Submit</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {!! asset_versioned('/custom/js/puzzles-3rd.js', 'js', 'type="text/javascript"') !!}
@endsection
