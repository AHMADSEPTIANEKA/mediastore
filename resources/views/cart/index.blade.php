<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-shopping-cart mr-2 text-indigo-600"></i> Keranjang Belanja
            </h1>
            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ count($cart) }} Item
            </span>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(count($cart) > 0)
            <!-- Cart Items -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @foreach($cart as $id => $item)
                    <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition duration-200">
                        <div class="flex items-start">
                            <!-- Product Image -->
                            <div class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden bg-gray-100">
                                @if($item['picture'])
                                    <img src="{{ asset('storage/' . $item['picture']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Product Details -->
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ ucfirst($item['type']) }}</p>
                                    </div>
                                    <button onclick="confirmDelete('{{ $id }}')" class="text-red-500 hover:text-red-700 transition">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                                
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-gray-700 font-medium">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm font-medium">
                                            Qty: {{ $item['quantity'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
@php
    $totalQuantity = array_sum(array_map(function($item) {
        return $item['quantity'];
    }, $cart));

    $subtotal = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));
@endphp
            <!-- Summary -->
            <div class="mt-6 bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Ringkasan Belanja</h3>
                <div class="space-y-3">
    <div class="flex justify-between">
        <span class="text-gray-600">Total Item</span>
        <span class="font-medium">{{ $totalQuantity }} Produk</span>
    </div>
    <div class="flex justify-between">
        <span class="text-gray-600">Subtotal</span>
        <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
    </div>
    <div class="border-t border-gray-200 pt-3 mt-3">
        <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-indigo-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
    </div>
</div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Lanjut Belanja
                    </a>
                    <!-- Updated Payment Button -->
                    <form action="{{ route('payment.show') }}" method="GET">
    @csrf
    <input type="hidden" name="total_amount" value="{{ $subtotal }}">
    @foreach($cart as $id => $item)
        <input type="hidden" name="items[{{ $id }}][id]" value="{{ $id }}">
        <input type="hidden" name="items[{{ $id }}][name]" value="{{ $item['name'] }}">
        <input type="hidden" name="items[{{ $id }}][price]" value="{{ $item['price'] }}">
        <input type="hidden" name="items[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
        <input type="hidden" name="items[{{ $id }}][type]" value="{{ $item['type'] }}">
        @if(isset($item['picture']))
            <input type="hidden" name="items[{{ $id }}][picture]" value="{{ $item['picture'] }}">
        @endif
        @if(isset($item['brand']))
            <input type="hidden" name="items[{{ $id }}][brand]" value="{{ $item['brand'] }}">
        @endif
    @endforeach
    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
        Bayar Sekarang <i class="fas fa-credit-card ml-2"></i>
    </button>
</form>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shopping-cart text-indigo-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Keranjangmu masih kosong</h3>
                <p class="text-gray-600 mb-6">Ayo temukan produk menarik dan mulai belanja!</p>
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-store mr-2"></i> Belanja Sekarang
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-sm w-full">
            <h3 class="text-lg font-semibold mb-4">Hapus Item?</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus item ini dari keranjang?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    Batal
                </button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(itemId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/cart/${itemId}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>