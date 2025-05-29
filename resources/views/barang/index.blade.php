@extends('layouts.app')

@section('content')
  <div class="px-4 md:px-24 py-10">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-3xl font-bold">Daftar <span class="text-primary">Barang</span></h1>
    </div>

    @if (!Auth::user()->is_admin)
      <a href="{{ route('barang.create') }}"
        class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded mb-4 inline-block">Tambah
        Barang</a>
    @endif

    <div class="w-full overflow-x-auto shadow-md rounded-lg">
      <table class="w-full bg-white">
        <thead>
          <tr class="bg-tertiary text-white text-left">
            <th class="p-3">Gambar</th>
            <th class="p-3">Nama Barang</th>
            <th class="p-3">Deskripsi</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($barang as $item)
            <tr class="hover:bg-gray-50">
              <td class="p-3">
                @if ($item->gambar)
                  <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}"
                    class="w-16 h-16 object-cover rounded">
                @else
                  <span class="text-gray-500 italic">Tidak ada gambar</span>
                @endif
              </td>
              <td class="p-3 font-medium text-gray-800">{{ $item->nama_barang }}</td>
              <td class="p-3 text-gray-700">{{ $item->deskripsi_barang }}</td>
              <td class="p-3">
                <span
                  class="px-2 py-1 text-xs font-medium rounded {{ $item->status_barang === 'tersedia' ? 'bg-green-200 text-green-800' : ($item->status_barang === 'tidak tersedia' ? 'bg-red-200 text-red-800' : 'bg-primary/50 text-tertiary') }}">
                  {{ ucfirst($item->status_barang) }}
                </span>
              </td>
              <td class="p-3">
                @if (Auth::user()->id == $item->id_user && !Auth::user()->is_admin && $item->status_barang !== 'ditukar')
                  <div class="flex space-x-2">
                    <a href="{{ route('barang.edit', $item->id_barang) }}"
                      class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </form>
                  </div>
                @else
                  <span class="text-gray-400 text-sm italic">-</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="p-3 text-center text-gray-600">Tidak ada barang tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
@endsection
