<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Barang</h1>

        <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="id_kategori" class="block text-gray-700">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="w-full p-2 border rounded">
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ $barang->id_kategori == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi_barang" class="block text-gray-700">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" id="deskripsi_barang" class="w-full p-2 border rounded" required>{{ $barang->deskripsi_barang }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status_barang" class="block text-gray-700">Status Barang</label>
                <select name="status_barang" id="status_barang" class="w-full p-2 border rounded">
                    <option value="tersedia" {{ $barang->status_barang == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="ditukar" {{ $barang->status_barang == 'ditukar' ? 'selected' : '' }}>Ditukar</option>
                    <option value="dihapus" {{ $barang->status_barang == 'dihapus' ? 'selected' : '' }}>Dihapus</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar Barang</label>
                @if ($barang->gambar)
                    <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-32 h-32 object-cover mb-2">
                @endif
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </form>
    </div>
</body>
</html>