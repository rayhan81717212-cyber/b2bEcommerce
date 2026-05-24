@extends('site.layout.master')

@section('title', 'Cart Page')

@section('content')
    <div class="container-fluid py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">🛒 Shopping Cart</h2>
            <a href="/" class="btn btn-dark">
                ⬅ Continue Shopping
            </a>
        </div>

        @if (count($cart) > 0)

            <div class="row g-4">

                <!-- LEFT SIDE TABLE -->
                <div class="col-lg-8">

                    <div class="card shadow-sm border-0">

                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table align-middle text-center mb-0">

                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-start ps-3">Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($cart as $id => $item)
                                            <tr id="row-{{ $id }}">

                                                <!-- PRODUCT -->
                                                <td class="text-start ps-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="{{ asset('storage/' . $item['photo']) }}"
                                                            class="rounded border" width="60" height="60"
                                                            style="object-fit:cover">

                                                        <div>
                                                            <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- PRICE -->
                                                <td class="fw-semibold">৳{{ $item['price'] }}</td>

                                                <!-- QTY -->
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">

                                                        <button class="btn btn-outline-secondary btn-sm"
                                                            onclick="updateQty({{ $id }}, -1)">
                                                            −
                                                        </button>

                                                        <input type="text" id="qty-{{ $id }}"
                                                            value="{{ $item['quantity'] }}"
                                                            class="form-control text-center mx-1" style="width:50px"
                                                            readonly>

                                                        <button class="btn btn-outline-secondary btn-sm"
                                                            onclick="updateQty({{ $id }}, 1)">
                                                            +
                                                        </button>

                                                    </div>
                                                </td>

                                                <!-- TOTAL -->
                                                <td class="fw-bold text-dark" id="total-{{ $id }}">
                                                    ৳{{ $item['price'] * $item['quantity'] }}
                                                </td>

                                                <!-- DELETE -->
                                                <td>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="removeItem({{ $id }})">
                                                        ❌
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT SUMMARY -->
                <div class="col-lg-4">

                    <div class="card shadow-sm border-0 p-3 sticky-top" style="top:20px">

                        <h4 class="fw-bold mb-3">Cart Summary</h4>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <strong id="subtotal">৳{{ $total }}</strong>
                        </div>



                        <hr>

                        <div class="d-flex justify-content-between fs-5">
                            <span>Total:</span>
                            <strong class="text-dark" id="grandTotal">৳{{ $total }}</strong>
                        </div>

                        <a  href="{{ route('checkout.page') }}" class="btn btn-dark w-100 mt-3 py-2">
                            PROCEED TO CHECKOUT
                        </a>

                    </div>

                </div>

            </div>
        @else
            <div class="alert alert-warning text-center py-4">
                <h5 class="mb-0">Your cart is empty 😢</h5>
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <script>
        function updateQty(id, change) {

            let qtyInput = document.getElementById('qty-' + id);
            let qty = parseInt(qtyInput.value);

            qty = qty + change;

            if (qty < 1) return;

            fetch("{{ route('cart.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: id,
                        quantity: qty,
                        type: 'update'
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {

                        document.getElementById('qty-' + id).value = qty;

                        document.getElementById('total-' + id).innerText =
                            '৳' + data.item_total;

                        document.getElementById('subtotal').innerText =
                            '৳' + data.total;

                        document.getElementById('grandTotal').innerText =
                            '৳' + data.total;

                        document.getElementById('cart-badge').innerText = data.count;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        function removeItem(id) {

            fetch("{{ route('cart.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: id,
                        type: 'delete'
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {


                        let row = document.getElementById('row-' + id);
                        row.remove();

                        document.getElementById('subtotal').innerText = '৳' + data.total;
                        document.getElementById('grandTotal').innerText = '৳' + data.total;
                        document.getElementById('cart-badge').innerText = data.count;


                        if (data.count == 0) {
                            location.reload();
                        }
                    }
                });
        }
    </script>
@endsection
