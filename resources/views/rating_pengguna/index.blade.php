@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
        Daftar <span class="text-blue-600 drop-shadow-md">Rating</span>
      </h1>
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
                        @if(Auth::id() === $rating->id_user || 
                            Auth::id() === $rating->penukaran->id_penawar || 
                            Auth::id() === $rating->penukaran->id_ditawar)
                            <a href="{{ route('rating_pengguna.edit', $rating->id_rating_pengguna) }}" 
                               class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-md inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


