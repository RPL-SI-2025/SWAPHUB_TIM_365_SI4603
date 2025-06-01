@extends('layouts.app')

@section('content')
  <main class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50">
    <div class="px-4 md:px-24 py-10 space-y-8">
      <!-- Header Section with enhanced design -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-8">
        <div class="flex items-center space-x-3">
          <div class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg"></div>
          <h1 class="text-3xl font-bold text-gray-800">
            Riwayat <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">Penukaran</span>
          </h1>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
          <a href="{{ route('rating_pengguna.index') }}" 
            class="group inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Lihat Rating
          </a>
          <a href="{{ route('penukaran.index') }}"
            class="group inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Penukaran
          </a>
        </div>
      </div>

      <!-- Enhanced Filter Section -->
      <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
        <form class="space-y-6" id="form-filter">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Search Input with enhanced design -->
            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700">Cari Transaksi</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" 
                      fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="pl-10 w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Cari berdasarkan nama produk/user">
              </div>
            </div>

            <!-- Category Select with enhanced design -->
            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700">Kategori</label>
              <select name="kategori" 
                      class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                  <option value="{{ $category->nama_kategori }}" {{ request('kategori') == $category->nama_kategori ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Date Input with enhanced design -->
            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700">Tanggal</label>
              <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>
          </div>

          <!-- Action Buttons with enhanced design -->
          <div class="flex justify-end">
            <button type="reset" 
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 transform hover:-translate-y-0.5">
              Reset Filter
            </button>
          </div>
        </form>
      </div>

      <!-- Enhanced Table Section -->
      <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
        <div class="min-w-full overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr class="bg-gradient-to-r from-blue-900 to-blue-800">
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6 first:rounded-tl-3xl">Penawar</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Ditawar</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Tanggal</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/4">Riwayat Penukaran</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Kategori</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12">Status</th>
                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12 last:rounded-tr-3xl">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($histories as $history)
              <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                <td class="px-4 py-4">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                      <span class="text-blue-600 font-medium">{{ substr($history->penukaran->penawar->first_name ?? 'U', 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                      <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                        {{ $history->penukaran->penawar->full_name ?? '-' }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                      <span class="text-gray-600 font-medium">{{ substr($history->penukaran->ditawar->first_name ?? 'U', 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                      <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                        {{ $history->penukaran->ditawar->full_name ?? '-' }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <div class="text-sm text-gray-900">{{ $history->created_at->format('d M Y') }}</div>
                  <div class="text-xs text-gray-500">{{ $history->created_at->format('H:i') }}</div>
                </td>
                <td class="px-4 py-4">
                  <div class="text-sm">
                    <p class="font-medium text-gray-900 mb-1 truncate max-w-[200px]" title="{{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}">
                      {{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}
                    </p>
                    <p class="text-gray-500 flex items-center truncate max-w-[200px]" title="{{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}">
                      <svg class="w-4 h-4 mr-1 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                      </svg>
                      {{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}
                    </p>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <div class="text-sm">
                    <p class="text-gray-900 truncate max-w-[150px]" title="{{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }}">
                      {{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }}
                    </p>
                    <p class="text-gray-500 truncate max-w-[150px]" title="{{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}">
                      {{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}
                    </p>
                  </div>
                </td>
                <td class="px-4 py-4">
                  <span class="px-3 py-1.5 text-sm font-medium rounded-full inline-flex items-center
                            {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-100 text-green-800' : 
                              ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-100 text-red-800' : 
                              'bg-yellow-100 text-yellow-800') }}">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="{{ $history->penukaran->status_penukaran === 'diterima' ? 'M5 13l4 4L19 7' : 
                                ($history->penukaran->status_penukaran === 'ditolak' ? 'M6 18L18 6M6 6l12 12' : 
                                'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z') }}"/>
                    </svg>
                      {{ ucfirst($history->penukaran->status_penukaran) }}
                  </span>
                </td>
                <td class="px-4 py-4">
                  <a href="{{ route('history.show', $history->id_history) }}"
                      class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-4 py-8 text-center">
                  <div class="flex flex-col items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500 text-sm">Barang tidak ditemukan sesuai pencarian atau filter.</p>
                  </div>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Enhanced Rating Actions Section -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($histories as $history)
          @php
            $userRating = null;
            if (Auth::id() === $history->penukaran->id_penawar) {
                $userRating = App\Models\RatingPengguna::where('id_penukaran_barang', $history->penukaran->id_penukaran)
                    ->where('id_user', Auth::id())
                    ->where('rating_type', 'penawar')
                    ->first();
            } elseif (Auth::id() === $history->penukaran->id_ditawar) {
                $userRating = App\Models\RatingPengguna::where('id_penukaran_barang', $history->penukaran->id_penukaran)
                    ->where('id_user', Auth::id())
                    ->where('rating_type', 'ditawar')
                    ->first();
            }
          @endphp

          @if($history->penukaran->status_penukaran === 'diterima' && 
              (Auth::id() === $history->penukaran->id_penawar || Auth::id() === $history->penukaran->id_ditawar))
            <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
              <div class="mb-4">
                <h3 class="text-sm font-medium text-gray-900 line-clamp-2">
                  {{ $history->penukaran->barangPenawar->nama_barang }} dengan {{ $history->penukaran->barangDitawar->nama_barang }}
                </h3>
                <p class="text-xs text-gray-500 mt-1">{{ $history->created_at->format('d M Y H:i') }}</p>
              </div>

              @if($userRating)
                <div class="flex items-center justify-between">
                  <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-800 rounded-xl text-xs font-medium">
                    <svg class="w-4 h-4 mr-1.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Sudah Dirating
                  </span>
                </div>
              @else
                <a href="{{ route('rating_pengguna.create', ['id_penukaran' => $history->penukaran->id_penukaran]) }}"
                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 text-sm font-medium shadow hover:shadow-md transform hover:-translate-y-0.5">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                  Beri Rating
                </a>
              @endif
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('#form-filter');
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

          const matchKeyword = !keyword ||
            penawar.includes(keyword) ||
            ditawar.includes(keyword) ||
            produk.includes(keyword);

          const matchKategori = !kategori || produkKategori.includes(kategori);

          const rowDate = new Date(dateText);
          const inputDate = new Date(tanggal);

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

      filterTable();
    });
  </script>
@endsection
