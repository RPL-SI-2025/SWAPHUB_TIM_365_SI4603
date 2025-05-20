<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan Penipuan - SwapHub</title>
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
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Laporan Penipuan</h2>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Detail Laporan -->
            <div class="space-y-4 text-sm text-gray-800">
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Kategori</div>
                    <div>{{ $laporan->kategori->nama_kategori }}</div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Pelapor</div>
                    <div>{{ $laporan->pelapor->first_name . ' ' . $laporan->pelapor->last_name }}</div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Pengguna yang Dilaporkan</div>
                    <div>{{ $laporan->dilapor->first_name . ' ' . $laporan->dilapor->last_name }}</div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Pesan Laporan</div>
                    <div>{{ $laporan->pesan_laporan }}</div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Foto Bukti</div>
                    <div>
                        @if ($laporan->foto_bukti)
                            <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="w-48 h-48 object-cover rounded">
                        @else
                            Tidak ada foto bukti.
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Status</div>
                    <div>
                        @if ($laporan->status_laporan == 'pending')
                            <span class="text-yellow-600">{{ $laporan->status_laporan }}</span>
                        @elseif ($laporan->status_laporan == 'diterima')
                            <span class="text-green-600">{{ $laporan->status_laporan }}</span>
                        @else
                            <span class="text-red-600">{{ $laporan->status_laporan }}</span>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="font-semibold">Tanggal Dibuat</div>
                    <div>{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 flex gap-3">
                @if (Auth::user()->is_admin || $laporan->id_pelapor == Auth::user()->id)
                    <a href="{{ route('laporan_penipuan.edit', $laporan->id_laporan) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">Edit</a>
                    <form action="{{ route('laporan_penipuan.destroy', $laporan->id_laporan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">Hapus</button>
                    </form>
                @endif
                <a href="{{ route('laporan_penipuan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">Kembali</a>
            </div>
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