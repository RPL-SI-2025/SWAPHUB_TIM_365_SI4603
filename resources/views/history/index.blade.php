<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Penukaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-6">
        <header class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Penukaran</h2>
        </header>

        {{-- Filter Tanggal --}}
        <form method="GET" action="{{ route('history.index') }}" class="mb-6 bg-white p-4 rounded shadow-md flex gap-4 items-end">
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            </div>
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Filter
                </button>
            </div>
        </form>

        {{-- Tabel Riwayat --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Riwayat Penukaran</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $history)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ $history->penukaran_barang->user->first_name ?? '-' }} {{ $history->penukaran_barang->user->last_name ?? '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $history->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                Penukaran antara 
                                <strong>{{ $history->penukaran_barang->barang_penawar->nama_barang ?? '-' }}</strong> 
                                dan 
                                <strong>{{ $history->penukaran_barang->barang_ditawar->nama_barang ?? '-' }}</strong>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded 
                                    {{ $history->penukaran_barang->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran_barang->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                                    {{ ucfirst($history->penukaran_barang->status_penukaran) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex flex-wrap gap-2">
                                <a href="{{ route('history.edit', $history->id_history) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm px-3 py-1">
                                    Edit
                                </a>
                                <form action="{{ route('history.destroy', $history->id_history) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-sm px-3 py-1">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data riwayat penukaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>
</html>
