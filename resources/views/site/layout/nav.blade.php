<nav class="navbar">
    <div class="nav-top">
        <div>🇧🇩 Deliver to: <strong style="color:#fff">Dhaka, BD</strong> &nbsp;|&nbsp; Free shipping on orders over
            ৳999</div>
        <div>
            <a href="#">Sell on ShopBD</a>
            <a href="#">Track Order</a>
            <a href="#">Help</a>
        </div>
    </div>
    <div class="nav-main">
        <div class="logo">
            <div class="logo-icon mx-5">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" width="80" alt="">
                </a>
            </div>

        </div>
        <div class="search-bar">
            <select class="search-category">
                <option>All</option>
                <option>Electronics</option>
                <option>Fashion</option>
                <option>Home</option>
                <option>Sports</option>
            </select>
            <input type="text" class="search-input" placeholder="Search for products, brands and more..."
                id="search-input" />
            <button class="search-btn" ">🔍</button>
      </div>
      <div class="nav-actions">
        {{-- login action --}}
        @auth
            @php
                $user = auth()->user();
            @endphp

              @if ($user->role_id == 1)
                    <a href="{{ url('/admin/dashboard') }}" class="btn p-0">
                        <div class="nav-action">
                            <div class="nav-action-icon">👑</div>
                            Admin Dashboard
                        </div>
                    </a>
                @elseif ($user->role_id == 2)
                    <a href="{{ url('/vendor/dashboard') }}" class="btn p-0">
                        <div class="nav-action">
                            <div class="nav-action-icon">🏪</div>
                            Vendor Dashboard
                        </div>
                    </a>
                @elseif ($user->role_id == 4)
                    <a href="{{ url('/customers/dashboard') }}" class="btn p-0">
                        <div class="nav-action">
                            <div class="nav-action-icon">👤</div>
                            My Dashboard
                        </div>
                    </a>
                    @endif
                @else
                    <a href="{{ url('/login') }}" title="login section" class="btn p-0">
                        <div class="nav-action">
                            <div class="nav-action-icon">👤</div>
                            Account
                        </div>
                    </a>
                @endauth
                {{-- login action end --}}
                <div class="nav-action">
                    <div class="nav-action-icon">❤️</div>
                    <div class="badge" id="wishlist-badge">0</div>
                    Wishlist
                </div>


                <a href="{{ route('cart.page') }}">
                    <div class="nav-action">
                        <div class="nav-action-icon">🛒</div>
                        <div class="badge" id="cart-badge">{{ count(session('cart', [])) }}</div>
                        Cart
                    </div>
                </a>
        </div>
    </div>
    <div class="nav-bottom text-center">
        <div class="category-btn"><a href="{{ route('home') }}" class="nav-item">🏠 Home</a></div>
        <div class="nav-bottom">
            <a href="{{ route('all.product.page') }}" class="nav-item"> Shop</a>

            <a href="{{ route('deals.page') }}" class="nav-item"> Deals</a>
        </div>
    </div>
</nav>
