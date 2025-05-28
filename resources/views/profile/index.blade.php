<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>SwapHub Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
  <style>
    a:hover .icon-path-1 {
      opacity: 0;
    }

    a:hover .icon-path-2 {
      opacity: 1;
      display: block;
    }

    .icon-path-1,
    .icon-path-2 {
      transition: opacity 0.3s ease;
    }
  </style>
</head>

<body class="bg-gray-100">
  @php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
  @endphp

  <!-- Header -->
  <div class="flex items-center justify-between bg-white px-6 py-4 shadow">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/SWAPHUB LOGO.png') }}" alt="logo" class="w-6 h-6">
      <h1 class="text-xl font-bold text-gray-800">SWAPHUB</h1>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-80 transition">
        <span class="font-medium text-gray-700">{{ $user->full_name }}</span>
        <img src="{{ asset(Auth::user()->profile_picture ?? 'photo-profile/default.png') }}?t={{ time() }}"
          alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">

      </a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex max-w-8xl mx-auto mt-8 px-4 gap-5">
    <!-- Sidebar -->
    <aside class="w-150 bg-white rounded-lg shadow p-4">
      <div class="flex items-center gap-x-4 mb-4" class="overflow-hidden">
        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
          <img src="{{ asset(Auth::user()->profile_picture ?? 'photo-profile/default.png') }}" alt="Profile Picture"
            class="object-cover w-full h-full">
        </div>
        <div class="text-gray-800 font-medium text-base">
          {{ $user->full_name }}
        </div>
      </div>

      <nav class="space-y-2 text-sm text-gray-700">
        <a href="{{ route('profile.index') }}"
          class="flex items-center gap-2 text-gray-800 hover:text-blue-600 transform hover:scale-105 transition duration-300 ease-in-out">
          <svg class="w-[25px] h-[25px] transition duration-300 ease-in-out" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
              d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
              clip-rule="evenodd" />
          </svg>
          <span class="transition duration-300 ease-in-out">Profile</span>
        </a>
        <a href="{{ route('wishlist.index') }}"
          class="flex items-center gap-2 text-gray-800 hover:text-blue-600 transform hover:scale-105 transition duration-300 ease-in-out">
          <svg class="w-6 h-6 transition duration-300 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
          </svg>
          <span class="transition duration-300 ease-in-out">Wishlist</span>
        </a>
        <a href="{{ route('home') }}"
          class="flex items-center gap-2 text-gray-800 hover:text-blue-600 transform hover:scale-105 transition duration-300 ease-in-out">
          <svg class="w-6 h-6 transition duration-300 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
              d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z"
              clip-rule="evenodd" />
          </svg>
          <span class="transition duration-300 ease-in-out">Product</span>
        </a>
        <a href="{{ route('notifikasi.index') }}"
          class="flex items-center gap-2 text-gray-800 hover:text-blue-600 transform hover:scale-105 transition duration-300 ease-in-out">
          <svg class="w-6 h-6 text-gray-800 transition-all duration-300 ease-in-out" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path class="icon-path-1"
              d="M17.133 12.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.933.933 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.391A1.001 1.001 0 1 1 6.854 5.8a7.43 7.43 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 17.146 5.8a1 1 0 0 1 1.471-1.354 9.424 9.424 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
            <path class="icon-path-2 hidden" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"
              d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.193-.538 1.193H5.538c-.538 0-.538-.6-.538-1.193 0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365Zm-8.134 5.368a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M8.54 17.901a3.48 3.48 0 0 0 6.92 0H8.54Z" />
          </svg>
          <span class="transition duration-300 ease-in-out">Notification</span>
        </a>
        <!-- Tombol Laporkan Penipuan -->
        <a href="{{ route('laporan_penipuan.create') }}" class="flex items-center gap-2 text-gray-800 hover:text-yellow-600 transform hover:scale-105 transition duration-300 ease-in-out">
          <svg class="w-6 h-6 transition duration-300 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 2a1 1 0 0 1 .894.553l7 14A1 1 0 0 1 19 18H5a1 1 0 0 1-.894-1.447l7-14A1 1 0 0 1 12 2Zm0 3.09L6.618 16h10.764L12 5.09Zm-1 7.91a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2Zm1 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
          </svg>
          <span class="transition duration-300 ease-in-out">Laporkan Penipuan</span>
        </a>
      </nav>
    </aside>

    <!-- Profile Section -->
    <section class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
      <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col md:flex-row gap-6">
          <!-- Profile Photo -->
          <div class="flex flex-col items-center">
            <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center mb-2">
              <img src="{{ asset(Auth::user()->profile_picture ?? 'photo-profile/default.png') }}"
                alt="Profile Picture" class="object-cover w-full h-full">
            </div>
            <!-- Hidden File Input -->
            <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*">

            <!-- Label as Button -->
            <label for="profile_picture" class="text-sm border px-3 py-1 rounded cursor-pointer hover:bg-gray-100">
              Change Photo
            </label>
          </div>

          <!-- Data Fields -->
          <div class="space-y-4 text-sm text-gray-800">
            <!-- Biodata Section -->
            <div>
              <h2 class="font-semibold text-gray-700 mb-2">Change Personal Biodata</h2>
              <div class="grid grid-cols-3 gap-2 items-center">
                <div>Name</div>
                <div>{{ $user->full_name }}</div>
                <a data-modal-target="editNameModal" data-modal-toggle="editNameModal"
                  class="text-green-600 hover:underline text-sm">
                  Ubah
                </a>
              </div>
            </div>

            <!-- Kontak Section -->
            <div>
              <h2 class="font-semibold text-gray-700 mt-6 mb-2">Change Contact</h2>

              <!-- Email -->
              <div class="grid grid-cols-3 gap-2 items-center">
                <div>Email</div>
                <div class="flex items-center gap-2">
                  <span>{{ $user->email }}</span>
                  @if ($user->email)
                    <span
                      class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-1 rounded">Terverifikasi</span>
                  @else
                    <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-1 rounded">
                      Belum Terverifikasi
                    </span>
                  @endif
                </div>
                <div class="text-right">
                  <a data-modal-target="editEmailModal" data-modal-toggle="editEmailModal"
                    class="text-green-600 hover:underline text-sm">
                    Ubah
                  </a>
                </div>

                <div>Nomor HP</div>
                <div class="flex items-center gap-2">
                  <span>{{ $user->phone }}</span>
                  @if ($user->phone)
                    <span
                      class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-1 rounded">Terverifikasi</span>
                  @else
                    <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-1 rounded">
                      Belum Terverifikasi
                    </span>
                  @endif
                </div>
                <div class="text-right">
                  <a data-modal-target="editPhoneModal" data-modal-toggle="editPhoneModal"
                    class="text-green-600 hover:underline text-sm">
                    Ubah
                  </a>
                </div>
              </div>

            </div>

          </div>

        </div>
      </form>
      <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit"
          class="flex items-center gap-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
          <svg class="w-[25px] h-[25px] text-white-800 dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
              d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
          </svg>
          <span>Log Out</span>
        </button>
      </form>
    </section>
  </div>

  <!-- Footer -->
  <footer class="mt-12 text-center text-sm text-gray-600 py-4">
    <hr class="mb-2 border-gray-300">
    <p><strong>SwapHub</strong> — Swap, Use, Save, Sustain!</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>

</html>
@include('profile.editprofile')
