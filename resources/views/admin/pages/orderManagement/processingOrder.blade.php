@extends('admin.layout.master')
@section('title', 'Processing Orders')
@section('content')
    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Processing Orders /</span> Manage</h4>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <h5 class="card-header">Processing Orders Table</h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered text-center">
                                    <caption>Processing Orders Table</caption>
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-white text-align-center"><i class="fa-solid fa-hashtag"></i> ID
                                            </th>
                                            <th class="text-white text-align-center"><i
                                                    class="fa-solid fa-user"></i>Customer Name</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-receipt"></i>
                                                Order Number</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-dollar-sign"></i>
                                                Amount</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-truck-fast"></i>
                                                Shipping Fee</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-calculator"></i>
                                                Total</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-wallet"></i>
                                                Payment Status</th>
                                            <th class="text-white text-align-center"><i
                                                    class="fa-solid fa-money-bill-wave"></i> Payment Method</th>
                                            <th class="text-white text-align-center"><i
                                                    class="fa-solid fa-clipboard-check"></i> Order Status</th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-image"></i> Photo
                                            </th>
                                            <th class="text-white text-align-center"><i class="fa-solid fa-gear"></i> Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $index => $item)
                                            <tr>
                                                <td>{{ $orders->firstItem() + $index }}</td>

                                                <td>{{ $item->firstName ?? '' }} {{ $item->lastName ?? '' }}</td>

                                                <td>{{ $item->order_number ?? 'N/A' }}</td>

                                                <td>{{ number_format($item->price, 2) }}</td>

                                                <td>{{ number_format($item->shipping_fee, 2) }}</td>

                                                <td>{{ number_format($item->price + $item->shipping_fee, 2) }}</td>

                                                <td>
                                                    @if ($item->payment_status == 'paid')
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $item->payment_method == 'cod' ? 'Cash on Delivery' : strtoupper($item->payment_method) }}
                                                </td>

                                                <td>
                                                    @if ($item->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($item->status == 'confirmed')
                                                        <span class="badge bg-primary">Confirmed</span>
                                                    @elseif($item->status == 'processing')
                                                        <span class="badge bg-info">Processing</span>
                                                    @elseif($item->status == 'delivered')
                                                        <span class="badge bg-success">Delivered</span>
                                                    @elseif($item->status == 'cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->productPhoto)
                                                        <img src="{{ asset('storage/' . $item->productPhoto) }}"
                                                            width="50" alt="product">
                                                    @else
                                                        <img src="{{ asset('images/no-image.png') }}" width="50"
                                                            alt="no image">
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle"
                                                            data-bs-toggle="dropdown">
                                                            Action
                                                        </button>

                                                        <ul class="dropdown-menu">

                                                            <li>
                                                                <a class="dropdown-item update-status"
                                                                    data-item-id="{{ $item->id }}" data-status="delivered">
                                                                    Delivered
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a class="dropdown-item update-status text-danger"
                                                                    data-item-id="{{ $item->id }}" data-status="cancelled">
                                                                    Cancel
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10">
                                                {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
