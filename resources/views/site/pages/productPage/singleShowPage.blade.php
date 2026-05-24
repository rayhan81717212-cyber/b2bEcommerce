@extends('site.layout.master')
@section('title', 'Product Page')

@section('content')
<div class="container py-4">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="ec_breadcrumb mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="#">{{ $product->category_name }}</a></li>
      <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
  </nav>

  <!-- Product Main -->
  <div class="ec_product_card p-3 p-md-4 mb-4">
    <div class="row g-4">

      <!-- Gallery -->
      <div class="col-12 col-md-5">

        <div class="ec_gallery_main mb-3">
            <span class="ec_badge_new">New</span>

            <!-- Main Image -->
            <img class="xzoom"
                id="main_image"
                src="{{ asset('storage/'.$product->photo) }}"
                xoriginal="{{ asset('storage/'.$product->photo) }}">
        </div>

        <div class="d-flex gap-2 overflow-auto pb-1">

          
           <div class="xzoom-thumbs d-flex gap-2 overflow-auto pb-1">

              <a href="{{ asset('storage/'.$product->photo) }}">
                  <img class="xzoom-gallery" width="80"
                      src="{{ asset('storage/'.$product->photo) }}">
              </a>

              @if($product->gallery)
                  @foreach($product->gallery as $img)
                      <a href="{{ asset('storage/'.$img->photo) }}">
                          <img class="xzoom-gallery" width="80"
                              src="{{ asset('storage/'.$img->photo) }}">
                      </a>
                  @endforeach
              @endif

          </div>
        

        </div>

      </div>

      <!-- Info -->
      <div class="col-12 col-md-7 d-flex flex-column gap-3">

        <div>
          <div class="ec_category_tag mb-1">{{ $product->category_name }}</div>
          <h1 class="ec_product_title">{{ $product->name }}</h1>
        </div>

        <!-- Rating -->
        <div class="d-flex align-items-center flex-wrap gap-2">
          <span class="ec_review_count">
            {{ $product->rating ?? '4.2' }} ({{ $product->review_count ?? 0 }} reviews)
          </span>
          <span class="">
            <span class="ec_stock_dot"></span>
                @if ($product->stock_quantity == 0)
                    <span class="badge bg-danger"> Stock Out</span>
                @elseif ($product->stock_quantity <= 10)
                    <span class="badge bg-warning">Low Stock</span>
                @else
                    <span class="badge bg-success">In Stock</span>
                @endif
          </span>
        </div>

        <hr class="ec_divider my-0">

        <!-- Price -->
        <div class="d-flex align-items-center flex-wrap gap-2">


        @if($product->discount_price)
            <span class="ec_price_main">
                ৳{{ number_format($product->discount_price) }}
            </span>
        @else
            <span class="ec_price_main">
                ৳{{ number_format($product->price) }}
            </span>
        @endif

        @if($product->discount_price)
            <span class="ec_price_old">
                ৳{{ number_format($product->price) }}
            </span>
        @endif

        @if($product->discount_price)
            <span class="ec_discount_badge">
                {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}% off
            </span>
        @endif

    </div>

        <!-- Quantity -->
        <div class="d-flex align-items-center flex-wrap gap-3">
          <span class="fw-semibold" style="font-size:13px;color:#555">Quantity</span>

          <div class="ec_qty_wrap">
            <button class="ec_qty_btn" onclick="ec_changeQty(-1)">−</button>
            <input class="ec_qty_input" type="number" id="ec_qty" value="1" readonly>
            <button class="ec_qty_btn" onclick="ec_changeQty(1)">+</button>
          </div>

          <span class="ec_qty_total" id="ec_qty_total">
            Total: ৳{{ number_format($product->discount_price ?? $product->price) }}
          </span>
        </div>

        <!-- Actions -->
        <div class="d-flex flex-wrap gap-2">

          <button class="ec_btn_cart" onclick="addToCart({{ $product->id }})">
            <i class="bi bi-cart3"></i> Add to Cart
          </button>

        </div>

        <!-- Delivery -->
        <div class="ec_delivery_box d-flex flex-column gap-2">
          <div class="ec_del_row">
            <i class="bi bi-truck"></i>
            <span><strong>Free delivery</strong> — 2–4 days</span>
          </div>
          <div class="ec_del_row">
            <i class="bi bi-arrow-counterclockwise"></i>
            <span><strong>7-day return</strong></span>
          </div>
          <div class="ec_del_row">
            <i class="bi bi-shield-check"></i>
            <span><strong>Warranty available</strong></span>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Tabs -->
  <div class="ec_tabs_wrap">

    <div class="ec_tab_nav d-flex overflow-auto">
      <button class="ec_tab_btn ec_tab_active" onclick="ec_switchTab(this,'spec')">Specifications</button>
      <button class="ec_tab_btn" onclick="ec_switchTab(this,'desc')">Description</button>
      <button class="ec_tab_btn" onclick="ec_switchTab(this,'review')">Reviews</button>
    </div>

    <!-- Spec -->
    <div class="ec_tab_pane ec_tab_show" id="ec_tab_spec">
      <table class="ec_spec_table">
        <tr><td>Brand</td><td>{{ $product->brand_name }}</td></tr>
        <tr><td>Category</td><td>{{ $product->category_name }}</td></tr>
        <tr><td>Price</td><td>৳{{ number_format($product->price) }}</td></tr>
        <tr><td>Short Description</td><td>৳{{ ($product->short_description) }}</td></tr>
        
      </table>
    </div>

    <!-- Description -->
    <div class="ec_tab_pane" id="ec_tab_desc">
      <div class="ec_desc_text">
        {!! $product->description !!}
      </div>
    </div>

    <!-- Reviews -->
    <div class="ec_tab_pane" id="ec_tab_review">
      <p>No reviews yet.</p>
    </div>

  </div>
</div>

@endsection

@section('scripts')
<script>
    

// photo zoom 
$(document).ready(function() {
    $(".xzoom, .xzoom-gallery").xzoom({
        position: "lens",
        lens: true,
        lensShape: "rounded",   
        lensSize: 200,         
        Xoffset: 0,
        Yoffset: 0,
        tint: false,
        smooth: true,
        zoomLevel: 2.5        
    });
});


 function ec_switchImg(el, url) {
    document.getElementById('ec_main_img').src = url;
    document.querySelectorAll('.ec_thumb_item').forEach(t => t.classList.remove('ec_thumb_active'));
    el.classList.add('ec_thumb_active');
  }

  // quantity
  const EC_UNIT_PRICE = {{ $product->discount_price ?? $product->price }};

  function ec_changeQty(delta) {
    const inp = document.getElementById('ec_qty');
    let val = parseInt(inp.value) + delta;

    if (val < 1) val = 1;
    if (val > 99) val = 99;

    inp.value = val;

    document.getElementById('ec_qty_total').textContent =
      'Total: ৳' + (EC_UNIT_PRICE * val).toLocaleString('en-IN');
  }



  // tab
  function ec_switchTab(el, id) {
    document.querySelectorAll('.ec_tab_btn').forEach(b => b.classList.remove('ec_tab_active'));
    document.querySelectorAll('.ec_tab_pane').forEach(p => p.classList.remove('ec_tab_show'));
    el.classList.add('ec_tab_active');
    document.getElementById('ec_tab_' + id).classList.add('ec_tab_show');
  }

  // add to cart
  function addToCart(id) {

    let qty = document.getElementById('ec_qty').value;

    fetch('/add-to-cart-product/' + id, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({
            quantity: qty
        })
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