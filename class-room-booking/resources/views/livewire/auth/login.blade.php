<div class="min-h-screen flex items-center justify-center bg-white">
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8 flex flex-col gap-6">
        <!-- Judul & Deskripsi -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Access Your Campus Room Booking</h2>
            <p class="text-sm text-gray-600 mt-2">Sign in to reserve meeting rooms and study spaces effortlessly.</p>
        </div>

        <!-- Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <!-- Form Login -->
        <form wire:submit="login" class="flex flex-col gap-6 mt-2">
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
                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
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
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-150 transform hover:scale-105"
                >
                    → Let’s go!
                </button>
            </div>
        </form>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 mt-4">
                Don't have an account?
                <flux:link :href="route('register')" wire:navigate class="text-blue-600 font-semibold">
                    Sign up
                </flux:link>
            </div>
        @endif
    </div>
</div>
