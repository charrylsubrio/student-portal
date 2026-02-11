<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="block mt-1 w-full border rounded p-2" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="block mt-1 w-full border rounded p-2" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label class="block font-medium">Password</label>

                        <input id="password"
                               type="password"
                               name="password"
                               class="block mt-1 w-full border rounded p-2"
                               required>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Strength Meter Text -->
                        <div id="strength" class="mt-1 font-semibold"></div>

                        <!-- Progress Segments -->
                        <div class="strength-segments mt-2">
                            <div id="segment-1" class="strength-segment"></div>
                            <div id="segment-2" class="strength-segment"></div>
                            <div id="segment-3" class="strength-segment"></div>
                            <div id="segment-4" class="strength-segment"></div>
                        </div>

                        <div id="strength-details" class="mt-1 text-xs text-gray-500"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label class="block font-medium">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="block mt-1 w-full border rounded p-2"
                               required>

                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mt-4">
                        <label class="block font-medium">Role</label>
                        <select name="role" class="block mt-1 w-full border rounded p-2">
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>
                                Student
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>

                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Save User
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- ================= PASSWORD STRENGTH STYLES ================= --}}
<style>
.strength-segments {
    display: flex;
    gap: 4px;
    height: 4px;
}

.strength-segment {
    flex: 1;
    border-radius: 2px;
    background-color: #e5e7eb;
    transition: all 0.3s ease;
}

.strength-segment.active { transform: scaleY(1.2); }
.strength-segment.weak { background-color: #ef4444; }
.strength-segment.medium { background-color: #f59e0b; }
.strength-segment.strong { background-color: #10b981; }
</style>


{{-- ================= PASSWORD STRENGTH SCRIPT ================= --}}
<script>
document.getElementById("password").addEventListener("input", function () {

    let value = this.value;
    let strengthDiv = document.getElementById("strength");
    let strengthDetails = document.getElementById("strength-details");

    // Reset segments
    for (let i = 1; i <= 4; i++) {
        document.getElementById(`segment-${i}`).className = "strength-segment";
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

    let level = 0;

    if (value.length >= 1) level = 1;
    if (value.length >= 6) level = 2;
    if (hasLength && (hasUpper || hasNumber || hasSpecial)) level = 3;
    if (hasLength && hasUpper && hasLower && hasNumber && hasSpecial) level = 4;

    const colors = ["", "weak", "weak", "medium", "strong"];
    for (let i = 1; i <= level; i++) {
        document.getElementById(`segment-${i}`).classList.add("active", colors[level]);
    }

    if (level === 4) {
        strengthDiv.innerText = "Strength: Strong";
        strengthDiv.style.color = "#10b981";
        strengthDetails.innerText = "✓ Excellent! Strong password.";
    }
    else if (level === 3) {
        strengthDiv.innerText = "Strength: Medium";
        strengthDiv.style.color = "#f59e0b";
        strengthDetails.innerText = "Add more character types.";
    }
    else {
        strengthDiv.innerText = "Strength: Weak";
        strengthDiv.style.color = "#ef4444";
        strengthDetails.innerText = "Use 8+ chars, uppercase, number, special.";
    }
});
</script>