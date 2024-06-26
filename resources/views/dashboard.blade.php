<x-app-layout>
<link rel="stylesheet" href="../css/dashboard.css">


<div class="main">
    <div class="side_nav">
        <a href="{{ route('dashboard') }}" class="dashboard-link">Dashboard</a>
        <a href="{{ route('dashboard') }}" class="user-link">User</a>
        <a href="{{ route('dashboard') }}" class="inventory-link">Products</a>
        <a href="{{ route('dashboard') }}" class="notification-link">Orders</a>
    </div> 
    <div class="dash" @if($searched_user==='yes' || $searched==='yes') style="display: None;" @else style="display: block;"@endif><h1>DASH</h1>
    @if(session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @elseif(session('error'))
    <script>
            window.onload = function() {
                alert("{{ session('error') }}");
            }
        </script>
    @endif

        <form action="{{route('Addcoupon')}}" method="POST">
        @csrf
            <input type="text" id="code" name="code" placeholder="Coupon Code." required>
            <input type="number" style="width: 200px;" min="1" max="2" id="coupontype" name="coupontype" placeholder="Coupon Type" required>
            <input type="number" id="value" name="value" placeholder="Coupon Value" >
            <input type="number"  id="percent_off" name="percent_off" placeholder="Coupon Percentage" >
            <button class="user_btn" type="submit">Add Coupon</button>
        </form>
        <a href="{{route('featuredProduct')}}">Add Feature Product</a>
        <table>
    <thead>
        <tr>
            <th>Coupon Code</th>
            <th>Coupon Type</th>
            <th>Coupon Value</th>
            <th>Coupon Percentage</th>
            <th>Coupon Created</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->code }}</td>
            <td>{{ $coupon->type }}</td>
            <td>{{ $coupon->value }}</td>
            <td>{{ $coupon->percent_off }}</td>
            <td>{{ $coupon->created_at }}</td>
            <td>
            <form action="{{ route('Deletecoupon', ['id' => $coupon->id]) }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete()" class="btm" style="background-color:rgb(255, 60, 20);">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this coupon?")) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>

    </div>
    <div class="user" @if($searched_user==='yes') style="display: block;" @endif>
        <h1>USER</h1>
        <div class="search_box">
        <form action="{{ route('search_user') }}" method="GET">
            <input type="text" name="query" placeholder="Search...">
            <button class="user_btn" type="submit">&#x1F50E;&#xFE0E;</button>
        </form>
        </div>
        <a href="{{ route('dashboard') }}">
            <button class="reset_user" @if($searched_user==='yes') style="display: block;" @endif> Reset </button>
        </a>
        
        <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Registration Date</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at }}</td>
                <td><a href="{{ route('user_view',['id' => $user->id]) }}"><button class="btm">View</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="inv" @if($searched==='yes') style="display: block;" @endif><h1>INVENTORY</h1>
    <div class="for_inv">
    <button class="btn_add">+ Add inventory</button>
    <a href="{{ route('dashboard') }}">
        <button class="reset_search" @if($searched==='yes') style="display: block;" @endif> Reset </button>
    </a>
    
    <span class="search">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search...">
        <button class="search_btn" type="submit">&#x1F50E;&#xFE0E;</button>
    </form>
    </span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Type</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->type }}</td>
                <td><a href="{{ route('product_update',['id' => $product->id]) }}"><button class="btm">View</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="add-inventory-form" style="display: none;">
    <h2>Add Inventory</h2>
    <button class='cross'>x</button>
    
    <form class=cont id="productForm" action="{{ route('Add Product') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="type">Type: </label>
        <select id="type" name="type" required>
            <option value="processor">Processor</option>
            <option value="motherboard">Motherboard</option>
            <option value="ram">Ram</option>
            <option value="gpu">Graphics Card</option>
            <option value="case">Case</option>
            <option value="storage">Storage</option>
            <option value="monitor">Monitor</option>
            <option value="accessories">Accessories</option>
        </select>
    </div>

    <!-- Processor form section -->
    <div id="processorForm" class="form-section" style="display: block;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="processor"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="processorGen">Generation: </label>
            <input type="text" id="processorGen" name="gen">
        </div>
        <div class="form-group">
            <label for="processorCore">Core: </label>
            <input type="text" id="processorCore" name="core">
        </div>
        <div class="form-group">
            <label for="processorSocket">Socket: </label>
            <input type="text" id="processorSocket" name="socket">
        </div>
        <button class="submit_btn" type="submit">Add Processor</button>
    </form>
