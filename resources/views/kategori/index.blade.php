@extends('layouts.kategori')

@section('content')
<div class="container">
    <h2>Daftar Kategori</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-4">Tambah Kategori</a>

    <!-- Tabel Barang -->
    <h3>Kategori Barang</h3>
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>
                        <a href="{{ route('kategori.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada kategori Barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabel Pelaporan -->
    <h3>Kategori Pelaporan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelaporan as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>
                        <a href="{{ route('kategori.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada kategori Pelaporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
