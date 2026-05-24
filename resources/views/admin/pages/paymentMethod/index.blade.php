@extends('admin.layout.master')

@section('title', 'Payment Method')

@section('content')

<div class="container-fluid p-4">

    <h4 class="mb-4">Payment Management</h4>

    <div class="card">

        <div class="card-header bg-dark text-white">
            Payment Records
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered text-center">

                <thead class="bg-dark text-white">
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer Name</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Invoice</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($payments as $index => $item)

                        <tr>
                            <td>#{{ $item->id }}</td>

                            <td>
                                {{ $item->order->user->first_name ?? '' }}
                                {{ $item->order->user->last_name ?? '' }}
                            </td>

                            <td>#{{ $item->order_id }}</td>

                            <td>
                                @if($item->payment_method == 'cod')
                                    Cash On Delivery
                                @else
                                    {{ strtoupper($item->payment_method) }}
                                @endif
                            </td>

                            <td>
                                {{ $item->grand_total }}
                            </td>

                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>

                                @elseif($item->status == 'paid')
                                    <span class="badge bg-success">Paid</span>

                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>

                            <td>
                                {{ $item->created_at->format('d M, Y') }}
                            </td>

                            <td>
                                <form method="POST" action="">
                                    @csrf
                                    <button class="btn btn-sm btn-dark">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                            </td>

                            <td>
                                <a href="{{ route('invoice', $item->order_id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-file-invoice"></i>
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9">No Payment Found</td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">
            {{ $payments->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
</div>

@endsection