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
				/* font-size: 13px !important; */
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

        .invoice-box table td {
            vertical-align: top;
            text-align: left;
        }

        .invoice-box .tbody{
            border-top: 2px solid #000  !important;
            border-bottom: 2px solid #000 !important;

        }

        /* table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width: 100%;
        } */

        td, tr, th{
            border:1px solid rgb(0, 0, 0);
            /* width: 100% */
            /* width:185px; */
        }
        th{
            /* background-color: #f0f0f0; */
        }
        h4, p{
            margin:0px;
        }

        .align-text-right{
				text-align: right !important; padding-right: 1rem !important;
        }

        .align-text-left{
				text-align: left !important; padding-left: 1rem !important;
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

        .mt-4 {
        margin-top: 2rem !important; }

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
                            <table style="border:none !important;">
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important;">Invoice Number</td>
                                    <td  style="border:none !important;">{{ $sale->code }}</td>
                                </tr>
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important;">Invoice Date</td>
                                    <td  style="border:none !important;">{{ date('d-M-Y', strtotime($sale->sales_date)) }}</td>
                                </tr>
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important;">Invoice Due Date</td>
                                    <td  style="border:none !important;">{{ date('d-M-Y', strtotime($sale->due_date)) }}</td>
                                </tr>
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important;">Balance Due</td>
                                    <td  style="border:none !important;">{{ rupiah($sale->grand_total) }}</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2">
                            {{-- <p>Customer Type : {{  $sale->customer->customer_type }} </p>
                            <b>{{ $sale->customer->name }}</b> --}}
                            <table style="border:none !important;">
                                <tr  style="border:none !important;">
                                    <td style="border:none !important; width: 45%">Customer Type :</td>
                                    <td style="border:none !important;">{{ $sale->customer->customer_type }}</td>
                                </tr>
                                <tr  style="border:none !important;">
                                    <td style="border:none !important;font-weight: bold;" colspan="2">{{ $sale->customer->name }}</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2">
                            <table style="border:none !important;">
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important; width:25%;">Ships To</td>
                                    <td  style="border:none !important;width:5%">:</td>
                                    <td  style="border:none !important;"></td>
                                </tr>
                                <tr  style="border:none !important;">
                                    <td  style="border:none !important; width:25%;">Order Date</td>
                                    <td  style="border:none !important;width:5%">:</td>
                                    <td  style="border:none !important;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <tr>
                        <th class="align-text-left" width="30%">Item</th>
                        <th class="align-text-center" width="5%">Unit</th>
                        <th class="align-text-center" width="25%">Quantity</th>
                        <th class="align-text-right" width="20%">Unit Cost</th>
                        <th class="align-text-right" width="20%">Line Total</th>
                    </tr>
                    @foreach ($sale->salesDetail as $row)
                    <tr>
                        <td class="align-text-left"><b>{{ $row->product_list }}</b></td>
                        <td class="align-text-center">{{ $row->product->unit }}</td>
                        <td class="align-text-center">{{ $row->quantity }}</td>
                        <td class="align-text-right">{{ rupiah($row->price) }}</td>
                        <td class="align-text-right">{{ rupiah($row->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:right;" colspan="4">Subtotal</th>
                        <td style="text-align:right;"><b>{{ rupiah($sale->sub_total) }}</b></td>
                    </tr>
                    <tr>
                        <th style="text-align:right; font-size:14px;" colspan="4">Balance Due</th>
                        <td style="text-align:right; font-size:14px;"><b>{{ rupiah($sale->grand_total) }}</b></td>
                    </tr>
                </tfoot>
            </table>
            <table>
                <thead style="border:none !important;">
                    <tr style="border:none !important;">
                        <td style="border:none !important;width:30%;text-align:center;">
                            <div style="margin-top:150px;">
                            Delivered By,
                            </div>
                        </td>
                        <td style="border:none !important;">
                        </td>
                        <td style="border:none !important;width:30%;text-align:center;">
                            <div style="margin-top:150px;">
                            Received By,
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>


    </div>


</body>
</html>