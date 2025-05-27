@extends('layouts.app')
@section('title', 'Reviews')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-6">Daftar Review Pengguna</h2>

    @foreach($reviews as $review)
        <div class="bg-white shadow rounded-lg p-4 mb-4">
            <div class="mb-2">
                <span class="font-semibold"{{ $review->user->name }}</span>
            </div>
            <p class="text-gray-700">{{ $review->content }}</p>

            @if ($review->reply)
                <div class="bg-gray-100 rounded p-3 mt-3 text-sm text-gray-800">
                    <strong>Balasan Admin:</strong> {{ $review->reply->reply_text}}
                </div>
            @else
                <a href="{{ route('admin.reviews.replyForm', $review->id) }}" class="inline-block mt-3 bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">
                    Balas Review
                </a>
            @endif
        </div>
    @endforeach
</div>
@endsection