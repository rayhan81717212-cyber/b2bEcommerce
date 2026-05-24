@extends('admin.layout.master')

@section('content')

<div class="container-fluid p-md-5 flex-grow-1 container-p-y">

    <h2 class="mb-4"> Commission Dashboard</h2>

    
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Total Commission</h5>
                <h3 class="text-primary">
                    {{ $data->total_commission ?? 0 }}
                </h3>
            </div>
        </div>

        @if(auth()->user()->role_id == 1)
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>Admin Earn</h5>
                    <h3 class="text-success">
                        {{ $data->admin_earn ?? 0 }}
                    </h3>
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>Your Earnings</h5>
                    <h3 class="text-success">
                        {{ $data->total_earn ?? 0 }}
                    </h3>
                </div>
            </div>
        @endif

    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">
                @if(auth()->user()->role_id == 1)
                    All Orders Commission
                @else
                    Your Commission History
                @endif
            </h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>

                        @if(auth()->user()->role_id == 1)
                            <th>Order ID</th>
                            <th>Grand Total</th>
                            <th>Commission</th>
                            <th>Admin Earn</th>
                        @else
                            <th>Order ID</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Commission</th>
                            <th>Your Earn</th>
                        @endif

                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($list as $key => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            @if(auth()->user()->role_id == 1)
                                <td>#{{ $item->id }}</td>
                                <td>{{ $item->grand_total }}</td>
                                <td>{{ $item->total_commission }}</td>
                                <td>{{ $item->admin_earn_total }}</td>
                            @else
                                <td>#{{ $item->order_id }}</td>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->commission_amount }}</td>
                                <td>{{ $item->vendor_earn }}</td>
                            @endif

                            <td>{{ $item->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">
                                No Data Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            
            <div class="mt-3">
                {{ $list->links('vendor.pagination.bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@endsection