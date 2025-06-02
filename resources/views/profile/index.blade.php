@extends('layouts.app')

@section('content')
  @php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
  @endphp

  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Profile Section -->
    <section class="w-full bg-white rounded-lg shadow-lg p-8 flex-1">
      <h1 class="text-3xl font-bold text-shadow-lg mb-10">Personalisasi <span class="text-primary">Profile</h1>

      <div class="flex flex-col md:flex-row gap-8">
        <!-- Profile Photo -->
        <div class="flex flex-col items-center">
          <div class="w-56 h-56 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center mb-6">
            <img
              src="{{ !empty(Auth::user()->profile_picture) ? Storage::url(Auth::user()->profile_picture) : asset('photo-profile/default.png') }}"
              alt="Profile Picture" class="object-cover w-full h-full">
          </div>
        </div>

        <!-- Personal Data and Buttons -->
        <div class="flex-1 space-y-6 text-sm text-gray-800">
          <h2 class="font-bold text-gray-700 mb-4">Personal Data</h2>
          <div class="grid grid-cols-3 gap-4 items-center">
            <div class="font-medium">Name</div>
            <div class="col-span-2 flex items-center justify-between">
              <span>{{ $user->full_name }}</span>
              <a data-modal-target="editNameModal" data-modal-toggle="editNameModal"
                class="text-green-600 hover:text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </a>
            </div>
          </div>
          <div class="grid grid-cols-3 gap-4 items-center">
            <div class="font-medium">Phone</div>
            <div class="col-span-2 flex items-center justify-between">
              <span>{{ $user->phone ?? 'Not set' }}</span>
              <a data-modal-target="editPhoneModal" data-modal-toggle="editPhoneModal"
                class="text-green-600 hover:text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </a>
            </div>
          </div>
          <div class="grid grid-cols-3 gap-4 items-center">
            <div class="font-medium">Email</div>
            <div class="col-span-2 flex items-center justify-between">
              <span>{{ $user->email ?? 'Not set' }}</span>
              <a data-modal-target="editEmailModal" data-modal-toggle="editEmailModal"
                class="text-green-600 hover:text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </a>
            </div>
          </div>
          <div class="grid grid-cols-3 gap-4 items-center">
            <div class="font-medium">Password</div>
            <div class="col-span-2">********</div>
          </div>

          <!-- Buttons -->
          <div class="flex justify-between gap-1 mt-8">
            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data"
              class="inline-block">
              @csrf
              @method('PUT')
              <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*">
              <label for="profile_picture"
                class="flex items-center gap-2 text-white bg-tertiary px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-md transition duration-300 w-full sm:w-auto text-center">
                <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Change Photo
              </label>

              <!-- Tombol Submit yang awalnya disembunyikan -->
              <button type="submit" id="submitBtn"
                class="text-white bg-primary px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:bg-primary-hover hover:text-white hover:shadow-md transition duration-300 w-full mt-3 text-center hidden">
                Submit Photo
              </button>
            </form>
            <form action="{{ route('logout') }}" method="POST" class="inline-block logout-form">
              @csrf
              <button type="submit"
                class="flex items-center gap-2 text-white bg-red-500 px-4 sm:px-8 py-2 sm:py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-md transition duration-300 w-full sm:w-auto text-center">
                <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                    d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                </svg>
                Log Out
              </button>
            </form>
          </div>
        </div>
    </section>
  </div>

  {{-- Sript Foto Profil --}}
  <script>
    const fileInput = document.getElementById('profile_picture');
    const submitBtn = document.getElementById('submitBtn');

    fileInput.addEventListener('change', function() {
      if (fileInput.files.length > 0) {
        submitBtn.classList.remove('hidden');
      } else {
        submitBtn.classList.add('hidden');
      }
    });
  </script>
@endsection
@include('profile.editprofile')
