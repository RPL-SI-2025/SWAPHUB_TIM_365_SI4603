@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50 px-4 md:px-12 lg:px-24 py-10">
    <!-- Enhanced Header Section -->
    <div class="max-w-full mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-1.5 h-8 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg"></div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Daftar <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">Rating</span>
                </h1>
            </div>
            <a href="{{ route('history.index') }}" 
                class="group inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Riwayat
            </a>
        </div>

        <!-- Rating dari Penawar Section -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <div class="w-1 h-6 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg mr-3"></div>
                <h2 class="text-xl font-semibold text-gray-800">Rating dari Penawar</h2>
            </div>
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="min-w-full">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-900 to-blue-800">
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/4 first:rounded-tl-3xl">Riwayat Penukaran</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Penawar</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Ditawar</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Tanggal</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Review</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12">Rating</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12 last:rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($ratings->where('rating_type', 'penawar') as $rating)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="px-4 py-4">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900 mb-1 truncate">
                                                {{ $rating->penukaran->barangPenawar->nama_barang ?? '-' }}
                                            </p>
                                            <p class="text-gray-500 flex items-center truncate">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                                <span class="truncate">{{ $rating->penukaran->barangDitawar->nama_barang ?? '-' }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 font-medium">{{ substr($rating->penukaran->penawar->first_name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                                                    {{ $rating->penukaran->penawar->first_name ?? '-' }} {{ $rating->penukaran->penawar->last_name ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 font-medium">{{ substr($rating->penukaran->ditawar->first_name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                                                    {{ $rating->penukaran->ditawar->first_name ?? '-' }} {{ $rating->penukaran->ditawar->last_name ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $rating->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $rating->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-sm text-gray-900 truncate max-w-[150px]" title="{{ $rating->review }}">
                                            {{ $rating->review }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-150" 
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                            @if(Auth::id() === $rating->penukaran->id_penawar)
                                                <a href="{{ route('rating_pengguna.edit', $rating->id_rating_pengguna) }}" 
                                                    class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 transform hover:-translate-y-0.5 shadow hover:shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('rating_pengguna.destroy', $rating->id_rating_pengguna) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:-translate-y-0.5 shadow hover:shadow-md"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">Belum ada rating dari penawar</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rating dari Yang Ditawar Section -->
        <div>
            <div class="flex items-center mb-6">
                <div class="w-1 h-6 bg-gradient-to-b from-blue-600 to-blue-800 rounded-lg mr-3"></div>
                <h2 class="text-xl font-semibold text-gray-800">Rating dari Yang Ditawar</h2>
            </div>
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="min-w-full">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-900 to-blue-800">
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/4 first:rounded-tl-3xl">Riwayat Penukaran</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Penawar</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Ditawar</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Tanggal</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/6">Review</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12">Rating</th>
                                <th class="px-4 py-4 text-left text-xs font-medium text-white uppercase tracking-wider w-1/12 last:rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($ratings->where('rating_type', 'ditawar') as $rating)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="px-4 py-4">
                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900 mb-1 truncate">
                                                {{ $rating->penukaran->barangPenawar->nama_barang ?? '-' }}
                                            </p>
                                            <p class="text-gray-500 flex items-center truncate">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                                <span class="truncate">{{ $rating->penukaran->barangDitawar->nama_barang ?? '-' }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 font-medium">{{ substr($rating->penukaran->penawar->first_name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                                                    {{ $rating->penukaran->penawar->first_name ?? '-' }} {{ $rating->penukaran->penawar->last_name ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                <span class="text-gray-600 font-medium">{{ substr($rating->penukaran->ditawar->first_name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 truncate max-w-[120px]">
                                                    {{ $rating->penukaran->ditawar->first_name ?? '-' }} {{ $rating->penukaran->ditawar->last_name ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $rating->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $rating->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-sm text-gray-900 truncate max-w-[150px]" title="{{ $rating->review }}">
                                            {{ $rating->review }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-150" 
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                            @if(Auth::id() === $rating->penukaran->id_ditawar)
                                                <a href="{{ route('rating_pengguna.edit', $rating->id_rating_pengguna) }}" 
                                                    class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 transform hover:-translate-y-0.5 shadow hover:shadow-md">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('rating_pengguna.destroy', $rating->id_rating_pengguna) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:-translate-y-0.5 shadow hover:shadow-md"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">Belum ada rating dari yang ditawar</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


