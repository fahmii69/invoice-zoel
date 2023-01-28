@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <form action="{{ $action }}" method="POST" id="form" enctype="multipart/form-data">
            @csrf
            @if ($product->id)
            @method('put')
            @endif
            <div class="container">
                <br>
                <strong>General</strong>
                <div class="row">
                    <div class="col-md-4">
                        <p>Change general information for this product. </p>
                        <br>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Product Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') ?? $product->name }}"
                                        placeholder="Enter Product Name..."
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        @foreach ($category as $item)
                                        <option></option>
                                        <option value="{{$item->id}}" @selected($product->category_id == $item->id)>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">Unit</label>

                                    <input type="text" value="{{ old('unit') ?? $product->unit }}"
                                        name="unit" id="unit"
                                        class="form-control @error('unit') is-invalid @enderror">
                                    @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_price">Sale Price</label>

                                <input type="text" value="{{ old('sale_price') ?? $product->sale_price }}"
                                        name="sale_price" id="sale_price"
                                        class="sale_price form-control @error('sale_price') is-invalid @enderror">
                                    @error('sale_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ml-2">
                                <label>Choose image from your computer :</label>
                                <span class="form-control @error('image') is-invalid @enderror">
                                    <i class="fa fa-folder-open"></i>&nbsp;Browse
                                    <input type="file" name="image">
                                </span>
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Stock</label>
                                <input type="number" class="input-value input-noVariant form-control @error('current_inventory') is-invalid @enderror"
                                name="current_inventory" id="current_inventory" value="0" readonly>
                                @error('current_inventory')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group float-right mb-3" role="group" aria-label="Button group">
                    <a class="btn btn-lg btn-secondary" type="button" href="{{ route('product.index') }}">Cancel</a>
                    <button type="submit" class="btn btn-lg btn-success btn-submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>

    $('.sale_price').inputmask({
        'alias'             : 'decimal',
        'prefix'            : 'Rp. ',
        'groupSeparator'    : ',',
        'autoGroup'         : true,
        'digits'            : 2,
        'digitsOptional'    : false,
        'removeMaskOnSubmit': true,
    });

    $('#category_id').select2({
        placeholder: '-- Select Category --',
        allowClear: true
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endpush
