<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Tambah Barang</h1>

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="w-full border rounded p-2 @error('nama_barang') border-red-500 @enderror" value="{{ old('nama_barang') }}">
                @error('nama_barang')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_barang" class="block text-gray-700">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" id="deskripsi_barang" class="w-full border rounded p-2 @error('deskripsi_barang') border-red-500 @enderror">{{ old('deskripsi_barang') }}</textarea>
                @error('deskripsi_barang')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status_barang" class="block text-gray-700">Status Barang</label>
                <select name="status_barang" id="status_barang" class="w-full border rounded p-2 @error('status_barang') border-red-500 @enderror">
                    <option value="tersedia" {{ old('status_barang') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status_barang') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status_barang')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="is_gift" class="block text-gray-700">Tipe Barang</label>
                <select name="is_gift" id="is_gift" class="w-full border rounded p-2 @error('is_gift') border-red-500 @enderror">
                    <option value="0" {{ old('is_gift') == '0' ? 'selected' : '' }}>Barang Biasa</option>
                    <option value="1" {{ old('is_gift') == '1' ? 'selected' : '' }}>Barang dengan Bonus</option>
                </select>
                @error('is_gift')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori" class="block text-gray-700">Kategori Barang</label>
                <select name="kategori" id="kategori" class="w-full border rounded p-2 @error('kategori') border-red-500 @enderror">
                    <option value="" {{ old('kategori') == '' ? 'selected' : '' }} disabled>Pilih Kategori</option>
                    @foreach (['Fashion', 'Outfits', 'Automotive', 'Accessories', 'Stationery', 'Books', 'Furniture', 'Decoration'] as $kategori)
                        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar Barang</label>
                <input type="file" name="gambar" id="gambar" class="w-full border rounded p-2 @error('gambar') border-red-500 @enderror">
                @error('gambar')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                <a href="{{ route('home') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>