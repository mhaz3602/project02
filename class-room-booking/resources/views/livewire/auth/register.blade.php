<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Campus Room Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: url('/images/bgruangan.webp') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.8s ease-out forwards;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .logo-breath {
            animation: breath 3s ease-in-out infinite;
        }
        @keyframes breath {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-black/50">

    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8 flex flex-col gap-6 fade-in">
        
        <!-- Logo dengan animasi -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logosttnf.jpg') }}" alt="Logo Kampus" class="h-28 w-auto mb-4 drop-shadow-lg logo-breath">
        </div>

        <!-- Judul -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Create Your Account</h2>
            <p class="text-sm text-gray-600 mt-2">Enter your details to start booking rooms.</p>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5 mt-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">Full Name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Your full name"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="your@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Your password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
            </div>

            <!-- Register Button -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-200 transform hover:scale-105"
                >
                    → Create Account
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="text-center text-sm text-gray-500 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                Login
            </a>
        </div>
    </div>

</body>
</html>
