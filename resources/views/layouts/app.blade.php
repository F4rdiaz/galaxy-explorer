<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galaxy Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1474073705359-5da2c5c3e52f?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .bg-overlay {
            background: linear-gradient(to bottom right, rgba(10, 10, 25, 0.95), rgba(20, 0, 50, 0.9));
        }
    </style>
</head>
<body class="min-h-screen text-white flex flex-col">
    <div class="bg-overlay min-h-screen flex flex-col">
        <nav class="bg-indigo-900 bg-opacity-90 text-white px-4 md:px-6 py-4 shadow-md">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <div class="font-bold text-xl flex items-center gap-2 mb-2 md:mb-0">
                    <span class="text-2xl">🚀</span> Galaxy Explorer
                </div>
                <div class="flex flex-wrap gap-3 text-sm items-center">
                    @auth
                        <a href="{{ route('missions.index') }}" class="hover:underline">Misi</a>
                        <a href="{{ route('planets.index') }}" class="hover:underline">Planet</a>
                        <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">Login</a>
                        <a href="{{ route('register') }}" class="hover:underline">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-6">
            @yield('content')
        </main>

        <footer class="bg-indigo-900 bg-opacity-90 text-white text-center py-4 mt-10">
            &copy; {{ date('Y') }} Galaxy Explorer — Dibuat dengan ❤️ oleh Fardiaz Eka Saputra
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
