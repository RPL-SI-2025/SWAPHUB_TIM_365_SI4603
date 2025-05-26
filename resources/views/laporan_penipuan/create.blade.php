<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Laporan Penipuan - SwapHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white px-6 py-4 shadow">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/SWAPHUB LOGO.png') }}" alt="logo" class="w-6 h-6">
            <h1 class="text-xl font-bold text-gray-800">SWAPHUB</h1>
        </div>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                <span class="font-medium text-gray-700">{{ Auth::user()->first_name . ' '. Auth::user()->last_name }}</span>
                <img src="{{ asset(Auth::user()->profile_picture ?? 'photo-profile/default.png') }}?t={{ time() }}" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Buat Laporan Penipuan</h2>

            <!-- Notifikasi -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('laporan_penipuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori Laporan</label>
                    <select name="id_kategori" id="id_kategori" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}" {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Pengguna yang Dilaporkan -->
                <div class="mb-4">
                    <label for="id_dilapor" class="block text-sm font-medium text-gray-700 mb-1">Pengguna yang Dilaporkan</label>
                    <select name="id_dilapor" id="id_dilapor" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Pengguna --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_dilapor') == $user->id ? 'selected' : '' }}>
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_dilapor')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Pesan Laporan -->
                <div class="mb-4">
                    <label for="pesan_laporan" class="block text-sm font-medium text-gray-700 mb-1">Pesan Laporan</label>
                    <textarea name="pesan_laporan" id="pesan_laporan" rows="4" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan detail laporan penipuan...">{{ old('pesan_laporan') }}</textarea>
                    @error('pesan_laporan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto Bukti -->
                <div class="mb-4">
                    <label for="foto_bukti" class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto_bukti" id="foto_bukti" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" accept="image/*">
                    @error('foto_bukti')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Kirim Laporan</button>
                    <a href="{{ route('laporan_penipuan.index') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition duration-200">Lihat Histori Laporan</a>
                    <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">Kembali</a>
                </div>
            </form>
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