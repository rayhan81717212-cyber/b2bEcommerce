@extends('admin.layout.master')
@section('title', 'Product')
@section('content')

    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product /</span> <span
                    class="text-dark">Manage</span></h4>
            <a href="{{ route('product.create') }}" class="btn btn-dark my-3">Add Product</a>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <form action="{{ route('product.search') }}" method="GET" class="mb-3 d-flex">
                                    <input type="text" name="search" class="form-control me-2"
                                        placeholder="Search product name or description..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-dark">Search</button>
                                </form>
                            </div>
                        </div>

                        <h5 class="card-header">Product Table</h5>
                        @if (session('success') == 'Product Delete Successfully!')
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @elseif (session('success') == 'Product Update Successfully!' || session('success') == 'Product Add Successfully!')
                            <div class="alert alert-dark">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="bg-dark text-center">
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-hashtag me-1"></i>Id</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-box me-1"></i>Product Name</th>
                                            @if (auth()->user()->role_id == 1)
                                                <th class="text-white align-middle text-center"><i
                                                    class="fas fa-user me-1"></i>Vendor Name</th>
                                            @endif
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-tags me-1"></i>Brand Name</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-dollar-sign me-1"></i>Price</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-percentage me-1"></i>Discount Price</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-layer-group me-1"></i>Stock Quantity</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-warehouse me-1"></i>Stock Status</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-circle me-1"></i>Status</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-image me-1"></i>Photo</th>
                                            <th class="text-white align-middle text-center"><i
                                                    class="fas fa-cogs me-1"></i>Action</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $index => $item)
                                            <tr>
                                                <td>{{ $product->firstItem() + $index }}</td>
                                                <td>{{ $item->name }}</td>
                                                @if (auth()->user()->role_id == 1)
                                                    <td>{{ trim(($item->first_name ?? '') . ' ' . ($item->last_name ?? '')) ?: 'NA' }}</td>
                                                @endif
                                                <td>{{ $item->brand_name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->discount_price ?? '-----' }}</td>
                                                <td class="{{ $item->stock_quantity < 5 ? 'text-danger' : 'text-dark' }}">
                                                    {{ $item->stock_quantity }} Pis
                                                </td>

                                                <td>
                                                    @if ($item->stock_quantity == 0)
                                                        <span class="badge bg-danger"> Stock Out</span>
                                                    @elseif ($item->stock_quantity <= 5)
                                                        <span class="badge bg-dark">Low Stock</span>
                                                    @elseif ($item->stock_quantity > 5 && $item->stock_quantity <= 20)
                                                        <span class="badge bg-primary">Medium Stock</span>
                                                    @else
                                                        <span class="badge bg-success">Stock</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span
                                                        class="{{ $item->status == 'Active' ? 'badge bg-primary' : 'badge bg-danger' }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                                <td>

                                                    @if ($item->photo !== null)
                                                        <a data-fancybox="gallery"
                                                            href="{{ asset('storage/' . $item->photo) }}">
                                                            <img src="{{ asset('storage/' . $item->photo) }}"
                                                                alt="Product Image" class="img-fluid" width="150">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (auth()->user()->role_id !== 1)
                                                            <!-- Details -->
                                                            <a href="{{ route('product.show', $item->id) }}"
                                                                class="btn btn-primary btn-sm me-1" title="Details">
                                                                <i class="fa fa-eye"></i>
                                                            </a>

                                                            <!-- Edit -->
                                                            <a href="{{ route('product.edit', ['product' => $item['id'], 'page' => request('page', 1)]) }}"
                                                                class="btn btn-dark btn-sm me-1" title="Edit">
                                                                <i class="fa fa-pen"></i>
                                                            </a>

                                                            <!-- Delete -->
                                                            <form action="{{ route('product.destroy', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this product?')"
                                                                    title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if (auth()->user()->role_id !== 2)
                                                            <a href="{{ route('product.approved', $item->id) }}" onclick="return confirm('Are you sure you want to approved this product?')" class="btn btn-dark btn-sm me-1" title="Approved Product">
                                                                <i class="fa fa-check-circle text-success"></i>
                                                            </a>
                                                            <!-- Delete -->
                                                            <form action="{{ route('product.destroy', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to reject this product?')"
                                                                    title="Reject Product">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="11">
                                                {{ $product->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
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
