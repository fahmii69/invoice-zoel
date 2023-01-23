<tr class="add-product">
    <td>
        <div class="form-group">
            <select name="product_list[]" class="form-control product_list" required>
                @foreach ($product as $item)
                <option></option>
                <option value="{{$item->id}}" 
                
                    {{-- @selected($getSale->product_id == $item->id) --}}
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
            <input type="text" id="price" name="price[]" class="form-control input-text price"
                value="0"
            >
        </div>
    </td>
    <td>
        <div class="form-group">
            <button class="btn btn-danger delete-product" type="button"><i class="fas fa-trash-alt"></i></button>
        </div>
    </td>
</tr>