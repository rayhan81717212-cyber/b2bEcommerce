@extends('admin.layout.master')
@section('title', 'Categories Create')
@section('content')



    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Categories</span>
                <span class="text-dark"> / Create</span>
            </h4>
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-4 font-weight-bold text-dark">Create Categories</h3>


                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf


                        <div class="form-group mb-3">
                            <label>Categories Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark ">Save</button>


                    </form>
                </div>
            </div>



        </div>
    </div>

@endsection
