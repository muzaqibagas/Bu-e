<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="{{ asset('asset/css/admin-c/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Admin</h1>
            <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="{{ $admin->username }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $admin->email }}" required>
                </div>
                <button type="submit">Update Admin</button>
            </form>
            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this admin?')">Delete Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
