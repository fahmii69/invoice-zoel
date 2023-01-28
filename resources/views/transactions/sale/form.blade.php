

@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4 col-12">
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
                            <option value="{{$item->id}}" data-custPayTerms="{{ $item->payment_terms }}"
                                @selected($sale->customer_id == $item->id)>
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" id="due_date" readonly
                                class="due_date form-control @error('due_date') is-invalid @enderror"
                                value="{{ old('due_date') ?? $sale->due_date }}">
                            @error('due_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
                                    <a class="text-success add-attribute pointer"><i class="fas fa-plus-square"></i> Add
                                        another product</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">
                                        <span style="font-weight:bold;"> Grand Total.</span>
                                        <input type="text" class="form-control grand_total" name="sub_total" id="total"
                                            value="">
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
<script>

    $('#shop_id').select2({
        placeholder: '-- Select Shop --',
        allowClear: true
    });

    $('.product_list').select2({
        placeholder: '-- Select Product --',
        allowClear: true
    });

    $('#customer_id').select2({
        placeholder: '-- Select Customer -- ',
        allowClear: true,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('keydown', function(e){
        if(e.keyCode == 13) {
            e.preventDefault();

            return false;
        }
    })

    $(document).on('click','.add-attribute', function(){
        loopAddProduct();
    });

    $(document).on('change','.customer_id', function(){
        let paymentDate = $(this).find(':selected').attr('data-custPayTerms');
        paymentDate = parseInt(paymentDate);
        var date = new Date();
        date.setDate(date.getDate()+paymentDate); 
        todayDate = date.toISOString().substr(0,10);
        $(this).closest('.row').find('.due_date').val(todayDate);
        loopContractPrice();
    });

    $(document).on('change','.sales_date',function(){
        loopContractPrice();
    });

    $(document).on('change','.product_list', async function(){
        // isModifier=$(this).val()
        let container = $(this).closest('tr');
        let quantity  = container.find('.quantity').val();
        let salePrice = $(this).find(':selected').attr('data-salePrice')
            salePrice = parseFloat(salePrice)
        let productId = $(this).val();

        contractProducts = await getContractPrice();

        let index = contractProducts.findIndex(x => x.product_id == productId);

        if(index > -1){
            salePrice = contractProducts[index].price;
            container.find('.sale_price').val(salePrice);
        }
        
        changePrice(quantity, salePrice, container);
        $(this).closest('tr').find('.sale_price').val(salePrice);
    });

    $(document).on('keydown', '.input-text', function(event){
        if(event.keyCode == 13){
            loopAddProduct();
        }
    });
    $(document).on('click', '.delete-product', function () {
            $(this).closest('.add-product').remove();
            loopContractPrice();
        })

    $(document).on('select2:open', () => {
        let allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
        $(this).one('mouseup keyup',()=>{
            setTimeout(()=>{
                allFound[allFound.length - 1].focus();
            },0);
        });
    });

    $(document).on('select2:select', () => {
        let allFound = document.querySelectorAll('.quantity');
        $(this).one('mouseup keyup',()=>{
            setTimeout(()=>{
                allFound[allFound.length - 1].focus();
            },0);
        });
    });

    $(document).on('change','.quantity',function(){
        let container = $(this).closest('tr');
        let salePrice = container.find('.sale_price').val();
            salePrice = parseFloat(salePrice.replaceAll(",", ""));

        changePrice($(this).val(), salePrice, container);
    });

    $(document).on('focusout', '.quantity', function(){
        if(this.value == ""){
            this.value = 0;
        }
    });

    function loopAddProduct(){
        html = `{!! $addProduct !!}`;
            $('#product-column').append(html);

            $('.product_list').select2({
                placeholder: '-- Select Product --',
                allowClear : true
            });

            $('.product_list').last().focus();
    }

    var loopContractPrice = async function(){

        contractProducts = await getContractPrice();

        var tr = $('#product-column').find('tr');

        $.each(tr, function(i, v){
            container = $(this);
            
            let productId = container.find('.product_list').val()
            let quantity  = container.find('.quantity').val()
            let salePrice = container.find('.sale_price').val()
                salePrice = parseFloat(salePrice.replace(/,/gi, '') || 0)
            
            let index = contractProducts.findIndex(x => x.product_id == productId);
            if(index > -1){
                salePrice = contractProducts[index].price;
                container.find('.sale_price').val(salePrice);

                changePrice(quantity, salePrice, container); 
            } else {
                let salePrice = container.find('.product_list').find(':selected').attr('data-salePrice')
                if(!salePrice){
                    salePrice = 0;
                }

                container.find('.sale_price').val(salePrice);

                changePrice(quantity, salePrice, container); 
            }

        })

    }

    var getContractPrice = async function(){
        let customerId = $('#customer_id').val();
        let date       = $('#sales_date').val();

        let result = await fetch("{{ route('sale.getContractPrice') }}", {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": "{{ csrf_token() }}"
            },
            method: "post",
            body: JSON.stringify({
                customerId: customerId,
                date: date    
            }),
        }).then(function(response){
            return response.json()
        })

        return result.data;
    }

    function changePrice(quantity, price, container){
        if(!price){
            price = 0;
        }
        result = quantity * price;

        container.find('.text-saleTotal').html(`
        <div class="form-group mt-2" style="display:flex; flex:wrap;">
            ` + ribuan(result) + `
            </div>
        `);

        grandTotalPrice();
    }

    function grandTotalPrice() {
        sum = 0;
        var product_row = document.getElementsByClassName('add-product');
        for (var i = 0; i < product_row.length; ++i) {
            var item      = product_row[i];
            var container = $(item).children();
            let quantity = container.find('.quantity').val()
            let salePrice = container.find('.sale_price').val()
            salePrice = parseFloat(salePrice.replace(/,/gi, '') || 0)
            rowResult = quantity * salePrice;

            sum+= rowResult;
        }

        $('.grand_total').inputmask({
            'alias'             : 'decimal',
            'prefix'            : 'Rp. ',
            'groupSeparator'    : ',',
            'autoGroup'         : true,
            'digits'            : 2,
            'digitsOptional'    : false,
            'removeMaskOnSubmit': true,
        });

        $('.sale_price').inputmask({
            'alias'         : 'decimal',
            'groupSeparator': ',',
            'autoGroup'     : true,
            'digits'        : 2,
            'digitsOptional': false,
            'placeholder'   : '0.00'
        });

        document.getElementById('total').value = sum;
    }
</script>
@if ($sale->id)
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

        var tr = $('#product-column').find('tr');

        $.each(tr, function(i, v){
            container = $(this);
            
            let productId = container.find('.product_list').val()
            let quantity  = container.find('.quantity').val()
            let salePrice = container.find('.sale_price').val()
                salePrice = parseFloat(salePrice.replace(/,/gi, '') || 0)

                changePrice(quantity, salePrice, container); 
        });       
    }
</script>
@else
<script>
    var contractProducts = [];
    loopAddProduct();

    $(function(){
        var todayDate = new Date().toISOString().slice(0, 10);
        $('#sales_date').val(todayDate);
        $('#due_date').val(todayDate);
    });
</script>
@endif
@endpush
