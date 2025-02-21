<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hidden-specs {
            display: none;
        }
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
    
    <!-- Notifikasi -->
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
    
    <!-- Container utama -->
    <div class="container mx-auto p-6 flex-grow overflow-auto">
        <!-- Header dan form pencarian -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">📱 Phone List</h2>
            <div class="flex items-center space-x-4">
                <form method="GET" action="{{ route('phones.index') }}" class="relative w-72">
                    <input type="text" name="search" placeholder="Cari handphone..." value="{{ request('search') }}" 
                        class="w-full bg-white border border-gray-300 rounded-full pl-10 pr-4 py-2 text-sm shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                </form>
                <!-- Tombol tambah ponsel -->
                <a href="{{ route('phones.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600">Add Phone</a>
                <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-600">Dashboard</a>
            </div>
        </div>

        <!-- Tabel daftar ponsel -->
        <div class="overflow-x-auto bg-white shadow-xl rounded-lg flex-grow">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="p-4 text-sm font-semibold">Picture</th>
                        <th class="p-4 text-sm font-semibold">Name</th>
                        <th class="p-4 text-sm font-semibold">Brand</th>
                        <th class="p-4 text-sm font-semibold">Type</th>
                        <th class="p-4 text-sm font-semibold">Specifications</th>
                        <th class="p-4 text-sm font-semibold">Price</th>
                        <th class="p-4 text-center text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($phones as $phone)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <!-- Gambar ponsel -->
                        <td class="p-4">
                            @if($phone->picture)
                                <img src="{{ asset('storage/' . $phone->picture) }}" class="w-12 h-12 object-cover rounded-full shadow-md" alt="{{ $phone->name }}">
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <!-- Nama ponsel -->
                        <td class="p-4 text-sm">{{ $phone->name }}</td>
                        <td class="p-4 text-sm">{{ $phone->brand }}</td>
                        <td class="p-4 text-sm">{{ $phone->type }}</td>
                        <!-- Spesifikasi ponsel -->
                        <td class="p-4 text-sm">
                            <ul class="space-y-1 text-sm">
                                <li><strong>Main Camera:</strong> {{ $phone->camera_main }}</li>
                                <li><strong>Screen Size:</strong> {{ $phone->screen_size }} inch</li>
                                <li class="hidden-specs"><strong>Ultra-Wide Camera:</strong> {{ $phone->camera_ultra }}</li>
                                <li class="hidden-specs"><strong>Front Camera:</strong> {{ $phone->camera_front }}</li>
                                <li class="hidden-specs"><strong>Screen Resolution:</strong> {{ $phone->screen_resolution }}</li>
                                <li class="hidden-specs"><strong>Refresh Rate:</strong> {{ $phone->refresh_rate }} Hz</li>
                                <li class="hidden-specs"><strong>Processor:</strong> {{ $phone->processor }}</li>
                                <li class="hidden-specs"><strong>Battery Capacity:</strong> {{ $phone->battery_capacity }} mAh</li>
                                <li class="hidden-specs"><strong>Charging Speed:</strong> {{ $phone->charging_speed }} W</li>
                                <li class="hidden-specs"><strong>IP Rating:</strong> {{ $phone->ip_rating }}</li>
                            </ul>
                            <button class="text-blue-500 text-sm mt-2" onclick="toggleSpecs(this)">Tampilkan lebih banyak</button>
                        </td>
                        <!-- Harga ponsel -->
                        <td class="p-4 font-semibold text-green-600">Rp {{ number_format($phone->price, 0, ',', '.') }}</td>
                        <!-- Aksi (View, Edit, Delete) -->
                        <td class="p-4 text-center space-x-2">
                            <a href="{{ route('phones.show', $phone->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600">🔍 View</a>
                            <a href="{{ route('phones.edit', $phone->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600">✏️ Edit</a>
                            <form action="{{ route('phones.destroy', $phone->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $phones->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
    <script>
        function toggleSpecs(button) {
            const specs = button.parentElement.querySelectorAll('.hidden-specs');
            const isHidden = specs[0].style.display === "none" || specs[0].style.display === "";
            specs.forEach(spec => spec.style.display = isHidden ? "block" : "none");
            button.textContent = isHidden ? "Tampilkan lebih sedikit" : "Tampilkan lebih banyak";
        }
    </script>
</body>
</html>
