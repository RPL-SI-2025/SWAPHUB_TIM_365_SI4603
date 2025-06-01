@extends('layouts.app')

@section('content')
  {{-- Search & Filter Section --}}
  <section class="px-4 md:px-24 pt-10">
    {{-- Search Bar --}}
    <form class="max-w-2xl mx-auto">
      <label for="default-search"
        class="mb-2 text-sm hover:text-primary font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="search" id="search-bar"
          class="block w-full p-3 ps-10 text-sm hover:text-primary text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-primary focus:border-primary"
          placeholder="Find your items" />
      </div>
    </form>

    {{-- Filter By Categories --}}
    <div class="mt-6 overflow-x-scroll overflow-y-hidden md:overflow-x-hidden p-2">
      <div class="flex space-x-6 md:space-x-14 md:justify-center">
        @php
          $categories = [
              ['name' => 'Gadget', 'icon' => 'mac-book-air.png'],
              ['name' => 'Otomotif', 'icon' => 'motorbike-helmet.png'],
              ['name' => 'Administrasi', 'icon' => 'book-and-pencil.png'],
              ['name' => 'Pakaian', 'icon' => 'hanger.png'],
              ['name' => 'Mainan', 'icon' => 'plush.png'],
              ['name' => 'Olahraga', 'icon' => 'tennis.png'],
              ['name' => 'Furniture', 'icon' => 'sofa.png'],
              ['name' => 'Aksesoris', 'icon' => 'necklace.png'],
          ];
        @endphp

        @foreach ($categories as $category)
          <div class="category-item flex-shrink-0 text-center cursor-pointer hover:scale-110 transition"
            data-kategori="{{ $category['name'] }}">
            <img src="{{ asset('images/' . $category['icon']) }}" alt="{{ $category['name'] }}" class="w-16 h-16 mx-auto">
            <span class="text-sm">{{ $category['name'] }}</span>
          </div>
        @endforeach
      </div>

    </div>

  </section>

  {{-- TODO: Jika ada barang rekomendasi --}}
  {{-- Just For You Section --}}
  {{-- <section class="px-4 md:px-24 pt-10">
      <h2 class="text-2xl md:text-3xl text-tertiary font-semibold tex mb-2">Just for you</h2>
      <p class="text-gray-500 mb-8">Barang rekomendasi.</p>

      <div id="item-grid-container">
        @if ($barang->isEmpty())
          <p class="text-gray-600 text-center mb-12">Tidak ada barang yang tersedia.</p>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-6">
            @foreach ($barang as $item)
              <div
                class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-100 flex items-center justify-center">
                  @if ($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}"
                      class="w-full h-full object-cover">
                  @else
                    <span class="text-gray-500 text-sm">Gambar Tidak Tersedia</span>
                  @endif
                </div>
                <div class="p-4">
                  <p class="font-medium text-lg text-gray-800 truncate">{{ $item->nama_barang }}</p>
                  <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $item->deskripsi_barang }}</p>
                  <div class="flex justify-center flex-wrap gap-2">
                    <a href="{{ route('barang.show', $item->id_barang) }}"
                      class="text-sm px-4 py-1 bg-primary rounded-lg text-white hover:bg-primary-hover font-medium">Lihat</a>

                    @if (Auth::user()->id == $item->id_user && $item->status_barang != 'ditukar')
                      <a href="{{ route('barang.edit', $item->id_barang) }}"
                        class="text-sm px-4 py-1 bg-yellow-500 rounded-lg text-white hover:bg-yellow-700 font-medium">Edit</a>

                      <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"
                          class="text-sm px-4 py-1 bg-red-500 rounded-lg text-white hover:bg-red-700 font-medium">
                          Hapus
                        </button>
                      </form>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </section> --}}
  <!-- Bagian Barang yang Direkomendasikan -->
<section class="px-4 md:px-24 py-10">
    <h2 class="text-2xl md:text-3xl font-semibold mb-2">Barang yang Direkomendasikan Untukmu</h2>

    @if($barangRekomendasi->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            @foreach ($barangRekomendasi as $item)
            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-100 flex items-center justify-center">
                    @if ($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-500 text-sm">Gambar Tidak Tersedia</span>
                    @endif
                </div>
                <div class="p-4">
                    <p class="font-medium text-lg text-gray-800 truncate">{{ $item->nama_barang }}</p>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $item->deskripsi_barang }}</p>
                    <div class="flex justify-center flex-wrap gap-2">
                        <a href="{{ route('barang.show', $item->id_barang) }}" class="text-sm px-4 py-1 bg-primary rounded-lg text-white hover:bg-primary-hover font-medium">Lihat</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        {{-- Jika belum ada barang direkomendasikan, bagian ini kosong (tidak tampil) --}}
    @endif
