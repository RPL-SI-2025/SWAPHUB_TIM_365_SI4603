@extends('layouts.kategori')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md animate-fade-in">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Detail Kategori</h2>

        <div class="mb-4">
            <strong class="block text-gray-700 mb-1">Nama:</strong>
            <p class="text-gray-600">{{ $kategori->nama }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-gray-700 mb-1">Jenis:</strong>
            <p class="text-gray-600">{{ $kategori->jenis }}</p>
        </div>

        <div class="flex justify-center mt-6">
            <a href="{{ route('kategori.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
