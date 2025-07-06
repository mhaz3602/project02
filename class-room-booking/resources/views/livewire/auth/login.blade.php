<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Campus Room Booking</title>
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
        
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logosttnf.jpg') }}" alt="Logo Kampus" class="h-28 w-auto mb-4 drop-shadow-lg logo-breath">
        </div>

        <!-- Judul -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Access Your Campus Room Booking</h2>
            <p class="text-sm text-gray-600 mt-2">Sign in to reserve meeting rooms and study spaces effortlessly.</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5 mt-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="your@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Your password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                >
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="absolute end-0 top-0 text-sm text-blue-500 hover:underline">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <!-- Error Message -->
                @if ($errors->has('email'))
                    <p class="text-red-500 text-sm mt-2">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input
                    id="remember_me"
                    name="remember"
                    type="checkbox"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                >
                <label for="remember_me" class="ml-2 block text-gray-700 text-sm">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-200 transform hover:scale-105"
                >
                    → Let’s Go!
                </button>
            </div>
        </form>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center text-sm text-gray-500 mt-4">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">
                    Sign up
                </a>
            </div>
        @endif
    </div>

</body>
</html>
