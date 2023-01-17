@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($stock->id)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id"
                        class="form-control @error('product_id') is-invalid @enderror">
                        @foreach ($product as $item)
                        <option></option>
                        <option value="{{$item->id}}" @selected($stock->product_id == $item->id)>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="shop_id">Shop</label>
                    <select name="shop_id" id="shop_id"
                        class="form-control @error('shop_id') is-invalid @enderror">
                        @foreach ($shop as $item)
                        <option></option>
                        <option value="{{$item->id}}" @selected($stock->shop_id == $item->id)>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('shop_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>

                    <input type="number" value="{{ old('quantity') ?? $stock->quantity }}"
                        name="quantity" id="quantity"
                        class="form-control @error('quantity') is-invalid @enderror">
                    @error('quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>
    $('#product_id').select2({
        placeholder: '-- Select Product --',
        allowClear: true
    });

    $('#shop_id').select2({
        placeholder: '-- Select Shop -- ',
        allowClear: true,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endpush
