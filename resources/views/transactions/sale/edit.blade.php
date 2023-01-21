@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ $action }}" method="POST" id="form-data">
                @csrf
                @if ($sale->id)
                @method('put')
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sales_date">Sales Date</label>
                            <input type="date" name="sales_date" id="sales_date"
                                class="sales_date form-control @error('sales_date') is-invalid @enderror"
                                value="{{ old('sales_date') ?? $sale->sales_date }}">
                            @error('sales_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id"
                            class="customer_id form-control @error('customer_id') is-invalid @enderror">
                            @foreach ($customer as $item)
                            <option></option>
                            <option value="{{$item->id}}" data-custId="{{ $item->id }}" @selected($sale->customer_id == $item->id)>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                
                <div class="form-group mt-4 table-responsive">
                    <table class="table" width="100%">
                        <thead>
                            <th style="width: 500px">Product</th>
                            {{-- <th>Curent Inventory </th> --}}
                            <th>Quantity </th>
                            <th>Price</th>
                            <th>Sub_Total</th>
                            <th style="width: 5%"></th>
                        </thead>
                        <tbody id="product-column">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="border-top:0px;">
                                    <a class="text-success add-attribute pointer"><i class="fas fa-plus-square"></i> Add another product</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">
                                        <span style="font-weight:bold;"> Grand Total.</span>
                                        <input type="text"
                                        class="form-control grand_total"
                                        name="sub_total" id="total" value="">
                                    </div>
                                </td>
                            </tr>
 
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('sale.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
@include('transactions.sale.js.sale-script')
<script>
    var contractProducts = [];
    loopEditProduct();

    function loopEditProduct(){
    html = `{!! $editProduct !!}`;
        $('#product-column').append(html);

        $('.product_list').select2({
            placeholder: '-- Select Product --',
            allowClear : true
        });

        $('.product_list').last().focus();
        grandTotalPrice();
}
</script>
@endpush

