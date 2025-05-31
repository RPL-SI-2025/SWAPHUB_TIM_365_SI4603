@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')
  <div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">User <span class="text-primary">List</span></h1>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">
              No
            </th>
            <th scope="col" class="px-6 py-3">
              ID
            </th>
            <th scope="col" class="px-6 py-3">
              Name
            </th>
            <th scope="col" class="px-6 py-3">
              Email
            </th>
            <th scope="col" class="px-6 py-3">
              Role
            </th>
            <th scope="col" class="px-6 py-3">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $index => $user)
            <tr class="bg-white text-gray-700 border-b ">
              <td class="px-6 py-4">
                {{ $index + 1 }}
              </td>
              <td class="px-6 py-4">
                {{ $user->id }}
              </td>
              <td class="px-6 py-4">
                {{ $user->full_name }}
              </td>
              <td class="px-6 py-4">
                {{ $user->email }}
              </td>
              <td class="px-6 py-4">
                {{ $user->role }}
              </td>
              <td class="px-6 py-4">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-4 py-2 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    Delete
                  </button>
                </form>
                </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-4 text-center">
                No users found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
