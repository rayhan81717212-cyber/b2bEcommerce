@extends('admin.layout.master')
@section('title', 'index')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Role /</span> Manage</h4>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <a href="{{ route('role.create') }}" class="btn btn-dark mb-3"> Add Role</a>
                <div class="mb-3">
                    @if (session('success') == 'Role Delete Successfully!')
                    <div class="alert alert-danger mb-0" role="alert">
                        <h6 class="mb-0">{{session('success')}}</h6>
                    </div>
                    @elseif (session('success') == 'Role Add Successfully!' || session('success') == 'Role Update Successfully!' )
                    <div class="alert alert-primary mb-0" role="alert">
                            <h6 class="mb-0">{{session('success')}}</h6>
                        </div>
                    @endif
                </div>
                <div class="card">
                    <h5 class="card-header">Bordered Table</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-white"> <i class="fas fa-hashtag"></i> Id</th>
                                        <th class="bg-dark text-white"> <i class="fas fa-user"></i> Name</th>
                                        <th class="bg-dark text-white"> <i class="fas fa-cogs"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $index=>$item)
                                        <tr>
                                            <td>{{ $index+1 }} </td>
                                            <td>{{$item->name }} </td>
                                            <td> 
                                                <div class="d-flex justify-content-center">
                                                    <form action="{{ route('role.show', $item->id) }}" method="GET">
                                                        @csrf
                                                        <button class="btn btn-primary btn-sm me-2"><i class="fa fa-eye"></i></button>
                                                    </form>
                                                    <form action="{{ route('role.edit', $item->id) }}" method="GET">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-dark btn-sm me-2"><i class="fa fa-pen"></i></button>
                                                    </form>
                                                    <form action="{{ route('role.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>

                                                </div>
                                             </td>
                                        </tr>
                                    @endforeach
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
