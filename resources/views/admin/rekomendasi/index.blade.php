@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto mt-8">

    <h2 class="text-2xl font-semibold mb-6">Manajemen Rekomendasi Barang</h2>

    {{-- Pilih User --}}
    <form action="{{ route('admin.rekomendasi.index') }}" method="GET" class="mb-6 space-y-4">
      <div>
        <label for="user_id" class="block font-medium mb-1">Pilih User</label>
        <select name="user_id" id="user_id" class="border rounded p-2 w-full" onchange="this.form.submit()">
          <option value="">-- Pilih User --</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
              {{ $user->full_name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Filter Kategori --}}
      @if ($selectedUserId)
        <div>
          <label for="category_filter" class="block font-medium mt-4 mb-1">Filter Kategori</label>
          <select name="category_filter" id="category_filter" class="border rounded p-2 w-full"
            onchange="this.form.submit()">
            <option value="">-- Semua Kategori --</option>
            @foreach ($kategori as $ktg)
              <option value="{{ $ktg->id_kategori }}"
                {{ $selectedCategoryFilter == $ktg->id_kategori ? 'selected' : '' }}>
                {{ $ktg->nama_kategori }}
              </option>
            @endforeach
          </select>
        </div>
      @endif
    </form>

    {{-- Form Tambah Rekomendasi --}}
    @if ($selectedUserId)
      <form action="{{ route('admin.rekomendasi.store') }}" method="POST" class="mb-6">
        @csrf
        <input type="hidden" name="user_id" value="{{ $selectedUserId }}">

        <div>
          <span class="font-medium mb-2 block">Pilih Barang untuk Direkomendasikan</span>

          {{-- Checklist Semua --}}
          <div class="mb-2">
            <label class="inline-flex items-center cursor-pointer">
              <input type="checkbox" id="checkAll"
                class="form-checkbox rounded border-gray-300 focus:ring focus:ring-blue-300" />
              <span class="ml-2 text-gray-700 font-medium">Checklist Semua</span>
            </label>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-h-80 overflow-auto border border-gray-300 rounded p-3">
            @forelse ($items as $barang)
              <label class="inline-flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="barang_ids[]" value="{{ $barang->id_barang }}"
                  class="item-checkbox rounded border-gray-300 focus:ring focus:ring-blue-300">
                <span>{{ $barang->nama_barang }}</span>
              </label>
            @empty
              <p class="text-gray-500">Tidak ada barang tersedia untuk direkomendasikan.</p>
            @endforelse
          </div>
        </div>

        <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Tambah Rekomendasi
        </button>
      </form>
    @endif

    {{-- Tabel Barang yang Direkomendasikan --}}
    @if ($selectedUserId)
      <div class="mb-6">
        <h3 class="text-xl font-semibold mb-3">Barang yang Direkomendasikan</h3>
        @if ($rekomendasi->isEmpty())
          <p>Belum ada rekomendasi barang.</p>
        @else
          <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow overflow-hidden">
            <thead class="bg-blue-700 text-white">
              <tr>
                <th class="py-3 px-4 text-left">Nama Barang</th>
                <th class="py-3 px-4 text-left">Kategori</th>
                <th class="py-3 px-4 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($rekomendasi as $item)
                <tr class="hover:bg-blue-50 transition">
                  <td class="py-3 px-4 whitespace-nowrap">{{ $item->barang->nama_barang ?? '-' }}</td>
                  <td class="py-3 px-4 whitespace-nowrap">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                  <td class="py-3 px-4 whitespace-nowrap">
                    <form action="{{ route('admin.rekomendasi.destroy', $item->id) }}" method="POST" class="delete-form"
                      class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    @endif

    {{-- Riwayat Penukaran --}}
    @if ($histories->isNotEmpty())
      <div>
        <h3 class="text-xl font-semibold mb-3">Riwayat Penukaran</h3>
        <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow overflow-hidden">
          <thead class="bg-blue-700 text-white">
            <tr>
              <th class="py-3 px-4 text-left">Penawar</th>
              <th class="py-3 px-4 text-left">Ditawar</th>
              <th class="py-3 px-4 text-left">Tanggal</th>
              <th class="py-3 px-4 text-left">Riwayat Penukaran</th>
              <th class="py-3 px-4 text-left">Kategori</th>
              <th class="py-3 px-4 text-left">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($histories as $history)
              <tr class="hover:bg-blue-50 transition">
                <td class="py-3 px-4 whitespace-nowrap">{{ $history->penukaran->penawar->full_name ?? '-' }}</td>
                <td class="py-3 px-4 whitespace-nowrap">{{ $history->penukaran->ditawar->full_name ?? '-' }}</td>
                <td class="py-3 px-4 whitespace-nowrap">{{ $history->created_at->format('d M Y') }}</td>
                <td class="py-3 px-4 whitespace-nowrap">
                  {{ $history->penukaran->barangPenawar->nama_barang ?? '-' }} ↔
                  {{ $history->penukaran->barangDitawar->nama_barang ?? '-' }}
                </td>
                <td class="py-3 px-4 whitespace-nowrap">
                  {{ $history->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }} /
                  {{ $history->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}
                </td>
                <td class="py-3 px-4 whitespace-nowrap">
                  <span
                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                            {{ $history->penukaran->status_penukaran === 'diterima' ? 'bg-green-100 text-green-800' : ($history->penukaran->status_penukaran === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($history->penukaran->status_penukaran) }}
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>

  {{-- Script untuk Checklist Semua --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkAllBox = document.getElementById('checkAll');
      if (checkAllBox) {
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        checkAllBox.addEventListener('change', function() {
          itemCheckboxes.forEach(checkbox => {
            checkbox.checked = checkAllBox.checked;
          });
        });
      }
    });
  </script>
@endsection
