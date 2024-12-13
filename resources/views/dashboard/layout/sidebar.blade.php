<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                </li>
                <li class="nav-item {{ request()->is('dashboard/*') ? 'active-bg' : '' }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>List Menu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            @php
                                $role_id = auth()->user()->role_id;
                                $menus = App\Models\Menu::whereHas('settingMenus', function ($query) use ($role_id) {
                                    $query->where('role_id', $role_id);
                                })->get();
                            @endphp

                            @foreach ($menus as $menu)
                                <li class="{{ request()->is('dashboard/' . $menu->link_menu . '*') ? 'active' : '' }}">
                                    <a href="/dashboard/{{ $menu->link_menu }}"
                                        class="{{ request()->is('dashboard/' . $menu->link_menu . '*') ? 'active' : '' }}">
                                        <span class="sub-item">{{ $menu->nama_menu }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
