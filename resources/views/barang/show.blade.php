@extends('layouts.app')

@section('content')
  <div class="px-4 md:px-24 py-10">
    <h1 class="text-3xl font-bold mb-6">Detail <span class="text-primary">Barang</span></h1>

    <div class="bg-white p-6 rounded shadow-md">
      <div class="flex flex-col md:flex-row">
        <div class="md:w-1/3">
          @if ($barang->gambar)
            <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}"
              class="w-full h-48 object-cover rounded">
          @else
            <span class="text-gray-500">Tidak ada gambar</span>
          @endif
        </div>
        <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
          <h2 class="text-2xl font-semibold">{{ $barang->nama_barang }}</h2>
          <p class="text-gray-600 mt-2"><strong>Deskripsi:</strong> {{ $barang->deskripsi_barang }}</p>
          <p class="text-gray-600 mt-2"><strong>Status:</strong>
            <span
              class="px-2 py-1 text-xs font-medium rounded {{ $barang->status_barang === 'tersedia' ? 'bg-green-200 text-green-800' : ($barang->status_barang === 'tidak tersedia' ? 'bg-red-200 text-red-800' : 'bg-primary/50 text-tertiary') }}">
              {{ ucfirst($barang->status_barang) }}
            </span>
          </p>
          <p class="text-gray-600 mt-2"><strong>Pemilik:</strong> {{ $barang->user->full_name }}</p>
          <p class="text-gray-600 mt-2"><strong>Kategori:</strong> {{ $barang->kategori->nama_kategori }}</p>
        </div>
      </div>
      <div class="flex flex-wrap gap-2 mt-4">
        <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded">
          Kembali
        </a>

        @if (Auth::user()->id != $barang->id_user && $barang->status_barang == 'tersedia')
          <a href="{{ route('penukaran.create', $barang->id_barang) }}"
            class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded">
            Minta Tukar
          </a>

          <button class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded add-to-wishlist-btn"
            data-id="{{ $barang->id_barang }}">
            Tambah ke Wishlist
          </button>
        @endif
      </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('.add-to-wishlist-btn');

      buttons.forEach(button => {
        button.addEventListener('click', function(e) {
          const idBarang = this.dataset.id;

          fetch('{{ route('wishlist.store') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                id_barang: idBarang
              })
            })
            .then(res => res.json())
            .then(data => {
              if (data.success) {
                showToast('success', data.message || 'Berhasil ditambahkan ke wishlist.');
              } else {
                showToast('error', data.message || 'Barang sudah ada di wishlist.');
              }
            })
            .catch(err => {
              console.error(err);
              showToast('error', 'Terjadi kesalahan saat menambahkan wishlist.');
            });

        });
      });
    });
  </script>

  {{-- WISHLIST --}}
  <div id="toast-success"
    class="hidden fixed flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm bottom-5 right-5 "
    role="alert">
    <div
      class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
      </svg>
      <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-sm font-normal" id="toast-success-message">Item added successfully.</div>
    <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      data-dismiss-target="#toast-success" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  </div>
  <div id="toast-danger"
    class="hidden fixed flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm bottom-5 right-5 "
    role="alert">
    <div
      class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
      </svg>
      <span class="sr-only">Error icon</span>
    </div>
    <div class="ms-3 text-sm font-normal" id="toast-danger-message">Failed to add item.</div>
    <button type="button"
      class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      data-dismiss-target="#toast-danger" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
      </svg>
    </button>
  </div>

  <script>
    function showToast(type, message) {
      const successToast = document.getElementById('toast-success');
      const errorToast = document.getElementById('toast-danger');

      if (type === 'success') {
        document.getElementById('toast-success-message').innerText = message;
        successToast.classList.remove('hidden');

        setTimeout(() => {
          successToast.classList.add('hidden');
        }, 3000);
      }

      if (type === 'error') {
        document.getElementById('toast-danger-message').innerText = message;
        errorToast.classList.remove('hidden');

        setTimeout(() => {
          errorToast.classList.add('hidden');
        }, 3000);
      }
    }
  </script>
@endsection
