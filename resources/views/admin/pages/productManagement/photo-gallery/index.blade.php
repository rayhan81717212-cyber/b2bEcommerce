@extends('admin.layout.master')
@section('title', 'Product')
@section('content')

    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product Gallery /</span> <span
                    class="text-dark">Manage</span></h4>
            <a href="{{ route('productgallery.create') }}" class="btn btn-dark my-3">Add Product</a>
            
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card p-4">
                        <h5 class="card-header">Product Gallery</h5>
                        @if (session('success') == 'Product Delete Successfully!')
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @elseif (session('success') == 'Product Update Successfully!' || session('success') == 'Photo Save Successfully!')
                            <div class="alert alert-dark">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="bg-dark ">
                                            <th class="text-white align-middle"><i class="fas fa-hashtag me-1"></i>Id</th>
                                            <th class="text-white align-middle"><i class="fas fa-box me-1"></i>Product Name</th>
                                            @if (auth()->user()->role_id == 1)
                                                <th class="text-white align-middle text-center"><i
                                                    class="fas fa-user me-1"></i>Vendor Name</th>
                                            @endif
                                            <th class="text-white align-middle"><i class="fas fa-image me-1"></i>photo</th>
                                            <th class="text-white align-middle"><i class="fas fa-cogs me-1"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productGallery as $index => $item)
                                            <tr>
                                                <td class="m-0 p-0">{{$index + 1}}</td>
                                                <td class="m-0 p-0 text-wrap w-50">{{$item->product}}</td>
                                                @if (auth()->user()->role_id == 1)
                                                    <td>{{ trim(($item->first_name ?? '') . ' ' . ($item->last_name ?? '')) ?: 'NA' }}</td>
                                                @endif
                                                <td class="m-0 p-0">
                                                    <a data-fancybox="gallery" href="{{ asset('storage/' . $item->photo) }}">
                                                        <img src="{{ asset('storage/'.$item->photo) }}" alt="Product Messing" width="100">
                                                    </a>
                                                </td>
                                                <td class="m-0 p-0">
                                                    <button class="btn btn-sm btn-primary me-2"><i class="fa fa-pen"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                {{ $productGallery->onEachSide(1)->links('pagination::bootstrap-5') }}
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
    </div>

@endsection
