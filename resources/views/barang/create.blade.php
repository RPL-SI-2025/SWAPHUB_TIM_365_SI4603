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

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_kategori" class="block text-gray-700">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="w-full p-2 border rounded">
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi_barang" class="block text-gray-700">Deskripsi Barang</label>
                <textarea name="deskripsi_barang" id="deskripsi_barang" class="w-full p-2 border rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label for="status_barang" class="block text-gray-700">Status Barang</label>
                <select name="status_barang" id="status_barang" class="w-full p-2 border rounded">
                    <option value="tersedia">Tersedia</option>
                    <option value="ditukar">Ditukar</option>
                    <option value="dihapus">Dihapus</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </form>
    </div>
</body>
</html>