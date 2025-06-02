@extends('layouts.app')

@section('content')
  <div class="px-4 md:px-24 py-10">
    <div class="md:flex justify-between items-center mb-4">
      <div class="flex items-center mb-4">
        <a href="{{ route('home') }}" class="mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </a>
        <span class="text-shadow-lg">
          <h1 class="text-3xl font-bold text-shadow-lg">Permintaan <span class="text-primary">Tukar Barang</span></h1>
        </span>
      </div>

      @if (!Auth::user()->is_admin)
        <a href="{{ route('history.index') }}"
          class="flex items-center bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded w-fit">
          History
        </a>
      @endif
    </div>

    {{-- Permintaan Masuk --}}
    <h2 class="text-xl font-semibold mb-3 text-shadow-lg"><span class="text-primary">Permintaan</span> Masuk</h2>
    <div class="overflow-x-auto rounded-lg shadow-md mb-10">
      <table class="w-full bg-white">
        <thead class="bg-tertiary text-white">
          <tr class="text-center">
            <th class="p-3">Mahasiswa Pengaju</th>
            <th class="p-3">Barang Anda</th>
            <th class="p-3">Barang Ditawarkan</th>
            <th class="p-3">Kategori</th>
            <th class="p-3">Pesan</th>
            <th class="p-3">Status Penukaran</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($permintaanMasuk as $penukaran)
            <tr class="hover:bg-gray-50 text-center">
              <td class="p-3">{{ $penukaran->penawar->full_name }}</td>
              <td class="p-3">{{ $penukaran->barangDitawar->nama_barang }}</td>
              <td class="p-3">{{ $penukaran->barangPenawar->nama_barang }}</td>
              <td class="p-3">{{ $penukaran->barangDitawar->kategori->nama_kategori }}</td>
              <td class="p-3">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
              <td class="p-3">
                <span
                  class="px-2 py-1 text-xs font-medium rounded {{ $penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                  {{ ucfirst($penukaran->status_penukaran) }}
                </span>
              </td>
              <td class="p-3">
                @if ($penukaran->status_penukaran == 'pending')
                  <form action="{{ route('penukaran.confirm', $penukaran->id_penukaran) }}" method="POST"
                    class="inline accept-form">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded mr-1">
                      Terima
                    </button>
                  </form>
                  <form action="{{ route('penukaran.reject', $penukaran->id_penukaran) }}" method="POST"
                    class="inline reject-form">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
                      Tolak
                    </button>
                  </form>
                @else
                  <span class="text-gray-400 text-sm italic">-</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Penawaran Keluar --}}
    <h2 class="text-xl font-semibold mb-3 text-shadow-lg"><span class="text-primary">Penawaran</span> Keluar</h2>
    <div class="overflow-x-auto rounded-lg shadow-md">
      <table class="w-full bg-white">
        <thead class="bg-tertiary text-white">
          <tr class="text-center">
            <th class="p-3">Mahasiswa Tujuan</th>
            <th class="p-3">Barang Ditawarkan</th>
            <th class="p-3">Barang Diminta</th>
            <th class="p-3">Kategori</th>
            <th class="p-3">Pesan</th>
            <th class="p-3">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penawaranKeluar as $penukaran)
            <tr class="hover:bg-gray-50 text-center">
              <td class="p-3">{{ $penukaran->ditawar->full_name }}</td>
              <td class="p-3">{{ $penukaran->barangPenawar->nama_barang }}</td>
              <td class="p-3">{{ $penukaran->barangDitawar->nama_barang }}</td>
              <td class="p-3">{{ $penukaran->barangPenawar->kategori->nama_kategori }}</td>
              <td class="p-3">{{ $penukaran->pesan_penukaran ?? '-' }}</td>
              <td class="p-3">
                <span
                  class="px-2 py-1 text-xs font-medium rounded {{ $penukaran->status_penukaran === 'diterima' ? 'bg-green-200 text-green-800' : ($penukaran->status_penukaran === 'ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                  {{ ucfirst($penukaran->status_penukaran) }}
                </span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Script SweetAlert --}}
  <script>
    // Reject
    document.querySelectorAll('.reject-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: 'Apakah Anda yakin ingin menolak permintaan ini?',
          text: 'Data ini tidak bisa dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#22c55e',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, tolak!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });

    // Accept
    document.querySelectorAll('.accept-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: 'Apakah Anda yakin ingin menerima permintaan ini?',
          text: 'Data ini tidak bisa dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#22c55e',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, terima!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>
@endsection
