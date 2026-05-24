@extends('admin.layout.master')

@section('content')
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restock /</span> <spanclass="text-dark">Manage</span>
        </h4>


        <div class="card p-4">
            <h3>Stock Management</h3>
            <div class="d-flex justify-content-end mb-3">

                <form method="GET" action="{{ route('stock.index') }}" class="d-flex gap-2">

                    <input type="text" name="search" class="form-control" style="width: 250px;"
                        placeholder="Search product..." value="{{ request('search') }}">

                    <button class="btn btn-primary btn-sm py-0">
                        Search
                    </button>

                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-dark">
                                <th class="text-white">Name</th>
                                <th class="text-white">Photo</th>
                                <th class="text-white">Stock</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr id="row-{{ $product->id }}">
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                                            width="60">
                                    </td>

                                    <td id="stock-{{ $product->id }}">
                                        {{ $product->stock_quantity }}
                                    </td>

                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                            onclick="openModal({{ $product->id }}, '{{ $product->name }}', {{ $product->stock_quantity }})">
                                            + Add Stock
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                {{ $products->withQueryString()->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- modal -->
    <div id="stockModal"
        style="display:none; position:fixed; top:25%; left:35%; width:400px; background:#fff; padding:20px; border:1px solid #ccc; z-index:9999;">

        <h4 id="productName"></h4>

        <p>Current Stock: <span id="currentStock"></span></p>

        <form id="stockForm">
            @csrf

            <input type="hidden" name="product_id" id="product_id">

            <input type="number" name="quantity" class="form-control mb-2" placeholder="Enter quantity" required>

            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(id, name, stock) {
            $('#product_id').val(id);
            $('#productName').text(name);
            $('#currentStock').text(stock);

            $('#stockModal').show();
        }

        function closeModal() {
            $('#stockModal').hide();
        }

        // ajax 
        $(document).ready(function() {

            $('#stockForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('restock') }}",
                    type: "POST",
                    data: $(this).serialize(),

                    success: function(res) {
                        if (res.success) {

                            $('#stock-' + res.product_id).text(res.new_stock);
                            $('#currentStock').text(res.new_stock);

                            $('input[name="quantity"]').val('');

                            closeModal();

                            toastr.success(res.message);
                            // alert(res.message);
                        }
                    },

                    error: function() {
                        alert('Error updating stock');
                    }
                });
            });

        });
    </script>
@endsection
