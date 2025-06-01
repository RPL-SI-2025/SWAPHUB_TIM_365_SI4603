@extends('layouts.app')

@section('content')
  <main class="px-4 md:px-24 py-10">
    <form class="mx-auto mb-6">
      <label for="search-wishlist" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="text" id="search-wishlist"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
          placeholder="Search Wishlist...">
      </div>
    </form>

    <h1 class="text-3xl font-bold mb-6 text-shadow-lg">Wishlist</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="wishlist-container">
      @foreach ($wishlistItems as $wishlist)
        <div class="relative group wishlist-item" data-nama="{{ strtolower($wishlist->barang->nama_barang) }}">
          <img src="{{ Storage::url($wishlist->barang->gambar) }}" alt="{{ $wishlist->barang->nama_barang }}"
            class="rounded-lg w-full h-80 object-cover">

          <div
            class="rounded-lg absolute inset-0 bg-black/50 text-white opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-center text-sm font-semibold">
            {{ $wishlist->barang->nama_barang }}
          </div>

          <form action="{{ route('wishlist.destroy', $wishlist->id_wishlist) }}" method="POST"
            class="delete-form absolute top-2 right-2">
            @csrf
            @method('DELETE')
            <a href="{{ route('barang.show', $wishlist->barang->id_barang) }}"
              class="bg-blue-500 text-white text-xs px-2 py-1 rounded hover:bg-blue-600">Detail</a>
            <button type="submit" class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
              Hapus
            </button>
          </form>
        </div>
      @endforeach
      <a href="{{ route('home') }}"
        class="h-80 w-full rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 cursor-pointer hover:bg-gray-300 transition duration-200 ease-in-out">
        + New Collection
      </a>
    </div>
  </main>

  {{-- JavaScript untuk real-time search --}}
  <script>
    document.getElementById('search-wishlist').addEventListener('input', function() {
      const search = this.value.toLowerCase();
      const items = document.querySelectorAll('.wishlist-item');

      items.forEach(item => {
        const nama = item.getAttribute('data-nama');
        if (nama.includes(search)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  </script>
@endsection
