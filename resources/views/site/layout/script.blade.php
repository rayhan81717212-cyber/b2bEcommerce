
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- xZoom -->
<script src="https://cdn.jsdelivr.net/gh/payalord/xZoom/dist/xzoom.min.js"></script>



{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- toaster --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   
    @if(session('success'))
    <script> 
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
       <script> 
        toastr.success("{{ session('error') }}");
    </script>
    @endif

<script>
$(document).ready(function () {
    $.get('/cart-count', function (data) {
        $('#cart-badge').text(data.count);
    });
});
</script>

@yield('scripts')