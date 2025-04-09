<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwapHub</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col md:flex-row items-center justify-center px-4 py-8">
        <!-- Left Section -->
        <div class="md:w-1/2 w-full text-center md:text-left p-6">
            <h1 class="text-3xl font-bold mb-4">Welcome back to <span class="text-blue-600">SwapHub</span>!</h1>
            <p class="text-gray-600 mb-6">
                Login and start swapping items with your community! Reuse, reduce, and recycle in style.
            </p>

            <div class="mt-8">
                <img src="https://www.svgrepo.com/show/410463/login.svg" alt="Login Illustration" class="w-2/3 mx-auto md:mx-0">
            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="md:w-1/2 w-full bg-white p-8 rounded-lg shadow-lg max-w-md">
            <h2 class="text-2xl font-semibold mb-6 text-center">Log In to SwapHub</h2>

            @if (session('loginError'))
                <div class="mb-4 text-red-600 text-sm text-center">
                    {{ session('loginError') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email address"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" required />

                <input type="password" name="password" placeholder="Password"
                    class="w-full mb-4 border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500" required />

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Log In
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Don't have an account?
                    <a href="{{ url('/registration') }}" class="text-blue-600 hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
