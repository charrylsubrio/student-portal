<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Portal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="flex items-center justify-end gap-4 p-6">

        @auth

            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ url('/admin/dashboard') }}"
                   class="px-5 py-2 border border-gray-600 rounded text-sm hover:bg-gray-800">
                   Admin Dashboard
                </a>
            @else
                {{-- STUDENT --}}
                <a href="{{ url('/student/dashboard') }}"
                   class="px-5 py-2 border border-gray-600 rounded text-sm hover:bg-gray-800">
                   Student Dashboard
                </a>
            @endif

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-2 border border-red-500 rounded text-sm text-red-400 hover:bg-red-600 hover:text-white">
                    Logout
                </button>
            </form>

        @else

            {{-- LOGIN --}}
            <a href="{{ route('login') }}"
               class="px-5 py-2 border border-gray-600 rounded text-sm hover:bg-gray-800">
               Log in
            </a>

            {{-- REGISTER --}}
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-5 py-2 border border-gray-600 rounded text-sm hover:bg-gray-800">
                   Register
                </a>
            @endif

        @endauth

    </nav>


    <!-- MAIN CONTENT -->
    <main class="flex-1 flex items-center justify-center">
        <div class="text-center">

            <h1 class="text-4xl font-bold mb-4">
                Welcome to the Student Portal
            </h1>

            <p class="text-gray-400">
                Please log in or register to continue.
            </p>

        </div>
    </main>

</body>
</html>