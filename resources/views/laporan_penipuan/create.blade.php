@extends('layouts.app')

@section('content')
  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    @include('layouts.sidebar')

    <div class="w-full bg-white rounded-lg shadow-lg p-8 flex-1">
      <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-gray-800">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </a>
        <h2 class="text-3xl font-bold text-shadow-lg">Buat <span class="text-primary">Laporan Penipuan</span></h2>
      </div>

      <!-- Notifikasi -->
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif

      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('laporan_penipuan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Kategori -->
        <div class="mb-4">
          <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori Laporan</label>
          <select name="id_kategori" id="id_kategori"
            class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $item)
              <option value="{{ $item->id_kategori }}" {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>
                {{ $item->nama_kategori }}
              </option>
            @endforeach
          </select>
          @error('id_kategori')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Pengguna yang Dilaporkan -->
        <div class="mb-4">
          <label for="id_dilapor" class="block text-sm font-medium text-gray-700 mb-1">Pengguna yang Dilaporkan</label>
          <select name="id_dilapor" id="id_dilapor"
            class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">-- Pilih Pengguna --</option>
            @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ old('id_dilapor') == $user->id ? 'selected' : '' }}>
                {{ $user->first_name . ' ' . $user->last_name }}
              </option>
            @endforeach
          </select>
          @error('id_dilapor')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Pesan Laporan -->
        <div class="mb-4">
          <label for="pesan_laporan" class="block text-sm font-medium text-gray-700 mb-1">Pesan Laporan</label>
          <textarea name="pesan_laporan" id="pesan_laporan" rows="4"
            class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500"
            placeholder="Jelaskan detail laporan penipuan..." required>{{ old('pesan_laporan') }}</textarea>
          @error('pesan_laporan')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Foto Bukti -->
        <div class="mb-4">
          <label for="foto_bukti" class="flex items-center text-sm font-medium text-gray-700 mb-1">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd" />
            </svg>
            Foto Bukti (Opsional)
          </label>
          <input type="file" name="foto_bukti" id="foto_bukti"
            class="w-full border rounded focus:ring-blue-500 focus:border-blue-500" accept="image/*">
          @error('foto_bukti')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <!-- Tombol -->
        <div class="flex gap-3">
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
            Kirim Laporan
          </button>
          <a href="{{ route('laporan_penipuan.index') }}"
            class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd"
                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                clip-rule="evenodd" />
            </svg>
            Histori Laporan
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
