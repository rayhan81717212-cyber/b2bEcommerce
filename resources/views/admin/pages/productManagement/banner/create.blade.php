@extends('admin.layout.master')
@section('title', 'Create Brand')
@section('content')



    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Banner</span>
                <span class="text-dark"> / Create</span>
            </h4>
            <div class="card p-4">
    <div class="card-body">
        <h3 class="mb-4">Create Banner</h3>
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
                
            <!-- Step 2: Photo -->
                <div class="form-group mb-3">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Product Photo</label>
                        <input type="file" name="photo" id="photo" class="filepond" required/>
                        @error('photo')
                           <span class="text-danger">{{$message}}</span> 
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>


        </form>
    </div>
</div>



        </div>
    </div>

@endsection
