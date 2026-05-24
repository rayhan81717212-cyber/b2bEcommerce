<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Vendor Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">



</head>

<body class="registerbody">
    <div class="register-wrapper">
        <div class="register-illustration">
            <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7885.jpg"
                alt="Register Image">
        </div>

        <!-- Right Side: Form Content -->
        <div class="register-form-section">
            <div class="brand-title">
                <h2>Join as a Vendor</h2>
                <p>Provide your information to start selling with us</p>
            </div>

            <form method="POST" action="{{ route('vendors-register-create') }}">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="custom-group">
                            <label class="custom-label">First Name</label>
                            <input type="text" name="first_name" class="custom-input" placeholder="e.g md"
                                value="{{ old('first_name') }}" required autofocus>
                            @error('first_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-group">
                            <label class="custom-label">Last Name</label>
                            <input type="text" name="last_name" class="custom-input" placeholder="e.g Rahim"
                                value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="custom-group">
                    <label class="custom-label">Email Address</label>
                    <input type="email" name="email" class="custom-input" placeholder="admin@gmail.com"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="custom-group">
                    <label class="custom-label">Password</label>
                    <input type="password" name="password" class="custom-input" placeholder="••••••••" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="custom-group">
                    <label class="custom-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="custom-input" placeholder="••••••••"
                        required>
                </div>

                {{-- vendor information --}}
                <div class="row">
                    <div class="col-6">
                        <div class="custom-group">
                            <label class="custom-label">Shop Name</label>
                            <input type="text" name="shop_name" class="custom-input" placeholder="e.g Rahim Store"
                                value="{{ old('shop_name') }}" required>
                            @error('shop_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-group">
                            <label class="custom-label">Mobile Number</label>
                            <input type="text" name="mobile_number" class="custom-input" placeholder="e.g 01XXXXXXXXX"
                                value="{{ old('mobile') }}" required>
                            @error('mobile')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-group">
                            <label class="custom-label">Address</label>
                            <input type="text" name="address" class="custom-input"
                                placeholder="e.g Dhaka, Bangladesh" value="{{ old('address') }}" required>
                            @error('address')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>







                <button type="submit" class="btn-submit">Create Account</button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Files -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
</body>

</html>
