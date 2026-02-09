<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    You are logged in as a <strong>Student</strong>.
                </p>

            </div>

        </div>
    </div>
</x-app-layout>