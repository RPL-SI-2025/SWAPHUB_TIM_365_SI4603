@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Rating</h1>
    <a href="{{ route('rating_pengguna.create') }}" class="btn btn-primary mb-3">Tambah Rating</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Penukaran</th>
                <th>ID User</th>
                <th>ID Rating Pengguna</th>
                <th>Review</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ratings as $rating)
            <tr>
                <td>{{ $rating->id }}</td>
                <td>{{ $rating->id_penukaran_barang }}</td>
                <td>{{ $rating->id_user }}</td>
                <td>{{ $rating->id_rating_pengguna }}</td>
                <td>{{ $rating->review }}</td>
                <td>{{ $rating->rating }}</td>
                <td>
                    <a href="{{ route('ratings.edit', $rating->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rating ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
