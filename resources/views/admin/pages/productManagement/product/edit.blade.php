@extends('admin.layout.master')
@section('title', 'Product Update')

@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Product</span>
            <span class="text-dark"> / Update</span>
        </h4>

        <div class="card p-4">
            <div class="card-body">

                <h3 class="mb-4">Update Product</h3>

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" @selected($product->status == "Active")>Active</option>
                                <option value="Inactive" @selected($product->status == "Inactive")>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == $product->category_id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Brand</label>
                            <select name="brand_id" class="form-control" required>
                                <option value="">Select Brand</option>
                                @foreach($brand as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == $product->brand_id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3">{{ $product->short_description }}</textarea>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Discount Price</label>
                            <input type="text" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Stock Quantity</label>
                            <input type="text" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}">
                        </div>
                    </div>

                    <!-- Row 6 -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Product Photo</label>

                            @if($product->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->photo) }}" width="120">
                                </div>
                            @endif

                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-dark">
                        Update Product
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection