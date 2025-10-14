<!-- partial:partials/_sidebar.html -->
@php
    $currentRouteName = Route::currentRouteName()
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                    @if(isset(Auth::user()->profile_image))
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="image">
                    @else
                        <img src="{{ asset('public/admin') }}/images/faces/face29.png" alt="image">
                    @endif
                    <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                        {{ Auth::user()->name ?? '' }}
                    </p>
                    <p class="sidebar-designation">
                        Welcome
                    </p>
                </div>
            </div>
            <div class="nav-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type to search..." aria-label="search"
                           aria-describedby="search">
                    <div class="input-group-append">
                  <span class="input-group-text" id="search">
                    <i class="typcn typcn-zoom"></i>
                  </span>
                    </div>
                </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
        </li>

        {{--    Dashboard    --}}
        <li class="nav-item @if($currentRouteName == 'admin.dashboard') active @endif">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="typcn typcn-home menu-icon"></i>
                <span class="menu-title">Dashboard </span>
            </a>
        </li>

        {{--   Admin & Role management     --}}
        @canany(['View Admin', 'View Role', 'View Permission'])
            <li class="nav-item @if(request()->routeIs('admin.admin.*','admin.role.*','admin.permission.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                   aria-controls="ui-basic">
                    <i class="typcn typcn-user menu-icon"></i>
                    <span class="menu-title">Admins</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.admin.*','admin.role.*','admin.permission.*')) show @endif"
                    id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        @can('View Admin')
                            <li class="nav-item">
                                <a class="nav-link @if($currentRouteName == 'admin.admin.index') active @endif"
                                   href="{{ route('admin.admin.index') }}">
                                    Admins
                                </a>
                            </li>
                        @endcan

                        @can('View Role')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.role.index') active @endif"
                                    href="{{ route('admin.role.index') }}">Roles</a></li>
                        @endcan

                        @can('View Permission')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.permission.index') active @endif"
                                    href="{{ route('admin.permission.index') }}">Permissions</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--    Product Manage    --}}
        @canany(['View Category'])
            <li class="nav-item @if(request()->routeIs('admin.category.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false"
                   aria-controls="product">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Category Management</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.category.*')) show @endif"
                    id="product">
                    <ul class="nav flex-column sub-menu">
                        @can('View Category')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.category.index') active @endif"
                                    href="{{ route('admin.category.index') }}">Category</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--   Core Content     --}}
        <li class="nav-item @if(request()->routeIs('admin.geography.*,admin.history.*,admin.collision.*,admin.live.*,admin.migration.*,admin.political.*,admin.technology.*,admin.community.*,admin.modern.*,admin.tradition.*,admin.contemporary.*')) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#content" aria-expanded="false"
               aria-controls="content">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Core Contents</span>
                <i class="typcn typcn-chevron-right menu-arrow"></i>
            </a>

            <div
                class="collapse @if(request()->routeIs('admin.geography.*,admin.history.*,admin.collision.*,admin.live.*,admin.migration.*,admin.political.*,admin.technology.*,admin.community.*,admin.modern.*,admin.tradition.*,admin.contemporary.*')) show @endif"
                id="content">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.geography.index') active @endif"
                            href="{{ route('admin.geography.index') }}">Geography</a>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.history.index') active @endif"
                            href="{{ route('admin.history.index') }}">History</a>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.collision.index') active @endif"
                            href="{{ route('admin.collision.index') }}">Collision</a>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.live.index') active @endif"
                            href="{{ route('admin.live.index') }}">Live</a>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.migration.index') active @endif"
                            href="{{ route('admin.migration.index') }}">Migration</a>
                    </li>

                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.political.index') active @endif"
                            href="{{ route('admin.political.index') }}">Political</a>
                    </li>
                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.technology.index') active @endif"
                            href="{{ route('admin.technology.index') }}">Technology</a>
                    </li>
                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.community.index') active @endif"
                            href="{{ route('admin.community.index') }}">Community</a>
                    </li>
                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.modern.index') active @endif"
                            href="{{ route('admin.modern.index') }}">Modern</a>
                    </li>
                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.tradition.index') active @endif"
                            href="{{ route('admin.tradition.index') }}">Tradition</a>
                    </li>
                    <li class="nav-item"><a
                            class="nav-link @if($currentRouteName == 'admin.contemporary.index') active @endif"
                            href="{{ route('admin.contemporary.index') }}">Contemporary</a>
                    </li>
                </ul>
            </div>
        </li>


        {{--    Slider and Banner    --}}
        @canany(['View Slider', 'View Banner'])
            <li class="nav-item @if(request()->routeIs('admin.slider.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#sliderBanner" aria-expanded="false"
                   aria-controls="sliderBanner">
                    <i class="typcn typcn-image menu-icon"></i>
                    <span class="menu-title">Hero Section</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.slider.*')) show @endif"
                     id="sliderBanner">
                    <ul class="nav flex-column sub-menu">

                        @can('View Slider')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.slider.index') active @endif"
                                    href="{{ route('admin.slider.index') }}">Slider</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany


        {{--   Pages     --}}
        @can('View Page')
            <li class="nav-item @if(request()->routeIs('admin.page.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages">
                    <i class="typcn typcn-document menu-icon"></i>
                    <span class="menu-title">Pages</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.page.*')) show @endif" id="pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a
                                class="nav-link @if($currentRouteName == 'admin.page.index') active @endif"
                                href="{{ route('admin.page.index') }}">Page List</a></li>
                        <li class="nav-item"><a
                                class="nav-link @if($currentRouteName == 'admin.page.create') active @endif"
                                href="{{ route('admin.page.create') }}">Page Create</a></li>
                    </ul>
                </div>
            </li>
        @endcan

        {{--   Settings     --}}
        @canany(['Basic Info'])
            <li class="nav-item  @if(request()->routeIs('admin.basic-info.index')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                   aria-controls="form-elements">
                    <i class="typcn typcn-spanner menu-icon"></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.basic-info.index')) show @endif"
                     id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        @can('Basic Info')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.basic-info.index') active @endif"
                                    href="{{ route('admin.basic-info.index') }}">Basic Info</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany
    </ul>

</nav>
<!-- partial -->
