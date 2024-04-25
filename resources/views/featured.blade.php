<x-app-layout>
<link rel="stylesheet" href="../css/dashboard.css">
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

    <a href="{{ route('dashboard') }}">Dashboard</a>
    <form action="{{ route('Addfeatured') }}" method="POST">
    @csrf
    <ul>
        @foreach($products as $product)
            <li>
                <input type="checkbox" id="product_{{ $product->id }}" name="product_ids[]" value="{{ $product->id }}">
                <label for="product_{{ $product->id }}">{{ $product->name }}</label>
            </li>
        @endforeach
    </ul>
    
    <button type="submit">Feature Selected Products</button>
</form>
    
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                @foreach($featuredProducts as $featuredProduct)
                    <tr>
                        <td>{{ $featuredProduct->id }}</td>
                        <td>{{ $featuredProduct->name }}</td>
                        <td>
                        <form action="{{ route('DeleteFeatured', ['id' => $featuredProduct->id]) }}" method="POST" id='deleteForm'>
                            @csrf
                            @method('DELETE')
                            <button type="button"  onclick="confirmDelete()" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No featured products available.</td>
                </tr>
            @endif
        </tbody>
    </table>
            <script>
            function confirmDelete() {
                if (confirm("Are you sure you want to delete this Featured Product?")) {
                    document.getElementById('deleteForm').submit();
                }
            }
            </script>
</x-app-layout>
