 @forelse ($saleDetail as $key => $item)
    <tr class="add-product">
        <tr class="tes-product bg-info">
            <td class="productId">{{ $item->product->name }}</td>
            <td class="quantity">{{ $item->total_quantity }}</td>
        </tr>
        @forelse (getBreakdownSales($item->product_id,$startDate,$endDate) as $sales)
            <tr class="">
                <td> - {{ $sales->sale->customer->name }}</td>
                <td> {{ $sales->total_quantity }}</td>
            </tr>
        @empty

        @endforelse
    </tr>   
 @empty

 @endforelse
