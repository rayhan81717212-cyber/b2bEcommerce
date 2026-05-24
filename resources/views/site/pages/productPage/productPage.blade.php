@extends('site.layout.master')
@section('title', 'Product Page')

@section('content')

    <!-- mobile topbar -->
    <div class="mobile-topbar">
        <button class="icon-btn" onclick="openSidebar()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="8" y1="12" x2="16" y2="12" />
                <line x1="11" y1="18" x2="13" y2="18" />
            </svg>
        </button>

        <div class="mob-search-bar">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" />
                <path d="M21 21l-4.35-4.35" />
            </svg>
            <div class="search-bar-area">
                <input type="text" id="searchInputMob" placeholder="Search products…" oninput="searchProducts('mob')">
            </div>
        </div>

        <div class="view-toggle">
            <button class="view-btn active" id="gridBtnMob" onclick="setView('grid')">⊞</button>
            <button class="view-btn" id="listBtnMob" onclick="setView('list')">☰</button>
        </div>
    </div>

    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <div class="page">

        <!-- sidebar -->
        <aside class="sidebar" id="sidebar">

            <div class="sidebar-box-area">
                <div class="sidebar-title">
                    Categories
                    <button class="sidebar-close" onclick="closeSidebar()">✕</button>
                </div>

                <ul class="cat-list" id="catList">
                    <li class="active" data-cat="all" onclick="filterCat(this)">All Products</li>

                    @foreach ($categories as $cat)
                        <li data-cat="{{ $cat->id }}" onclick="filterCat(this)">
                            {{ $cat->name }}
                            <span class="cat-count" id="count-{{ $cat->id }}">0</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-box-area">
                <div class="sidebar-title">Price Range (৳)</div>
                <div class="price-inputs">
                    <input type="number" id="minPrice" value="0">
                    <input type="number" id="maxPrice" value="999999">
                </div>
                <button class="apply-btn" onclick="applyPrice()">Apply</button>
            </div>

        </aside>

        <!-- main -->
        <main class="main">

            <div class="topbar">
                <div class="page-title">
                    All Products <span id="resultCount">(0 items)</span>
                </div>

                <div class="topbar-right">

                    <div class="search-bar-area">
                        <input type="text" id="searchInput" placeholder="Search products…"
                            oninput="searchProducts('desk')">
                    </div>
                    {{-- <div class="sort-select"> --}}
                    <select class="sort-select" id="sortSelect" onchange="sortProducts()">
                        <option value="default">Default</option>
                        <option value="price-asc">Price: Low → High</option>
                        <option value="price-desc">Price: High → Low</option>
                        <option value="rating">Top Rated</option>
                        <option value="discount">Biggest Discount</option>
                    </select>
                    {{-- </div> --}}
                    <div class="view-toggle">
                        <button class="view-btn active" id="gridBtn" onclick="setView('grid')">⊞</button>
                        <button class="view-btn" id="listBtn" onclick="setView('list')">☰</button>
                    </div>

                </div>
            </div>

            <div class="cat-chips-strip" id="catChipsStrip"></div>

            <div class="mob-action-row">
                <select id="sortSelectMob" onchange="sortProducts('mob')">
                    <option value="default">Default Sort</option>
                    <option value="price-asc">Price: Low → High</option>
                    <option value="price-desc">Price: High → Low</option>
                    <option value="rating">Top Rated</option>
                    <option value="discount">Biggest Discount</option>
                </select>

                <span id="resultCountMob"></span>
            </div>

            <div class="active-filters" id="activeFilters"></div>


            <div class="product-grid" id="productGrid"></div>

            <div class="no-results" id="noResults">
                <div class="icon">🔍</div>
                <h3>No Product Found</h3>
            </div>

            <div class="pagination" id="pagination"></div>

        </main>
    </div>

@endsection

