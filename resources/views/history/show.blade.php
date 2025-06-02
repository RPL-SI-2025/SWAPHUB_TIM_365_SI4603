@extends('layouts.app')

@section('content')
  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="w-full bg-white rounded-lg shadow-lg p-8 flex-1 space-y-8">
      <!-- Header Section -->
      <div class="mb-8 flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <div class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg"></div>
          <h1 class="text-3xl font-bold text-gray-800">
            Detail Riwayat <span
              class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">Penukaran</span>
          </h1>
        </div>
        <a href="{{ route('history.index') }}"
          class="group inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
          <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Kembali ke Riwayat
        </a>
      </div>

      <!-- Main Content Card -->
      <div class="bg-white rounded-3xl shadow-lg p-8 space-y-10">
        <!-- Exchange Details Section -->
        <div class="border-b border-gray-200 pb-8">
          <h4 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Detail Penukaran
          </h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
              <div class="bg-gray-50 rounded-xl p-4">
                <span class="text-gray-600 font-medium block mb-2">Pesan Penukaran:</span>
                <p class="text-gray-800">{{ $history->penukaran->pesan_penukaran }}</p>
              </div>
              <div>
                <span class="text-gray-600 font-medium block mb-2">Status Penukaran:</span>
                <span
                  class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium
                      {{ $history->penukaran->status_penukaran === 'diterima'
                          ? 'bg-green-100 text-green-800'
                          : ($history->penukaran->status_penukaran === 'ditolak'
                              ? 'bg-red-100 text-red-800'
                              : 'bg-yellow-100 text-yellow-800') }}">
                  <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="{{ $history->penukaran->status_penukaran === 'diterima'
                          ? 'M5 13l4 4L19 7'
                          : ($history->penukaran->status_penukaran === 'ditolak'
                              ? 'M6 18L18 6M6 6l12 12'
                              : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z') }}" />
                  </svg>
                  {{ ucfirst($history->penukaran->status_penukaran) }}
                </span>
              </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
              <span class="text-gray-600 font-medium block mb-2">Tanggal Penukaran:</span>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <div>
                  <p class="text-gray-800 font-medium">{{ $history->created_at->format('d M Y') }}</p>
                  <p class="text-gray-500 text-sm">{{ $history->created_at->format('H:i') }} WIB</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Exchanged Items Section -->
        <div class="border-b border-gray-200 pb-8">
          <h4 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            Barang yang Ditukar
          </h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Barang Penawar -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-3xl overflow-hidden">
              <div class="flex flex-col md:flex-row">
                <div class="p-6 flex-1">
                  <div class="flex items-center gap-3 mb-6">
                    <h5 class="text-lg font-semibold text-white">Barang Penawar</h5>
                    <span class="px-3 py-1 bg-blue-700 rounded-xl text-sm text-white font-medium">Ditawarkan</span>
                  </div>
                  <div class="space-y-4">
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Nama Barang</span>
                      <p class="text-white font-medium">{{ $history->penukaran->barangPenawar->nama_barang ?? '-' }}</p>
                    </div>
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Deskripsi</span>
                      <p class="text-white text-sm">{{ $history->penukaran->barangPenawar->deskripsi_barang ?? '-' }}</p>
                    </div>
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Kategori</span>
                      <p class="text-white">{{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                    <div>
                      <span class="text-blue-200 text-sm block mb-1">Pemilik</span>
                      <p class="text-white font-medium">{{ $history->penukaran->barangPenawar->user->full_name }}</p>
                    </div>
                  </div>
                </div>
                @if ($history->penukaran->barangPenawar->gambar)
                  <div class="p-4 md:w-72 flex items-center justify-center bg-white/5 backdrop-blur-sm">
                    <div class="aspect-[3/4] w-48 md:w-full overflow-hidden rounded-xl shadow-lg bg-white">
                      <img src="{{ asset('storage/' . $history->penukaran->barangPenawar->gambar) }}"
                        alt="Gambar Barang Penawar"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                  </div>
                @endif
              </div>
            </div>

            <!-- Barang Ditawar -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-3xl overflow-hidden">
              <div class="flex flex-col md:flex-row">
                <div class="p-6 flex-1">
                  <div class="flex items-center gap-3 mb-6">
                    <h5 class="text-lg font-semibold text-white">Barang Ditawar</h5>
                    <span class="px-3 py-1 bg-blue-700 rounded-xl text-sm text-white font-medium">Ditukar</span>
                  </div>
                  <div class="space-y-4">
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Nama Barang</span>
                      <p class="text-white font-medium">{{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}</p>
                    </div>
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Deskripsi</span>
                      <p class="text-white text-sm">{{ $history->penukaran->barangDitawar->deskripsi_barang ?? '-' }}</p>
                    </div>
                    <div class="border-b border-blue-700/30 pb-3">
                      <span class="text-blue-200 text-sm block mb-1">Kategori</span>
                      <p class="text-white">{{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                    <div>
                      <span class="text-blue-200 text-sm block mb-1">Pemilik</span>
                      <p class="text-white font-medium">{{ $history->penukaran->barangDitawar->user->full_name }}</p>
                    </div>
                  </div>
                </div>
                @if ($history->penukaran->barangDitawar->gambar)
                  <div class="p-4 md:w-72 flex items-center justify-center bg-white/5 backdrop-blur-sm">
                    <div class="aspect-[3/4] w-48 md:w-full overflow-hidden rounded-xl shadow-lg bg-white">
                      <img src="{{ asset('storage/' . $history->penukaran->barangDitawar->gambar) }}"
                        alt="Gambar Barang Ditawar"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Rating Section -->
        <div>
          <h4 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            Rating Penukaran
          </h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Rating dari Penawar -->
            <div class="bg-white border border-gray-200 rounded-3xl p-6 hover:shadow-lg transition-shadow duration-200">
              <h5 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Rating dari Penawar
              </h5>
              @php
                $ratingPenawar = App\Models\RatingPengguna::where(
                    'id_penukaran_barang',
                    $history->penukaran->id_penukaran,
                )
                    ->where('rating_type', 'penawar')
                    ->first();
              @endphp

              @if ($ratingPenawar)
                <div class="space-y-4">
                  <div>
                    <div class="flex items-center mb-3">
                      @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $ratingPenawar->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                          fill="currentColor" viewBox="0 0 20 20">
                          <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                      @endfor
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                      <p class="text-gray-700">{{ $ratingPenawar->review }}</p>
                    </div>
                  </div>
                  <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Diberikan pada: {{ $ratingPenawar->created_at->format('d M Y') }}
                  </div>
                </div>
              @else
                <div class="text-center py-8">
                  <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                  </svg>
                  <p class="text-gray-500 italic">Belum ada rating dari penawar</p>
                </div>
              @endif
            </div>

            <!-- Rating dari Yang Ditawar -->
            <div class="bg-white border border-gray-200 rounded-3xl p-6 hover:shadow-lg transition-shadow duration-200">
              <h5 class="font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Rating dari Yang Ditawar
              </h5>
              @php
                $ratingDitawar = App\Models\RatingPengguna::where(
                    'id_penukaran_barang',
                    $history->penukaran->id_penukaran,
                )
                    ->where('rating_type', 'ditawar')
                    ->first();
              @endphp

              @if ($ratingDitawar)
                <div class="space-y-4">
                  <div>
                    <div class="flex items-center mb-3">
                      @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $ratingDitawar->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                          fill="currentColor" viewBox="0 0 20 20">
                          <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                      @endfor
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                      <p class="text-gray-700">{{ $ratingDitawar->review }}</p>
                    </div>
                  </div>
                  <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Diberikan pada: {{ $ratingDitawar->created_at->format('d M Y') }}
                  </div>
                </div>
              @else
                <div class="text-center py-8">
                  <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                  </svg>
                  <p class="text-gray-500 italic">Belum ada rating dari yang ditawar</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>
  @endsection
