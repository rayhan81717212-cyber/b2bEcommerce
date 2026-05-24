@extends('admin.layout.master')
@section('title', 'Product Create')
@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Product Gallery</span>
            <span class="text-dark"> / Create</span>
        </h4>

        <div class="card p-4">
            <div class="card-body">
                <h3 class="mb-4 font-weight-bold text-dark">Create Product Gallery</h3>

                <form action="{{ route('productgallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="brand">Select Brand</label>
                        <select id="brand" name="brand_id" class="form-control">
                            <option selected disabled>-- Select Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="product">Select Product</label>
                        <select id="product" name="product_id" class="form-control">
                            <option value="">-- Select Product --</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="photo" class="form-label">Product Photo</label>
                        <input type="file" name="photo[]" id="photo" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-dark">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#brand').on('change', function() {
    let brand_id = $(this).val();
    // $('#product').html('<option value="">Loading...</option>');
    console.log('{{ url("get-products") }}/' + brand_id)

    if (brand_id) {
        $.ajax({
            url: '{{ url("get-products") }}/' + brand_id,
            type: 'GET',
            success: function(data) {
                // console.log(data)
                $('#product').empty().append('<option value="">-- Select Product --</option>');
                $.each(data, function(key, product) {
                    $('#product').append('<option value="' + product.id + '">' + product.name + '</option>');
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    } else {
        $('#product').html('<option value="">-- Select Product --</option>');
    }
});
</script>

@endsection
