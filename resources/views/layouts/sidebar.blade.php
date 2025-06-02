<!-- Toggle Button (Visible only on Mobile) -->
<button onclick="toggleSidebar()" class="md:hidden p-2 bg-primary text-white rounded-lg">
  ☰ Menu
</button>

<aside id="sidebar" class="hidden md:block w-full h-fit md:w-1/4 bg-white rounded-3xl shadow-lg p-2">
  <div class="bg-tertiary  rounded-3xl p-6">
    <nav class="space-y-4 text-sm">
      <a href="{{ route('profile.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('profile.index') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span>My Profile</span>
      </a>
      @if (!Auth::user()->is_admin)
        <a href="{{ route('barang.index') }}"
          class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('barang*') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v2h-2zm0 4h2v6h-2z" />
          </svg>
          <span>Product</span>
        </a>
        <a href="{{ route('history.index') }}"
          class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('history.index') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L8 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8z" />
          </svg>
          <span>History</span>
        </a>
        <a href="{{ route('wishlist.index') }}"
          class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('wishlist.index') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
          <span>Wishlist</span>
          @if (auth()->user()->wishlist_count > 0)
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full ms-auto">
              {{ auth()->user()->wishlist_count }}
            </span>
          @endif
        </a>
      @endif
      <a href="{{ route('notifikasi.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('notifikasi.index') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span>Notification</span>
        @if (auth()->user()->unread_notifications_count > 0)
          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full ms-auto">
            {{ auth()->user()->unread_notifications_count }}
          </span>
        @endif
      </a>
      @if (!Auth::user()->is_admin)
        <a href="{{ route('laporan_penipuan.index') }}"
          class="flex items-center gap-3 p-3 rounded-lg transition duration-300
                    hover:bg-primary hover:text-white hover:shadow-md
                    {{ request()->routeIs('laporan_penipuan*') ? 'bg-primary text-white' : 'bg-white text-tertiary' }}">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-2-10a5 5 0 00-5 5h-2a7 7 0 0114 0h-2a5 5 0 00-5-5zm-1 11a1 1 0 112 0 1 1 0 01-2 0z" />
          </svg>
          <span>Fraud Report</span>
        </a>
      @endif
    </nav>
  </div>
</aside>
