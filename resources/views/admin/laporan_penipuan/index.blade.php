@extends('layouts.admin.app')

@section('content')

  <!-- Main Content -->
  <div class="container mx-auto">

    <div class="flex justify-between items-center mb-6">
      <h2 class="text-3xl font-semibold text-gray-900">Daftar <span class="text-primary">Laporan Penipuan</span></h2>
    </div>

    <!-- Tabel Laporan -->
    @if ($laporan->isEmpty())
      <p class="text-gray-600 text-center py-6 bg-gray-50 rounded-lg">Belum ada laporan penipuan.</p>
    @else
      <div class="w-full overflow-x-auto shadow-md rounded-lg">
        <table class="w-full bg-white">
          <thead>
            <tr class="bg-tertiary text-white text-center">
              <th class="p-3 rounded-tl-lg font-medium">Kategori</th>
              <th class="p-3 font-medium">Pelapor</th>
              <th class="p-3 font-medium">Dilapor</th>
              <th class="p-3 font-medium">Status</th>
              <th class="p-3 font-medium">Catatan Admin</th>
              <th class="p-3 rounded-tr-lg font-medium">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($laporan as $item)
              <tr class="bg-white hover:bg-gray-50 transition duration-200 border-b border-gray-300">
                <td class="p-4">{{ $item->kategori->nama_kategori }}</td>
                <td class="p-4">{{ $item->pelapor->first_name . ' ' . $item->pelapor->last_name }}</td>
                <td class="p-4">{{ $item->dilapor->first_name . ' ' . $item->dilapor->last_name }}</td>
                <td class="p-4">
                  @if ($item->status_laporan == 'pending')
                    <span
                      class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                  @elseif ($item->status_laporan == 'diterima')
                    <span
                      class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                  @else
                    <span
                      class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">{{ $item->status_laporan }}</span>
                  @endif
                </td>
                <td class="p-4">
                  @if ($item->pesan_admin)
                    <span class="text-gray-700 text-sm">{{ $item->pesan_admin }}</span>
                  @else
                    <span class="text-gray-400 text-sm">-</span>
                  @endif
                </td>
                <td class="p-4 flex gap-2">
                  <a href="{{ route('laporan.show', $item->id_laporan) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                      <path fill-rule="evenodd" d="M10 0a10 10 0 100 20 10 10 0 000-20zM2 10a8 8 0 1116 0 8 8 0 01-16 0z"
                        clip-rule="evenodd" />
                    </svg>
                    Lihat
                  </a>
                  <form action="{{ route('laporan_penipuan.updateStatus', $item->id_laporan) }}" method="POST"
                    class="inline-flex items-center gap-2">
                    @csrf
                    <div>
                      <select name="status_laporan" id="status_laporan" onchange="this.form.submit()"
                        class="w-26 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="pending" {{ $item->status_laporan == 'pending' ? 'selected' : '' }}>
                          Pending
                        </option>
                        <option value="diterima" {{ $item->status_laporan == 'diterima' ? 'selected' : '' }}>
                          Diterima
                        </option>
                        <option value="ditolak" {{ $item->status_laporan == 'ditolak' ? 'selected' : '' }}>
                          Ditolak
                        </option>
                      </select>
                    </div>
                    <input type="text" name="pesan_admin" value="{{ old('pesan_admin', $item->pesan_admin ?? '') }}"
                      placeholder="Masukkan catatan"
                      class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
