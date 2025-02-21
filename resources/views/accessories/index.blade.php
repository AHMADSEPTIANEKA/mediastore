<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #38a169;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        .fade-out {
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 h-screen flex flex-col">
    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div id="notification" class="notification">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('notification').classList.add('fade-out');
        }, 3000);
    </script>
    @endif
    <div class="container mx-auto p-6 flex-grow overflow-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">🛍 Accessories List</h2>
            <div class="flex items-center space-x-4">
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('accessories.index') }}" class="relative w-72">
                    <input type="text" name="search" placeholder="Cari aksesori..." value="{{ request('search') }}" 
                        class="w-full bg-white border border-gray-300 rounded-full pl-10 pr-4 py-2 text-sm shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                </form>
                <a href="{{ route('accessories.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600">Add Accessory</a>
                <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600">Dashboard</a>
            </div>
        </div>
        <div class="overflow-x-auto bg-white shadow-xl rounded-lg flex-grow">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="p-4 text-sm font-semibold">Picture</th>
                        <th class="p-4 text-sm font-semibold">Name</th>
                        <th class="p-4 text-sm font-semibold">Brand</th>
                        <th class="p-4 text-sm font-semibold">Price</th>
                        <th class="p-4 text-center text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessories as $accessory)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="p-4">
                            @if($accessory->picture)
                                <img src="{{ asset('storage/' . $accessory->picture) }}" class="w-12 h-12 object-cover rounded-full shadow-md" alt="{{ $accessory->name }}">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm">{{ $accessory->name }}</td>
                        <td class="p-4 text-sm">{{ $accessory->brand }}</td>
                        <td class="p-4 font-semibold text-green-600">Rp {{ number_format($accessory->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-center space-x-2">
                            <a href="{{ route('accessories.edit', $accessory->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600">✏️ Edit</a>
                            <a href="{{ route('accessories.show', $accessory->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600">🔍 View</a>
                            <form action="{{ route('accessories.destroy', $accessory->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $accessories->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</body>
</html>
