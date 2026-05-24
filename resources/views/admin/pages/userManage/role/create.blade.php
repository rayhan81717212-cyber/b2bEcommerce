@extends('admin.layout.master')
@section('title', 'index')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role /</span> Manage</h4>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header">Bordered Table</h5>
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md">
                                    <label for="name">Role</label>
                                    <input type="text" name="name" class="form-control" autofocus value="{{ old('name') }}">
                                    <div>
                                        @error('name')
                                            <span class="text-danger" >{{$message}}</span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-dark mt-3">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
