<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan Penipuan - SwapHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <!-- Header -->
    <div class="flex items-center justify-between bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 shadow-lg text-gray-900">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/SWAPHUB LOGO.png') }}" alt="logo" class="w-10 h-10">
            <h1 class="text-2xl font-bold">SWAPHUB</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-90 transition">
                <span class="font-medium">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                <img src="{{ asset(Auth::user()->profile_picture ?? 'photo-profile/default.png') }}?t={{ time() }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover border-2 border-gray-300">
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-900">Detail Laporan Penipuan</h2>
                <a href="{{ route('laporan_penipuan.index') }}" class="flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L9.586 10l-2.293 2.293a1 1 0 101.414 1.414L11 11.414l2.293 2.293a1 1 0 001.414-1.414L12.414 10l2.293-2.293a1 1 0 00-1.414-1.414L11 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    Kembali
                </a>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm shadow-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm shadow-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Detail Laporan -->
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Kategori Laporan</label>
                        <p class="mt-1 text-gray-900 font-medium">{{ $laporan->kategori->nama_kategori }}</p>
                    </div>
                    <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Pelapor</label>
                        <p class="mt-1 text-gray-900 font-medium">{{ $laporan->pelapor->first_name . ' ' . $laporan->pelapor->last_name }}</p>
                    </div>
                    <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Pengguna yang Dilaporkan</label>
                        <p class="mt-1 text-gray-900 font-medium">{{ $laporan->dilapor->first_name . ' ' . $laporan->dilapor->last_name }}</p>
                    </div>
                    <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Status Laporan</label>
                        <p class="mt-1 text-gray-900">
                            @if ($laporan->status_laporan == 'pending')
                                <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">{{ $laporan->status_laporan }}</span>
                            @elseif ($laporan->status_laporan == 'diterima')
                                <span class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">{{ $laporan->status_laporan }}</span>
                            @else
                                <span class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">{{ $laporan->status_laporan }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700">Pesan Laporan</label>
                    <p class="mt-1 text-gray-900">{{ $laporan->pesan_laporan }}</p>
                </div>
                <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700">Foto Bukti</label>
                    @if ($laporan->foto_bukti)
                        <img src="{{ asset('storage/' . $laporan->foto_bukti) }}" alt="Foto Bukti" class="mt-2 w-full max-w-lg h-auto object-cover rounded-lg shadow-lg border border-gray-300">
                    @else
                        <p class="mt-1 text-gray-500">Tidak ada foto bukti.</p>
                    @endif
                </div>
                @if ($laporan->pesan_admin)
                    <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Catatan dari Admin</label>
                        <p class="mt-1 text-gray-700">{{ $laporan->pesan_admin }}</p>
                    </div>
                @endif
                <div class="border border-gray-200 p-4 rounded-lg bg-gray-50">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                    <p class="mt-1 text-gray-900">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('laporan_penipuan.index') }}" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L9.586 10l-2.293 2.293a1 1 0 101.414 1.414L11 11.414l2.293 2.293a1 1 0 001.414-1.414L12.414 10l2.293-2.293a1 1 0 00-1.414-1.414L11 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-12 text-center text-sm text-gray-600 py-4 bg-white shadow-inner border-t border-gray-200">
        <hr class="border-gray-300 mb-2">
        <p><strong class="text-gray-800">SwapHub</strong> — Swap, Use, Save, Sustain!</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>