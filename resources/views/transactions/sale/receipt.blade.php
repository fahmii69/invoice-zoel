<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Receipt</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				/* padding: 5px; */
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				/* padding-bottom: 20px; */
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
			.align-text-right{
				text-align: right !important; padding-right: 1rem !important;
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
			<div class="mb-4">
				<img src="{{ url('https://zoelidesigns.com/wp-content/uploads/2021/11/zoeli-logo-2.png') }}" alt="Company Logo" style="width: 50%; max-width: 300px">
			</div>
			
			<table>
				<tr class="top">
					<td colspan="4">
						<table style="color: #181818; font-size: 90%" class="mb-3" >
							<tr>
								<td>Invoice No</td>
								<td>:</td>
								<td>{{ $sale->code }}</td>
							</tr>
							<tr>
								<td>Invoice Date</td>
								<td>:</td>
								<td>{{ date('j F Y H:i A', strtotime($sale->created_at)) }}</td>
							</tr>
						</table>
					</td>

					<td colspan="2">
						<table style="color: #181818; font-size: 90%;">
							<tr>
								<td>
                                    <b>Billing Details</b><br />
								@php
									$customer      = $sale->customer;

									$name = $customer->name;
									$address  = $customer->address;
									$phone = $customer->phone;
								@endphp

									{{ $name }}<br>
									{{ $phone }} <br>
									{{ $address }} <br>

								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">

				</tr>

			</table>
			<h4 align="left" style="color: #181818;"><b>Order Details</b></h4>
			<table>
				<thead style="color: #181818; font-size: 90%;">
					<th>Qty Product</th>
					<th class="align-text-right">Price</th>
					<th align="left">Total</th>
				</thead>
				<tbody style="color: #181818; font-size: 80%;">
					@forelse($sale->salesDetail as $item)
						<tr>
							<td style="text-align: left;">{{ number_format($item->quantity) }} x {{ $item->product_list  }} <br>
									<p style="font-size: 90%; margin-top: 1%">
										&nbsp; &nbsp; Product Name : {{ $item->product_list  }} <br>
									</p>
							</td>
							<td class="align-text-right">{{ rupiah($item->price) }}</td>
							<td style="text-align: left;">{{ rupiah($item->total) }}</td>
						</tr>
						@empty
						@endforelse
				
					<tr>
						<td> &nbsp;&nbsp;</td>
						<td class="align-text-right">
							<b>
								Subtotal:
							</b>
						</td>
						<td style="text-align: left;"><b>
							{{ rupiah($sale->sub_total) }}
						</td>
					</tr>
					<tr>
						<td> &nbsp;&nbsp;</td>
						<td class="align-text-right">
							<b>
								Tax:
							</b>
						</td>
						<td style="text-align: left;"><b>
							{{ rupiah($sale->tax) }}
						</td>
					</tr>
					<tr>
						<td> &nbsp;&nbsp;</td>
						<td class="align-text-right">
							<b>
								Grand Total:
							</b>
						</td>
						<td style="text-align: left;"><b>
							{{ rupiah($sale->grand_total) }}</b>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="text-align: end; margin-top: 1rem; font-size: 80%; color: #181818;">

			</table>
		</div>
	</body>
</html>