<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="loginbody">
    <div class="auth-container">
        <!-- Left Side: img -->
        <div class="auth-illustration">
            <img src="{{ asset('assets/img/logo/login.avif') }}" alt="Login Illustration">
        </div>

        <!-- Right Side: Login Form -->
        <div class="auth-form-section">
            <div class="d-flex gap-2 mb-2 justify-content-center">

            <!-- Admin -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('rayhan8171@gmail.com')" title="Admin">
                <i class="bi bi-shield-lock-fill"></i>
            </button>

            <!-- Vendor 1 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('rayhan@gmail.com')"  title="Vendor 1">
                <i class="bi bi-shop"></i>
            </button>

            <!-- Vendor 2 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('mehedi@gmail.com')" title="Vendor 2">
                <i class="bi bi-shop-window"></i>
            </button>

            <!-- Vendor 3 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('jannat@gmail.com')" title="Vendor 3">
                <i class="bi bi-shop-window"></i>
            </button>

            <!-- Vendor 4 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('pannaakter7133@gmail.com')" title="Vendor 4">
                <i class="bi bi-shop-window"></i>
            </button>

            <!-- Customer 1 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('sumaiya@gmail.com')" title="Customer 1">
                <i class="bi bi-person-fill"></i>
            </button>

            <!-- Customer 2 -->
            <button class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" onclick="fillLogin('nusaybah@gmail.com')" title="Customer 2">
                <i class="bi bi-people-fill"></i>
            </button>

        </div>
            <div class="welcome-text">
                <h2>Hello,</h2>
                <h2>Welcome back</h2>
                <p>Login to your account to continue</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success small py-2">{{ session('status') }}</div>
            @endif

            <form id="formAuthentication" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Username or email" value="{{ old('email') }}" required autofocus />
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="extra-links">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>

            <p class="text-center mt-4 small">
                Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-primary">Click here</a>
            </p>

           
        </div>
    </div>

    <!-- JS Files -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function fillLogin(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = '1234';
        }

        
    </script>
    {{-- toaster --}}
    
    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif


</body>
</html>