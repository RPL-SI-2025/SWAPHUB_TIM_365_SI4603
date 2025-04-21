<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SwapHub Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <div class="flex items-center justify-between bg-white px-6 py-4 shadow">
        <div class="flex items-center gap-2">
            <img src="https://www.svgrepo.com/show/499963/arrows-retweet.svg" alt="logo" class="w-6 h-6">
            <h1 class="text-xl font-bold text-gray-800">SWAPHUB</h1>
        </div>
          <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-80 transition">
            <span class="font-medium text-gray-700">Tom Cook</span>
            <img src="https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg" alt="profile" class="w-8 h-8 rounded-full">
          </a>
    </div>

    <!-- Search Bar -->
    <div class="max-w-3xl mx-auto mt-6 px-4">
        <input type="text" placeholder="Search"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Category Icons -->
    <div class="flex justify-center gap-4 mt-6 flex-wrap px-4">
        @php
            $categories = ['Fashion', 'Gadget', 'Others', 'Cosmetics', 'Accessories', 'Stationery', 'Books', 'Furniture', 'Decoration'];
        @endphp
        @foreach ($categories as $category)
            <div class="flex flex-col items-center text-sm text-gray-600">
                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mb-1">
                    <img src="https://www.svgrepo.com/show/506921/box.svg" class="w-5 h-5" alt="">
                </div>
                {{ $category }}
            </div>
        @endforeach
    </div>

    <!-- Just For You Section -->
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Just For You</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="bg-gray-200 h-36 mb-4 flex items-center justify-center">
                        <span class="text-gray-400">[Image]</span>
                    </div>
                    <p class="font-semibold text-sm">Nama Barang</p>
                    <p class="text-xs text-gray-500">Nama User</p>
                    <p class="text-xs text-gray-400 mt-1">Lorem ipsum dolor sit amet, consectetur</p>
                </div>
            @endfor
        </div>
    </div>

    <!-- With Bonus Item Section -->
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-1">
            With Bonus Item
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11 0h2v24h-2z"/><path d="M0 11h24v2h-24z"/>
            </svg>
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="bg-gray-200 h-36 mb-4 flex items-center justify-center">
                        <span class="text-gray-400">[Image]</span>
                    </div>
                    <p class="font-semibold text-sm">Nama Barang</p>
                    <p class="text-xs text-gray-500">Nama User</p>
                    <p class="text-xs text-gray-400 mt-1">Lorem ipsum dolor sit amet, consectetur</p>
                </div>
            @endfor
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-12 text-center text-sm text-gray-600 py-4">
        <hr class="mb-2 border-gray-300">
        <p><strong>SwapHub</strong> — Swap, Use, Save, Sustain!</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
