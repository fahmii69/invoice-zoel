<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				/* color: #000; */
			}

            .jp-name {
				/* font-style: sans-serif, !important */
				font-weight: 300px;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
				font-size: 21px !important
			}

			.header{
				font-size:12px;
				/* margin-bottom: 2px; */
				/* margin-top: 5px */
			}

			body h2 {
				font-weight: 300px;
				margin-top: 10px;
				margin-bottom: 20px;
				font-size: 21px;
			}

			body a {
				color: #06f;
			}
        .container{
            margin:0 auto; */
            width: 100%;
            height:auto; 
            background-color:#fff;
        }

        .invoice-box {
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 14px;
				line-height: 18px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: rgb(0, 0, 0);
			}

        .invoice-box table {
            width: 100%;
            font-size: 12px;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
            margin:0 auto;
        }
           
        /* table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width: 100%;
        } */
        td, tr, th{
            border:1px solid #333;
            /* width: 100% */
            /* width:185px; */
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }

        .align-text-right{
				text-align: right !important; padding-right: 1rem !important;
        }

        .align-text-center{
            text-align: center !important;
        }

        .mb-1 {
        margin-bottom: 0.25rem !important; }

        .mb-2 {
        margin-bottom: 0.5rem !important; }

        .mb-3 {
        margin-bottom: 1rem !important; }

        .mb-4 {
        margin-bottom: 2rem !important; }

        .page-break {
            page-break-after: always;
        }

        .ul-ultimate{
            list-style: none;
            padding: 0;
            margin-left: 30px;
            list-style: circle;
        }
        .li-ultimate{
            /* padding-left: 1.3em; */
            margin-bottom: 3px;
        }
        .li-ultimate:before{
            color: #7a7a7a;
            display: inline-block;
            margin-left: -1.3em; /* same as padding-left set on li */
            width: 1.3em; /* same as padding-left set on li */
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="mb-2">
            <h3 class="jp-name">{{ getSetting('jp_name') }}</h3>
            <div class="header">
                <span>{{ getSetting('jp_address') }}</span><br>
                <span>{{ getSetting('jp_state') }}</span><br>
                <span>{{ getSetting('jp_website') }}</span><br>
                <span>{{ getSetting('jp_email') }}</span><br>
                <span>{{ getSetting('jp_phone') }}</span><br>
            </div>
            <h2>INVOICE</h2>
        </div>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <td>
                            <p>Invoice Number : <b>{{ $sale->code }}</b></p>
                            <p>Invoice Date: {{ date('j F Y', strtotime($sale->created_at)) }}</p>
                            <p>Invoice Due Date: {{ date('j F Y', strtotime($sale->created_at)) }} </p>
                            <p>Balance Due: {{ rupiah($sale->grand_total) }}</p>
                        </td>
                        <td colspan="2">
                            <h4>Pelanggan: </h4>
                            <p>{{ $sale->customer->name }}<br>
                            {{ $sale->customer->address }}<br>
                            {{-- {{ $sale->customer->phone }} <br>
                            {{ $sale->customer->email }} --}}
                            </p>
                        </td>
                        <td colspan="2">
                            <h4>Pelanggan: </h4>
                            <p>{{ $sale->customer->name }}<br>
                            {{ $sale->customer->address }}<br>
                            {{-- {{ $sale->customer->phone }} <br>
                            {{ $sale->customer->email }} --}}
                            </p>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">Item</th>
                        <th width="5%">Unit</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Unit Cost</th>
                        <th width="20%">Line Total</th>
                    </tr>
                    @foreach ($sale->salesDetail as $row)
                    <tr>
                        <td>{{ $row->product_list }}</td>
                        <td class="align-text-center">{{ $row->product->unit }}</td>
                        <td class="align-text-center">{{ $row->quantity }}</td>
                        <td>Rp {{ number_format($row->price) }}</td>
                        <td>Rp {{ $row->total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Subtotal</th>
                        <td>Rp {{ number_format($sale->sub_total) }}</td>
                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td></td>
                        <td>2%</td>
                        <td>Rp {{ number_format($sale->tax) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <td>Rp {{ number_format($sale->grand_price) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>