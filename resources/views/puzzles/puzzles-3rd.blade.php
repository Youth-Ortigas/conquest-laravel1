@extends('layouts.app')
@section('title', 'Home')
@section('page-class', 'home')

@section('content')
    {{ csrf_field() }}
    <div class="page_wrap">
        <div class="banner-main">
            <div class="vc_row wpb_row vc_row-fluid shape_divider_top-none shape_divider_bottom-none sc_layouts_row sc_layouts_row_type_normal scheme_dark">
                <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div id="sc_content_1925973386" class="sc_content color_style_default sc_content_default sc_content_width_1_1 sc_float_center">
                                <div class="sc_content_container">
                                    <div class="sc_layouts_item">
                                        <div id="sc_layouts_title_850083845" class="sc_layouts_title with_content without_image without_tint">
                                            <div class="sc_layouts_title_content">
                                                <div class="sc_layouts_title_title">
                                                    <h1 class="sc_layouts_title_caption">Third & Last Puzzle</h1>
                                                </div>
                                            </div><!-- .sc_layouts_title_content -->
                                        </div><!-- /.sc_layouts_title -->
                                    </div>
                                </div>
                            </div><!-- /.sc_content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="top_panel top_panel_custom top_panel_custom_592 top_panel_custom_header-home with_bg_image kings_queens_inline_219517677">
            <div
                class="vc_row wpb_row vc_row-fluid vc_custom_1521023294303 vc_row-o-equal-height vc_row-o-content-middle vc_row-flex shape_divider_top-none shape_divider_bottom-none sc_layouts_row sc_layouts_row_type_normal sc_layouts_row_fixed scheme_dark"
                style="top: auto;">
                <div
                    class="wpb_column vc_column_container vc_col-sm-3 vc_col-xs-7 sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left">
                    <div class="vc_column-inner vc_custom_1523451038926">
                        <div class="wpb_wrapper">
                            <div class="sc_layouts_item">
                                <a href="#" id="sc_layouts_logo_1605142163" class="sc_layouts_logo sc_layouts_logo_default">
                                    <img class="logo_image" src="{{ asset("images/ConquestLogo.png") }}" alt="Conquest">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="wpb_column vc_column_container vc_col-sm-9 vc_col-lg-6 vc_col-sm-offset-0 vc_col-xs-offset-3 vc_col-xs-2 sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div class="sc_layouts_item">
                                <nav
                                    class="sc_layouts_menu sc_layouts_menu_default sc_layouts_menu_dir_horizontal menu_hover_fade hide_on_mobile inited"
                                    id="sc_layouts_menu_348537080" data-animation-in="fadeInUpSmall"
                                    data-animation-out="fadeOutDownSmall">
                                    <ul id="sc_layouts_menu_106073659"
                                        class="sc_layouts_menu_nav inited sf-js-enabled sf-arrows"
                                        style="touch-action: pan-y;">
                                        <li id="menu-item-171"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-171">
                                            <a href="{{ env("APP_URL") }}/home" class="sf-with-ul"><span>Home</span></a>
                                            <ul class="sub-menu fadeOutDownSmall animated fast" style="display: none;">
                                                <li id="menu-item-381"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-367 current_page_item menu-item-381">
                                                    <a href="#" aria-current="page"><span>Home 1</span></a>
                                                </li>
                                                <li id="menu-item-382"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-382">
                                                    <a href="#"><span>Home 2</span></a>
                                                </li>
                                                <li id="menu-item-383"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-383">
                                                    <a href="#"><span>Home 3</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-272"
                                            class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-272">
                                            <a href="{{ url("/puzzles") }}" class="sf-with-ul"><span>Puzzles</span></a>
                                        </li>
                                        <li id="menu-item-258"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-258">
                                            <a href="{{ url("/updates") }}"><span>Updates</span></a>
                                        </li>
                                    </ul>
                                </nav><!-- /.sc_layouts_menu -->
                                <div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
                                    <a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
                                        <span
                                            class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="wpb_column vc_column_container vc_col-sm-3 vc_hidden-md vc_col-sm-offset-0 vc_hidden-sm vc_col-xs-offset-5 vc_col-xs-2 vc_hidden-xs sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div
                                class="sc_layouts_item sc_layouts_hide_on_mobile sc_layouts_hide_on_tablet sc_layouts_hide_on_notebook">
                                <div id="sc_layouts_cart_876795221"
                                     class="sc_layouts_cart hide_on_notebook hide_on_tablet hide_on_mobile vc_custom_1522141681777 inited">
                                    <span
                                        class="sc_layouts_item_icon sc_layouts_cart_icon trx_addons_icon-basket"></span>
                                    <span class="sc_layouts_item_details sc_layouts_cart_details">
						<span class="sc_layouts_item_details_line2 sc_layouts_cart_totals">
				<span class="sc_layouts_cart_items">0 items</span>
				<span class="sc_layouts_cart_summa">$0</span>
			</span>
		</span><!-- /.sc_layouts_cart_details -->
                                    <span class="sc_layouts_cart_items_short">0</span>
                                    <div class="sc_layouts_cart_widget widget_area">
                                        <span class="sc_layouts_cart_widget_close trx_addons_icon-cancel"></span>
                                        <div class="widget woocommerce widget_shopping_cart">
                                            <div class="widget_shopping_cart_content">

                                                <p class="woocommerce-mini-cart__empty-message">No products in the
                                                    cart.</p>


                                            </div>
                                        </div>
                                    </div><!-- /.sc_layouts_cart_widget -->
                                </div><!-- /.sc_layouts_cart --></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="menu_mobile_overlay" style="display: none;"></div>
        <div class="menu_mobile menu_mobile_fullscreen scheme_dark">
            <div class="menu_mobile_inner">
                <a class="menu_mobile_close icon-cancel"></a><a class="sc_layouts_logo"
                                                                href="{{ env("APP_URL") }}"><img
                        src="{{ asset('images/ConquestLogo.png') }}" alt="Conquest"
                        width="218" height="58"></a>
                <nav class="menu_mobile_nav_area">
                    <ul id="menu_mobile_1082560149" class="prepared">
                        <li id="menu_mobile-item-171"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-171 current-menu-ancestor current-menu-parent">
                            <a href="{{ env("APP_URL") }}/home"><span>Home</span><span class="open_child_menu"></span></a>
                            <ul class="sub-menu">
                                <li id="menu_mobile-item-381"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home page_item page-item-367 menu-item-381 current-menu-item current_page_item">
                                    <a href="{{ env("APP_URL") }}/home"
                                       aria-current="page"><span>Home 1</span></a></li>
                                <li id="menu_mobile-item-382"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-382"><a
                                        href="{{ env("APP_URL") }}/home"><span>Home 2</span></a></li>
                                <li id="menu_mobile-item-383"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-383"><a
                                        href="{{ env("APP_URL") }}/home"><span>Home 3</span></a></li>
                            </ul>
                        </li>
                        <li id="menu_mobile-item-272"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-272">
                            <a href="{{ env("APP_URL") }}/puzzles"><span>Puzzles</span><span class="open_child_menu"></span></a>
                        </li>
                        <li id="menu_mobile-item-258"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-258"><a
                                href="{{ env("APP_URL") }}/updates"><span>Updates</span></a></li>
                    </ul>
                </nav>
                <div class="search_wrap search_style_normal search_mobile inited">
                    <div class="search_form_wrap">
                        <form role="search" method="get" class="search_form"
                              action="#">
                            <input type="text" class="search_field fill_inited" placeholder="Search" value="" name="s">
                            <button type="submit" class="search_submit trx_addons_icon-search"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
