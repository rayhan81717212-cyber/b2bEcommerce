<div class="sidebar">
    <div class="p-2 text-center">
        <h4 class="fw-bold text-primary"><img src="{{ asset('assets/img/logo/logo.png') }}" width="100" alt=""></h4>
    </div>
    <nav class="nav flex-column mt-3">
        <a class="nav-link {{ request()->is('customers/dashboard') ? 'active' : '' }}"
            href="{{ url('/customers/dashboard') }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->is('customers/orders') ? 'active' : '' }}"
            href="{{ url('/customers/orders') }}"><i class="fa-solid fa-box"></i> My Orders
        </a>
            
        <a class="nav-link {{ request()->is('customers/payment') ? 'active' : '' }}"
            href="{{ url('customers/payment') }}"><i class="fa-solid fa-wallet"></i> Payments
        </a>
        <a class="nav-link {{ request()->is('customers-profile') ? 'active' : '' }}"
            href="{{ url('customers-profile') }}"><i class="fa-solid fa-user"></i> Profile Info
        </a>
        <hr class="mx-3 my-4 text-muted">
        <a class="nav-link text-danger" href="#">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="align-middle">Log Out</span>
                </button>
            </form>
        </a>
    </nav>
</div>
