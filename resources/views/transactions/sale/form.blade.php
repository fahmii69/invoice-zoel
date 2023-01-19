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
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sales_date">Sales Date</label>
                        <input type="date" name="sales_date" id="sales_date"
                            class="form-control @error('sales_date') is-invalid @enderror"
                            value="{{ old('sales_date') }}">
                        @error('sales_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="shop_id">Shop</label>
                        <select name="shop_id" id="shop_id" class="form-control @error('shop_id') is-invalid @enderror">
                            @foreach ($shop as $item)
                            <option></option>
                            <option value="{{$item->id}}" {{-- @selected($shop->shop_id == $item->id) --}}>
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
                    <div class="col-md-4">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id"
                            class="form-control @error('customer_id') is-invalid @enderror">
                            @foreach ($customer as $item)
                            <option></option>
                            <option value="{{$item->id}}" {{-- @selected($stock->customer_id == $item->id) --}}>
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
                            <th>Curent Inventory </th>
                            <th>Quantity </th>
                            <th>Price</th>
                            <th>Sub_Total</th>
                            <th style="width: 5%"></th>
                        </thead>
                        <tbody id="product-column">
                            {{-- <x-add-sale-product :product=$product/> --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">
                                        <h6  class="grand-total" style="font-weight:bold;"> Grand Total.</h6>
                                        <input type="text"
                                        class="form-control grand-total"
                                        name="product_price"  id="total" value="">
                                    </div>
                                </td>
                            </tr>
 
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="{{ route('stock.index') }}" class="btn btn-secondary float-right mr-2">Cancel</a>
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
        // allowClear: true
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

    loopAddProduct();
    $(document).on('change','.product_list', function(){
        // isModifier=$(this).val()
        let container = $(this).closest('tr');
        let quantity  = container.find('.quantity').val();
        let salePrice = $(this).find(':selected').attr('data-salePrice')
            salePrice = parseFloat(salePrice)

        changePrice(quantity, salePrice, container);
        
        $(this).closest('tr').find('.sale_price').val(salePrice);
        $('.sale_price').inputmask({
            'alias'         : 'decimal',
            'groupSeparator': ',',
            'autoGroup'     : true,
            'digits'        : 2,
            'digitsOptional': false,
            'placeholder'   : '0.00'
        });
        
        console.log(salePrice);
    });

    function loopAddProduct(){
        html = `{!! $addProduct !!}`;
            $('#product-column').append(html);
    
            $('.product_list').select2({
                placeholder: '-- Select Product --',
                allowClear : true
            });

            // $('#product_list'+i+'').val('').trigger('change');
            $('.product_list').last().focus();
            // }
    }
    $(document).on('keydown', '.input-text', function(event){
        if(event.keyCode == 13){
            loopAddProduct();
        }
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

    function changePrice(quantity, price, container){
        result = quantity * price;

        container.find('.text-subTotal').html(`
        <div class="form-group mt-2" style="display:flex; flex:wrap;">
            ` + ribuan(result) + `
            </div>
            `);

    grandTotalPrice(quantity, price, result);
    }
        
    function grandTotalPrice(quantity,price,result) {
    
        var cusid_ele = document.getElementsByClassName('add-product');
        console.log(cusid_ele);
        for (var i = 0; i < cusid_ele.length; ++i) {
            var item      = cusid_ele[i];
            var container = $(item).children();
            let quantity = container.find('.quantity').val()
            let salePrice = container.find('.sale_price').val()
            salePrice = parseFloat(salePrice.replace(/,/gi, '') || 0)
            // let salePrice = 
            // var quantity  = container.find('.quantity').val();
            // item.innerHTML = 'this is value';
            console.log(salePrice);
            
            }

        // sum = $result
        // $('.addProduct').each(function(){
        //     $(this).find('td').each(function(){
        //         console.log(quantity);
        //     })
        // })
        // let passingItem=$('#accordionExample').find('.addProduct');
        // $('.add-product').each(function(index,value) { 
                // salePrice = parseFloat(salePrice)    
                
                // $(this).closest('tr').find('.grand_t').val(salePrice);
                
                // console.log(123);
        // document.getElementById('total').value = result;

        // console.log(quantity,price,result);
        // });

    }

    // var dataPassingItem=[];
    //     var dataPassingModifier=[];
    //     $.each(passingItem, function(index,value){
    //         ItemName=$(this).find('.name').val();
    //         HargaTotal=$(this).find('.hargaAttr').attr('data-price');
    //         hargaAsli=$(this).find('.hargaAttr').attr('data-hargaAsli');
    //         Qty=$(this).find('.changeQty').val();
    //         listSales=$(this).find('.listSales').val();
    //         notes=$(this).find('.notes').val();

    //         dataPassingItem.push({
    //             'ItemName':ItemName, 
    //             'HargaTotal':HargaTotal, 
    //             'Qty':Qty, 
    //             'listSales':listSales, 
    //             'notes':notes, 
    //             'hargaAsli':hargaAsli, 
    //         });
    //     });

    //     function changeTotalPrice(){
    //     listitem=$('.add-product');
    //     subtotal=0;
    //     total=0;

    //     if(listitem.length>0){
    //         $.each(listitem,function(index,value){
    //             hargabarang=$(this).find('.hargaAttr').attr('data-price');
    //             subtotal=subtotal+parseInt(hargabarang);
    //             total=subtotal;
    //         });  
    //     }else{
    //         subtotal=0;
    //         total=0;
    //     }        

    //     if(diskonType==1){
    //         total=parseInt(subtotal)-parseInt(diskonValue);
    //         diskon=diskonValue;

    //     }else{
    //         diskon=parseInt((subtotal*diskonValue)/100);
    //         total=parseInt(subtotal)-parseInt(diskon);
    //     }
    //     document.getElementById('total').innerHTML=ribuan(total);

    // }
</script>
@endpush
