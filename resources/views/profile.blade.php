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
            <span class="font-medium text-gray-700">{{ $user->name }}</span>
            <img src="https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg" class="w-8 h-8 rounded-full" alt="profile">
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex max-w-7xl mx-auto mt-8 px-4 gap-6">
        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 bg-white rounded-lg shadow p-4">
            <div class="flex items-center gap-2 mb-6">
                <img src="https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg" class="w-10 h-10" alt="profile">
                <span class="font-semibold">{{ $user->name }}</span>
            </div>
            <nav class="space-y-2 text-sm text-gray-700">
                <a href="#" class="block hover:text-blue-600">My Profile</a>
                <a href="#" class="block hover:text-blue-600">Wishlist</a>
                <a href="#" class="block hover:text-blue-600">Setting</a>
                <a href={{route('home')}} class="block hover:text-blue-600">Product</a>
                <a href="#" class="block hover:text-blue-600">Notification</a>
            </nav>
        </aside>

        <!-- Profile Section -->
        <section class="w-full md:w-3/4 bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Personal Data</h2>
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
                    <div class="flex-1 space-y-4">
                        <div class="flex justify-between items-center">
                            <span><strong>Name:</strong> {{ $user->full_name }}</span>
                            <a href="#" class="text-blue-600 text-sm hover:underline">Update</a>
                        </div>
                        <div class="flex justify-between items-center">
                            <span><strong>No. Telp:</strong> {{ $user->phone_users ?? '-' }}</span>
                            <a href="#" class="text-blue-600 text-sm hover:underline">Update</a>
                        </div>
                        <div class="flex justify-between items-center">
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                            <a href="#" class="text-blue-600 text-sm hover:underline">Update</a>
                        </div>
                        <div class="flex justify-between items-center">
                            <span><strong>Password:</strong> ********</span>
                            <a href="#" class="text-blue-600 text-sm hover:underline">Update</a>
                        </div>
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
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
