@extends('site.layout.master')
@section('title', 'Place Order')

@section('content')

    <div class="container py-5">

        <div class="row g-4">

            <!-- LEFT: PRODUCT LIST -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0 p-3">

                    <h4 class="fw-bold mb-3">Checkout</h4>

                    <div class="list-group">

                        @foreach ($cart as $item)
                            <div class="list-group-item d-flex align-items-center justify-content-between">

                                <div class="d-flex align-items-center gap-3">

                                    <img src="{{ asset('storage/' . $item['photo']) }}" width="80" height="80"
                                        class="rounded" style="object-fit:cover">

                                    <div>
                                        <h6 class="mb-0">{{ $item['name'] }}</h6>
                                        <p class="text-bold mt-2">Qty: {{ $item['quantity'] }}</p>
                                    </div>

                                </div>

                                <div class="fw-bold text-dark">
                                    ৳{{ $item['price'] * $item['quantity'] }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            <!-- RIGHT: SUMMARY -->
            <div class="col-lg-4">

                <form action="{{ route('order.place') }}" method="POST">

                    @csrf

                    <div class="card shadow-sm border-0 p-3 sticky-top" style="top:20px">

                        <h5 class="fw-bold mb-3">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>৳{{ $total }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>৳{{ $shipping_fee }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fs-5 mb-3">
                            <strong>Total:</strong>
                            <strong class="text-primary">৳{{ $grand_total }}</strong>
                        </div>

                        <!-- hidden shipping -->
                        <input type="hidden" name="shipping_fee" value="{{ $shipping_fee }}">

                        <!-- PAYMENT -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Payment Method</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                                <label class="form-check-label">Cash On Delivery</label>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">
                            PLACE ORDER
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
