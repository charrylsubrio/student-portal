<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Users
            </h2>

            <!-- CREATE BUTTON -->
            <a href="{{ route('admin.users.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Role</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-2 border">{{ $user->id }}</td>
                                <td class="p-2 border">{{ $user->name }}</td>
                                <td class="p-2 border">{{ $user->email }}</td>
                                <td class="p-2 border">{{ ucfirst($user->role) }}</td>

                                <!-- ACTION BUTTONS -->
                                <td class="p-2 border space-x-2">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
