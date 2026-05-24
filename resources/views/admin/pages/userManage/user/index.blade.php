@extends('admin.layout.master')
@section('title', 'index')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Manage</h4>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <a href="{{ route('user.create') }}" class="btn btn-dark mb-3"> Add User</a>
                <div class="mb-3">
                    @if (session('success') == 'User Delete Successfully!')
                    <div class="alert alert-danger mb-0" role="alert">
                        <h6 class="mb-0">{{session('success')}}</h6>
                    </div>
                    @elseif (session('success') == 'User Add Successfully!' || session('success') == 'User Update Successfully!' )
                    <div class="alert alert-primary mb-0" role="alert">
                            <h6 class="mb-0">{{session('success')}}</h6>
                        </div>
                    @endif
                </div>
                <div class="card">
                    <h5 class="card-header">User Table</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-dark ">
                                        <th class="text-center text-white"><i class="fas fa-hashtag"></i> ID</th>
                                        <th class="text-center text-white"><i class="fas fa-user"></i> Name</th>
                                        <th class="text-center text-white"><i class="fas fa-envelope"></i> Email</th>
                                        <th class="text-center text-white"><i class="fas fa-phone"></i> Phone</th>
                                        <th class="text-center text-white"><i class="fas fa-building"></i> Shop Name</th>
                                        <th class="text-center text-white"><i class="fas fa-toggle-on"></i> Status</th>
                                        <th class="text-center text-white"><i class="fas fa-image"></i> Photo</th>
                                        <th class="text-center text-white "><i class="fas fa-cogs"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->phone)
                                                        {{ $item->phone }}
                                                    @else
                                                        {{ $item->mobile_number }}
                                                    @endif
                                            </td>
                                            <td>{{ $item->shop_name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $item->vendor_status == '1' ? 'bg-primary' : 'bg-danger' }}">
                                                    {{ $item->vendor_status == 0 ? 'Pending' : 'Approved' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->photo)
                                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="photo" width="50">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('user.show', $item->id) }}" class="btn btn-primary btn-sm me-2">Details</a>

                                                     <form action="{{ route('user.edit', $item->id) }}" method="GET">
                                                        @csrf
                                                        <button class="btn btn-dark me-2 btn-sm">Update</button>
                                                    </form>
                                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <thead>
                                    <tr>
                                        <td colspan="9">
                                            {{ $user->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
