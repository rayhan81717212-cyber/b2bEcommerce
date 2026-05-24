@extends('customersDashboard.layouts.master')
@section('title', 'Payment')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            
            <div class="card">
                <h3 class="text-dark text-uppercase ps-3 pt-3">Payment Table</h3>
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered text-center align-middle">
                            <caption class="text-dark">Payment Records Table</caption>

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Number</th>
                                    <th>Product Name</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Shipping Fee</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($payment as $index => $item)
                                    <tr>
                                        <td>{{ $payment->firstItem() + $index }}</td>

                                        <td>{{ $item->order_number ?? 'N/A' }}</td>

                                        <td>{{ $item->product_name ?? 'N/A' }}</td>

                                        <td>
                                            @if ($item->payment_method == 'cod')
                                                Cash On Delivery
                                            @else
                                                {{ strtoupper($item->payment_method) }}
                                            @endif
                                        </td>

                                        <td>{{ number_format($item->amount, 2) }}</td>

                                        <td>{{ number_format($item->shipping_fee, 2) }}</td>

                                        <td>{{ number_format($item->grand_total, 2) }}</td>

                                        <td>
                                            @if ($item->status == "pending")
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif ($item->status == "paid")
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($item->updated_at)->format('d M, Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-danger">No Payment Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="9">
                                        {{ $payment->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
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

@endsection