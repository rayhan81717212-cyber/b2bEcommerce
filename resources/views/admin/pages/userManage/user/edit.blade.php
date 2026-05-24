@extends('admin.layout.master')
@section('title', 'Product Create')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Users</span>
            <span class="text-dark"> / Update</span>
        </h4>

        <div class="card p-4">
            <div class="card-body">

                <h3 class="mb-4">Update User</h3>

                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">

                        {{-- First Name --}}
                        <div class="col-md-6 mb-3">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ $user->first_name }}">
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="col-md-6 mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ $user->last_name }}">
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control"
                                value="{{ $user->email }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ $user->phone }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="col-md-6 mb-3">
                            <label>Role</label>
                            <select name="role_id" class="form-control">
                                <option value="">Select Role</option>
                                @foreach ($role as $item)
                                    <option value="{{ $item->id }}"
                                        @selected($item->id == $user->role_id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Active" @selected($user->status == 'Active')>Active</option>
                                <option value="Inactive" @selected($user->status == 'Inactive')>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Photo --}}
                        <div class="col-md-12 mb-3">
                            <label>Photo</label>

                            <input type="file" name="photo" class="form-control">
                            <div class="mb-2">
                                @if ($user->photo)
                                    <img src="{{ asset('storage/'.$user->photo) }}"
                                         width="100"
                                         class="rounded">
                                @else
                                    <img src="https://placehold.co/100x100" class="rounded">
                                @endif
                            </div>

                            @error('photo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-dark mt-3">
                        Update User
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection