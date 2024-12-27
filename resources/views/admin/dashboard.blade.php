<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, Admin!</h1>
        <p>You have access to the admin dashboard.</p>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>