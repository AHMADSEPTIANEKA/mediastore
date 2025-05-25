<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE PEDIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .content {
            margin-top: 80px;
        }
        .carousel {
            position: relative;
            overflow: hidden;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            min-width: 100%;
            transition: opacity 1s;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
 <!-- Navbar -->
<nav class="navbar bg-white shadow-lg p-4 flex justify-between items-center fixed w-full top-0 z-50 transition-all duration-300 ease-in-out">
    <div class="flex items-center space-x-6">
        <a href="#" class="text-3xl font-bold text-indigo-600 tracking-wide transition duration-300 transform hover:scale-110 hover:text-indigo-700">STORE PEDIA</a>
        
        <div class="relative group">
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Store</a>
            <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">New Arrivals</a>
                <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Best Sellers</a>
                <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Discounts</a>
            </div>
        </div>
        
        <div class="relative group">
            <a href="{{ route('phones.index') }}" class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Handphone</a>
            <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                <a href="{{ route('phones.android') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Android</a>
                <a href="{{ route('phones.iphone') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">iPhone</a>
            </div>
        </div>
        
        <div class="relative group">
            <a href="{{ route('laptops.index') }}" class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Laptop</a>
            <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100 overflow-hidden">
                <a href="{{ route('laptops.gaming') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Gaming</a>
                <a href="{{ route('laptops.ultrabook') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Ultrabook</a>
                <a href="{{ route('laptops.workstation') }}" class="block px-4 py-3 text-gray-700 hover:bg-indigo-200 rounded-md">Workstation</a>
            </div>
        </div>
        
        <div class="relative group">
            <a href="{{ route('accessories.home') }}" class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md">Accessories</a>
        </div>
    </div>
    
    <div class="flex items-center space-x-4">
        <form action="{{ route('search') }}" method="GET" class="flex">
            <input type="text" name="query" id="search" placeholder="Search..." class="px-4 py-2 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out shadow-sm">
            <button type="submit" class="ml-2 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition duration-300">🔍</button>
        </form>
        <a href="{{ route('cart.index') }}" class="text-gray-700 text-xl transform hover:scale-125 transition duration-300">🛒</a>
        <a href="#" class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-full hover:opacity-90 transform hover:scale-110 transition duration-300 shadow-lg">Login</a>
    </div>
</nav>   
    <!-- Product List for Phones -->
    <div class="p-8 mt-20">
        <h3 class="text-2xl font-bold mb-4">Workstation Laptop</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($laptops as $laptop)
            <div class="bg-white p-5 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                <div class="relative overflow-hidden rounded-2xl">
                    <img src="{{ asset('storage/' . $laptop->picture) }}" alt="{{ $laptop->name }}" class="w-full h-40 object-contain rounded-xl">
                </div>
                <div class="mt-4">
                    <h4 class="text-gray-800 font-semibold text-lg">{{ $laptop->name }}</h4>
                    <p class="text-gray-600 text-sm">{{ $laptop->brand }}</p>
                    <p class="text-indigo-600 font-bold text-xl">Rp {{ number_format((int) str_replace('.', '', $laptop->price), 0, ',', '.') }}</p>
                </div>
                <div class="mt-4 space-y-2">
<a href="{{ route('payment', ['product_id' => $laptop->id, 'type' => 'laptop']) }}" 
   class="block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 mt-2">
   Buy Now
</a>
                    <a href="{{ route('laptops.show', $laptop->id) }}" class="block text-center bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300">Learn More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
        let index = 0;
        function changeSlide() {
            const slides = document.querySelectorAll('.carousel-item');
            const totalSlides = slides.length;
            index = (index + 1) % totalSlides;
            document.querySelector('.carousel-inner').style.transform = `translateX(-${index * 100}%)`;
        }
        setInterval(changeSlide, 3000);
    </script>
</body>
</html>
