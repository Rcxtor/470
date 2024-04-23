<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h2>Invoice</h2>
    <p>Hello {{ $invoice->user_name }},</p>
    <p>Your order has been successfully placed. Below is the invoice details:</p>
    
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp
            @foreach($invoice as $invoice)
            <tr>
                <td>{{ $invoice->product_name }}</td>
                <td>{{ $invoice->quantity }}</td>
                <td>{{ $invoice->price }}</td>
                <td>{{ $invoice->quantity * $invoice->price }}</td>
            </tr>
            @php
                $subtotal += $invoice->quantity * $invoice->price;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Subtotal</strong></td>
                <td>{{ $subtotal }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
