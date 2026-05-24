@include('admin.layout.headerLink')

<!-- Menu -->
@if (auth()->user()->role_id == 1)
    @include('admin.layout.sideberAdmin')
@elseif (auth()->user()->role_id == 2)
    @include('admin.layout.sideberVendor')

@endif
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->
    @include('admin.layout.nav')

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        @yield('content')
   

        <!-- / Content -->


@include('admin.layout.footer')
@yield('scripts')



