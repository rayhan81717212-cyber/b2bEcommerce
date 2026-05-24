@extends('customersDashboard.layouts.master')
@section('title', 'customer dashboard')

@section('content')

<div class="container-fluid mt-4">

    {{-- success message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-dark" href="{{ route('customer.create') }}">
            Update Profile
        </a>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Customer Profile</h5>
        </div>

        <div class="card-body">

            @forelse ($customers as $item)

                <div class="row g-4 align-items-center border-bottom pb-3 mb-3">

                    {{-- IMAGE --}}
                    <div class="col-md-2 text-center">
                        <img src="{{ $item->profile_image ? asset('storage/'.$item->profile_image) : 'https://placehold.co/100x100' }}"
                             class="rounded-circle border"
                             width="90" height="90"
                             style="object-fit: cover;">
                    </div>

                    {{-- INFO --}}
                    <div class="col-md-10">

                        <div class="row">

                            <div class="col-md-4 mb-2">
                                <strong>Name:</strong>
                                <div>{{ $item->first_name }} {{ $item->last_name }}</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <strong>Email:</strong>
                                <div>{{ $item->email ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <strong>Phone:</strong>
                                <div>{{ $item->phone ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <strong>City:</strong>
                                <div>{{ $item->city ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <strong>Country:</strong>
                                <div>{{ $item->country ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <strong>Postal Code:</strong>
                                <div>{{ $item->postal_code ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <strong>Address:</strong>
                                <div>{{ $item->address ?? 'N/A' }}</div>
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="alert alert-info text-center">
                    No customer data found
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection