<header class="top_panel top_panel_custom_592 top_panel_custom_header-home with_bg_image kings_queens_inline_219517677" style="background-color: black !important; height: 100px;">
    <div
        class="vc_row wpb_row vc_row-fluid vc_custom_1521023294303 vc_row-o-equal-height vc_row-o-content-middle vc_row-flex shape_divider_top-none shape_divider_bottom-none sc_layouts_row sc_layouts_row_type_normal sc_layouts_row_fixed scheme_dark" style="top: auto;">
        <div class="wpb_column vc_column_container vc_col-sm-8 vc_col-md-9 vc_col-lg-9 vc_col-sm-offset-0 vc_col-xs-offset-3 vc_col-xs-2 sc_layouts_column sc_layouts_column_align_left" style="margin-top: -10px">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <div class="sc_layouts_item">
                        <nav class="sc_layouts_menu sc_layouts_menu_default sc_layouts_menu_dir_horizontal menu_hover_fade hide_on_mobile inited"
                            id="sc_layouts_menu_348537080" data-animation-in="fadeInUpSmall"
                            data-animation-out="fadeOutDownSmall">
                            <ul id="sc_layouts_menu_106073659"
                                class="sc_layouts_menu_nav inited sf-js-enabled sf-arrows"
                                style="touch-action: pan-y;">
                                <li id="menu-item-171" class="menu-item menu-item-type-custom menu-item-object-custom
                                    {{ Request::is('home') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/home') }}" class="sf-with-ul"><span>Home</span></a>
                                </li>
                                <li id="menu-item-272"
                                    class="menu-item menu-item-type-post_type menu-item-object-page
                                    {{ Request::is('puzzles*') | Request::is('team-leaderboards*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/puzzles') }}" class="sf-with-ul"><span>Pre-Camp Activities</span></a>
                                </li>
                                <li id="menu-item-258"
                                    class="menu-item menu-item-type-post_type menu-item-object-page
                                    {{ Request::is('updates*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/updates') }}"><span>Updates</span></a>
                                </li>
                                <li id="menu-item-259"
                                    class="menu-item menu-item-type-post_type menu-item-object-page
                                    {{ Request::is('materials*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                    <a href="{{ url('/materials') }}"><span>Materials</span></a>
                                </li>
                                @if (Auth::check())
                                    <li id="menu-item-260" class="menu-item menu-item-type-post_type menu-item-object-page
                                            {{ Request::is('logout*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                                            <a href="/logout"><span>Logout</span></a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                        <div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button" style="margin-top: 6px">
                            <a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
                                <span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wpb_column vc_column_container vc_col-sm-3 vc_col-xs-12 sc_layouts_column sc_layouts_column_align_right" style="margin-top: 15px">
            <div class="vc_column-inner vc_custom_1523451038926">
                <div class="wpb_wrapper">
                    <div class="sc_layouts_item">
                        @php
                            $checkLoggedStatus = Auth::check();
                            $loggedInName = Auth::check() && Auth::user()->first_name
                            ? explode(' ', Auth::user()->first_name)[0]
                            : '';
                            $loggedInTeamName = Auth::user()->team->team_name ?? "";
                            $loggedInTeamName = implode(' ', array_slice(explode(' ', $loggedInTeamName), -2));
                            $buttonText = $checkLoggedStatus ? "Hail $loggedInName of the $loggedInTeamName!" : "Step To Thy Conquest!";
                            $buttonLink = $checkLoggedStatus ? "/dashboard" : "/login";
                        @endphp
                        <a href="{{ $buttonLink }}" class="sc_button color_style_default sc_button_bordered sc_button_size_normal sc_button_with_icon sc_button_icon_left" id="btn-step-to-thy-conquest">
                            <span class="sc_button_icon">
                                <span class="icon-icon-2"></span>
                            </span>
                            <span class="sc_button_text">
                                <span class="sc_button_title">
                                    {{ $buttonText }}
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
