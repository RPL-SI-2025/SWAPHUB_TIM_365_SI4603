<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Penukaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-6">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Detail Riwayat Penukaran</h2>
        </div>

        <div class="bg-white p-6 rounded-lg shadow space-y-6">
            <div>
                <h4 class="text-lg font-semibold text-gray-700">Informasi Pengguna</h4>
                <p><strong>Nama:</strong> {{ $history->penukaran_barang->user->first_name }} {{ $history->penukaran_barang->user->last_name }}</p>
                <p><strong>Email:</strong> {{ $history->penukaran_barang->user->email }}</p>
                <p><strong>Telepon:</strong> {{ $history->penukaran_barang->user->phone }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700">Detail Penukaran</h4>
                <p><strong>Pesan Penukaran:</strong> {{ $history->penukaran_barang->pesan_penukaran }}</p>
                <p><strong>Status Penukaran:</strong>
                    <span class="inline-block px-2 py-1 text-sm font-medium rounded
                        {{ $history->penukaran_barang->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran_barang->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                        {{ ucfirst($history->penukaran_barang->status_penukaran) }}
                    </span>
                </p>
                <p><strong>Tanggal Penukaran:</strong> {{ $history->created_at->format('d M Y - H:i') }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-gray-700">Barang yang Ditukar</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="font-medium mb-2">Barang Penawar</h5>
                        <p><strong>Nama:</strong> {{ $history->penukaran_barang->barang_penawar->nama_barang ?? '-' }}</p>
                        <p><strong>Deskripsi:</strong> {{ $history->penukaran_barang->barang_penawar->deskripsi_barang ?? '-' }}</p>
                        @if($history->penukaran_barang->barang_penawar->gambar)
                            <img src="{{ asset('storage/' . $history->penukaran_barang->barang_penawar->gambar) }}" alt="Gambar Barang Penawar" class="mt-2 w-40 rounded">
                        @endif
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="font-medium mb-2">Barang Ditawar</h5>
                        <p><strong>Nama:</strong> {{ $history->penukaran_barang->barang_ditawar->nama_barang ?? '-' }}</p>
                        <p><strong>Deskripsi:</strong> {{ $history->penukaran_barang->barang_ditawar->deskripsi_barang ?? '-' }}</p>
                        @if($history->penukaran_barang->barang_ditawar->gambar)
                            <img src="{{ asset('storage/' . $history->penukaran_barang->barang_ditawar->gambar) }}" alt="Gambar Barang Ditawar" class="mt-2 w-40 rounded">
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('history.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</body>
</html>
