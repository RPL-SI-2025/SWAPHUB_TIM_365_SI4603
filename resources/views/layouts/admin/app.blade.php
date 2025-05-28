<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ isset($title) ? $title : config('app.name', 'SwapHub Admin') }}</title>

  {{-- Flowbite --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> --}}

  <!-- Scripts -->
  @vite('resources/css/app.css')

  {{-- SweetAlert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-secondary font-inter">

  {{-- Navbar --}}
  @include('layouts.admin.navbar')

  {{-- Sideabar --}}
  @include('layouts.admin.sidebar')

  <div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
      @include('layouts.flash-messages')
      <main>
        @yield('content')
      </main>
    </div>
  </div>

  {{-- JS SweetAlert --}}
  <script>
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: 'Yakin mau hapus?',
          text: 'Data ini tidak bisa dikembalikan!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
