@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Rating</h1>

    <form action="{{ route('rating_pengguna.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>ID Penukaran</label>
            <input type="number" name="id_penukaran_barang" class="form-control" value="{{ $rating->id_penukaran_barang }}" required>
        </div>

        <div class="mb-3">
            <label>ID User</label>
            <input type="number" name="id_user" class="form-control" value="{{ $rating->id_user }}" required>
        </div>

        <div class="mb-3">
            <label>ID Rating Pengguna</label>
            <input type="number" name="id_rating_pengguna" class="form-control" value="{{ $rating->id_rating_pengguna }}">
        </div>

        <div class="mb-3">
            <label>Review</label>
            <textarea name="review" class="form-control">{{ $rating->review }}</textarea>
        </div>

        <div class="mb-3">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" value="{{ $rating->rating }}" min="1" max="5" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('ratings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
