@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Rating</h1>
                    <a href="{{ route('rating_pengguna.index') }}" class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

                <form action="{{ route('rating_pengguna.update', $rating->id_rating_pengguna) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Hidden fields to keep reference to penukaran and user --}}
                    <input type="hidden" name="id_penukaran_barang" value="{{ $rating->id_penukaran_barang }}">
                    <input type="hidden" name="id_user" value="{{ $rating->id_user }}">
                    <input type="hidden" name="id_rating_pengguna" value="{{ $rating->id_rating_pengguna }}">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Review</label>
                        <textarea name="review" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32 @error('review') border-red-500 @enderror"
                                required>{{ old('review', $rating->review) }}</textarea>
                        @error('review')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                        <div class="flex items-center space-x-1">
                            <input type="hidden" name="rating" id="selected_rating" value="{{ old('rating', $rating->rating) }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        class="star-button {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 focus:outline-none transition-colors duration-150"
                                        data-rating="{{ $i }}"
                                        onclick="setRating({{ $i }})">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                    <a href="{{ route('rating_pengguna.index') }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-150 ease-in-out">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150 ease-in-out">
                        Simpan Perubahan
                    </button>
                    </div>
                </form>
            </div>
    </div>

    <script>
    function setRating(rating) {
        document.getElementById('selected_rating').value = rating;
        const stars = document.querySelectorAll('.star-button');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const initialRating = {{ old('rating', $rating->rating) }};
        setRating(initialRating);
    });
    </script>
@endsection