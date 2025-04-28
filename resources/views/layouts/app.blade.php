<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ isset($title) ? $title : config('app.name', 'SwapHub') }}</title>

  <!-- Scripts -->
  @vite('resources/css/app.css')

  {{-- SweetAlert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

  {{-- Navbar --}}
  @include('layouts.navbar')

  {{-- Main Content --}}
  <main class="container mx-auto p-6">
    @include('layouts.flash-messages')
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
