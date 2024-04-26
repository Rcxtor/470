<!-- <link rel="stylesheet" href="../css/dashboard.css"> -->
<x-app-layout>
    <a href="{{route('profile.show')}}"><-Profile</a>
<table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Payment Method</th>
                <th>Order Date</th>
                <th>Order Stage</th>

            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->payment }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->stage }}</td>
                <td>
                @if( $order->stage =="processing")
                <form  action="{{ route('orderChange', ['id' => $order->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <input type="hidden" id="stage" name="stage" value="canceled"> 
                </div>
                <button type="submit">Cancel Order</button>
                </form>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>