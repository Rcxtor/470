<x-app-layout>  
<link rel="stylesheet" href="../css/product.css">
<link rel="stylesheet" href="../css/welcome.css">

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        @endif

    <div class="box">
    <span class="pr_type" style="width: 150vh;">
    <h1 style="color: rgb(241, 140, 7);">SI Fuad's Choice</h1> 
    </span>
    <div class="grid">
    @foreach($featuredProducts as $featuredProducts)
            <div class="product-box">
                <img src="../image/product.jpg">
                <h3>{{ $featuredProducts->name }}</h3>
                
                <p>Brand: {{ $featuredProducts->brand }}</p>
                <p>Price: {{ $featuredProducts->price }}</p>
                <p>Type: {{ $featuredProducts->type }}</p>
                
                <form action="{{url('AddCart',$featuredProducts->id)}}" method="POST">
                    @csrf
                    <input type="number" value="1" min="1" max="4" class="form-control" style="width:50px" name="quantity">
                    <br>
                    <input class="cart_btn" type="submit" value="Add To Cart">
                </form>
                <h1>{{ session('error') }}</h1>
                <form action="{{url('AddWishlist',$featuredProducts->id)}}" method="POST">
                    @csrf
                    <input class="wishlist_btn" type="submit" value="Add to Wishlist">
                </form>
            </div>
        @endforeach
    </div>
    </div>
</x-app-layout>  