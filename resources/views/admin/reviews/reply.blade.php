@extends('layouts.app')
@section('title', 'Balas Review')
@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-6">Balas Review</h2>

    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <div class="mb-1 text-gray-600">Review dari:</div>
        <div class="font-semibold">{{ $review->content }}</div>
    </div>

    <form action="{{ route('admin.replies.store', $review->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="reply_text" class="block text-sm font-medium text-gray-700">Balasan</label>
            <textarea name="reply_text" id="reply_text" rows="4" required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm p-2">
        </textarea>
        </div>
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                Kirim Balasan
            </button>
            <a href="{{ route('admin.reviews.index') }}" class="ml-2 text-sm text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection