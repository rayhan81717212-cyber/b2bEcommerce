@extends('customersDashboard.layouts.master')
@section('title', 'Customer Profile')

@section('content')

<div class="container-fluid py-5">

    <div class="card shadow-sm p-4">

        <h4 class="mb-4">Customer Profile</h4>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <!-- first Name -->
                <div class="col-md-6 mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name', auth()->user()->first_name ?? '') }}">
                </div>
                <!-- Last Name -->
                <div class="col-md-6 mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name', auth()->user()->last_name ?? '') }}">

                </div>
                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $customer->phone ?? '') }}">

                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="col-md-6 mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                        value="{{ old('city', $customer->city ?? '') }}">

                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Country -->
                <div class="col-md-6 mb-3">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                        value="{{ old('country', $customer->country ?? '') }}">

                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Postal Code -->
                <div class="col-md-6 mb-3">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                        value="{{ old('postal_code', $customer->postal_code ?? '') }}">

                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $customer->address ?? '') }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Profile Image -->
                <div class="col-md-12 mb-3">
                    <label>Profile Image</label>
                    <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror">

                    @error('profile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- old img show --}}
                    @if(!empty($customer->profile_image))
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $customer->profile_image) }}"
                                 width="100" class="rounded border">
                        </div>
                    @endif
                </div>

            </div>

            <button class="btn btn-dark px-4 mt-2">Save</button>

        </form>

    </div>

</div>

@endsection