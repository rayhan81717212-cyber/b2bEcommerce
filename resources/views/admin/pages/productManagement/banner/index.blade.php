@extends('admin.layout.master')
@section('title', 'Product')
@section('content')

    <div class="mx-md-4">
        <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Banner /</span> <span
                    class="text-dark">Manage</span></h4>
            <a href="{{ route('banner.create') }}" class="btn btn-dark my-3">Add Banner</a>
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card p-4">
                        <h5 class="card-header">Banner Table</h5>
                        @if (session('success') == 'Banner Delete Successfully!')
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @elseif (session('success') == 'Banner Update Successfully!' || session('success') == 'Banner Add Successfully!')
                            <div class="alert alert-dark">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered text-center">
                                   <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                        @foreach ($banner as $index => $item)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>
                                                    @if ($item->photo !==null)
                                                        <img src="{{ asset('storage/'.$item->photo) }}" alt="" width="400">
                                                    @endif
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
