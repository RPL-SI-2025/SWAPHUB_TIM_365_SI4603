<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Detail Barang</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow-md">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    @if ($barang->gambar)
                        <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover rounded">
                    @else
                        <span class="text-gray-500">Tidak ada gambar</span>
                    @endif
                </div>
                <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
                    <h2 class="text-2xl font-semibold">{{ $barang->nama_barang }}</h2>
                    <p class="text-gray-600 mt-2"><strong>Deskripsi:</strong> {{ $barang->deskripsi_barang }}</p>
                    <p class="text-gray-600 mt-2"><strong>Status:</strong> {{ $barang->status_barang }}</p>
                    <p class="text-gray-600 mt-2"><strong>Pemilik:</strong> {{ $barang->user->name }}</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Kembali</a>
                @if (Auth::user()->id != $barang->id_user && $barang->status_barang == 'tersedia')
                    <a href="{{ route('penukaran.create', $barang->id_barang) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Minta Tukar</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>