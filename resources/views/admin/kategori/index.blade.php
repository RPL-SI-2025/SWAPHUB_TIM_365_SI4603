@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto">
    <div class="flex-col space-y-2 justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-gray-800">Manage <span class="text-blue-500">Category</span></h2>
      <a href="{{ route('kategori.create') }}"
        class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Add Category</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Kategori Barang -->
      <div class="bg-blue-100 rounded-xl p-6 shadow-md">
        <h3 class="text-xl font-semibold text-center mb-4">Barang</h3>
        <div class="w-full overflow-x-auto shadow-md rounded-lg">
          <table class="w-full bg-white">
            <thead>
              <tr class="bg-tertiary text-white text-center">
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($barang as $item)
                <tr class="border-t border-gray-300">
                  <td class="px-4 py-2">{{ $item->nama_kategori }}</td>
                  <td class="px-4 py-2">
                    <div class="flex space-x-2">
                      <a href="{{ route('kategori.show', $item->id_kategori) }}"
                        class="text-blue-500 hover:underline">Lihat</a>
                      <a href="{{ route('kategori.edit', $item->id_kategori) }}"
                        class="text-yellow-500 hover:underline">Edit</a>
                      <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST"
                        class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-4">Belum ada kategori Barang.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Kategori Pelaporan -->
      <div class="bg-blue-100 rounded-xl p-6 shadow-md">
        <h3 class="text-xl font-semibold text-center mb-4">Pelaporan</h3>
        <div class="w-full overflow-x-auto shadow-md rounded-lg">
          <table class="w-full bg-white">
            <thead>
              <tr class="bg-tertiary text-white text-center">
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($laporan as $item)
                <tr class="border-t">
                  <td class="px-4 py-2">{{ $item->nama_kategori }}</td>
                  <td class="px-4 py-2">
                    <div class="flex space-x-2">
                      <a href="{{ route('kategori.show', $item->id_kategori) }}"
                        class="text-blue-500 hover:underline">Lihat</a>
                      <a href="{{ route('kategori.edit', $item->id_kategori) }}"
                        class="text-yellow-500 hover:underline">Edit</a>
                      <form action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-4">Belum ada kategori Pelaporan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
