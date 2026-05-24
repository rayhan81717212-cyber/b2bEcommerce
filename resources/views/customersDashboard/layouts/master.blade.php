<!DOCTYPE html>
<html lang="en">
<head>
    @include('customersDashboard.layouts.head')
</head>
<body>

    <!-- Sidebar -->
    @include('customersDashboard.layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        @include('customersDashboard.layouts.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    @include('customersDashboard.layouts.script')

</body>
</html>