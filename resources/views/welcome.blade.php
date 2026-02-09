<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Portal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- NAVBAR -->
    <nav class="flex items-center justify-end gap-4 p-6">

        @auth

            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ url('/admin/dashboard') }}"
                   class="px-5 py-2 border rounded text-sm">
                   Admin Dashboard
                </a>
            @else
                {{-- STUDENT --}}
                <a href="{{ url('/student/dashboard') }}"
                   class="px-5 py-2 border rounded text-sm">
                   Student Dashboard
                </a>
            @endif

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-2 border rounded text-sm text-red-600">
                    Logout
                </button>
            </form>

        @else

            {{-- LOGIN --}}
            <a href="{{ route('login') }}"
               class="px-5 py-2 border rounded text-sm">
               Log in
            </a>

            {{-- REGISTER --}}
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-5 py-2 border rounded text-sm">
                   Register
                </a>
            @endif

        @endauth

    </nav>


    <!-- MAIN CONTENT -->
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">
                Welcome to the Student Portal
            </h1>

            <p class="text-gray-600">
                Please log in or register to continue.
            </p>
        </div>
    </div>

</body>
</html>
