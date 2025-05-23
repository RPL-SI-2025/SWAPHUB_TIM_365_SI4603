<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('kategori.index') }}" class="text-white text-2xl font-bold">
                Manajemen Kategori Admin
            </a>
            <a href="{{ route('users.index') }}" class="text-white">Users</a>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-8">
        @yield('content')
    </main>

</body>
</html>
