<div class="@guest md:hidden @else flex @endguest items-center md:order-2 space-x-3 md:space-x-4">
  @auth
    <span
      class="hidden md:inline me-3 text-shadow-lg font-medium @if (request()->is('admin*')) text-tertiary @else truncate max-w-[100px] @endif"
      title="{{ Auth::user()->full_name }}">{{ Auth::user()->full_name }}</span>
    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-primary"
      id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
      <span class="sr-only">Open user menu</span>
      <img class="w-8 h-8 rounded-full"
        src="{{ !empty(Auth::user()->profile_picture) ? Storage::url(Auth::user()->profile_picture) : asset('photo-profile/default.png') }}"
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
        @if (Auth::user()->is_admin)
          <li>
            <a href="{{ route('dashboard.index') }}"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Dashboard</a>
          </li>
        @endif
        <li>
          <a href="{{ route('home') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Home</a>
        </li>
        <li>
          <a href="{{ route('profile.index') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">Profile</a>
        </li>
        @if (!Auth::user()->is_admin)
          <li>
            <a href="{{ route('wishlist.index') }}"
              class="flex justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">
              Wishlist
              @if (auth()->user()->wishlist_count > 0)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                  {{ auth()->user()->wishlist_count }}
                </span>
              @endif
            </a>
          </li>
        @endif
        <li>
          <a href="{{ route('notifikasi.index') }}"
            class="flex justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-hover">
            Notifications
            @if (auth()->user()->unread_notifications_count > 0)
              <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {{ auth()->user()->unread_notifications_count }}
              </span>
            @endif
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST" class= "logout-form">
            @csrf
            <button type="submit"
              class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  @endauth
  <button data-collapse-toggle="navbar-user" type="button"
    class="@if (request()->is('admin*')) hidden @else inline-flex @endif items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary"
    aria-controls="navbar-user" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M1 1h15M1 7h15M1 13h15" />
    </svg>
  </button>
</div>
