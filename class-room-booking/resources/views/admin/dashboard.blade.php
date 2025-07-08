<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body class="p-10 font-sans">
    <h1 class="text-2xl font-bold">Welcome, Admin!</h1>
    <p>You are now logged in as an admin.</p>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
            Logout
        </button>
    </form>
</body>
</html>
