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

        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="id_kategori" class="block text-gray-700">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="w-full p-2 border rounded">
                    <option value="">Pilih Kategori</option>
                    @if ($kategori->isEmpty())
                        <option value="" disabled>Tidak ada kategori tersedia</option>
                    @else
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    @endif
                </select>
                @error('id_kategori')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" class="w-full p-2 border rounded" required>
                @error('nama_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_barang" class="block text-gray-700">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" id="deskripsi_barang" class="w-full p-2 border rounded" required>{{ old('deskripsi_barang') }}</textarea>
                @error('deskripsi_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status_barang" class="block text-gray-700">Status Barang</label>
                <select name="status_barang" id="status_barang" class="w-full p-2 border rounded">
                    <option value="tersedia" {{ old('status_barang') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="ditukar" {{ old('status_barang') == 'ditukar' ? 'selected' : '' }}>Ditukar</option>
                    <option value="dihapus" {{ old('status_barang') == 'dihapus' ? 'selected' : '' }}>Dihapus</option>
                </select>
                @error('status_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar Barang</label>
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border rounded">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </form>
    </div>
</body>
</html>