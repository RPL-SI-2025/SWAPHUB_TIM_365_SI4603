<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Penukaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-white shadow p-4 flex items-center justify-between border-b-4 border-blue-900">
    <div class="flex items-center gap-2">
        <img src="{{asset('images/SWAPHUB LOGO.png')}}" alt="SWAPHUB Logo" class="h-16 w-16">
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
            {{ Auth::user()->name ?? 'Guest' }}
        </span>        
        <img src="{{ Auth::user()->profile_photo }}" alt="Profile" class="h-10 w-10 rounded-full object-cover">
    </div>
</header>

<!-- Main Content -->
<main class="flex-1">
    <div class="container mx-auto px-4 py-6">

        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Detail Riwayat <span class="text-blue-600 drop-shadow-md">Penukaran</span>
            </h1>
            <a href="{{ route('history.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
                ← Kembali ke Riwayat
            </a>
        </div>
    

    <div class="bg-white p-6 rounded-lg shadow space-y-6">
        <div>
            <h4 class="text-lg font-semibold text-gray-700">Detail Penukaran</h4>
            <p><strong>Pesan Penukaran:</strong> {{ $history->penukaran->pesan_penukaran }}</p>
            <p><strong>Status Penukaran:</strong>
                <span class="inline-block px-2 py-1 text-sm font-medium rounded
                    {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                    {{ ucfirst($history->penukaran->status_penukaran) }}
                </span>
            </p>
            <p><strong>Tanggal Penukaran:</strong> {{ $history->created_at->format('d M Y - H:i') }}</p>
        </div>

        <div>
            <h4 class="text-lg font-semibold text-gray-700">Barang yang Ditukar</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Barang Penawar -->
                <div class="bg-blue-900 p-4 rounded-lg text-white">
                    <h5 class="font-medium mb-2">Barang Penawar</h5>
                    <p><strong>Nama:</strong> {{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}</p>
                    <p><strong>Deskripsi:</strong> {{ $history->penukaran->barangPenawar->deskripsi_barang ?? '-' }}</p>
                    <p><strong>Kategori:</strong> {{ $history->penukaran->barangPenawar->kategori ?? '-' }}</p>
                    <p><strong>Pemilik:</strong> {{ $history->penukaran->barangPenawar->user->First_Name }} {{ $history->penukaran->barangPenawar->user->Last_Name }}</p>
                    @if($history->penukaran->barangPenawar->gambar)
                        <img src="{{ asset('storage/' . $history->penukaran->barangPenawar->gambar) }}" alt="Gambar Barang Penawar" class="mt-2 w-40 rounded">
                    @endif
                </div>
            
                <!-- Barang Ditawar -->
                <div class="bg-blue-900 p-4 rounded-lg text-white">
                    <h5 class="font-medium mb-2">Barang Ditawar</h5>
                    <p><strong>Nama:</strong> {{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}</p>
                    <p><strong>Deskripsi:</strong> {{ $history->penukaran->barangDitawar->deskripsi_barang ?? '-' }}</p>
                    <p><strong>Kategori:</strong> {{ $history->penukaran->barangDitawar->kategori ?? '-' }}</p>
                    <p><strong>Pemilik:</strong> {{ $history->penukaran->barangDitawar->user->First_Name }} {{ $history->penukaran->barangDitawar->user->Last_Name }}</p>
                    @if($history->penukaran->barangDitawar->gambar)
                        <img src="{{ asset('storage/' . $history->penukaran->barangDitawar->gambar) }}" alt="Gambar Barang Ditawar" class="mt-2 w-40 rounded">
                    @endif
                </div>
            </div>            
        </div>
    </div>
</div>

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
