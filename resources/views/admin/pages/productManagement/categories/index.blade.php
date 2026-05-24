@extends('admin.layout.master')
@section('title', 'Categories')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5  flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Categories /</span>
            <span class="text-dark">Manage</span>
        </h4>
        <a href="{{ route('categories.create') }}" class="btn btn-dark my-3">Add Categories</a>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                @if (session('success') == 'Category Delete successfully!')
                        <div class="alert alert-danger" >
                            {{ session('success') }}
                        </div>
                    @elseif (session('success') == 'Category added successfully!' || session('success') == 'Category Update successfully!')
                    <div class="alert alert-dark" >
                            {{ session('success') }}
                        </div>
                    @endif
                <div class="card">
                    <h5 class="card-header">Categories Table</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-dark ">
                                        <th class="text-white align-middle"><i class="fas fa-hashtag me-1"></i>Id</th>
                                        <th class="text-white align-middle"><i class="fas fa-list-alt me-1"></i>Category Name</th>
                                        @if (auth()->user()->role_id == 1)
                                                <th class="text-white align-middle text-center"><i
                                                    class="fas fa-user me-1"></i>Vendor Name</th>
                                            @endif
                                        <th class="text-white align-middle"><i class="fas fa-circle me-1"></i>Status</th>
                                        <th class="text-white align-middle"><i class="fas fa-cogs me-1"></i>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $categories as $index=> $item)
                                        <tr>
                                            <td>{{$categories->firstItem() + $index}}</td>
                                            <td class="text-start">{{ $item->name }}</td>
                                            @if (auth()->user()->role_id == 1)
                                                    <td>{{ trim(($item->first_name ?? '') . ' ' . ($item->last_name ?? '')) ?: 'NA' }}</td>
                                                @endif
                                            <td><span class="{{($item->status == 'Active') ? 'badge bg-success' : 'badge bg-danger' }}">{{$item->status}}</span></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <form action="{{ route('categories.edit', $item->id) }}" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-dark me-2"><i class="fa fa-pen"></i></button>
                                                    </form>

                                                    <form action="{{ route('categories.destroy', $item->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            {{ $categories->links("vendor.pagination.bootstrap-5") }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
