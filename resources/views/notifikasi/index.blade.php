@extends('layouts.app')

@section('content')
  <div class="max-w-8xl mx-auto mt-10 mb-12 px-6 md:px-16 flex flex-col md:flex-row gap-8">
    @include('layouts.sidebar')

    <div class="w-full bg-white rounded-lg shadow-lg p-8 flex-1">
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
          <a href="{{ route('home') }}" class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </a>
          <h1 class="text-3xl font-bold text-shadow-lg">Notifikasi</h1>
        </div>

        <form action="{{ route('notifikasi.markAllAsRead') }}" method="POST">
          @csrf
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
            Tandai semua telah dibaca
          </button>
        </form>
      </div>

      <div class="space-y-4">
        @forelse ($notifications as $notification)
          <div
            class="flex items-center justify-between p-4 rounded-lg shadow
        {{ $notification->is_read ? 'bg-gray-100' : 'bg-blue-100' }}">

            <div>
              <a href="{{ $notification->url }}">
                <p class="text-sm {{ $notification->is_read ? 'text-gray-700' : 'text-blue-900 font-semibold' }}">
                  {{ $notification->message }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                  {{ $notification->created_at->diffForHumans() }}
                </p>
              </a>
            </div>

            <div class="flex space-x-2">
              @if (!$notification->is_read)
                <form action="{{ route('notifikasi.markAsRead', $notification->id_notifikasi) }}" method="POST">
                  @csrf
                  <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                    Tandai telah dibaca
                  </button>
                </form>
              @endif

              <form action="{{ route('notifikasi.destroy', $notification->id_notifikasi) }}" method="POST"
                class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">
                  Hapus
                </button>
              </form>
            </div>

          </div>
        @empty
          <p class="text-gray-500 text-center">Tidak ada notifikasi.</p>
        @endforelse
      </div>
    </div>
  </div>

  {{-- SweetAlert untuk konfirmasi hapus --}}
  <script>
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Hapus notifikasi?',
          text: 'Tindakan ini tidak bisa dibatalkan!',
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
@endsection
