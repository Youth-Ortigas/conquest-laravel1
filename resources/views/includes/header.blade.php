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
                                    class="menu-item menu-item-type-custom menu-item-object-custom
                                    {{ Request::is('home') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/home') }}" class="sf-with-ul"><span>Home</span></a>
                                </li>

                                <li id="menu-item-272"
                                    class="menu-item menu-item-type-post_type menu-item-object-page
                                    {{ Request::is('puzzles*') ? 'current-menu-ancestor current-menu-parent' : '' }}">

                                    <a href="{{ url('/puzzles') }}" class="sf-with-ul"><span>Pre-Camp Activities</span></a>
                                </li> <!-- Changed this to Pre-Camp Activies, as discussed in our meeting-->



                                <li id="menu-item-258"
                                    class="menu-item menu-item-type-post_type menu-item-object-page
                                    {{ Request::is('updates*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/updates') }}"><span>Updates</span></a>
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
    </div>
</header>
