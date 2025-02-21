<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-4">➕ Add Phone</h2>

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

        <!-- Formulir Tambah Ponsel -->
        <form action="{{ route('phones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Ponsel -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold">Name Phone</label>
                <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Merek Ponsel -->
            <div class="mb-4">
                <label for="brand" class="block text-lg font-semibold">Brand</label>
                <input type="text" name="brand" id="brand" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Jenis Handphone -->
            <div class="mb-4">
                <label class="block text-lg font-semibold">Type</label>
                <select name="type" id="type" class="w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Select Phone Type</option>
                    <option value="Android">Android</option>
                    <option value="iPhone">iPhone</option>
                </select>
            </div>

            <!-- Spesifikasi Ponsel -->
            <div class="mb-4">
                <label for="camera_main" class="block text-lg font-semibold">Camera Main</label>
                <input type="text" name="camera_main" id="camera_main" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="camera_ultra" class="block text-lg font-semibold">Camera Ultra Wide</label>
                <input type="text" name="camera_ultra" id="camera_ultra" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="camera_front" class="block text-lg font-semibold">Camera Front</label>
                <input type="text" name="camera_front" id="camera_front" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="screen_size" class="block text-lg font-semibold">Screen Size (inches)</label>
                <input type="number" name="screen_size" id="screen_size" class="w-full p-3 border border-gray-300 rounded-md" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="screen_resolution" class="block text-lg font-semibold">Screen Resolution</label>
                <input type="text" name="screen_resolution" id="screen_resolution" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="refresh_rate" class="block text-lg font-semibold">Refresh Rate (Hz)</label>
                <input type="number" name="refresh_rate" id="refresh_rate" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="processor" class="block text-lg font-semibold">Processor</label>
                <input type="text" name="processor" id="processor" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="battery_capacity" class="block text-lg font-semibold">Battery Capacity (mAh)</label>
                <input type="number" name="battery_capacity" id="battery_capacity" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="charging_speed" class="block text-lg font-semibold">Fast Charging (W)</label>
                <input type="number" name="charging_speed" id="charging_speed" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="ip_rating" class="block text-lg font-semibold">IP Rating</label>
                <input type="text" name="ip_rating" id="ip_rating" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Harga Ponsel -->
            <div class="mb-4">
                <label for="price" class="block text-lg font-semibold">Price (Rp)</label>
                <input type="number" name="price" id="price" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <!-- Gambar Ponsel -->
            <div class="mb-4">
                <label for="picture" class="block text-lg font-semibold">Picture</label>
                <input type="file" name="picture" id="picture" class="w-full p-3 border border-gray-300 rounded-md">
            </div>

            <!-- Tombol Submit -->
            <div class="mb-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700">Add Phone</button>
                <a href="{{ route('phones.index') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-800">⬅️ Back</a>
            </div>
        </form>
    </div>
</body>
</html>
