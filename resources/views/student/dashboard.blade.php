<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>

    <h1>Student Dashboard</h1>

    <p>Welcome, {{ auth()->user()->name }}</p>

    <!-- ✅ Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="color:red; margin-top:10px;">
            Logout
        </button>
    </form>

</body>
</html>
