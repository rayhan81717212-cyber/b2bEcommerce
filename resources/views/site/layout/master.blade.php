<!DOCTYPE html>
<html lang="en">

<head>
    @include('site.layout.head')
</head>

<body>

    <!-- NAVBAR -->
    @include('site.layout.nav')

    @yield('content')

    {{-- footer --}}

    @include('site.layout.footer')
    @include('site.layout.script')
</body>

</html>
