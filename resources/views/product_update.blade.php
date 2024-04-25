<x-app-layout>
    <div class>
        <form action="{{ route('product_update', ['id' => $product->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Common fields for all product types -->
            <div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" >
                </div>

                <div>
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" value="{{ $product->brand }}" >
                </div>

                <div>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" value="{{ $product->price }}" >
                </div>

                <div>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" >
                </div>

                <div>
                    <label for="warranty">Warranty</label>
                    <input type="text" name="warranty" id="warranty" value="{{ $product->warranty }}" >
                </div>

            </div>
            <!-- Dynamic form section for each product type -->
            @if($processor)
            <div id="processorForm" class="form-section">
                <div>
                    <label for="processorGen">Generation</label>
                    <input type="text" name="gen" id="processorGen" value="{{ $processor->gen}}" >
                </div>
                <div>
                    <label for="processorCore">Core</label>
                    <input type="text" name="core" id="processorCore" value="{{ $processor->core}}" >
                </div>
                <div>
                    <label for="processorSocket">Socket</label>
                    <input type="text" name="socket" id="processorSocket" value="{{ $processor->socket}}" >
                </div>
            </div>
            @endif
            <!-- Motherboard form section -->
            @if($motherboard)
            <div id="motherboardForm" class="form-section">
                <div class="form-group">
                    <label for="motherboardGen">Generation: </label>
                    <input type="text" id="motherboardGen" name="gen" value="{{ $motherboard->gen}}" >
                </div>
                <div class="form-group">
                    <label for="motherboardProcessor">Processor: </label>
                    <input type="text" id="motherboardProcessor" name="processor" value="{{ $motherboard->processor}}">
                </div>
                <div class="form-group">
                    <label for="motherboardSocket">Socket: </label>
                    <input type="text" id="motherboardSocket" name="socket" value="{{ $motherboard->socket}}">
                </div>
                <div class="form-group">
                    <label for="motherboardRamtype">Ramtype: </label>
                    <input type="text" id="motherboardRamtype" name="ramtype" value="{{ $motherboard->ramtype}}">
                </div>
            </div>
            @endif
            <!-- Ram form section -->
            @if($ram)
            <div id="ramForm" class="form-section">
                <div class="form-group">
                    <label for="ramCapacity">Capacity: </label>
                    <input type="text" id="ramCapacity" name="capacity" value="{{ $ram->capacity}}">
                </div>
                <div class="form-group">
                    <label for="ramType">Type: </label>
                    <input type="text" id="ramType" name="ramtype" value="{{ $ram->ramtype}}">
                </div>
                <div class="form-group">
                    <label for="ramSpeed">Speed: </label>
                    <input type="text" id="ramSpeed" name="speed" value="{{ $ram->speed}}">
                </div>
            </div>
            @endif
            <!-- Gpu form section -->
            @if($gpu)
            <div id="gpuForm" class="form-section">
                <div class="form-group">
                    <label for="gpuChipset">Chipset: </label>
                    <input type="text" id="gpuChipset" name="chipset" value="{{ $gpu->chipset}}">
                </div>
                <div class="form-group">
                    <label for="gpuMemory">Memory: </label>
                    <input type="text" id="gpuMemory" name="memory" value="{{ $gpu->memory}}">
                </div>
            </div>
            @endif
            <!-- Case form section -->
            @if($computercase)
            <div id="caseForm" class="form-section">
                <div class="form-group">
                    <label for="caseColor">Case Color: </label>
                    <input type="text" id="caseColor" name="color" value="{{ $computercase->color}}">
                </div>
            </div>
            @endif
            <!--Storage form section -->
            @if($storage)
            <div id="storageForm" class="form-section">
            
                <div class="form-group">
                    <label for="storageInterface">Interface: </label>
                    <input type="text" id="storageInterface" name="interface" value="{{ $storage->interface}}">
                </div>
                <div class="form-group">
                    <label for="storageCapacity">Capacity: </label>
                    <input type="text" id="storageCapacity" name="capacity" value="{{ $storage->capacity}}">
                </div>
            </div>
            @endif
            <!--Monitor form section -->
            @if($monitor)
            <div id="monitorForm" class="form-section">
                <div class="form-group">
                    <label for="monitorSize">Size: </label>
                    <input type="text" id="monitorSize" name="size"value="{{ $monitor->size}}">
                </div>
                <div class="form-group">
                    <label for="monitorPanel">Panel: </label>
                    <input type="text" id="monitorPanel" name="panel" value="{{ $monitor->panel}}">
                </div>
                <div class="form-group">
                    <label for="monitorRate">Rate: </label>
                    <input type="text" id="monitorRate" name="rate" value="{{ $monitor->rate}}">
                </div>
                <div class="form-group">
                    <label for="monitorResolution">Resolution: </label>
                    <input type="text" id="monitorResolution" name="resolution" value="{{ $monitor->resolution}}">
                </div>
            </div>
            @endif
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Function to show the form section based on the selected product type
                    function showFormSection(selectedType) {
                        // Hide all form sections first
                        document.querySelectorAll('.form-section').forEach(function(section) {
                            section.style.display = 'none';
                        });

                        // Show the form section corresponding to the selected product type
                        document.getElementById(selectedType + 'Form').style.display = 'block';
                    }

                    // Show the initial form section based on the product type
                    showFormSection('{{ $product->type }}');
                });
            </script>

            <button type="submit">Update Product</button>
        </form>
        <form id="delete-form" action="{{ route('product_delete', ['id' => $product->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete()">Delete Product</button>
        </form>
    </div>
    <h1>{{ session('success') }}</h1>
    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this product?')) {
                // If user confirms, submit the form
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-app-layout>