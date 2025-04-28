@extends('layouts.kategori')

@section('content')
<div class="container">
    <h2>Detail Kategori</h2>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $kategori->nama }}
    </div>

    <div class="mb-3">
        <strong>Jenis:</strong> {{ $kategori->jenis }}
    </div>

    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
