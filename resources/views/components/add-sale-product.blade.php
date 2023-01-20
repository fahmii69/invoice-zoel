<tr class="add-product">
    <td>
        <div class="form-group">
            <select name="product_list[]" class="form-control product_list" required>
                @foreach ($product as $item)
                <option></option>
                <option value="{{$item->id}}" data-salePrice="{{ $item->sale_price }}">{{$item->name}}</option>
                @endforeach
            </select>
            @error('product_list')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </td>
    <td>
        <div class="form-group" style="display:flex; flex:wrap;">
            <input type="hidden" disabled id="Product_Code" name="Product_Code" class="form-control input-barang">
            <input type="number" disabled id="System_Stock" name="System_Stock"
                class="form-control input-barang System_Stock">
        </div>
    </td>

    <td>
        <div class="form-group" style="display:flex; flex:wrap;">
            <input type="number" id="quantity" name="quantity[]" class="form-control input-barang input-text quantity"
                value="0">
        </div>
    </td>

    <td>
        <div class="form-group" style="display:flex; flex:wrap;">

            <input type="text" disabled id="sale_price" name="sale_price[]" class="form-control input-barang sale_price">
        </div>
    </td>
    <td class="text-subTotal" id="text-subTotal">
        <div class="form-group mt-2" style="display:flex; flex:wrap;">
        {{-- <span class="form-group"> --}}
            Rp.0
        {{-- </span> --}}
        </div>
    </td>
    <td>
        <div class="form-group">
            <button class="btn btn-danger delete-product" type="button"><i class="fas fa-trash-alt"></i></button>
        </div>
    </td>
</tr>
