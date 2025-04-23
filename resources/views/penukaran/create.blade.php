<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minta Tukar Barang - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Minta Tukar Barang</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4">Barang yang Diinginkan</h2>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    @if ($barang->gambar)
                        <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover rounded">
                    @else
                        <span class="text-gray-500">Tidak ada gambar</span>
                    @endif
                </div>
                <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold">{{ $barang->nama_barang }}</h3>
                    <p class="text-gray-600 mt-2"><strong>Deskripsi:</strong> {{ $barang->deskripsi_barang }}</p>
                    <p class="text-gray-600 mt-2"><strong>Pemilik:</strong> {{ $barang->user->name }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('penukaran.store', $barang->id_barang) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_barang_ditawarkan" class="block text-gray-700">Pilih Barang Anda untuk Ditukar</label>
                <select name="id_barang_ditawarkan" id="id_barang_ditawarkan" class="w-full p-2 border rounded" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($userBarang as $item)
                        <option value="{{ $item->id_barang }}">{{ $item->nama_barang }} - {{ $item->deskripsi_barang }}</option>
                    @endforeach
                </select>
                @error('id_barang_ditawarkan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="pesan_penukaran" class="block text-gray-700">Pesan (Opsional)</label>
                <textarea name="pesan_penukaran" id="pesan_penukaran" class="w-full p-2 border rounded" placeholder="Tambahkan pesan untuk pemilik barang...">{{ old('pesan_penukaran') }}</textarea>
                @error('pesan_penukaran')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Kirim Permintaan</button>
            <a href="{{ route('barang.show', $barang->id_barang) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </form>
    </div>
</body>
</html>