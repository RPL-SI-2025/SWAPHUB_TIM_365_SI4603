@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Rating</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Penawar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ditawar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Review</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Rating</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($ratings as $rating)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $rating->penukaran->penawar->first_name ?? '-' }} {{ $rating->penukaran->penawar->last_name ?? '' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $rating->penukaran->ditawar->first_name ?? '-' }} {{ $rating->penukaran->ditawar->last_name ?? '' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $rating->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $rating->penukaran->barangPenawar->kategori->nama_kategori ?? '-' }} / 
                        {{ $rating->penukaran->barangDitawar->kategori->nama_kategori ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $rating->review }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('rating_pengguna.edit', $rating->id_rating_pengguna) }}" 
                               class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('rating_pengguna.destroy', $rating->id_rating_pengguna) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus rating ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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


