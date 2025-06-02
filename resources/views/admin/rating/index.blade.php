@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Ratings <span class="text-primary">List</span></h1>

    <div class="w-full overflow-x-auto shadow-md rounded-lg">
      <table class="w-full bg-white">
        <thead>
          <tr class="bg-tertiary text-white text-center">
            <th scope="col" class="px-6 py-3">No</th>
            <th scope="col" class="px-6 py-3">User</th>
            <th scope="col" class="px-6 py-3">Rating</th>
            <th scope="col" class="px-6 py-3">Review</th>
            <th scope="col" class="px-6 py-3">Visible</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($ratings as $index => $rating)
            <tr class="bg-white text-gray-700 border-b border-gray-300">
              <td class="px-6 py-4">{{ $index + 1 }}</td>
              <td class="px-6 py-4">{{ $rating->user->full_name }}</td>
              <td class="px-6 py-4">
                <div class="flex gap-1 mb-2">
                  @for ($i = 1; $i <= 5; $i++)
                    <span class="text-xl {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                  @endfor
                </div>
              </td>
              <td class="px-6 py-4 truncate">{{ $rating->review }}</td>
              <td class="px-6 py-4">{{ $rating->is_visible ? 'Yes' : 'No' }}</td>
              <td class="px-6 py-4">
                <span
                  class="px-2 py-1 text-xs font-medium rounded {{ $rating->tanggapan_review ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                  {{ $rating->tanggapan_review ? 'Replied' : 'Not yet replied' }}
                </span>
              </td>
              <td class="px-6 py-4">
                <a href="{{ route('admin.rating.replyForm', $rating->id_rating_website) }}"
                  class="text-white {{ $rating->tanggapan_review ? 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300' : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-300' }} focus:ring-4 focus:outline-none font-medium rounded-lg text-xs px-4 py-2 text-center">
                  {{ $rating->tanggapan_review ? 'Edit' : 'Reply' }}</a>
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
