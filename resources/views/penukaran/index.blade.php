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
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
                    ← Kembali
                </a>                
                <h1 class="text-3xl font-bold">Permintaan Tukar Barang</h1>
            </div>
            <a href="{{ route('history.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">History</a>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- Permintaan Masuk -->
        <h2 class="text-xl font-semibold mb-3">Permintaan Masuk</h2>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mb-10">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Mahasiswa Pengaju</th>
                    <th class="p-3 text-left">Barang Anda</th>
                    <th class="p-3 text-left">Barang Ditawarkan</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Pesan</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permintaanMasuk as $penukaran)
                    <tr>
                        <td class="p-3 border-b">{{ $penukaran->penawar->name }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangDitawar->nama_barang }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangPenawar->nama_barang }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangDitawar->kategori }}</td>
                        <td class="p-3 border-b">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
                        <td class="p-3 border-b">
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

        <!-- Penawaran Keluar -->
        <h2 class="text-xl font-semibold mb-3">Penawaran Keluar</h2>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mb-10">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Mahasiswa Tujuan</th>
                    <th class="p-3 text-left">Barang Ditawarkan</th>
                    <th class="p-3 text-left">Barang Diminta</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Pesan</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penawaranKeluar as $penukaran)
                    <tr>
                        <td class="p-3 border-b">{{ $penukaran->ditawar->name }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangPenawar->nama_barang }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangDitawar->nama_barang }}</td>
                        <td class="p-3 border-b">{{ $penukaran->barangPenawar->kategori }}</td>
                        <td class="p-3 border-b">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
                        <td class="p-3 border-b">{{ $penukaran->status_penukaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
