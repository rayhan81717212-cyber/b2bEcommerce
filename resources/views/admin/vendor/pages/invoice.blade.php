<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>

    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .invoice {
            width: 100%;
            max-width: 800px; 
            margin: 40px auto; 
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        .company {
            text-align: right;
            font-size: 13px;
        }

        .meta {
            margin-top: 10px;
            font-size: 13px;
        }

        .meta p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table th {
            border-bottom: 2px solid #000;
            padding: 8px;
            font-size: 13px;
            text-align: left;
        }

        table td {
            padding: 8px;
            font-size: 13px;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }

        .product {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
        }

        .totals {
            margin-top: 15px;
            float: right;
            width: 250px;
        }

        .totals table td {
            border: none;
            padding: 5px;
        }

        .grand {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #000;
        }

        .barcode {
            text-align: center;
            margin-top: 30px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }

        .print-btn {
            text-align: center;
            margin: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background: black;
            color: white;
            cursor: pointer;
        }

        @media print {
            .invoice {
                max-width: 100%; 
                margin: 0;
                padding: 10px;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="invoice">

    <div class="header">
        <div>
            <h1>INVOICE</h1>
            <p>#{{ $order->id }}</p>
        </div>

        <div class="company">
            <b>{{ $orderitem->shop_name }}</b><br>
            {{ $orderitem->address }}<br>
            Phone: {{ $orderitem->mobile_number }}
        </div>
    </div>

    <div class="meta">
        <p><b>Billing By:</b> {{ $orderitem->first_name }} {{ $orderitem->last_name }}</p>
        <p><b>Date:</b> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        <p><b>Payment:</b> {{ $order->payment_method }}</p>
        <p><b>Status:</b> {{ $order->payment_status }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="50%">Product</th>
                <th width="10%">Qty</th>
                <th width="20%">Price</th>
                <th width="20%">Total</th>
            </tr>
        </thead>

        <tbody>
            @php use Illuminate\Support\Facades\Storage; @endphp

            @foreach($order->items as $item)
            <tr>
                <td>
                    <div class="product">
                        @if($item->product && $item->product->photo)
                            <img src="{{ Storage::url($item->product->photo) }}">
                        @endif
                        <div>
                            {{ $item->product->name ?? 'N/A' }}
                        </div>
                    </div>
                </td>

                <td>{{ $item->quantity }}</td>
                <td>৳ {{ number_format($item->price, 2) }}</td>
                <td>৳ {{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td align="right">৳ {{ number_format($order->amount, 2) }}</td>
            </tr>
            <tr class="grand">
                <td>Total:</td>
                <td align="right">৳ {{ number_format($order->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="barcode">
        <img src="data:image/png;base64,{{ $barcodeImage }}" width="300">
        <p>{{ $order->barcode }}</p>
    </div>

    <div class="footer">
        Thank you for your business
    </div>

</div>

<div class="print-btn">
    <button onclick="window.print()">Print</button>
</div>

</body>
</html>