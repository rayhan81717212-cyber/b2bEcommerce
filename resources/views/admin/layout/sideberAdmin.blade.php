<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo w-100 d-flex justify-content-center">
        <div class="d-flex flex-column align-items-center">
            <img src="{{ asset('assets/img/logo/logo.png') }}" width="70" height="70" class="rounded-circle mb-2">
            <span class="fw-bolder">Online Shop</span>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('/admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('/admin/dashboard') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-home-circle fs-4"></i>
                    <span class="fs-6">Dashboard</span>
                </div>
            </a>
        </li>

        <!-- Ecommerce Main Menu -->
        <li
            class="menu-item {{ request()->is('product*') || request()->is('order*') || request()->is('stock*') || request()->is('payment*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-store fs-4"></i>
                    <span class="fs-6">Ecommerce</span>
                </div>
            </a>

            <ul class="menu-sub">

                <!-- Product Management -->
                <li
                    class="menu-item {{ request()->is('product*') || request()->is('categories*') || request()->is('brand*') || request()->is('productgallery*') || request()->is('banner*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-box fs-4"></i>
                            <span class="fs-6">Product Management</span>
                        </div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('product') ? 'active' : '' }}">
                            <a href="{{ url('/product') }}" class="menu-link">
                                <i class="bx bx-list-ul"></i> All Products
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('product-pending') ? 'active' : '' }}">
                            <a href="{{ url('/product-pending') }}" class="menu-link">
                                <i class="bx bx-hourglass"></i> Pending Products
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('categories') ? 'active' : '' }}">
                            <a href="{{ url('categories') }}" class="menu-link">
                                <i class="bx bx-category"></i> Categories
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('brand') ? 'active' : '' }}">
                            <a href="{{ url('brand') }}" class="menu-link">
                                <i class="bx bx-purchase-tag"></i> Brand
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('productgallery') ? 'active' : '' }}">
                            <a href="{{ url('productgallery') }}" class="menu-link">
                                <i class="bx bx-image"></i> Product Gallery
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('banner') ? 'active' : '' }}">
                            <a href="{{ url('banner') }}" class="menu-link">
                                <i class="bx bx-images"></i> Banner
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Orders Management -->
                <li
                    class="menu-item {{ request()->is('order*') || request()->is('pending-order*') || request()->is('confirmed-order*') || request()->is('processing-order*') || request()->is('delivered-order*') || request()->is('cancelled-order*') ? 'active' : '' }}">

                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="bx bx-package fs-4 me-2"></i>
                        <span class="fs-6">Orders Management</span>
                    </a>

                    <ul class="menu-sub">

                        {{-- All Orders --}}
                        <li class="menu-item {{ request()->is('order') ? 'active' : '' }}">
                            <a href="{{ url('order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-list-ul"></i>
                                    <span class="fs-6">All Orders</span>
                                </div>
                            </a>
                        </li>

                        {{-- Pending --}}
                        <li class="menu-item {{ request()->is('pending-order') ? 'active' : '' }}">
                            <a href="{{ url('pending-order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-time-five"></i>
                                    <span class="fs-6">Pending Orders</span>
                                </div>
                            </a>
                        </li>

                        {{-- Confirmed --}}
                        <li class="menu-item {{ request()->is('confirmed-order') ? 'active' : '' }}">
                            <a href="{{ url('confirmed-order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-check-shield"></i>
                                    <span class="fs-6">Confirmed Orders</span>
                                </div>
                            </a>
                        </li>

                        {{-- Processing --}}
                        <li class="menu-item {{ request()->is('processing-order') ? 'active' : '' }}">
                            <a href="{{ url('processing-order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-loader-circle"></i>
                                    <span class="fs-6">Processing Orders</span>
                                </div>
                            </a>
                        </li>

                        {{-- Delivered --}}
                        <li class="menu-item {{ request()->is('delivered-order') ? 'active' : '' }}">
                            <a href="{{ url('delivered-order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-check-circle"></i>
                                    <span class="fs-6">Delivered Orders</span>
                                </div>
                            </a>
                        </li>

                        {{-- Cancelled --}}
                        <li class="menu-item {{ request()->is('cancelled-order') ? 'active' : '' }}">
                            <a href="{{ url('cancelled-order') }}" class="menu-link">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bx bx-x-circle"></i>
                                    <span class="fs-6">Cancelled Orders</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- stock Management -->
                <li
                    class="menu-item {{ request()->is('stock*')  ? 'active open' : '' }}">
                    
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-archive fs-4"></i>
                            <span class="fs-6">Inventory Management</span>
                        </div>
                    </a>

                    <ul class="menu-sub">

                        <li class="menu-item {{ request()->is('stock-manage') ? 'active' : '' }}">
                            <a href="{{ url('/stock-manage') }}" class="menu-link">
                                <i class="bx bx-refresh"></i> Restock Product 
                            </a>
                        </li>

                        <li class="menu-item {{ request()->is('stock.logs') ? 'active' : '' }}">
                            <a href="{{ url('/stock.logs') }}" class="menu-link">
                                <i class="bx bx-history"></i> Stock Logs 
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Payment -->
                <li class="menu-item {{ request()->is('/payments/history') ? 'active' : '' }}">
                    <a href="{{ url('/payments/history') }}" class="menu-link">
                        <i class="bx bx-credit-card fs-4 me-2"></i>
                        <span class="fs-6">Payment Method</span>
                    </a>
                </li>
                {{-- commission --}}
                <li class="menu-item {{ request()->is('commission*') ? 'active' : '' }}">
                    <a href="{{ url('/commission') }}" class="menu-link">
                        <i class="bx bx-line-chart fs-4 me-2"></i>
                        <span class="fs-6">Commission</span>
                    </a>
                </li>

            </ul>
        </li>

        {{-- pos system --}}
        <li class="menu-item {{ request()->is('pos-product') ? 'active' : '' }}">
            <a href="{{ url('pos-product') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-desktop fs-4"></i>
                    <span class="fs-6">POS</span>
                </div>
            </a>
        </li>
        {{-- Report  --}}
        <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
            <a href="{{ url('report') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-bar-chart-alt-2 fs-4"></i>
                    <span class="fs-6">Analytics & reporting  </span>
                </div>
            </a>
        </li>
        {{-- email --}}
        <li class="menu-item {{ request()->is('email-form') ? 'active' : '' }}">
            <a href="{{ url('email-form') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-envelope fs-4"></i>
                    <span class="fs-6">Send Email</span>
                </div>
            </a>
        </li>

        <!-- User -->
        <li
            class="menu-item {{ request()->is('user*') || request()->is('role*') || request()->is('pending*') || request()->is('customer') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-user fs-4"></i>
                    <span class="fs-6">User Management</span>
                </div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
                    <a href="{{ url('user') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-user-circle"></i>
                            <span class="fs-6">User</span>
                        </div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('pending.vendor') ? 'active' : '' }}">
                    <a href="{{ route('pending.vendor') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-user-circle"></i>
                            <span class="fs-6">Pending Vendor</span>
                        </div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('customer') ? 'active' : '' }}">
                    <a href="{{ url('customer') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-user-circle"></i>
                            <span class="fs-6">Customer</span>
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('role') ? 'active' : '' }}">
                    <a href="{{ url('role') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-lock-alt"></i>
                            <span class="fs-6">Role</span>
                        </div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
