<x-app-layout>
<link rel="stylesheet" href="../css/product.css">
<div class="main">
<div class="side_bar">
<h2>Filter By Brand</h2>

    <form action="{{ route('products.category', ['category' => $category]) }}" method="GET">
                @foreach($products as $product)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $product->brand }}" id="{{ $product->id }}">
                        <label class="form-check-label" for="{{ $product->id }}">
                            {{ $product->brand }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </form>
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
                <!-- <h3>{{ $product->name }}</h3> -->
                <a href="{{route('productDetails',$product->id)}}">{{ $product->name }}</a>
                <p>Brand: {{ $product->brand }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Type: {{ $product->type }}</p>
                
                <form action="{{url('AddCart',$product->id)}}" method="POST">
                    @csrf
                    <input type="number" value="1" min="1" max="4" class="form-control" style="width:50px" name="quantity">
                    <br>
                    <input class="cart_btn" type="submit" value="Add To Cart">
                </form>
                <h1>{{ session('error') }}</h1>
                <form action="{{url('AddWishlist',$product->id)}}" method="POST">
                    @csrf
                    <input class="wishlist_btn" type="submit" value="Add to Wishlist">
                </form>
                
                
              
            </div>
        @endforeach
    @endif
</div>
</div>
</div>
</x-app-layout>