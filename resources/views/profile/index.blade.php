<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SwapHub Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
    @endphp

    <!-- Header -->
    <div class="flex items-center justify-between bg-white px-6 py-4 shadow">
        <div class="flex items-center gap-2">
            <img src="https://www.svgrepo.com/show/499963/arrows-retweet.svg" alt="logo" class="w-6 h-6">
            <h1 class="text-xl font-bold text-gray-800">SWAPHUB</h1>
        </div>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                <span class="font-medium text-gray-700">{{ $user->full_name }}</span>
                <img src="{{ asset(Auth::user()->profile_picture_users) }}" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex max-w-8xl mx-auto mt-8 px-4 gap-5">
        <!-- Sidebar -->
        <aside class="w-150 bg-white rounded-lg shadow p-4">
            <div class="flex items-center gap-x-4 mb-4" class="overflow-hidden">
                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                    <img src="{{ asset(Auth::user()->profile_picture_users) }}" alt="Profile Picture" class="object-cover w-full h-full">
                </div>
                <div class="text-gray-800 font-medium text-base">
                    {{ $user->full_name }}
                </div>
            </div>
             
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="{{route('profile.index')}}" class="block hover:text-blue-600">My Profile</a>
                <a href="#" class="block hover:text-blue-600">Wishlist</a>
                <a href={{route('home')}} class="block hover:text-blue-600">Product</a>
                <a href="#" class="block hover:text-blue-600">Notification</a>
            </nav>
        </aside>

        <!-- Profile Section -->
        <section class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Profile Photo -->
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center mb-2">
                            <img src="{{ asset(Auth::user()->profile_picture_users) }}" alt="Profile Picture" class="object-cover w-full h-full">
                        </div>
                        <!-- Hidden File Input -->
                        <input type="file" id="profile_picture_users" name="profile_picture_users" class="hidden" accept="image/*">

                        <!-- Label as Button -->
                        <label for="profile_picture_users" class="text-sm border px-3 py-1 rounded cursor-pointer hover:bg-gray-100">
                            Change Photo
                        </label>
                    </div>

                    <!-- Data Fields -->
                    <div class="space-y-4 text-sm text-gray-800">
                        <!-- Biodata Section -->
                        <div>
                            <h2 class="font-semibold text-gray-700 mb-2">Change Personal Biodata</h2>
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <div>Name</div>
                                <div>{{ $user->full_name }}</div>
                                <a 
                                    data-modal-target="editNameModal" 
                                    data-modal-toggle="editNameModal" 
                                    class="text-green-600 hover:underline text-sm">
                                        Ubah
                                </a>
                                
                            </div>
                        </div>
                    
                        <!-- Kontak Section -->
                        <div>
                            <h2 class="font-semibold text-gray-700 mt-6 mb-2">Change Contact</h2>

                            <!-- Email -->
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <div>Email</div>
                                <div class="flex items-center gap-2">
                                    <span>{{ $user->email }}</span>
                                    @if ($user->email)
                                        <span class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-1 rounded">Terverifikasi</span>
                                    @else
                                        <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-1 rounded">
                                            Belum Terverifikasi
                                        </span>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <a 
                                        data-modal-target="editEmailModal" 
                                        data-modal-toggle="editEmailModal" 
                                        class="text-green-600 hover:underline text-sm">
                                        Ubah
                                    </a>
                                </div>
                            
                                <div>Nomor HP</div>
                                <div class="flex items-center gap-2">
                                    <span>{{ $user->phone_users }}</span>
                                    @if ($user->phone_users)
                                        <span class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-1 rounded">Terverifikasi</span>
                                    @else
                                        <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-1 rounded">
                                            Belum Terverifikasi
                                        </span>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <a 
                                        data-modal-target="editPhoneModal" 
                                        data-modal-toggle="editPhoneModal" 
                                        class="text-green-600 hover:underline text-sm">
                                        Ubah
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    
                </div>
            </form>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Log Out
                </button>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <footer class="mt-12 text-center text-sm text-gray-600 py-4">
        <hr class="mb-2 border-gray-300">
        <p><strong>SwapHub</strong> — Swap, Use, Save, Sustain!</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
@include('profile.editprofile')