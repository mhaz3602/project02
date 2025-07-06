<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Campus Room Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Jika pakai Vite --}}
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
        
        <!-- Logo Besar dengan Animasi Bernafas -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logosttnf.jpg') }}" alt="Logo Kampus" class="h-28 w-auto mb-4 drop-shadow-lg logo-breath">
        </div>

        <!-- Judul & Subjudul -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Access Your Campus Room Booking</h2>
            <p class="text-sm text-gray-600 mt-2">Sign in to reserve meeting rooms and study spaces effortlessly.</p>
        </div>

        <!-- Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <!-- Form Login -->
        <form wire:submit="login" class="flex flex-col gap-5 mt-4">
            <!-- Email -->
            <flux:input
                wire:model="email"
                label="Email address"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="your@email.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    wire:model="password"
                    label="Password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Your password"
                    viewable
                />
                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm text-blue-500 hover:underline" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox wire:model="remember" label="Remember me" />

            <!-- Tombol Login -->
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
                <flux:link :href="route('register')" wire:navigate class="text-blue-600 font-semibold hover:underline">
                    Sign up
                </flux:link>
            </div>
        @endif
    </div>

</body>
</html>
