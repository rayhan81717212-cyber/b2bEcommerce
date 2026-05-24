<!-- Footer -->
            

            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
        <footer class="content-footer footer bg-footer-theme mt-auto layout-page mx-md-5">
            <div class="container-fluid  flex-grow-1 container-p-y ">
              <div class="mb-2 mb-md-0 p-4 bg-white rounded shadow">
                © , made with ❤️ by Mohammad Rayhan
              </div>
            </div>
          </footer>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- chart --}}

   
    @if(session('success'))
    <script> 
        toastr.success("{{ session('success') }}");
    </script>
    @endif
    @if(session('message'))
    <script> 
        toastr.success("{{ session('message') }}");
    </script>
    @endif

    @if(session('error'))
       <script> 
        toastr.success("{{ session('error') }}");
    </script>
    @endif

   


  </body>
</html>
