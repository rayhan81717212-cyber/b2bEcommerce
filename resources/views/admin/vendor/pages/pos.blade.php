<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
     <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/posPage.css') }}">
    
    
   
</head>

<body>

<div class="pos">

    <!-- LEFT SIDE -->
    <div class="left">

        <input type="text" id="search" placeholder="Search product..." onkeyup="filterProducts()">

        <div class="cats">
            <button class="active" onclick="setFilter('all', this)">All</button>

            @foreach($categories as $cat)
                <button onclick="setFilter('{{ strtolower($cat->name) }}', this)">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <div class="products">

            @foreach($products as $product)
                <div class="prod-card"
                     data-name="{{ strtolower($product->name) }}"
                     data-cat="{{ strtolower($product->category->name ?? 'all') }}"
                     onclick="addToCart({{ $product->id }})">

                    <div class="prod-img">
                        <img src="{{ asset('storage/'.$product->photo) }}">
                    </div>

                    <div class="prod-name">
                        {{ \Illuminate\Support\Str::limit($product->name, 18) }}
                    </div>

                    <div class="prod-price">
                        ৳ {{ $product->price }}
                    </div>

                    <div class="prod-stock">
                        Stock: {{ $product->stock_quantity }}
                    </div>

                </div>
            @endforeach

        </div>
        <div class="pagination-wrapper">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <div class="cart-header bg-success ">
            <h3 class="text-white" style="text-transform: uppercase"> Cart</h3>
            <span class="fs-4 bg-white px-3 text-dark rounded" id="cartCount">0</span>
        </div>

        <div id="cartBox" class="cart-box"></div>

        <div class="cart-footer">
            <button class="btn primary" onclick="checkout()">Confirm Order</button>
            <button class="btn gray" onclick="clearCart()">Clear</button>
        </div>

    </div>

</div>

</body>
<!-- Bootstrap 5 JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function addToCart(id){
    fetch(`/pos/add/${id}`, {
        method:"POST",
        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        }
    }).then(()=>loadCart());
}

function loadCart(){
    fetch('/pos/cart-data')
    .then(res=>res.json())
    .then(data=>{

        let html = "";
        let total = 0;
        let count = 0;

        Object.entries(data.cart).forEach(([id,item])=>{

            count += item.quantity;
            total += item.price * item.quantity;

            html += `
                <table class="table table-sm align-middle">
                    <tbody>
                        <tr>
                            <td width="50">
                                <img src="/storage/${item.photo}" width="40">
                            </td>

                            <td>
                                <b>${item.name.substring(0,15)}</b>
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm fs-4 text-danger" onclick="updateQty(${id},'minus')">-</button>
                                    <button class="btn btn-sm fs-4 text-success" onclick="updateQty(${id},'plus')">+</button>
                                </div>
                            </td>

                            <td>
                                ${item.quantity} x ${item.price}
                            </td>
                        </tr>
                    </tbody>
                </table>
                `;
        });

        html += `<hr><b>Total: ৳ ${total}</b>`;

        document.getElementById('cartBox').innerHTML = html;
        document.getElementById('cartCount').innerText = count;
    });
}

function updateQty(id,action){
    fetch('/pos/update',{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        },
        body:JSON.stringify({
            product_id:id,
            type:"update",
            action:action
        })
    }).then(()=>loadCart());
}

function checkout(){
    fetch('/pos/checkout',{
        method:"POST",
        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){
            window.location.href = "/pos/invoice/" + data.order_id;
        } else {
            alert(data.message ?? "Checkout failed");
        }

    })
    .catch(err => {
        console.log(err);
        alert("Something went wrong!");
    });
}

function clearCart(){
    fetch('/pos/clear',{
        method:"POST",
        headers:{
            "X-CSRF-TOKEN":"{{ csrf_token() }}"
        }
    }).then(()=>loadCart());
}

let currentFilter = 'all';

function setFilter(type, btn = null) {

    currentFilter = type;

    document.querySelectorAll('.cats button').forEach(b => {
        b.classList.remove('active');
    });

    if (btn) btn.classList.add('active');

    filterProducts();
}

function filterProducts() {

    let search = document.getElementById('search').value.toLowerCase();

    document.querySelectorAll('.prod-card').forEach(card => {

        let name = (card.dataset.name || '').toLowerCase();
        let cat = (card.dataset.cat || '').toLowerCase();

        let matchSearch = name.includes(search);
        let matchCat = (currentFilter === 'all' || cat === currentFilter);

        card.style.display = (matchSearch && matchCat) ? "block" : "none";
    });
}


loadCart();
</script>
</html>