</section>

  {{-- Daftar Barang Section --}}
  <section class="px-4 md:px-24 py-10">
    <h2 class="text-2xl md:text-3xl text-tertiary font-semibold tex mb-2">Daftar Barang</h2>
    <p class="text-gray-500 mb-8">Apa yang lagi dicari hari ini?</p>

    <div id="item-grid-container">
      @if ($barang->isEmpty())
        <p class="text-gray-600 text-center mb-12">Tidak ada barang yang tersedia.</p>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-6">
          @foreach ($barang as $item)
            <div
              class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition barang-item"
              data-nama="{{ strtolower($item->nama_barang) }}">
              <div class="h-48 bg-gray-100 flex items-center justify-center">
                @if ($item->gambar)
                  <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}"
                    class="w-full h-full object-cover">
                @else
                  <span class="text-gray-500 text-sm">Gambar Tidak Tersedia</span>
                @endif
              </div>
              <div class="p-4">
                <p class="font-medium text-lg text-gray-800 truncate">{{ $item->nama_barang }}</p>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $item->deskripsi_barang }}</p>
                <div class="flex justify-center flex-wrap gap-2">
                  <a href="{{ route('barang.show', $item->id_barang) }}"
                    class="text-sm px-4 py-1 bg-primary rounded text-white hover:bg-primary-hover font-medium">Lihat</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  {{-- Script Pencarian & Filter By Category --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const categoryItems = document.querySelectorAll('.category-item');
      const itemGridContainer = document.querySelector('#item-grid-container:last-of-type');
      const searchInput = document.getElementById('search-bar');

      let activeCategory = null;

      function loadBarang(kategori = '', keyword = '') {
        let url = '/barang/filter';

        const params = new URLSearchParams();
        if (kategori) params.append('kategori', kategori);
        if (keyword) params.append('search', keyword);

        url += '?' + params.toString();

        fetch(url, {
            method: 'GET',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
            },
          })
          .then(response => response.json())
          .then(data => {
            itemGridContainer.innerHTML = '';

            if (data.barang.length === 0) {
              itemGridContainer.innerHTML =
                '<p class="text-gray-600 text-center mb-12">Tidak ada barang yang ditemukan.</p>';
              return;
            }

            const grid = document.createElement('div');
            grid.className = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6';

            data.barang.forEach(item => {

              const card = document.createElement('div');
              card.className =
                'bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition';

              card.innerHTML = `
              <div class="h-48 bg-gray-100 flex items-center justify-center">
                ${item.gambar
                  ? `<img src="/storage/${item.gambar}" alt="${item.nama_barang}" class="w-full h-full object-cover">`
                  : `<span class="text-gray-500 text-sm">Gambar Tidak Tersedia</span>`}
              </div>
              <div class="p-4">
                <p class="font-medium text-lg text-gray-800 truncate">${item.nama_barang}</p>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">${item.deskripsi_barang}</p>
                <div class="flex justify-center flex-wrap gap-2">
                  <a href="/barang/${item.id_barang}" class="text-sm px-4 py-1 bg-primary rounded-lg text-white hover:bg-primary-hover font-medium">Lihat</a>
                </div>
              </div>
            `;

              grid.appendChild(card);
            });

            itemGridContainer.appendChild(grid);
          })
          .catch(error => {
            console.error('Error:', error);
            itemGridContainer.innerHTML =
              '<p class="text-red-600 text-center mb-12">Terjadi kesalahan saat memuat data.</p>';
          });
      }

      // Klik kategori
      categoryItems.forEach(item => {
        item.addEventListener('click', function() {
          const clickedKategori = this.getAttribute('data-kategori');

          // Toggle aktif/nonaktif
          if (activeCategory === clickedKategori) {
            activeCategory = null; // Hilangkan filter kategori
            categoryItems.forEach(i => i.classList.remove('selected'));
          } else {
            activeCategory = clickedKategori;
            categoryItems.forEach(i => i.classList.remove('selected'));
            this.classList.add('selected');
          }

          // Panggil ulang berdasarkan kategori baru & pencarian (jika ada)
          const keyword = searchInput.value.trim().toLowerCase();
          loadBarang(activeCategory, keyword);
        });
      });

      // Pencarian dengan kategori aktif
      searchInput.addEventListener('input', function() {
        const keyword = this.value.trim().toLowerCase();
        loadBarang(activeCategory, keyword);
      });

      // Muat semua barang pertama kali
      loadBarang();
    });
  </script>



@endsection
