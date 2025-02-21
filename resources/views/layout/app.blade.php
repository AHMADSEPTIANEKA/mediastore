<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store Pedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">Store Pedia</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('phones.index') }}" class="hover:underline">Handphone</a></li>
                <li><a href="{{ route('laptops.index') }}" class="hover:underline">Laptop</a></li>
                <li><a href="{{ route('accessories.index') }}" class="hover:underline">Accessories</a></li>
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Notifikasi -->
    @if(session('success'))
    <div id="notification" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500 opacity-100">
        {{ session('error') }}
    </div>
    @endif

    <!-- Container utama -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>
    
    <script>
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.classList.add('opacity-0');
                setTimeout(() => notification.remove(), 500);
            }
        }, 3000);
    </script>
</body>
</html>