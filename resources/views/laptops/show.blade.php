<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $laptop->name }} - Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        dark: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                            600: '#475569',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            'from': { opacity: '0', transform: 'translateY(20px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            min-height: 100vh;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .product-header {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            font-weight: 700;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .product-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .laptop-image {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .laptop-image:hover {
            transform: scale(1.03) rotate(-1deg);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(14, 165, 233, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #334155;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            background: rgba(14, 165, 233, 0.1);
            color: #0ea5e9;
        }
        
        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            position: relative;
            display: inline-block;
        }
        
        .price-tag::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: rgba(14, 165, 233, 0.3);
            z-index: -1;
            border-radius: 2px;
        }
        
        .spec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .spec-item {
            display: flex;
            flex-direction: column;
            padding: 0.75rem;
            border-radius: 8px;
            background: rgba(241, 245, 249, 0.5);
        }
        
        .spec-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }
        
        .spec-value {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
        }
    </style>
</head>
<body class="font-sans text-dark-800">
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header with laptop name -->
        <div class="product-header mb-8 animate-fade-in">
            <h1 class="text-3xl md:text-4xl tracking-tight">💻 {{ $laptop->name }}</h1>
            <div class="mt-2 flex justify-center items-center gap-4">
                <span class="badge">{{ $laptop->brand ?? 'Brand' }}</span>
                <span class="price-tag">Rp {{ number_format($laptop->price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="glass-card p-6 md:p-8 rounded-2xl mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <!-- Image Section -->
                <div class="flex justify-center animate-float">
                    @if($laptop->picture)
                        <img src="{{ asset('storage/' . $laptop->picture) }}" 
                             class="laptop-image max-w-xs md:max-w-md"
                             alt="{{ $laptop->name }}">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Key Specifications -->
                <div class="spec-grid">
                    <div class="spec-item">
                        <span class="spec-label">Processor</span>
                        <span class="spec-value">{{ $laptop->processor ?? '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">RAM</span>
                        <span class="spec-value">{{ $laptop->ram ? $laptop->ram . 'GB' : '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Storage</span>
                        <span class="spec-value">{{ $laptop->storage ? $laptop->storage . 'GB' : '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Screen Size</span>
                        <span class="spec-value">{{ $laptop->screen_size ? $laptop->screen_size . ' inches' : '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Battery Life</span>
                        <span class="spec-value">{{ $laptop->battery_life ? $laptop->battery_life . ' hours' : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="laptop">
                <input type="hidden" name="id" value="{{ $laptop->id }}">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Add to Cart
                </button>
            </form>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>
        </div>
    </div>
    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            const successMessage = document.querySelector('.bg-emerald-50');
            if (successMessage) {
                successMessage.style.transition = 'opacity 0.5s ease';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>