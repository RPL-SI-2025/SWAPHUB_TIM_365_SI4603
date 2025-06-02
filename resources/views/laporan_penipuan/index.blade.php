@extends('layouts.app')

@section('content')
  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    @include('layouts.sidebar')

    <div class="w-full bg-white rounded-lg shadow-lg p-8 flex-1">
      <!-- Header -->
      <div class="mb-6">
        <div class="flex items-center mb-4">
          <a href="{{ route('profile.index') }}" class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </a>
          <h1 class="text-3xl font-bold text-shadow-lg">Daftar <span class="text-primary">Laporan Penipuan</span></h1>
        </div>
        <div class="flex justify-end items-center">
          <a href="{{ route('laporan_penipuan.index') }}"
            class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-hover flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                clip-rule="evenodd" />
            </svg>
            Refresh
          </a>
        </div>
      </div>

      <!-- Tabel Laporan -->
      @if ($laporan->isEmpty())
        <p class="text-gray-600 text-center py-6 bg-gray-50 rounded">Belum ada laporan penipuan.</p>
      @else
        <div class="w-full overflow-x-auto shadow-md rounded-lg">
          <table class="w-full bg-white">
            <thead>
              <tr class="bg-tertiary text-white text-center">
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-left">Pelapor</th>
                <th class="p-3 text-left">Dilapor</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Catatan Admin</th>
                <th class="p-3 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($laporan as $item)
                <tr class="hover:bg-gray-50 border-b border-gray-300">
                  <td class="p-3">{{ $item->kategori->nama_kategori }}</td>
                  <td class="p-3">{{ $item->pelapor->first_name . ' ' . $item->pelapor->last_name }}</td>
                  <td class="p-3">{{ $item->dilapor->first_name . ' ' . $item->dilapor->last_name }}</td>
                  <td class="p-3">
                    <span
                      class="inline-flex px-2 py-1 text-xs font-medium rounded {{ $item->status_laporan == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($item->status_laporan == 'diterima' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                      {{ ucfirst($item->status_laporan) }}
                    </span>
                  </td>
                  <td class="p-3">
                    @if ($item->pesan_admin)
                      <span class="text-gray-700 text-sm">{{ $item->pesan_admin }}</span>
                    @else
                      <span class="text-gray-400 text-sm">-</span>
                    @endif
                  </td>
                  <td class="p-3 flex gap-2">
                    <a href="{{ route('laporan_penipuan.show', $item->id_laporan) }}"
                      class="bg-primary text-white px-3 py-2 rounded hover:bg-primary-hover flex items-center">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                          d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                          clip-rule="evenodd" />
                      </svg>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      <!-- Tombol Tambah Laporan (Hanya untuk user) -->
      @if (!Auth::user()->is_admin)
        <div class="mt-6 flex justify-end">
          <a href="{{ route('laporan_penipuan.create') }}"
            class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-hover flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd" />
            </svg>
            Tambah Laporan
          </a>
        </div>
      @endif
    </div>
  </div>
@endsection
