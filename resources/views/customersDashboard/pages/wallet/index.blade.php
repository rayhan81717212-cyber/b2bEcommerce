@extends('customersDashboard.layouts.master')
@section('title', 'customer dashboard')
@section('content')

@section('content')
<div class="container py-4">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Total Wallet Balance</h5>
                <h2 class="text-success">৳ {{ $wallet->balance }}</h2>
            </div>
        </div>
    </div>

    <div class="card p-3 shadow-sm">
        <h5>Transaction History</h5>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Source</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr>
                    <td>
                        <span class="badge bg-{{ $t->type == 'credit' ? 'success' : 'danger' }}">
                            {{ $t->type }}
                        </span>
                    </td>
                    <td>৳ {{ $t->amount }}</td>
                    <td>{{ $t->source }}</td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $transactions->links("vendor.pagination.bootstrap-5") }}
    </div>

</div>
@endsection