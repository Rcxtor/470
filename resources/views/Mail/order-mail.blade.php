<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalprice = 0; ?>
        @foreach($invoice as $invoiceItem)
        <tr>
            <?php $t_price = 0; ?>
            <td>{{$invoiceItem->product_name}}</td>
            <td>{{$invoiceItem->quantity}}</td>
            <?php $t_price = $t_price + (($invoiceItem->price) * ($invoiceItem->quantity)) ?>
            <td>{{$t_price}}</td>
        </tr>
        <?php $totalprice = $totalprice + (($invoiceItem->price) * ($invoiceItem->quantity)) ?>
        @endforeach
    </tbody>
</table>
