
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

@yield('scripts')