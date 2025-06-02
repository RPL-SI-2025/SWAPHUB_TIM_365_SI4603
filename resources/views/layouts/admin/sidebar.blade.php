@php
  $jumlahPending = App\Models\LaporanPenipuan::countPending();
  $jumlahBelumDitanggapi = App\Models\RatingWebsite::countBelumDitanggapi();
@endphp

<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="{{ route('dashboard.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('dashboard*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('dashboard*') ? 'text-primary' : 'text-gray-500' }}"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
            <path
              d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
          </svg>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('kategori.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('kategori*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('kategori*') ? 'text-primary' : 'text-gray-500' }}"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path
              d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
        </a>
      </li>
      <li>
        <a href="{{ route('laporan.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('laporan*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('laporan*') ? 'text-primary' : 'text-gray-500' }}"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Fraud Reports</span>
          @if ($jumlahPending > 0)
            <span
              class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">{{ $jumlahPending }}</span>
          @endif
        </a>
      </li>
      <li>
        <a href="{{ route('users.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('users*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('users*') ? 'text-primary' : 'text-gray-500' }}"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path
              d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.rekomendasi.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('admin.rekomendasi*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('admin.rekomendasi*') ? 'text-primary' : 'text-gray-500' }}"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path
              d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Item Recommendations</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.rating.index') }}"
          class="flex items-center p-2 rounded-lg group
    {{ request()->routeIs('admin.rating*') ? 'bg-gray-100 text-primary' : 'text-gray-900 hover:bg-gray-100' }}">
          <svg
            class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900
    {{ request()->routeIs('admin.rating*') ? 'text-primary' : 'text-gray-500' }}"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd"
              d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
              clip-rule="evenodd" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Website Rating</span>
          @if ($jumlahBelumDitanggapi > 0)
            <span
              class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">{{ $jumlahBelumDitanggapi }}</span>
          @endif
        </a>
      </li>
    </ul>
  </div>
</aside>
