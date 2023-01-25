@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form action="{{ $action }}" method="POST" id="form-data">
                @csrf
                @if ($contract->id)
                @method('put')
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="row">Date Range</label>
                        <input type="text" name="daterange" class="form-control  @error('daterange') is-invalid @enderror"id="daterange"
                        @if($contract->id)
                            value="{{ date('d/m/Y',strtotime($contract->start_date)).' - '. date('d/m/Y',strtotime($contract->end_date)) }}" 
                        @endif
                         />
                        @error('daterange')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>
                    </div>

                    <div class="col-md-8">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id"
                            class="customer_id form-control @error('customer_id') is-invalid @enderror">
                            @foreach ($customer as $item)
                            <option></option>
                            <option value="{{$item->id}}" data-custId="{{ $item->id }}"
                                @selected($contract->customer_id == $item->id)>
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
                            <th class="col-md-8">Product</th>
                            {{-- <th>Curent Inventory </th> --}}
                            <th>Price </th>
                            <th style="width: 5%"></th>
                        </thead>
                        <tbody id="product-column">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="border-top:0px;">
                                    <a class="text-success add-attribute pointer"><i class="fas fa-plus-square"></i> Add
                                        another product</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('contract.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>

    $('#customer_id').select2({
        placeholder: '-- Select Customer -- ',
        allowClear: true,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.add-attribute', function(){
        loopAddProduct();
    });

    $(document).on('click', '.delete-product', function () {
        $(this).closest('.add-product').remove();
    })

    $(document).on('select2:open', () => {
        let allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
        $(this).one('mouseup keyup',()=>{
            setTimeout(()=>{
                allFound[allFound.length - 1].focus();
            },0);
        });
    });

    $(window).on('keydown', function(e){
        if(e.keyCode == 13) {
            e.preventDefault();

            return false;
        }
    });

    $(document).on('keydown', '.input-text', function(event){
        if(event.keyCode == 13){
            loopAddProduct();
        }
    });

    $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale:{
                    format: 'DD/MM/YYYY'
                }
            });
        });

    function loopAddProduct(){
        html = `{!! $addProduct !!}`;
            $('#product-column').append(html);

            $('.product_list').select2({
                placeholder: '-- Select Product --',
                allowClear : true
            });

            $('.price').inputmask({
                'alias'             : 'decimal',
                'prefix'            : 'Rp. ',
                'groupSeparator'    : ',',
                'autoGroup'         : true,
                'digits'            : 2,
                'digitsOptional'    : false,
                'removeMaskOnSubmit': true,
            });

            $('.product_list').last().focus();
    }

</script>
@if ($contract->id)
<script>
    loopEditProduct();

    

    function loopEditProduct(){
    html = `{!! $editProduct !!}`;
        $('#product-column').append(html);

        $('.product_list').select2({
            placeholder: '-- Select Product --',
            allowClear : true
        });

        $('.price').inputmask({
                'alias'             : 'decimal',
                'prefix'            : 'Rp. ',
                'groupSeparator'    : ',',
                'autoGroup'         : true,
                'digits'            : 2,
                'digitsOptional'    : false,
                'removeMaskOnSubmit': true,
            });

        $('.product_list').last().focus();
}
</script>
@else
<script>
    loopAddProduct();
</script>
@endif
@endpush
