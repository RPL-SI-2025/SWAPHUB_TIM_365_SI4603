@extends('layouts.app')

@section('content')
  <div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6">Manajemen Rekomendasi Barang</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success mb-4">
            <div class="text-green-600 bg-green-100 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Rekomendasi saat ini --}}
    <div class="card mb-6 shadow-lg rounded-lg">
        <div class="card-header bg-blue-500 text-white p-4 rounded-t-lg">Barang yang Direkomendasikan</div>
        <div class="card-body p-4">
            @if($rekomendasi->isEmpty())
                <p>Belum ada rekomendasi barang.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($rekomendasi as $item)
                        <li class="flex justify-between items-center p-3 border border-gray-300 rounded-lg">
                            <span>{{ $item->barang->nama_barang }}</span>
                            <form action="{{ route('admin.rekomendasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus rekomendasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md">Hapus</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Form untuk menambah rekomendasi --}}
    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-indigo-500 text-white p-4 rounded-t-lg">Tambah Rekomendasi Barang</div>
        <div class="card-body p-4">
            <form action="{{ route('admin.rekomendasi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
                    <select name="user_id" id="user_id" class="form-select mt-1 block w-full bg-gray-100 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                    <div class="space-y-2">
                        @foreach ($barang as $b)
                            <div class="flex items-center">
                                <input class="form-check-input h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" type="checkbox" name="barang_ids[]" value="{{ $b->id }}" id="barang{{ $b->id }}">
                                <label class="form-check-label ml-2 text-gray-700" for="barang{{ $b->id }}">
                                    {{ $b->nama_barang }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-md">Tambah Rekomendasi</button>
            </form>
        </div>
    </div>

    {{-- Riwayat Penukaran --}}
    @if($penukaran)
        <div class="card mt-6 shadow-lg rounded-lg">
            <div class="card-header bg-green-500 text-white p-4 rounded-t-lg">Riwayat Penukaran Barang</div>
            <div class="card-body p-4">
                @if($penukaran->isEmpty())
                    <p>Belum ada riwayat penukaran untuk user ini.</p>
                @else
                    <table class="table-auto w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Barang</th>
                                <th scope="col" class="px-6 py-3">Tanggal Penukaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penukaran as $index => $p)
                                <tr class="bg-white text-gray-700 border-b">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $p->barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $p->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endif
  </div>
@endsection
