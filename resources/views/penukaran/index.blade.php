<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Tukar Barang - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Permintaan Tukar Barang</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- Permintaan Masuk -->
        <h2 class="text-2xl font-semibold mb-4">Permintaan Masuk</h2>
        @if ($permintaanMasuk->isEmpty())
            <p class="text-gray-600 mb-8">Belum ada permintaan tukar masuk.</p>
        @else
            <table class="w-full bg-white shadow-md rounded mb-8">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3">Mahasiswa Pengaju</th>
                        <th class="p-3">Barang Anda</th>
                        <th class="p-3">Barang Ditawarkan</th>
                        <th class="p-3">Pesan</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaanMasuk as $penukaran)
                        <tr>
                            <td class="p-3">{{ $penukaran->penawar->name }}</td>
                            <td class="p-3">{{ $penukaran->barangDitawar->nama_barang }}</td>
                            <td class="p-3">{{ $penukaran->barangPenawar->nama_barang }}</td>
                            <td class="p-3">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
                            <td class="p-3">{{ $penukaran->status_penukaran }}</td>
                            <td class="p-3">
                                @if ($penukaran->status_penukaran == 'pending')
                                    <form action="{{ route('penukaran.confirm', $penukaran->id_penukaran) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded mr-1" onclick="return confirm('Apakah Anda yakin ingin menerima permintaan ini?')">Terima</button>
                                    </form>
                                    <form action="{{ route('penukaran.reject', $penukaran->id_penukaran) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menolak permintaan ini?')">Tolak</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Penawaran Keluar -->
        <h2 class="text-2xl font-semibold mb-4">Penawaran Keluar</h2>
        @if ($penawaranKeluar->isEmpty())
            <p class="text-gray-600 mb-8">Belum ada penawaran tukar yang diajukan.</p>
        @else
            <table class="w-full bg-white shadow-md rounded mb-8">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3">Mahasiswa Tujuan</th>
                        <th class="p-3">Barang Ditawarkan</th>
                        <th class="p-3">Barang Diminta</th>
                        <th class="p-3">Pesan</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penawaranKeluar as $penukaran)
                        <tr>
                            <td class="p-3">{{ $penukaran->ditawar->name }}</td>
                            <td class="p-3">{{ $penukaran->barangPenawar->nama_barang }}</td>
                            <td class="p-3">{{ $penukaran->barangDitawar->nama_barang }}</td>
                            <td class="p-3">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
                            <td class="p-3">{{ $penukaran->status_penukaran }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-4">
            <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </div>
</body>
</html>