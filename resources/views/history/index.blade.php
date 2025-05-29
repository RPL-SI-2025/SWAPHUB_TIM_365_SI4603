@extends('layouts.app')

@section('content')
  <main class="px-4 md:px-24 py-10">
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-gray-800">
        Riwayat <span class="text-blue-600 drop-shadow-md">Penukaran</span>
      </h1>
      <a href="{{ route('penukaran.index') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
        ← Kembali ke Penukaran
      </a>
    </div>

    <form
      class="form-filter mb-6 bg-white p-4 rounded-lg shadow flex flex-col sm:flex-row gap-4 items-center sm:items-end">
      <div class="relative w-full sm:w-1/3">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksimu di sini"
          class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
      </div>

      <div class="w-full sm:w-1/4">
        <select name="kategori" class="w-full border-gray-300 rounded-md shadow-sm">
          <option value="">Semua Produk</option>
          <option value="fashion" {{ request('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
          <option value="outfits" {{ request('kategori') == 'outfits' ? 'selected' : '' }}>Outfits</option>
          <option value="automotive" {{ request('kategori') == 'automotive' ? 'selected' : '' }}>Automotive</option>
          <option value="accessories" {{ request('kategori') == 'accessories' ? 'selected' : '' }}>Accessories
          </option>
          <option value="stationery" {{ request('kategori') == 'stationery' ? 'selected' : '' }}>Stationery</option>
          <option value="books" {{ request('kategori') == 'books' ? 'selected' : '' }}>Books</option>
          <option value="furniture" {{ request('kategori') == 'furniture' ? 'selected' : '' }}>Furniture</option>
          <option value="decoration" {{ request('kategori') == 'decoration' ? 'selected' : '' }}>Decoration</option>
        </select>
      </div>

      <div class="w-full sm:w-1/4">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
      </div>

      <div class="flex space-x-2">
        <button type="reset" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-150 ease-in-out">
          Reset Filter
        </button>
        <a href="{{ route('rating_pengguna.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow transition duration-150 ease-in-out inline-flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
          Lihat Rating
        </a>
      </div>
    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
      <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-tertiary text-white">
          <tr>
            <th class="px-6 py-3">Penawar</th>
            <th class="px-6 py-3">Ditawar</th>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3">Riwayat Penukaran</th>
            <th class="px-6 py-3">Kategori</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Aksi</th>
            <th class="px-6 py-3">Rating</th>
          </tr>
        </thead>
        <tbody>
          @forelse($histories as $history)
            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
              <td class="px-6 py-4">
                {{ $history->penukaran->penawar->full_name ?? '-' }}
              </td>
              <td class="px-6 py-4">
                {{ $history->penukaran->ditawar->full_name ?? '-' }}
              </td>
              <td class="px-6 py-4">
                {{ $history->created_at->format('d M Y') }}
              </td>
              <td class="px-6 py-4">
                Penukaran antara <strong>{{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}</strong> dan
                <strong>{{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}</strong>
              </td>
              <td class="px-6 py-4">
                {{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }} /
                {{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}
              </td>
              <td class="px-6 py-4">
                <span
                  class="px-2 py-1 text-xs font-medium rounded {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                  {{ ucfirst($history->penukaran->status_penukaran) }}
                </span>
              </td>
              <td class="px-6 py-4">
                <a href="{{ route('history.show', $history->id_history) }}"
                  class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-sm px-3 py-1">
                  Detail
                </a>
              </td>
              <td class="px-6 py-4">
                @if($history->penukaran->rating)
                    <span class="inline-flex items-center text-gray-500 bg-gray-200 px-3 py-1.5 rounded-lg text-sm">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Sudah Dirating
                    </span>
                @else
                    <a href="{{ route('rating_pengguna.create', ['id_penukaran' => $history->penukaran->id_penukaran]) }}"
                    class="inline-flex items-center text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm px-3 py-1.5">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Beri Rating
                    </a>
                @endif
            </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                Barang tidak ditemukan sesuai pencarian atau filter.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  {{-- Script Filter --}}
  {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
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

          const matchKeyword = keyword === '' || penawar.includes(keyword) || ditawar.includes(keyword) || produk
            .includes(keyword);
          const matchKategori = kategori === '' || produkKategori.includes(kategori);
          const matchTanggal = tanggal === '' || new Date(dateText).toDateString() === new Date(tanggal)
            .toDateString();

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

      form.addEventListener('reset', function(e) {
        setTimeout(() => {
          filterTable();
        }, 0);
      });
    });
  </script> --}}

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('.form-filter');
      const searchInput = form.querySelector('input[name="search"]');
      const kategoriSelect = form.querySelector('select[name="kategori"]');
      const tanggalInput = form.querySelector('input[name="tanggal"]');
      const rows = document.querySelectorAll('tbody tr');

      function filterTable() {
        const keyword = searchInput.value.toLowerCase();
        const kategori = kategoriSelect.value.toLowerCase();
        const tanggal = tanggalInput.value; // Format: yyyy-mm-dd

        rows.forEach(row => {
          const penawar = row.children[0]?.textContent.toLowerCase();
          const ditawar = row.children[1]?.textContent.toLowerCase();
          const produk = row.children[3]?.textContent.toLowerCase();
          const produkKategori = row.children[4]?.textContent.toLowerCase();
          const dateText = row.children[2]?.textContent.trim(); // e.g. "21 May 2025"

          const rowDate = new Date(dateText);
          const inputDate = new Date(tanggal);

          const matchKeyword = !keyword ||
            penawar.includes(keyword) ||
            ditawar.includes(keyword) ||
            produk.includes(keyword);

          const matchKategori = !kategori || produkKategori.includes(kategori);

          const matchTanggal = !tanggal || (
            rowDate.getFullYear() === inputDate.getFullYear() &&
            rowDate.getMonth() === inputDate.getMonth() &&
            rowDate.getDate() === inputDate.getDate()
          );

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

      form.addEventListener('reset', function() {
        setTimeout(() => {
          searchInput.value = '';
          kategoriSelect.value = '';
          tanggalInput.value = '';
          filterTable();
        }, 0);
      });

      filterTable(); // Jalankan saat pertama kali halaman dimuat
    });
  </script>
@endsection
