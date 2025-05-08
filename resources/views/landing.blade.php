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
  <nav class="bg-white border-gray-200">
    <div class="container pe-4 md:px-4 lg:px-24 flex flex-wrap items-center justify-between mx-auto">
      <a href="/" class="flex items-center space-x-3">
        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" class="h-20" alt="SwapHub Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-primary text-shadow-lg">SWAPHUB</span>
      </a>
      <div class="@guest md:hidden @else flex @endguest items-center md:order-2 space-x-3 md:space-x-0">
        @auth
          <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-primary"
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full"
              src="{{ !empty(Auth::user()->profile_picture_users) ? asset(Auth::user()->profile_picture_users) : asset('photo-profile/default.png') }}?t={{ time() }}"
              alt="Profile Picture">
          </button>
          {{-- Dropdown menu  --}}
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm"
            id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900">{{ Auth::user()->full_name }}</span>
              <span class="block text-sm  text-gray-500 truncate">{{ Auth::user()->email }}</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
              <li>
                <a href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Dashboard</a>
              </li>
              <li>
                <a href="{{ route('home') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Home</a>
              </li>
              <li>
                <a href="{{ route('profile.index') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Profile</a>
              </li>
              <li>
                <a href="{{ route('wishlist.index') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Wishlist
                  <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">1</span></a>
                </a>
              </li>
              <li>
                <a href="{{ route('notifikasi.index') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Notifications
                  <span
                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">1</span></a>
                </a>
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit"
                    class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        @endauth
        <button data-collapse-toggle="navbar-user" type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary"
          aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
      </div>
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
    <section class="flex flex-col justify-center items-center px-4 md:px-24 py-10">
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
            <input type="password" name="password" placeholder="Password"
              class="w-full px-4 py-2 mb-4 border rounded-sm" required />
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
  <section class="bg-secondary px-4 md:px-24 py-10" id="collection">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
        OUR <span class="text-primary">COLLECTION</span>
      </h2>

      <div class="overflow-x-auto whitespace-nowrap space-x-4 flex pb-4">
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
  </section>

  {{-- About Section --}}
  <section class="px-4 md:px-24 py-10" id="about">
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
        <p class="text-gray-700 leading-relaxed">
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
  <section class="bg-secondary px-4 md:px-24 py-10" id="features">
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
        <ul class="text-gray-700 leading-relaxed space-y-2">
          <li class="list-style">
            Pertukaran Barang
          </li>
          <li class="list-style">
            Pencarian & Filter Barang
          </li>
          <li class="list-style">
            Rating and review sistem
          </li>
          <li class="list-style">
            Keamanan & Verifikasi Pengguna
          </li>
          <li class="list-style">
            Manajemen Transaksi & Riwayat
          </li>
          <li class="list-style">
            Feedback & Saran Pengguna
          </li>
        </ul>

      </div>

    </div>
  </section>

  {{-- Testimonial/Review Section --}}
  <section class="px-4 md:px-24 py-10" id="review">
    <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
      THEY <span class="text-primary">SAID...</span>
    </h2>
    <div class="container mx-auto flex flex-col md:flex-row gap-6 justify-center">
      <div class="flex-1 bg-secondary p-6 text-center rounded-xl shadow-md">
        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Alya"
          class="w-full h-[150px] rounded-lg object-cover mb-4">
        <p class="text-sm text-gray-600 leading-5 mb-3">
          "Fitur rating dan review bikin aku lebih percaya sama orang yang mau aku ajak barter. Jadi nggak takut kena
          tipu. Keren banget!"
        </p>
        <div class="font-semibold text-sm text-primary">Alya - Mahasiswa DKV</div>
      </div>
      <div class="flex-1 bg-secondary p-6 text-center rounded-xl shadow-md">
        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Nadia"
          class="w-full h-[150px] rounded-lg object-cover mb-4">
        <p class="text-sm text-gray-600 leading-5 mb-3">
          "SwapHub bikin proses barter lebih seru dan fleksibel. Bisa chat langsung sama pemilik barang, jadi lebih
          gampang negosiasi."
        </p>
        <div class="font-semibold text-sm text-primary">Nadia - Mahasiswa Manajemen</div>
      </div>
      <div class="flex-1 bg-secondary p-6 text-center rounded-xl shadow-md">
        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="Fajar"
          class="w-full h-[150px] rounded-lg object-cover mb-4">
        <p class="text-sm text-gray-600 leading-5 mb-3">
          "Platformnya mudah digunakan dan sistem verifikasinya bikin aku lebih nyaman. Udah beberapa kali barter dan
          selalu lancar!"
        </p>
        <div class="font-semibold text-sm text-primary">Fajar - Mahasiswa Hukum</div>
      </div>
    </div>
  </section>

  {{-- Feedback Section --}}
  <section class="bg-secondary px-4 md:px-24 py-10">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center text-tertiary text-shadow-lg mb-8">
        Give Us <span class="text-primary">Feedback</span> for <span class="text-primary">Improvement</span>
      </h2>

      {{-- Stars  --}}
      <div id="stars" class="flex justify-center gap-3 mb-6 text-[50px] text-gray-300 cursor-pointer">
        <span data-value="1">★</span>
        <span data-value="2">★</span>
        <span data-value="3">★</span>
        <span data-value="4">★</span>
        <span data-value="5">★</span>
      </div>

      {{-- Feedback Form  --}}
      <form id="feedback-form" class="flex flex-col gap-5 w-full md:w-1/2 mx-auto">
        <input type="email" name="email" placeholder="Your Email Address" required
          class="w-full px-4 py-2 border rounded-sm">

        <textarea name="message" placeholder="Message" required
          class="w-full px-4 py-2 border rounded-sm h-[150px] resize-none"></textarea>

        {{-- Hidden input to store selected rating  --}}
        <input type="hidden" name="rating" id="rating-value">

        {{-- Submit Button  --}}
        <button type="submit"
          class="bg-primary text-white font-semibold px-6 py-3 rounded-md hover:bg-primary-hover cursor-pointer transition">
          Submit Feedback
        </button>
      </form>
    </div>
  </section>

  {{-- Footer --}}
  <footer class="bg-tertiary px-4 md:px-24 py-8">
    <p class="text-white text-center font-semibold text-2xl">"SwapHub - Swap, Use, Save, Sustain!"</p>
  </footer>

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

  {{-- Script Star & Submit Feedback --}}
  <script>
    const stars = document.querySelectorAll('#stars span');
    const ratingInput = document.getElementById('rating-value');
    let currentRating = 0;

    stars.forEach(star => {
      star.addEventListener('click', () => {
        currentRating = parseInt(star.getAttribute('data-value'));
        ratingInput.value = currentRating; // Simpan ke input hidden
        updateStars();
      });
      star.addEventListener('mouseover', () => {
        const hoverValue = parseInt(star.getAttribute('data-value'));
        updateStars(hoverValue);
      });
      star.addEventListener('mouseleave', () => {
        updateStars();
      });
    });

    function updateStars(hoverValue = 0) {
      stars.forEach(star => {
        const starValue = parseInt(star.getAttribute('data-value'));
        if ((hoverValue || currentRating) >= starValue) {
          star.classList.add('text-yellow-400');
          star.classList.remove('text-gray-300');
        } else {
          star.classList.remove('text-yellow-400');
          star.classList.add('text-gray-300');
        }
      });
    }

    // Handle form submission
    document.getElementById('feedback-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.email.value;
      const message = this.message.value;
      const rating = this.rating.value;

      // TODO: kalau sudah fix untuk rating sistem
      // fetch('/feedback', {
      //   method: 'POST',
      //   headers: {
      //     'Content-Type': 'application/json',
      //     'X-CSRF-TOKEN': '{{ csrf_token() }}'
      //   },
      //   body: JSON.stringify({
      //     email: data.email,
      //     message: data.message,
      //     rating: data.rating
      //   })
      // });

      alert(`Thank you!\nEmail: ${email}\nRating: ${rating} stars\nMessage: ${message}`);
      this.reset();
      currentRating = 0;
      updateStars();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
