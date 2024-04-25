<x-app-layout>
    <a href="{{route('dashboard')}}">Go Back</a>
    <div>
        <h2>User Information</h2>
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
        <!-- Role change -->
        <form action="{{ route('user_view', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="role"><strong>Change Role: </strong></label>
                    <select name="role" id="role">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <button type="submit">Update User</button>
                <p>{{session('change')}}</p>
        </form>
    </div>

    <div>
    <h2>Order History</h2>
        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <ul>
                @foreach($orders as $order)
                    <li>{{ $order->id }} - {{ $order->product_name }} - {{ $order->quantity }} - {{ $order->payment }} - {{ $order->created_at->format('Y-m-d') }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    
    <!-- User Delete -->
    <form id="delete-form" action="{{ route('user_delete', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete()">Remove User</button>
        </form>
    </div>
    <h1>{{ session('success') }}</h1>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to remove this user?')) {
                // If user confirms, submit the form
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>
