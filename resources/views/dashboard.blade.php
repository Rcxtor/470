<x-app-layout>
<link rel="stylesheet" href="../css/dashboard.css">


<div class="main">
    <div class="side_nav">
        <a href="" class="dashboard-link">Dashboard</a>
        <a href="" class="user-link">User</a>
        <a href="" class="inventory-link">Products</a>
        <a href="" class="notification-link">Notification</a>
    </div> 
    <div class="dash"><h1>DASH</h1></div>

    <div class="user">
        <h1>USER</h1>
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


    <div class="inv"><h1>INVENTORY</h1>
    <button class="btn_add">+ Add inventory</button>
    <span class="search">
    <form action="/search" method="GET">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">&#x1F50E;&#xFE0E;</button>
    </form>
    </span>

    <div class="add-inventory-form" style="display: none;">
    <h2>Add Inventory</h2>
    <button class='cross'>x</button>
    <form action="{{ route('dashboard') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
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
        <button class="submit_btn" type="submit">Add Inventory</button>
    </form>
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
            @foreach($products as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->brand }}</td>
                <td>{{ $user->price }}</td>
                <td>{{ $user->type }}</td>
                <td><button class="btm">View</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="noti"><h1>NOTIFICATION</h1></div>


</div>
<div class="overlay"></div>
<script src="../js/dashboard.js"></script>
</x-app-layout>

