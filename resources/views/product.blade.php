<x-app-layout>
<link rel="stylesheet" href="../css/product.css">
<div class="main">
<div class="side_bar">

</div>
<div class="container">
<span class="pr_type">
    <h1>{{$category}}</h1>
</span>
<div class="products-grid">
    @if($products->isEmpty())
                <h2>No items available.</h2>
    @else
        @foreach($products as $product)
            <div class="product-box">
                <img src="../image/product.jpg">
                <h3>{{ $product->name }}</h3>
                <p>Brand: {{ $product->brand }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Type: {{ $product->type }}</p>
                <button>Add To Cart</button><!-- route system ta use kore controller diye add kore dis  -->
                <button>Add To Wishlist</button> 

            </div>
        @endforeach
    @endif
</div>
</div>
</div>
</x-app-layout>