@php
    $checkLoggedStatus = Auth::check();
    $loggedInName = Auth::check() && Auth::user()->first_name ? explode(' ', Auth::user()->first_name)[0] : '';
    $loggedInTeamName = Auth::user()->team->team_name ?? "";
    $buttonText = $checkLoggedStatus ? "Hail $loggedInName of the $loggedInTeamName!" : "Step To Thy Conquest!";
    $buttonLink = $checkLoggedStatus ? "/dashboard" : "/login";
@endphp

<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_fullscreen scheme_dark">
    <div class="menu_mobile_inner">
        <a class="menu_mobile_close icon-cancel"></a>
        <a class="sc_layouts_logo" href="{{ route('home.index') }}">
            <img src="{{ asset('images/mobile/conquestlogo.png') }}" alt="Conquest 2025 Youth Camp">
        </a>
        <nav class="menu_mobile_nav_area">
            <ul id="menu_mobile_1082560149" class="prepared">
                <li id="menu-item-171" class="menu-item menu-item-type-custom menu-item-object-custom
                    {{ Request::is('home') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/home') }}" class="sf-with-ul"><span>Home</span></a>
                </li>
                <li id="menu-item-272" class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('puzzles*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/puzzles') }}" class="sf-with-ul"><span>Pre-Camp Activities</span></a>
                </li>
                <li id="menu-item-258" class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('updates*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/updates') }}"><span>Updates</span></a>
                </li>
                <li id="menu-item-259" class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('materials*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ url('/materials') }}"><span>Materials</span></a>
                </li>
                <li id="menu-item-259" class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('login*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                    <a href="{{ $buttonLink }}"><span>{{ $buttonText }}</span></a>
                </li>
                @if (Auth::check())
                    <li id="menu-item-260" class="menu-item menu-item-type-post_type menu-item-object-page
                    {{ Request::is('logout*') ? 'current-menu-ancestor current-menu-parent' : '' }}">
                        <a href="/logout"><span>Logout</span></a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>

