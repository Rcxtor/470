@if(session('error'))
    <div class="error-message">
        {{ session('error') }}
    </div>
@endif
<x-app-layout>
<link rel="stylesheet" href="../css/dashboard.css">


<div class="main">
    <div class="side_nav">
        <a href="{{ route('dashboard') }}" class="dashboard-link">Dashboard</a>
        <a href="{{ route('dashboard') }}" class="user-link">User</a>
        <a href="{{ route('dashboard') }}" class="inventory-link">Products</a>
        <a href="{{ route('dashboard') }}" class="notification-link">Notification</a>
    </div> 
    <div class="dash" @if($searched_user==='yes' || $searched==='yes') style="display: None;" @else style="display: block;"@endif><h1>DASH</h1></div>


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
                <td><button class="btm">View</button></td>
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
                <td>{{ $product->type }}</td>
                <td><button class="btm">View</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="add-inventory-form" style="display: none;">
    <h2>Add Inventory</h2>
    <button class='cross'>x</button>
    
    <form class="cont" action="{{ route('Add Product') }}" method="POST">
        @csrf
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
        <div class="form-section" id="processorForm" style="display: block;">
                    <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="brand">Brand: </label>
                    <input type="text" id="brand" name="brand" required>
                </div>
                <div class="form-group">
                    <label for="price">Resolution: </label>
                    <input type="number" id="price" name="price" required>
                </div>
        </div>
        <div class="form-section" id="motherboardForm" style="display: none;">
            <!-- Inputs specific to motherboard -->
        </div>
        <button class="submit_btn" type="submit">Add Inventory</button>
    </form>
    </div>
    </div>

    <div class="noti"><h1>NOTIFICATION</h1></div>


</div>
<div class="overlay"></div>
<script src="../js/dashboard.js"></script>
</x-app-layout>
