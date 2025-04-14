<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard SwapHub</h1>

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

        @if (!Auth::user()->is_admin)
            <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Barang</a>
        @endif

        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Nama Barang</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Pemilik</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td class="p-3">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-16 h-16 object-cover">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $item->nama_barang }}</td>
                        <td class="p-3">{{ $item->deskripsi_barang }}</td>
                        <td class="p-3">{{ $item->status_barang }}</td>
                        <td class="p-3">{{ $item->user->name }}</td>
                        <td class="p-3">
                            @if (Auth::user()->id == $item->id_user)
                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>