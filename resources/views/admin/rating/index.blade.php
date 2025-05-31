@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Ratings <span class="text-primary">List</span></h1>
    
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">User</th>
                <th scope="col" class="px-6 py-3">Rating</th>
                <th scope="col" class="px-6 py-3">Review</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($ratings as $index => $rating)
                <tr class="bg-white text-gray-700 border-b">
                <td class="px-6 py-4">{{ $index + 1 }}</td>
                <td class="px-6 py-4">{{ $rating->user->full_name }}</td>
                <td class="px-6 py-4">{{ $rating->rating }}</td>
                <td class="px-6 py-4 truncate">{{ $rating->review }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.rating.replyForm', $rating->id_rating_website) }}"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 text-center">
                    Reply</a>
                </tr>
            @empty
                <tr>
                <td colspan="5" class="text-center px-6 py-4">No ratings found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>
    </div>
@endsection