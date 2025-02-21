<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Phone - {{ $phone->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #E0E7FF, #C7D2FE);
            animation: fadeIn 0.8s ease-in-out;
            color: #4B5563;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(6px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        .card-shadow:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .button {
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .button-primary {
            background-color: #4F46E5;
            color: white;
        }

        .button-secondary {
            background-color: #6B7280;
            color: white;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .product-name-box {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.75), rgba(59, 130, 246, 0.75));
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            padding: 14px 20px;
            border-radius: 10px;
            text-align: center;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .specs-box {
            background-color: #F9FAFB;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: grid;
            gap: 8px;
        }

        .specs-box p {
            font-size: 0.95rem;
            color: #4B5563;
            line-height: 1.4;
        }

        .specs-box p strong {
            color: #4F46E5;
        }

        .image-container img {
            transition: transform 0.3s ease;
            max-width: 80%;
            height: auto;
            border-radius: 8px;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

    </style>
</head>
<body>

    <div class="container mx-auto p-4">

        <!-- Phone Name Box -->
        <div class="product-name-box mb-6">
            📱 {{ $phone->name }}
        </div>

        <div class="glass-card p-6 rounded-xl max-w-3xl mx-auto card-shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">

                <!-- Image Section -->
                <div class="relative group flex justify-center mb-6 md:mb-0 image-container">
                    @if($phone->picture)
                        <img src="{{ asset('storage/' . $phone->picture) }}" 
                             class="object-cover shadow-md"
                             alt="{{ $phone->name }}">
                    @else
                        <div class="text-gray-500 bg-gray-200 p-4 rounded-lg text-center">No Image Available</div>
                    @endif
                </div>

                <!-- Phone Details (Specifications Box) -->
                <div class="specs-box">
                    <p><strong>Brand:</strong> {{ $phone->brand ?? 'Tidak tersedia' }}</p>
                    <p><strong>Price:</strong> Rp {{ number_format($phone->price, 0, ',', '.') }}</p>
                    <p><strong>Kamera Utama:</strong> {{ $phone->camera_main ?? 'Tidak tersedia' }}</p>
                    <p><strong>Kamera Ultra-Lebar:</strong> {{ $phone->camera_ultra ?? 'Tidak tersedia' }}</p>
                    <p><strong>Kamera Depan:</strong> {{ $phone->camera_front ?? 'Tidak tersedia' }}</p>
                    <p><strong>Ukuran Layar:</strong> {{ $phone->screen_size ? $phone->screen_size . ' inci' : 'Tidak tersedia' }}</p>
                    <p><strong>Resolusi Layar:</strong> {{ $phone->screen_resolution ?? 'Tidak tersedia' }}</p>
                    <p><strong>Refresh Rate:</strong> {{ $phone->refresh_rate ? $phone->refresh_rate . ' Hz' : 'Tidak tersedia' }}</p>
                    <p><strong>Prosesor:</strong> {{ $phone->processor ?? 'Tidak tersedia' }}</p>
                    <p><strong>Baterai:</strong> {{ $phone->battery_capacity ? number_format($phone->battery_capacity) . ' mAh' : 'Tidak tersedia' }}</p>
                    <p><strong>Pengisian:</strong> {{ $phone->charging_speed ? $phone->charging_speed . ' W' : 'Tidak tersedia' }}</p>
                    <p><strong>IP Rating:</strong> {{ $phone->ip_rating ?? 'Tidak tersedia' }}</p>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ route('phones.index') }}" class="button button-secondary">
                    Back To List
                </a>
                <a href="{{ route('dashboard') }}" class="button button-primary">
                    Dashboard
                </a>
            </div>
        </div>
    </div>

</body>
</html>
