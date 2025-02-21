<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Accessory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-100 to-gray-300 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white shadow-2xl rounded-xl p-8"> 
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 border-b-2 pb-3 text-center">Edit Accessory</h1>
        <form action="{{ route('accessories.update', $accessory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" name="name" value="{{ $accessory->name }}" class="border border-gray-300 p-3 w-full rounded-lg shadow-sm focus:ring-4 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Brand:</label>
                <input type="text" name="brand" value="{{ $accessory->brand }}" class="border border-gray-300 p-3 w-full rounded-lg shadow-sm focus:ring-4 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Price:</label>
                <input type="number" name="price" value="{{ $accessory->price }}" class="border border-gray-300 p-3 w-full rounded-lg shadow-sm focus:ring-4 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Current Picture:</label>
                @if($accessory->picture)
                    <div class="flex justify-center my-4">
                        <img src="{{ asset('storage/' . $accessory->picture) }}" alt="Accessory Image" class="w-40 h-40 object-cover rounded-lg shadow-lg border">
                    </div>
                @endif
                <input type="file" name="picture" class="border border-gray-300 p-3 w-full rounded-lg shadow-sm focus:ring-4 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description:</label>
                <textarea name="description" class="border border-gray-300 p-3 w-full rounded-lg shadow-sm focus:ring-4 focus:ring-indigo-500 focus:outline-none">{{ $accessory->description }}</textarea>
            </div>
            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">Update</button>
                <a href="{{ route('accessories.index') }}" class="text-gray-600 hover:text-gray-900 font-semibold">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>