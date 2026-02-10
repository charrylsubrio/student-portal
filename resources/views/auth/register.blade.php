<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            
            <!-- Strength Meter Text -->
            <div id="strength" style="margin-top:5px; font-weight:bold;"></div>

            <!-- Enhanced Animation Segments -->
            <div class="strength-segments mt-1">
                <div id="segment-1" class="strength-segment"></div>
                <div id="segment-2" class="strength-segment"></div>
                <div id="segment-3" class="strength-segment"></div>
                <div id="segment-4" class="strength-segment"></div>
            </div>

            <div id="strength-details" class="mt-1"></div>
        </div>

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

            .strength-segment.active {
                transform: scaleY(1.2);
            }

            .strength-segment.weak {
                background-color: #ef4444;
            }

            .strength-segment.medium {
                background-color: #f59e0b;
            }

            .strength-segment.strong {
                background-color: #10b981;
            }

            #strength-details {
                font-size: 0.75rem;
                color: #6b7280;
                margin-top: 4px;
                min-height: 16px;
            }

            /* Dark mode support */
            .dark .strength-segment {
                background-color: #4b5563;
            }

            .dark #strength-details {
                color: #9ca3af;
            }
        </style>

        <script>
        document.getElementById("password").addEventListener("input", function () {
            let strengthText = "Weak";
            let strengthColor = "red";
            let value = this.value;
            let strengthDiv = document.getElementById("strength");
            let strengthDetails = document.getElementById("strength-details");
            
            // Reset all segments
            for (let i = 1; i <= 4; i++) {
                let segment = document.getElementById(`segment-${i}`);
                segment.className = "strength-segment";
                segment.style.backgroundColor = "";
            }
            
            // Clear if empty
            if (value.length === 0) {
                strengthText = "";
                strengthDiv.style.display = "none";
                strengthDetails.innerText = "";
                return;
            } else {
                strengthDiv.style.display = "block";
            }
            
            // Check requirements
            let hasLength = value.length >= 8;
            let hasUpper = /[A-Z]/.test(value);
            let hasLower = /[a-z]/.test(value);
            let hasNumber = /[0-9]/.test(value);
            let hasSpecial = /[^A-Za-z0-9]/.test(value);
            
            let activeSegments = 0;
            let detailsMessage = "";
            
            // Segment 1: Length
            if (value.length >= 1) {
                document.getElementById("segment-1").classList.add("active", "weak");
                activeSegments = 1;
            }
            
            // Segment 2: Length >= 6
            if (value.length >= 6) {
                document.getElementById("segment-2").classList.add("active", "weak");
                activeSegments = 2;
            }
            
            // Segment 3: Good length and some complexity
            if (hasLength && (hasUpper || hasNumber || hasSpecial)) {
                for (let i = 1; i <= 3; i++) {
                    let segment = document.getElementById(`segment-${i}`);
                    segment.className = "strength-segment active medium";
                }
                activeSegments = 3;
                detailsMessage = "Good! Add more character types for stronger password";
            }
            
            // Segment 4: Excellent - all requirements met
            if (hasLength && hasUpper && hasNumber && hasSpecial && hasLower) {
                for (let i = 1; i <= 4; i++) {
                    let segment = document.getElementById(`segment-${i}`);
                    segment.className = "strength-segment active strong";
                }
                activeSegments = 4;
                detailsMessage = "✓ Excellent! Your password is very strong";
            }
            
            // Set strength level and details
            if (activeSegments === 4) {
                strengthText = "Strong";
                strengthColor = "#10b981";
            } else if (activeSegments === 3) {
                strengthText = "Medium";
                strengthColor = "#f59e0b";
                if (!detailsMessage) detailsMessage = "Add uppercase, numbers, or special characters";
            } else if (activeSegments >= 1) {
                strengthText = "Weak";
                strengthColor = "#ef4444";
                if (!detailsMessage) detailsMessage = "Use 8+ characters with uppercase, numbers, and special characters";
            }
            
            // Update displays
            strengthDiv.style.color = strengthColor;
            strengthDiv.innerText = "Strength: " + strengthText;
            strengthDetails.innerText = detailsMessage;
            
            // Add specific requirement hints
            let requirements = [];
            if (!hasLength) requirements.push("at least 8 characters");
            if (!hasUpper) requirements.push("one uppercase letter");
            if (!hasLower) requirements.push("one lowercase letter");
            if (!hasNumber) requirements.push("one number");
            if (!hasSpecial) requirements.push("one special character");
            
            if (requirements.length > 0 && activeSegments < 4) {
                strengthDetails.innerText = "Requirements: " + requirements.slice(0, 3).join(", ");
            }
        });
        </script>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>