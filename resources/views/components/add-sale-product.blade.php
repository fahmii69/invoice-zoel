<tr class="add-product">
    <td>
        <div class="form-group">
            <select name="product_list[]" class="form-control product_list" required>
                @foreach ($product as $item)
                <option></option>
                <option value="{{$item->id}}" 
                data-salePrice="{{ $item->sale_price }}">{{$item->name}}</option>
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
            <input type="number" id="quantity" name="quantity[]" class="form-control input-text quantity"value="0">
        </div>
    </td>

    <td>
        <div class="form-group" style="display:flex; flex:wrap;">

            <input type="text" readonly id="sale_price" name="sale_price[]" class="form-control sale_price" value="0">
        </div>
    </td>
    <td class="text-saleTotal" id="text-saleTotal">
        <div class="form-group mt-2" style="display:flex; flex:wrap;"> Rp.0 </div>
    </td>
    <td>
        <div class="form-group">
            <button class="btn btn-danger delete-product" type="button"><i class="fas fa-trash-alt"></i></button>
        </div>
    </td>
</tr>
