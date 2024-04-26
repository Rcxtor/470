<!DOCTYPE html>
<html>
@php
$test = $invoice;
@endphp

<head>
    <title>Invoice</title>
</head>
<body>
    <h2>Invoice</h2>
    <p>Hello Customer,</p>
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
        @foreach($test as $test)
            <tr>
                <td>{{ $test->product_name }}</td>
                <td>{{ $test->quantity }}</td>
                <td>{{ $test->price }}</td>
                <td>{{ $test->quantity * $test->price }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
              
                
            </tr>
        </tfoot>
    </table>
</body>
</html>
