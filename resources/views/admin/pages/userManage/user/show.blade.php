@extends('admin.layout.master')
@section('title', 'Product Details')

@section('content')
<div class="mx-md-4">
  <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
    
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Users </span>
      <span class="text-dark"> / Details</span>
    </h4>

    <div class="row">
      <div class="col-12">
        <div class="card height-auto">
          <div class="card-body">
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3>User Details</h3>
              <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm">Back</a>
            </div>

            <div class="single-info-details">
              <div class="row">
                
                <!-- Product Image -->
                <div class="col-lg-4 col-12 text-center mb-3">
                  @if ($user->photo !== null)
                    <img src="{{ asset('storage/' . $user->photo) }}" 
                       alt="{{ $user->name }}" 
                       class="rounded img-fluid shadow" 
                       width="250" height="300">
                  @else 
                    <img src="https://placehold.co/600x400" alt="" width="250" height="300">
                  @endif
                </div>

                <!-- Product Info -->
                <div class="col-lg-8 col-12 px-4">

                    <h2 class="text-uppercase text-success fw-bold">
                        {{ $user->name }}
                    </h2>


                 <h6 class="text-muted" style="text-align: justify; line-height: 1.7;">
                    {{ $user->description }}
                </h6>

                  <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <th>Name</th>
                          <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        </tr>
                      <tr>
                        <th>email</th>
                        <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <th>Role</th>
                        <td>{{ ($user->role) }}</td>
                      </tr>
                      <tr>
                        <th>phone</th>
                        <td>{{ ($user->phone) }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>
                            <span class="{{ $user->status == 'Active' ? 'badge bg-primary' : 'badge bg-danger' }}">
                               {{ $user->status }}
                            </span>
                        </td>


                      </tr>
                      <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at->format('d M, Y') }}</td>
                      </tr>
                      <tr>
                        <th>Updated At</th>
                        <td>{{ $user->updated_at->format('d M, Y') }}</td>
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
