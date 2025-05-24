<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>

<body
    class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white p-4">
    <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg flex overflow-hidden border border-gray-700">

        <!-- Bagian Kanan (Gambar) -->
        <div class="w-1/2 bg-gray-700 flex items-center justify-center relative">
            <img src="image/bola1.jpg" alt="User Login" class="w-full h-full object-cover">
            <div
                class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-40 flex flex-col items-center justify-center text-center p-4">
                <h3 class="text-2xl font-bold text-orange-400 drop-shadow-md">Selamat Datang!</h3>
                <p class="text-sm text-gray-300">Hanya Untuk Admin!.</p>
            </div>
        </div>

        <!-- Bagian Kiri (Form Login) -->
        <div class="w-1/2 p-8 flex flex-col justify-center bg-gray-900 relative">
            <h2 class="text-3xl font-bold mb-6 text-center text-orange-500">Login</h2>

            @if ($errors->any())
                <div class="text-red-500 text-sm mb-4 text-center bg-red-800 p-2 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Input Email -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="email" name="email" id="email" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Email">
                </div>

                <!-- Input Password -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Password">
                </div>

                <button type="submit"
                    class="w-full text-center bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-bold transition duration-300">
                    Login
                </button>
                <div
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-bold text-center transition duration-300">
                    <a href="{{ route('dashboard') }}">Kembali</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
