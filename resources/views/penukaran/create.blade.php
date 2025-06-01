@extends('layouts.app')

@section('content')
  <div class="px-4 md:px-24 py-10">
    <div class="flex items-center gap-3 mb-6">
      <a href="{{ route('barang.show', $barang->id_barang) }}" class="text-gray-600 hover:text-gray-800">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </a>
      <h1 class="text-3xl font-bold text-shadow-lg">Minta <span class="text-primary">Tukar Barang</span></h1>
    </div>

    <div class="bg-white p-6 rounded shadow-md mb-6">
      <div class="flex flex-col md:flex-row">
        <div>
          @if ($barang->gambar)
            <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}"
              class="w-full h-80 object-cover rounded">
          @else
            <span class="text-gray-500">Tidak ada gambar</span>
          @endif
        </div>
        <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
          <h3 class="text-xl font-semibold">{{ $barang->nama_barang }}</h3>
          <p class="text-gray-600 mt-2"><strong>Deskripsi:</strong> {{ $barang->deskripsi_barang }}</p>
          <p class="text-gray-600 mt-2"><strong>Pemilik:</strong> {{ $barang->user->full_name }}</p>
          <p class="text-gray-600 mt-2"><strong>Kategori:</strong> {{ $barang->kategori->nama_kategori }}</p>
        </div>
      </div>
    </div>

    <form action="{{ route('penukaran.store', $barang->id_barang) }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="id_barang_ditawarkan" class="block text-gray-700">Pilih Barang Anda untuk Ditukar</label>
        <select name="id_barang_ditawarkan" id="id_barang_ditawarkan" class="w-full p-2 border rounded" required>
          <option value="">-- Pilih Barang --</option>
          @foreach ($userBarang as $item)
            <option value="{{ $item->id_barang }}">{{ $item->nama_barang }} - {{ $item->deskripsi_barang }}</option>
          @endforeach
        </select>
        @error('id_barang_ditawarkan')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-4">
        <label for="pesan_penukaran" class="block text-gray-700">Pesan (Opsional)</label>
        <textarea name="pesan_penukaran" id="pesan_penukaran" class="w-full p-2 border rounded"
          placeholder="Tambahkan pesan untuk pemilik barang...">{{ old('pesan_penukaran') }}</textarea>
        @error('pesan_penukaran')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mr-2 flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
        </svg>
        Kirim Permintaan</button>
    </form>
  </div>
@endsection