<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Penukaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-6">
        <header class="mb-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('penukaran.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
                    ← Kembali ke Penukaran
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Riwayat Penukaran</h2>
            </div>
        </header>
        

        {{-- Filter Tanggal --}}
        <form class="mb-6 bg-white p-4 rounded-lg shadow flex flex-col sm:flex-row gap-4 items-center sm:items-end">
            {{-- Search Input --}}
            <div class="relative w-full sm:w-1/3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksimu di sini"
                    class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            </div>
        
            {{-- Dropdown Kategori Produk (jika ada kategori) --}}
            <div class="w-full sm:w-1/4">
                <select name="kategori" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Produk</option>
                    <option value="fashion" {{ request('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="outfits" {{ request('kategori') == 'outfits' ? 'selected' : '' }}>Outfits</option>
                    <option value="automotive" {{ request('kategori') == 'automotive' ? 'selected' : '' }}>Automotive</option>
                    <option value="accessories" {{ request('kategori') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                    <option value="stationery" {{ request('kategori') == 'stationery' ? 'selected' : '' }}>Stationery</option>
                    <option value="books" {{ request('kategori') == 'books' ? 'selected' : '' }}>Books</option>
                    <option value="furniture" {{ request('kategori') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="decoration" {{ request('kategori') == 'decoration' ? 'selected' : '' }}>Decoration</option>
                </select>
            </div>
            
        
            {{-- Date Picker --}}
            <div class="w-full sm:w-1/4">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            </div>
        
            <div>
                <button type="reset" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Reset Filter
                </button>
            </div>
        </form>
        

{{-- Tabel Riwayat --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
    <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3">Penawar</th>
                <th class="px-6 py-3">Ditawar</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Riwayat Penukaran</th>
                <th class="px-6 py-3">Kategori</th> <!-- Tambahan -->
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($histories as $history)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">
                        {{ $history->penukaran->penawar->First_Name ?? '-' }} {{ $history->penukaran->penawar->Last_Name ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $history->penukaran->ditawar->First_Name ?? '-' }} {{ $history->penukaran->ditawar->Last_Name ?? '' }}
                    </td>                            
                    <td class="px-6 py-4">
                        {{ $history->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        Penukaran antara 
                        <strong>{{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}</strong> 
                        dan 
                        <strong>{{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}</strong>
                    </td>
                    <td class="px-6 py-4"> <!-- Tambahan -->
                        {{ $history->penukaran->barangPenawar->kategori ?? '-' }} / {{ $history->penukaran->barangDitawar->kategori ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded 
                            {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                            {{ ucfirst($history->penukaran->status_penukaran) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('history.show', $history->id_history) }}" 
                               class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-3 py-1">
                                Detail
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500"> <!-- ubah colspan jadi 7 -->
                        Barang tidak ditemukan sesuai pencarian atau filter.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const searchInput = form.querySelector('input[name="search"]');
            const kategoriSelect = form.querySelector('select[name="kategori"]');
            const tanggalInput = form.querySelector('input[name="tanggal"]');
            const rows = document.querySelectorAll('tbody tr');
    
            function filterTable() {
                const keyword = searchInput.value.toLowerCase();
                const kategori = kategoriSelect.value.toLowerCase();
                const tanggal = tanggalInput.value;
    
                rows.forEach(row => {
                    const penawar = row.children[0]?.textContent.toLowerCase();
                    const ditawar = row.children[1]?.textContent.toLowerCase();
                    const dateText = row.children[2]?.textContent.trim();
                    const produk = row.children[3]?.textContent.toLowerCase();
                    const produkKategori = row.children[4]?.textContent.toLowerCase();
    
                    const matchKeyword = keyword === '' || penawar.includes(keyword) || ditawar.includes(keyword) || produk.includes(keyword);
                    const matchKategori = kategori === '' || produkKategori.includes(kategori);
                    const matchTanggal = tanggal === '' || new Date(dateText).toDateString() === new Date(tanggal).toDateString();
    
                    if (matchKeyword && matchKategori && matchTanggal) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
    
            searchInput.addEventListener('input', filterTable);
            kategoriSelect.addEventListener('change', filterTable);
            tanggalInput.addEventListener('change', filterTable);
    
            form.addEventListener('reset', function (e) {
                setTimeout(() => {
                    filterTable();
                }, 0); 
            });
        });
    </script>
    
    
</body>
</html>
