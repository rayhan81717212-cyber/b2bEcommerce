@extends('admin.layout.master')
@section('title', 'Product Details')

@section('content')
<div class="mx-md-4">
  <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
    
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Product </span>
      <span class="text-dark"> / Details</span>
    </h4>

    <div class="row">
      <div class="col-12">
        <div class="card height-auto">
          <div class="card-body">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3>Product Details</h3>
              <a href="{{ route('product.index') }}" class="btn btn-dark btn-sm">Back</a>
            </div>

            <div class="single-info-details">
              <div class="row">
                
                <!-- Product Image -->
                <div class="col-lg-4 col-12 text-center mb-3">
                  @if ($productId->photo !== null)
                    <img src="{{ asset('storage/' . $productId->photo) }}" 
                       alt="{{ $productId->name }}" 
                       class="rounded img-fluid shadow" 
                       width="300" height="400">
                  @else 
                    <img src="https://placehold.co/600x400" alt="">
                  @endif
                </div>

                <!-- Product Info -->
                <div class="col-lg-8 col-12 px-4">

                    <h2 class="text-uppercase text-success fw-bold">
                        {{ $productId->name }}
                    </h2>


                 <h6 class="text-muted" style="text-align: justify; line-height: 1.7;">
                    {{ $productId->description }}
                </h6>

                  <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <th>Product Short Description</th>
                          <td>{{ $productId->short_description }}</td>
                        </tr>
                        <tr>
                          <th>Category</th>
                          <td>{{ $productId->category_name }}</td>
                        </tr>
                      <tr>
                        <th>Brand</th>
                        <td>{{ $productId->brand_name }}</td>
                      </tr>
                      <tr>
                        <th>Price</th>
                        <td>{{ number_format($productId->price) }} Tk</td>
                      </tr>
                      <tr>
                        <th>Discount Price</th>
                        <td>{{ number_format($productId->discount_price) }} Tk</td>
                      </tr>
                      <tr>
                        <th>Stock Quantity</th>
                        <td>{{ number_format($productId->stock_quantity) }} Pis</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>
                            <span class="{{ $productId->status == 'Active' ? 'badge bg-primary' : 'badge bg-danger' }}">
                               {{ $productId->status }}
                            </span>
                        </td>


                      </tr>
                      <tr>
                        <th>Created At</th>
                        <td>{{ $productId->created_at->format('d M, Y') }}</td>
                      </tr>
                      <tr>
                        <th>Updated At</th>
                        <td>{{ $productId->updated_at->format('d M, Y') }}</td>
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

  </div>
</div>
@endsection
