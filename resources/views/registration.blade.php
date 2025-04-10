<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwapHub - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col md:flex-row items-center justify-center px-4 py-8">
        <!-- Left Section -->
        <div class="md:w-1/2 w-full text-center md:text-left p-6">
            <h1 class="text-3xl font-bold mb-4">The best way to <span class="text-blue-600">Swap & Reuse</span> items with your friends!</h1>
            <p class="text-gray-600 mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Make your unused items more useful.
            </p>
            <img src="https://www.svgrepo.com/show/410459/register.svg" alt="Register Illustration" class="w-2/3 mx-auto md:mx-0">
        </div>

        <!-- Right Section - Register Form -->
        <div class="md:w-1/2 w-full bg-white p-8 rounded-lg shadow-lg max-w-md">
            <h2 class="text-2xl font-semibold mb-6 text-center">Sign Up & Enjoy your SwapHub</h2>

            @if (session('success'))
                <div class="mb-4 text-green-600 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <input type="text" name="firstName" placeholder="Your first name"
                        class="border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('firstName') }}" required>
                    <input type="text" name="lastName" placeholder="Your last name"
                        class="border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('lastName') }}" required>
                </div>

                <input type="email" name="email" placeholder="Your email address"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}" required>

                <input type="text" name="phone_users" placeholder="Your phone number"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('phone_users') }}" required>

                <input type="password" name="password" placeholder="Pick a password"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" required>

                <input type="password" name="password_confirmation" placeholder="Confirm password"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" required>

                <!-- Role Dropdown -->
                <select name="role" class="w-full mb-4 border border-gray-300 rounded px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Role</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <label class="block text-gray-700 mb-2">Upload Profile Picture (optional)</label>
                <input type="file" name="profile_picture"
                    class="mb-4 w-full border border-gray-300 rounded px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Sign Up
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log In</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
