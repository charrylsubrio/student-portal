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
                    <div class="mb-4">
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="w-full border rounded p-2" required>

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full border rounded p-2" required>

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block font-medium">Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full border rounded p-2" required>

                        <!-- Strength Meter -->
                        <div id="password-strength" class="mt-2 text-sm font-semibold"></div>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label class="block font-medium">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border rounded p-2" required>
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label class="block font-medium">Role</label>
                        <select name="role" class="w-full border rounded p-2">
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
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save User
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Password Strength Script -->
<script>
document.getElementById('password').addEventListener('input', function () {
    const password = this.value;
    const strengthText = document.getElementById('password-strength');

    let strength = 0;

    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    if (password.length === 0) {
        strengthText.textContent = "";
        return;
    }

    if (strength <= 2) {
        strengthText.textContent = "Strength: Weak";
        strengthText.className = "mt-2 text-sm font-semibold text-red-600";
    } else if (strength === 3) {
        strengthText.textContent = "Strength: Medium";
        strengthText.className = "mt-2 text-sm font-semibold text-yellow-600";
    } else {
        strengthText.textContent = "Strength: Strong";
        strengthText.className = "mt-2 text-sm font-semibold text-green-600";
    }
});
</script>
