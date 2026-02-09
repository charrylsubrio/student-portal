<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name"
                               value="{{ $user->name }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email"
                               value="{{ $user->email }}"
                               class="w-full border rounded p-2" required>
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label class="block font-medium">Role</label>
                        <select name="role" class="w-full border rounded p-2">
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <button class="bg-green-600 text-white px-4 py-2 rounded">
                        Update User
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
