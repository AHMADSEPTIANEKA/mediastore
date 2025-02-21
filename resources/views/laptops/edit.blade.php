<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laptop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-4">✏️ Edit Laptop</h2>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir Edit Laptop -->
        <form action="{{ route('laptops.update', $laptop->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Laptop -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold">Name Laptop</label>
                <input type="text" name="name" id="name" value="{{ old('name', $laptop->name) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Merek Laptop -->
            <div class="mb-4">
                <label for="brand" class="block text-lg font-semibold">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand', $laptop->brand) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Type:</label>
                    <select name="type" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                        <option value="Gaming" {{ $laptop->type == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                        <option value="Ultrabook" {{ $laptop->type == 'Ultrabook' ? 'selected' : '' }}>Ultrabook</option>
                        <option value="workstation"  {{ $laptop->type == 'workstation' ? 'selected' : '' }}>Workstation</option>
                    </select>
                </div>

            <!-- Spesifikasi Laptop -->
            <div class="mb-4">
                <label for="processor" class="block text-lg font-semibold">Processor</label>
                <input type="text" name="processor" id="processor" value="{{ old('processor', $laptop->processor) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="ram" class="block text-lg font-semibold">RAM (GB)</label>
                <input type="number" name="ram" id="ram" value="{{ old('ram', $laptop->ram) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="storage" class="block text-lg font-semibold">Storage (GB)</label>
                <input type="number" name="storage" id="storage" value="{{ old('storage', $laptop->storage) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="screen_size" class="block text-lg font-semibold">Screen Size (inches)</label>
                <input type="text" name="screen_size" id="screen_size" value="{{ old('screen_size', $laptop->screen_size) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="battery_life" class="block text-lg font-semibold">Battery Life (hours)</label>
                <input type="text" name="battery_life" id="battery_life" value="{{ old('battery_life', $laptop->battery_life) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Harga Laptop -->
            <div class="mb-4">
                <label for="price" class="block text-lg font-semibold">Price (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $laptop->price) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Gambar Laptop -->
            <div class="mb-4">
                <label for="picture" class="block text-lg font-semibold">Picture</label>
                <input type="file" name="picture" id="picture" class="w-full p-3 border border-gray-300 rounded-md">
                <p class="text-sm text-gray-500">Current Image: <img src="{{ asset('storage/' . $laptop->picture) }}" alt="{{ $laptop->name }}" class="w-32 h-32 object-cover mt-2"></p>
            </div>

            <!-- Tombol Submit -->
            <div class="mb-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700">Update Laptop</button>
                <a href="{{ route('laptops.index') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-800">⬅️ Back</a>
            </div>
        </form>
    </div>
</body>
</html> 