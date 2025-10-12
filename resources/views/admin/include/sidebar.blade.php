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

        {{--     Affiliate      --}}
        @can('View Affiliate')
            <li class="nav-item @if(request()->routeIs('admin.affiliate.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#affiliate" aria-expanded="false"
                   aria-controls="ui-basic">
                    <i class="typcn typcn-user-add-outline menu-icon"></i>
                    <span class="menu-title">Affiliate</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.affiliate.*')) show @endif" id="affiliate">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a
                                class="nav-link @if($currentRouteName == 'admin.affiliate.index') active @endif"
                                href="{{ route('admin.affiliate.index') }}">Affiliates</a></li>
                    </ul>
                </div>

            </li>
        @endcan

        {{--    Product Manage    --}}
        @canany(['View Category', 'View Subcategory', 'View Child Category', 'View Brand', 'View Type', 'View Product', 'View Color', 'View Variant'])
            <li class="nav-item @if(request()->routeIs('admin.category.*','admin.subcategory.*','admin.child-category.*','admin.brand.*','admin.product-type.*','admin.product.*','admin.color.*','admin.variant.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false"
                   aria-controls="product">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Product Management</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.category.*','admin.subcategory.*','admin.child-category.*','admin.brand.*','admin.product-type.*','admin.product.*','admin.color.*','admin.variant.*')) show @endif"
                    id="product">
                    <ul class="nav flex-column sub-menu">
                        @can('View Category')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.category.index') active @endif"
                                    href="{{ route('admin.category.index') }}">Category</a></li>
                        @endcan

                        @can('View Subcategory')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.subcategory.index') active @endif"
                                    href="{{ route('admin.subcategory.index') }}">Subcategory</a></li>
                        @endcan

                        @can('View Child Category')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.child-category.index') active @endif"
                                    href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                        @endcan

                        @can('View Brand')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.brand.index') active @endif"
                                    href="{{ route('admin.brand.index') }}">Brand</a></li>
                        @endcan

                        @can('View Type')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.product-type.index') active @endif"
                                    href="{{ route('admin.product-type.index') }}">Product Type</a></li>
                        @endcan

                        @can('View Product')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.product.index') active @endif"
                                    href="{{ route('admin.product.index') }}">Product List</a></li>
                        @endcan

                        @can('Create Product')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.product.create') active @endif"
                                    href="{{ route('admin.product.create') }}">Product Create</a></li>
                        @endcan

                        @can('View Color')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.color.index') active @endif"
                                    href="{{ route('admin.color.index') }}">Colors</a></li>
                        @endcan

                        @can('View Variant')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.variant.index') active @endif"
                                    href="{{ route('admin.variant.index') }}">Variants</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--    Order Manage    --}}
        @canany(['View Coupon', 'View Order'])
            <li class="nav-item @if(request()->routeIs('admin.coupon.*','admin.order.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                    <i class="typcn typcn-shopping-cart menu-icon"></i>
                    <span class="menu-title">Order Management</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.coupon.*','admin.order.*')) show @endif" id="order">
                    <ul class="nav flex-column sub-menu">
                        @can('View Coupon')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.coupon.index') active @endif"
                                    href="{{ route('admin.coupon.index') }}">Coupon</a></li>
                        @endcan

                        @can('View Order')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.order.index') active @endif"
                                    href="{{ route('admin.order.index') }}">Orders</a></li>
                        @endcan

                    </ul>
                </div>
            </li>
        @endcanany

        {{--   Inventory & Stock --}}
        @canany(['View Inventory', 'View Purchase', 'View Supplier','Create Purchase'])
            <li class="nav-item @if(request()->routeIs('admin.purchase.*','admin.supplier.*','admin.inventory.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#inventory"
                   aria-expanded="@if(request()->routeIs('admin.purchase.*','admin.supplier.*'))true @else false @endif"
                   aria-controls="order">
                    <i class="typcn typcn-archive menu-icon"></i>
                    <span class="menu-title">Inventory Management</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.purchase.*','admin.supplier.*','admin.inventory.*')) show @endif"
                    id="inventory">
                    <ul class="nav flex-column sub-menu">
                        @can('View Supplier')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName  == 'admin.supplier.index') active @endif"
                                    href="{{ route('admin.supplier.index') }}">Supplier</a></li>
                        @endcan

                        @can('View Purchase')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName  == 'admin.purchase.index') active @endif"
                                    href="{{ route('admin.purchase.index') }}">Purchase</a></li>
                        @endcan

                        @can('Create Purchase')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.purchase.create') active @endif"
                                    href="{{ route('admin.purchase.create') }}">Add Purchase</a></li>
                        @endcan

                        @can('View Inventory')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName  == 'admin.inventory.index') active @endif"
                                    href="{{ route('admin.inventory.index') }}">Inventory</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--   Wholesale & Stock --}}
        @canany(['View Wholesale', 'View wStocks', 'View wCustomer'])
            <li class="nav-item  @if(request()->routeIs('admin.wcustomers.*','admin.wsales.*','admin.wsalestocks.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#wholesale"
                   aria-expanded="@if(request()->routeIs('admin.wcustomers.*','admin.wsales.*','admin.wsalestocks.*')) true @else false @endif"
                   aria-controls="order">
                    <i class="typcn typcn-archive menu-icon"></i>
                    <span class="menu-title">Wholesale Management</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.wcustomers.*','admin.wsales.*','admin.wsalestocks.*')) show @endif"
                    id="wholesale">
                    <ul class="nav flex-column sub-menu">
                        @can('View wCustomer')
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('admin.wcustomers.index') }}">Customers</a>
                            </li>
                        @endcan

                        @can('View Wholesale')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.wsales.index') }}">Sales</a>
                            </li>
                        @endcan

                        @can('View wStocks')
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('admin.wsalestocks.index') }}">Stocks</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--    Slider and Banner    --}}
        @canany(['View Slider', 'View Banner'])
            <li class="nav-item @if(request()->routeIs('admin.slider.*','admin.banner.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#sliderBanner" aria-expanded="false"
                   aria-controls="sliderBanner">
                    <i class="typcn typcn-image menu-icon"></i>
                    <span class="menu-title">Slider and Banner</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.slider.*','admin.banner.*')) show @endif"
                     id="sliderBanner">
                    <ul class="nav flex-column sub-menu">
                        @can('View Slider')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.slider.index') active @endif"
                                    href="{{ route('admin.slider.index') }}">Slider</a></li>
                        @endcan

                        @can('View Banner')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.banner.index') active @endif"
                                    href="{{ route('admin.banner.index') }}">Banner</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--   API Manage     --}}
        @canany(['Courier API', 'SMS Gateway', 'Payment Gateway'])
            <li class="nav-item @if(request()->routeIs('admin.courier.*','admin.sms.*','admin.payment.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#api-manage" aria-expanded="false"
                   aria-controls="api-manage">
                    <i class="typcn typcn-key menu-icon"></i>
                    <span class="menu-title">API</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.courier.*','admin.sms.*','admin.payment.*')) show @endif"
                    id="api-manage">
                    <ul class="nav flex-column sub-menu">
                        @can('Courier API')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.courier.index') active @endif"
                                    href="{{ route('admin.courier.index') }}">Courier API</a></li>
                        @endcan

                        @can('SMS Gateway')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.sms.index') active @endif"
                                    href="{{ route('admin.sms.index') }}">SMS Gateway</a></li>
                        @endcan

                        @can('Payment Gateway')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.payment.index') active @endif"
                                    href="{{ route('admin.payment.index') }}">Payment Gateway</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--    Blog Manage    --}}
        @canany(['View Blog', 'Create Blog'])
            <li class="nav-item @if(request()->routeIs('admin.blog.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="blog">
                    <i class="typcn typcn-image-outline menu-icon"></i>
                    <span class="menu-title">Blog</span>
                    <i class="typcn typcn-chevron-right menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.blog.*')) show @endif" id="blog">
                    <ul class="nav flex-column sub-menu">
                        @can('View Blog')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.blog.index') active @endif"
                                    href="{{ route('admin.blog.index') }}">Blog List</a></li>
                        @endcan

                        @can('Create Blog')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.blog.create') active @endif"
                                    href="{{ route('admin.blog.create') }}">Create Blog</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        {{--    Landing page Manage    --}}
        {{--        <li class="nav-item @if(request()->routeIs('admin.landing-page.*')) active @endif">--}}
        {{--            <a class="nav-link" data-toggle="collapse" href="#landing" aria-expanded="false" aria-controls="landing">--}}
        {{--                <i class="typcn typcn-media-play menu-icon"></i>--}}
        {{--                <span class="menu-title">Landing Page</span>--}}
        {{--                <i class="typcn typcn-chevron-right menu-arrow"></i>--}}
        {{--            </a>--}}

        {{--            <div class="collapse @if(request()->routeIs('admin.landing-page.*')) show @endif" id="landing">--}}
        {{--                <ul class="nav flex-column sub-menu">--}}
        {{--                    <li class="nav-item"> <a class="nav-link @if($currentRouteName == 'admin.landing-page.index') active @endif" href="{{ route('admin.landing-page.index') }}">Landing Page</a></li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </li>--}}

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

        {{--   Reports     --}}
        @can('Sales Report')
            <li class="nav-item @if(request()->routeIs('admin.sales-report.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
                    <i class="typcn typcn-document-add menu-icon"></i>
                    <span class="menu-title">Reports</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="collapse @if(request()->routeIs('admin.sales-report.*')) show @endif" id="report">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a
                                class="nav-link @if($currentRouteName == 'admin.sales-report.index') active @endif"
                                href="{{ route('admin.sales-report.index') }}">Sales Report</a></li>
                    </ul>
                </div>
            </li>
        @endcan

        {{--   Settings     --}}
        @canany(['Basic Info', 'Shipping Charge', 'Order Status', 'Pixel', 'Google Tag'])
            <li class="nav-item  @if(request()->routeIs('admin.basic-info.index','admin.shipping-charge.index','admin.order-status.index','admin.pixel.index','admin.tag.index')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                   aria-controls="form-elements">
                    <i class="typcn typcn-spanner menu-icon"></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>

                <div
                    class="collapse @if(request()->routeIs('admin.basic-info.index','admin.shipping-charge.index','admin.order-status.index','admin.pixel.index','admin.tag.index')) show @endif"
                    id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        @can('Basic Info')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.basic-info.index') active @endif"
                                    href="{{ route('admin.basic-info.index') }}">Basic Info</a></li>
                        @endcan

                        @can('Shipping Charge')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.shipping-charge.index') active @endif"
                                    href="{{ route('admin.shipping-charge.index') }}">Shipping Charge</a></li>
                        @endcan

                        @can('Order Status')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.order-status.index') active @endif"
                                    href="{{ route('admin.order-status.index') }}">Order Status</a></li>
                        @endcan

                        @can('Pixel')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.pixel.index') active @endif"
                                    href="{{ route('admin.pixel.index') }}">Pixel</a></li>
                        @endcan

                        @can('Google Tag')
                            <li class="nav-item"><a
                                    class="nav-link @if($currentRouteName == 'admin.tag.index') active @endif"
                                    href="{{ route('admin.tag.index') }}">Tag Management</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany
    </ul>

</nav>
<!-- partial -->
