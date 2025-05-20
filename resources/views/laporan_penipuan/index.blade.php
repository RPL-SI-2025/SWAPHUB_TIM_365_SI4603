<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laporan Penipuan - SwapHub</title>
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
    <div class="max-w-6xl mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Laporan Penipuan</h2>

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

            <!-- Tabel Laporan -->
            @if ($laporan->isEmpty())
                <p class="text-gray-600">Belum ada laporan penipuan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Kategori</th>
                                <th scope="col" class="px-6 py-3">Pelapor</th>
                                <th scope="col" class="px-6 py-3">Dilapor</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $item->kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4">{{ $item->pelapor->first_name . ' ' . $item->pelapor->last_name }}</td>
                                    <td class="px-6 py-4">{{ $item->dilapor->first_name . ' ' . $item->dilapor->last_name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($item->status_laporan == 'pending')
                                            <span class="text-yellow-600">{{ $item->status_laporan }}</span>
                                        @elseif ($item->status_laporan == 'diterima')
                                            <span class="text-green-600">{{ $item->status_laporan }}</span>
                                        @else
                                            <span class="text-red-600">{{ $item->status_laporan }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('laporan_penipuan.show', $item->id_laporan) }}" class="text-blue-600 hover:underline">Lihat</a>
                                        @if (Auth::user()->is_admin || $item->id_pelapor == Auth::user()->id)
                                            <a href="{{ route('laporan_penipuan.edit', $item->id_laporan) }}" class="text-green-600 hover:underline">Edit</a>
                                            <form action="{{ route('laporan_penipuan.destroy', $item->id_laporan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        @endif
                                        @if (Auth::user()->is_admin)
                                            <form action="{{ route('laporan_penipuan.updateStatus', $item->id_laporan) }}" method="POST">
                                                @csrf
                                                <select name="status_laporan" onchange="this.form.submit()" class="border rounded p-1">
                                                    <option value="pending" {{ $item->status_laporan == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="diterima" {{ $item->status_laporan == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                    <option value="ditolak" {{ $item->status_laporan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
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
                <div class="mt-4">
                    <a href="{{ route('laporan_penipuan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Buat Laporan Baru</a>
                </div>
            @endif
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