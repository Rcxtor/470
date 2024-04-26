<x-app-layout>
<link rel="stylesheet" href="../css/productDetails.css">
<div class="back_bar">
    <a href="{{route('products.category',$product->type)}}"><-{{ucfirst($product->type)}}</a>
</div>

    <div class="container">
    <div class="img-box"><img src="../image/meme.jpg"></div>
    <div style="flex-direction: row; margin:50px 10px 100px 10px;">
    <div class="common">
        <h2>{{$product->name}}</h2>
        <!-- <img src="../image/product.jpg"> -->
        <div style="display:flex; flex-direction: row; gap:30px;">
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Product ID:</strong> {{ $product->id }}</p>
        <p><strong>Brand:</strong> {{ $product->brand }}</p>
        @if($product->quantity > 0)
            <p><strong>Stock: </strong>Available</p>
        @else
            <p><strong>Stock: </strong>Stock Out</p>
        @endif
        <p><strong>Warranty:</strong> {{ $product->warranty }}</p>
    </div>
    </div>
    <div class="extra">
        <!-- Dynamic form section for each product type -->

        <!-- Processor form section -->
        @if($processor)           
        <p><strong>Generation:</strong> {{ $processor->gen}}</p>
        <p><strong>Core:</strong> {{ $processor->core}}</p>
        <p><strong>Socket:</strong> {{ $processor->socket}}</p>
        @endif

        <!-- Motherboard form section -->
        @if($motherboard)
        <p><strong>Generation:</strong> {{ $motherboard->gen}}</p>
        <p><strong>Processor:</strong> {{ $motherboard->processor}}</p>
        <p><strong>Socket:</strong> {{ $motherboard->socket}}</p>
        <p><strong>Ram Type:</strong> {{ $motherboard->ramtype}}</p>
        @endif

        <!-- Ram form section -->
        @if($ram)
        <p><strong>Capacity:</strong> {{ $ram->capacity}}</p>
        <p><strong>Ram Type:</strong> {{ $ram->ramtype}}</p>
        <p><strong>Ram Speed:</strong> {{ $ram->speed}}</p>
        @endif

        <!-- Gpu form section -->
        @if($gpu)
        <p><strong>Chipset:</strong> {{ $gpu->chipset}}</p>
        <p><strong>Memory:</strong> {{ $gpu->memory}}</p>
        @endif

        <!-- Case form section -->
        @if($computercase)        
        <p><strong>Case Color:</strong> {{ $computercase->color}}</p>        
        @endif

        <!--Storage form section -->
        @if($storage)
        <p><strong>Interface:</strong> {{ $storage->interface}}</p>
        <p><strong>Capacity:</strong> {{ $storage->capacity}}</p>
        @endif

        <!--Monitor form section -->
        @if($monitor)
        <p><strong>Size:</strong> {{ $monitor->size}}</p>
        <p><strong>Screen Panel:</strong> {{ $monitor->panel}}</p>
        <p><strong>Rate:</strong> {{ $monitor->rate}}</p>
        <p><strong>Resolution:</strong> {{ $monitor->resolution}}</p>
        @endif
    </div>
    <h4>Price: {{$product-> price}}</h4>
    <div class="buttons">
    <form action="{{url('AddCart',$product->id)}}" method="POST" style="display:flex; gap:5px;">
        @csrf
        <input type="number" value="1" min="1" max="4" class="form-control" style="width:100px; height:40px; margin-top:10px; border-radius: 10px; border:2px solid silver;" name="quantity">
        <br>
        @if($product->quantity > 0)
        <button class="button-9" type="submit" >Add To Cart</button>
        @else
        <button class="button-9" disabled>Out Of Stock</button>
        @endif
    </form>
    <form action="{{url('AddWishlist',$product->id)}}" method="POST">
        @csrf
        <button class="button-10" type="submit">Add to Wishlist</button>
    </form>
    </div>
    <h1 style="color:red;">{{ session('error') }}</h1>
    </div>

    </div>
</x-app-layout>