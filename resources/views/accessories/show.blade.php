<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aksesori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10 p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $accessory->name }}</h1>
        @if ($accessory->picture)
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $accessory->picture) }}" alt="Accessory Image"
                    class="w-64 h-64 object-cover rounded-lg shadow-md">
            </div>
        @endif
        <div class="text-gray-700 space-y-2">
            <p><strong class="text-gray-900">Brand:</strong> {{ $accessory->brand }}</p>
            <p><strong class="text-gray-900">Price:</strong> <span class="text-green-600 font-semibold">Rp
                    {{ number_format($accessory->price, 0, ',', '.') }}</span></p>
            <p><strong class="text-gray-900">Description:</strong> {{ $accessory->description }}</p>
        </div>
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('accessories.edit', $accessory->id) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">Edit</a>
            <a href="{{ route('accessories.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg shadow">Back to List</a>
        </div>
    </div>
</body>

</html>
