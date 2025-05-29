@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Rating</h1>
            <a href="{{ route('rating_pengguna.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>
        </div>

        <form action="{{ route('rating_pengguna.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_penukaran_barang" value="{{ request('id_penukaran') }}">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Review</label>
                <textarea name="review" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32" required></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                <div class="flex items-center space-x-1">
                    <input type="hidden" name="rating" id="selected_rating" value="0">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" 
                                class="star-button text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors duration-150"
                                data-rating="{{ $i }}"
                                onclick="setRating({{ $i }})">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                    @endfor
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('rating_pengguna.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
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
</script>
<!-- Footer -->
<footer class="bg-blue-900 text-white w-full mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Judul Atas -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">
                <span class="text-white">"SwapHub</span> - 
                <span class="text-blue-400">Swap, Use, Save, Sustain</span>
                <span class="text-white">!"</span>
            </h2>
        </div>

        <!-- Garis -->
        <hr class="border-t border-white opacity-30 my-6">

        <!-- Isi Footer -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

            <!-- Kiri -->
        <div class="flex flex-col items-center md:items-start">
            <p class="text-gray-400 mb-4 text-center md:text-left">© 2020 Landify UI Kit.<br>All rights reserved.</p>

            <!-- Logo SWAPHUB -->
            <div class="flex items-center space-x-2 mt-2">
                <img src="{{asset('images/SWAPHUB LOGO.png')}}" alt="SWAPHUB Logo" class="h-16 w-16">
                <span class="text-2xl font-bold">
                    <span class="text-blue-400">SWAP</span><span class="text-gray-400">HUB</span>
                </span>
            </div>
        </div>

            <!-- Tengah -->
            <div class="flex flex-col md:flex-row justify-center gap-12">
                <div>
                    <h4 class="font-semibold mb-3">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">About us</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                        <li><a href="#" class="hover:text-white">Contact us</a></li>
                        <li><a href="#" class="hover:text-white">Pricing</a></li>
                        <li><a href="#" class="hover:text-white">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Help center</a></li>
                        <li><a href="#" class="hover:text-white">Terms of service</a></li>
                        <li><a href="#" class="hover:text-white">Legal</a></li>
                        <li><a href="#" class="hover:text-white">Privacy policy</a></li>
                        <li><a href="#" class="hover:text-white">Rating & Review</a></li>
                    </ul>
                </div>
            </div>

            <!-- Kanan -->
            <div class="flex flex-col items-center md:items-end">
                <h4 class="font-semibold mb-3">Stay up to date</h4>
                <form class="flex w-full max-w-xs">
                    <input type="email" placeholder="Your email address"
                           class="flex-1 px-4 py-2 rounded-l-md bg-blue-800 text-white placeholder-gray-400 focus:outline-none">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-r-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</footer>
@endsection


