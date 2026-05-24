@extends('customersDashboard.layouts.master')
@section('title', 'customer dashboard')
@section('content')


    <!-- Order Table -->
    <div class="custom-table">

        <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
            <h5 class="fw-bold mb-0">All Orders</h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Order ID</th>
                        <th>Date</th>
                        <th>Items Name</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($orders as $order)
                        <tr>

                            <td class="ps-4 fw-medium">
                                #{{ $order->order_number }}
                            </td>

                            <td class="text-muted">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>

                            <td style="max-width: 350px;">
                                {{ $order->productName }}
                            </td>

                            <td class="fw-bold">
                                ৳{{ $order->price }}
                            </td>
                            <td class="fw-bold">
                                <img src="{{ asset('storage/' . $order->productPhoto) }}" width="100px" alt="">
                            </td>

                            <td>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge bg-primary">Confirmed</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-info">Processing</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a class="btn btn-dark btn-sm"
                                    href="{{ route('customer.order.show', $order->order_list_id) }}">
                                    View Details
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No orders found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
