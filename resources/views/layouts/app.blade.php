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
     <nav
        class="navbar bg-white shadow-lg p-4 flex justify-between items-center fixed w-full top-0 z-50 transition-all duration-300 ease-in-out">
        <div class="flex items-center space-x-6">
            <a href="#"
                class="text-3xl font-bold text-indigo-600 tracking-wide transition duration-300 transform hover:scale-110 hover:text-indigo-700">STORE
                PEDIA</a>
            <div class="relative group">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Store</a>
                <div
                    class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">New
                        Arrivals</a>
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Best
                        Sellers</a>
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Discounts</a>
                </div>
            </div>
            <div class="relative group">
                <a href="{{ route('phones.index') }}"
                    class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Handphone</a>
                <div
                    class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                    <a href="{{ route('phones.android') }}"
                        class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Android</a>
                    <a href="{{ route('phones.iphone') }}"
                        class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">iPhone</a>
                </div>
            </div>
            <div class="relative group">
                <a href="{{ route('laptops.index') }}"
                    class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Laptop</a>
                <div
                    class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                    <a href="{{ route('laptops.gaming') }}"
                        class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Gaming</a>
                    <a href="{{ route('laptops.ultrabook') }}"
                        class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Ultrabook</a>
                    <a href="{{ route('laptops.workstation') }}"
                        class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Workstation</a>
                </div>
            </div>
            <div class="relative group">
                <a href="{{ route('accessories.home') }}"
                    class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Accessories</a>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <form action="{{ route('search') }}" method="GET" class="flex">
                <input type="text" name="query" id="search" placeholder="Search..."
                    class="px-4 py-2 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out shadow-sm">
                <button type="submit"
                    class="ml-2 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition duration-300">🔍</button>
            </form>
            <a href="#" class="text-gray-700 text-xl transform hover:scale-125 transition duration-300">🛒</a>
            <a href="{{ route('login') }}"
                class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-full hover:opacity-90 transform hover:scale-110 transition duration-300 shadow-lg">Login</a>
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