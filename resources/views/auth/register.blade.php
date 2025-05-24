<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900 text-white">
    <div
        class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg flex flex-col md:flex-row overflow-hidden border border-gray-700">

        <!-- Bagian Gambar -->
        <div class="md:w-1/2 w-full bg-gray-700 flex items-center justify-center relative">
            <img src="image/bola1.jpg" alt="User Login" class="w-full h-full object-cover">
            <div
                class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-40 flex flex-col items-center justify-center text-center p-4">
                <h3 class="text-2xl font-bold text-orange-400 drop-shadow-md">Selamat Datang!</h3>
                <p class="text-sm text-gray-300">Hanya Untuk Admin.</p>
            </div>
        </div>

        <!-- Form Register -->
        <div class="bg-gray-800 p-6 w-full md:w-1/2">
            <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

            @if ($errors->any())
                <div class="text-red-500 text-sm mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="relative mt-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" name="name" id="name" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Nama">
                </div>

                <!-- Email -->
                <div class="relative mt-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </span>
                    <input type="email" name="email" id="email" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Email">
                </div>

                <!-- Password -->
                <div class="relative mt-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Password">
                </div>

                <!-- Konfirmasi Password -->
                <div class="relative mt-4 mb-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <i class="fa-solid fa-unlock"></i>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full pl-10 py-3 rounded-lg bg-gray-800 border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-white"
                        placeholder="Konfirmasi Password">
                </div>
                <div class="flex items-center justify-center gap-2 text-center">
                    <button type="submit"
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 rounded font-bold">
                        Register
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="w-full bg-red-600 rounded-md p-2 hover:bg-red-700">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
