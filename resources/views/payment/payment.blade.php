<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - STORE PEDIA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha512-sA+z0p3xI5xE9kHSpY97JoP7i9YFv6v+e2eVrH1FiZ2oY6qKr8pU+TTGmTC7JgPXYeI1YxFg9isx2kLfX2Vx5w==" 
          crossorigin="">
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .payment-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }
        .card-input {
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }
        .card-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: white;
        }
        .product-image {
            height: 80px;
            width: 80px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #f0f0f0;
            background: white;
        }
        .payment-method {
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        .payment-method:hover {
            transform: translateY(-2px);
        }
        .payment-method.active {
            border-color: #6366f1;
            background-color: #f0f4ff;
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.1);
        }
        .map-container {
            height: 300px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            background: #f8f9fa;
        }
        .order-summary {
            max-height: 400px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #e0e0e0 #f8f9fa;
        }
        .order-summary::-webkit-scrollbar {
            width: 6px;
        }
        .order-summary::-webkit-scrollbar-track {
            background: #f8f9fa;
        }
        .order-summary::-webkit-scrollbar-thumb {
            background-color: #e0e0e0;
            border-radius: 20px;
        }
        .pay-button {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }
        @media (max-width: 768px) {
            .flex-col-on-mobile {
                flex-direction: column;
            }
            .w-full-on-mobile {
                width: 100% !important;
            }
            .map-container {
                height: 250px;
            }
        }

        /* Popup Animation */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .popup-container {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            text-align: center;
        }
        
        .popup-overlay.active .popup-container {
            transform: translateY(0);
        }
        
        .popup-icon {
            font-size: 5rem;
            margin: 20px 0;
        }
        
        .popup-success {
            color: #10B981;
        }
        
        .popup-error {
            color: #EF4444;
        }
        
        .popup-button {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            margin: 20px 10px 10px;
            display: inline-block;
        }
        
        .popup-success-button {
            background: #10B981;
            color: white;
        }
        
        .popup-success-button:hover {
            background: #059669;
        }
        
        .popup-error-button {
            background: #EF4444;
            color: white;
        }
        
        .popup-error-button:hover {
            background: #DC2626;
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            opacity: 0;
        }
    </style>
