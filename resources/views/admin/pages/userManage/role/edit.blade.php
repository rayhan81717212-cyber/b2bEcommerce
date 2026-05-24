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
                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PATCH') 
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control">
                            <button class="btn btn-dark mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
