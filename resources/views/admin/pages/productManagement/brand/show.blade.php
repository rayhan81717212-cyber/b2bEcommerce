@extends('admin.layout.master')
@section('title', 'Brand Details')

@section('content')
<div class="mx-md-4">
  <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
    
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Brand </span>
      <span class="text-dark"> / Details</span>
    </h4>

    <div class="row">
      <div class="col-12">
        <div class="card height-auto">
          <div class="card-body">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3>Brand Details</h3>
              <a href="{{ route('brand.index') }}" class="btn btn-dark btn-sm">Back</a>
            </div>

            <div class="single-info-details">
              <div class="row">
                
                <!-- Product Image -->
                <div class="col-lg-4 col-12 text-center mb-3">
                  @if ($brandId->logo !== null)
                    <img src="{{ asset('storage/' . $brandId->logo) }}" 
                       alt="{{ $brandId->name }}" 
                       class="rounded img-fluid shadow" 
                       width="300" height="400">
                  @else 
                    <img src="https://placehold.co/600x400" alt="">
                  @endif
                </div>

                <!-- Product Info -->
                  <div class="col-lg-8">
                    <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <th>Brand</th>
                          <td>{{ $brandId->name }}</td>
                        </tr>
                      <tr>
                        <th>Brand Description</th>
                        <td style="text-align: justify">{{ $brandId->description }}</td>
                      </tr>
                      <tr>
                        <th>Created At</th>
                        <td>{{ $brandId->created_at->format('d M, Y') }}</td>
                      </tr>
                      <tr>
                        <th>Updated At</th>
                        <td>{{ $brandId->updated_at->format('d M, Y') }}</td>
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
</div>
@endsection
