<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>SwapHub - Swap, Use, Save, Sustain!</title>

  {{-- Flowbite --}}
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  {{-- TailwindCSS --}}
  @vite(['resources/css/app.css'])

</head>

<body class="font-inter">

  {{-- Navbar --}}
  <nav class="bg-white">
    <div class="container pe-4 md:px-4 lg:px-24 flex flex-wrap items-center justify-between mx-auto">
      <a href="/" class="flex items-center space-x-3">
        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" class="h-20" alt="SwapHub Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap text-primary text-shadow-lg">
          <span class="md:text-primary">SWAP</span><span class="text-tertiary">HUB</span>
        </span>
      </a>
      @include('layouts.menu-user')
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
        <ul
          class="flex flex-col text-shadow-lg font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
          @guest
            <li>
              <a href="#form-section"
                class="block py-2 px-3 text-white bg-primary rounded-sm md:bg-transparent md:text-primary md:p-0"
                aria-current="page">Join</a>
            </li>
          @else
            <li>
              <a href="#collection"
                class="block py-2 px-3 text-white bg-primary rounded-sm md:bg-transparent md:text-primary md:p-0"
                aria-current="page">Collection</a>
            </li>
          @endguest
          <li>
            <a href="#about"
              class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary md:p-0">About</a>
          </li>
          <li>
            <a href="#features"
              class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary md:p-0">Features</a>
          </li>
          <li>
            <a href="#review"
              class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary md:p-0">Review</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Hero Section --}}
  <section class="bg-secondary px-4 md:px-24 py-10 animate-fade-in">
    <div class="container mx-auto md:flex justify-between items-center">
      <div class="flex-1 my-auto text-shadow-lg text-center md:text-start">
        <h1 class="text-5xl font-bold text-tertiary">The best way to <span class="text-primary">Swap</span> &
          <span class="text-primary">Reuse</span> items with
          your friends!
        </h1>
        <p class="my-6">SwapHub hadir sebagai solusi inovatif untuk memfasilitasi pertukaran barang antar mahasiswa
          dalam satu
          platform yang aman dan terpercaya.</p>
        <a href="#about"
          class="px-4 py-2 bg-primary hover:bg-primary-hover w-full text-white inline-block rounded-sm font-semibold">Learn
          More</a>
      </div>
      <div class="hidden md:block flex-1">
        <img src="{{ asset('images/grafiklanding1.png') }}" alt="image" class="w- mx-auto">
      </div>
    </div>
  </section>

  @guest
    {{-- Auth Section --}}
    <section class="flex flex-col justify-center items-center px-4 md:px-24 py-10 animate-fade-slide-up">
      <h2 class="text-3xl font-bold text-tertiary text-center text-shadow-lg mb-8"><span class="text-primary">SIGN
          UP</span>
        & <span class="text-primary">ENJOY</span> YOUR SWAPHUB!</h2>

      {{-- Tombol toggle pill  --}}
      <div class="mb-6 md:hidden bg-white rounded-full shadow-md flex p-1 w-full max-w-xs">
        <button id="showRegister"
          class="flex-1 text-center py-2 rounded-full font-semibold text-tertiary hover:bg-tertiary-hover hover:text-white">
          Sign Up
        </button>
        <button id="showLogin"
          class="flex-1 text-center py-2 rounded-full font-semibold text-white bg-primary hover:bg-primary-hover hover:text-white">
          Log In
        </button>
      </div>

      {{-- Container form  --}}
      <div class="container md:flex md:space-x-10" id="form-section">
        {{-- Register Form  --}}
        <div id="registerForm" class="w-full md:w-1/2 bg-secondary p-6 shadow-lg rounded-lg hidden md:block">
          <h2 class="text-2xl font-bold mb-4 text-tertiary text-center">Sign Up</h2>

          @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-300">
              {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-300">
              <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row md:gap-4">
              <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Your first name"
                class="w-full px-4 py-2 mb-4 border rounded-sm" required />
              <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Your last name"
                class="w-full px-4 py-2 mb-4 border rounded-sm" required />
            </div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
              class="w-full px-4 py-2 mb-4 border rounded-sm" required />
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Your phone number"
              class="w-full px-4 py-2 mb-4 border rounded-sm" required />
            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 mb-4 border rounded-sm"
              required />
            <input type="password" name="password_confirmation" placeholder="Confirm password"
              class="w-full px-4 py-2 mb-4 border rounded-sm" required />

            <select name="role" class="w-full px-4 py-2 mb-4 border rounded-sm">
              <option value="">Select Role</option>
              <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <label class="block text-gray-700 mb-2 text-sm">Upload Profile Picture (optional)</label>
            <input type="file" name="profile_picture" class="w-full mb-4 border rounded-sm" accept="image/*">

            <button type="submit"
              class="w-full bg-tertiary text-white py-2 rounded-sm hover:bg-tertiary-hover cursor-pointer">Sign
              Up</button>
          </form>
        </div>

        {{-- Login Form  --}}
        <div id="loginForm" class="w-full md:w-1/2 bg-secondary p-6 shadow-lg rounded-lg">
          <h2 class="text-2xl font-bold mb-4 text-primary text-center">Log in</h2>

          @if (session('loginError'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-300">
              {{ session('loginError') }}
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 mb-4 border rounded-sm"
              required />
            <input type="password" name="password" placeholder="Password"
              class="w-full px-4 py-2 mb-4 border rounded-sm" required />
            <button type="submit"
              class="w-full bg-primary text-white py-2 rounded-sm hover:bg-primary-hover cursor-pointer">Login</button>
          </form>
        </div>
      </div>
    </section>
  @endguest

  {{-- Collection Section --}}
  <section class="bg-secondary px-4 md:px-24 py-10 animate-fade-slide-up" id="collection">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
        OUR <span class="text-primary">COLLECTION</span>
      </h2>

      <div class="overflow-x-hidden whitespace-nowrap carousel-container pb-4 relative">
        <div id="carousel" class="flex space-x-4 animate-scroll">
          @forelse ($barang as $item)
            <div class="relative inline-block min-w-[200px] max-w-[250px]">
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}"
                class="w-full h-48 object-cover rounded-lg shadow-md" />
              <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                Tersedia
              </div>
            </div>
          @empty
            <p class="mx-auto text-gray-600">Tidak ada barang yang tersedia saat ini.</p>
          @endforelse
          <!-- Duplikat konten untuk efek looping -->
          @forelse ($barang as $item)
            <div class="relative inline-block min-w-[200px] max-w-[250px]">
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}"
                class="w-full h-48 object-cover rounded-lg shadow-md" />
              <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                Tersedia
              </div>
            </div>
          @empty
            <p class="mx-auto text-gray-600">Tidak ada barang yang tersedia saat ini.</p>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  {{-- About Section --}}
  <section class="px-4 md:px-24 py-10 animate-fade-slide-up" id="about">
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-10">

      {{-- Gambar  --}}
      <div class="w-full md:w-1/3">
        <img src="{{ asset('images/WHATIS.jpg') }}" alt="What is SwapHub" class="h-full rounded-lg" />
      </div>

      {{-- Deskripsi  --}}
      <div class="w-full md:w-2/3">
        <h2 class="text-3xl font-bold text-center md:text-left text-tertiary text-shadow-lg mb-8">
          WHAT IS <span class="text-primary">SWAPHUB</span><span class="text-swaphub">?</span>
        </h2>
        <p class="text-gray-700 leading-relaxed text-justify">
          SwapHub adalah platform web yang memudahkan mahasiswa bertukar barang secara efisien dan aman.
          Dengan fitur algoritma pencocokan, verifikasi akun, serta rating & ulasan transparan, SwapHub membangun
          kepercayaan dan mendorong praktik ekonomi timbal balik yang berkelanjutan.
          <br><br>
          Platform ini berkontribusi pada <strong>SDG 12</strong> (konsumsi dan produksi bertanggung jawab)
          dengan mengurangi limbah melalui penggunaan kembali barang, serta mendukung <strong>SDG 11</strong>
          untuk membentuk komunitas yang lebih ramah lingkungan dan berkelanjutan.
        </p>
      </div>

    </div>
  </section>

  {{-- Features Section --}}
  <section class="bg-secondary px-4 md:px-24 py-10 animate-fade-slide-up" id="features">
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-10">

      {{-- Gambar  --}}
      <div class="w-full md:w-1/3">
        <img src="{{ asset('images/FEATURES.jpg') }}" alt="Features" class="h-full rounded-lg" />
      </div>

      {{-- Deskripsi  --}}
      <div class="w-full md:w-2/3">
        <h2 class="text-3xl font-bold text-center md:text-left text-tertiary text-shadow-lg mb-8">
          AVAILABLE <span class="text-primary">FEATURES</span>
        </h2>
        <ul class="text-gray-700 leading-relaxed space-y-4">
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9H9m-5 7a8.001 8.001 0 0015.356 2H15v5" />
              </svg>
            </div>
            Pertukaran Barang
          </li>
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            Pencarian & Filter Barang
          </li>
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.519-4.674z" />
              </svg>
            </div>
            Rating and review sistem
          </li>
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm8-6h-2m2 4h-2m2 4h-2" />
              </svg>
            </div>
            Keamanan & Verifikasi Pengguna
          </li>
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
              </svg>
            </div>
            Manajemen Transaksi & Riwayat
          </li>
          <li class="flex items-center gap-3">
            <div class="bg-primary rounded-full p-2">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
            </div>
            Feedback & Saran Pengguna
          </li>
        </ul>
      </div>
    </div>
  </section>

  {{-- Testimonial/Review Section --}}
  <section class="px-4 md:px-24 py-10 animate-fade-slide-up" id="review">
    <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
      THEY <span class="text-primary">SAID...</span>
    </h2>

    <div class="overflow-x-hidden whitespace-nowrap carousel-container-review pb-4 relative">
      <div id="carousel-review" class="flex space-x-4 animate-scroll">
        @forelse ($allRating as $rating)
          <div class="min-w-[200px] max-w-[250px] bg-secondary p-6 text-center rounded-xl shadow-md">
            <img
              src="{{ $rating->user->profile_picture ? Storage::url($rating->user->profile_picture) : asset('photo-profile/default.png') }}"
              alt="Profile Picture" class="w-full h-[150px] rounded-lg object-cover mb-4">
            <div class="flex justify-center gap-2 mb-2">
              @for ($i = 1; $i <= 5; $i++)
                <span class="text-3xl {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
              @endfor
            </div>
            <p class="text-sm text-gray-600 leading-5 mb-3">
              "{{ $rating->review }}"
            </p>
            <div class="font-semibold text-sm text-primary">{{ $rating->user->full_name }}</div>
          </div>
        @empty
          <p class="mx-auto text-gray-600">Tidak ada review yang tersedia saat ini.</p>
        @endforelse
        <!-- Duplikat konten untuk efek looping -->
        @forelse ($allRating as $rating)
          <div class="min-w-[200px] max-w-[250px] bg-secondary p-6 text-center rounded-xl shadow-md">
            <img
              src="{{ $rating->user->profile_picture ? Storage::url($rating->user->profile_picture) : asset('photo-profile/default.png') }}"
              alt="Profile Picture" class="w-full h-[150px] rounded-lg object-cover mb-4">
            <div class="flex justify-center gap-2 mb-2">
              @for ($i = 1; $i <= 5; $i++)
                <span class="text-3xl {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
              @endfor
            </div>
            <p class="text-sm text-gray-600 leading-5 mb-3">
              "{{ $rating->review }}"
            </p>
            <div class="font-semibold text-sm text-primary">{{ $rating->user->full_name }}</div>
          </div>
        @empty
          <p class="mx-auto text-gray-600">Tidak ada review yang tersedia saat ini.</p>
        @endforelse
      </div>
    </div>
  </section>


  @if (Auth::user() && !Auth::user()->is_admin)
    <section id="rating" class="animate-fade-slide-up">
      <div class="py-16 px-6 md:px-24 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
          Give Us <span class="text-primary">Feedback</span> for <span class="text-primary">Improvement</span>
        </h2>

        <div class="w-full md:w-1/2 mx-auto">
          {{-- ALERTS --}}
          @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
              {{ session('success') }}
            </div>
          @endif

          @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
              {{ session('error') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
              <ul class="list-disc list-inside text-left">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        @if ($userRating)
          {{-- EXISTING RATING --}}
          <div class="bg-white rounded-lg shadow-lg p-6 mb-6 flex flex-col gap-5 w-full md:w-1/2 mx-auto">
            <h3 class="text-xl font-bold mb-2">Your <span class="text-primary">Current Rating</span></h3>
            <div class="flex justify-center gap-2 mb-2">
              @for ($i = 1; $i <= 5; $i++)
                <span class="text-5xl {{ $i <= $userRating->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
              @endfor
            </div>
            <p><strong>Your Review:</strong> {{ $userRating->review }}</p>
            <p class="text-sm text-gray-500">Submitted on {{ $userRating->created_at->format('M d, Y') }} |
              <span class="text-primary">{{ $userRating->is_visible ? 'Visible' : 'Not visible' }}</span> in landing
              page
            </p>

            @if ($userRating->tanggapan_review)
              <p><strong>Admin Reply:</strong> {{ $userRating->tanggapan_review }}</p>
            @else
              <p>Belum ada tanggapan dari admin</p>
            @endif
            <div class="flex justify-center gap-4">
              <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                onclick="toggleEditForm()">Edit</button>

              <form method="POST" action="{{ route('rating.destroy', $userRating->id_rating_website) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')"
                  class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                  Delete
                </button>
              </form>
            </div>

          </div>

          {{-- EDIT FORM --}}
          <div id="editForm" class="hidden bg-white rounded-lg shadow-lg p-6 w-full md:w-1/2 mx-auto">
            <h3 class="text-xl font-semibold mb-4">Edit Your Rating</h3>
            <form method="POST" action="{{ route('rating.update', $userRating->id_rating_website) }}"
              class="flex flex-col gap-5">
              @csrf
              @method('PUT')

              <div class="flex flex-row-reverse justify-center gap-4 stars">
                @for ($i = 5; $i >= 1; $i--)
                  <input type="radio" name="rating" id="edit_star{{ $i }}"
                    value="{{ $i }}" class="hidden" {{ $userRating->rating == $i ? 'checked' : '' }}>
                  <label for="edit_star{{ $i }}" class="text-5xl text-gray-300 cursor-pointer">★</label>
                @endfor
              </div>

              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_visible" value="1" class="sr-only peer"
                  {{ old('is_visible', $userRating->is_visible ?? false) ? 'checked' : '' }}>
                <div
                  class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900">
                  Show Rating in Landing Page
                </span>
              </label>

              <textarea name="review" placeholder="Update your message" required
                class="w-full p-3 border border-gray-300 rounded h-[150px] resize-none">{{ $userRating->review }}</textarea>

              <div class="flex justify-center gap-4">
                <button type="submit"
                  class="bg-primary text-white px-6 py-2 rounded hover:bg-primary-hover cursor-pointer">Update</button>
                <button type="button" onclick="toggleEditForm()"
                  class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</button>
              </div>
            </form>
          </div>
        @else
          {{-- NEW RATING FORM --}}
          <form method="POST" action="{{ route('rating.store') }}"
            class="bg-white p-6 rounded-lg shadow-lg mx-auto w-full md:w-1/2 flex flex-col gap-5">
            @csrf

            <div class="flex flex-row-reverse justify-center gap-4 mb-4 stars">
              @for ($i = 5; $i >= 1; $i--)
                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                  class="hidden" required>
                <label for="star{{ $i }}" class="text-5xl text-gray-300 cursor-pointer">★</label>
              @endfor
            </div>

            <label class="inline-flex items-center cursor-pointer">
              <input type="checkbox" name="is_visible" value="1" class="sr-only peer"
                {{ old('is_visible', $rating->is_visible ?? false) ? 'checked' : '' }}>
              <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
              </div>
              <span class="ms-3 text-sm font-medium text-gray-900">
                Show Rating in Landing Page
              </span>
            </label>


            <textarea name="review" placeholder="Message" required
              class="w-full p-3 border border-gray-300 rounded mb-4 h-[150px] resize-none"></textarea>

            <button type="submit"
              class="bg-primary text-white font-semibold px-6 py-3 rounded-md hover:bg-primary-hover cursor-pointer transition">
              Submit Feedback
            </button>
          </form>
        @endif
      </div>
    </section>
  @endif

  {{-- Footer --}}
  <footer class="bg-tertiary px-4 md:px-24 py-8 animate-fade-slide-up">
    <p class="text-white text-center font-semibold text-2xl">"SwapHub - Swap, Use, Save, Sustain!"</p>
  </footer>

  {{-- STAR INTERACTION --}}
  <script>
    function toggleEditForm() {
      const editForm = document.getElementById('editForm');
      editForm.classList.toggle('hidden');
    }

    document.addEventListener('DOMContentLoaded', () => {
      const starsContainers = document.querySelectorAll('.stars');

      starsContainers.forEach(container => {
        const labels = container.querySelectorAll('label');
        const inputs = container.querySelectorAll('input');

        labels.forEach((label, index) => {
          label.addEventListener('mouseover', () => highlight(labels, labels.length - index));
          label.addEventListener('mouseout', () => reset(labels, inputs));
          label.addEventListener('click', () => {
            const val = labels.length - index;
            const input = container.querySelector(`input[value="${val}"]`);
            if (input) input.checked = true;
          });
        });

        const highlight = (stars, count) => {
          stars.forEach((star, i) => {
            star.classList.toggle('text-yellow-400', i >= stars.length - count);
            star.classList.toggle('text-gray-300', i < stars.length - count);
          });
        };

        const reset = (stars, inputs) => {
          const checked = Array.from(inputs).find(input => input.checked);
          if (checked) highlight(stars, parseInt(checked.value));
          else stars.forEach(star => {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
          });
        };
      });
    });
  </script>

  {{-- Script toggle auth  --}}
  <script>
    const loginBtn = document.getElementById("showLogin");
    const registerBtn = document.getElementById("showRegister");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    function showForm(show, hide) {
      hide.classList.add("animate-fade-out");
      setTimeout(() => {
        hide.classList.add("hidden");
        hide.classList.remove("animate-fade-out");

        show.classList.remove("hidden");
        show.classList.add("animate-fade-in");
        setTimeout(() => {
          show.classList.remove("animate-fade-in");
        }, 300);
      }, 300);
    }

    loginBtn.addEventListener("click", () => {
      showForm(loginForm, registerForm);
      loginBtn.classList.add("bg-primary", "text-white");
      registerBtn.classList.remove("bg-tertiary", "text-white");
      registerBtn.classList.add("text-tertiary");
    });

    registerBtn.addEventListener("click", () => {
      showForm(registerForm, loginForm);
      registerBtn.classList.add("bg-tertiary", "text-white");
      loginBtn.classList.remove("bg-primary", "text-white");
      loginBtn.classList.add("text-primary");
    });
  </script>

  <!-- Script untuk Carousel Otomatis -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const carousel = document.getElementById('carousel');
      const container = document.querySelector('.carousel-container');
      const items = carousel.querySelectorAll('div');
      const itemWidth = items[0].offsetWidth + 16; // Lebar item + margin (16px dari space-x-4)
      const totalWidth = itemWidth * items.length;
      const speed = 20; // Kecepatan scrolling (ms per frame)

      const carouselReview = document.getElementById('carousel-review');
      const containerReview = document.querySelector('.carousel-container-review');

      // Duplikat konten sudah ada di Blade, jadi kita hanya perlu animasi
      function startCarousel() {
        let position = 0;
        setInterval(() => {
          position -= 1;
          if (Math.abs(position) >= totalWidth / 2) {
            position = 0; // Kembali ke awal saat mencapai setengah duplikat
          }
          carousel.style.transform = `translateX(${position}px)`;
          carouselReview.style.transform = `translateX(${position}px)`;
        }, speed);
      }

      // Mulai carousel setelah konten dimuat
      startCarousel();

      // Pastikan container tidak memiliki overflow-x yang mengganggu
      container.style.overflowX = 'hidden';
      containerReview.style.overflowX = 'hidden';
    });
  </script>

  <!-- Script untuk Animasi Scroll -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sections = document.querySelectorAll('.animate-fade-slide-up');

      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target); // Hentikan observer setelah animasi
          }
        });
      }, {
        threshold: 0.2 // Animasi dipicu saat 20% section terlihat
      });

      sections.forEach(section => {
        observer.observe(section);
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