</head>
<!-- Leaflet CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<style>
    .map-container {
        height: 300px;
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
</style>


<body class="bg-gray-50 font-sans antialiased">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
            integrity="sha512-vRZWmFtJzMKwxm9dfpTO2P4BkXn/SMp9Xvzt0bFiE+F3yp9EzBQZGOq7FhP2iyp7IsdeQib+qz/IVy30sUvF0A==" 
            crossorigin=""></script>
    
    <!-- Navbar -->
    <nav class="navbar bg-white p-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600 flex items-center">
            <i class="fas fa-store mr-2"></i>
            STORE PEDIA
        </a>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition px-4 py-2 rounded-md hidden md:block">Home</a>
            <a href="{{ route('cart.index') }}" class="text-gray-700 relative">
                <i class="fas fa-shopping-cart text-xl"></i>
                @if(isset($cartCount) && $cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition hidden md:block">
                Login
            </a>
            <button class="md:hidden text-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto mt-24 p-4 md:p-6">
        <div class="flex flex-col md:flex-row gap-8 flex-col-on-mobile">
            <!-- Payment Form -->
            <div class="md:w-2/3 w-full-on-mobile">
                <div class="payment-card p-6 md:p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-indigo-100 p-3 rounded-full mr-4">
                            <i class="fas fa-credit-card text-indigo-600 text-xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-800">Payment Checkout</h1>
                    </div>
                    
                    <form id="payment-form" action="{{ route('payment.process') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(isset($items))
                            @foreach($items as $id => $item)
                                <input type="hidden" name="items[{{ $id }}][id]" value="{{ $item['id'] }}">
                                <input type="hidden" name="items[{{ $id }}][name]" value="{{ $item['name'] }}">
                                <input type="hidden" name="items[{{ $id }}][price]" value="{{ $item['price'] }}">
                                <input type="hidden" name="items[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                <input type="hidden" name="items[{{ $id }}][type]" value="{{ $item['type'] }}">
                                <input type="hidden" name="items[{{ $id }}][picture]" value="{{ $item['picture'] ?? '' }}">
                            @endforeach
                        @else
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_type" value="{{ $productType }}">
                        @endif

                        <!-- Payment Method Selection -->
                        <div>
                            <label class="block mb-3 font-semibold text-gray-700">Payment Method</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="payment-method border rounded-lg p-4 text-center cursor-pointer active" data-method="credit_card">
                                    <div class="bg-indigo-50 p-3 rounded-full inline-block mb-2">
                                        <i class="fas fa-credit-card text-2xl text-indigo-600"></i>
                                    </div>
                                    <p class="font-medium text-gray-700">Credit Card</p>
                                    <p class="text-xs text-gray-500 mt-1">Visa, Mastercard</p>
                                    <input type="radio" name="payment_method" value="credit_card" checked class="hidden">
                                </div>
                                <div class="payment-method border rounded-lg p-4 text-center cursor-pointer" data-method="paypal">
                                    <div class="bg-blue-50 p-3 rounded-full inline-block mb-2">
                                        <i class="fab fa-paypal text-2xl text-blue-500"></i>
                                    </div>
                                    <p class="font-medium text-gray-700">PayPal</p>
                                    <p class="text-xs text-gray-500 mt-1">Secure payment</p>
                                    <input type="radio" name="payment_method" value="paypal" class="hidden">
                                </div>
                            </div>
                        </div>

                        <!-- Credit Card Fields -->
                        <div id="credit-card-fields" class="space-y-4">
                            <div>
                                <label class="block mb-2 font-medium text-gray-700">Name on Card</label>
                                <input type="text" name="card_name" required 
                                       class="w-full p-3 card-input rounded-lg"
                                       pattern="[A-Za-z ]+" title="Only letters and spaces allowed">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 font-medium text-gray-700">Card Number</label>
                                    <input type="text" name="card_number" maxlength="19" required 
                                           class="w-full p-3 card-input rounded-lg" placeholder="1234 5678 9012 3456"
                                           pattern="[\d ]{13,19}" title="Enter a valid card number">
                                </div>
                                <div>
                                    <label class="block mb-2 font-medium text-gray-700">CVV</label>
                                    <div class="relative">
                                        <input type="password" name="card_cvv" maxlength="4" required 
                                               class="w-full p-3 card-input rounded-lg pr-10" placeholder="•••"
                                               pattern="\d{3,4}" title="3 or 4 digit CVV">
                                        <div class="absolute right-3 top-3 text-gray-400 cursor-pointer hover:text-gray-600" onclick="toggleCVV(this)">
                                            <i class="far fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-gray-700">Expiry Date</label>
                                <input type="month" name="card_expiry" required 
                                       class="w-full p-3 card-input rounded-lg" 
                                       min="{{ date('Y-m') }}">
                            </div>
                        </div>

                        <!-- PayPal Fields (hidden by default) -->
                        <div id="paypal-fields" class="hidden">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-yellow-500 mt-1 mr-2"></i>
                                    <p class="text-yellow-700">You will be redirected to PayPal to complete your payment after clicking "Pay Now"</p>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        <div class="border-t pt-6 mt-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-indigo-100 p-2 rounded-full mr-3">
                                    <i class="fas fa-truck text-indigo-600 text-lg"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">Shipping Information</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-gray-700">First Name</label>
                                    <input type="text" name="first_name" required 
                                           class="w-full p-3 card-input rounded-lg" 
                                           pattern="[A-Za-z]+" title="Only letters allowed">
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700">Last Name</label>
                                    <input type="text" name="last_name" required 
                                           class="w-full p-3 card-input rounded-lg" 
                                           pattern="[A-Za-z]+" title="Only letters allowed">
                                </div>
                                
                                <div class="md:col-span-2">
    <label class="block mb-2 text-gray-700">Address</label>
    <input type="text" name="address" id="address" required 
           class="w-full p-3 card-input rounded-lg">
</div>

                                
                                <div class="md:col-span-2">
                                    <label class="block mb-2 text-gray-700">Pin Your Location</label>
                                    <div id="map" class="map-container"></div>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span>Drag the marker to your exact location</span>
                                    </div>
                                    <input type="hidden" name="latitude" id="latitude" required>
                                    <input type="hidden" name="longitude" id="longitude" required>
                                </div>

                                <div>
                                    <label class="block mb-2 text-gray-700">City</label>
                                    <input type="text" name="city" required 
                                           class="w-full p-3 card-input rounded-lg">
                                </div>
                                <div>
                                    <label class="block mb-2 text-gray-700">Postal Code</label>
                                    <input type="text" name="postal_code" required 
                                           class="w-full p-3 card-input rounded-lg" 
                                           pattern="\d+" title="Only numbers allowed">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block mb-2 text-gray-700">Country</label>
                                    <select name="country" required 
                                            class="w-full p-3 card-input rounded-lg appearance-none">
                                        <option value="">Select Country</option>
                                        <option value="ID" selected>Indonesia</option>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="SG">Singapore</option>
                                        <option value="MY">Malaysia</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div>
                            <label class="block mb-2 text-gray-700">Order Notes (Optional)</label>
                            <textarea name="notes" rows="3" 
                                      class="w-full p-3 card-input rounded-lg" 
                                      maxlength="500"
                                      placeholder="Special instructions, delivery preferences, etc."></textarea>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms" required 
                                   class="mt-1 mr-3 h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="terms" class="text-sm text-gray-600">
                                I agree to the <a href="#" class="text-indigo-600 hover:underline">Terms and Conditions</a> and <a href="#" class="text-indigo-600 hover:underline">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" 
                                class="w-full pay-button text-white py-4 rounded-lg font-semibold transition flex items-center justify-center mt-6">
                            <span id="button-text">Pay Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                            <span id="button-spinner" class="hidden ml-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="md:w-1/3 w-full-on-mobile">
                <div class="bg-white p-6 rounded-2xl shadow-lg sticky top-28">
                    <div class="flex items-center mb-4">
                        <div class="bg-indigo-100 p-2 rounded-full mr-3">
                            <i class="fas fa-receipt text-indigo-600"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Order Summary</h2>
                    </div>
                    
                    <div class="order-summary space-y-4 pb-4">
                        @if(isset($items) && count($items) > 0)
                            {{-- Kalau dari cart --}}
                            @foreach($items as $item)
                                <div class="flex items-center border-b pb-4">
                                    <img src="{{ asset($item['picture'] ? 'storage/' . $item['picture'] : 'images/default-product.jpg') }}" 
                                         class="product-image rounded-lg" alt="{{ $item['name'] }}">
                                    <div class="ml-4">
                                        <h4 class="font-medium text-gray-800">{{ $item['name'] }}</h4>
                                        <p class="text-xs text-gray-500">{{ ucfirst($item['type'] ?? 'product') }}</p>
                                        <p class="text-sm text-gray-700 mt-1">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }} × {{ $item['quantity'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @elseif(isset($product))
                            {{-- Kalau dari Buy Now (direct product) --}}
                            <div class="flex items-center border-b pb-4">
                                <img src="{{ asset($product->picture ? 'storage/' . $product->picture : 'images/default-product.jpg') }}" 
                                     class="product-image rounded-lg" alt="{{ $product->name }}">
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-800">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ ucfirst($productType ?? 'product') }}</p>
                                    <p class="text-sm text-gray-700 mt-1">
                                        Rp {{ number_format($product->price, 0, ',', '.') }} × 1
                                    </p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500 py-4 text-center">Your cart is empty</p>
                        @endif
                    </div>

                    <div class="border-t pt-4 mt-2 space-y-3">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span>Rp {{ isset($subtotal) ? number_format($subtotal, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Shipping</span>
                            <span>Rp {{ isset($shipping) ? number_format($shipping, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-2">
                            <span>Total</span>
                            <span>Rp {{ isset($total) ? number_format($total, 0, ',', '.') : '0' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<!-- Popup Notification -->
    <div id="popup-overlay" class="popup-overlay">
        <div class="popup-container">
            <div id="popup-icon" class="popup-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 id="popup-title" class="text-2xl font-bold mb-2">Payment Successful!</h2>
            <p id="popup-message" class="text-gray-600 px-6 mb-6">Your order has been processed successfully. Order ID: #12345</p>
            <button id="popup-button" class="popup-button popup-success-button">
                <i class="fas fa-shopping-bag mr-2"></i>Continue Shopping
            </button>
        </div>
</div>
    <script>
        // Payment Method Selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
                this.classList.add('active');
                const methodType = this.dataset.method;
                document.querySelector(`input[value="${methodType}"]`).checked = true;
                
                document.getElementById('credit-card-fields').classList.toggle('hidden', methodType !== 'credit_card');
                document.getElementById('paypal-fields').classList.toggle('hidden', methodType !== 'paypal');
            });
        });

        // Format card number with spaces
        document.querySelector('input[name="card_number"]')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });

        // Toggle CVV visibility
        function toggleCVV(button) {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Form submission
        document.getElementById('payment-form')?.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const buttonText = button.querySelector('#button-text');
            const spinner = button.querySelector('#button-spinner');
            
            button.disabled = true;
            buttonText.textContent = 'Processing...';
            spinner.classList.remove('hidden');
        });

        // Initialize map with better styling
        document.addEventListener("DOMContentLoaded", function() {
            const mapElement = document.getElementById('map');
            if (!mapElement) return;
            
            // Default to Jakarta coordinates
            const defaultLat = -6.2088;
            const defaultLng = 106.8456;
            
            // Create map with better tile layer
            const map = L.map('map', {
                center: [defaultLat, defaultLng],
                zoom: 13,
                zoomControl: false,
                scrollWheelZoom: false
            });

            // Add tile layer with better visual
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);

            // Custom marker icon
            const customIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

            // Add marker with dragging
            const marker = L.marker([defaultLat, defaultLng], {
                icon: customIcon,
                draggable: true
            }).addTo(map);

            // Set initial values
            document.getElementById("latitude").value = defaultLat;
            document.getElementById("longitude").value = defaultLng;

            // Update coordinates when marker is moved
            marker.on('dragend', function(e) {
                const latLng = marker.getLatLng();
                document.getElementById("latitude").value = latLng.lat.toFixed(6);
                document.getElementById("longitude").value = latLng.lng.toFixed(6);
            });

            // Add click event to move marker
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                document.getElementById("latitude").value = e.latlng.lat.toFixed(6);
                document.getElementById("longitude").value = e.latlng.lng.toFixed(6);
            });

            // Add zoom controls
            L.control.zoom({
                position: 'topright'
            }).addTo(map);

            // Try geolocation if available
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    
                    marker.setLatLng([userLat, userLng]);
                    map.setView([userLat, userLng], 15);
                    
                    document.getElementById("latitude").value = userLat.toFixed(6);
                    document.getElementById("longitude").value = userLng.toFixed(6);
                    
                    // Add a nice popup
                    marker.bindPopup("Your current location").openPopup();
                }, function(error) {
                    console.log("Geolocation error:", error);
                    // Add default popup if geolocation fails
                    marker.bindPopup("Drag to your exact location").openPopup();
                });
            } else {
                // Add default popup if geolocation not supported
                marker.bindPopup("Drag to your exact location").openPopup();
            }
        });
        


    document.addEventListener("DOMContentLoaded", function () {
        // Lokasi default (Jakarta)
        var initialLat = -6.2;
        var initialLng = 106.816666;

        // Inisialisasi map
        var map = L.map('map').setView([initialLat, initialLng], 13);

        // Tile layer dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker draggable
        var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

        // Update input saat marker digeser
        marker.on('dragend', function (e) {
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        // Set input default
        document.getElementById('latitude').value = initialLat;
        document.getElementById('longitude').value = initialLng;
    });


    document.addEventListener("DOMContentLoaded", function () {
        var initialLat = -6.2;
        var initialLng = 106.816666;

        var map = L.map('map').setView([initialLat, initialLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

        // Set nilai awal
        document.getElementById('latitude').value = initialLat;
        document.getElementById('longitude').value = initialLng;

        // Fungsi untuk reverse geocoding
        function fetchAddress(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        document.getElementById('address').value = data.display_name;
                    }
                })
                .catch(err => {
                    console.error("Failed to get address:", err);
                });
        }

        // Panggil saat marker digeser
        marker.on('dragend', function () {
            var pos = marker.getLatLng();
            document.getElementById('latitude').value = pos.lat;
            document.getElementById('longitude').value = pos.lng;
            fetchAddress(pos.lat, pos.lng); // Dapatkan alamat otomatis
        });

        // Ambil alamat awal
        fetchAddress(initialLat, initialLng);
    });


    // Function to show payment popup
        function showPaymentPopup(type, message, orderId = '') {
            const popup = document.getElementById('popup-overlay');
            const icon = document.getElementById('popup-icon');
            const title = document.getElementById('popup-title');
            const msg = document.getElementById('popup-message');
            const button = document.getElementById('popup-button');
            
            // Reset classes
            icon.className = 'popup-icon';
            button.className = 'popup-button';
            
            if (type === 'success') {
                icon.classList.add('popup-success');
                button.classList.add('popup-success-button');
                title.textContent = 'Payment Successful!';
                msg.textContent = message || `Your order has been processed successfully. Order ID: #${orderId}`;
                button.innerHTML = '<i class="fas fa-shopping-bag mr-2"></i>Continue Shopping';
                createConfetti();
            } else {
                icon.classList.add('popup-error');
                button.classList.add('popup-error-button');
                title.textContent = 'Payment Failed';
                msg.textContent = message || 'There was an error processing your payment. Please try again.';
                button.innerHTML = '<i class="fas fa-redo mr-2"></i>Try Again';
            }
            
            popup.classList.add('active');
            
            // Button action
            button.onclick = function() {
                popup.classList.remove('active');
                if (type === 'success') {
                    window.location.href = "{{ route('dashboard') }}";
                }
            };
        }

        // Confetti effect for success
        function createConfetti() {
            const colors = ['#EF4444', '#F59E0B', '#10B981', '#3B82F6', '#8B5CF6'];
            const popup = document.querySelector('.popup-container');
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = -10 + 'px';
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                
                const animationDuration = Math.random() * 3 + 2;
                confetti.style.animation = `fall ${animationDuration}s linear forwards`;
                
                popup.appendChild(confetti);
                
                // Remove after animation
                setTimeout(() => {
                    confetti.remove();
                }, animationDuration * 1000);
            }
        }

        // Add CSS animation for confetti
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: translateY(300px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Example usage (you would call this after payment processing):
        // showPaymentPopup('success', 'Thank you for your purchase!', '12345');
        // showPaymentPopup('error', 'Insufficient funds. Please use another payment method.');
        
        // For demo purposes - remove in production
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate payment processing
            document.getElementById('payment-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const button = this.querySelector('button[type="submit"]');
                const buttonText = button.querySelector('#button-text');
                const spinner = button.querySelector('#button-spinner');
                
                button.disabled = true;
                buttonText.textContent = 'Processing...';
                spinner.classList.remove('hidden');
                
                // Simulate API call
                setTimeout(() => {
                    // Randomly show success or error for demo
                    const isSuccess = Math.random() > 0.3;
                    if (isSuccess) {
                        showPaymentPopup('success', 'Thank you for your purchase!', Math.floor(Math.random() * 90000) + 10000);
                    } else {
                        showPaymentPopup('error', 'Payment declined. Please check your card details and try again.');
                    }
                    
                    button.disabled = false;
                    buttonText.textContent = `Pay Rp {{ number_format($total ?? 0, 0, ',', '.') }}`;
                    spinner.classList.add('hidden');
                }, 2000);
            });
        });

    </script>
</body>
</html>