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
        <li class="menu-item {{ request()->is('/vendor/dashboard') ? 'active' : '' }}">
            <a href="{{ url('/vendor/dashboard') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-home-circle fs-4"></i>
                    <span class="fs-6">Vendor Dashboard</span>
                </div>
            </a>
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

        <!-- Product Management -->
        <li
            class="menu-item {{ request()->is('product*') || request()->is('categories*') || request()->is('brand*') || request()->is('productgallery*') || request()->is('banner*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-box fs-4"></i>
                    <span class="fs-6">Product Management</span>
                </div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('product') ? 'active' : '' }}">
                    <a href="{{ url('/product') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-list-ul"></i>
                            <span class="fs-6">All Products</span>
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('product-pending') ? 'active' : '' }}">
                    <a href="{{ url('/product-pending') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-hourglass"></i>
                            <span class="fs-6">Pendding Products</span>
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('categories') ? 'active' : '' }}">
                    <a href="{{ url('categories') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-category"></i>
                            <span class="fs-6">Categories</span>
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('brand') ? 'active' : '' }}">
                    <a href="{{ url('brand') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-purchase-tag"></i>
                            <span class="fs-6">Brand</span>
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('productgallery') ? 'active' : '' }}">
                    <a href="{{ url('productgallery') }}" class="menu-link">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bx bx-image"></i>
                            <span class="fs-6">Product Gallery</span>
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Orders -->
        <li
            class="menu-item  {{ request()->is('order*') ||
            request()->is('pending-order*') ||
            request()->is('confirmed-order*') ||
            request()->is('processing-order*') ||
            request()->is('delivered-order*') ||
            request()->is('cancelled-order*')
                ? 'active'
                : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-package fs-4"></i>
                    <span class="fs-6">Orders Management</span>
                </div>
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

        {{-- inventory --}}
        <li class="menu-item {{ request()->is('stock*') ? 'active open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-archive fs-4"></i>
                    <span class="fs-6">Inventory Management</span>
                </div>
            </a>

            <ul class="menu-sub">

                {{-- Restock Product --}}
                <li class="menu-item {{ request()->is('stock-manage') ? 'active' : '' }}">
                    <a href="{{ url('/stock-manage') }}" class="menu-link">
                        <i class="bx bx-refresh"></i> Restock Product
                    </a>
                </li>

                <li class="menu-item {{ request()->is('stock-logs') ? 'active' : '' }}">
                    <a href="{{ url('/stock-logs') }}" class="menu-link">
                        <i class="bx bx-history"></i> Stock Logs
                    </a>
                </li>

            </ul>
        </li>


        <!-- Payment -->
        <li class="menu-item {{ request()->is('/payments/history') ? 'active' : '' }}">
            <a href="{{ url('/payments/history') }}" class="menu-link">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-credit-card fs-4"></i>
                    <span class="fs-6">Payment Method</span>
                </div>
            </a>
        </li>
        {{-- commission --}}
        <li class="menu-item {{ request()->is('commission*') ? 'active' : '' }}">
            <a href="{{ url('/commission') }}" class="menu-link">
                <i class="bx bx-line-chart fs-4 me-2"></i>
                <span class="fs-6">Commission</span>
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

    </ul>
</aside>
