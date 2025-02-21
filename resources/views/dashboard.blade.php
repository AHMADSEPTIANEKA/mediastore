<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE PEDIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: white;
        }
        .carousel {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 400px;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            min-width: 100%;
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
        <a href="#" class="text-gray-700 text-xl transform hover:scale-125 transition duration-300">🛒</a>
        <a href="#" class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-full hover:opacity-90 transform hover:scale-110 transition duration-300 shadow-lg">Login</a>
    </div>
</nav>
    <!-- Carousel -->
    <div class="carousel mt-20 relative">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="storage/pictures/jl.png" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="storage/pictures/jp.jpg" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="storage/pictures/jo.png" class="w-full h-full object-cover" alt="Slide 3">
            </div>
        </div>
    </div>
    <!-- Product List -->
    <div class="p-8">
        <h3 class="text-2xl font-bold mb-4">Handphones</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($phones as $phone)
            <div class="bg-white p-5 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:scale-105 product-card">
                <img src="{{ asset('storage/' . $phone->picture) }}" alt="{{ $phone->name }}" class="w-full h-40 object-contain rounded-xl">
                <h4 class="text-gray-800 font-semibold text-lg mt-2">{{ $phone->name }}</h4>
                <p class="text-gray-600 text-sm">{{ $phone->brand }}</p>
                <p class="text-indigo-600 font-bold text-xl">Rp {{ number_format($phone->price, 0, ',', '.') }}</p>
                <a href="#" class="block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 mt-2">Buy Now</a>
                <a href="{{ route('phones.show', $phone->id) }}" class="block text-center bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 mt-2">Learn More</a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Product List for Laptops -->
    <div class="p-8">
        <h3 class="text-2xl font-bold mb-4">Laptops</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($laptops as $laptop)
            <div class="bg-white p-5 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:scale-105 product-card">
                <img src="{{ asset('storage/' . $laptop->picture) }}" alt="{{ $laptop->name }}" class="w-full h-40 object-contain rounded-xl">
                <h4 class="text-gray-800 font-semibold text-lg mt-2">{{ $laptop->name }}</h4>
                <p class="text-gray-600 text-sm">{{ $laptop->brand }}</p>
                <p class="text-indigo-600 font-bold text-xl">Rp {{ number_format($laptop->price, 0, ',', '.') }}</p>
                <a href="#" class="block text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 mt-2">Buy Now</a>
                <a href="{{ route('laptops.show', $laptop->id) }}" class="block text-center bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 mt-2">Learn More</a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Animasi dan Carousel -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            ScrollReveal().reveal('.product-card', {
                origin: 'bottom',
                distance: '50px',
                duration: 1000,
                delay: 200,
                easing: 'ease-in-out',
                reset: true
            });
        });
    </script>
</body>
</html>
