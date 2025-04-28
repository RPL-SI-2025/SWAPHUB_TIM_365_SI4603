@extends('layouts.kategori')

@section('content')
<div class="container">
    <h2>Edit Kategori</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Kategori</label>
            <select name="jenis" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Barang" {{ old('jenis', $kategori->jenis) == 'Barang' ? 'selected' : '' }}>Barang</option>
                <option value="Pelaporan" {{ old('jenis', $kategori->jenis) == 'Pelaporan' ? 'selected' : '' }}>Pelaporan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
