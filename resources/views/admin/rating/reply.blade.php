@extends('layouts.admin.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-6">Balas Review</h2>

    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <div class="mb-1 text-gray-600">Review dari: {{ $rating->user->full_name }}</div>
        <div class="mb-1 text-gray-600">{{ $rating->rating }}★</div>
        <div class="font-semibold">{{ $rating->review }}</div>
    </div>

    <form action="{{ route('admin.rating.reply', $rating->id_rating_website) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="tanggapan_review" class="block text-sm font-medium text-gray-700">Balasan</label>
            <textarea name="tanggapan_review" id="tanggapan_review" rows="4" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm p-2">
            </textarea>
            @error('tanggapan_review')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                Kirim Balasan
            </button>
            <a href="{{ route('admin.rating.index') }}" class="ml-2 text-sm text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection