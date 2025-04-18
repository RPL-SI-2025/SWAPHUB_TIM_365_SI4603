<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SwapHub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">SWAPHUB</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</button>
            </form>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-8">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-8">{{ session('error') }}</div>
        @endif

        @if (Auth::user()->unreadNotifications->isNotEmpty())
            @foreach (Auth::user()->unreadNotifications as $notification)
                <div class="bg-blue-500 text-white p-4 rounded mb-8 flex justify-between items-center">
                    <span>{{ $notification->data['message'] }}</span>
                    <a href="{{ $notification->data['url'] }}" onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();" class="text-white underline">Tandai Dibaca</a>
                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notification.read', $notification->id) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endforeach
        @endif

        <!-- Tombol Tambah Barang dan Lihat Permintaan Tukar -->
        @if (!Auth::user()->is_admin)
            <div class="flex justify-end mb-8 space-x-4">
                <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Barang</a>
                <a href="{{ route('penukaran.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Lihat Permintaan Tukar</a>
            </div>
        @endif

        <!-- Kategori (Statis) -->
        <div class="flex justify-center space-x-4 mb-8">
            <button class="text-gray-600 hover:text-gray-800">Fashion</button>
            <button class="text-gray-600 hover:text-gray-800">Outfits</button>
            <button class="text-gray-600 hover:text-gray-800">Automotive</button>
            <button class="text-gray-600 hover:text-gray-800">Accessories</button>
            <button class="text-gray-600 hover:text-gray-800">Stationery</button>
            <button class="text-gray-600 hover:text-gray-800">Books</button>
            <button class="text-gray-600 hover:text-gray-800">Furniture</button>
            <button class="text-gray-600 hover:text-gray-800">Decoration</button>
        </div>

        <!-- Seksi Just For You -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Just For You</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @foreach ($barang->where('is_gift', false) as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500">Gambar Tidak Tersedia</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->nama_barang }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($item->deskripsi_barang, 50) }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('barang.show', $item->id_barang) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Lihat</a>
                            @if (Auth::user()->id == $item->id_user && $item->status_barang != 'ditukar')
                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Seksi With Bonus Item -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">With Bonus Item 🎁</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @foreach ($barang->where('is_gift', true) as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500">Gambar Tidak Tersedia</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->nama_barang }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($item->deskripsi_barang, 50) }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('barang.show', $item->id_barang) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Lihat</a>
                            @if (Auth::user()->id == $item->id_user && $item->status_barang != 'ditukar')
                                <a href="{{ route('barang.edit', $item->id_barang) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="text-center text-gray-600 mt-12">
            <p>"SWAPHUB – SWAP, USE, SAVE, SUSTAIN!"</p>
        </div>
    </div>
</body>
</html>