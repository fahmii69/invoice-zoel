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
            salePrice = parseFloat(salePrice)
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