<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Accessory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container max-w-lg mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Add Accessory</h1>
        <form action="{{ route('accessories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Name Input -->
            <label class="block font-semibold mb-1">Name:</label>
            <input type="text" name="name" class="border p-2 w-full mb-2 rounded-md" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <!-- Brand Input -->
            <label class="block font-semibold mb-1">Brand:</label>
            <input type="text" name="brand" class="border p-2 w-full mb-2 rounded-md" value="{{ old('brand') }}">
            @error('brand')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <!-- Price Input -->
            <label class="block font-semibold mb-1">Price:</label>
            <input type="number" name="price" class="border p-2 w-full mb-2 rounded-md" value="{{ old('price') }}">
            @error('price')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <!-- Picture Upload -->
            <label class="block font-semibold mb-1">Picture:</label>
            <input type="file" name="picture" class="border p-2 w-full mb-2 rounded-md">
            @error('picture')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <!-- Description Input -->
            <label class="block font-semibold mb-1">Description:</label>
            <textarea name="description" class="border p-2 w-full mb-2 rounded-md">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            <!-- Submit Button -->
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md w-full hover:bg-indigo-700">
                Save
            </button>
        </form>
    </div>
</body>
</html>
