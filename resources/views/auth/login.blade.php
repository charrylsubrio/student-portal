<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password"
                              class="block mt-1 w-full pr-16"
                              type="password"
                              name="password"
                              required
                              autocomplete="current-password" />

                <!-- SHOW / HIDE BUTTON -->
                <button type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-2 top-2 text-xs text-gray-500 hover:text-gray-700">
                    Show
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="remember">

                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <!-- Login Button + Forgot Password -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Extra Navigation Links -->
        <div class="mt-6 text-center space-x-4">
            <a href="{{ url('/') }}"
               class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600">
                ← Back to Home Page
            </a>

            <a href="{{ route('register') }}"
               class="text-sm text-indigo-600 hover:underline">
                Register Page
            </a>
        </div>
    </form>
</x-guest-layout>


{{-- SHOW / HIDE PASSWORD SCRIPT --}}
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);

    if (input.type === "password") {
        input.type = "text";
        btn.innerText = "Hide";
    } else {
        input.type = "password";
        btn.innerText = "Show";
    }
}
</script>