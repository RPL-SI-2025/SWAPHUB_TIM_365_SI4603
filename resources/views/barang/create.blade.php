@extends('layouts.app')

@section('content')
  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    @include('layouts.sidebar')

    <div class="w-full bg-white rounded-lg shadow-lg p-8 flex-1">
      <h1 class="text-3xl font-bold mb-6">Tambah Barang</h1>

      <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label for="nama_barang" class="block text-gray-700">Nama Barang</label>
          <input type="text" name="nama_barang" id="nama_barang"
            class="w-full border rounded p-2 @error('nama_barang') border-red-500 @enderror"
            value="{{ old('nama_barang') }}">
          @error('nama_barang')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="deskripsi_barang" class="block text-gray-700">Deskripsi Barang</label>
          <textarea name="deskripsi_barang" id="deskripsi_barang"
            class="w-full border rounded p-2 @error('deskripsi_barang') border-red-500 @enderror">{{ old('deskripsi_barang') }}</textarea>
          @error('deskripsi_barang')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="status_barang" class="block text-gray-700">Status Barang</label>
          <select name="status_barang" id="status_barang"
            class="w-full border rounded p-2 @error('status_barang') border-red-500 @enderror">
            <option value="tersedia" {{ old('status_barang') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="tidak tersedia" {{ old('status_barang') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia
            </option>
          </select>
          @error('status_barang')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="id_kategori" class="block text-gray-700">Kategori Barang</label>
          <select name="id_kategori" id="id_kategori"
            class="w-full border rounded p-2 @error('id_kategori') border-red-500 @enderror">
            <option value="" {{ old('id_kategori') == '' ? 'selected' : '' }} disabled>Pilih Kategori</option>
            @foreach ($kategori as $ktg)
              <option value="{{ $ktg->id_kategori }}" {{ old('id_kategori') == $ktg->id_kategori ? 'selected' : '' }}>
                {{ $ktg->nama_kategori }}</option>
            @endforeach
          </select>
          @error('id_kategori')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="gambar" class="block text-gray-700">Gambar Barang</label>
          <input type="file" name="gambar" id="gambar" accept="image/*"
            class="w-full border rounded px-2 @error('gambar') border-red-500 @enderror">
          @error('gambar')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex space-x-4">
          <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-hover">Simpan</button>
          <a href="{{ route('barang.index') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection
