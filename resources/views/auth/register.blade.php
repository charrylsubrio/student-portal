<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-16"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />

                <!-- SHOW/HIDE BUTTON -->
                <button type="button"
                    onclick="togglePassword('password', this)"
                    class="absolute right-2 top-2 text-xs text-gray-500">
                    Show
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Strength Meter -->
            <div id="strength" style="margin-top:5px; font-weight:bold;"></div>

            <div class="strength-segments mt-1">
                <div id="segment-1" class="strength-segment"></div>
                <div id="segment-2" class="strength-segment"></div>
                <div id="segment-3" class="strength-segment"></div>
                <div id="segment-4" class="strength-segment"></div>
            </div>

            <div id="strength-details" class="mt-1"></div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-16"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <button type="button"
                    onclick="togglePassword('password_confirmation', this)"
                    class="absolute right-2 top-2 text-xs text-gray-500">
                    Show
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400
                hover:text-gray-900 dark:hover:text-gray-100
                rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2
                focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

{{-- ================= STYLES ================= --}}
<style>
.strength-segments {
    display: flex;
    gap: 4px;
    margin-top: 8px;
    height: 4px;
}
.strength-segment {
    height: 100%;
    flex: 1;
    border-radius: 2px;
    background-color: #e5e7eb;
    transition: all 0.3s ease;
}
.strength-segment.active { transform: scaleY(1.2); }
.strength-segment.weak { background-color: #ef4444; }
.strength-segment.medium { background-color: #f59e0b; }
.strength-segment.strong { background-color: #10b981; }

#strength-details {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 4px;
    min-height: 16px;
}

.dark .strength-segment { background-color: #4b5563; }
.dark #strength-details { color: #9ca3af; }
</style>

{{-- ================= SCRIPTS ================= --}}
<script>
// SHOW / HIDE PASSWORD
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

// PASSWORD STRENGTH
document.getElementById("password").addEventListener("input", function () {
    let value = this.value;
    let strengthDiv = document.getElementById("strength");
    let strengthDetails = document.getElementById("strength-details");

    for (let i = 1; i <= 4; i++) {
        let segment = document.getElementById(`segment-${i}`);
        segment.className = "strength-segment";
    }

    if (value.length === 0) {
        strengthDiv.innerText = "";
        strengthDetails.innerText = "";
        return;
    }

    let hasLength = value.length >= 8;
    let hasUpper = /[A-Z]/.test(value);
    let hasLower = /[a-z]/.test(value);
    let hasNumber = /[0-9]/.test(value);
    let hasSpecial = /[^A-Za-z0-9]/.test(value);

    let active = 0;

    if (value.length >= 1) {
        document.getElementById("segment-1").classList.add("active","weak");
        active = 1;
    }
    if (value.length >= 6) {
        document.getElementById("segment-2").classList.add("active","weak");
        active = 2;
    }
    if (hasLength && (hasUpper || hasNumber || hasSpecial)) {
        for (let i = 1; i <= 3; i++)
            document.getElementById(`segment-${i}`).className="strength-segment active medium";
        active = 3;
    }
    if (hasLength && hasUpper && hasLower && hasNumber && hasSpecial) {
        for (let i = 1; i <= 4; i++)
            document.getElementById(`segment-${i}`).className="strength-segment active strong";
        active = 4;
    }

    if (active === 4) {
        strengthDiv.innerText = "Strength: Strong";
        strengthDiv.style.color = "#10b981";
        strengthDetails.innerText = "✓ Excellent! Very strong password.";
    } else if (active === 3) {
        strengthDiv.innerText = "Strength: Medium";
        strengthDiv.style.color = "#f59e0b";
    } else {
        strengthDiv.innerText = "Strength: Weak";
        strengthDiv.style.color = "#ef4444";
    }
});
</script>