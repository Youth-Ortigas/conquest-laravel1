<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_fullscreen scheme_dark">
    <div class="menu_mobile_inner">
        <a class="menu_mobile_close icon-cancel"></a>
        <a class="sc_layouts_logo" href="{{ route('home.index') }}">
            <img
                src="{{ asset('images/ConquestLogo.png') }}" alt="Conquest"
                width="218" height="58"
            >
        </a>
        <nav class="menu_mobile_nav_area">
            <ul id="menu_mobile_1082560149" class="prepared">
                <li id="menu-item-171"
                    class="menu-item menu-item-type-custom menu-item-object-custom
                    {{ Request::is('home') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/home') }}" class="sf-with-ul"><span>Home</span></a>
                </li>

                <li id="menu-item-272"
                    class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('puzzles*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/puzzles') }}" class="sf-with-ul"><span>Puzzles</span></a>
                </li>

                <li id="menu-item-258"
                    class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('updates*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/updates') }}"><span>Updates</span></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

