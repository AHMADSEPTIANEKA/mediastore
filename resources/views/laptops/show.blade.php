<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $laptop->name }} - Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-100 to-gray-300 text-gray-900">
    <div class="container mx-auto p-8 max-w-4xl bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <div class="p-6">
            <h2 class="text-4xl font-extrabold text-indigo-600 mb-6 text-center">{{ $laptop->name }}</h2>
            <div class="flex justify-center mb-6">
                <img src="{{ asset('storage/' . $laptop->picture) }}" alt="{{ $laptop->name }}" class="w-full max-h-[400px] object-contain rounded-lg shadow-md border border-gray-200">
            </div>
            <div class="grid grid-cols-2 gap-6 text-lg font-medium text-gray-700 bg-gray-50 p-6 rounded-lg shadow-inner">
                <p><span class="font-bold">Brand:</span> {{ $laptop->brand }}</p>
                <p><span class="font-bold">Price:</span> <span class="text-indigo-600 font-extrabold">Rp {{ number_format($laptop->price, 0, ',', '.') }}</span></p>
                <p><span class="font-bold">Processor:</span> {{ $laptop->processor }}</p>
                <p><span class="font-bold">RAM:</span> {{ $laptop->ram }} GB</p>
                <p><span class="font-bold">Storage:</span> {{ $laptop->storage }} GB</p>
                <p><span class="font-bold">Screen Size:</span> {{ $laptop->screen_size }} inches</p>
                <p><span class="font-bold">Battery:</span> {{ $laptop->battery_life }} hours</p>
            </div>
            <div class="mt-8 flex justify-between">
                <a href="{{ route('laptops.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all transform hover:scale-105">Back to List</a>
                <a href="{{ route('dashboard') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-900 transition-all transform hover:scale-105">Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
