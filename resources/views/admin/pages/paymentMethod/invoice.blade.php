<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice</title>

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

</head>
<body class="full-body">

<div class="invoice-box">

    <!-- Header -->
    <div class="invoice-header">
        <div>
            <h2>INVOICE</h2>
            <p>Date: {{ $order->created_at->format('d M, Y') }}</p>
            <p>Order No: #{{ $order->id }}</p>
        </div>

        <div class="company-details">
            <h3></h3>
            <p>Address: Madanganj, Narayanganj</p>
            <p>Phone: 01705675623</p>
            <p>Email: rayhan8171@gmail.com</p>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="customer-info">
        <h3>Billing Details</h3>

        <p><strong>Name:</strong>
            {{ $order->user->first_name }} {{ $order->user->last_name }}
        </p>

        <p><strong>Phone:</strong> {{ $order->user->phone ?? '' }}</p>
        <p><strong>Email:</strong> {{ $order->user->email ?? '' }}</p>
    </div>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $item->product->name }}</td>

                <td>{{ $item->quantity }}</td>

                <td>{{ number_format($item->price, 2) }}</td>

                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Section -->
    <div class="total-box">
        <table>

            <tr>
                <td>Subtotal:</td>
                <td>৳ {{ number_format($order->amount, 2) }}</td>
            </tr>

            <tr>
                <td>Shipping:</td>
                <td>৳ {{ number_format($order->shipping_fee, 2) }}</td>
            </tr>

            <tr class="grand-total">
                <td>Total:</td>
                <td>৳ {{ number_format($order->grand_total, 2) }}</td>
            </tr>

        </table>
    </div>

    <p style="text-align:center; margin-top:30px; color:#777;">
        Thank you for shopping with us!
    </p>

</div>

</body>
</html>