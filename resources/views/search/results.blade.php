@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="mt-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
            Hasil Pencarian untuk: <span class="text-indigo-600">"{{ $query }}"</span>
        </h1>
        <p class="text-gray-500 mt-2">
            Ditemukan {{ $phones->count() + $laptops->count() + $accessories->count() }} hasil
        </p>
    </div>

    <!-- Search Results -->
    <div class="space-y-12">
        <!-- Handphone Section -->
        @if($phones->isNotEmpty())
        <div>
            <div class="flex items-center mb-4">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Handphone</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($phones as $phone)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-100 flex items-center justify-center p-4">
                        @if ($phone['picture'])
            <img src="{{ asset('storage/' . $phone['picture']) }}" alt="{{ $phone['name'] }}" width="150">
        @else
            <p>[Tidak ada gambar]</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $phone->name }}</h3>
                        <p class="text-indigo-600 font-medium">Rp {{ number_format($phone->price, 0, ',', '.') }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $phone->brand ?? 'N/A' }}</span>
                            <a href="{{ route('phones.show', $phone->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Laptop Section -->
        @if($laptops->isNotEmpty())
        <div>
            <div class="flex items-center mb-4">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Laptop</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($laptops as $laptop)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-100 flex items-center justify-center p-4">
                        @if ($laptop['picture'])
            <img src="{{ asset('storage/' . $laptop['picture']) }}" alt="{{ $laptop['name'] }}" width="150">
        @else
            <p>[Tidak ada gambar]</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $laptop->name }}</h3>
                        <p class="text-indigo-600 font-medium">Rp {{ number_format($laptop->price, 0, ',', '.') }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $laptop->processor ?? 'N/A' }}</span>
                            <a href="{{ route('laptops.show', $laptop->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Accessories Section -->
        @if($accessories->isNotEmpty())
        <div>
            <div class="flex items-center mb-4">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Aksesoris</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($accessories as $accessory)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-48 bg-gray-100 flex items-center justify-center p-4">
                        @if ($accessory['picture'])
            <img src="{{ asset('storage/' . $accessory['picture']) }}" alt="{{ $accessory['name'] }}" width="150">
        @else
            <p>[Tidak ada gambar]</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $accessory->name }}</h3>
                        <p class="text-indigo-600 font-medium">Rp {{ number_format($accessory->price, 0, ',', '.') }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $accessory->type ?? 'N/A' }}</span>
                            <a href="{{ route('accessories.show', $accessory->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- No Results -->
        @if($phones->isEmpty() && $laptops->isEmpty() && $accessories->isEmpty())
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
            <p class="mt-2 text-gray-500">Coba kata kunci lain atau periksa ejaan Anda</p>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection