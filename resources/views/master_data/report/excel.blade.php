<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td style="background-color: yellow; border-bottom: 1px solid #000000; border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">{{ $loop->iteration }}</td>
            <td style="background-color: yellow; border-bottom: 1px solid #000000; border-top: 1px solid #000000;">{{ $item->product->name }}</td>
            <td style="background-color: yellow; border-bottom: 1px solid #000000; border-top: 1px solid #000000;border-right: 1px solid #000000;">{{ $item->total_quantity}}</td>
        </tr>
            @forelse (getBreakdownSales($item->product_id,$startDate,$endDate) as $sales)
            <tr>
                <td style="border-left: 1px solid #000000;"></td>
                <td> - {{ $sales->sale->customer->name }}</td>
                <td style="border-right: 1px solid #000000;"> {{ $sales->total_quantity }}</td>
            </tr>
            @empty

            @endforelse
        @empty
        @endforelse
    </tbody>
</table>