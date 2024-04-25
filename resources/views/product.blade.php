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
                <!-- Processor -->
                @if($category =='Processor')
                <strong>Filter By Generation</strong>
                @foreach($processors as $processor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Pgens[]" value="{{ $processor->gen }}" id="{{ $processor->processor_product_id }}">
                        <label class="form-check-label" for="{{ $processor->processor_product_id }}">
                            {{ $processor->gen }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Socket</strong>
                @foreach($processors as $processor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Psocket[]" value="{{ $processor->socket }}" id="{{ $processor->processor_product_id }}">
                        <label class="form-check-label" for="{{ $processor->processor_product_id }}">
                            {{ $processor->socket }}
                        </label>
                    </div>
                @endforeach
                @endif
                <!-- Motherboard -->
                @if($category =='Motherboard')
                <strong>Filter By Generation</strong>
                @foreach($motherboards as $motherboard)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Mgens[]" value="{{ $motherboard->gen }}" id="{{ $motherboard->motherboard_product_id }}">
                        <label class="form-check-label" for="{{ $motherboard->motherboard_product_id }}">
                            {{ $motherboard->gen }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Socket</strong>
                @foreach($motherboards as $motherboard)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Msocket[]" value="{{ $motherboard->socket }}" id="{{ $motherboard->motherboard_product_id }}">
                        <label class="form-check-label" for="{{ $motherboard->motherboard_product_id }}">
                            {{ $motherboard->socket }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Ram Type</strong>
                @foreach($motherboards as $motherboard)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Mram[]" value="{{ $motherboard->ramtype }}" id="{{ $motherboard->motherboard_product_id }}">
                        <label class="form-check-label" for="{{ $motherboard->motherboard_product_id }}">
                            {{ $motherboard->ramtype }}
                        </label>
                    </div>
                @endforeach
                @endif
                <!-- Ram -->
                @if($category =='Ram')
                <strong>Filter By Ram Type</strong>
                @foreach($rams as $ram)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Rram[]" value="{{ $ram->ramtype }}" id="{{ $ram->ram_product_id }}">
                        <label class="form-check-label" for="{{ $ram->ram_product_id }}">
                            {{ $ram->ramtype }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Capacity</strong>
                @foreach($rams as $ram)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Rcap[]" value="{{ $ram->capacity }}" id="{{ $ram->ram_product_id }}">
                        <label class="form-check-label" for="{{ $ram->ram_product_id }}">
                            {{ $ram->capacity }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Speed</strong>
                @foreach($rams as $ram)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Rspeed[]" value="{{ $ram->speed }}" id="{{ $ram->ram_product_id }}">
                        <label class="form-check-label" for="{{ $ram->ram_product_id }}">
                            {{ $ram->speed }}
                        </label>
                    </div>
                @endforeach
                @endif
                <!-- Monitor -->
                @if($category =='Monitor')
                <strong>Filter By Size</strong>
                @foreach($monitors as $monitor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Monsize[]" value="{{ $monitor->size }}" id="{{ $monitor->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $monitor->monitor_product_id }}">
                            {{ $monitor->size }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Panel</strong>
                @foreach($monitors as $monitor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Monpal[]" value="{{ $monitor->panel }}" id="{{ $monitor->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $monitor->monitor_product_id }}">
                            {{ $monitor->panel }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Rate</strong>
                @foreach($monitors as $monitor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Monrate[]" value="{{ $monitor->rate }}" id="{{ $monitor->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $monitor->monitor_product_id }}">
                            {{ $monitor->rate }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Resolution</strong>
                @foreach($monitors as $monitor)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Monres[]" value="{{ $monitor->resolution }}" id="{{ $monitor->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $monitor->monitor_product_id }}">
                            {{ $monitor->resolution }}
                        </label>
                    </div>
                @endforeach
                @endif



                <!-- Graphics card NEEDS TO WORK -->
                @if($category =='Gpu')
                <strong>Filter By Chipset</strong>
                @foreach($gpus as $gpu)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Gchip[]" value="{{ $gpu->chipset }}" id="{{ $gpu->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $gpu->gpu_product_id }}">
                            {{ $gpu->chipset }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Memory</strong>
                @foreach($gpus as $gpu)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="Gmem[]" value="{{ $gpu->memory }}" id="{{ $gpu->monitor_product_id }}">
                        <label class="form-check-label" for="{{ $gpu->gpu_product_id }}">
                            {{ $gpu->memory }}
                        </label>
                    </div>
                @endforeach
                @endif
                <!-- Storage -->
                @if($category =='Storage')
                <strong>Filter By Interface</strong>
                @foreach($storages as $storage)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="STint[]" value="{{ $storage->interface }}" id="{{ $storage->storage_product_id }}">
                        <label class="form-check-label" for="{{ $storage->storage_product_id }}">
                            {{ $storage->interface }}
                        </label>
                    </div>
                @endforeach
                <strong>Filter By Capacity</strong>
                @foreach($storages as $storage)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="STcap[]" value="{{ $storage->capacity }}" id="{{ $storage->storage_product_id }}">
                        <label class="form-check-label" for="{{ $storage->storage_product_id }}">
                            {{ $storage->capacity }}
                        </label>
                    </div>
                @endforeach
                @endif
                <!-- Case -->
                @if($category =='Case')
                <strong>Filter By Color</strong>
                @foreach($cases as $case)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="{{ $case->color }}" id="{{ $case->case_product_id }}">
                        <label class="form-check-label" for="{{ $case->case_product_id }}">
                            {{ $case->color }}
                        </label>
                    </div>
                @endforeach
                @endif

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