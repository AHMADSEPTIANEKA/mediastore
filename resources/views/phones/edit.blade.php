<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">✏️ Edit Phone</h2>
        
        <form action="{{ route('phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Phone Picture -->
            <div class="flex flex-col items-center mb-4">
                <label class="block text-gray-700 text-lg font-semibold">Picture:</label>
                <div class="relative group mb-4">
                    <img id="previewImage" src="{{ asset('storage/' . $phone->picture) }}" class="w-40 h-40 object-cover rounded-lg shadow-md transition-transform group-hover:scale-110" alt="Phone Image">
                </div>
                <input type="file" name="picture" id="pictureInput" class="mt-2 border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Phone Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">Name:</label>
                    <input type="text" name="name" value="{{ $phone->name }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Brand:</label>
                    <input type="text" name="brand" value="{{ $phone->brand }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Type:</label>
                    <select name="type" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                        <option value="Android" {{ $phone->type == 'Android' ? 'selected' : '' }}>Android</option>
                        <option value="iPhone" {{ $phone->type == 'iPhone' ? 'selected' : '' }}>iPhone</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Price (Rp):</label>
                    <input type="number" name="price" value="{{ $phone->price }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Main Camera:</label>
                    <input type="text" name="camera_main" value="{{ $phone->camera_main }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Ultra-Wide Camera:</label>
                    <input type="text" name="camera_ultra" value="{{ $phone->camera_ultra }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Front Camera:</label>
                    <input type="text" name="camera_front" value="{{ $phone->camera_front }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Screen Size (inch):</label>
                    <input type="number" name="screen_size" value="{{ $phone->screen_size }}" step="0.01" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Screen Resolution:</label>
                    <input type="text" name="screen_resolution" value="{{ $phone->screen_resolution }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Refresh Rate (Hz):</label>
                    <input type="number" name="refresh_rate" value="{{ $phone->refresh_rate }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Processor:</label>
                    <input type="text" name="processor" value="{{ $phone->processor }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Battery Capacity (mAh):</label>
                    <input type="number" name="battery_capacity" value="{{ $phone->battery_capacity }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Charging Speed (W):</label>
                    <input type="number" name="charging_speed" value="{{ $phone->charging_speed }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">IP Rating:</label>
                    <input type="text" name="ip_rating" value="{{ $phone->ip_rating }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between mt-8">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg shadow-md hover:bg-green-700 transition duration-200 flex items-center gap-2">
                    ✅ Update
                </button>
                <a href="{{ route('phones.index') }}" class="bg-red-500 text-white px-8 py-3 rounded-lg shadow-md hover:bg-red-600 transition duration-200 flex items-center gap-2">
                    ❌ Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // Preview gambar sebelum upload
        document.getElementById('pictureInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
