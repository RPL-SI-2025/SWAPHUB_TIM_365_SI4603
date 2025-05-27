@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Rating</h1>

    <form action="{{ route('rating_pengguna.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>ID Penukaran</label>
            <input type="number" name="id_penukaran_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>ID User</label>
            <input type="number" name="id_user" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>ID Rating Pengguna</label>
            <input type="number" name="id_rating_pengguna" class="form-control">
        </div>

        <div class="mb-3">
            <label>Review</label>
            <textarea name="review" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('ratings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
