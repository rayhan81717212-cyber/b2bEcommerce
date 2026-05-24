@extends('admin.layout.master')
@section('title', 'Create Brand')

@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Brand</span>
            <span class="text-dark"> / Create</span>
        </h4>

        <div class="card p-4">
            <div class="card-body">

                <h3 class="mb-4">Create Brand</h3>

                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- Brand Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name') }}" required>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand Logo</label>
                            <input type="file" name="photo" class="form-control" required>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Brand Description</label>
                            <textarea name="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-dark">
                            Create Brand
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection