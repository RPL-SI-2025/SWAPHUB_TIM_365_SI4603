{{-- Navbar --}}
<nav class="bg-white border-b-8 border-primary">
  <div class="container pe-4 md:px-4 lg:px-24 flex flex-wrap items-center justify-between mx-auto">
    <a href="/" class="flex items-center space-x-3">
      <img src="{{ asset('images/SWAPHUBLOGO.png') }}" class="h-20" alt="SwapHub Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-primary text-shadow-lg">SWAPHUB</span>
    </a>
    @include('layouts.menu-user')
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
      <ul
        class="flex flex-col text-shadow-lg font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="{{ route('home') }}"
            class="block py-2 px-3 rounded-sm md:p-0
      {{ request()->routeIs('home')
          ? 'text-white bg-primary md:bg-transparent md:text-primary'
          : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary' }}"
            aria-current="{{ request()->routeIs('home') ? 'page' : '' }}">
            Home
          </a>
        </li>
        @if (!Auth::user()->is_admin)
          <li>
            <a href="{{ route('barang.index') }}"
              class="block py-2 px-3 rounded-sm md:p-0
      {{ request()->routeIs('barang*')
          ? 'text-white bg-primary md:bg-transparent md:text-primary'
          : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary' }}">
              My Items
            </a>
          </li>

          <li>
            <a href="{{ route('penukaran.index') }}"
              class="block py-2 px-3 rounded-sm md:p-0
      {{ request()->routeIs('penukaran*')
          ? 'text-white bg-primary md:bg-transparent md:text-primary'
          : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary' }}">
              Trade
            </a>
          </li>

          <li>
            <a href="{{ route('rating.index') }}"
              class="block py-2 px-3 rounded-sm md:p-0
      {{ request()->routeIs('rating*')
          ? 'text-white bg-primary md:bg-transparent md:text-primary'
          : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary' }}">
              Rate Our Service!
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
