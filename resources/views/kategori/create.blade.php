@extends('layouts.kategori')

@section('content')
<div class="container">
    <h2>Buat Kategori Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan saat input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Kategori</label>
            <select name="jenis" class="form-control" id="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Barang" {{ old('jenis') == 'Barang' ? 'selected' : '' }}>Barang</option>
                <option value="Pelaporan" {{ old('jenis') == 'Pelaporan' ? 'selected' : '' }}>Pelaporan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
