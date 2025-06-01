@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50 py-10">
    <div class="px-4 md:px-24">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Enhanced Header Section with Animation -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate-fade-in">
                <div class="flex items-center space-x-3">
                    <div class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg"></div>
                    <h1 class="text-3xl font-bold">
                        Edit <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">Rating</span>
                    </h1>
                </div>
                <a href="{{ route('rating_pengguna.index') }}" 
                   class="group inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md animate-fade-in" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium">Error!</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Enhanced Main Form Card with Animation -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 transform hover:shadow-xl transition-all duration-300 animate-fade-in-up">
                <form action="{{ route('rating_pengguna.update', $rating->id_rating_pengguna) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Fields -->
                    <input type="hidden" name="id_penukaran_barang" value="{{ $rating->id_penukaran_barang }}">
                    <input type="hidden" name="id_user" value="{{ $rating->id_user }}">
                    <input type="hidden" name="id_rating_pengguna" value="{{ $rating->id_rating_pengguna }}">

                    <!-- Enhanced Rating Stars Section -->
                    <div class="space-y-4">
                        <label class="block text-gray-800 text-lg font-semibold">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Ubah Rating
                            </span>
                        </label>
                        <div class="flex items-center justify-center sm:justify-start space-x-3">
                            <input type="hidden" name="rating" id="selected_rating" value="{{ old('rating', $rating->rating) }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        class="star-button text-gray-300 hover:text-yellow-400 focus:outline-none transition-all duration-300 transform hover:scale-125"
                                        data-rating="{{ $i }}"
                                        onclick="setRating({{ $i }})">
                                    <svg class="w-14 h-14 filter drop-shadow-md" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-500 text-center sm:text-left flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Klik bintang untuk mengubah rating (1-5)
                        </p>
                    </div>

                    <!-- Enhanced Review Section -->
                    <div class="space-y-4">
                        <label class="block text-gray-800 text-lg font-semibold">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ubah Review
                            </span>
                        </label>
                        <div class="relative group">
                            <textarea 
                                name="review" 
                                class="w-full px-5 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 min-h-[180px] resize-none group-hover:border-blue-300 @error('review') border-red-500 @enderror"
                                required>{{ old('review', $rating->review) }}</textarea>
                            <div class="absolute bottom-4 right-4 text-gray-400 transition-transform duration-200 transform group-hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                        </div>
                        @error('review')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Enhanced Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
                        <a href="{{ route('rating_pengguna.index') }}" 
                           class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 text-center transform hover:-translate-y-0.5">
                            Batal
                        </a>
                        <button type="submit" 
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center justify-center group">
                            <span>Simpan Perubahan</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out;
}
</style>

<script>
function setRating(rating) {
    document.getElementById('selected_rating').value = rating;
    const stars = document.querySelectorAll('.star-button');
    
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
            star.classList.add('scale-110');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.remove('scale-110');
            star.classList.add('text-gray-300');
        }
    });

    // Enhanced animation effect
    stars[rating - 1].classList.add('scale-125');
    setTimeout(() => {
        stars[rating - 1].classList.remove('scale-125');
        stars[rating - 1].classList.add('scale-110');
    }, 200);

    // Add ripple effect
    const ripple = document.createElement('div');
    ripple.className = 'absolute w-full h-full bg-yellow-400 rounded-full animate-ping opacity-75';
    stars[rating - 1].appendChild(ripple);
    setTimeout(() => ripple.remove(), 1000);
}

// Enhanced hover effect with smooth transitions
document.querySelectorAll('.star-button').forEach((star, index) => {
    star.addEventListener('mouseover', () => {
        const rating = parseInt(star.dataset.rating);
        const stars = document.querySelectorAll('.star-button');
        
        stars.forEach((s, i) => {
            if (i < rating) {
                s.classList.add('text-yellow-300');
                s.style.transform = 'scale(1.1)';
            }
        });
    });

    star.addEventListener('mouseout', () => {
        const currentRating = parseInt(document.getElementById('selected_rating').value);
        const stars = document.querySelectorAll('.star-button');
        
        stars.forEach((s, i) => {
            if (i >= currentRating) {
                s.classList.remove('text-yellow-300');
                s.classList.add('text-gray-300');
                s.style.transform = '';
            }
        });
    });
});

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const initialRating = {{ old('rating', $rating->rating) }};
    setRating(initialRating);
});
</script>
@endsection