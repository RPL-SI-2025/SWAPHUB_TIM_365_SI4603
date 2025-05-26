<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laporan Penipuan - SwapHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-custom th,
        .table-custom td {
            border: 1px solid #e5e7eb;
        }
        .table-custom th:first-child,
        .table-custom td:first-child {
            border-left: none;
        }
        .table-custom th:last-child,
        .table-custom td:last-child {
            border-right: none;
        }
        .table-custom tr:last-child td {
            border-bottom: none;
        }
    </style>
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
    <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-900">Daftar Laporan Penipuan</h2>
                <div class="space-x-4">
                    <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:text-blue-800 underline font-medium">Kembali</a>
                    <a href="{{ route('laporan_penipuan.index') }}" class="text-sm text-gray-600 hover:text-gray-800 underline font-medium">Refresh</a>
                </div>
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

            <!-- Tabel Laporan -->
            @if ($laporan->isEmpty())
                <p class="text-gray-600 text-center py-6 bg-gray-50 rounded-lg">Belum ada laporan penipuan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-custom w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 rounded-tl-lg font-medium text-gray-900">Kategori</th>
                                <th class="px-6 py-3 font-medium text-gray-900">Pelapor</th>
                                <th class="px-6 py-3 font-medium text-gray-900">Dilapor</th>
                                <th class="px-6 py-3 font-medium text-gray-900">Status</th>
                                <th class="px-6 py-3 font-medium text-gray-900">Catatan Admin</th>
                                <th class="px-6 py-3 rounded-tr-lg font-medium text-gray-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr class="bg-white hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4">{{ $item->kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4">{{ $item->pelapor->first_name . ' ' . $item->pelapor->last_name }}</td>
                                    <td class="px-6 py-4">{{ $item->dilapor->first_name . ' ' . $item->dilapor->last_name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($item->status_laporan == 'pending')
                                            <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                                        @elseif ($item->status_laporan == 'diterima')
                                            <span class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                                        @else
                                            <span class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->pesan_admin)
                                            <span class="text-gray-700 text-sm">{{ $item->pesan_admin }}</span>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('laporan_penipuan.show', $item->id_laporan) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M10 0a10 10 0 100 20 10 10 0 000-20zM2 10a8 8 0 1116 0 8 8 0 01-16 0z" clip-rule="evenodd" />
                                            </svg>
                                            Lihat
                                        </a>
                                        @if (Auth::user()->is_admin)
                                            <form action="{{ route('laporan_penipuan.updateStatus', $item->id_laporan) }}" method="POST" class="inline-flex items-center gap-2">
                                                @csrf
                                                <select name="status_laporan" onchange="this.form.submit()" class="border rounded-lg p-1 bg-white text-gray-700 hover:bg-gray-50 transition duration-200 text-sm">
                                                    <option value="pending" {{ $item->status_laporan == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="diterima" {{ $item->status_laporan == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                    <option value="ditolak" {{ $item->status_laporan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                                <input type="text" name="pesan_admin" value="{{ old('pesan_admin', $item->pesan_admin ?? '') }}" placeholder="Masukkan catatan" class="border rounded-lg p-1 w-56 text-sm focus:ring-2 focus:ring-blue-500">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Tombol Buat Laporan (Hanya untuk user) -->
            @if (!Auth::user()->is_admin)
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('laporan_penipuan.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-lg hover:shadow-xl">Buat Laporan Baru</a>
                </div>
            @endif
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