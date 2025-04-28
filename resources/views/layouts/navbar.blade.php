<nav class="bg-white border-gray-200 shadow">
  <div class="container flex flex-wrap items-center justify-between mx-auto p-6">
    <a href="/" class="flex text-blue-600 items-center space-x-3">
      {{-- <img src="" class="h-8" alt="SwapHub Logo" /> --}}
      <span class="self-center text-2xl font-semibold whitespace-nowrap">SwapHub</span>
    </a>
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0">
      @auth
        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
          id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          @if (Auth::user()->profile_photo_path)
            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
          @else
            <img class="w-8 h-8 rounded-full" src="{{ asset('photo-profile/default.png') }}"
              alt="{{ Auth::user()->name }}">
          @endif
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm"
          id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900">{{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}</span>
            <span class="block text-sm  text-gray-500 truncate">{{ Auth::user()->email }}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
            </li>
            <li>
              <a href="{{ route('wishlist.index') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Wishlist
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">1</span></a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
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
      @else
        <div class="flex items-center space-x-3">
          <a href="{{ route('login') }}"
            class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white font-medium">Login</a>
          <a href="{{ route('registration') }}"
            class="text-sm px-4 py-2 text-blue-600 border border-blue-600 hover:bg-blue-600 rounded hover:text-white font-medium">Register</a>
        </div>
      @endauth
      <button data-collapse-toggle="navbar-user" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
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
        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="#"
            class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0"
            aria-current="page">Home</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">About</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Pricing</a>
        </li>
        <li>
          <a href="#"
            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
