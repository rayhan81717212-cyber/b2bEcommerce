@extends('admin.layout.master')

@section('content')
<div class="container-fluid p-md-5 flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Stock Logs /</span>
        <span class="text-dark">Manage</span>
    </h4>

    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Stock Logs</h3>

            <!-- filter -->
            <form method="GET" class="d-flex gap-2">

                <select name="type" class="form-control" style="width: 150px;">
                    <option value="">All</option>
                    <option value="in" {{ request('type')=='in' ? 'selected' : '' }}>IN</option>
                    <option value="out" {{ request('type')=='out' ? 'selected' : '' }}>OUT</option>
                </select>

                <button class="btn btn-primary btn-sm py-0">
                    Filter
                </button>

            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-bordered align-middle">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-white">Product</th>
                            <th class="text-white">Photo</th>
                            <th class="text-white">Quantity</th>
                            <th class="text-white">Type</th>
                            <th class="text-white">Note</th>
                            <th class="text-white">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->product->name ?? 'N/A' }}</td>
                                <td><img src="{{ asset('storage/' . $log->product->photo) }}" alt="{{ $log->name }}" width="60"></td>

                                <td>
                                    <span class="fw-bold">
                                        {{ $log->quantity }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge {{ $log->type == 'in' ? 'bg-success' : 'bg-danger' }}">
                                        {{ strtoupper($log->type) }}
                                    </span>
                                </td>

                                <td>{{ $log->note }}</td>

                                <td>
                                    {{ $log->created_at->format('d M Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!-- pagination -->
        <div class="mt-3">
            {{ $logs->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
</div>
@endsection