@section('scripts')

    <script>
        const products = @json($products).map(p => ({
            id: p.id,
            name: p.name,
            cat: p.category_id,
            price: Number(p.price),
            discountPrice: p.discount_price ? Number(p.discount_price) : null,
            rating: Number(p.rating ?? 4),
            img: p.photo ? `/storage/${p.photo}` : '/images/default.png',
            hot: p.is_hot ?? false
        }));

        let currentCat = 'all',
            currentMinPrice = 0,
            currentMaxPrice = 999999,
            currentRating = 0,
            currentSearch = '',
            currentSort = 'default',
            currentView = 'grid',
            currentPage = 1;

        const perPage = 15;


        function renderGrid() {

            let filtered = getFiltered();

            if (currentSort === 'price-asc') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (currentSort === 'price-desc') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (currentSort === 'rating') {
                filtered.sort((a, b) => b.rating - a.rating);
            } else if (currentSort === 'discount') {
                filtered.sort((a, b) => b.discount - a.discount);
            }

            const total = filtered.length;

            const start = (currentPage - 1) * perPage;
            const page = filtered.slice(start, start + perPage);

            const grid = document.getElementById('productGrid');
            const no = document.getElementById('noResults');

            grid.className = 'product-grid' + (currentView === 'list' ? ' list-view' : '');

            if (page.length === 0) {
                grid.innerHTML = '';
                no.style.display = 'block';
            } else {
                no.style.display = 'none';
                grid.innerHTML = page.map(p => `
                  <div class="product-card" onclick="goToProduct(${p.id})">
                  ${p.hot ? '<span class="hot-badge">HOT</span>' : ''}
                  ${p.discount ? `<span class="discount-badge">${p.discount}%</span>` : ''}

                  <button class="wishlist-btn">🤍</button>

                  <div class="product-img">
                    <img src="${p.img}" onerror="this.src='/images/default.png'" width='150px'/>
                  </div>

                  <div class="product-info">
                    <div class="product-name">${p.name}</div>


                    <div class="product-price">

                    ${
                      p.discountPrice
                      ? `
                            <span class="product-price">৳${p.discountPrice.toLocaleString()}</span>
                            <span class="product-old">৳${p.price.toLocaleString()}</span>
                          `
                      : `
                            <span class="product-price">৳${p.price.toLocaleString()}</span>
                          `
                    }

                    ${
                      p.discountPrice
                      ? `
                            <span class="product-discount">
                              ${Math.round(((p.price - p.discountPrice) / p.discountPrice) * 100)}%
                            </span>
                          `
                      : ''
                    }

                  </div>

                   <button class="add-cart-btn"
                        onclick="event.stopPropagation(); addToCart(${p.id})"
                        ${p.stock_quantity <= 0 ? 'disabled' : ''}>
                        
                        ${p.stock_quantity <= 0 
                            ? '❌ Stock Out' 
                            : '🛒 Add to Cart'
                        }
                    </button>
                                    </div>
                </div>
              `).join('');
            }

            document.getElementById('resultCount').innerText = `(${total} items)`;
            document.getElementById('resultCountMob').innerText = `(${total} items)`;

            renderPagination(total);
            updateCounts();
        }

        // clcik cart redirect single product
        function goToProduct(id){
          window.location.href = "/product-single/" + id;
        }


        /* pagination */
        function renderPagination(total) {
            const totalPages = Math.ceil(total / perPage);
            const pagination = document.getElementById('pagination');

            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let html = '';

            html += `
    <button class="page-btn" 
      ${currentPage === 1 ? 'disabled' : ''}
      onclick="goPage(${currentPage - 1})">
      ←
    </button>
  `;

            let start = Math.max(1, currentPage - 2);
            let end = Math.min(totalPages, currentPage + 2);


            if (start > 1) {
                html += `<button class="page-btn" onclick="goPage(1)">1</button>`;
                if (start > 2) {
                    html += `<span class="dots">...</span>`;
                }
            }


            for (let i = start; i <= end; i++) {
                html += `
      <button class="page-btn ${i===currentPage ? 'active' : ''}"
        onclick="goPage(${i})">
        ${i}
      </button>
    `;
            }


            if (end < totalPages) {
                if (end < totalPages - 1) {
                    html += `<span class="dots">...</span>`;
                }
                html += `<button class="page-btn" onclick="goPage(${totalPages})">${totalPages}</button>`;
            }


            html += `
    <button class="page-btn"
      ${currentPage === totalPages ? 'disabled' : ''}
      onclick="goPage(${currentPage + 1})">
      →
    </button>
  `;

            pagination.innerHTML = html;
        }

        function goPage(p) {
            currentPage = p;
            renderGrid();
        }

        /* filter product */
        function getFiltered() {
            let list = [...products];

            if (currentCat !== 'all')
                list = list.filter(p => p.cat == currentCat);

            list = list.filter(p => p.price >= currentMinPrice && p.price <= currentMaxPrice);

            if (currentRating > 0)
                list = list.filter(p => p.rating >= currentRating);

            if (currentSearch)
                list = list.filter(p => p.name.toLowerCase().includes(currentSearch.toLowerCase()));

            return list;
        }

        /* events */
        function setView(v) {
            currentView = v;

            document.getElementById('gridBtn')?.classList.toggle('active', v === 'grid');
            document.getElementById('listBtn')?.classList.toggle('active', v === 'list');

            document.getElementById('gridBtnMob')?.classList.toggle('active', v === 'grid');
            document.getElementById('listBtnMob')?.classList.toggle('active', v === 'list');

            renderGrid();
        }

        function filterCat(el) {
            document.querySelectorAll('#catList li').forEach(l => l.classList.remove('active'));
            el.classList.add('active');

            currentCat = el.dataset.cat;
            currentPage = 1;

            renderGrid();
        }

        function searchProducts(type) {
            const val = type === 'mob' ?
                document.getElementById('searchInputMob').value :
                document.getElementById('searchInput').value;

            currentSearch = val;
            currentPage = 1;
            renderGrid();
        }

        function sortProducts() {
            currentSort = document.getElementById('sortSelect').value;
            renderGrid();
        }

        function applyPrice() {
            currentMinPrice = Number(document.getElementById('minPrice').value || 0);
            currentMaxPrice = Number(document.getElementById('maxPrice').value || 999999);
            currentPage = 1;
            renderGrid();
        }

        function filterRating(r) {
            currentRating = r;
            currentPage = 1;
            renderGrid();
        }

        function updateCounts() {
            document.querySelectorAll('#catList li').forEach(li => {
                const cat = li.dataset.cat;
                const count = document.getElementById('count-' + cat);

                if (count) {
                    count.innerText =
                        cat === 'all' ?
                        products.length :
                        products.filter(p => p.cat == cat).length;
                }
            });
        }


        renderGrid();

        // add cart
        function addToCart(id) {

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
