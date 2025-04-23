<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Penukaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-6">
        <!-- Tombol kembali + judul -->
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('history.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
                ← Kembali
            </a>
            <h2 class="text-2xl font-semibold text-gray-800">Detail Riwayat Penukaran</h2>
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
                    <div class="bg-gray-50 p-4 rounded-lg">
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
                    <div class="bg-gray-50 p-4 rounded-lg">
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

</body>
</html>
