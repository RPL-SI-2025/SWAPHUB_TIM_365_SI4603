@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md animate-fade-in">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buat Kategori Baru</h2>

      @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label for="nama_kategori" class="block text-sm font-semibold mb-1">Nama Kategori</label>
          <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
          <label for="jenis_kategori" class="block text-sm font-semibold mb-1">Jenis Kategori</label>
          <select name="jenis_kategori" id="jenis_kategori" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Pilih Jenis --</option>
            <option value="barang">Barang</option>
            <option value="laporan">Laporan</option>
          </select>
        </div>

        <button type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition">
          Simpan
        </button>
      </form>
    </div>
  </div>
@endsection
