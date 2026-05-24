 @extends('site.layout.master')
 @section('title', 'Home Page')
 @section('content')


     <!-- HERO -->
     <div class="hero" style="max-width:100%;padding:16px 24px">
         <div class="sidebar-cats">
             <h4 style="background: #ff4757" class="fw-bold text-white">Categories</h4>
             <div style="height: 330px; overflow-y: auto;">

                 @foreach ($categories as $item)
                    <div class="cat-item">
                        <a href="{{ route('all.product.page', ['category_id' => $item->id]) }}" class="btn">
                            {{ $item->name }}
                        </a>
                    </div>
                @endforeach
             </div>
         </div>

         <div class="hero-banner">

             <div class="banner-slide">

                 <div class="banner-tag">⚡ MEGA SALE</div>

                 <div class="banner-title">
                     Ultimate <span>Tech</span><br>Deals 2025
                 </div>

                 <div class="banner-sub">
                     Up to 70% off on premium electronics<br>
                     Limited time offer — ends tonight!
                 </div>

                 <button class="banner-cta" onclick="showToast('🎉 Loading best deals...')">
                     Shop Now →
                 </button>

                 <div class="dots">
                     <div class="dot active"></div>
                     <div class="dot"></div>
                     <div class="dot"></div>
                 </div>

             </div>

             <!-- banner -->
             <div class="banner-img">
                 @if (isset($banners) && count($banners) > 0)
                     <img src="{{ asset('storage/' . $banners[0]->photo) }}"
                         style="width:100%; height:100%; object-fit:cover; border-radius:12px;">
                 @else
                     📱
                 @endif
             </div>

         </div>

         <div class="hero-right">
             <div class="mini-banner" onclick="showToast('Opening Fashion Sale!')">
                 <h4>Fashion Week</h4>
                 <p>Up to 50% off<br>New arrivals daily</p>
                 <div class="mini-banner-img">👗</div>
             </div>
             <div class="mini-banner" onclick="showToast('Opening Gaming Store!')">
                 <h4>Gaming Zone</h4>
                 <p>Latest consoles<br>& accessories</p>
                 <div class="mini-banner-img">🎮</div>
             </div>
         </div>
     </div>

     <!-- deals -->
     <div class="deals-strip">

         <div class="deal-items text-center d-flex justify-content-center">

             @foreach ($products->take(5) as $product)
                 <div class="deal-item">

                     <div class="deal-thumb">
                         <img src="{{ asset('storage/' . $product->photo) }}" width="50">
                     </div>

                     <div class="deal-info">
                         <div class="name">{{ $product->name }}</div>

                         <div class="prices">
                             @if ($product->discount_price)
                                 <span class="price">৳{{ $product->discount_price }}</span>
                                 <span class="old">৳{{ $product->price }}</span>
                             @else
                                 <span class="price">৳{{ $product->price }}</span>
                             @endif
                         </div>
                     </div>

                 </div>
             @endforeach

         </div>
     </div>


     <!-- featured Products -->
     <div class="section">
         <div class="section-header mt-5">
             <div class="section-title"> Featured Products</div>
             <div class="view-all"><a class="btn" href="{{ route('all.product.page') }}">View All →</a></div>
         </div>
         <div class="products-grid " id="products-grid">
             @foreach ($products as $item)
                <div class="product-card" onclick="goToProduct({{ $item->id }})">
                     <div class="product-badge hot">HOT</div>
                     <button class="wishlist-btn">♡</button>

                     <div class="product-img">
                         <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="img-fluid"
                             style="width: 70%">
                     </div>

                     <div class="product-info">

                         <div class="product-rating">
                             ⭐⭐⭐⭐⭐
                         </div>

                         <div class="product-name">
                             {{ $item->name }}
                         </div>

                         <div class="product-prices">
                             @if ($item->discount_price)
                                 <span class="product-price">৳{{ $item->discount_price }}</span>
                                 <span class="product-old">৳{{ $item->price }}</span>
                             @else
                                 <span class="product-price">৳{{ $item->price }}</span>
                             @endif

                             @if ($item->discount_price)
                                 <span class="product-discount">
                                     {{ round((($item->price - $item->discount_price) / $item->discount_price) * 100) }}%
                                 </span>
                             @endif
                         </div>

                         <button 
                            class="add-cart-btn"
                            onclick="event.stopPropagation(); addToCart({{ $item->id }})"
                            {{ $item->stock_quantity <= 0 ? 'disabled' : '' }}
                        >
                            @if($item->stock_quantity <= 0)
                                ❌ Stock Out
                            @else
                                🛒 Add to Cart
                            @endif
                        </button>

                     </div>
                 </div>
             @endforeach
         </div>
     </div>


     <!-- more products -->
     <div class="section">
         <div class="section-header">
             <div class="section-title"> Best Sellers</div>
             <div class="view-all"><a class="btn" href="{{ route('all.product.page') }}">View All →</a></div>
         </div>
         <div class="products-grid" id="best-sellers-grid">
             @foreach ($bestSellers as $item)
                 <div class="product-card" onclick="goToProduct({{ $item->id }})">
                     <div class="product-badge hot">HOT</div>
                     <button class="wishlist-btn">♡</button>

                     <div class="product-img">
                         <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="img-fluid"
                             style="width: 70%">
                     </div>

                     <div class="product-info">

                         <div class="product-rating">
                             ⭐⭐⭐⭐⭐
                         </div>

                         <div class="product-name">
                             {{ $item->name }}
                         </div>

                         <div class="product-prices">
                             @if ($item->discount_price)
                                 <span class="product-price">৳{{ $item->discount_price }}</span>
                                 <span class="product-old">৳{{ $item->price }}</span>
                             @else
                                 <span class="product-price">৳{{ $item->price }}</span>
                             @endif

                             @if ($item->discount_price)
                                 <span class="product-discount">
                                     {{ round((($item->price - $item->discount_price) / $item->discount_price) * 100) }}%
                                 </span>
                             @endif
                         </div>

                         <button 
                            class="add-cart-btn"
                            onclick="event.stopPropagation(); addToCart({{ $item->id }})"
                            {{ $item->stock_quantity <= 0 ? 'disabled' : '' }}
                        >
                            @if($item->stock_quantity <= 0)
                                ❌ Stock Out
                            @else
                                🛒 Add to Cart
                            @endif
                        </button>

                     </div>
                 </div>
             @endforeach
         </div>
     </div>




 @endsection

 @section('scripts')


     <script>
        // clcik cart redirect single product
        function goToProduct(id){
          window.location.href = "/product-single/" + id;
        }

         // const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
         function addToCart(id) {

             // if (!isLoggedIn) {
             //     window.location.href = "/login";
             //     return;
             // }

             fetch('/add-to-cart/' + id, {
                     method: "POST",
                     headers: {
                         "X-CSRF-TOKEN": "{{ csrf_token() }}",
                         "Content-Type": "application/json",
                         "Accept": "application/json"
                     }
                 })
                 .then(res => res.json())
                 .then(data => {

                     if (data.success) {

                         document.getElementById('cart-badge').innerText = data.count;

                         Swal.fire({
                             toast: true,
                             position: 'top-end',
                             icon: 'success',
                             title: '🛒 Added to cart',
                             showConfirmButton: false,
                             timer: 2000,
                             timerProgressBar: true,
                             background: '#1f2937',
                         });
                     }

                 })
                 .catch(error => {
                     console.log(error);

                     Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Something went wrong!'
                     });
                 });
         }
     </script>
 @endsection
