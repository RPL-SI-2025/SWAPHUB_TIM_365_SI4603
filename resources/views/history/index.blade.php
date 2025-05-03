<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Penukaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

<!-- Header -->
<header class="bg-white shadow p-4 flex items-center justify-between border-b-4 border-blue-900">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/SWAPHUB LOGO.png') }}" alt="SWAPHUB Logo" class="h-16 w-16">
        <span class="text-xl font-bold">
            <span class="text-blue-600">SWAP</span><span class="text-blue-900">HUB</span>
        </span>
    </div>    
    <div class="flex items-center gap-4">
        <button class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 8 7.388 8 9v5.159c0 .538-.214 1.055-.595 1.436L6 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </button>
        <span class="text-gray-700 font-medium">
            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
        </span>
        <img src="{{ Auth::user()->profile_photo ?? asset('photo-profile/default.png') }}" alt="Profile" class="h-10 w-10 rounded-full object-cover">
    </div>
</header>

<main class="flex-1">
    <div class="container mx-auto px-4 py-6">

        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Riwayat <span class="text-blue-600 drop-shadow-md">Penukaran</span>
            </h1>
            <a href="{{ route('penukaran.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
                ← Kembali ke Penukaran
            </a>
        </div>

        <form class="mb-6 bg-white p-4 rounded-lg shadow flex flex-col sm:flex-row gap-4 items-center sm:items-end">
            <div class="relative w-full sm:w-1/3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksimu di sini"
                       class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            <div class="w-full sm:w-1/4">
                <select name="kategori" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Produk</option>
                    <option value="fashion" {{ request('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="outfits" {{ request('kategori') == 'outfits' ? 'selected' : '' }}>Outfits</option>
                    <option value="automotive" {{ request('kategori') == 'automotive' ? 'selected' : '' }}>Automotive</option>
                    <option value="accessories" {{ request('kategori') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                    <option value="stationery" {{ request('kategori') == 'stationery' ? 'selected' : '' }}>Stationery</option>
                    <option value="books" {{ request('kategori') == 'books' ? 'selected' : '' }}>Books</option>
                    <option value="furniture" {{ request('kategori') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="decoration" {{ request('kategori') == 'decoration' ? 'selected' : '' }}>Decoration</option>
                </select>
            </div>

            <div class="w-full sm:w-1/4">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <button type="reset" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Reset Filter
                </button>
            </div>
        </form>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-blue-900 text-white">
                <tr>
                    <th class="px-6 py-3">Penawar</th>
                    <th class="px-6 py-3">Ditawar</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Riwayat Penukaran</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($histories as $history)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $history->penukaran->penawar->first_name ?? '-' }} {{ $history->penukaran->penawar->last_name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $history->penukaran->ditawar->first_name ?? '-' }} {{ $history->penukaran->ditawar->last_name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $history->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            Penukaran antara <strong>{{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}</strong> dan <strong>{{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}</strong>
                        </td>
                        <td class="px-6 py-4">
                            {{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }} / {{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium rounded {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                                {{ ucfirst($history->penukaran->status_penukaran) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('history.show', $history->id_history) }}"
                               class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-3 py-1">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Barang tidak ditemukan sesuai pencarian atau filter.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-blue-900 text-white w-full mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Judul Atas -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">
                <span class="text-white">"SwapHub</span> - 
                <span class="text-blue-400">Swap, Use, Save, Sustain</span>
                <span class="text-white">!"</span>
            </h2>
        </div>

        <!-- Garis -->
        <hr class="border-t border-white opacity-30 my-6">

        <!-- Isi Footer -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

            <!-- Kiri -->
        <div class="flex flex-col items-center md:items-start">
            <p class="text-gray-400 mb-4 text-center md:text-left">© 2020 Landify UI Kit.<br>All rights reserved.</p>

            <!-- Logo SWAPHUB -->
            <div class="flex items-center space-x-2 mt-2">
                <img src="{{asset('images/SWAPHUB LOGO.png')}}" alt="SWAPHUB Logo" class="h-16 w-16">
                <span class="text-2xl font-bold">
                    <span class="text-blue-400">SWAP</span><span class="text-gray-400">HUB</span>
                </span>
            </div>
        </div>

            <!-- Tengah -->
            <div class="flex flex-col md:flex-row justify-center gap-12">
                <div>
                    <h4 class="font-semibold mb-3">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">About us</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                        <li><a href="#" class="hover:text-white">Contact us</a></li>
                        <li><a href="#" class="hover:text-white">Pricing</a></li>
                        <li><a href="#" class="hover:text-white">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Help center</a></li>
                        <li><a href="#" class="hover:text-white">Terms of service</a></li>
                        <li><a href="#" class="hover:text-white">Legal</a></li>
                        <li><a href="#" class="hover:text-white">Privacy policy</a></li>
                        <li><a href="#" class="hover:text-white">Rating & Review</a></li>
                    </ul>
                </div>
            </div>

            <!-- Kanan -->
            <div class="flex flex-col items-center md:items-end">
                <h4 class="font-semibold mb-3">Stay up to date</h4>
                <form class="flex w-full max-w-xs">
                    <input type="email" placeholder="Your email address"
                           class="flex-1 px-4 py-2 rounded-l-md bg-blue-800 text-white placeholder-gray-400 focus:outline-none">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-r-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</footer>

</body>
</html>