</div>

<div id="motherboardForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="motherboard"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="motherboardGen">Generation: </label>
            <input type="text" id="motherboardGen" name="gen">
        </div>
        <div class="form-group">
            <label for="motherboardProcessor">Processor: </label>
            <input type="text" id="motherboardProcessor" name="processor">
        </div>
        <div class="form-group">
            <label for="motherboardSocket">Socket: </label>
            <input type="text" id="motherboardSocket" name="socket">
        </div>
        <div class="form-group">
            <label for="motherboardRamtype">Ramtype: </label>
            <input type="text" id="motherboardRamtype" name="ramtype">
        </div>
        <button class="submit_btn" type="submit">Add Motherboard</button>
    </form>
</div>


<div id="ramForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="ram"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="ramCapacity">Capacity: </label>
            <input type="text" id="ramCapacity" name="capacity">
        </div>
        <div class="form-group">
            <label for="ramType">Type: </label>
            <input type="text" id="ramType" name="ramtype">
        </div>
        <div class="form-group">
            <label for="ramSpeed">Speed: </label>
            <input type="text" id="ramSpeed" name="speed">
        </div>
        <button class="submit_btn" type="submit">Add Ram</button>
    </form>
</div>


<div id="gpuForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="gpu"> <!-- -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="gpuChipset">Chipset: </label>
            <input type="text" id="gpuChipset" name="chipset">
        </div>
        <div class="form-group">
            <label for="gpuMemory">Memory: </label>
            <input type="text" id="gpuMemory" name="memory">
        </div>
        <button class="submit_btn" type="submit">Add Graphics Card</button>
    </form>
</div>


<div id="caseForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="case"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="caseColor">Case Color: </label>
            <input type="text" id="caseColor" name="color">
        </div>
        <button class="submit_btn" type="submit">Add Case</button>
    </form>
</div>


<div id="storageForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="storage"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="storageInterface">Interface: </label>
            <input type="text" id="storageInterface" name="interface">
        </div>
        <div class="form-group">
            <label for="storageCapacity">Capacity: </label>
            <input type="text" id="storageCapacity" name="capacity">
        </div>
        <button class="submit_btn" type="submit">Add Storage</button>
    </form>
</div>


<div id="monitorForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="monitor"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <div class="form-group">
            <label for="monitorSize">Size: </label>
            <input type="text" id="monitorSize" name="size">
        </div>
        <div class="form-group">
            <label for="monitorPanel">Panel: </label>
            <input type="text" id="monitorPanel" name="panel">
        </div>
        <div class="form-group">
            <label for="monitorRate">Rate: </label>
            <input type="text" id="monitorRate" name="rate">
        </div>
        <div class="form-group">
            <label for="monitorResolution">Resolution: </label>
            <input type="text" id="monitorResolution" name="resolution">
        </div>
        <button class="submit_btn" type="submit">Add Monitor</button>
    </form>
</div>

<div id="accessoriesForm" class="form-section" style="display: none;">
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="accessories"> 
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand: </label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price: </label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity: </label>
            <input type="text" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="warranty">Warranty: </label>
            <input type="text" id="warranty" name="warranty">
        </div>

        <button class="submit_btn" type="submit">Add Accessories</button>
    </form>
</div>
</form>
    </div>
    </div>

    <div class="noti"><h1>ORDER</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Registration Date</th>
                <th>Order Stage</th>

            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->user_email }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->payment }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                <form  action="{{ route('orderChange', ['id' => $order->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <select name="stage" id="stage">
                        <option value="processing" {{ $order->stage === 'processing' ? 'selected' : '' }}>processing</option>
                        <option value="confirm" {{ $order->stage === 'confirm' ? 'selected' : '' }}>confirm</option>
                        <option value="canceled" {{ $order->stage === 'canceled' ? 'selected' : '' }}>canceled</option>
                    </select>
                </div>
                <button type="submit">Update Order</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

<div class="overlay"></div>
<script src="../js/dashboard.js"></script>
</x-app-layout>

