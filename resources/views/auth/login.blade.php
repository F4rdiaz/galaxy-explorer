<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Galaxy Explorer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CDN Tailwind --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-black to-gray-900 flex items-center justify-center text-white">

    <div class="w-full max-w-md px-6 py-8 bg-white bg-opacity-10 backdrop-blur-md rounded-xl shadow-lg">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-indigo-300">🚀 Galaxy Explorer</h1>
            <p class="text-sm text-indigo-200">Masuk untuk menjelajahi luar angkasa</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-indigo-200">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 w-full px-4 py-2 bg-white bg-opacity-20 border border-indigo-500 text-white placeholder-indigo-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
                @error('email')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-indigo-200">Password</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 w-full px-4 py-2 bg-white bg-opacity-20 border border-indigo-500 text-white placeholder-indigo-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
                @error('password')
                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-indigo-200">Ingat saya</label>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 rounded transition duration-200">
                Masuk
            </button>

            {{-- Links --}}
            <div class="flex justify-between text-sm text-indigo-300 mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="hover:underline">Lupa password?</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:underline">Daftar</a>
                @endif
            </div>
        </form>
    </div>

</body>
</html>
